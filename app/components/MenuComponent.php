<?php

namespace App\Components;

class MenuComponent {

	private static $config;

	private static $templates = [
		'menu' => '<aside class="menu js-menu"><div class="menu__wrapper js-menu-container bg-dark"><button class="menu__hide js-menu-hide">&times;</button>%s</div></aside>',
		'menu-group' => '<nav class="menu__group">%s%s</nav>',
		'menu-title' => '<h3 class="menu__title">%s%s</h3>',
		'menu-content' => '<ul class="menu__content nav flex-column nav-pills">%s</ul>',
		'menu-item' => '<li class="menu__item nav-item"><a href="%s" class="menu__link nav-link %s">%s%s</a></li>',
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
// 		echo '<div style="margin-left: 200px; margin-top: 60px;"><div class="container-fluid">';
		$dm = \FW\Core\DependenciesManager::getInstance();
		$router = \FW\Core\Router::getInstance();
		$security = $dm->resolve(\FW\Security\SecurityService::class);

		$show = !empty($item->roles) ? $security->hasAnyRoles($item->roles) : true;
		$active = false;

		if (!$show) {
			return;
		}

		foreach ($item->activeRoute as $route) {
			$pattern = '/^' . preg_replace(['/[\/\/]+/i', '/\//i', '/([\*]+)/i'], ['/', '\/', '?.*'], $route) . '$/';
			//vd($router->getActiveRoute(), $pattern, preg_match($pattern, $router->getActiveRoute()));

			if (preg_match($pattern, $router->getActiveRoute())) {
				$active = true;
				break;
			}
		}

// 		vd($router->getActiveRoute() . ' - ' . $show  . ' - ' . $active);
		$icon = $item->icon
				? sprintf(self::$templates['icon'], $item->icon)
				: '';
// 		echo '</div></div>';

		return sprintf(self::$templates['menu-item'], $item->href, $active ? 'active menu__link--active' : '', $icon, $item->title);
	}

}
