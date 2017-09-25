<?php

namespace FW\Core;

class Router {

	private static $instance;

	public $routes;

	private $validMethods;

	private $dm;

	protected function __construct() {
		$this->routes = [];
		$this->validMethods = ['CONNECT', 'COPY', 'DELETE', 'GET', 'HEAD', 'LOCK', 'OPTIONS', 'PATCH', 'POST', 'PROPFIND', 'PUT', 'TRACE', 'UNLOCK'];
		$this->dm = DependenciesManager::getInstance();
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
				list($path, $requestMethods) = $this->resolveMethod($method);

				$route = $root;

				if (strlen($path) && $path[0] !== '/') {
					$route .= '/';
				}

				$route .= $path;
				$route = '/^' . preg_replace(['/[\/\/]+/i', '/\//i', '/{(.*?)}/i'], ['/', '\/', '([^\/]+)'], $route) . '\/?$/i';

				$parameters = array_map(function($parameter) {
					return $parameter->getName();
				}, $method->getParameters());

				if (array_key_exists($route, $this->routes)) {
					throw new \Exception('The route "' . $route . '" already exists');
				}

				$this->routes[$route] = (object) [
					'class' => $class,
					'method' => $method->getName(),
					'parameters' => $parameters,
					'requestMethods' => $requestMethods,
					'pattern' => $route,
				];
			}
		}
	}

	private function resolveMethod($method) {
		$path = '';
		$methods = ['GET'];

		if (preg_match("/@RequestMap\s([^" . PHP_EOL . "]+)/i", $method->getDocComment(), $matches)) {
			$path = trim($matches[1]);
		}

		if (preg_match("/@RequestMethod\s([^" . PHP_EOL . "]+)/i", $method->getDocComment(), $matches)) {
			$methods = trim($matches[1], "[]");
			$methods = preg_split("/(,\s?)/i", $methods);
			$methods = array_filter($methods);

			if (in_array('ALL', $methods)) {
				$methods = $this->validMethods;
			} else {
				try {
					$this->validateMethods($methods);
				} catch (\Exception $e) {
					throw new \Exception($e->getMessage() . ' on the method "' . $method->getName() . '"
						of the controller "' . $method->getDeclaringClass()->getName() . '"');
				}
			}
		}

		return [$path, $methods];
	}

	private function validateMethods(array $methods) {
		foreach ($methods as $method) {
			if (!in_array($method, $this->validMethods)) {
				throw new \Exception('Invalid HTTP Method "' . $method . '"');
			}
		}
	}

	public function handle($route, $requestMethod) {
		$map = $this->findRoute($route);

		if (!in_array($requestMethod, $map->requestMethods)) {
			throw new \Exception('HTTP Method "' . $requestMethod . '" not allowed on route "' . $route . '"');
		}

		$controller = $this->dm->resolve($map->class);
		preg_match($map->pattern, $route, $matches);
		array_shift($matches);

		$view = $controller->{$map->method}(...$matches);
		vd($view);
	}

	private function findRoute($route) {
		$routes = array_filter($this->routes, function($pattern) use ($route) {
			return preg_match($pattern, $route);
		}, ARRAY_FILTER_USE_KEY);

		if (!count($routes)) {
			throw new \Exception('Route "' . $route . '" not found');
		}

		return array_values($routes)[0];
	}

}
