<?php

namespace FW;

use \FW\Core\DependenciesManager;
use \FW\Core\Router;

class FW {

	private static $instance;

	public $dm;

	public $router;

	private $statics;

	private $views;

	private $template;

	protected function __construct() {
		$this->dm = DependenciesManager::getInstance();
		$this->router = Router::getInstance();
		$this->template = 'template';
	}

	public static function getInstance() : self {
		if (is_null(self::$instance)) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function lookThrough(String ...$folders) {
		if (!count($folders)) {
			throw new \Exception('At least 1 folder needs to be informed');
		}

		foreach ($folders as $folder) {
			$this->lookUp($folder, true);
		}
	}

	public function lookUp($folder, $recursive = false) {
		if (!$folder) {
			throw new \Exception('A folder needs to be informed');
		}

		foreach (glob($folder . DIRECTORY_SEPARATOR . '*') as $entry) {
			if (is_dir($entry) && $recursive) {
				$this->lookUp($folder);
			} else {
				$this->resolveEntry($entry);
			}
		}
	}

	public function run() {
		if (!isset($_SERVER['PATH_INFO']) && !isset($_SERVER['REDIRECT_URL'])) {
			$controller = $this->router->handle('/', $_SERVER['REQUEST_METHOD']);
		} else {
			$controller = $this->router->handle($_SERVER['PATH_INFO'] ?? $_SERVER['REDIRECT_URL'], $_SERVER['REQUEST_METHOD']);
		}
	}

	private function resolveEntry($entry) {
		$handler = fopen($entry, 'r');

		if (!$handler) {
			throw new \Exception('Folder "' . $entry . '" does not exists');
		}

		$namespace = $className = null;
		$isController = false;

		while (!feof($handler) && !($namespace && $className)) {
			$line = fgets($handler);

			if (preg_match('/namespace\s([^;]+)/i', trim($line), $matches)) {
				$namespace = $matches[1];
			} else if (preg_match('/class\s([^\s]+)/i', trim($line), $matches) && $namespace) {
				$className = $matches[1];
			}

			if (preg_match('/@Controller$/i', trim($line), $matches) && $namespace) {
				$isController = true;
			}
		}

		fclose($handler);

		if (!$namespace || !$className) {
			return;
		}

		$fullName = $namespace . '\\' . $className;

		$this->dm->register($fullName);

		if($isController) {
			$this->router->register($fullName);
		}
	}

	public function setStatics($folder) {
		if (!file_exists($folder)) {
			throw new \Exception('Folder "' . $folder . '" does not exists!');
		}

		$this->statics = $folder;
	}

	public function getStatics() {
		if (!$this->statics) {
			throw new \Exception('No folder for static files was specified!');
		}

		return $this->statics;
	}

	public function setViews($folder) {
		if (!file_exists($folder)) {
			throw new \Exception('Folder "' . $folder . '" does not exists!');
		}

		$this->views = $folder;
	}

	public function getViews() {
		if (!$this->views) {
			throw new \Exception('No folder for views files was specified!');
		}

		return $this->views;
	}

	public function setTemplate($template) {
		$file = $this->views . '/' . $template . '.php';

		if (!file_exists($file)) {
			throw new \Exception('Template file "' . $file . '" does not exists!');
		}

		$this->template = $template;
	}

	public function getTemplate() {
		if (!$this->template) {
			throw new \Exception('No template file was specified!');
		}

		return $this->template;
	}

}
