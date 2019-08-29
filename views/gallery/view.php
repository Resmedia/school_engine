<?php
/**
 * Created by PhpStorm.
 * User: rogozhuk
 * Date: 24.08.19
 * Time: 8:33
 *
 * @var $image
 */
include_once TEMPLATES_DIR . "FeedBackMessage.php";

$item = (object)$image;
$messages = (object)$messages;
$sectionName = 'Просмотр рисунка';
$feedback = new FeedBackMessage();

$feedback->id = $item->id;
$feedback->model = 'images';
$feedback->messages = $messages;
?>
<h1 class="text-center">
    <?= $sectionName ?>
</h1>

<a class="go-back" href="/gallery">&lt; Вернуться к галерее</a>
<div class="gallery-image">
    <div class="info">
        <div class="views">Просмотры: <?= $item->views ?></div>
        <div>
            <a class="feedback-count" title="Перейти к отзывам" href="#feedback">
                <i class="fa fa-comments"></i>
                <?= count(getFeedBackMessages($item->id, 'images')) ?>
            </a>
        </div>
        <div class="like">
            <button class="like-btn" onclick="like(<?= $item->id; ?>)">&#10084;</button>
            <div class="like-count"><?= $item->likes; ?></div>
        </div>
    </div>
    <img class="image-view" alt="image" width="70%" src="<?= IMAGES_DIR . 'big/' . $item->url; ?>">

    <hr/>
    <?= $feedback->messages() ?>
</div>