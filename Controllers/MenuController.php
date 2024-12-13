<?php
require_once MODELS_PATH . 'MenuModel.php';
/**
 * Clase contenedora de todas las acciones posibles para realizar con la gestión de menús
 */
class MenuController {
    /**
     * Método para renderizar la vista de la tabla de menus, donde se podrá realizar las operaciones de agregar, modificar y eliminar.
     *
     * @return void
     */
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
    
    /**
     * Método que renderiza el formulario para registrar un nuevo menú
     *
     * @return void
     */
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
    
    /**
     * Método que permite visualizar la vista de edición y editar los datos modificados.
     *
     * @param  array $params Arreglo con los parametros de la url, por ejemplo el id. 
     * @return void
     */
    public function editar($params) {
        $menuModel = new MenuModel();
        $datos = $menuModel->getAll();
        if(request->requestMethod == 'POST') {
            $data = [
                'name' => request->post('nombre'),
                'description' => request->post('descripcion'),
                'parent_id' => request->post('padre') 
            ];

            $messages = [
                'error' => [],
            ];

            if ($data['parent_id'] == $params['id']) {
                array_push($messages['error'], 'No puedes relacionar el elemento consigo mismo.');
            }
    
            if($data['name'] == null || strlen($data['name'])<1 ) {
                array_push($messages['error'], 'El nombre no puede estar vacío.');
            }
            
            if($data['description'] == null || strlen($data['description'])<1 ) {
                array_push($messages['error'], 'La descripción no puede estar vacía.');
            }

            if (sizeof($messages['error'])>0) {

                View::getView('shared/head');
                View::getView('Form',[
                    'select' => $datos,
                    'data' => $data,
                    'action' => '/alta',
                    'messages' => $messages,
                ]);
                View::getView('shared/footer');
                return;
            }
            
            try {
                $menuModel->update($params['id'], $data);
                $messages['success'] = [
                    'Datos guardados con éxito.'
                ];
            } catch (\Throwable $th) {
                array_push($messages['error'], 'Ocurrio un error al registrar la información.');
            }

            View::getView('shared/head');
            View::getView('Form',[
                'select' => $datos,
                'data' => $data,
                'action' => '/alta',
                'messages' => $messages,
            ]);
            View::getView('shared/footer');


        } else {
            $found_key = array_search($params['id'], array_column($datos, 'id'));
            
            if($found_key === false) {
                View::getView('NotFound', [
                    'message' => 'No se ha encontrádo la opción del menú que desea eliminar.',
                ]);
            } else {
                $selected = $datos[$found_key]; 
                View::getView('shared/head');
                View::getView('Form', [
                    'select' => $datos,
                    'action' => "/editar/{$selected['id']}",
                    'data' => $selected,
                ]);
                View::getView('shared/footer');
            }

        }
    }
    /*
     * Método para mostrar la vista de eliminación de menus y maneja la petición de eliminación.
     * 
     * @param  mixed $params
     * @return void
     */
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
    
    /**
     * Método para gestionar la petición post de guardado de un nuevo menú
     *
     * @return void
     */
    public function guarda() {

        $data = [
            'name' => request->post('nombre'),
            'description' => request->post('descripcion'),
            'parent_id' => request->post('padre') 
        ];

        $messages = [
            'error' => [],
        ];

        if($data['name'] == null || strlen($data['name'])<1 ) {
            array_push($messages['error'], 'El nombre no puede estar vacío.');
        }
        
        if($data['description'] == null || strlen($data['description'])<1 ) {
            array_push($messages['error'], 'La descripción no puede estar vacía.');
        }

        $menuModel = new MenuModel();
        $datos = $menuModel->getAll();
        
        if (sizeof($messages['error'])>0) {

            View::getView('shared/head');
            View::getView('Form',[
                'select' => $datos,
                'data' => $data,
                'action' => '/alta',
                'messages' => $messages,
            ]);
            View::getView('shared/footer');
            return;
        }
        
        try {
            $menuModel->insert($data);
            $messages['success'] = [
                'Se ha registrado un nuevo elemento al menú'
            ];
        } catch (\Throwable $th) {
            array_push($messages['error'], 'Ocurrio un error al registrar la información.');
        }
        View::getView('shared/head');
        View::getView('Form',[
            'select' => $datos,
            'action' => '/alta',
            'messages' => $messages,
        ]);
        View::getView('shared/footer');

    }
}