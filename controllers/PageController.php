<?php

namespace app\controllers;

use app\models\repositories\PageRepository;

class PageController extends Controller
{
    public function actionContact() {
        $id = $_GET['id'];
        $repo = new PageRepository();
        if ($id == 0) {
            throw new \Exception("Страница не найдена", 404);
        }
        $model = $repo->getOne($id);
        echo $this->render('page/contact', ['model' => $model]);
    }
}