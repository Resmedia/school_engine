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
    if (is_numeric($id)) {
        $item = getAssocResult("SELECT * FROM $element WHERE `id` = '$id'");
    } else {
        $item = getAssocResult("SELECT * FROM $element WHERE `url` = '$id'");
    }
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

function actionCatalog(
    string $action,
    $post = null,
    $id = 0
)
{
    $time_create = time();
    $time_update = time();
    if(isset($post)) {
        $views = $post['views'];
        $fullDesc = $post['full_desc'];
        $name = $post['name'];
        $price = $post['price'];
        $postId = $post['id'];
    }

    switch ($action) {
        case 'create':
            $result = updateSql("
               INSERT INTO `catalog` (`name`, `full_desc`, `price`, `views`, `time_create`, `time_update`) 
               VALUES ('$name','$fullDesc','$price','$views','$time_create', '$time_update')
            ");
            break;
        case 'update':
            $result = updateSql("
               UPDATE `catalog` 
               SET `name` = '$name', `full_desc` = '$fullDesc', `price` = '$price', `views` = '$views', `time_create` = `time_create`, `time_update` = '$time_update' 
               WHERE `id` = '$postId'
            ");
            break;
        case 'remove':
            $result = updateSql("DELETE FROM `catalog` WHERE `id` = '$id'");
            break;
        default:
            $result = false;
    }

    if($result){
        header("Location: /cabinet/catalog");
    } else {
        return $result;
    }
}