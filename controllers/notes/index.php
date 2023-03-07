<?php /** @noinspection ALL */

$config = require base_path('config.php');

$db = new Database($config['database']);
$notes = $db->query('SELECT * FROM notes')->findAll();

require view('notes/index.view.php', [
    'heading' => 'Notes',
    'notes' => $notes
]);