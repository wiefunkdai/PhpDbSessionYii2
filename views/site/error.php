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

$this->title = $name;
?>
<div class="container-fluid py-5">
    <h1 class="display-5 fw-bold" style="margin-top: -20px"><?= Html::encode($this->title) ?></h1>
    <p class="col-md-8 fs-4"><?= nl2br(Html::encode($message)) ?></p>
    <p class="col-md-8 m-0">The above error occurred while the Web server was processing your request.</p>
    <p class="col-md-8 m-0">Please contact us if you think this is a server error. Thank you.</p>
    <button class="btn btn-goback btn-primary btn-lg mt-4" type="button"><i class="bi bi-arrow-left-square"></i> Back to Last Page</button>
</div>
<?php $this->registerJs(<<<EOF
jQuery('.btn-goback').on('click',function(e){ window.history.back(); });
EOF); ?>