<?php

define('HOSTNAME', '%%config.domain%%');

return array(
    'application' => array(
        'environment'    => 'development',

        'servicesDir'   =>  APP_ROOT . '/app/services/',
        'configDir'     => dirname(__FILE__) . DIRECTORY_SEPARATOR,
        'libraryDir'     => APP_ROOT . DIRECTORY_SEPARATOR . 'lib/',
        'pluginDir'      => APP_ROOT . '/app/plugins/',
        'moduleDir'      => APP_ROOT . '/app/module/',
        'tasksDir'      => APP_ROOT . '/app/tasks/',
        'baseUri'        => '/',
        'language'       => '%%config.locale%%',
        'subModules'    =>  array(
            'frontend', 'backend', 'dashboard'
        ),
        'view'  => array(
            'cacheDir'  =>  APP_ROOT . '/cache/',
            'layout'    =>  'main',
            'layoutsDir'    =>  APP_ROOT . '/app/layouts'
        ),

        'hostname'    =>  HOSTNAME
    ),

    'mongo' => array(
        'db' => '',
        //see app/services/MongoServiceProvider.php to get more information how to setup database details
    ),

    'database' => array(
        "adapter"  => "%%config.adapter%%",
        //see app/services/DbServiceProvider.php to get more information how to setup database details
    ),

    'session' => array(
        'cookie_name'   =>  'sid',
        'cookie_lifetime'   =>  36*3600, //day and a half
        'cookie_secure' => 0,
        'cookie_httponly' => 1
    ),

    'plugins' => array(
        'security' => array(
            'class' => 'SecurityPlugin',
            'attach' => 'dispatch'
        )
    )
);