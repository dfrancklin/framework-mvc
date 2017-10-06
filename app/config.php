<?php

$config = \FW\Core\Config::getInstance();

$config->set('views-folder', __DIR__ . '/views');
$config->set('menu', (object) [
	'groups' => [
		(object) [
			'title' => 'Title',
			'icon' => 'build',
			'items' => [
				(object) [
					'title' => 'Dashboard',
					'icon' => 'dashboard',
					'href' => '/dashboard',
					'class' => 'menu--item',
					'classActive' => 'menu--item__active',
					'activeRoute' => ['/', '/dashboard'],
					'roles' => [],
				],
				(object) [
					'title' => 'Products',
					'icon' => 'cog',
					'href' => '/products',
					'class' => 'menu--item',
					'classActive' => 'menu--item__active',
					'activeRoute' => ['/products/*'],
					'roles' => [],
				],
			],
		],
	],
]);
