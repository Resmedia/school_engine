<?php


namespace app\models\repositories;

use app\engine\App;
use app\models\entities\Order;
use app\models\Repository;

class OrderRepository extends Repository
{

    public function getTableName()
    {
        return 'orders';
    }

    public function getEntityClass()
    {
        return Order::class;
    }

    public function getStatus($status)
    {
        switch ($status) {
            case Order::STATUS_ACTIVE:
                return 'Новый';
            case Order::STATUS_DONE:
                return 'Выполнен';
            default:
                return 'Неизвестно';
        }
    }

    public function getOrderGoods($id)
    {
        if(!$id){
            throw new \Exception("ID обязательный параметр для получения товаров", 500);
        }
        $goodsArray = [];
        $order = $this->getOne($id);
        $goods = App::call()->goodsRepository;
        $products = App::call()->productRepository;
        $items = $goods->getWhereAll('order_id', $order->id);

        foreach ($items as $item) {
            $goodsArray[] = $products->getWhere('id', $item['product_id']);
        }

        return $goodsArray;
    }
}