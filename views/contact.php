<?php
/**
 * Created by PhpStorm.
 * User: rogozhuk
 * Date: 17.08.19
 * Time: 19:36
 *
 * @var $model app\models\entities\Page
 */

use app\models\entities\Page;

if ($model->status = Page::STATUS_PUBLISHED):
?>

<div class="container">
    <h1 class="text-center"><?= $model->name ?></h1>
    <div class="description">
        <?= $model->description ?>
    </div>
</div>

<?php endif; ?>