<?php


namespace app\models\repositories;


use app\models\entities\Goods;
use app\models\Repository;

class GoodsRepository extends Repository
{

    public function getTableName()
    {
        return 'goods';
    }

    public function getEntityClass()
    {
        return Goods::class;
    }
}