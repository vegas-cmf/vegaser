    <?php
/**
 * @author Sławomir Żytko <slawek@amsterdam-standard.pl>
 * @copyright (c) 2014, Amsterdam Standard
 */

require_once "phar://vegaser.phar" . DIRECTORY_SEPARATOR . "common.php";

function __autoload($name) {
    require_once 'phar://vegaser.phar' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . str_replace('\\',DIRECTORY_SEPARATOR,$name) . '.php';
}

AppManager::run($argv);