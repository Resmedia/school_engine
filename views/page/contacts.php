<?php
/**
 * Created by PhpStorm.
 * User: rogozhuk
 * Date: 17.08.19
 * Time: 19:36
 */

$model = (object)$item[0];

if ($model->status = STATUS_PUBLISHED):
?>

<div class="container">
    <h1 class="text-center"><?= $model->name ?></h1>
    <div class="description">
        <?= $model->description ?>
    </div>
</div>

<?php endif; ?>