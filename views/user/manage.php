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
use sdailover\yii\widgets\tab\SDTabWindow;

$this->title = 'User Application Manager';

$this->params['pageIcon'] = '<span class="bi bi-book-half" style="font-size:24px"></span>';
$this->params['pageTitle'] = $this->title;
$this->params['breadcrumbs'][] = 'User Manager';
?>
<?= SDTabWindow::widget([
    'id' => 'tabWindowManage',
    'newPageLabel' => 'Form',
    'enableAddPageButton' => true,
    'addPageButtonLabel' => '<span class="bi bi-plus-square-fill"></span> Create',
    'newPageUrl' => Url::to(['/user/add']),
    'pages' => [
        [
            'label' => 'Manage',
            'content' => $this->render('_gridview', [
                'tabId' => 'tabWindowManage',
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel
            ])
        ]
    ]
]) ?>