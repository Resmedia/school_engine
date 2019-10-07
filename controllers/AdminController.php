<?php

namespace app\controllers;

use app\engine\App;
use Exception;

class AdminController extends Controller
{
    public function actionIndex() {
        if(!App::call()->userRepository->isAdmin()){
            throw new Exception('Вы не администратор!', 403);
        }
        $models = App::call()->orderRepository->getAll();
        echo $this->render('admin/index', ['models' => $models]);
    }

    public function actionView() {
        if(!App::call()->userRepository->isAdmin()){
            throw new Exception('Вы не администратор!', 403);
        }
        $id = App::call()->request->get('id');

        if ($id == 0) {
            throw new Exception("Продукт не найден", 404);
        }
        $product = App::call()->orderRepository->getOne($id);
        echo $this->render('admin/view', ['model' => $product]);
    }
}