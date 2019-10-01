<?php


namespace app\controllers;

use app\models\repositories\BasketRepository;

class BasketController extends Controller
{
    public function actionIndex()
    {
        echo $this->render('basket', [
            'products' => (new BasketRepository())->getBasket(session_id())]);
    }
}