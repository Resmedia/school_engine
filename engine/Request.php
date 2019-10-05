<?php


namespace app\engine;

class Request {
    protected $requestString;
    protected $method;
    protected $controllerName;
    protected $actionName;
    protected $params;

    public function __construct()
    {
        $this->requestString = $_SERVER['REQUEST_URI'];
        $this->parseRequest();
    }

    private function parseRequest() {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $url = explode('/', $this->requestString);
        $this->controllerName = $url[1];
        $this->actionName = isset($url[2]) ? $url[2] : '';
        $this->params = $_REQUEST;
        //парсинг json-post данных
        $data = json_decode(file_get_contents('php://input'));
        if (!is_null($data)) {
            foreach ($data as $key => $elem) {
                $this->params[$key] = $elem;
            }
        }
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @return mixed
     */
    public function getControllerName()
    {
        return $this->controllerName;
    }

    /**
     * @return mixed
     */
    public function getActionName()
    {
        return $this->actionName;
    }

    /**
     * @return mixed
     */
    public function getParams()
    {
        return $this->params;
    }

    public function redirect(string $location, $replace = null, $code = null)
    {
        header("Location: $location", $replace, $code);
    }

    public function post(string $value)
    {
        return isset($_POST[$value]) ? $_POST[$value] : false;
    }

    public function get(string $value)
    {
        return isset($_GET[$value]) ? $_GET[$value] : false;
    }

}