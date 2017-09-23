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
		if (!isset($_SERVER['PATH_INFO'])) {
			$controller = $this->router->resolve('/');
		} else {
			$controller = $this->router->resolve($_SERVER['PATH_INFO']);
		}

		$controller = $this->dm->resolve($controller);
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

}
