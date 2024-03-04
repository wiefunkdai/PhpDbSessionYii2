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
use sdailover\components\SDAppAsset;

SDAppAsset::register($this);
?>
<?php $this->beginPage() ?>
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
<!DOCTYPE html>
<html lang="<?= SDaiLover::$app->language ?>">
<head>
    <meta charset="UTF-8">
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
<main>
    <div class="container py-4">
        <header class="pb-3 mb-4 border-bottom">
            <a href="<?= SDaiLover::$app->homeUrl ?>" class="d-flex align-items-center text-body-emphasis text-decoration-none">
                <img src="<?= SDUrl::to('@websdailover/themes/images/sdailover-header.png'); ?>" alt="">
            </a>
        </header>

        <div class="content-error p-5 mb-4 bg-pageerror rounded-3">
            <?= $content ?>
        </div>
        <footer class="pt-3 mt-4 text-body-secondary border-top">
            <div class="pull-right"><?= SDaiLover::copyright() ?> | <?= SDaiLover::powered() ?></div>
        </footer>
    </div>
</main>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>