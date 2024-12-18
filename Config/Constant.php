<?php

// Directorio donde se almacenaran las vistas
define('VIEWS_PATH', __DIR__ . "/../Views/");

define('CONFIG_PATH', __DIR__ . "/");

define('MODELS_PATH', __DIR__ . "/../Models/");
define('HELPERS_PATH', __DIR__ . "/../helpers/");

define('DEBUG', true);

define('BASE_DIR', 'http://localhost');

define('DB_CONFIG', [
    'HOST' => 'localhost',
    'USER' => '',
    'PASS' => '',
    'DBNAME' => '',
    'PORT' => '3306',
    'CHARSET' => 'utf8mb4'
]);
