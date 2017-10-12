<?php

namespace App\Components;

class SelectComponent implements IComponent {

	private $templates = [];

	public function render(bool $print = false) {
		$input = 'input rendered';

		if ($print) {
			echo $input;
		} else {
			return $input;
		}
	}

	public function __get(string $attr) {
		if (!property_exists($attr, __CLASS__)) {
			throw new \Exception('The property "' . $attr . '" does not exists on the class "' . __CLASS__ . '"');
		}

		return $this->$attr;
	}

	public function __set(string $attr, $value) {
		if (!property_exists($attr, __CLASS__)) {
			throw new \Exception('The property "' . $name . '" does not exists on the class ' . __CLASS__);
		}

		$this->$attr = $value;
	}

	public function __toString() {
		return $this->render(false);
	}

}
