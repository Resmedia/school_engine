<?php

namespace app\controllers;

use app\engine\App;
use app\models\repositories\ProductRepository;

class ProductController extends Controller
{
    public function actionIndex() {
        echo $this->render('catalog/index');
    }

    public function actionCatalog() {
        $repo = new ProductRepository();
        $catalog = $repo->getAll();
        echo $this->render('catalog/catalog', ['catalog' => $catalog]);
    }

    public function actionCard() {
        $id = $_GET['id'];

        if ($id == 0) {
            throw new \Exception("Продукт не найден", 404);
        }
        $product = App::call()->productRepository->getOne($id);
        echo $this->render('catalog/view', ['product' => $product]);
    }
}