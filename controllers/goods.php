<?php
/**
 * Created by PhpStorm.
 * User: rogozhuk
 * Date: 29.08.19
 * Time: 18:09
 */

if (!isset($_COOKIE["cart"])) {
    setcookie("cart", json_encode([]), time() + 3600);
    if(isset($_COOKIE['cart'])){
        return $_COOKIE['cart'];
    }
}

function addToCart($id)
{
    if ($id) {
        $item = (object)getBdItem($id, 'catalog')[0];

        if ($item) {
            $images = (object)getImages($item->id, 'catalog')[0];

            $newItem = [
                'id' => $item->id,
                'count' => 1,
                'image' => $images->url,
                'name' => $item->name,
                'price' => $item->price,
            ];

            if(isset($_COOKIE['cart'])){
                $cartItems = json_decode($_COOKIE['cart'], true);
                $newCart = [];

                if(isset($cartItems)){
                    foreach ($cartItems as $cartItem){
                        if($cartItem['id'] == $item->id){
                            $cartItem['count']++;
                            array_push($newCart, $cartItem);
                        } else {
                            $updateItem = [
                                'id' => $cartItem['id'],
                                'count' => $cartItem['count'],
                                'image' => $cartItem['image'],
                                'name' => $cartItem['name'],
                                'price' => $cartItem['price'],
                            ];
                            array_push($newCart, $updateItem);
                        }
                        setcookie("cart", json_encode($newCart), time() + 3600);
                        return $newCart;
                    }
                } else {
                    array_push($newCart, $newItem);
                    setcookie("cart", json_encode($newCart), time() + 3600);
                    return $newCart;
                }
            }
        }
    }

    return false;
}

function getCartCount()
{
    $count = 0;

    if (isset($_COOKIE["cart"])) {
        $items = json_decode($_COOKIE["cart"], true);
        if(isset($items)){
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

    if (isset($_COOKIE["cart"])) {
        $items = json_decode($_COOKIE["cart"], true);
        if(isset($items)) {
            foreach ($items as $item) {
                $price += $item['price'];
            }
        }
    }
    return $price;
}

function clearCart()
{
    setcookie("cart");
    return true;
}

function getUserCartItems()
{
    $items = [];
    if (isset($_COOKIE["cart"])) {
        $items = json_decode($_COOKIE["cart"], true);
    }
    return $items;
}