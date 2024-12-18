<?php
require_once './Config/Constant.php';
require_once './helpers/GlobalHelpers.php';
require_once './Config/Router.php';
require_once './Config/Views.php';

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

Router::dispatch(request->url, request->requestMethod);
