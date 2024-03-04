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

define('YII_DEBUG', true);
define('YII_ENV', 'dev');
define('SDAILOVER_VENDORPATH', __DIR__ . '/vendor');
define('SDAILOVER_YIIPATH', SDAILOVER_VENDORPATH . '/yiisoft');
define('SDAILOVER_PATH', __DIR__);

require SDAILOVER_PATH . '/SDaiLover.php';

$config = require SDAILOVER_PATH . '/config/vercel.php';
SDaiLover::createVercelApplication($config)->run();