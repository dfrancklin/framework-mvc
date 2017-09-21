<?php

namespace FW;

use \FW\Core\DependenciesManager;
use \FW\Core\Router;

class FW {

	private static $instance;

	public $dm;

	public $router;

	protected function __construct() {
		$this->dm = DependenciesManager::getInstance();
		$this->router = Router::getInstance();
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
		foreach (glob($folder . DIRECTORY_SEPARATOR . '*') as $entry) {
			if (is_dir($entry) && $recursive) {
				$this->lookUp($folder);
			} else {
				$this->resolveEntry($entry);
			}
		}
	}

	public function run() {
		list($ctrl, $action, $params) = $this->breakURL();

		$ctrl = ucfirst($ctrl) . 'Controller';
		$ctrl = $this->dm->make($ctrl);

		vd($ctrl);
	}

	private function breakURL() {
		if (!isset($_SERVER['PATH_INFO'])) {
			return ['home', 'index', null];
		}

		$path = explode('/', substr($_SERVER['PATH_INFO'], 1));
		list($ctrl, $action) = $path;

		return [$ctrl, $action, array_slice($path, 2)];
	}

	private function resolveEntry($entry) {
		$handler = fopen($entry, 'r');

		if (!$handler) {
			throw new \Exception('Folder "' . $entry . '" does not exists');
		}

		$namespace = $className = null;

		while (!feof($handler) && !($namespace && $className)) {
			$line = fgets($handler);

			if (preg_match('/namespace\s([^;]+)/i', trim($line), $matches)) {
				$namespace = $matches[1];
			} else if (preg_match('/class\s([^\s]+)/i', trim($line), $matches)) {
				$className = $matches[1];
			}
		}

		fclose($handler);

		if (!$namespace || !$className) {
			return;
		}

		$fullName = $namespace . '\\' . $className;

		$this->dm->register($fullName);
	}

}
