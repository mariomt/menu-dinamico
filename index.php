<?php

require_once './Config/Constant.php';
require_once './helpers/GlobalHelpers.php';
require_once './Config/Views.php';

use Config\Router;

spl_autoload_register(function($class){
    $file = str_replace('\\','/', $class) . '.php';
    if(file_exists($file)) {
        require_once $file;
    }
});

Router::get('/', 'BaseController', 'index');
Router::get('/menu', 'BaseController', 'inicio');
Router::get('/menu/{id}', 'BaseController', 'inicio');
Router::get('/Menus', 'MenuController', 'index');

Router::get('/alta', 'MenuController', 'alta');
Router::post('/alta', 'MenuController', 'guarda');

Router::get('/editar/{id}', 'MenuController', 'editar');
Router::post('/editar/{id}', 'MenuController', 'editar');

Router::get('/elimina/{id}', 'MenuController', 'elimina');
Router::post('/elimina/{id}', 'MenuController', 'elimina');

Router::dispatch(request()->url, request()->requestMethod);
