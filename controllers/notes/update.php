<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);
$id = $_POST['id'];
$body = $_POST['body'];
$currentUser = 3;

$note = $db->query('SELECT * FROM notes WHERE id = :id', [':id' => $id])->findOrFail();

authorize($note['user_id'] === $currentUser);

$minCharacters = 1;
$maxCharacters = 100;
$errors = [];

if (!Validator::string($_POST['body'], $minCharacters, $maxCharacters)) {
    $errors['body'] = 'A body of no more than 100 characters is required';
}

if (count($errors)) {
    return view('notes/edit.view.php', [
        'heading' => 'Edit',
        'note' => $note,
        'errors' => $errors
    ]);
}

$db->query('UPDATE notes SET body  = :body WHERE id = :id', ['id' => $id, ':body' => $body]);


header('location: /notes');

exit();



