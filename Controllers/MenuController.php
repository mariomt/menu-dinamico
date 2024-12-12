<?php

class MenuController {
    public function index() {

        View::getView('shared/head');
        View::getView('ListMenus');
        View::getView('shared/footer');
    }

    public function alta() {
        View::getView('shared/head');
        View::getView('Alta');
        View::getView('shared/footer');
    }

    public function editar() {
        View::getView('shared/head');
        View::getView('Alta');
        View::getView('shared/footer');
    }

    public function elimina() {
        View::getView('shared/head');
        View::getView('Elimina');
        View::getView('shared/footer');
    }
}