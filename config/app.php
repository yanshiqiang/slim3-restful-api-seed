<?php

return [
    'app' => [
        'name' => env('APP_NAME', 'mySlimApp'),
        'domain' => env('APP_DOMAIN', 'http://localhost:8000'),
        'directories' => [
            'command' => [
                'classDir' => ROOT . 'app/Command/',
                'classNamespace' => 'App\\Command',
                'classPrefix' => 'Command',
                'classTemplate' => ROOT . 'templates/command.txt'
            ],
            'controller' => [
                'classDir' => ROOT . 'app/Controller/',
                'classNamespace' => 'App\\Controller',
                'classPrefix' => 'Controller',
                'classTemplate' => ROOT . 'templates/controller.txt'
            ],
            'middleware' => [
                'classDir' => ROOT . 'app/Middleware/',
                'classNamespace' => 'App\\Middleware',
                'classPrefix' => 'Middleware',
                'classTemplate' => ROOT . 'templates/middleware.txt'
            ],
            'model' => [
                'classDir' => ROOT . 'app/Model/',
                'classNamespace' => 'App\\Model',
                'classPrefix' => 'Model',
                'classTemplate' => ROOT . 'templates/model.txt'
            ],
            'presenter' => [
                'classDir' => ROOT . 'app/Presenter/',
                'classNamespace' => 'App\\Presenter',
                'classPrefix' => 'Presenter',
                'classTemplate' => ROOT . 'templates/presenter.txt'
            ]
        ]
    ]
];
