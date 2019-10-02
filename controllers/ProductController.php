<?php

namespace app\controllers;

use app\models\repositories\ProductRepository;

class ProductController extends Controller
{
    public function actionIndex() {
        echo $this->render('index');
    }

    public function actionCatalog() {
        $repo = new ProductRepository();
        $catalog = $repo->getAll();
        echo $this->render('catalog', ['catalog' => $catalog]);
    }


    public function actionCard() {
        $id = $_GET['id'];
        $repo = new ProductRepository();

        if ($id == 0) {
            throw new \Exception("Продукт не найден", 404);
        }
        $product = $repo->getOne($id);
        echo $this->render('card', ['product' => $product]);
    }



}