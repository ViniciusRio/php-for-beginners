<?php

use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);
$currentUser = 4;


$note = $db->query('select * from php_for_beginners.notes where id = :id', [
    'id' => $_GET['id']
])->findOrFail();

authorize($note['user_id'] === $currentUser);
view("notes/show.view.php", [
    'heading' => 'Note',
    'note' => $note,
    'errors' => Session::get('errors')
]);

