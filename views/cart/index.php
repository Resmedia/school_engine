<?php
/**
 * Created by PhpStorm.
 * User: rogozhuk
 * Date: 29.08.19
 * Time: 17:40
 */
?>

<div class="container">
    <h1 class="text-center">Ваша корзина</h1>
    <img id="loader" class="loader" src="/img/loader.svg"/>
    <div class="cart-block">
        <?php
        if (isset($items) && count($items) > 0): ?>
            <button onclick="clearCart()" class="btn btn-default">
                Очистить
            </button>
            <?php foreach ($items as $item): ?>
                <div class="cart-item">
                    <div class="item-info">
                        <img class="item-img" alt="<?= $item['name'] ?>"
                             src="<?= IMAGES_DIR . 'small/' . $item['image'] ?>"/>
                        <div class="item-settings">
                            <div class="settings-name">
                                <?= $item['name'] ?>
                            </div>
                            <div class="settings-name">
                                Цена за шт: <?= $item['price'] ?>
                            </div>
                            <div class="settings-name">
                                <?= $item['count'] ?>
                            </div>
                        </div>
                    </div>
                    <div class="remove">
                        <i onclick="removeCartItem(<?= $item['id'] ?>)" class="fa fa-remove"></i>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <h2 class="text-center">В корзине пусто... Начните <a href="/catalog">добавлять</a></h2>
        <?php endif; ?>
    </div>
</div>
