<?php 

namespace Model;
use Core\App;
use Core\Database;
use Core\Session;
use Core\Validation\NotFoundException;

class User
{
    protected $user;

    public function matchCredencials() 
    {
        $this->user = App::resolve(Database::class)->query('SELECT id FROM php_for_beginners.users WHERE email = :email', [
            ':email' => Session::get('user')['email']
        ])->find();

        $this->failed();


        return $this->user;
    }

    public function throw($message)
    {
        NotFoundException::throw($message);
    }

    private function failed() 
    {
        $this->user ? null : $this->throw('Usuário não encontrado');
    }
}