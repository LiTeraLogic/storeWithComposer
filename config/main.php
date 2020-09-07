<?php
return [
    'title' => 'Мой магазин',
    'defaultControllerName' => 'good',
    'components' => [
        'db' => [
            'class' => \App\services\DB::class,
            'config' => [
                'driver' => 'mysql',
                'host' => 'localhost',
                'dbname' => 'shop',
                'charset' => 'UTF8',
                'username' => 'root',
                'password' => '',
                'port' => '3307',
            ]
        ],
        'twigRenderer' => [
            'class' => \App\services\renderers\TwigRenderer::class
        ],
        'request' => [
            'class' => \App\services\Request::class
        ],
        'GoodRepository' => [
            'class' => \App\repositories\GoodRepository::class
        ],
        'UserRepository' => [
            'class' => \App\repositories\UserRepository::class
        ],
        'OrderRepository' => [
            'class' => \App\repositories\OrderRepository::class
        ],
        'basketServices' => [
            'class' => \App\services\BasketServices::class
        ],
    ]
];
