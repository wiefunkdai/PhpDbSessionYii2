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
use yii\helpers\Url;

$this->title = 'Login Application';
?>
<?php $form = ActiveForm::begin([
    'id' => 'login-form',
    'enableAjaxValidation' => false,
    'layout' => 'horizontal',
    'errorCssClass' => 'is-invalid',
    'fieldConfig' => [
        'template' => "{input}\n{label}\n{error}",
        'options' => ['class' => 'form-floating'],
        'labelOptions' => ['class' => ''],
        'inputOptions' => ['class' => 'form-control']
    ],
    'options' => ['class' => 'form-signin']
]); ?>
    <img class="logo mt-2 mb-4" src="<?= Url::to('@websdailover/themes/images/sdailover-logo.svg'); ?>" alt="" width="72" height="57">
    <h3 class="form-signin-heading text-center">Please sign in</h3>

    <?= $form->field($model, 'username')->textInput(['id'=>'floatingInput', 'autofocus'=>true, 'placeholder'=>'']) ?>

    <?= $form->field($model, 'password')->passwordInput(['id'=>'floatingPassword', 'placeholder'=>'']) ?>

    <div class="form-check text-start my-3">
        <?= Html::activeCheckbox($model, 'rememberMe', ['id'=>'flexCheckDefault', 'label'=>null, 'class'=>'form-check-input']) ?>
        <?= Html::activeLabel($model, 'rememberMe', ['for'=>'flexCheckDefault', 'class'=>'form-check-label']) ?>
    </div>

    <?= Html::submitButton('Login', ['class' => 'btn btn-primary w-100 py-2', 'name' => 'login-button']) ?>

    <p class="form-notice text-center" style="color:#999;">You may login with <strong>demo/demo</strong>.</p>

    <p class="form-footer text-body-secondary text-center"><?= SDaiLover::copyright() ?><br><?= SDaiLover::powered() ?></p>
<?php ActiveForm::end(); ?>
<?php $this->registerCss(<<<EOF
body {
    padding-top: 40px;
    padding-bottom: 40px;
    background-color: #eee;
}
.logo {
    display: block;
    margin: 0 auto;
    margin-bottom: 1.5rem !important;
}
.form-signin {
    max-width: 330px;
    padding: 1rem;
    margin: 0 auto;
}
.form-signin .form-signin-heading,
.form-signin .form-check {
    margin-bottom: 10px;
    font-weight: 400;
}
.form-signin .form-floating:focus-within {
    z-index: 2;
}
.form-signin input {
    margin-bottom: 0;
    border-radius: 4px;
}
.form-signin .form-floating {
    margin-bottom: 1rem;
}
.form-signin .invalid-feedback {
    text-align: center;
}
.form-signin .form-notice {
    margin-top: 1rem;
    margin-bottom: 1rem;
}
.form-signin .form-footer {
    margin-top: 2rem;
    margin-bottom: 1rem;
}
EOF); ?>