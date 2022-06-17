<?php


use app\controllers\SiteController;
use app\core\Application;

require_once __DIR__ . '/../vendor/autoload.php';


$app = new Application(dirname(__DIR__));

//$app->router->get('/', 'home');

$app->router->get('/', [SiteController::class, 'home']);
$app->router->get('/contact', [SiteController::class, 'contact']);
$app->router->post('/contact', [SiteController::class, 'handleContact']);
$app->router->get('/login', [\app\controllers\AuthController::class, 'login']);
$app->router->post('/login', [\app\controllers\AuthController::class, 'login']);
$app->router->get('/register', [\app\controllers\AuthController::class, 'register']);
$app->router->post('/register', [\app\controllers\AuthController::class, 'register']);

$app->run();