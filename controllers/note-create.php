<?php

require 'Validator.php';

$config = require 'config.php';
$db = new Database($config['database']);
$minCharacters = 1;
$maxCharacters = 100;

$heading = 'Note Create';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];
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

require "views/note-create.view.php";