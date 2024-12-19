<?php

require_once './Config/Constant.php';
require_once './Core/functions.php';
require './vendor/autoload.php';

use Core\Router;

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
