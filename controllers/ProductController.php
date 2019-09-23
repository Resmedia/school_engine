<?php

namespace app\controllers;

use app\models\Product;

class ProductController extends Controller
{

    public function actionIndex()
    {
        $limit = isset($_POST['limit']) ? $_POST['limit'] : 5;
        /** @var $models \app\models\Product */
        if(isset($_POST['limit'])) {
            $models = Product::getLimit(intval($limit));
            return json_encode($models);
        } else {
            $models = Product::getLimit(intval($limit));
        }

        echo $this->render('index', [
            'models' => $models
        ]);
    }

    public function actionView($id)
    {
        if (!$id) {
            return false;
        }
        /** @var $model \app\models\Product */
        $model = Product::getOne($id);

        $model->views += 1;
        $model->save();

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