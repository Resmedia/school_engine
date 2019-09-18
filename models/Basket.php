<?php


namespace app\models;


class Basket extends Model
{
    public $id;
    public $session_id;
    public $product_id;
    public $user_id;
    public $time_create;
    public $time_update;

    public function getTableName() {
        return 'basket';
    }

    public function getUser(): array
    {
        $user = new User();
        return $user->findOne(['id' => $this->user_id]);
    }

    public function getProducts(): array
    {
        $product = new User();
        return $product->findAll(['id' => $this->product_id]);
    }

    public function getSession()
    {

    }
}