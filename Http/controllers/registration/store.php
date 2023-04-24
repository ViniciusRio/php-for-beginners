<?php

use Core\App;
use Core\Authenticator;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

$email = $_POST['email'];
$password = $_POST['password'];

$errors = [];
if (!Validator::email($email)) {
    $errors['email'] = 'Please provide a valid email address.';
}

if (!Validator::string($password, 7, 255)) {
    $errors['password'] = 'Please provide a password of at least seven characters.';
}

if (! empty($errors)) {
    return view('registration/create.view.php', [
        'errors' => $errors
    ]);
}

$user = $db->query('SELECT * FROM php_for_beginners.users WHERE email = :email', [
    ':email' => $email
])->find();

if ($user) {
    header('location: /register');
    exit();
} else {
    $db->query('INSERT INTO php_for_beginners.users(email,password) VALUES(:email, :password)', [
        ':email' =>$email,
        ':password' =>password_hash($password, PASSWORD_BCRYPT)
    ]);

    (new Authenticator)->login([
        'email' => $email
    ]);


    header('location: /');
    exit();
}