<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

spl_autoload_register(function (string $className){
    require_once('../src/'.str_replace('\\', '/', $className).'.php');
});

$route = $_GET['route'] ?? "";
echo $route;
$routes = require_once('../src/routes.php');
$isRouteFound = false;

foreach($routes as $pattern=>$controllerAndAction){
    preg_match($pattern, $route, $matches);
    if (!empty($matches)){
        $isRouteFound = true;
        break;
    }
}
if (!$isRouteFound){
    $view = new View\View(__DIR__.'/../templates');
    $view->renderHtml('errors/404.php', [], 404);
    return;
}


unset($matches[0]);
$controllerName = $controllerAndAction[0];
$actionName = $controllerAndAction[1];

$controller = new $controllerName;
$controller->$actionName(...$matches);
