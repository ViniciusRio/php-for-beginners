<?php

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$routers = [
    '/' => 'controllers/index.php',
    '/about' => 'controllers/about.php',
    '/contact' => 'controllers/contact.php'
];

routesToController($uri, $routers);
function abort($status = 404) {
    http_response_code(404);
    require "views/{$status}.php";
    die();
}

function routesToController($uri, $routers) {
    if (array_key_exists($uri, $routers)) {
        require $routers[$uri];
    } else {
        abort();
    }
}