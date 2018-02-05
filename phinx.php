<?php

require_once 'bootstrap/app.php';

$database = $container->config->get('database');

return [
    'paths' => [
        'migrations' => 'app/Migration'
    ],
    'environments' => [
        'default' => [
            'adapter' => $database['driver'],
            'host' => $database['host'],
            'port' => $database['port'],
            'name' => $database['database'],
            'user' => $database['username'],
            'pass' => $database['password']
        ],
        'default_migration_table' => 'migrations'
    ],
    'migration_base_class' => 'App\Base\Migration',
    'templates' => [
        'file' => 'templates/migration.txt'
    ]
];
