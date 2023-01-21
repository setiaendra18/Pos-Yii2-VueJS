<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'name' => 'CAMILES MANAJEMEN SISTEM',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'qmaBYjvbEw6VsY2dpZlWBFEa0yIwMrSu',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => false,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,

        'urlManager' => [
            'enablePrettyUrl' => false,
            'enableStrictParsing' => false,
            'showScriptName' => false,
            'rules' => [
                ['class' => 'yii\rest\UrlRule', 'controller' => 'menu', 'pluralize' => false],
                'PUT,PATCH menu/<id:[a-zA-Z0-9-]+>' => 'menu/update',
                'DELETE menu/<id:[a-zA-Z0-9-]+>' => 'menu/delete',
                'GET,HEAD menu/<id:[a-zA-Z0-9-]+>' => 'menu/view',
                'POST menu' => 'menu/create',
                'GET,HEAD menu' => 'menu/index',
                'menu/<id:[a-zA-Z0-9-]+>' => 'menu/options',
                'menu' => 'menu/options',

                //KATEGORI MENU URL RULE//
                ['class' => 'yii\rest\UrlRule', 'controller' => 'kategori-menu', 'pluralize' => false],
                'PUT,PATCH kategori-menu/<id:[a-zA-Z0-9-]+>' => 'kategori-menu/update',
                'DELETE kategori-menu/<id:[a-zA-Z0-9-]+>' => 'kategori-menu/delete',
                'GET,HEAD kategori-menu/<id:[a-zA-Z0-9-]+>' => 'kategori-menu/view',
                'POST kategori-menu' => 'kategori-menu/create',
                'GET,HEAD kategori-menu' => 'kategori-menu/index',
                'kategori-menu/<id:[a-zA-Z0-9-]+>' => 'kategori-menu/options',
                'kategori-menu' => 'kategori-menu/options',

                ['class' => 'yii\rest\UrlRule', 'controller' => 'kategori-pesan', 'pluralize' => false],
                'PUT,PATCH kategori-pesan/<id:[a-zA-Z0-9-]+>' => 'kategori-pesan/update',
                'DELETE kategori-pesan/<id:[a-zA-Z0-9-]+>' => 'kategori-pesan/delete',
                'GET,HEAD kategori-pesan/<id:[a-zA-Z0-9-]+>' => 'kategori-pesan/view',
                'POST kategori-pesan' => 'kategori-pesan/create',
                'GET,HEAD kategori-pesan' => 'kategori-pesan/index',
                'kategori-pesan/<id:[a-zA-Z0-9-]+>' => 'kategori-pesan/options',
                'kategori-pesan' => 'kategori-pesan/options',

                ['class' => 'yii\rest\UrlRule', 'controller' => 'meja', 'pluralize' => false],
                'PUT,PATCH meja/<id:[a-zA-Z0-9-]+>' => 'meja/update',
                'DELETE meja/<id:[a-zA-Z0-9-]+>' => 'meja/delete',
                'GET,HEAD meja/<id:[a-zA-Z0-9-]+>' => 'meja/view',
                'POST meja' => 'meja/create',
                'GET,HEAD meja' => 'meja/index',
                'meja/<id:[a-zA-Z0-9-]+>' => 'meja/options',
                'meja' => 'meja/options',

                ['class' => 'yii\rest\UrlRule', 'controller' => 'pembayaran', 'pluralize' => false],
                'PUT,PATCH pembayaran/<id:[a-zA-Z0-9-]+>' => 'pembayaran/update',
                'DELETE pembayaran/<id:[a-zA-Z0-9-]+>' => 'pembayaran/delete',
                'GET,HEAD pembayaran/<id:[a-zA-Z0-9-]+>' => 'pembayaran/view',
                'POST pembayaran' => 'pembayaran/create',
                'GET,HEAD pembayaran' => 'pembayaran/index',
                'pembayaran/<id:[a-zA-Z0-9-]+>' => 'pembayaran/options',
                'pembayaran' => 'pembayaran/options',

                ['class' => 'yii\rest\UrlRule', 'controller' => 'pesanan', 'pluralize' => false],
                'PUT,PATCH pesanan/<id:[a-zA-Z0-9-]+>' => 'pesanan/update',
                'DELETE pesanan/<id:[a-zA-Z0-9-]+>' => 'pesanan/delete',
                'GET,HEAD pesanan/<id:[a-zA-Z0-9-]+>' => 'pesanan/view',
                'POST pesanan' => 'pesanan/create',
                'GET,HEAD pesanan' => 'pesanan/index',
                'pesanan/<id:[a-zA-Z0-9-]+>' => 'pesanan/options',
                'pesanan' => 'pesanan/options',
                
                ['class' => 'yii\rest\UrlRule', 'controller' => 'pesanan-detail', 'pluralize' => false],
                'PUT,PATCH pesanan-detail/<id:[a-zA-Z0-9-]+>' => 'pesanan-detail/update',
                'DELETE pesanan-detail/<id:[a-zA-Z0-9-]+>' => 'pesanan-detail/delete',
                'GET,HEAD pesanan-detail/<id:[a-zA-Z0-9-]+>' => 'pesanan-detail/view',
                'POST pesanan-detail' => 'pesanan-detail/create',
                'GET,HEAD pesanan-detail' => 'pesanan-detail/index',
                'pesanan-detail/<id:[a-zA-Z0-9-]+>' => 'pesanan-detail/options',
                'pesanan-detail' => 'pesanan-detail/options',

                ['class' => 'yii\rest\UrlRule', 'controller' => 'user-akun', 'pluralize' => false],
                'PUT,PATCH user-akun/<id:[a-zA-Z0-9-]+>' => 'user-akun/update',
                'DELETE user-akun/<id:[a-zA-Z0-9-]+>' => 'user-akun/delete',
                'GET,HEAD user-akun/<id:[a-zA-Z0-9-]+>' => 'user-akun/view',
                'POST user-akun' => 'user-akun/create',
                'GET,HEAD user-akun' => 'user-akun/index',
                'user-akun/<id:[a-zA-Z0-9-]+>' => 'user-akun/options',
                'user-akun' => 'user-akun/options',

            ],

        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
