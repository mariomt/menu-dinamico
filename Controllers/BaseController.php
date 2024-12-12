<?php

class BaseController {
    public function index() {
        echo 'Hola desde el indes de base controller';
    }

    public function inicio() {
        
        View::getView('Test', ['title' => 'prueba', "name" => "Mario"]);
    }
}