<?php
return [
    'application' => [
        'locale' => '%%project_locale%%',
        'defaultModule' => 'Home',
        'environment' => \Vegas\Env::DEVELOPMENT,
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
            'App\View' => APP_ROOT . '/app/view'
        ],
        'modulesDirectory' => 'app/modules',
        'sharedServices' => [
            'App\Shared\ViewCache',
            'App\Shared\Dao',
            '%%project_database_service%%'
        ],
        'initializers'=> [
            '%%project_template_initializer%%'
        ],
        'view' => [
            'cacheDir' => APP_ROOT . '/app/cache/view/',
            'viewsDir' => APP_ROOT . '/app',
            'layout' => 'main',
            'layoutsDir' => 'layouts/',
            'engines' => [
                'volt' => [
                    'compiledPath' => APP_ROOT . '/app/cache/view/compiled/',
                    'compiledSeparator' => '_',
                    'compileAlways' => false
                ]
            ]
        ]
    ]
];