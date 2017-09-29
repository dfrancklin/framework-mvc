<?php

namespace FW\View;

use \FW\Security\ISecurityService;
use \FW\Core\DependenciesManager;

class View {

	private $data;

	private $security;

	private $views;

	private $template;

	public function __construct(ISecurityService $security, string $template, string $views) {
		$this->security = $security;
		$this->template = $template;
		$this->views = $views;
	}

	public function bind($name, &$value) {
		$this->$name = $value;
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

