<?php

namespace App\Components;

class ButtonComponent implements IComponent {

	const STYLES = [
		'primary' => 'btn-primary',
		'secondary' => 'btn-secondary',
		'success' => 'btn-success',
		'danger' => 'btn-danger',
		'warning' => 'btn-warning',
		'info' => 'btn-info',
		'light' => 'btn-light',
		'dark' => 'btn-dark',
		'link' => 'btn-link'
	];

	const SIZES = [
		's' => ' btn-sm',
		'n' => '',
		'l' => ' btn-lg'
	];

	const TYPES = ['button', 'reset', 'submit'];

	private $templates = [
		'button' => '<div class="form-group col"><button type="%s" name="%s" title="%s" class="btn %s %s %s">%s%s</button></div>',
		'icon' => '<span class="material-icons">%s</span>'
	];

	private $name;

	private $title;

	private $type;

	private $size;

	private $block;

	private $style;

	private $icon;

	public function render(bool $print = false) {
		$button = $this->formatButton();

		if ($print) {
			echo $button;
		} else {
			return $button;
		}
	}

	private function formatButton() {
		$icon = '';

		if (empty($this->name)) {
			throw new \Exception('The name of the button must be informed');
		}

		if (empty($this->type) || !in_array($this->type, self::TYPES)) {
			$this->type = 'button';
		}

		if (empty($this->style) || !array_key_exists($this->style, self::STYLES)) {
			$this->style = 'secondary';
		}

		if (empty($this->size) || !array_key_exists($this->size, self::SIZES)) {
			$this->size = 'n';
		}

		if (empty($this->title)) {
			$this->title = ucfirst($this->name);
		}

		if (!empty($this->icon)) {
			$icon = sprintf($this->templates['icon'], $this->icon);
		}

		return sprintf($this->templates['button'],
						$this->type,
						$this->name,
						$this->title,
						self::STYLES[$this->style],
						self::SIZES[$this->size],
						($this->block ? ' btn-block' : ''),
						$this->title,
						$icon);
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
