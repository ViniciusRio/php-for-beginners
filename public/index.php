<?php
const BASE_PATH = __DIR__ . '/../';

require BASE_PATH . 'core/functions.php';
//require base_path('Database.php');
//require base_path('Response.php');

spl_autoload_register(function ($class) {
    require base_path("core/{$class}.php");
});
require base_path('core/router.php');
