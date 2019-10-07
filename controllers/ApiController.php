<?php

namespace app\controllers;

use app\engine\App;
use app\models\entities\Basket;
use app\models\entities\Goods;
use app\models\entities\Order;
use Exception;

class ApiController extends Controller
{
    public function actionAddBasket()
    {
        $repo = App::call()->basketRepository;

        $repo->save(new Basket(session_id(), App::call()->request->getParams()['id']));

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
        $name = strip_tags(stripslashes(App::call()->request->post('name')));
        $email = strip_tags(stripslashes(App::call()->request->post('email')));
        $phone = strip_tags(stripslashes(App::call()->request->post('phone')));
        $address = strip_tags(stripslashes(App::call()->request->post('address')));
        $description = strip_tags(stripslashes(App::call()->request->post('description')));
        $goods = App::call()->request->post('goods');

        if (!$phone || !$address || !$name) {
            throw new \Exception('Нет основных аттрибутов', 500);
        } else {

            $existOrder = App::call()->orderRepository->getWhere('session_id', App::call()->session->getId());
            $savedOrder = null;

            if(empty($existOrder) ||
                (!empty($existOrder) && $existOrder->status == Order::STATUS_DONE)
            ) {
                $order = new Order();
                $orderRepo = App::call()->orderRepository;
                $order->name = $name;
                $order->email = $email;
                $order->phone = $phone;
                $order->address = $address;
                $order->description = $description;
                $order->session_id = App::call()->session->getId();
                $order->user_id = 0;
                $order->status = Order::STATUS_ACTIVE;
                $order->time_create = time();
                $order->time_update = time();
                $orderRepo->save($order);

                $savedOrder = $orderRepo->getWhere('session_id', App::call()->session->getId());
            }

            $id = !empty($existOrder) && $existOrder->status != Order::STATUS_DONE ? $existOrder->id : $savedOrder->id;

            $goodsRepo = App::call()->goodsRepository;
            if (!empty($goods)) {
                foreach ($goods as $good) {
                    $newGood = new Goods();
                    $newGood->order_id = $id;
                    $newGood->product_id = $good['id_prod'];
                    $goodsRepo->save($newGood);
                }

                $this->actionCleanBasket();

                $result = [
                    'status' => true,
                    'order_id' => $id,
                ];

                echo json_encode($result);
            }
        }
    }

    public function actionCleanBasket()
    {
        $repo = App::call()->basketRepository;

        $session = session_id();

        $repo->deleteAllWhere('session_id', $session);

        return true;
    }

    public function actionRemoveFromBasket()
    {
        $repo = App::call()->basketRepository;

        $id = App::call()->request->getParams()['id'];
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

    public function actionRemoveOrder()
    {
        if(!App::call()->userRepository->isAdmin()){
            throw new Exception('Вы не администратор!', 403);
        }

        $id = (int)App::call()->request->post('id');
        if($id){
            App::call()->orderRepository->deleteById($id);
            App::call()->goodsRepository->deleteAllWhere('order_id', $id);

            echo json_encode(['status' => true]);
            return true;
        }
        throw new Exception("Нет такого продукта", 404);
    }

    public function actionOrderDone()
    {
        if(!App::call()->userRepository->isAdmin()){
            throw new Exception('Вы не администратор!', 403);
        }

        $id = (int)App::call()->request->post('id');
        if($id){
            $order = new Order();
            $order->id = $id;
            $order->status = Order::STATUS_DONE;
            App::call()->orderRepository->save($order);

            echo json_encode(['status' => true]);
            return true;
        }
        throw new \Exception("Нет такого продукта", 404);
    }
}