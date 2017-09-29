<?php
$config = \FW\Core\Config::getInstance();

$config->set('template', 'template');
$config->set('not-found', 'not-found');
$config->set('log', __DIR__ . '/logs/' . date('Y-m-d') . '-log-{level}.log');
