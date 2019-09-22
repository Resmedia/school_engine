<?

include $_SERVER['DOCUMENT_ROOT'] . "/../config/config.php";
include $_SERVER['DOCUMENT_ROOT'] . "/../engine/Autoload.php";
include $_SERVER['DOCUMENT_ROOT'] . "/../config/url-manager.php";

spl_autoload_register([new Autoload(), 'loadClass']);

/** @var $routes */

$getUrl = substr($_SERVER['REQUEST_URI'], 1);
$returnArray = explode('/', $getUrl);
$request = explode('/', $routes['/' . $returnArray[0] . (isset($returnArray[1]) ? '/id' : '' )]);

if($routes['/' . $returnArray[0]]) {
    $controllerName = $request[0];
    $actionName = $request[1];
    $id = isset($returnArray[1]) ? $returnArray[1] : null;

    $controllerClass = CONTROLLER_NAMESPACE . ucfirst($controllerName) . "Controller";

    if (class_exists($controllerClass)) {
        $controller = new $controllerClass();
        $controller->runAction($actionName, $controllerName, $id);
    } else {
        echo "Неправильный контроллер";
    }
} else {
    throw new ErrorException('Страница не существует', 404);
}
