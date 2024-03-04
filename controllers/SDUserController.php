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

namespace sdailover\controllers;
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
use yii\helpers\Json;
use sdailover\components\SDController;
use sdailover\yii\phpsessconnector\SDActiveProvider;
use sdailover\models\SDUserSearch;
use sdailover\models\SDUser;

/**
 * SDaiLover User Controller
 * 
 * @author    : Stephanus Bagus Saputra,
 *              ( 戴 Dai 偉 Wie 峯 Funk )
 * @email     : wiefunk@stephanusdai.web.id
 * @contact   : https://t.me/wiefunkdai
 * @support   : https://opencollective.com/wiefunkdai
 * @link      : https://www.stephanusdai.web.id
 */
class SDUserController extends SDController
{
    public function actionManage()
    {
        $searchModel = new SDUserSearch();
        $searchParams = SDaiLover::$app->request->isGet ? SDaiLover::$app->request->get() : SDaiLover::$app->request->post();
        $dataProvider = $searchModel->search($searchParams);
        
        $params = [
            'tabId' => SDaiLover::$app->request->get('tabId'),
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ];

        if (SDaiLover::$app->request->isAjax) 
            return Json::encode($this->renderPartial('_gridview', $params));
        return $this->render('manage', $params);
    }

    public function actionCreate()
    {
        $model = new SDUser();
        $params = [
            'model' => $model,
            'tabId' => SDaiLover::$app->request->get('tabId'),
            'tabNavId' => SDaiLover::$app->request->get('tabNavId'),
            'tabPageId' => SDaiLover::$app->request->get('tabPageId') ? : 'adduserform'
        ];

        try {
            if (SDaiLover::$app->request->isPost) {
                if ($model->load(SDaiLover::$app->request->post()) && $model->validate()) {
                    if ($model->save()) {
                        $params['model'] = new SDUser();
                        if (!SDaiLover::$app->request->isAjax)
                            return $this->redirect(['view', 'id' => $model->id]);                    
                    }
                    $params['savedSuccess'] = 'Saved has been successfully!';
                    SDaiLover::$app->getSession()->setFlash('success', $params['savedSuccess']);
                }
            }
            if (SDaiLover::$app->request->isAjax)
                return Json::htmlEncode($this->renderPartial('_form', $params));
        } catch (StaleObjectException $e) {
            // logic to resolve the conflict
            $this->sendErrorPage(500,'Error: '.$e->getMessage());
        }

        return $this->render('create', $params);
    }

    public function actionView($id=null)
    {
        $model = SDUser::findOne($id);
        $params = [
            'model' => $model
        ];

        if ($model === null)
            $this->sendErrorPage(404,'Page Not Found!');
        return $this->render('view', $params);

    }

    public function actionUpdate($id=null)
    {
        $model = SDUser::findOne($id);
        $params = [
            'model' => $model,
            'tabId' => SDaiLover::$app->request->get('tabId'),
            'tabNavId' => SDaiLover::$app->request->get('tabNavId'),
            'tabPageId' => SDaiLover::$app->request->get('tabPageId') ? : 'adduserform'
        ];

        if ($model === null)
            $this->sendErrorPage(404,'Page Not Found!');

        try {
            if (SDaiLover::$app->request->isPost) {
                if ($model->load(SDaiLover::$app->request->post()) && $model->validate()) {
                    if ($model->update()) {
                        if (!SDaiLover::$app->request->isAjax)
                            return $this->redirect(['view', 'id' => $model->id]);                    
                    }
                    $params['savedSuccess'] = 'Saved has been successfully!';
                    SDaiLover::$app->getSession()->setFlash('success', $params['savedSuccess']);
                }
            }
            if (SDaiLover::$app->request->isAjax)
                return Json::htmlEncode($this->renderPartial('_form', $params));
        } catch (StaleObjectException $e) {
            // logic to resolve the conflict
            $this->sendErrorPage(500,'Error: '.$e->getMessage());
        }

        return $this->render('create', $params);
    }

    public function actionRemove($id=null)
    {
        if (SDaiLover::$app->user->id==$id)
            $this->sendErrorPage(403,'You cannot delete a running user!');
        $model = SDUser::findOne($id);
        if ($model===null)
            $this->sendErrorPage(404,'You cannot delete a running user!');
        try {
            $model->delete();
        } catch(\yii\db\Exception $e) {
            $this->sendErrorPage(500,'Error: '.$e->getMessage());
        }

        if (SDaiLover::$app->request->isAjax) {
            $this->action->id = 'manage';
            return $this->actionManage();
        }

        return $this->redirect(['/user/manage']);
    }

    public function actionExport($id=null)
    {
        $query = SDUser::find();
        $dataProvider = new SDActiveProvider([
            'query' => $query,
            'pagination' => false,
            'sort' =>false

        ]);
        if (SDaiLover::$app->request->post('items')) {
            $ids = Json::decode(SDaiLover::$app->request->post('items'));
            $query->where(['in', 'id', $ids]);
        } elseif ($id!==null) {
            $query->where(['id'=>$id]);
        }
        
        if (SDaiLover::$app->request->isAjax)
            return Json::htmlEncode($this->renderPartial('_print', ['dataProvider'=>$dataProvider]));
        return $this->render('export', ['dataProvider'=>$dataProvider]);
    }
}