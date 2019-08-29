<?php
/**
 * Created by PhpStorm.
 * User: rogozhuk
 * Date: 29.08.19
 * Time: 11:16
 */

function getBdItems(string $element, string $column = '', string $sort = ''): array
{
    $items = getAssocResult('SELECT * FROM' . ' ' . $element . ($sort ? ' ORDER BY ' . $column . ' ' . $sort : ''));
    return $items;
}

function getImages(string $id, string $model): array
{
    $items = getAssocResult("SELECT * FROM `gallery_images` WHERE `model_id` = '$id' AND `model` = '$model'");
    return $items;
}

function getBdItem($id, $element)
{
    $item = getAssocResult("SELECT * FROM $element WHERE id = {$id}");
    return $item;
}

function setLike(int $id, $element = '')
{
    updateSql("UPDATE $element SET `likes` = `likes` + 1 WHERE `id` = $id");
    $items = getAssocResult("SELECT * FROM $element WHERE id = {$id}");
    $result = [];
    if (isset($items[0])) {
        $result = $items[0];
    }
    return $result['likes'];
}

function getItemContent(int $id, string $element): array
{
    $id = (int)$id;
    $sql = "SELECT * FROM $element WHERE id = {$id}";
    updateSql("UPDATE $element SET `views` = `views` + 1 WHERE `id` = {$id}");
    $items = getAssocResult($sql);

    $result = [];
    if (isset($items[0]))
        $result = $items[0];
    return $result;
}