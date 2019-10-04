<?php


namespace app\controllers;

use app\engine\Cookies;
use app\engine\Request;
use app\engine\Session;
use app\interfaces\IRenderer;
use app\models\repositories\BasketRepository;
use app\models\repositories\UserRepository;

abstract class Controller
{
    private $action;
    private $defaultAction = "index";
    private $layout = 'main';
    private $useLayouts = true;
    private $renderer;

    public $session;
    public $cookies;
    public $request;

    /**
     * Controller constructor.
     * @param $renderer
     */
    public function __construct(IRenderer $renderer = null)
    {
        $this->cookies = new Cookies();
        $this->session = new Session();
        $this->request = new Request();
        $this->renderer = $renderer;
    }

    public function runAction($action = null)
    {
        $this->action = $action ?: $this->defaultAction;
        $method = "action" . ucfirst($this->action);

        if (method_exists($this, $method)) {
            $this->$method();
        } else {
            throw new \Exception('Ошибка запуска', 500);
        }
    }

    public function render($template, $params = [])
    {
        $user = new UserRepository();
        $basket = new BasketRepository();

        if ($this->useLayouts) {
            return $this->renderTemplate("layouts/{$this->layout}", [
                'content' => $this->renderTemplate($template, $params),
                'auth' => $user->isAuth(),
                'username' => $user->getName(),
                'menu' => $this->renderTemplate('menu', [
                    'count' => $basket->getCountWhere('session_id', session_id())

                ])
            ]);
        } else {
            return $this->renderTemplate($template, $params);
        }
    }

    public function renderTemplate($template, $params = [])
    {
        return $this->renderer->renderTemplate($template, $params);
    }

}