<?php

define('APP_ROOT', dirname(__DIR__));
require_once APP_ROOT . '/vendor/autoload.php';

error_reporting(E_ALL);
ini_set('display_errors', '1');

$config = new \Phalcon\Config(require_once APP_ROOT . '/app/config/config.php');
$di = new \Phalcon\Di\FactoryDefault();
$app = new \Vegas\Mvc\Application($di, $config);
$app->setApplicationDirectory(APP_ROOT);
$app->setDefaultModule($config->application->defaultModule);

$app->handle();