<?php
use Vegas\Tests\Mvc\Router\TestAfterPlugin;
use Vegas\Tests\Mvc\Router\TestPlugin;
/** @var \Vegas\Mvc\Router $router */

/**
$router->add('/test', [
    'module' => '%%module_name%%',
    'controller' => 'Frontend\Index',
    'action' => 'index'
]);

$router->add('/dashboard', [
    'module' => '%%module_name%%',
    'controller' => 'Backend\Dashboard',
    'action' => 'index'
])->pushFilter(new \App\Filter\AuthorizationFilter);

*/
