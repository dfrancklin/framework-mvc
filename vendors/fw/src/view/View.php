<?php

namespace FW\View;

use \FW\Security\ISecurityService;
use \FW\Core\DependenciesManager;

class View {

	private $data;

	private $security;

	private static $views;

	private static $template = 'template';

	public function __construct(ISecurityService $security) {
		$this->security = $security;
	}

	public function bind($name, &$value) {
		$this->$name = $value;
	}

	public function __set($name, $value) {
		$this->data[$name] = $value;
	}

	public function render($page) {
		$template = self::getViews() . '/' . self::getTemplate() . '.php';
		if (!file_exists($template)) {
			throw new \Exception('Template file "' . $template . '" does not exists!');
		}

		$page = self::getViews() . '/' . $page . '.php';
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

	public static function setViews($folder) {
		if (!file_exists($folder)) {
			throw new \Exception('Folder "' . $folder . '" does not exists!');
		}

		self::$views = $folder;
	}

	public static function getViews() {
		if (!self::$views) {
			throw new \Exception('No folder for views files was specified!');
		}

		return self::$views;
	}

	public static function setTemplate($template) {
		$file = self::getViews() . '/' . $template . '.php';

		if (!file_exists($file)) {
			throw new \Exception('Template file "' . $file . '" does not exists!');
		}

		self::$template = $template;
	}

	public static function getTemplate() {
		if (!self::$template) {
			throw new \Exception('No template file was specified!');
		}

		return self::$template;
	}

}

