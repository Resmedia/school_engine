<?php

namespace app\controllers;

use app\models\Product;

class ProductController extends Controller
{

    public function actionIndex()
    {
        $model = Product::findAll(['status' => Product::STATUS_PUBLISHED]);

        echo $this->render('index', [
            'model' => $model
        ]);
    }

    public function actionView($id)
    {
        $model = Product::getOne($id);
        echo $this->render('view', [
            'model' => $model
        ]);
    }

    public function actionCard()
    {
        $id = $_GET['id'];
        $product = Product::getOne($id);
        echo $this->render('card', [
            'product' => $product
        ]);
    }
}