<?php
/**
 * Created by PhpStorm.
 * User: rogozhuk
 * Date: 22.09.19
 * Time: 15:23
 */

namespace app\controllers;

use app\models\Menu;
use app\models\Pages;

class PageController extends Controller
{
    public function actionIndex() {

        echo $this->render('index');
    }

    public function actionContacts($id = null, $twig) {
        $menu = Menu::findAll(['status' => Menu::STATUS_PUBLISHED]);
        $model = Pages::findOne([
            'url' => 'contacts',
            'status' => Pages::STATUS_PUBLISHED,
        ]);

        echo $twig->render('index.tmpl', [
            'model' => (object)$model,
            'menu' => $menu
        ]);
    }
}