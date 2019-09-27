<?

require(__DIR__ . "/../config/config.php");
require(__DIR__ . "/../engine/Autoload.php");
require(__DIR__ . "/../config/url-manager.php");
require(__DIR__ . '/../vendor/autoload.php');

$loader = new \Twig\Loader\FilesystemLoader(TEMPLATES_TWIG_DIR);

spl_autoload_register([new Autoload(), 'loadClass']);

$twig = new \Twig\Environment($loader, ['debug' => true]);

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
        if($controllerName == 'page') {
            $controller->runTwigAction($actionName, $controllerName, $id, $twig);
        } else {
            $controller->runAction($actionName, $controllerName, $id);
        }

    } else {
        echo "Неправильный контроллер";
    }
} else {
    throw new ErrorException('Страница не существует', 404);
}
