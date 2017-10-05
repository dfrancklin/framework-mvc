<?php

$config = \FW\Core\Config::getInstance();

$config->set('views-folder', __DIR__ . '/views');
$config->set('menu', (object) [
	'title' => 'Title',
	'icon' => 'Icon',
	'groups' => [
		(object) [
			'title' => 'Title',
			'icon' => 'Icon',
			'items' => [
				(object) [
					'title' => 'Dashboard',
					'icon' => 'dashboard',
					'href' => '/dashboard',
					'class' => 'menu--item',
					'classActive' => 'menu--item__active',
					'active' => ['/', '/dashboard'],
					'roles' => [],
				],
				(object) [
					'title' => 'Products',
					'icon' => 'cog',
					'href' => '/products',
					'class' => 'menu--item',
					'classActive' => 'menu--item__active',
					'active' => ['/products/*'],
					'roles' => [],
				],
			],
		],
	],
]);
