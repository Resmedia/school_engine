<?php
/**
 * Created by PhpStorm.
 * User: rogozhuk
 * Date: 29.08.19
 * Time: 10:56
 */

function actionMessage(
    string $action,
    int $model_id,
    int $id = 0,
    string $model,
    string $text = '',
    string $user = ''
)
{
    $time_create = time();
    $time_update = time();

    switch ($action) {
        case 'add':
            $result = updateSql("
               INSERT INTO `feedback` (`model_id`, `model`, `user`, `text`, `time_create`, `time_update`) 
               VALUES ('$model_id','$model','$user','$text','$time_create', '$time_update')
            ");
            $message = 'добавлен';
            break;
        case 'edit':
            $result = updateSql("
               UPDATE `feedback` 
               SET `user` = '$user', `text` = '$text', `time_create` = `time_create`, `time_update` = '$time_update' 
               WHERE `model_id` = '$model_id' 
               AND `id` = '$id' 
               AND `model` = '$model'
            ");
            $message = 'изменен';
            break;
        case 'remove':
            $result = updateSql("DELETE FROM `feedback` WHERE `id` = '$id' AND `model_id` = '$model_id' AND `model` = '$model'");
            $message = 'удален';
            break;
        default:
            $result = false;
            $message = '';
    }

    $items = getAssocResult("SELECT * FROM `feedback` WHERE `model_id` = '$model_id' AND `model` = '$model'");

    if ($result) {
        $messages[] = [
            'message' => "Отзыв успешно $message",
            'items' => $items,
        ];
    } else {
        $messages[] = [
            'message' => 'Что-то пошло не так. Обратитесь к администратору',
            'items' => $items,
        ];
    }

    return $messages;
}

function getFeedBackMessages(int $id, string $model)
{
    $items = getAssocResult("SELECT * FROM `feedback` WHERE `model_id` = '$id' AND `model` = '$model'");
    return $items;
}
