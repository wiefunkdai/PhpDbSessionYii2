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

namespace sdailover\components;
/**
 * Copyright (c) ID 2023-2024 SDaiLover (https://www.sdailover.com).
 * All rights reserved.
 *
 * Licensed under the Clause BSD License, Version 3.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.sdailover.com/license.html
 *
 * This software is provided by the SDAILOVER and
 * CONTRIBUTORS "AS IS" and Any Express or IMPLIED WARRANTIES, INCLUDING,
 * BUT NOT LIMITED TO, the implied warranties of merchantability and
 * fitness for a particular purpose are disclaimed in no event shall the
 * SDaiLover or Contributors be liable for any direct,
 * indirect, incidental, special, exemplary, or consequential damages
 * arising in anyway out of the use of this software, even if advised
 * of the possibility of such damage.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

use SDaiLover;
use yii\web\AssetManager;
use yii\helpers\FileHelper;
use yii\base\InvalidConfigException;

/**
 * SDaiLover Asset Manager Component
 * 
 * @author    : Stephanus Bagus Saputra,
 *              ( 戴 Dai 偉 Wie 峯 Funk )
 * @email     : wiefunk@stephanusdai.web.id
 * @contact   : https://t.me/wiefunkdai
 * @support   : https://opencollective.com/wiefunkdai
 * @link      : https://www.stephanusdai.web.id
 */
class SDAssetManager extends AssetManager
{
    public $dirMode = 0775;

    private $_published = [];
    private $_isBasePathPermissionChecked;

    public function checkBasePathPermission()
    {
        // if the check is been done already, skip further checks
        if ($this->_isBasePathPermissionChecked) {
            return;
        }

        if ($this->basePath===null || rtrim($this->basePath, "\/")==='' || empty($this->basePath)) {
            $this->basePath = dirname(__DIR__).'/web/assets/';
        }
        if (is_dir($this->basePath)) {
            @chmod($this->basePath, $this->dirMode);
        }

        if (!is_dir($this->basePath)) {
            @mkdir(rtrim($this->basePath, "\/"), $this->dirMode, true);
            @chmod($this->basePath, $this->dirMode);
        }

        if (!is_writable($this->basePath)) {
            @chmod($this->basePath, $this->dirMode);
        }

        $this->_isBasePathPermissionChecked = true;
    }

    public function publish($path, $options = [])
    {
        $path = SDaiLover::getAlias($path);

        if (isset($this->_published[$path])) {
            return $this->_published[$path];
        }

        if (is_file($path)) {
            return $this->_published[$path] = $this->publishFile($path);
        }

        return $this->_published[$path] = $this->publishDirectory($path, $options);
    }
    
    protected function publishFile($src)
    {
        $this->checkBasePathPermission();

        $dir = $this->hash($src);
        $fileName = basename($src);
        $dstDir = $this->basePath . DIRECTORY_SEPARATOR . $dir;
        $dstFile = $dstDir . DIRECTORY_SEPARATOR . $fileName;

        if (!is_dir($dstDir)) {
            @mkdir($dstDir, $this->dirMode, true);
            @chmod($dstDir, $this->dirMode);
        }

        if ($this->linkAssets) {
            if (!is_file($dstFile)) {
                @symlink($src, $dstFile);
            }
        } elseif (@filemtime($dstFile) < @filemtime($src)) {
            @copy($src, $dstFile);
            if ($this->fileMode !== null) {
                @chmod($dstFile, $this->fileMode);
            }
        }

        if ($this->appendTimestamp && ($timestamp = @filemtime($dstFile)) > 0) {
            $fileName = $fileName . "?v=$timestamp";
        }

        return [$dstFile, $this->baseUrl . "/$dir/$fileName"];
    }
}