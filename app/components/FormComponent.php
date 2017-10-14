<?php

namespace App\Components;

class FormComponent implements IComponent {

	private $templates = [
		'form' => '<form class="row" action="%s" method="%s" name="%s" id="%s">%s</form>'
	];

	private $methods = ['GET', 'POST', 'PUT', 'DELETE'];

	private $components = [
		'input' => \App\Components\InputComponent::class,
		'select' => \App\Components\SelectComponent::class,
		'uploader' => \App\Components\UploaderComponent::class,
		'button' => \App\Components\ButtonComponent::class,
	];

	private $action;

	private $method;

	private $name;

	private $id;

	private $children = [];

	private function method($method) {
		if (empty($method)) {
			throw new \Exception('A valid HTTP method "' . $method . '" must be informed');
		}

		if (!in_array($method, $this->methods)) {
			throw new \Exception('The HTTP Method "' . $method . '" is invalid');
		}

		$this->method = $method;

		return $this;
	}

	public function __call(string $method, array $parameters) {
		if (array_key_exists($method, $this->components)) {
			return $this->add($method, ...$parameters);
		} else {
			throw new \Exception('The method "' . $method . '" does not exists on class "' . self::class . '"');
		}
	}

	private function add(string $type, array $config) {
		$component = new $this->components[$type];

		foreach ($config as $attr => $value) {
			$component->{$attr} = $value;
		}

		$this->children[] = $component;

		return $this;
	}

	public function render(bool $print = true) {
		$form = $this->templates['form'];

		$form = sprintf($form, $this->action, $this->method, $this->name, $this->id, implode("\n", $this->children));

		if ($print) {
			echo $form;
		} else {
			return $form;
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
