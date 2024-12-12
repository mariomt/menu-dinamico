<?php

class BaseController {
    public function index() {
        echo 'Hola desde el indes de base controller';
    }

    public function inicio() {
        require_once __DIR__.'/../Config/Views.php';
        View::getView('Test');
    }
}