<?php

header('refresh:2');

function vd(...$vs) {
	echo '<pre style="white-space: pre-wrap; word-break: break-all;">';
	foreach ($vs as $v) var_dump($v);
	echo '</pre>';
}

function pr(...$vs) {
	echo '<pre style="white-space: pre-wrap; word-break: break-all;">';
	foreach ($vs as $v) print_r($v);
	echo '</pre>';
}

include __DIR__ . '/vendors/fw/load.php';

$loader->addNamespace('App', __DIR__ . '/app');

use \FW\FW;

$fw = FW::getInstance();

$fw->lookThrough(
	__DIR__ . '/app/controllers',
	__DIR__ . '/app/services',
	__DIR__ . '/app/repositories');

$fw->run();

// foreach ($fw->dm->instances as $interface => $instances) {
// 	vd($interface);

// 	foreach ($instances as $instance) {
// 		vd($instance);

// 		foreach ($instance['dependencies'] as $dependency) {
// 			vd($dependency);
// 		}
// 	}

// 	pr('---------------------------------------------------------------------------');
// }
