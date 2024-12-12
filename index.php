<?php
require_once './Config/Constant.php';
require_once './Config/Router.php';
require_once './Config/Views.php';

Router::get('/', 'BaseController', 'index');
Router::get('/menu', 'BaseController', 'inicio');
Router::get('/Menus', 'MenuController', 'index');

Router::get('/alta', 'MenuController', 'alta');
Router::post('/guarda', 'MenuController', 'guarda');

Router::get('/editar', 'MenuController', 'editar');
Router::get('/elimina', 'MenuController', 'elimina');

Router::dispatch(request->url, request->requestMethod);
