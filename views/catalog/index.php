<?php
/**
 * @var $catalog ../public/index.php
 */
$model = 'catalog';
?>
<h1 class="text-center">
    <?= $name ?: '' ?>
</h1>

<div id="catalog" class="catalog">
    <?php foreach ($catalog as $item):
        $object = (object)$item;
        $images = getImages($object->id, $model);
        ?>
        <div class="catalog-item">
            <a href="/catalog/<?= $object->id ?>">
                <img class="item-img" alt="img" src="<?= IMAGES_DIR . 'small/' . $images[0]['url'] ?>">
            </a>
            <div class="item-info">
                <a href="/catalog/<?= $object->id ?>">
                    <h2 class="info-name">
                        <?= $object->name ?>
                    </h2>
                </a>
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
                    <div id="add-cart" class="btn btn-success" data-id="<?= $object->id ?>">
                        Добавить в карзину
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>