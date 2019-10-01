<?php

namespace app\controllers;


use app\engine\Request;
use app\models\entities\Basket;
use app\models\repositories\BasketRepository;

class ApiController extends Controller
{
    public function actionAddBasket()
    {

        (new BasketRepository())->save(new Basket(session_id(), (new Request())->getParams()['id']));


        $response = [
            'result' => 1,
            'count' => (new BasketRepository())->getCountWhere('session_id', session_id())
        ];
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }

    public function actiondelFromBasket()
    {

        $id = (new Request())->getParams()['id'];
        $session = session_id();
        /*
        $basket = Basket::getOne($id);
        if ($session == $basket->session_id)
            $basket->delete();
        */
//DELETE FROM basket WHERE id=1 AND session_id='23123';
        //Вариант оптимальный

        (new BasketRepository())->deleteByIdWhere($id, 'session_id', $session);


        $response = [
            'result' => 1,
            'count' => (new BasketRepository())->getCountWhere('session_id', $session)
        ];

        header('Content-Type: application/json');
        echo json_encode($response);

        exit;
    }
}