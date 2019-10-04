<?php


namespace app\models\entities;

/**
 * Basket constructor.
 * @param int $order_id
 * @param int $product_id
 */

class Goods extends DataEntity
{
    public $id;
    public $order_id;
    public $product_id;

    public function __construct(
        $id = null,
        $order_id = null,
        $product_id = null
    )
    {
        $this->id = $id;
        $this->order_id = $order_id;
        $this->product_id = $product_id;
    }
}