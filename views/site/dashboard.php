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
use yii\helpers\Url;

$this->title = 'Dashboard Application';

$this->params['pageIcon'] = '<span class="bi bi-house-fill" style="font-size:24px"></span>';
$this->params['pageTitle'] = $this->title;
?>
<div class="p-5 mb-4 bg-body-tertiary rounded-3">
    <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold pb-3 mb-4 border-bottom">SDaiLover PhpDbSession</h1>
        <p class="fs-5 col-md-8">The SDaiLover demo site for the <a href="https://github.com/SDaiLover/yii2-phpsessconnector">PhpSessConnector Extension</a> and <a href="https://github.com/SDaiLover/yii2-sdailoverwidgets">SDaiLover Widget</a> runs using the <a href="https://yiiframework.com">Yii 2.0 Framework</a>. With a beautiful website display equipped with <a href="https://getbootstrap.com">Bootstrap</a> & <a href="https://jquery.com/">jQuery</a>.</p>
        <div class="mb-5">
            <?= Html::a('<i class="bi bi-github"></i> Get Source', Url::to('https://github.com/wiefunkdai/phpdbsessionyii2'), ['type'=>'button','class'=>'btn btn-primary btn-lg px-4']) ?>
        </div>
        <hr class="col-3 col-md-2 mb-5">
        <div class="row g-3 g-md-5">
            <div class="col-md-6">
                <h2 class="text-body-emphasis">Author &amp; Contributors:</h2>
                <p>SDaiLover is maintained by the founding team and a small group of invaluable core contributors, with the massive support and involvement of our projections.</p>
            </div>
            <div class="col-md-6">
                <div class="list-group mb-3">
                    <div class="list-group-item list-group-item-action d-flex flex-wrap align-items-center justify-content-center justify-content-sm-start px-3 py-3">
                        <div class="d-flex align-items-center justify-content-center justify-content-md-start">
                            <?= Html::img(Url::to('https://github.com/wiefunkdai.png'), ['alt'=>'@wiefunkdai', 'width'=>'32', 'height'=>'32', 'class'=>'rounded me-2']) ?>
                            <p class="ms-1 mb-0"><?= Html::a('Stephanus Bagus Saputra', Url::to('https://stephanusdai.web.id'), ['class'=>'text-decoration-none']) ?></p>
                        </div>
                        <div class="d-flex align-items-center justify-content-end ms-auto pt-1 pt-md-0">
                            <?= Html::a(Html::tag('i','',['class'=>'bi bi-house-heart-fill']), Url::to('https://stephanusdai.web.id'), ['type'=>'button', 'class'=>'btn btn-sm me-1 btn-outline-primary']) ?>
                            <?= Html::a(Html::tag('i','',['class'=>'bi bi-github']), Url::to('https://github.com/wiefunkdai'), ['type'=>'button', 'class'=>'btn btn-sm me-1 btn-outline-primary']) ?>
                            <?= Html::a(Html::tag('i','',['class'=>'bi bi-telegram']), Url::to('https://t.me/wiefunkdai'), ['type'=>'button', 'class'=>'btn btn-sm btn-outline-primary']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>