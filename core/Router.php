<?php

namespace Core;

class Router {
    public $routes = [];
    public function add($uri, $controller, $method) {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method,
            'middleware' => null
        ];

        return $this;
    }
    public function get($uri, $controller)
    {
        return $this->add($uri, $controller, 'GET');
    }
    public function post($uri, $controller)
    {
        return $this->add($uri, $controller, 'POST');
    }
    public function put($uri, $controller)
    {
        return $this->add($uri, $controller, 'PUT');
    }
    public function patch($uri, $controller)
    {
        return $this->add($uri, $controller, 'PATCH');

    }
    public function delete($uri, $controller)
    {
        return $this->add($uri, $controller, 'DELETE');
    }

    public function only($key)
    {
        $this->routes[array_key_last($this->routes)]['middleware'] = $key;

        dd($this->routes);


    }
    public function route($uri, $method)
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
               return require base_path($route['controller']);
            }
        }

        $this->abort(404);
    }

    public function abort($status = 404) {
        http_response_code(404);
        require base_path("views/{$status}.php");
        die();
    }
}