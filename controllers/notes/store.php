<?php

use Core\App;
use Core\Database;
use Core\Validator;

require base_path('core/Validator.php');

$db = App::resolve(Database::class);

$minCharacters = 1;
$maxCharacters = 100;
$errors = [];

if (!Validator::string($_POST['body'], $minCharacters, $maxCharacters)) {
    $errors['body'] = 'A body of no more than 100 characters is required';
}

if (!empty($errors)) {
    return require view('notes/create.view.php', [
        'heading' => 'Create Note',
        'errors' => $errors
    ]);
}

$db->query('INSERT INTO notes(body, user_id) VALUES(:body, :user_id)', [
    ':body' => $_POST['body'],
    ':user_id' => 3
]);

header('location: /notes');

exit();
