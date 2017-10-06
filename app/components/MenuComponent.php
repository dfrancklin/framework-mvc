<?php

namespace App\Components;

class MenuComponent {

	private static $config;

	private static $templates = [
		'menu' => '<aside class="menu bg-dark">%s</aside>',
		'menu-group' => '<nav class="menu--group">%s%s</nav>',
		'menu-title' => '<h3 class="menu--title">%s%s</h3>',
		'menu-content' => '<ul class="menu--content">%s</ul>',
		'menu-item' => '<li class="menu--item">%s</li>',
		'icon' => '<span class="material-icons mr-2">%s</span>',
	];

	public static function render() {
		$menu = \FW\Core\Config::getInstance()->get('menu');

		$output = '';

		foreach ($menu->groups as $group) {
			$output .= self::formatGroup($group);
		}

		echo sprintf(self::$templates['menu'], $output);
	}

	private static function formatGroup($group) {
		$title = '';

		if ($group->icon || $group->title) {
			$icon = $group->icon
					? sprintf(self::$templates['icon'], $group->icon)
					: '';

			$title .= sprintf(self::$templates['menu-title'], $icon, $group->title);
		}

		$content = self::formatContent($group->items);

		return sprintf(self::$templates['menu-group'], $title, $content);
	}

	private static function formatContent($items) {
		$content = '';

		foreach ($items as $item) {
			$content .= self::formatItem($item);
		}

		return sprintf(self::$templates['menu-content'], $content);
	}

	private static function formatItem($item) {
		echo '<div class="main"><div class"container-fluid">';
		$dm = \FW\Core\DependenciesManager::getInstance();
		$router = \FW\Core\Router::getInstance();
		$security = $dm->resolve(\FW\Security\SecurityService::class);

		$show = !empty($item->roles) ? $security->hasAnyRoles($item->roles) : true;
		$active = $router->getActiveRoute();

		if (!$show) {
			return;
		}

		foreach ($item->activeRoute as $route) {
			$pattern = '/^' . preg_replace(['/[\/\/]+/i', '/\//i', '/([\*]+)/i'], ['/', '\/', '(.*)'], $route) . '$/';
			vd($active, $pattern, preg_match($pattern, $active));
		}


		echo '</div></div>';
	}

}
