<?php

$config = require 'config.php';
$db = new Database($config['database']);

$id = $_GET['id'];
$query = "SELECT * FROM notes WHERE id = :id";

$note = $db->query($query,[':id' => $id] )->findOrFail();
$currentUser = 3;

authorize($note['user_id'] === $currentUser);

$heading = 'Note';

require "views/note.view.php";