<?php
require_once './Config/Constant.php';
require_once './Config/Router.php';
require_once './Config/Views.php';

$uri = $_SERVER['REQUEST_URI'];
$requerMethod = $_SERVER['REQUEST_METHOD'];

Router::get('/', 'BaseController', 'index');
Router::get('/menu', 'BaseController', 'inicio');
Router::get('/Menus', 'MenuController', 'index');
Router::get('/alta', 'MenuController', 'alta');
Router::get('/editar', 'MenuController', 'editar');
Router::get('/elimina', 'MenuController', 'elimina');

Router::dispatch($uri, $requerMethod);
