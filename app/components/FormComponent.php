<?php

namespace App\Components;

class FormComponent implements IComponent {

	const METHODS = ['GET', 'POST', 'PUT', 'DELETE'];

	const TEMPLATES = [
		'form' => '<form class="row" action="%s" method="%s" name="%s" id="%s">%s%s</form>'
	];

	const COMPONENTS = [
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

	private $buttons = [];

	public function __call(string $method, array $parameters) {
		if (array_key_exists($method, self::COMPONENTS)) {
			return $this->add($method, ...$parameters);
		} else {
			throw new \Exception('The method "' . $method . '" does not exists on class "' . self::class . '"');
		}
	}

	private function add(string $type, array $config) {
		$component = self::COMPONENTS[$type];
		$component = new $component;

		foreach ($config as $attr => $value) {
			$component->{$attr} = $value;
		}

		if ($component instanceof \App\Components\ButtonComponent) {
			$this->buttons[] = $component;
		} else {
			$this->children[] = $component;
		}

		return $this;
	}

	public function render(bool $print = true) {
		if (empty($this->method)) {
			$this->method = 'GET';
		}

		if (!in_array($this->method, self::METHODS)) {
			throw new \Exception('The HTTP Method "' . $method . '" is invalid');
		}
		
		if (!empty($this->buttons)) {
			array_unshift($this->buttons, '<div class="form-group col">');
			array_push($this->buttons, '</div>');
		}
		
		$form = sprintf(self::TEMPLATES['form'], 
											$this->action, 
											$this->method, 
											$this->name, 
											$this->id, 
											implode("\n", $this->children), 
											implode("\n", $this->buttons));

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
