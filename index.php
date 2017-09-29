<?php

session_start();

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
use \FW\Core\Config;

$fw = FW::getInstance();

$fw->scanComponents(
	__DIR__ . '/app/controllers',
	__DIR__ . '/app/services',
	__DIR__ . '/app/repositories');

$config->set('views-folder', __DIR__ . '/app/views');

$fw->run();
