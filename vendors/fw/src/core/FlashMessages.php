<?php

namespace FW\Core;

class FlashMessages {

	private static $instance;

	const INFO = 'i';
	const SUCCESS = 's';
	const WARNING = 'w';
	const ERROR = 'e';

	protected $types = [
		self::ERROR => 'error',
		self::WARNING => 'warning',
		self::SUCCESS => 'success',
		self::INFO => 'info',
	];

	protected $wrapper = "<div class='%s'>%s</div>\n";

	private $appId;

	private $id = 'flash-messages';

	protected function __construct() {
		$this->appId = Config::getInstance()->get('app-id');

		if (!array_key_exists($this->id, $_SESSION[$this->appId])){
			$_SESSION[$this->appId][$this->id] = [];
		}
	}

	public static function getInstance() : self {
		if (is_null(self::$instance)) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function __call($method, $parameters) {
		if (defined('self::' . strtoupper($method))) {
			$type = constant('self::' . strtoupper($method));
			$this->add($parameters[0], $type);
		} else {
			throw new \Exception('The method "' . $method . '" does not exists on class "' . self::class . '"');
		}
	}

	public function add($message, $type) {
		if (!trim($message)) {
			return false;
		}

		if (!array_key_exists($type, $this->types)) {
			$type = self::INFO;
		}

		if (!array_key_exists($type, $_SESSION[$this->appId][$this->id])) {
			$_SESSION[$this->appId][$this->id][$type] = [];
		}

		$_SESSION[$this->appId][$this->id][$type][] = $message;
	}

	public function display($types = null, $print = true) {
		if (!isset($_SESSION[$this->appId][$this->id])) {
			return false;
		}

		$output = '';

		if (is_null($types) || !$types || (is_array($types) && empty($types)) ) {
			$types = array_keys($this->types);
		} elseif (is_array($types) && !empty($types)) {
			$theTypes = $types;
			$types = [];

			foreach($theTypes as $type) {
				$types[] = strtolower($type[0]);
			}
		} else {
			$types = [strtolower($types[0])];
		}

		foreach ($types as $type) {
			if (!isset($_SESSION[$this->appId][$this->id][$type]) || empty($_SESSION[$this->appId][$this->id][$type])) {
				continue;
			}

			foreach($_SESSION[$this->appId][$this->id][$type] as $message) {
				$output .= $this->format($message, $type);
			}

			$this->clear($type);
		}

		if ($print) {
			echo $output;
		} else {
			return $output;
		}
	}

	public function hasErrors() {
		return !empty($_SESSION[$this->appId][$this->id][self::ERROR]);
	}

	public function hasMessages($type = null) {
		if (!is_null($type)) {
			if (!empty($_SESSION[$this->appId][$this->id][$type])) {
				return $_SESSION[$this->appId][$this->id][$type];
			}
		} else {
			foreach (array_keys($this->types) as $type) {
				if (isset($_SESSION[$this->appId][$this->id][$type]) && !empty($_SESSION[$this->appId][$this->id][$type])) {
					return $_SESSION[$this->appId][$this->id][$type];
				}
			}
		}

		return false;
	}

	protected function format($message, $type) {
		$msgType = isset($this->types[$type]) ? $type : $this->defaultType;
		$css = 'alert alert-' . $this->types[$type];

		return sprintf($this->wrapper, $css, $message);
	}

	protected function clear($types = []) {
		if ((is_array($types) && empty($types)) || is_null($types) || !$types) {
			unset($_SESSION[$this->appId][$this->id]);
		} elseif (!is_array($types)) {
			$types = [$types];
		}

		foreach ($types as $type) {
			unset($_SESSION[$this->appId][$this->id][$type]);
		}

		return $this;
	}

}
