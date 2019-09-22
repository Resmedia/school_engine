<?php
/**
 * Created by PhpStorm.
 * User: rogozhuk
 * Date: 22.09.19
 * Time: 15:46
 */

/**
 * @var $model \app\models\Product
*/
?>

<div class="catalog-item">
    <a href="/products/<?= $model->id ?>">
       <!-- <img class="item-img" alt="img" src="<?/*= IMAGES_DIR . 'small/' . $images[0]['url'] */?>">-->
    </a>
    <div class="item-info">
        <a href="/products/<?= $model->id ?>">
            <h2 class="info-name">
                <?= $model->name ?>
            </h2>
        </a>
        <div class="bottom-price">
            Стоимость <?= $model->price ?> руб.
        </div>
        <div class="info-bottom">
            <div class="bottom-cv">
                <!--<div>
                    <i class="fa fa-comments"></i>
                    <?/*= count(getFeedBackMessages($model->id, 'catalog')) */?>
                </div>-->
                <div>
                    <i class="fa fa-eye"></i>
                    <?= $model->views ?>
                </div>
            </div>
            <div class="bottom-date pull-right">
                <?= date('d.m.Y в h:i', $model->time_create) ?>
            </div>
            <div id="add-cart" class="btn btn-success" data-id="<?= $model->id ?>">
                Добавить в карзину
            </div>
        </div>
    </div>
</div>
