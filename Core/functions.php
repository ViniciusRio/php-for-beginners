<?php

use Core\Response;

function dd($value) {
    echo '<pre>';
    var_dump($value);
    echo '</pre>';

    die();
}

function urlIs($url) {
    return $_SERVER['REQUEST_URI'] === $url;
}

function authorize($condition, $status = Response::FORBIDDEN) {
    if (!$condition) {
        abort($status);
    }
}

function base_path($path) {
    return BASE_PATH . $path;
}

function view($path, $attributes = []): void
{
    extract($attributes);

    require base_path('views/'. $path);
}

function abort($status = 404) {
    http_response_code(404);
    require base_path("views/{$status}.php");
    die();
}

function login($user) {
    $_SESSION['user'] = [
        'email' => $user['email']
    ];

    session_regenerate_id(true);
}

function logout() {
    session_unset();
    session_destroy();

    $params = session_get_cookie_params();

    setcookie(
        'PHPSESSID',
         '',
        time() - 3600,
        $params['path'],
        $params['domain'],
        $params['secure'],
        $params['httponly']
    );
 }