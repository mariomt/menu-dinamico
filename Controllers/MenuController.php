<?php
require_once MODELS_PATH . 'MenuModel.php';
class MenuController {
    public function index() {
        $menuModel = new MenuModel();
        $datos = $menuModel->getAll();
        View::getView('shared/head');
        View::getView('ListMenus',['data' => $datos]);
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

    public function guarda() {

        $data = [
            'name' => request->post('nombre'),
            'description' => request->post('descripcion'),
            'parent_id' => request->post('padre') 
        ];
        
        $menuModel = new MenuModel();
        $menuModel->insert($data);

        $this->index();
    }
}