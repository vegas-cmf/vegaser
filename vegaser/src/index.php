<?php
/**
 * @author Sławomir Żytko <slawek@amsterdam-standard.pl>
 * @copyright (c) 2014, Amsterdam Standard
 */

require_once "phar://vegaser.phar" . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";

spl_autoload_register(function ($name) {
    require_once 'phar://vegaser.phar' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . str_replace('\\',DIRECTORY_SEPARATOR,$name) . '.php';
});

require_once "phar://vegaser.phar" . DIRECTORY_SEPARATOR . "src" . DIRECTORY_SEPARATOR . "common.php";

AppManager::run($argv);