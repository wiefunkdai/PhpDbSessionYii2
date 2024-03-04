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

namespace sdailover\models;
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

use sdailover\yii\phpsessconnector\SDActiveRecord;
use sdailover\yii\phpsessconnector\SDUniqueValidator;
use sdailover\components\SDPasswordValidator;

/**
 * SDaiLover User Model
 * 
 * @author    : Stephanus Bagus Saputra,
 *              ( 戴 Dai 偉 Wie 峯 Funk )
 * @email     : wiefunk@stephanusdai.web.id
 * @contact   : https://t.me/wiefunkdai
 * @support   : https://opencollective.com/wiefunkdai
 * @link      : https://www.stephanusdai.web.id
 */
class SDUser extends SDActiveRecord implements \yii\web\IdentityInterface
{
	const STATUS_SUSPEND = 0;
	const STATUS_ACTIVED = 1;

    public $id;
    public $email;
    public $fullname;
    public $username;
    public $password;
    public $newpassword;
    public $authKey;
    public $accessToken;
    public $createdate;
    public $status;

    private static $users = [
        [
            'id' => '100',
            'fullname' => 'Demo User',
            'email' => 'demo@localhost.com',
            'username' => 'demo',
            'password' => 'demo',
            'authKey' => 'demo100',
            'accessToken' => '100-token',
            'createdate' => '2020-12-01',
            'status' => '1'
        ],
        [
            'id' => '101',
            'fullname' => 'Administrator',
            'email' => 'admin@localhost.com',
            'username' => 'admin',
            'password' => 'admin',
            'authKey' => 'admin101',
            'accessToken' => '101-token',
            'createdate' => '2020-12-27',
            'status' => '0'
        ]
    ];
    
    public static function tableName()
    {
        return '{{user}}';
    }

    public static function loadTable()
    {
        parent::records(static::$users);
    }
    
    public function rules()
    {
        return [
            [['id'], 'integer'],  
            [['username', 'email', 'status'], 'required'],
            ['username', 'string'],
            ['password', 'string'],
            [['id','username', 'email'], SDUniqueValidator::class],
            ['newpassword', SDPasswordValidator::class, 'copyAttributeTo'=>'password', 'mixedCase'=>true, 'skipOnEmpty'=>false], 
            ['email', 'email'],     
            [['id','fullname', 'authKey', 'accessToken', 'password', 'createdate'], 'safe'],
            [['status'], 'in', 'range' => [0, 1]]
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'newpassword' => 'Password'
        ];
    }

    public static function findIdentity($id)
    {
        return static::findOne(['id'=>$id]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['accessToken'=>$token]);
    }

    public static function findByUsername($username)
    {
        return static::findOne(['username'=>$username]);
    }

    public function getId()
    {
        return $this->id;
    }
    
    public function getAuthKey()
    {
        return $this->authKey;
    }

    public function getStatus()
    {
        return $this->status;
    }
    
    public function validateAuthKey($authKey)
    {
        return $this->authKey == $authKey;
    }

    public function validatePassword($password)
    {
        return $this->password == $password;
    }

    public function validateStatus()
    {
        return $this->status == SDUser::STATUS_ACTIVED;
    }
}
