<?php
/**
 * Created by PhpStorm.
 * User: rogozhuk
 * Date: 22.09.19
 * Time: 15:45
 */

/** @var $models app\models\Product */

?>
<div id="catalog" class="catalog">
    <?php foreach ($models as $model): ?>
        <?php $this->useLayouts = false;
              echo $this->render('_row', ['model' => (object)$model])
        ?>
    <?php endforeach;?>
    <br/>
    <div class="text-center ">
        <button id="get-more" class="btn btn-default">Показать еще</button>
    </div>
</div>
