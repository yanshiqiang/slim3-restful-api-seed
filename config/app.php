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
                'classTemplate' => ROOT . 'resource/templates/command.txt'
            ],
            'controller' => [
                'classDir' => ROOT . 'app/Controller/',
                'classNamespace' => 'App\\Controller',
                'classPrefix' => 'Controller',
                'classTemplate' => ROOT . 'resource/templates/controller.txt'
            ],
            'middleware' => [
                'classDir' => ROOT . 'app/Middleware/',
                'classNamespace' => 'App\\Middleware',
                'classPrefix' => 'Middleware',
                'classTemplate' => ROOT . 'resource/templates/middleware.txt'
            ],
            'model' => [
                'classDir' => ROOT . 'app/Model/',
                'classNamespace' => 'App\\Model',
                'classPrefix' => 'Model',
                'classTemplate' => ROOT . 'resource/templates/model.txt'
            ],
            'presenter' => [
                'classDir' => ROOT . 'app/Presenter/',
                'classNamespace' => 'App\\Presenter',
                'classPrefix' => 'Presenter',
                'classTemplate' => ROOT . 'resource/templates/presenter.txt'
            ]
        ]
    ]
];
