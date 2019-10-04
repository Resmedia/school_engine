<?php

namespace app\controllers;

use app\models\entities\Basket;
use app\models\entities\Goods;
use app\models\entities\Order;
use app\models\repositories\BasketRepository;
use app\models\repositories\GoodsRepository;
use app\models\repositories\OrderRepository;

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

    public function actionOrder()
    {
        $name = strip_tags(stripslashes($this->request->post('name')));
        $email = strip_tags(stripslashes($this->request->post('email')));
        $phone = strip_tags(stripslashes($this->request->post('phone')));
        $address = strip_tags(stripslashes($this->request->post('address')));
        $description = strip_tags(stripslashes($this->request->post('description')));
        $goods = $this->request->post('goods');

        if (!$phone || !$address || !$name) {
            throw new \Exception('Нет основных аттрибутов', 500);
        } else {

            $order = new Order();
            $orderRepo = new OrderRepository();
            $order->name = $name;
            $order->email = $email;
            $order->phone = $phone;
            $order->address = $address;
            $order->description = $description;
            $order->session_id = $this->session->getId();
            $order->user_id = 0;
            $order->time_create = time();
            $order->time_update = time();
            $orderRepo->save($order);

            $savedOrder = $orderRepo->getWhere('session_id', $this->session->getId());

            $goodsRepo = new GoodsRepository();
            $basket = new BasketRepository();
            if (!empty($goods)) {
                foreach ($goods[0] as $good) {
                    $newGood = new Goods();
                    $newGood->order_id = $savedOrder->id;
                    $newGood->product_id = $good;
                    $goodsRepo->save($newGood);
                    // TODO Look why not delet
                    $basket->deleteById(intval($good));
                }
            }

            $result = [
                'status' => true,
                'order_id' => $savedOrder->id,
            ];

            echo json_encode($result);
        }
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