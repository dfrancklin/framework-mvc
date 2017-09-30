<?php

namespace FW\View;

use \FW\Core\Config;
use \FW\Core\FlashMessages;
use \FW\Core\DependenciesManager;
use \FW\Security\ISecurityService;

class View {

	private $data;

	private $security;

	private $template;
	
	private $messages;

	private $views;

	public function __construct(ISecurityService $security, FlashMessages $messages, string $template, string $views) {
		$this->security = $security;
		$this->messages = $messages;
		$this->template = $template;
		$this->views = $views;
		$this->data = [];
	}

	public function __get($name) {
		if (!array_key_exists($name, $this->data)) {
			throw new \Exception('A variable "' . $name . '" was not defined on the view');
		}
		
		return $this->data[$name];
	}

	public function __set($name, $value) {
		$this->data[$name] = $value;
	}

	public function render($page) {
		$template = $this->views . '/' . $this->template . '.php';
		if (!file_exists($template)) {
			throw new \Exception('Template file "' . $template . '" does not exists!');
		}

		$page = $this->views . '/' . $page . '.php';
		if (!file_exists($page)) {
			throw new \Exception('Page file "' . $page . '" does not exists!');
		}

		if (count($this->data)) {
			extract($this->data);
		}

		ob_start();
		require $page;
		$content = ob_get_contents();
		ob_clean();

		ob_start();
		require $template;
		$total = ob_get_contents();
		ob_clean();

		list($head, $foot) = preg_split('/<!--\s?content\s?-->/i', $total);

		return $head . $content . $foot;
	}

}

