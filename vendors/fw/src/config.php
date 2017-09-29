<?php

$config = \FW\Core\Config::getInstance();

$config->set('template', 'template');
$config->set('page-404', 'not-found');
$config->set('log', __DIR__ . '/logs/' . date('Y-m-d') . '-log-{level}.log');
$config->set('app-id', md5($_SERVER['SERVER_NAME']));
