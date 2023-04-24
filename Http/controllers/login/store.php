<?php

use Core\Authenticator;
use Core\Session;
use Http\Forms\LoginForm;


$email = $_POST['email'];
$password = $_POST['password'];

$form = new LoginForm();

if ($form->validate($email, $password)) {

    if ((new Authenticator)->attempt($email, $password)) {
        redirect("/");
    }
    
    $form->error('login_fail', 'No matching account found for that email or password.');

}

Session::flash('errors', $form->errors());
Session::flash('old', ['email' => $email]);

return redirect('/login');
