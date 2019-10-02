<?php


namespace app\engine;

class SessionException extends \Exception {

}

class Session {

    private $session = [];

    public function __construct()
    {
        $this->session = $_SESSION;
    }

    /**
     * @param string $value
     */
    public function getValue(string $value)
    {
        return isset($this->session[$value]) ? $this->session[$value] : false;
    }

    public function setValue(array $params) {
        if(!empty($params)) {
            foreach ($params as $key => $param) {
                $_SESSION[$key] = $param;
            }
        }
    }

    public function destroy(){
        session_destroy();
    }
}