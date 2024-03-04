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

namespace sdailover\assets;

/**
 * SDaiLover App Asset
 */
class SDAppAsset extends \yii\web\AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'themes/css/main.css',
        ['themes/css/print.css', 'media' => 'print']
    ];

    public $js = [
        'themes/vendors/popperjs/dist/umd/popper.js',
        'themes/vendors/fontawesome/js/all.min.js'
    ];

    public $depends = [
        'sdailover\yii\widgets\SDaiLoverAsset',
        'yii\web\YiiAsset',
        'yii\web\JqueryAsset',
        'yii\bootstrap5\BootstrapAsset',
        'yii\bootstrap5\BootstrapIconAsset',
        'yii\bootstrap5\BootstrapPluginAsset'
    ];
}