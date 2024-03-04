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

defined('SDAILOVER_VENDORPATH') or define('SDAILOVER_VENDORPATH', __DIR__ . '/vendor');
defined('SDAILOVER_YIIPATH') or define('SDAILOVER_YIIPATH', SDAILOVER_VENDORPATH . '/yiisoft');
defined('SDAILOVER_PATH') or define('SDAILOVER_PATH', __DIR__);

if (file_exists(SDAILOVER_VENDORPATH . '/autoload.php')!=false)
{
    $loader = require_once(SDAILOVER_VENDORPATH . '/autoload.php');
    $loader->register();
    $loader->setUseIncludePath(true);
}

if (file_exists(SDAILOVER_YIIPATH . '/Yii.php'))
    require SDAILOVER_YIIPATH . '/Yii.php';
else if (file_exists(SDAILOVER_YIIPATH . '/yii2/Yii.php'))
    require SDAILOVER_YIIPATH . '/yii2/Yii.php';
else
    throw new Exception('Not found Yii Framework. Please Install Framework.');


/**
 * SDaiLover base class
 * 
 * @author    : Stephanus Bagus Saputra,
 *              ( 戴 Dai 偉 Wie 峯 Funk )
 * @email     : wiefunk@stephanusdai.web.id
 * @contact   : https://t.me/wiefunkdai
 * @support   : https://opencollective.com/wiefunkdai
 * @link      : https://www.stephanusdai.web.id
 */
class SDaiLover extends Yii
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }
        
        spl_autoload_register(array('SDaiLover', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader();
        spl_autoload_unregister(array('SDaiLover', 'loadClassLoader'));
        foreach (self::$_classMaps as $namespace => $path) {
            $loader->setPsr4($namespace, $path);
        }
        return $loader;
    }

    public static function createConsoleApplication($config=null) {
        return new yii\console\Application($config);
    }

    public static function createWebApplication($config=null) {
        return new yii\web\Application($config);
    }

    public static function createVercelApplication($config=null) {
        return new SDVercelApplication($config);
    }

    public static function author() {
        return \SDaiLover::t('yii', 'Author by {author}', [
            'sdailover' => '<a href="https://www.sdailover.com/" rel="external">' . \Yii::t('yii',
                    'SDaiLover') . '</a>'
        ]);
    }

    public static function copyright() {
        return \SDaiLover::t('yii', '&copy; ID {date} {sdailover}', [
            'date' => date('Y')==='2023' ? date('Y') : '2023-' . date('Y'),
            'sdailover' => '<a href="https://www.sdailover.com/" rel="external">' . \Yii::t('yii',
                    'SDaiLover') . '</a>'
        ]);
    }
}

class SDVercelApplication extends \yii\web\Application
{
    public function coreComponents()
    {
        return array_merge(parent::coreComponents(), [
            'request' => ['class' => 'sdailover\components\SDRequest']
        ]);
    }
}

if (!class_exists('Composer\Autoload\ClassLoader')) {
    $loader = SDaiLover::getLoader();
    $loader->register();
    $loader->setUseIncludePath(true);
}