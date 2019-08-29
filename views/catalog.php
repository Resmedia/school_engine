<?php
/**
 * @var $catalog ../public/index.php
 */

?>
<h1 class="text-center">
    <?= $name ?: '' ?>
</h1>

<div class="catalog">
    <?php foreach ($catalog as $item):
        $object = (object)$item;
        $images = getCatalogImages($object->id);
        ?>
        <a class="catalog-item" href="/catalog/<?= $object->id ?>">
            <img class="item-img" alt="img" src="<?= IMAGES_DIR . 'small/' . $images[0]['url'] ?>">
            <div class="item-info">
                <h2 class="info-name">
                    <?= $object->name ?>
                </h2>
                <div class="bottom-price">
                    Стоимость <?= $object->price ?> руб.
                </div>
                <div class="info-bottom">
                    <div class="bottom-cv">
                        <div>
                            <i class="fa fa-comments"></i>
                            <?= count(getFeedBackMessages($object->id, 'catalog')) ?>
                        </div>
                        <div>
                            <i class="fa fa-eye"></i>
                            <?= $object->views ?>
                        </div>
                    </div>
                    <div class="bottom-date pull-right">
                        <?= date('d.m.Y в h:i', $object->time_create) ?>
                    </div>
                </div>
            </div>
        </a>
    <?php endforeach; ?>
</div>