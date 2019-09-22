<?php


namespace app\controllers;

use app\models\Menu;

abstract class Controller
{
    private $action;
    private $defaultAction = "index";
    private $layouts = "layouts";
    private $layout = 'main';
    private $useLayouts = true;
    private $controller;

    public function runAction($action = null, $controller = null, $id = null) {
        $this->action = $action ?: $this->defaultAction;
        $this->controller = $controller;
        $method = "action" . ucfirst($this->action);
        if (method_exists($this, $method)) {
            $this->$method($id);
        } else {
            echo "404";
        }
    }

    public function render($page, $params = []) {
        if ($this->useLayouts) {
            // TODO Move it to Main controller
            $menu = Menu::findAll(['status' => Menu::STATUS_PUBLISHED]);
            return $this->renderTemplate("{$this->layout}", [
                'content' => $this->renderTemplate($page, $params),
                'menu' => $menu
            ]);
        } else {
            return $this->renderTemplate($page, $params);
        }
    }

    public function renderTemplate($page, $params = []) {
        ob_start();
        extract($params);
        $templatePath = TEMPLATES_DIR . ($page == $this->layout ?
                $this->layouts . DIRECTORY_SEPARATOR . $page . ".php" :
                $this->controller . DIRECTORY_SEPARATOR  . $page . ".php"
            );
        include $templatePath;
        return ob_get_clean();
    }
}