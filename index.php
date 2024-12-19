<?php

require_once './Config/Constant.php';
require_once './Core/functions.php';
require './vendor/autoload.php';

use Core\Logger;
use Core\Router;

try {
    Router::get('/', 'HomeController', 'index');
    Router::get('/menu', 'HomeController', 'inicio');
    Router::get('/menu/{id}', 'HomeController', 'inicio');
    Router::get('/Menus', 'MenuController', 'index');
    
    Router::get('/alta', 'MenuController', 'alta');
    Router::post('/alta', 'MenuController', 'guarda');
    
    Router::get('/editar/{id}', 'MenuController', 'editar');
    Router::post('/editar/{id}', 'MenuController', 'editar');
    
    Router::get('/elimina/{id}', 'MenuController', 'elimina');
    Router::post('/elimina/{id}', 'MenuController', 'elimina');
    
    Router::dispatch(request()->url, request()->requestMethod);

} catch (\Core\Errors\FileNotFound $err) {

    $logger = new Logger();
    $logger->logError($err);

    if (DEBUG) {
        throw $err;
    } else {
        require VIEWS_PATH . 'errors/NotFoundView.php';
    }
} catch (\Throwable $th) {
    $logger = new Logger();
    $logger->logError($th);

    if (DEBUG) {
        throw $th;
    } else {
        require VIEWS_PATH . 'errors/InternalServerErrorView.php';
    }
}

