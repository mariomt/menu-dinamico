<?php

class BaseController {

    public function index() {
        echo 'Hola desde el indes de base controller';
    }

    public function inicio() {
        
        View::getView('shared/head');
        View::getView('Menu', ['title' => 'prueba', "name" => "Mario"]);
        View::getView('shared/footer');
    }
}