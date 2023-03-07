<?php

use Core\Database;
use Core\Validator;

require base_path('core/Validator.php');

$config = require base_path('config.php');
$db = new Database($config['database']);
$minCharacters = 1;
$maxCharacters = 100;
$errors = [];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $validator = new Validator();

    if (!Validator::string($_POST['body'], $minCharacters, $maxCharacters)) {
        $errors['body'] = 'A body of no more than 100 characters is required';
    }

    if (empty($errors)) {
        $db->query('INSERT INTO notes(body, user_id) VALUES(:body, :user_id)', [
            ':body' => $_POST['body'],
            ':user_id' => 3
        ]);
    }
}

require view('notes/create.view.php', [
    'heading' => 'Create Note',
    'errors' => $errors
]);