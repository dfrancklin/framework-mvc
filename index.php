<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

header('refresh:2');

function vd(...$v) {
	echo '<pre style="white-space: pre-wrap; word-break: break-all;">';
	var_dump(...$v);
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

$fw->setViews(__DIR__ . '/app/views');

$fw->run();
