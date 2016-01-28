<?php
use Vegas\Tests\Mvc\Router\TestAfterPlugin;
use Vegas\Tests\Mvc\Router\TestPlugin;
/** @var \Vegas\Mvc\Router $router */
$router->add('/', [
    'module' => 'Home',
    'controller' => 'Frontend\Index',
    'action' => 'index'
])->setName('root');

$router->add('/test', [
    'module' => 'Home',
    'controller' => 'Frontend\Index',
    'action' => 'index'
]);

$router->add('/dashboard', [
    'module' => 'Home',
    'controller' => 'Backend\Dashboard',
    'action' => 'index'
])->pushFilter(new \App\Filter\AuthorizationFilter);
