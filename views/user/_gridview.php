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
use sdailover\yii\widgets\grid\SDGridView;
?>
<?= $this->render('_toolbar', ['searchModel'=>$searchModel]) ?>
<?= SDGridView::widget([
    'id' => 'usergridview',
    'dataProvider' => $dataProvider,
    'options' => ['class' => 'grid-view grid-manager grid-responsive', 'sd-tab'=>isset($tabId)?$tabId:''],
    'tableOptions' => ['id' => 'dataGridUser'],
    'columns' => [
        ['class' => 'sdailover\yii\widgets\grid\SDCheckboxColumn'],
        [
            'attribute' => 'username',
            'format' => 'text',
            'headerOptions' => ['scope'=>'col', 'class'=>'column-primary'],
            'contentOptions' => ['class'=>'title']
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
                return ($status == 0 ? '<span class="badge badge-danger">Disable</span>' : '<span class="badge badge-success">Active</span>');
            },
        ],
        [
            'class' => 'sdailover\yii\widgets\grid\SDActionColumn',
            'template' => '{edit}{clear}',
            'buttons' => [
                'view' => function($url, $model) {
                    return Html::a('<span class="bi bi-eye-fillll"></span>', 
                    ['view', 'id' => $model['id']], 
                    ['title' => 'View', 'class' => 'btn btn-primary text-white btn-sm btn-icon view']);
                },
                'edit' => function($url, $model) {
                    return Html::a('<span class="bi bi-pencil-square"></span>', 
                    ['edit', 'id' => $model['id']], 
                    ['title' => 'Edit', 'class' => 'btn btn-primary text-white btn-sm btn-icon update']);
                },
                'clear' => function($url, $model) {
                    return Html::a('<span class="bi bi-file-earmark-x-fill"></span>', 
                    ['clear', 'id' => $model['id']], 
                    [
                        'title' => 'Clear', 
                        'class' => 'btn btn-danger text-white btn-sm btn-icon delete', 
                        'data' => [
                            'confirm' => 'Are you absolutely sure ? You will lose all the information about this user with this action.',
                            'method' => 'post', 
                            'data-pjax' => false
                        ]
                    ]);
                }
            ]
        ]
    ],
    'pager' => [
        'maxButtonCount' => 5
    ]
]); ?>