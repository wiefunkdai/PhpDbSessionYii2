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
   'class' => 'sdailover\yii\phpsessconnector\SDConnection',
   'dsn' => 'phpsessconnector:sdailover',
   'tablePrefix' => 'sd_',

   /**
    * OR use can syntax normal database configuration:
    * 
    * 'class' => 'sdailover\yii\phpsessconnector\SDConnection',
    *  'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    * 'username' => 'root',
    * 'password' => '',
    * 'charset' => 'utf8',
    */


   // Schema cache options (for production environment)
   //'enableSchemaCache' => true,
   //'schemaCacheDuration' => 60,
   //'schemaCache' => 'cache'
 ];