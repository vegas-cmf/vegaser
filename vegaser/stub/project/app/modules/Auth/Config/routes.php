<?php
use Vegas\Tests\Mvc\Router\TestAfterPlugin;
use Vegas\Tests\Mvc\Router\TestPlugin;
/** @var \Vegas\Mvc\Router $router */
$router->add('/login', [
    'module' => 'Auth',
    'controller' => 'Auth',
    'action' => 'login'
])->setName('login');

$router->add('/register', [
    'module' => 'Auth',
    'controller' => 'Auth',
    'action' => 'register'
])->setName('register');

$router->add('/logout', [
    'module' => 'Auth',
    'controller' => 'Auth',
    'action' => 'logout'
])->setName('logout');
