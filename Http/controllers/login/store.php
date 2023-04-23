<?php

use Core\App;
use Core\Database;
use Http\Forms\LoginForm;

$db = App::resolve(Database::class);

$email = $_POST['email'];
$password = $_POST['password'];

$form = new LoginForm();
if (!$form->validate($email, $password)) {
    return view('login/create.view.php', [
        'errors' => $form->errors()
    ]);

}

$user = $db->query('SELECT * FROM php_for_beginners.users WHERE email = :email', [
    ':email' => $email
])->find();

if($user) {
    if(password_verify($password, $user['password'])) {
        login([
            'email' => $email
        ]);
    
        header('Location: /');
        exit();
    }
}

return view('login/create.view.php', [
    'errors' => [
        'login_fail' => 'No matching account found for that email or password.' 
    ]
]);


