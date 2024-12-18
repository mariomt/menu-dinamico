<?php

require CONFIG_PATH . '/Request.php';

/**
 * Función que concatena en BASE_DIR con el path indicado
 *
 * @param  string $path
 * @return void
 */
function getURL($path)
{
    $baseDir = rtrim(BASE_DIR, '/');
    $path = ltrim($path, '/');
    return $baseDir . '/' . $path;
}

function request() {
    return Request::getInstance();
}
