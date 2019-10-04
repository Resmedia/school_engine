<?php


namespace app\models\repositories;

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

    public function getOrderGoods($id): array
    {
        if(!$id){
            throw new \Exception("ID обязательный параметр для получения товаров", 500);
        }
        $order = $this->getOne($id);
        $goods = new GoodsRepository();
        $result = $goods->getWhere('id', $order->id);

        return $result;
    }
}