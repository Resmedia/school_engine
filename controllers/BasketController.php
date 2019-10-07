<?php


namespace app\controllers;

use app\models\repositories\BasketRepository;

class BasketController extends Controller
{
    public function actionIndex()
    {
        $repo = new BasketRepository();
        echo $this->render('basket/index', [
            'products' => $repo->getBasket(session_id())]);
    }
}