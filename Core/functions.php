<?php

use Core\Errors\HelperNotFound;
use Core\View;
use Core\Request;


if (!function_exists('getURL')) {
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
}

if (!function_exists('request')) {
    function request() {
        return Request::getInstance();
    }
}

if (!function_exists('helper')) {    
    /**
     * Función que ayuda a cargar los helpers
     *
     * @param  mixed $helper
     * @return void
     */
    function helper(string $helper)
    {
        if (!str_ends_with($helper, "Helper")) {
            $helper = $helper . "Helper";
        }

        $filePath = HELPERS_PATH . $helper . ".php";

        if ( !file_exists($filePath) ) {
            throw new HelperNotFound("El herper '{$helper}' no existe en la ruta {$filePath}");
        }

        require_once $filePath;
    }
}

if (!function_exists('view')) {    
    /**
     * Función para renderizar una vista e hidratarla con datos
     *
     * @param  string $name nombre de la vista
     * @param  array $data información a inyectar a la vista
     * @return void
     */
    function view(string $name, array $data = null) {
        View::getView($name, is_null($data) ? [] : $data);
    }
}