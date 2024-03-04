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
use yii\web\HttpException;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

SDaiLover::setAlias('@websdailover', '@web');
SDaiLover::setAlias('@rootsdailover', '@webroot');

/**
 * SDaiLover Controller Component
 * 
 * @author    : Stephanus Bagus Saputra,
 *              ( 戴 Dai 偉 Wie 峯 Funk )
 * @email     : wiefunk@stephanusdai.web.id
 * @contact   : https://t.me/wiefunkdai
 * @support   : https://opencollective.com/wiefunkdai
 * @link      : https://www.stephanusdai.web.id
 */
class SDController extends \yii\web\Controller
{
    public function beforeAction($action)
    {
        if (SDaiLover::$app->getRequest()->getIsAjax()) {
            $exception = SDaiLover::$app->errorHandler->exception;
            if ($exception !== null) {
                SDaiLover::$app->response->headers->set('Content-type', 'application/json');
                SDaiLover::$app->response->format = Response::FORMAT_JSON;
            }
        }
        
        return parent::beforeAction($action);
    }
    
    public function sendErrorPage($code,$message)
    {
        if (SDaiLover::$app->getRequest()->getIsAjax()) {
            SDaiLover::$app->response->headers->set('Content-type', 'application/json');
            SDaiLover::$app->response->format = Response::FORMAT_JSON;
        }
        throw new HttpException($code, $message);
    }
    
    public function behaviors()
    {
        $behaviors = [];
        if ($this->id=='site') {
            $behaviors = [
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'actions' => ['login', 'error'],
                            'allow' => true,
                        ],
                        [
                            'actions' => ['logout', 'dashboard'],
                            'allow' => true,
                            'roles' => ['@'],
                        ]
                    ]
                ]
            ];
        } else {
            $behaviors = [
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'actions' => ['manage', 'view', 'create', 'update', 'remove', 'export'],
                            'allow' => true,
                            'roles' => ['@'],
                        ]
                    ]
                ],
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'remove' => ['post'],
                    ],
                ]
            ];
        }

        return $behaviors;
    }

    public function actions()
    {
        $actions = [];

        if ($this->id=='site') {
            $actions = [
                'error' => [
                    'class' => 'sdailover\components\SDErrorAction',
                ],
                'captcha' => [
                    'class' => 'yii\captcha\CaptchaAction',
                    'fixedVerifyCode' => YII_ENV_TEST ? 'websdailover' : null,
                ]
            ];
        }

        return $actions;
    }
}