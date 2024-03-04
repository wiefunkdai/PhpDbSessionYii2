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

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
?>
<div class="offcanvas offcanvas-start offcanvas-panel" data-bs-backdrop="static" tabindex="-1" id="sidebarSearch" aria-labelledby="sidebarSearchLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="sidebarSearchLabel">Search User</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <?php $form = ActiveForm::begin([
            'id' => 'sidebarSearchForm',
            'action' => ['user/manage'],
            'method' => 'post',
            'layout' => 'horizontal',
            'errorCssClass' => 'is-invalid',
            'fieldConfig' => [
                'template' => "{input}\n{label}\n{error}",
                'options' => ['class' => 'form-floating'],
                'labelOptions' => ['class' => ''],
                'inputOptions' => ['class' => 'form-control mb-3']
            ],
            'options' => ['class' => 'offcanvas-search sidebarsearch-form']
        ]); ?>
        <?= $form->field($model, 'username')->textInput(['autofocus'=>true, 'placeholder'=>'']) ?>
        <?= $form->field($model, 'fullname')->textInput(['placeholder'=>'']) ?>
        <?= $form->field($model, 'status')->dropDownList(['0'=>'Suspend','1'=>'Active'], ['prompt' => 'All Status']); ?>
        <div class="d-flex justify-content-center justify-content-lg-end form-group mt-4 border-top py-3">
        <?= Html::submitButton('<span class="bi bi-funnel"></span> Filter Now', ['class' => 'btn btn-primary btn-full w-100']) ?>
    </div>
    <?php ActiveForm::end(); ?>
  </div>
</div>