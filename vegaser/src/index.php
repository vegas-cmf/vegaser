<?php
/**
 * @author Sławomir Żytko <slawek@amsterdam-standard.pl>
 * @copyright (c) 2014, Amsterdam Standard
 */

require_once "phar://vegaser.phar/common.php";

function __autoload($name) {
    require_once 'phar://vegaser.phar/src/' . str_replace('\\',DIRECTORY_SEPARATOR,$name) . '.php';
}

AppManager::run($argv);