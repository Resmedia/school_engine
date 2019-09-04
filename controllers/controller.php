<?php
/*
 * Функция подготовки переменных для передачи их в шаблон
 */
function prepareVariables($url, $id, $post)
{
    switch ($url) {
        case '/':
            $params = [
                'page' => 'page/main',
            ];
            break;

        case '/gallery':
            $params = [
                'page' => 'gallery/index',
                'images' => getBdItems('images', 'likes', 'DESC')
            ];
            break;

        case '/login':
            $params = [
                'page' => 'user/login',
                'result' => $post ? login($post['email'], $post['pass']) : '',
                'user' => getAdminUser(),
            ];
            break;

        case '/logout':
            logout();
            exit();
            break;

        case '/registration':
            $params = [
                'page' => 'user/registration',
                'result' => $post ? signUp($post['name'], $post['email'], $post['pass']) : '',
                'user' => getAdminUser(),
            ];
            break;

        case "/gallery/$id":
            if (getBdItem($id, 'images')) {
                $params = [
                    'page' => 'gallery/view',
                    'messages' => [
                        'message' => '',
                        'items' => getFeedBackMessages(+$id, 'images')
                    ],
                    'image' => getItemContent(+$id, 'images'),
                ];
            } else {
                $params = [
                    'page' => 'page/error',
                    'code' => 404,
                ];
            }
            break;

        case '/catalog':
            $params = [
                'page' => 'catalog/index',
                'catalog' => getBdItems('catalog', 'id', 'ASC'),
                'name' => "Каталог товаров"
            ];
            break;

        case "/catalog/$id":
            if (getBdItem($id, 'catalog')) {
                $params = [
                    'page' => 'catalog/view',
                    'messages' => [
                        'message' => '',
                        'items' => getFeedBackMessages(+$id, 'catalog')
                    ],
                    'item' => getItemContent(+$id, 'catalog'),
                ];
            } else {
                $params = [
                    'page' => 'page/error',
                    'code' => 404,
                ];
            }
            break;

        case '/cart':
            $params = [
                'page' => 'cart/index',
                'items' => getUserCartItems(),
            ];
            break;

        case "/contacts":
            if (getBdItem('contacts', 'pages')) {
                $params = [
                    'page' => 'page/contacts',
                    'item' => getBdItem('contacts', 'pages'),
                ];
            } else {
                $params = [
                    'page' => 'page/error',
                    'code' => 404,
                ];
            }
            break;

        case "/api/add-to-cart":
            $result = addToCart((int)$post['id']);
            echo json_encode($result);
            exit();
            break;

        case "/api/clear-cart":
            $result = clearCart();
            echo json_encode($result);
            exit();
            break;

        case "/api/remove-from-cart":
            $result = removeFromCart((int)$post['id']);
            echo json_encode($result);
            exit();
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

        case "/cabinet/catalog":
            if (getAdminUser()) {
                $params = [
                    'page' => 'admin/catalog/index',
                    'items' => getBdItems('catalog')
                ];
            } else {
                $params = [
                    'page' => 'page/error',
                    'code' => 403,
                ];
            }
            break;

        case "/cabinet/catalog/update":
            if (getAdminUser()) {
                $params = [
                    'page' => 'admin/catalog/update',
                ];
            } else {
                $params = [
                    'page' => 'page/error',
                    'code' => 403,
                ];
            }
            break;

        case "/api/catalog/update":
            if (getAdminUser()) {
                actionItems('update', 'catalog', $post);
                exit();
                break;
            } else {
                $params = [
                    'page' => 'page/error',
                    'code' => 403,
                ];
            }
            break;

        case "/api/catalog/create":
            if (getAdminUser()) {
                actionItems('create', 'catalog', $post);
                exit();
                break;
            } else {
                $params = [
                    'page' => 'page/error',
                    'code' => 403,
                ];
            }
            break;

        case "/api/catalog/remove/$id":
            if (getAdminUser()) {
                actionItems('remove', 'catalog', null, $id);
                exit();
                break;
            } else {
                $params = [
                    'page' => 'page/error',
                    'code' => 403,
                ];
            }
            break;

        case "/cabinet/catalog/update/$id":
            if (getAdminUser()) {
                $params = [
                    'page' => 'admin/catalog/update',
                    'item' => getItemContent(+$id, 'catalog'),
                ];
            } else {
                $params = [
                    'page' => 'page/error',
                    'code' => 403,
                ];
            }
            break;

        case "/cabinet/users":
            if (getAdminUser()) {
                $params = [
                    'page' => 'admin/users/index',
                    'users' => getBdItems('users')
                ];
            } else {
                $params = [
                    'page' => 'page/error',
                    'code' => 403,
                ];
            }
            break;

        case "/cabinet/gallery":
            if (getAdminUser()) {
                $params = [
                    'page' => 'admin/gallery/index',
                    'images' => getBdItems('images'),
                    'gallery' => getBdItems('gallery_images'),
                ];
            } else {
                $params = [
                    'page' => 'page/error',
                    'code' => 403,
                ];
            }
            break;

        case "/cabinet/feedback":
            if (getAdminUser()) {
                $params = [
                    'page' => 'admin/feedback/index',
                    'images' => getBdItems('images'),
                    'gallery' => getBdItems('gallery_images'),
                ];
            } else {
                $params = [
                    'page' => 'page/error',
                    'code' => 403,
                ];
            }
            break;

        default:
            $params = [
                'page' => 'page/error',
                'code' => 404,
            ];
    }

    return $params;
}