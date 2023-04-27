<?php

namespace Core\Validation;

class NotFoundException extends \Exception
{
    protected $message = [];
    
    public static function throw($message) 
    {
        $instance = new static;

        $instance->message['user'] = $message;

        throw $instance;

    }

    public function message() 
    {

        return $this->message;
    }
}