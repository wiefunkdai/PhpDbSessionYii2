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
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'enableStrictParsing' => false,
    'rules' => [
        '<action:\w+>' => 'site/<action>',
        '<controller:\w+>/add' => '<controller>/create',
        '<controller:\w+>/edit/<id:\d+>' => '<controller>/update',
        '<controller:\w+>/clear/<id:\d+>' => '<controller>/remove',
        '<controller:\w+>/print/<id:\d+>' => '<controller>/export',
        '<controller:\w+>/edit' => '<controller>/update',
        '<controller:\w+>/clear' => '<controller>/remove',
        '<controller:\w+>/print' => '<controller>/export',
        '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
        '<controller:\w+>/<action:\w+>' => '<controller>/<action>'
    ]
];