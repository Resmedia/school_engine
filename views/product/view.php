<?php
/**
 * Created by PhpStorm.
 * User: rogozhuk
 * Date: 22.09.19
 * Time: 15:46
 */

?>

<div class="catalog-view">
    <h1 class="info-name">
        <?= $model->name ?>
    </h1>
    <div class="info-items">
        <!--<div class="info-item">
            <a class="feedback-count" title="Перейти к отзывам" href="#feedback">
                <i class="fa fa-comments"></i>
                <?/*= count(getFeedBackMessages($model->id, 'catalog')) */?>
            </a>
        </div>-->
        <div class="info-item">
            <i class="fa fa-eye"></i> <?= $model->views ?>
        </div>
    </div>
   <!-- <div class="gallery-images">
        <?php /*foreach ($images as $key => $image): */?>
            <a class="gallery-image" data-fancybox="gallery"
               href="<?/*= IMAGES_DIR . 'big/' . $image['url'] */?>">
                <img class="view-img" alt="<?/*= $image['name'] */?>" src="<?/*= IMAGES_DIR . 'small/' . $image['url'] */?>">
            </a>
        <?php /*endforeach; */?>
    </div>-->
    <div class="view-info">
        <div class="info-item info-price">
            Стоимость <?= $model->price ?> руб.
        </div>
        <div class="info-item info-desc">
            <?= $model->full_desc ?>
        </div>
        <div id="add-to-cart" class="btn btn-success pull-left" data-id="<?= $model->id ?>">
            Добавить в карзину
        </div>
        <div class="info-item info-date">
            <?= date('d.m.Y в H:i', $model->time_create) ?>
        </div>
    </div>
    <hr/>
    <?/*= $feedback->messages() */?>
</div>

