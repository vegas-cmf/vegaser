<?php
error_reporting(E_ALL);
//Test Suite bootstrap
include __DIR__ . "/../vendor/autoload.php";

use Phalcon\Loader;

define('TESTS_ROOT_DIR', dirname(__FILE__));
define('APP_ROOT', dirname(__FILE__) . '/fixtures');

//$configArray = require_once TESTS_ROOT_DIR . '/config.php';

$_SERVER['HTTP_HOST'] = 'vegas.dev';
$_SERVER['REQUEST_URI'] = '/';