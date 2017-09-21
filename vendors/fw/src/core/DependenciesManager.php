<?php

namespace FW\Core;

class DependenciesManager {

	private static $instance;

	public $instances;

	protected function __construct() {
		$this->instances = [];
	}

	public static function getInstance() : self {
		if (is_null(self::$instance)) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function register($class) {
		$reflection = new \ReflectionClass($class);

		$dependecies = [];
		$interfaces = array_merge($reflection->getInterfaceNames(), [$reflection->getName()]);
		$constructor = $reflection->getConstructor();

		if ($constructor) {
			foreach ($constructor->getParameters() as $parameter) {
				$dependendy = [
					'name' => $parameter->getName(),
					'type' => $parameter->hasType() ? $parameter->getType()->__toString() : null,
					'position' => $parameter->getPosition()
				];

				$dependecies[] = (object) $dependendy;
			}
		}

		foreach ($interfaces as $interface) {
			$instance = [
				'name' => $reflection->getName(),
				'instance' => null,
				'dependecies' => $dependecies
			];

			$this->instances[$interface][] = (object) $instance;
		}
	}

	public function make() {

	}

}
