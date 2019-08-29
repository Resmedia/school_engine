<?php
/*
 * Функция подготовки переменных для передачи их в шаблон
 */
function prepareVariables($url, $id, $post)
{
    $params = [];

    switch ($url) {
        case '/':
            $params = [];
            break;

        case '/gallery':
            $params = [
                'page' => 'gallery',
                'images' => getBdItems('images', 'likes', 'DESC')
            ];
            break;

        case "/gallery/$id":
            if (getBdItem($id, 'images')) {
                $params = [
                    'page' => 'gallery_view',
                    'messages' => [
                        'message' => '',
                        'items' => getFeedBackMessages(+$id, 'images')
                    ],
                    'image' => getItemContent(+$id, 'images'),
                ];
            } else {
                die("Страницы не существует 404");
            }
            break;

        case '/catalog':
            $params = [
                'page' => 'catalog',
                'catalog' => getBdItems('catalog', 'id', 'ASC'),
                'name' => "Каталог товаров"
            ];
            break;

        case "/catalog/$id":
            if (getBdItem($id, 'catalog')) {
                $params = [
                    'page' => 'catalog_view',
                    'messages' => [
                        'message' => '',
                        'items' => getFeedBackMessages(+$id, 'catalog')
                    ],
                    'item' => getItemContent(+$id, 'catalog'),
                ];
            } else {
                die("Страницы не существует 404");
            }
            break;

        case "/api/message":
            $result = actionMessage(
                (string)$post['action'],
                (int)$post['model_id'],
                (int)$post['id'],
                (string)$post['model'],
                (string)$post['text'],
                (string)$post['user']
            );
            echo json_encode($result);
            exit();
            break;

        case "/api/catalog-item":
            $data = getBdItem((int)$post['id'], 'feedback');
            echo json_encode($data);
            exit();
            break;

        case "/api/like":
            echo setLike((int)$post['id'], (string)$post['element']);
            exit();
            break;
    }

    return $params;
}

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

function getBdItems(string $element, string $column = '', string $sort = ''): array
{
    $items = getAssocResult('SELECT * FROM' . ' ' . $element . ($sort ? ' ORDER BY ' . $column . ' ' . $sort : ''));
    return $items;
}

function getCatalogImages(string $id): array
{
    $items = getAssocResult("SELECT * FROM `gallery_images` WHERE `model_id` = '$id'");
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

function render($page, $param = [])
{
    return renderTemplate(LAYOUTS_DIR . "layout", ['content' => renderTemplate($page, $param)]);
}

function renderTemplate($page, array $params = [])
{
    ob_start();

    extract($params);

    $filename = TEMPLATES_DIR . $page . ".php";

    if (file_exists($filename)) {
        include $filename;
    } else {
        die("Страницы не существует 404");
    }

    return ob_get_clean();
}

function renderMenu(array $items)
{
    $result = "";
    $subItems = [];
    $hasItems = 0;

    foreach ($items as $item) {

        foreach ($items as $subItem) {
            if ((int)$subItem['parent_id'] && (int)$subItem['parent_id'] == $item['id']) {
                array_push($subItems, $subItem);
                $hasItems = $item['id'];
            }
        }

        if ($hasItems != $item['id'] && !(int)$item['parent_id']) {
            $result .= "<li class='nav__item'>";
            $result .= "<a class='nav__link' href='{$item['url']}'>{$item['name']}</a>";
            $result .= "</li>";
        } elseif (!(int)$item['parent_id']) {
            $result .= "<li class='nav__item drop-down'>";
            $result .= "<a class='nav__link' href='{$item['url']}'>{$item['name']}</a>";
            $result .= renderDropDown($subItems);
            $result .= "</li>";
        }
    }

    return $result;
}

function renderDropDown(array $items): string
{
    $result = '';

    $result .= '<ul class="drop-down__items">';
    foreach ($items as $item) {
        $result .= "<li class='nav__item'><a class='nav__link' href='{$item['url']}'>{$item['name']}</a></li>";
    }
    $result .= '</ul>';

    return $result;
}