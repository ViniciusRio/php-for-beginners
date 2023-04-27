<?php

use Core\App;
use Core\Database;
use Model\User;

$user = (new User)->matchCredencials();

$db = App::resolve(Database::class);

$note = $db->query('SELECT * FROM php_for_beginners.notes WHERE id = :id', [
    ':id' => $_POST['id']
])->findOrFail();

authorize($note['user_id'] === $user['id']);

$db->query('DELETE from php_for_beginners.notes WHERE id = :id', [
    'id' => $_POST['id']
]);

header('location: /notes');
exit();
