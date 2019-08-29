<?php
/**
 * @var $images
 * @var $imageView
 */
$sectionName = 'Галерея рисунков';

?>
<h1 class="text-center">
    <?= $sectionName ?>
</h1>

<div class="gallery-images">
    <?php foreach ($images as $key => $image): ?>
        <div class="gallery-item">
            <div class="item-info">
                <i class="fa fa-heart"></i> <?= $images[$key]['likes'] ?>
                <i class="fa fa-eye"></i> <?= $images[$key]['views'] ?>
                <i class="fa fa-comments"></i>
                <?= count(getFeedBackMessages($image['id'], 'images')) ?>
            </div>
            <a class="gallery-image" data-fancybox="gallery"
               href="<?= IMAGES_DIR . 'big/' . $images[$key]['url'] ?>">
                <img alt="image" src="<?= IMAGES_DIR . 'small/' . $image['url'] ?>">
            </a>
            <a class="image-link" href="/gallery/<?= $image['id'] ?>">
                Открыть на отдельной странице
            </a>
        </div>
    <?php endforeach; ?>
</div>

