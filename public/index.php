<?php

require __DIR__ . '/../vendor/autoload.php';

use Calinn\Saweb\Router\Router;
use Calinn\Saweb\Http\Controllers\AuthController;
use Calinn\Saweb\Http\Controllers\HomeController;

session_start();

define('BASEPATH', '/');

$homeController = new HomeController();
$authController = new AuthController();

Router::add('/', function () use ($homeController) {
    $homeController->index();
});

Router::add('/guest', function () use ($homeController) {
    $homeController->guest();
});
Router::add('/guest', function () use ($homeController) {
    $homeController->guestHandle();
}, 'post');
Router::add('/accounts', function () use ($homeController) {
    $homeController->accounts();
});

Router::add('/auth', function () use ($authController) {
    $authController->index();
});
Router::add('/register', function () use ($authController) {
    $authController->register();
});

Router::add('/logout', function () use ($authController) {
    $authController->logout();
});

Router::add('/auth', function () use ($authController) {
    $authController->signIn();
}, 'post');

Router::add('/register', function () use ($authController) {
    $authController->signUp();
}, 'post');

Router::pathNotFound(function ($path) {
    header('HTTP/1.0 404 Not Found');
    echo 'Error 404 :-(<br>';
    echo 'The requested path "' . $path . '" was not found!';
});

Router::methodNotAllowed(function ($path, $method) {
    header('HTTP/1.0 405 Method Not Allowed');
    echo 'Error 405 :-(<br>';
    echo 'The requested path "' . $path . '" exists. But the request method "' . $method . '" is not allowed on this path!';
});

Router::run(BASEPATH);
