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
    'aliases' => [
        '@sdailoverasset' => null,
        '@app' => dirname(__DIR__),
        '@vendor' => SDAILOVER_VENDORPATH,
        '@sdailover' => '@app',
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset'
    ],
    'controllerMap' => require(__DIR__ . '/controllers.php'),
    'components' => [
        'request' => [
            'class' => 'sdailover\components\SDRequest'
        ],
        'assetManager' => [
            'appendTimestamp' => false,
            'linkAssets' => false,
            'dirMode' => 0777,
            'bundles' => [
                'sdailover\yii\widgets\SDaiLoverAsset' => [
                    'sourcePath' => null,
                    'basePath' => '@webroot',
                    'baseUrl' => '@web',
                    'css' => [
                        'bundles/sdailover/css/sdailover.css'
                    ],
                    'js'=>[
                        'bundles/sdailover/js/sdailover.js'
                    ]              
                ],
                'sdailover\yii\widgets\tab\SDTabWindowAsset' => [
                    'sourcePath' => null,
                    'basePath' => '@webroot',
                    'baseUrl' => '@web',
                    'css' => [],
                    'js'=>[
                        'bundles/sdailover/js/sdailover.tabWindow.js'
                    ]                    
                ],
                'yii\web\YiiAsset' => [
                    'sourcePath' => null,
                    'basePath' => '@webroot',
                    'baseUrl' => '@web',
                    'css' => [],
                    'js'=>[
                        'bundles/yii/yii.js'
                    ]
                ],
                'yii\validators\ValidationAsset' => [
                    'sourcePath' => null,
                    'basePath' => '@webroot',
                    'baseUrl' => '@web',
                    'css' => [],
                    'js'=>[
                        'bundles/yii/yii.validation.js'
                    ]
                ],
                'yii\captcha\CaptchaAsset' => [
                    'sourcePath' => null,
                    'basePath' => '@webroot',
                    'baseUrl' => '@web',
                    'css' => [],
                    'js'=>[
                        'bundles/yii/yii.captcha.js'
                    ]
                ],
                'yii\widgets\ActiveFormAsset' => [
                    'sourcePath' => null,
                    'basePath' => '@webroot',
                    'baseUrl' => '@web',
                    'css' => [],
                    'js'=>[
                        'bundles/yii/yii.activeForm.js'
                    ]
                ],
                'yii\grid\GridViewAsset' => [
                    'sourcePath' => null,
                    'basePath' => '@webroot',
                    'baseUrl' => '@web',
                    'css' => [],
                    'js'=>[
                        'bundles/yii/yii.gridView.js'
                    ]
                ],
                'yii\validators\PunycodeAsset' => [
                    'sourcePath' => null,
                    'basePath' => '@webroot',
                    'baseUrl' => '@web',
                    'css' => [],
                    'js'=>[
                        'bundles/punycode/punycode.js'
                    ]
                ],
                'yii\validators\PjaxAsset' => [
                    'sourcePath' => null,
                    'basePath' => '@webroot',
                    'baseUrl' => '@web',
                    'css' => [],
                    'js'=>[
                        'bundles/yii2-pjax/jquery.pjax.js'
                    ]
                ],
                'yii\widgets\MaskedInputAsset' => [
                    'sourcePath' => null,
                    'basePath' => '@webroot',
                    'baseUrl' => '@web',
                    'css' => [],
                    'js'=>[
                        'bundles/inputmask/dist/jquery.inputmask.bundle.js'
                    ]
                ],
                'yii\web\JqueryAsset' => [
                    'sourcePath' => null,
                    'basePath' => '@webroot',
                    'baseUrl' => '@web',
                    'css' => [],
                    'js'=>[
                        'bundles/jquery/dist/jquery.js'
                    ]
                ],
                'yii\bootstrap5\BootstrapAsset' => [
                    'sourcePath' => null,
                    'basePath' => '@webroot',
                    'baseUrl' => '@web',
                    'css' => [
                        'bundles/bootstrap/dist/css/bootstrap.css'
                    ],
                    'js'=>[]
                ],
                'yii\bootstrap5\BootstrapIconAsset' => [
                    'sourcePath' => null,
                    'basePath' => '@webroot',
                    'baseUrl' => '@web',
                    'css' => [
                        'bundles/bootstrap-icons/font/bootstrap-icons.css'
                    ],
                    'js'=>[]
                ],
                'yii\bootstrap5\BootstrapPluginAsset' => [
                    'sourcePath' => null,
                    'basePath' => '@webroot',
                    'baseUrl' => '@web',
                    'css' => [],
                    'js' => [
                        'bundles/bootstrap/dist/js/bootstrap.bundle.js'
                    ]
                ]
            ]
        ],
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