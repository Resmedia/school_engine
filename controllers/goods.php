<?php
/**
 * Created by PhpStorm.
 * User: rogozhuk
 * Date: 29.08.19
 * Time: 18:09
 */
//unset($_SESSION["cart"]);

if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = [];
}

function addToCart(int $id)
{
    if ($id) {
        $id = intval($id);
        $item = (object)getBdItem($id, 'catalog')[0];

        if ($item) {
            $itemId = intval($item->id);
            $newItem = [
                'id' => $itemId,
                'count' => 1,
            ];

            if (isset($_SESSION['cart'])) {
                if (count($_SESSION['cart'])) {
                    foreach ($_SESSION['cart'] as $key => $cartItem) {
                        if ($cartItem['id'] == $itemId) {
                            $_SESSION['cart'][$key]['count']++;
                            return $_SESSION['cart'];
                        }
                    };

                    array_push($_SESSION['cart'], $newItem);
                    return $_SESSION['cart'];

                } else {
                    array_push($_SESSION['cart'], $newItem);
                    return $_SESSION['cart'];
                }

            } else {
                $_SESSION["cart"] = [];
                array_push($_SESSION['cart'], $newItem);
                return $_SESSION['cart'];
            }
        }
    }

    return false;
}

function removeFromCart(int $id)
{
    if ($id) {
        $id = intval($id);
        if (isset($_SESSION['cart'])) {
            if (count($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $key => $cartItem) {
                    if ($cartItem['id'] == $id) {
                        if ($cartItem['count'] > 1) {
                            --$_SESSION['cart'][$key]['count'];
                        } else {
                            unset($_SESSION['cart'][$key]);
                        }
                    }
                }

                return getUserCartItems();
            }
        }
    }

    return false;
}

function getCartCount()
{
    $count = 0;

    if (isset($_SESSION["cart"])) {
        $items = $_SESSION["cart"];
        if (isset($items)) {
            foreach ($items as $item) {
                $count += $item['count'];
            }
        }

    }
    return $count;
}

function getTotalPrice()
{
    $price = 0;

    if (isset($_SESSION["cart"])) {
        $items = $_SESSION["cart"];
        if (isset($items)) {
            foreach ($items as $item) {
                $bdItem = (object)getBdItem($item['id'], 'catalog')[0];
                $price += $bdItem->price * $item['count'];
            }
        }
    }
    return $price;
}

function clearCart()
{
    unset($_SESSION["cart"]);
    return true;
}

function getUserCartItems()
{
    $bdItems = [];
    if (isset($_SESSION["cart"])) {
        $items = $_SESSION["cart"];
        foreach ($items as $item) {
            $bdItem = (object)getBdItem($item['id'], 'catalog')[0];
            $bdImage = (object)getImages($bdItem->id, 'catalog')[0];
            $newItem = [
                'id' => $bdItem->id,
                'image' => $bdImage->url,
                'count' => $item['count'],
                'price' => $bdItem->price,
                'name' => $bdItem->name,
            ];
            array_push($bdItems, $newItem);
        }
    }
    return $bdItems;
}