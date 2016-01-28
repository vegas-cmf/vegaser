<?php
/**
 * This file is part of Vegas package
 *
 * @author Slawomir Zytko <slawek@amsterdam-standard.pl>
 * @company Amsterdam Standard Sp. z o.o.
 * @homepage http://cmf.vegas
 */

namespace App\Filter;

use Vegas\Mvc\Router\PluginInterface;
use Vegas\Mvc\Router\Route;

class AuthorizationFilter implements PluginInterface
{
    /**
     * @param $uri
     * @return mixed
     */
    public function beforeMatch($uri, \Vegas\Mvc\Router\Route $route)
    {
        if(!$route->getDI()->get('authorization')->isAuthenticated()) {
            return $route->getDI()->get('response')->redirect('/login');
        }

        return true;
    }

    /**
     * @param $uri
     * @param Route $route
     * @return mixed
     */
    public function afterMatch($uri, \Vegas\Mvc\Router\Route $route)
    {
       return true;
    }
}