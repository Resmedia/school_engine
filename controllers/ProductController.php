<?php

namespace app\controllers;

use app\models\Product;

class ProductController extends Controller
{

    public function actionIndex()
    {
        $models = Product::findAll(['status' => Product::STATUS_PUBLISHED]);

        echo $this->render('index', [
            'models' => $models
        ]);
    }

    public function actionView($id)
    {
        if (!$id) {
            return false;
        }
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