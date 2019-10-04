<?php


namespace app\engine;

class Cookies {

    private $cookies = [];

    public function __construct()
    {
        $this->cookies = $_COOKIE;
    }

    /**
     * @param string $value
     */
    public function getValue($value)
    {
        return isset($this->cookies[$value]) ? $this->cookies[$value] : false;
    }

    /**
     * @param mixed $name
     * @param mixed $value
     * @param mixed $expire
     * @param mixed $path
     * @param mixed $domain
     * @param mixed $secure
     * @param mixed $httpOnly
     */
    public function setCookies(
        $name,
        $value,
        $expire = null,
        $path = null,
        $domain = null,
        $secure = null,
        $httpOnly = null
    )
    {
        if(setcookie($name, $value, $expire, $path, $domain, $secure, $httpOnly)) {
            return true;
        };

        throw new \Exception('Ошибка Cookies');
    }

}