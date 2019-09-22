<?php
/**
 * Created by PhpStorm.
 * User: rogozhuk
 * Date: 22.09.19
 * Time: 15:23
 */

namespace app\controllers;


use app\models\Menu;

class PageController extends Controller
{
    public function actionIndex() {
        $menu = Menu::findAll(['status' => Menu::STATUS_PUBLISHED]);
        echo $this->render('index', [
            'menu' => $menu,
        ]);
    }
}