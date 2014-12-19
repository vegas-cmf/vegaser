<?php
return [
    'dashboard' => [
        'route' => '/dashboard',
        'paths' => [
            'module'    =>  'Home',
            'controller' => 'Frontend\Dashboard',
            'action' => 'index',

            'auth'  =>  'auth'
        ]
    ]
];