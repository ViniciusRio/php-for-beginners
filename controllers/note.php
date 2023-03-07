<?php

$config = require 'config.php';
$db = new Database($config['database']);

$id = $_GET['id'];
$query = "SELECT * FROM notes WHERE id = :id";

$note = $db->query($query,[':id' => $id] )->fetch();

if (!$note) {
    abort();
}
$currentUser = 3;

if ($note['user_id'] != $currentUser) {
    abort(Response::FORBIDDEN);
}

$heading = 'Note';

require "views/note.view.php";