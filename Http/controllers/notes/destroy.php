<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);
$currentUser = 3;

$note = $db->query('SELECT * FROM php_for_beginners.notes WHERE id = :id', [
    ':id' => $_POST['id']
])->findOrFail();

authorize($note['user_id'] === $currentUser);

$db->query('DELETE from php_for_beginners.notes WHERE id = :id', [
    'id' => $_POST['id']
]);

header('location: /notes');
exit();