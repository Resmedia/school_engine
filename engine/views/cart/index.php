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
    <?php
    if (isset($items) && count($items) > 0): ?>
        <button onclick="clearCart()" class="btn btn-default">
            Очистить карзину
        </button>
        <div class="cart-block">
            <?php foreach ($items as $item): $itemObj =  (object)$item ?>
                <div class="cart-item">
                    <div class="item-info">
                        <img class="item-img" alt="<?= $itemObj->name ?>"
                             src="<?= IMAGES_DIR . 'small/' . $itemObj->image ?>"/>
                        <div class="item-settings">
                            <div class="settings-name">
                                <?= $itemObj->name ?>
                            </div>
                            <div class="settings-name">
                                <b>Цена за шт:</b> <?= $itemObj->price ?> руб.
                            </div>
                            <div class="settings-name">
                                <b>Количество:</b> <?= $itemObj->count ?> шт.
                            </div>
                        </div>
                    </div>
                    <div class="remove">
                        <span onclick="removeCartItem(<?= $itemObj->id ?>)"> &times; </span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <hr/>
        <b>КОЛИЧЕСТВО: <span id="total-page-count"><?= getCartCount() ?></span> шт.</b> <br/>
        <b>НА СУММУ: <span id="total-page-price"><?= getTotalPrice() ?></span> руб.</b>
    <?php else: ?>
        <h2 class="text-center">В корзине пусто... Начните <a href="/catalog">добавлять</a></h2>
    <?php endif; ?>
</div>

