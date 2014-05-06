<?php
/**
 * @author Sławomir Żytko <slawek@amsterdam-standard.pl>
 * @copyright (c) 2014, Amsterdam Standard
 */

require_once 'PEAR/Registry.php';

/**
 * Class AppManager
 */
class AppManager
{
    private static $intro = <<<TEXT
##   ## ####### #####   #####   #####  ####### ######
##   ## ##     ##   ## ##   ## ##   ## ##      ##   ##
##   ## ##     ##      ##   ## ##      ##      ##   ##
##   ## #####  ## ###  #######  #####  #####   ######
 ## ##  ##     ##   ## ##   ##      ## ##      ##   ##
 ## ##  ##     ##   ## ##   ## ##   ## ##      ##   ##
  ###   ####### #####  ##   ##  #####  ####### ##   ##

Vegaser version 0.1 (Build 2014-04-30)
TEXT;

    private static $help = <<<TEXT
Usage:
    command [arguments]

Available commands:
    build-project       Create new project using default Vegas structure
    build-library       Create structure for Vegas library
    help                Display help for a command

TEXT;

    /**
     * Handle commands
     *
     * @param $arguments
     */
    public static function run($arguments) {
        self::checkExtensions();

        if (count($arguments) == 1) {
            self::displayHelp();
        } else {
            $console = new \Vegaser\Console(array_slice($arguments, 1));
            $console->handle();
        }
    }

    /**
     * Display console help
     */
    private static function displayHelp()
    {
        echo str_repeat(PHP_EOL, 2);
        echo self::$intro;
        echo str_repeat(PHP_EOL, 2);
        echo self::$help;
        echo str_repeat(PHP_EOL, 2);
    }

    /**
     * Checks if required tools are installed
     */
    private static function checkExtensions()
    {
        if (!extension_loaded('phalcon')) {
            print (
                'Extension cphalcon was not found. ' . PHP_EOL .
                'Check http://docs.phalconphp.com/en/latest/reference/install.html for more information' . PHP_EOL
            );

            exit;
        }
    }
}