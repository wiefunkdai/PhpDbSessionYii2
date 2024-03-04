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
use sdailover\components\SDController;
use sdailover\models\SDLoginForm;

/**
 * SDaiLover Site Controller
 * 
 * @author    : Stephanus Bagus Saputra,
 *              ( 戴 Dai 偉 Wie 峯 Funk )
 * @email     : wiefunk@stephanusdai.web.id
 * @contact   : https://t.me/wiefunkdai
 * @support   : https://opencollective.com/wiefunkdai
 * @link      : https://www.stephanusdai.web.id
 */
class SDSiteController extends SDController
{
    public function actionDashboard()
    {
        return $this->render('dashboard');
    }

    public function actionLogin()
    {
        if (!SDaiLover::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new SDLoginForm();
        if ($model->load(SDaiLover::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $this->layout = 'login';
        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        SDaiLover::$app->user->logout();

        return $this->goHome();
    }
}