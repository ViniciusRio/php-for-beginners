<?php

$routes = require 'routes.php';

function abort($status = 404) {
    http_response_code(404);
    require "views/{$status}.php";
    die();
}

function routesToController($uri, $routes) {
    if (array_key_exists($uri, $routes)) {
        require $routes[$uri];
    } else {
        abort();
    }
}

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

routesToController($uri, $routes);