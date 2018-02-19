<?php
return [
    'settings' => [
        // Slim Settings
        'determineRouteBeforeAppMiddleware' => false,
        'displayErrorDetails' => true,

        // View settings
        'view' => [
            'template_path' => array(
                               __DIR__ . '/templates/admin-cms/default',
                               __DIR__ . '/templates/admin-cms/partials',
                               __DIR__ . '/templates/admin-cms/partials/head',
                               __DIR__ . '/templates/admin-cms/partials/script'),
            'twig' => [
                'cache' => __DIR__ . '/../cache/twig',
                'debug' => true,
                'auto_reload' => true,
            ],
        ],

        // monolog settings
        'logger' => [
            'name' => 'app',
            'path' => __DIR__ . '/../log/app.log',
        ],
        'doctrine' => [
            'meta' => [
                'entity_path' => ['app/src/Entities/'],
                'auto_generate_proxies' => true,
                'proxy_dir' =>  __DIR__.'/../cache/proxies',
                'cache' => null,
            ],
            'connection' => [
                'driver'   => 'pdo_mysql',
                'host'     => 'localhost',
                'dbname'   => 'db-cms',
                'user'     => 'root',
                'password' => 'root',
                'charset'  => 'utf8',
                'driverOptions' => array(
                    1002 => 'SET NAMES utf8'
                )
            ]
        ]
    ],
];
