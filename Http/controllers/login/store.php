<?php

use Core\Authenticator;
use Http\Forms\LoginForm;

$form = LoginForm::validate($attributes = [
    'email' => $_POST['email'],
    'password' => $_POST['password']
]);

$isSingd = (new Authenticator)->attempt($attributes['email'], $attributes['password']);

if(!$isSingd) {
    $form->error('login_fail', 'No matching account found for that email or password.')->throw();
}

redirect('/');
