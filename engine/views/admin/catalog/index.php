<?php
/**
 * Created by PhpStorm.
 * User: rogozhuk
 * Date: 01.09.19
 * Time: 18:19
 */
?>

<ul class="edit-block">
    <?php foreach ($items as $itemArray): $item = (object)$itemArray  ?>
        <li class="edit-item">
            <div class="item-info">
                <?= $item->id ?>
            </div>
            <div class="item-info">
                <?= $item->name ?>
            </div>
            <div class="item-info">
                <div class="group-btn">
                    <a href="/cabinet/catalog/update/<?= $item->id ?>" class="btn btn-sm btn-default">
                        <i class="fa fa-pencil"></i>
                    </a>
                    <a href="/api/catalog/remove/<?= $item->id ?>" class="btn btn-sm btn-danger">
                        <i class="fa fa-trash"></i>
                    </a>
                </div>
            </div>
        </li>
    <?php endforeach; ?>
    <br/>
    <a href="/cabinet/catalog/update" class="btn btn-success">
        <i class="fa fa-plus"></i> Создать
    </a>
</ul>

