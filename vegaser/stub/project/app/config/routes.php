<?php

/** @var \Vegas\Mvc\Router $router */
$router->notFound([
    'module' => 'Home',
    'controller' => 'Error',
    'action' => 'notfound'
]);

$router->setDefaultAction('notfound');
$router->setDefaultController('Error');
$router->setDefaultModule('Home');