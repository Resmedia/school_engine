<?

include $_SERVER['DOCUMENT_ROOT'] . "/../config/config.php";
include $_SERVER['DOCUMENT_ROOT'] . "/../engine/Autoload.php";
include $_SERVER['DOCUMENT_ROOT'] . "/../config/url-manager.php";

spl_autoload_register([new Autoload(), 'loadClass']);

/** @var $routes */

$getUrl = substr($_SERVER['REQUEST_URI'], 1);
$request = explode('/', $routes['/' . $getUrl]);

if($request[0]) {
    $controllerName = $request[0];
    $actionName = $request[1];

    $controllerClass = CONTROLLER_NAMESPACE . ucfirst($controllerName) . "Controller";

    if (class_exists($controllerClass)) {
        $controller = new $controllerClass();
        $controller->runAction($actionName, $controllerName);
    } else {
        echo "Неправильный контроллер";
    }
} else {
    throw new ErrorException('Страница не существует', 404);
}
