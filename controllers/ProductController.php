<?php

namespace app\controllers;

use app\engine\Request;
use app\models\Basket;
use app\models\Product;
use app\models\repositories\ProductRepository;

class ProductController extends Controller
{


    public function actionIndex() {
        echo $this->render('index');
    }

    public function actionCatalog() {
        $catalog = (new ProductRepository())->getAll();
        echo $this->render('catalog', ['catalog' => $catalog]);
    }


    public function actionCard() {
        $id = $_GET['id'];

        if ($id == 0) {
            throw new \Exception("Продукт не найден", 404);
        }

        $product = (new ProductRepository())->getOne($id);
        echo $this->render('card', ['product' => $product]);
    }



}