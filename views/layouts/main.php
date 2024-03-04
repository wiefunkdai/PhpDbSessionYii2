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
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\bootstrap5\Breadcrumbs;
use yii\helpers\Url;
use sdailover\components\SDAppAsset;

SDAppAsset::register($this);

?>
<!--//
 // SDaiLover Web Packages
 //
 // @author    : Stephanus Bagus Saputra,
 //              ( 戴 Dai 偉 Wie 峯 Funk )
 // @email     : wiefunk@stephanusdai.web.id
 // @contact   : https://t.me/wiefunkdai
 // @support   : https://opencollective.com/wiefunkdai
 // @link      : https://www.sdailover.com,
 //              https://www.stephanusdai.web.id
 // @license   : https://www.sdailover.com/license.html
 // @copyright : (c) ID 2023-2024 SDaiLover. All rights reserved.
 // This software using Yii Framework has released under the terms of the BSD License.
 //-->
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= SDaiLover::$app->language ?>">
<head>
    <meta charset="UTF-8">
    <meta name="referrer" content="strict-origin" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title . ' - ' . SDaiLover::$app->name) ?></title>
    <link rel="apple-touch-icon" sizes="180x180" href="<?= Url::to('@websdailover/themes/images/favicons/apple-touch-icon.png'); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= Url::to('@websdailover/themes/images/favicons/favicon-32x32.png'); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= Url::to('@websdailover/themes/images/favicons/favicon-16x16.png'); ?>">
    <link rel="icon" type="image/svg+xml" href="<?= Url::to('@websdailover/themes/images/favicons/favicon.svg'); ?>">
    <link rel="icon" type="image/png" href="<?= Url::to('@websdailover/themes/images/favicons/favicon.png'); ?>">
    <link rel="shortcut icon" href="<?= Url::to('@websdailover/themes/images/favicons/favicon.ico'); ?>">
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
    <?php
    NavBar::begin([
        'id' => 'navbartop',
        'brandLabel' => SDaiLover::$app->name,
        'brandImage' => Url::to('@websdailover/themes/images/sdailover-header.png'),
        'brandUrl' => '#',
        'brandOptions' => ['data-bs-toggle'=>'collapse', 'data-bs-target'=>'#sidebarMenu', 'aria-expanded'=>'false', 'aria-controls'=>'sidebarMenu', 'aria-label'=>'Toggle navigation'],
        'togglerContent' => '<span class="bi bi-justify"></span>',
        'innerContainerOptions' => [
            'class' => 'container-fluid'
        ],
        'options' => [
            'tag'=>'header',
            'class' => 'headbar navbar navbar-expand-xl navbar-inverse navbar-fixed-top sticky-top bg-light shadow'
        ]
    ]);
    echo Nav::widget([
        'id' => 'navitemtop',
        'activateItems' => true,
        'activateParents' => true,
        'encodeLabels' => false,
        'options' => ['class' => 'navbar-nav navbar-right ms-auto me-1 mb-2 mb-lg-0'],
        'items' => [
            ['label' => '<i class="bi bi-info-circle-fill me-1"></i> Dashboard', 'url' => ['/site/dashboard']],
            ['label' => '<i class="bi bi-person-lines-fill me-1"></i> Account',  'items' => [
                    ['label'=>'<div class="mt-3">'
                    . '<img src="'.Url::to('@websdailover/themes/images/sdailover-logo.png').'" class="d-block mx-auto" style="max-height:60px"/>'
                    . '<p class="text-center p-0 mt-3 mb-0 fw-bold">' . SDaiLover::$app->user->identity->fullname . '</p>'
                    . '</div>'],
                    ['label'=>'&nbsp;', 'options'=>['class'=>'dropdown-divider px-0 mx-0']],
                    ['label' => Html::beginForm(['/site/logout'], 'post')
                    . Html::submitButton(
                        '<i class="bi bi-escape"></i> Log Out',
                        ['class' => 'btn btn-primary w-100 py-2 logout']
                    )
                    . Html::endForm()]   
                ],
                'dropdownOptions' => [
                    'class' => 'dropdown-menu dropdown-menu-end'
                ]
            ],
        ]
    ]);
    NavBar::end();
    ?>
    <div class="mainpage container-fluid">
        <div class="row">
            <div id="sidebarMenu" class="sidebar border-right col-md-3 col-lg-2 p-0 collapse collapse-horizontal show">
                <div class="position-sticky sidebar-item pt-4">
                    <?= Nav::widget([
                        'activateItems' => true,
                        'activateParents' => true,
                        'encodeLabels' => false,
                        'options' => ['class' => 'nav flex-column'],
                        'items' => [
                            [
                                'label' => '<i class="bi bi-house-fill me-1"></i> Dashboard', 
                                'url' => ['site/dashboard']
                            ]
                        ]
                    ]) ?>
                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-2 mb-1 border-top border-bottom py-2">
                        <span>User Manager</span>
                        <span class="bi bi-grid-3x3-gap-fill"></span>
                    </h6>
                    <?= Nav::widget([
                        'activateItems' => true,
                        'activateParents' => true,
                        'encodeLabels' => false,
                        'options' => ['class' => 'nav flex-column'],
                        'items' => [
                            [
                                'label' => '<i class="bi bi-buildings-fill me-1"></i> Manage User', 
                                'url' => ['user/manage']
                            ]
                        ]
                    ]) ?>
                </div>
            </div>
            <main class="content col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <?= Breadcrumbs::widget([
                    'encodeLabels' => false,
                    'homeLink' => [
                        'label' => '<i class="bi bi-house-fill"></i> Dashboard',
                        'url' => SDaiLover::$app->homeUrl,
                        'class'=>'link-body-emphasis'
                    ],
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    'options' => [
                        'tag' => 'div',
                        'id' => 'breadcrumb',
                        'class' => 'breadcrumb breadcrumb-chevron p-3 mb-4 bg-body-tertiary rounded-3'
                    ]
                ]) ?>
                <div class="post-content">
                    <?php if(isset($this->params['pageTitle'])): ?>
                        <div class="page-title pb-3 mb-4 px-3 border-bottom">
                            <div class="d-flex align-items-center text-body-emphasis">
                                <?= isset($this->params['pageIcon']) ? $this->params['pageIcon'] : '' ?>
                                <span class="fs-4 ms-2"><?= Html::encode($this->params['pageTitle']) ?></span>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?= $content ?>
                </div>
            </main>
        </div>
    </div>
    <footer class="footer py-1 px-2">
        <div class="pull-right"><?= SDaiLover::copyright() ?> | <?= SDaiLover::powered() ?></div>
    </footer>
    <?php if(isset($this->params['searchWidgets'])) {
        $searchWidgets = $this->params['searchWidgets'];
        foreach($searchWidgets as $searchWidget) {
            echo $searchWidget;
        }
    } ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>