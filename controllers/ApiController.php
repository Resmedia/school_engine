<?php

namespace app\controllers;

use app\models\entities\Basket;
use app\models\repositories\BasketRepository;

class ApiController extends Controller
{
    public function actionAddBasket()
    {
        $repo = new BasketRepository();

        $repo->save(new Basket(session_id(), $this->request->getParams()['id']));

        $response = [
            'result' => 1,
            'count' => $repo->getCountWhere('session_id', session_id())
        ];
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }

    public function actionRemoveFromBasket()
    {
        $repo = new BasketRepository();

        $id = $this->request->getParams()['id'];
        $session = session_id();

        $repo->deleteByIdWhere($id, 'session_id', $session);

        $response = [
            'result' => 1,
            'count' => $repo->getCountWhere('session_id', $session)
        ];

        header('Content-Type: application/json');
        echo json_encode($response);

        exit;
    }
}