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

function actionItems(string $action, string $column, $post = null, $id = 0)
{
    if($post && ($action == 'create' || $action = 'update')){
        $columns = [];
        $values = [];
        $update = [];
        $postId = $post['id'];
        $time_create = time();
        $time_update = time();

        foreach ($post as $key => $value){
            $columns[] = '`' . $key . '`';
            $values[] = '\'' . $value . '\'';
            $update[] = "`$key` = '$value'";
        }
        $strColumns = implode(', ', $columns);
        $strValues = implode(', ', $values);
        $strUpdate = implode(', ' , $update);
    }

    switch ($action) {
        case 'create':
            $result = updateSql("
                                      INSERT INTO $column ($strColumns, `time_create`, `time_update`) 
                                      VALUES ($strValues, $time_create, $time_update)
                                ");
            break;
        case 'update':
            $result = updateSql("UPDATE $column SET $strUpdate, `time_update` = $time_update  WHERE `id` = '$postId'");
            break;
        case 'remove':
            $result = updateSql("DELETE FROM $column WHERE `id` = '$id'");
            break;
        default:
            $result = false;
    }

    if($result){
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }

    return $result;
}