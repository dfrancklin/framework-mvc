<?php

namespace App\Components;

class MenuComponent {
	
	private static $config;
	
	private static $templates = [];
	
	public static function render() {
		$menu = \FW\Core\Config::getInstance()->get('menu');
		vd($menu);
	}

}