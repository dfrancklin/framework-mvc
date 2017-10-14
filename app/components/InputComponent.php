<?php

namespace App\Components;
/**
 */
class InputComponent implements IComponent {

	const TYPES = [
		'color',
		'date',
		'datetime',
		'datetime-local',
		'email',
		'hidden',
		'month',
		'number',
		'password',
		'radio',
		'range',
		'tel',
		'text',
		'time',
		'url',
		'week'
	];

	const SIZES = [
		's' => ' input-group-sm',
		'n' => '',
		'l' => ' input-group-lg'
	];

	const WIDTHS = [
		'1' => ' col-12',
		'1/2' => ' col-md-6 col-12',
		'1/3' => ' col-md-4 col-12',
		'1/4' => ' col-md-3 col-12',
	];

	private $templates = [
		'form-group' => '<div class="form-group %s">%s%s</div>',
		'label' => '<label%s for="%s">%s:</label>',
		'input-group' => '<div class="input-group%s">%s%s</div>',
		'input-group-addon' => '<span class="input-group-addon%s"><span class="material-icons">%s</span></span>',
		'input' => '<input type="%s" name="%s" id="%s" placeholder="%s" title="%s" value="%s" class="form-control"%s%s>',
	];

	private $type;

	private $value;

	private $name;

	private $title;

	private $showLabel;

	private $required;

	private $autofocus;

	private $size;

	private $width;

	private $icon;

	public function render(bool $print = false) {
		$input = $this->formatFormGroup();

		if ($print) {
			echo $input;
		} else {
			return $input;
		}
	}

	private function formatFormGroup() {
		$inputGroup = $this->formatInputGroup();
		$label = sprintf($this->templates['label'], (!$this->showLabel ? ' class="sr-only"' : ''), $this->name, $this->title);

		if (empty($this->width) || !array_key_exists($this->width, self::WIDTHS)) {
			$this->width = '1';
		}

		return sprintf($this->templates['form-group'], self::WIDTHS[$this->width], $label, $inputGroup);
	}

	private function formatInputGroup() {
		$input = $this->formatInput();
		$icon = '';

		if (!empty($this->icon)) {
			$icon = sprintf($this->templates['input-group-addon'], null, $this->icon);
		}

		if (empty($this->size) || !array_key_exists($this->size, self::SIZES)) {
			$this->size = 'n';
		}

		$size = self::SIZES[$this->size];

		return sprintf($this->templates['input-group'], $size, $icon, $input);
	}

	private function formatInput() {
		if (empty($this->name)) {
			throw new \Exception('The name of the input must be informed');
		}

		if (empty($this->type) || !in_array($this->type, self::TYPES)) {
			$this->type = 'text';
		}

		if (empty($this->title)) {
			$this->title = ucfirst($this->name);
		}

		return sprintf($this->templates['input'],
						$this->type,
						$this->name,
						$this->name,
						$this->title,
						$this->title,
						$this->value,
						($this->required ? ' required' : null),
						($this->autofocus ? ' autofocus' : null));
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
