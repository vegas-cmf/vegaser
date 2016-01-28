<?php
return [

    'application' => [
        'defaultModule' => 'Home',
        'environment' => \Vegas\Env::DEVELOPMENT,
        'locale' => '%%project_locale%%',
        'modules' => [
            'Home',
            'Auth',
        ],
        'mongo' => [
            'db' => 'vegas_demo'
        ],
        'mysql' => [
            'db' => ''
        ],
        'autoload' => [
            'App\Initializer' => APP_ROOT . '/app/initializers',
            'App\Shared' => APP_ROOT . '/app/shared',
            'App\Service' => APP_ROOT . '/app/services',
            'App\Filter' => APP_ROOT . '/app/filters',
            'App\View' => APP_ROOT . '/app/view'
        ],
        'modulesDirectory' => 'app/modules',
        'sharedServices' => [
            'App\Shared\Session',
            'App\Shared\Dao',
            'App\Shared\Mongo',
            'App\Shared\CollectionManager',
            'App\Shared\Authorization',
            'App\Shared\FlashSession'
        ],
        'initializers'=> [
            'App\Initializer\Volt'
        ],
        'view' => [
            'cacheDir' => APP_ROOT . '/cache/',
            'viewsDir' => APP_ROOT . '/app',
            'layout' => 'main',
            'layoutsDir' => 'layouts/',
            'engines' => [
                'volt' => [
                    'compiledPath' => APP_ROOT . '/cache/',
                    'compiledSeparator' => '_',
                    'compileAlways' => true
                ]
            ]
        ]
    ]
];