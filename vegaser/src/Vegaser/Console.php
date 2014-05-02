<?php
/**
 * This file is part of Vegas package
 *
 * @author Slawomir Zytko <slawomir.zytko@gmail.com>
 * @copyright Amsterdam Standard Sp. Z o.o.
 * @homepage https://github.com/vegas-cmf/vegaser
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vegaser;

/**
 * Class Console
 * @package Vegaser
 */
class Console
{
    /**
     * Array of arguments for command
     *
     * @var array
     */
    protected $arguments;

    /**
     * @param $arguments
     */
    public function __construct($arguments)
    {
        $this->parseArguments($arguments);
    }

    /**
     * Parses command arguments
     *
     * @param $arguments
     */
    private function parseArguments($arguments)
    {
        //2nd argument is a name of command
        $this->arguments['name'] = $arguments[0];
        if (count($this->arguments) > 1) {
            $this->arguments['args'] = array_slice($arguments, 1);
        } else {
            $this->arguments['args'] = array();
        }
    }

    /**
     * Handles commands
     */
    public function handle()
    {
        $command = $this->resolveCommandName($this->arguments['name']);
        $command->run($this->arguments['args']);
    }

    /**
     * Checks command existing, if yes returns new instance of command, otherwise throws exception
     *
     * @param $commandName
     * @return object
     */
    private function resolveCommandName($commandName)
    {
        $commandClassName = ucfirst($this->camelize(str_replace('-', '_', $commandName)));
        $namespace = 'Vegaser\\Command\\' . $commandClassName;
        try {
            $reflectionClass = new \ReflectionClass($namespace);
            return $reflectionClass->newInstance();
        } catch (\ReflectionException $ex) {
            trigger_error(sprintf("Invalid command: %s", $commandName));
        }
    }

    /**
     * Convert command name to class name
     *
     * @param $str
     * @return string
     */
    private function camelize($str)
    {
        return lcfirst(implode('', array_map( 'ucfirst', array_map( 'strtolower', explode('_', $str)))));
    }
}
 