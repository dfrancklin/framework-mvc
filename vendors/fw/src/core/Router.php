<?php

namespace FW\Core;

class Router {

	private static $instance;

	public $routes;

	protected function __construct() {

	}

	public static function getInstance() : self {
		if (is_null(self::$instance)) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function register($class) {
		$reflection = new \ReflectionClass($class);

		$reflection->getDocComment();
	}

}
