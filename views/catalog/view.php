<?php
/**
 * Created by PhpStorm.
 * User: rogozhuk
 * Date: 24.08.19
 * Time: 8:33
 *
 * @var $messages
 * @var $item
 */

$model = 'catalog';

$messages = (object)$messages;
$item = (object)$item;
$images = getImages($item->id, $model);

$feedback = new FeedBackMessage();
$feedback->id = $item->id;
$feedback->model = 'catalog';
$feedback->messages = $messages;
?>

<div class="catalog-view">
    <h1 class="info-name">
        <?= $item->name ?>
    </h1>
    <div class="info-items">
        <div class="info-item">
            <a class="feedback-count" title="Перейти к отзывам" href="#feedback">
                <i class="fa fa-comments"></i>
                <?= count(getFeedBackMessages($item->id, 'catalog')) ?>
            </a>
        </div>
        <div class="info-item">
            <i class="fa fa-eye"></i> <?= $item->views ?>
        </div>
    </div>
    <div class="gallery-images">
        <?php foreach ($images as $key => $image): ?>
            <a class="gallery-image" data-fancybox="gallery"
               href="<?= IMAGES_DIR . 'big/' . $image['url'] ?>">
                <img class="view-img" alt="<?= $image['name'] ?>" src="<?= IMAGES_DIR . 'small/' . $image['url'] ?>">
            </a>
        <?php endforeach; ?>
    </div>
    <div class="view-info">
        <div class="info-item info-price">
            Стоимость <?= $item->price ?> руб.
        </div>
        <div class="info-item info-desc">
            <?= $item->full_desc ?>
        </div>
        <div id="add-to-cart" class="btn btn-success pull-left" data-id="<?= $item->id ?>">
            Добавить в карзину
        </div>
        <div class="info-item info-date">
            <?= date('d.m.Y в H:i', $item->time_create) ?>
        </div>
    </div>
    <hr/>
    <?= $feedback->messages() ?>
</div>
