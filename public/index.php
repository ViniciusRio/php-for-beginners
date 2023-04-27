<?php
use Core\Session;
use Core\Router;
use Core\Validation\NotFoundException;
use Core\Validation\ValidationException;

session_start();


const BASE_PATH = __DIR__ . '/../';

require BASE_PATH . 'Core/functions.php';

spl_autoload_register(function ($class) {
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    require base_path("{$class}.php");
});

require base_path('bootstrap.php');

$router = new Router();
$routes = require base_path('routes.php');

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

try {
    $router->route($uri, $method);
} catch (ValidationException $validationException) {
    Session::flash('errors', $validationException->errors);
    Session::flash('old', ['email' => $validationException->old['email']]);
    
    return redirect($router->previousUrl());
} catch (NotFoundException $exception) {
    Session::flash('errors', $exception->message());
    
    return redirect($router->previousUrl());
}

Session::unflash();