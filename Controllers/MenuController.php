<?php
require_once MODELS_PATH . 'MenuModel.php';
class MenuController {
    public function index() {
        $messages = [];
        if (request->get('new') != null) {
            $messages['success'] = [
                'Se ha registrado un nuevo elemento al menú',
            ];
        }
        $menuModel = new MenuModel();
        $datos = $menuModel->getAllWithParentName();

        View::getView('shared/head');
        View::getView('ListMenus',[
            'data' => $datos,
            'messages' => $messages
        ]);
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
                View::getView('NotFound', [
                    'message' => 'No se ha encontrádo la opción del menú que desea eliminar.',
                ]);
            } else {
                $selected = $data[$found_key]; 
                View::getView('shared/head');
                View::getView('Form', [
                    'select' => $data,
                    'action' => "/editar/{$selected['id']}",
                    'data' => $selected,
                ]);
                View::getView('shared/footer');
            }

        }
    }
    public function elimina($params) {
        $menuModel = new MenuModel();
        $data = $menuModel->getAll();
        $found_key = array_search($params['id'], array_column($data, 'id'));
        
        if($found_key === false) {
            View::getView('NotFound', [
                'message' => 'No se ha encontrádo la opción del menú que desea eliminar.',
            ]);
        } else {
            $selected = $data[$found_key]; 
            if(request->requestMethod == 'POST') {
                try {
                    //code...
                    $menuModel->delete($params['id']);
                    Router::redirect('/Menus');
                } catch (\Throwable $th) {
                    if (str_contains($th->getMessage(), "a foreign key constraint fails")) {
                        View::getView('shared/head');
                        View::getView('Elimina',[
                            'select' => $data,
                            'action' => "/elimina/{$selected['id']}",
                            'data' => $selected,
                            'messages' => [
                                'error' => [
                                    'No se puede eliminar un menú que tiene menús hijos.'
                                ] 
                            ]
                        ]);
                        View::getView('shared/footer');
                    }
                }
            } else {
                View::getView('shared/head');
                View::getView('Elimina',[
                    'select' => $data,
                    'action' => "/elimina/{$selected['id']}",
                    'data' => $selected,
                ]);
                View::getView('shared/footer');
            }
        }
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