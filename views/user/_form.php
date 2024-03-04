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
$successClass = !$model->hasErrors() && (SDaiLover::$app->session->getFlash('success') || isset($savedSuccess)) ? ' form-success' : '';
?>
<?php $form = ActiveForm::begin([
    'id' => 'add-' . $tabPageId . 'form',
    'enableAjaxValidation' => false,
    'layout' => 'horizontal',
    'errorCssClass' => 'is-invalid',
    'fieldConfig' => [
        'template' => "{input}\n{label}\n{error}",
        'options' => ['class' => 'form-floating mb-3'],
        'labelOptions' => ['class' => ''],
        'inputOptions' => ['class' => 'form-control']
    ],
    'options' => ['class' => 'tab-form form-'.strtolower($tabPageId).$successClass]
]); ?>
    <?= $form->field($model, 'username')->textInput(['id'=>'formTitle', 'autofocus'=>true, 'placeholder'=>'Username', 'class'=>'sdtabtitleinput form-control']) ?>
    <?= $form->field($model, 'email')->textInput(['id'=>'formEmail', 'placeholder'=>'Email', 'class'=>'form-control']) ?>
    <?= $form->field($model, 'fullname')->textInput(['id'=>'formFullname', 'placeholder'=>'Full Name', 'class'=>'form-control']) ?>
    <?= $form->field($model, 'newpassword')->passwordInput(['id'=>'formPassword', 'placeholder'=>'Password', 'class'=>'form-control']) ?>
    <?= $form->field($model, 'status')->dropDownList(['0'=>'Suspend','1'=>'Active'], ['prompt' => 'User Status']); ?>
    <?php if (!$model->hasErrors() && (SDaiLover::$app->session->getFlash('success') || isset($savedSuccess))): ?>
        <div class="alert alert-success" role="alert">
            <?= $savedSuccess ?? SDaiLover::$app->session->getFlash('success') ?>
        </div>
    <?php endif; ?>
    <?= $form->errorSummary($model) ?>
    <div class="d-flex justify-content-center justify-content-lg-end form-group mt-4 border-top py-3">
        <?= Html::submitButton($model->getIsNewRecord() ? '<span class="bi bi-floppy"></span> Save &amp; New' : '<span class="bi bi-floppy"></span> Save Update', ['class' => 'btn btn-secondary me-2']) ?>
        <?php if (SDaiLover::$app->request->isAjax): ?>
            <?= Html::button('<span class="bi bi-box-arrow-right"></span> Save &amp; Exit', ['class' => 'btn btn-primary btn-closetab']) ?>
        <?php endif; ?>
    </div>
<?php ActiveForm::end() ?>
<?php if (SDaiLover::$app->request->isAjax): ?>
<script type="text/javascript">
jQuery('#<?= $tabId ?>').sdailoverTabWindow('updateTitleTab', {tabNavId:'<?= $tabNavId ?>', formTitle: jQuery('#add-<?= $tabPageId ?>form input.sdtabtitleinput').attr('value')});
jQuery('#add-<?= $tabPageId ?>form input.sdtabtitleinput').on('change',function(e){
    let pageTitle = this.value!=''?this.value:'Form';
    jQuery('#<?= $tabId ?>').sdailoverTabWindow('updateTitleTab', {tabNavId:'<?= $tabNavId ?>', formTitle: pageTitle});
});
jQuery('#add-<?= $tabPageId ?>form').on('submit',function(e){
    e.preventDefault();
    jQuery('#<?= $tabId ?>').sdailoverTabWindow('sendAjaxFormTab', {tabNavId:'<?= $tabNavId ?>', activeFormId: '#add-<?= $tabPageId ?>form', isRemoveTab: false});
    return false;
});
jQuery('#add-<?= $tabPageId ?>form .btn-closetab').on('click',function(e){
    jQuery('#<?= $tabId ?>').sdailoverTabWindow('sendAjaxFormTab', {tabNavId:'<?= $tabNavId ?>', activeFormId: '#add-<?= $tabPageId ?>form', isRemoveTab: true});
});
</script>
<?php endif; ?>