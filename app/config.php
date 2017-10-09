<?php

$config = \FW\Core\Config::getInstance();

$config->set('views-folder', __DIR__ . '/views');
$config->set('menu', (object) [
	'groups' => [
		(object) [
			'title' => '',
			'icon' => '',
			'items' => [
				(object) [
					'title' => 'Dashboard',
					'icon' => 'dashboard',
					'href' => '/dashboard',
					'activeRoute' => ['/', '/dashboard'],
					'roles' => [],
				],
				(object) [
					'title' => 'Products',
					'icon' => 'settings',
					'href' => '/products',
					'activeRoute' => ['/products/*'],
					'roles' => [],
				],
			],
		],
	],
]);
