<?php
require_once './Config/Router.php';

$uri = $_SERVER['REQUEST_URI'];
$requerMethod = $_SERVER['REQUEST_METHOD'];

Router::get('/', 'BaseController', 'index');

Router::dispatch($uri, $requerMethod);
