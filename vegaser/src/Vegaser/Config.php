<?php
/**
 * This file is part of Vegas package
 *
 * @author Mateusz Aniolek <mateusz.aniolek@amsterdam-standard.pl>
 * @copyright Amsterdam Standard Sp. Z o.o.
 * @homepage https://github.com/vegas-cmf/vegaser
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vegaser;


class Config
{
    protected static $config = [];

    protected static $output;

    public static function set($key, $value)
    {
        self::$config[$key] = $value;
    }

    public static function get()
    {
        return self::$config;
    }

    public static function setOutput($value)
    {
        self::$output = $value;
    }

    public static function getOutput()
    {
        return self::$output;
    }



}