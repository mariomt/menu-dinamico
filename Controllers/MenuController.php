<?php
require_once MODELS_PATH . 'MenuModel.php';
class MenuController {
    public function index() {
        $menuModel = new MenuModel();
        $datos = $menuModel->getAllWithParentName();

        View::getView('shared/head');
        View::getView('ListMenus',['data' => $datos]);
        View::getView('shared/footer');

    }

    public function alta() {
        $menuModel = new MenuModel();
        $datos = $menuModel->getAll();
        View::getView('shared/head');
        View::getView('Form',[
            'select' => $datos,
            'action' => '/alta'
        ]);
        View::getView('shared/footer');
    }

    public function editar($params) {
        $menuModel = new MenuModel();
        if(request->requestMethod == 'POST') {
            $data = [
                'name' => request->post('nombre'),
                'description' => request->post('descripcion'),
                'parent_id' => request->post('padre') 
            ];
            $menuModel->update($params['id'], $data);
            Router::redirect('/Menus');
        } else {
            $data = $menuModel->getAll();
            $found_key = array_search($params['id'], array_column($data, 'id'));
            
            if($found_key === false) {
                // TODO: hacer validación para cuando se ingresa a editar un elemento que no existe
            } else {
                $selected = $data[$found_key]; 
            }

            View::getView('shared/head');
            View::getView('Form', [
                'select' => $data,
                'action' => "/editar/{$selected['id']}",
                'data' => $selected,
            ]);
            View::getView('shared/footer');
        }
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

        Router::redirect('/Menus');
    }
}