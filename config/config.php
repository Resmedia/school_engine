<?php

use app\engine\Cookies;
use app\engine\Request;
use app\engine\Session;
use app\models\repositories\BasketRepository;
use app\models\repositories\GoodsRepository;
use app\models\repositories\OrderRepository;
use app\models\repositories\ProductRepository;
use app\models\repositories\UserRepository;
use app\engine\Db;

return [
    'root_dir' => __DIR__ . "/../",
    'templates_dir' => __DIR__ . "/../views/",
    'controllers_namespaces' => 'app\controllers\\',
    'components' => [
        'db' => [
            'class' => Db::class,
            'driver' => 'mysql',
            'host' => 'localhost',
            'login' => 'root',
            'password' => 'root',
            'database' => 'shop',
            'charset' => 'utf8'
        ],
        'request' => [
            'class' => Request::class
        ],
        'cookies' => [
            'class' => Cookies::class
        ],
        'session' => [
            'class' => Session::class
        ],
        'orderRepository' => [
            'class' => OrderRepository::class
        ],
        'basketRepository' => [
            'class' => BasketRepository::class
        ],
        'goodsRepository' => [
            'class' => GoodsRepository::class
        ],
        'productRepository' => [
            'class' => ProductRepository::class
        ],
        'userRepository' => [
            'class' => UserRepository::class
        ]

    ]
];