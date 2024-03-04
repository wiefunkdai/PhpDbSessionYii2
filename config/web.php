<?php
/**
 * SDaiLover PHP Web Packages
 *
 * @author    : Stephanus Bagus Saputra,
 *              ( 戴 Dai 偉 Wie 峯 Funk )
 * @email     : wiefunk@stephanusdai.web.id
 * @contact   : https://t.me/wiefunkdai
 * @support   : https://opencollective.com/wiefunkdai
 * @link      : https://www.sdailover.com,
 *              https://www.stephanusdai.web.id
 * @license   : https://www.sdailover.com/license.html
 * @copyright : (c) ID 2023-2024 SDaiLover. All rights reserved.
 * This software using Yii Framework has released under the terms of the BSD License.
 */

return [
    'id' => 'sdailover-phpdbsessionyii-application',
    'name' => 'SDaiLover PhpDbSession Yii Framework',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'sdailover\controllers',
    'defaultRoute' => 'site/dashboard',
    'bootstrap' => ['log'],
    'aliases' => require(__DIR__ . '/aliases.php'),
    'controllerMap' => require(__DIR__ . '/controllers.php'),
    'components' => [
        'assetManager' => require(__DIR__ . '/assets.php'),
        'request' => [
            'csrfParam' => '_csrf-sdailover',
            'cookieValidationKey' => '3022460817d5b55b55fe891ea5149ee9'
        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource'
                ]
            ]
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache'
        ],
        'user' => [
            'identityClass' => 'sdailover\models\SDUser',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-sdailover', 'httpOnly' => true]
        ],
        'session' => [
            'name' => '_session-sdailover'
        ],
        'errorHandler' => [
            'errorAction' => YII_DEBUG ? null : 'site/error'
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning']
                ]
            ]
        ],
        'db' => require(__DIR__ . '/db.php'),
        'urlManager' => require(__DIR__ . '/route.php')
    ],
    'params' => require(__DIR__ . '/params.php')
];