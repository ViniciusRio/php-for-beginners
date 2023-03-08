<?php

namespace Core;

class Router {
    public $routes = [];
    public function add($uri, $controller, $method) {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method,
        ];
    }
    public function get($uri, $controller)
    {
        $this->add($uri, $controller, 'GET');
    }
    public function post($uri, $controller)
    {
        $this->add($uri, $controller, 'POST');
    }
    public function put($uri, $controller)
    {
        $this->add($uri, $controller, 'PUT');
    }
    public function patch($uri, $controller)
    {
        $this->add($uri, $controller, 'PATCH');

    }
    public function delete($uri, $controller)
    {
        $this->add($uri, $controller, 'DELETE');
    }

    public function route($uri, $method) : void
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
                require base_path($route['controller']);
            }
        }

        $this->abort();
    }

    public function abort($status = 404) {
        http_response_code(404);
        require base_path("views/{$status}.php");
        die();
    }
}