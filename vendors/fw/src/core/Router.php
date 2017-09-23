<?php

namespace FW\Core;

class Router {

	private static $instance;

	public $routes;

	private $validMethods = ['GET', 'HEAD', 'POST', 'PUT', 'DELETE', 'CONNECT', 'OPTIONS', 'TRACE', 'PATCH'];

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

		if (preg_match('/@Route\s([^\n]+)/i', $reflection->getDocComment(), $matches)) {
			$root = trim($matches[1]);
		} else {
			throw new \Exception('A route must be specified on the controller "' . $class . '"');
		}

		if (strlen($root) && $root[0] !== '/') {
			$root = '/' . $root;
		}

		foreach($reflection->getMethods() as $method) {
			if (!$method->isConstructor() && $method->isPublic()) {
				$route = $this->resolveRoute($root, $method);
				vd($route);
			}
		}
	}

	public function resolve($route) {

	}

	private function resolveRoute($root, $method) {
		$path = '';
		$methods = ['GET'];

		if (preg_match("/@RequestMap\s([^" . PHP_EOL . "]+)/i", $method->getDocComment(), $matches)) {
			$path = trim($matches[1]);
		}

		if (preg_match("/@RequestMethod\s([^" . PHP_EOL . "]+)/i", $method->getDocComment(), $matches)) {
			$methods = trim($matches[1], "[]");
			$methods = preg_split("/(,\s?)/i", $methods);
			$methods = array_filter($methods);

			try {
				$this->validateMethods($methods);
			} catch (\Exception $e) {
				throw new \Exception($e->getMessage() . ' on the method "' . $method->getName() . '"
					of the controller "' . $method->getDeclaringClass()->getName() . '"');
			}
		}

		$route = $root;

		if (strlen($path) && $path[0] !== '/') {
			$route .= '/';
		}

		$route .= $path;
		$route = preg_replace('/[\/\/]+/i', '/', $route);

		return (object) [
			'route' => $route,
			'methods' => $methods
		];
	}

	private function validateMethods(array $methods) {
		foreach ($methods as $method) {
			if (!in_array($method, $this->validMethods)) {
				throw new \Exception('Invalid HTTP Method "' . $method . '"');
			}
		}
	}

}
