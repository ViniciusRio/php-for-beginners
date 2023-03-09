<?php

namespace Core;
class Container
{
    protected $bindings = [];

    public function bind($key, $fn)
    {
        $this->bindings[$key] = $fn;
    }

    public function resolve($key)
    {
        if (!array_key_exists($key, $this->bindings)) {
            throw new Exception("Not matching binding for {$key}");
        }

        return call_user_func($this->bindings[$key]);
    }
}