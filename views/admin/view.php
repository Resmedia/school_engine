<?php
/**
 * Created by PhpStorm.
 * User: rogozhuk
 * Date: 05.10.19
 * Time: 15:13
 *
 * @var $model \app\models\entities\Order
 */

use app\engine\App;
$totalPrice = 0;
?>

<h1>Заказ № <?= $model->id ?></h1>

<h3>ФИО: <?= $model->name ?> </h3>

<h3>Телефон: <?=$model->phone ?></h3>

<h3>Email: <?=$model->email ?></h3>

<p>Адрес: <?=$model->address ?></p>

<p>Пожелания: <?=$model->description ?></p>

<p>Время заказа: <?= gmdate("d.m.Y H:i", $model->time_create) ?></p>

<p>Статус: <?= App::call()->orderRepository->getStatus($model->status) ?></p>

<h3>Товары:</h3>

<table class="table">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Название</th>
        <th scope="col">Стоимость</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach (App::call()->orderRepository->getOrderGoods($model->id) as $item):
        if (!empty($item)):
            $totalPrice += $item->price;
            ?>
            <tr>
                <th scope="row"><?= $item->id ?></th>
                <td><a href="/product/card/?id=<?= $item->id ?>"><?= $item->name ?></a></td>
                <td><?= $item->price ?> руб</td>
            </tr>
        <?php endif; ?>
    <?php endforeach; ?>
    </tbody>
</table>

<strong>ИТОГО: <?= $totalPrice ?> руб.</strong>

