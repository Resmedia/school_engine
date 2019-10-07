<?php
/**
 * Created by PhpStorm.
 * User: rogozhuk
 * Date: 05.10.19
 * Time: 15:10
 *
 * @var $model \app\models\entities\Order
 */

use app\engine\App;
use app\models\entities\Order;

?>
<h1>Заказы</h1>
<table class="table">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Имя</th>
        <th scope="col">Телефон</th>
        <th scope="col">Адрес</th>
        <th scope="col">Время создания</th>
        <th scope="col">Статус</th>
        <th scope="col">Действия</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($models as $mod): $model = (object)$mod ?>
    <tr>
        <th scope="row"><?= $model->id ?></th>
        <td><?= $model->name ?></a></td>
        <td><?= $model->phone ?></td>
        <td><?= $model->address ?></td>
        <td><?= gmdate("d.m.Y H:i", $model->time_create) ?></td>
        <td>
            <?= App::call()->orderRepository->getStatus($model->status) ?>
        </td>
        <td>
            <div class="btn-group">
                <a href="/admin/view/?id=<?= $model->id ?>" class="d-inline-block btn btn-xs btn-outline-info">
                    Просмотр
                </a>
                <?php if ($model->status != Order::STATUS_DONE): ?>
                <button id="status-done" data-id="<?= $model->id ?>" class="d-inline-block btn btn-xs btn-outline-success">
                    Выполнено
                </button>
                <?php endif; ?>
                <button id="delete-order" data-id="<?= $model->id ?>" class="d-inline-block  btn btn-xs btn-outline-danger">
                    Удалить
                </button>
            </div>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>
