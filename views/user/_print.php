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

use yii\helpers\Url;
use sdailover\yii\widgets\grid\SDGridView;
?>

<div class="container-fluid py-4">
    <div class="pb-3 mb-4 border-bottom">
        <a href="<?= SDaiLover::$app->homeUrl ?>" class="d-flex align-items-center text-body-emphasis text-decoration-none">
            <img src="<?= Url::to('@websdailover/themes/images/sdailover-header.png'); ?>" alt="">
        </a>
    </div>

    <div class="content-print mb-4 py-4 bg-pageprint rounded-3">
        <?= SDGridView::widget([
            'id' => 'usergridview',
            'dataProvider' => $dataProvider,
            'options' => ['class' => 'table-responsive grid-view'],
            'tableOptions' => ['class' => 'table table-striped mb-4'],
            'layout' => '{items}',
            'columns' => [
                [
                    'attribute' => 'username',
                    'format' => 'text'
                ],
                [
                    'attribute' => 'fullname',
                    'format' => 'text'
                ],
                [
                    'attribute' => 'status',
                    'format' => 'raw',
                    'value' => function ($data) {
                        $status = is_array($data) ? $data['status'] : $data->status;
                        return ($status == 0 ? 'disable' : 'active');
                    },
                ]
            ]
        ]); ?>
    </div>
    <div class="pt-3 mt-4 text-body-secondary position-static bottom-0 border-top">
        <div class="pull-right"><?= SDaiLover::copyright() ?> | <?= SDaiLover::powered() ?></div>
    </div>
</div>