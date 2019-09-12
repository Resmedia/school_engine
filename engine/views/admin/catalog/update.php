<?php
/**
 * Created by PhpStorm.
 * User: rogozhuk
 * Date: 01.09.19
 * Time: 17:14
 */
$issetRecord = isset($item);

if($issetRecord){
    $item = (object)$item;
}

?>
<div class="update-block">
    <h2 class="text-center text-default"><?= $issetRecord ? 'Обновление элемента ID ' . $item->id : 'Создание нового элемента' ?></h2>
    <form method="post" action="/api/catalog/<?= $issetRecord ? 'update' : 'create'?>">
        <input class="form-control" name="id" hidden value="<?= $issetRecord ? $item->id : ''?>">
        <input class="form-control" name="name" value="<?= $issetRecord ? $item->name : ''?>" placeholder="Введите название">
        <textarea class="form-control" rows="10" name="full_desc" placeholder="Введите текст">
            <?= $issetRecord ? $item->full_desc : ''?>
        </textarea>
        <input class="form-control" name="price" value="<?= $issetRecord ? $item->price : ''?>" placeholder="Введите стоимость">
        <input class="form-control" name="views" value="<?= $issetRecord ? $item->views : ''?>" placeholder="Введите просмотры">
        <button type="submit" class="btn btn-success"><?= $issetRecord ? 'Обновить' : 'Создать' ?></button>
    </form>
</div>

