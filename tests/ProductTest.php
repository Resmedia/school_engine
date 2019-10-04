<?php


namespace app\tests;

use app\models\entities\Product;
use PHPUnit\Framework\TestCase;


class ProductTest extends TestCase
{
    public function testProduct() {
        $name = "Чай";
        $product = new Product($name, "Цейлонский", 55);
        $this->assertEquals($name, $product->name);
    }
}