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

$this->params['searchWidgets'][] = $this->render('_search', ['model' => $searchModel]);
?>
<div class="grid-toolbar container mb-3">
  <div class="row">
    <div class="col-9 col-md-8 px-0 pe-1 d-flex gap-2 justify-content-start">
      <button class="btn btn-sm btn-outline-success" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarSearch" aria-controls="sidebarSearch">
        <i class="bi bi-binoculars-fill"></i> <span class="btn-cap">Search</span>
      </button>
      <button class="btn btn-sm btn-outline-dark grid-export" type="button" data-href="<?= Url::to(['/user/export']) ?>">
        <i class="bi bi-printer-fill"></i> <span class="btn-cap">Export</span>
      </button>
      <button class="btn btn-sm btn-outline-primary grid-update" type="button" data-href="<?= Url::to(['/user/update']) ?>">
        <i class="bi bi-archive-fill"></i> <span class="btn-cap">Modify</span>
      </button>
    </div>
    <div class="col-3 col-md-4 px-0 ps-1 d-flex gap-2 justify-content-end">
      <button class="btn btn-sm btn-outline-danger grid-delete" type="button" data-href="<?= Url::to(['/user/remove']) ?>">
        <i class="bi bi-trash-fill"></i> <span class="btn-cap">Delete</span>
      </button>
    </div>
  </div>
</div>