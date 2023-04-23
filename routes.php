<?php

$router->get('/', 'index.php');

$router->get('/notes', 'notes/index.php')->only('auth');
$router->post('/notes', 'notes/store.php');

$router->get('/note', 'notes/show.php');
$router->delete('/note', 'notes/destroy.php');
$router->patch('/note', 'notes/update.php');

$router->get('/note/edit', 'notes/edit.php');
$router->get('/notes/create', 'notes/create.php');

$router->get('/register', 'registration/create.php')->only('guest');
$router->post('/register', 'registration/store.php')->only('guest');

$router->get('/login', 'login/create.php')->only('guest');
$router->post('/login', 'login/store.php')->only('guest');
$router->delete('/logout', 'logout/destroy.php')->only('auth');

