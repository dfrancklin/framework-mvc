<?php

namespace App\Components;

class ButtonComponent implements IComponent {

	private $templates = [];

	private $name;

	private $text;

	private $type;

	private $size;

	private $block;

	private $style;

	public function render(bool $print = false) {
		$input = 'input rendered';

		if ($print) {
			echo $input;
		} else {
			return $input;
		}
	}

	public function __get(string $attr) {
		if (!property_exists(__CLASS__, $attr)) {
			throw new \Exception('The property "' . $attr . '" does not exists on the class "' . __CLASS__ . '"');
		}

		return $this->$attr;
	}

	public function __set(string $attr, $value) {
		if (!property_exists(__CLASS__, $attr)) {
			throw new \Exception('The property "' . $attr . '" does not exists on the class "' . __CLASS__ . '"');
		}

		$this->$attr = $value;
	}

	public function __toString() {
		return $this->render(false);
	}

}
