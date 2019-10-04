<?
session_start();

use app\engine\Render;
use app\engine\Request;

try {

    include $_SERVER['DOCUMENT_ROOT'] . "/../config/config.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/../vendor/autoload.php";

    $request = new Request();

    $controllerName = $request->getControllerName() ?: 'product';
    $actionName = $request->getActionName();

    $controllerClass = CONTROLLER_NAMESPACE . ucfirst($controllerName) . "Controller";

    if (class_exists($controllerClass)) {
        $controller = new $controllerClass(new Render());
        $controller->runAction($actionName);
    } else {
        echo "Не правильный контроллер";
    }
}
catch (\PDOException $e) {
    var_dump("Ошибка PDO");
}

catch (\Exception $e) {
    var_dump($e);
    var_dump($e->getTrace());
}

