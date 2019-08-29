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
                $params = [
                    'page' => 'error',
                    'code' => 404,
                ];
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
                $params = [
                    'page' => 'error',
                    'code' => 404,
                ];
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

        default:
            $params = [
                'page' => 'error',
                'code' => 404,
            ];
    }

    return $params;
}