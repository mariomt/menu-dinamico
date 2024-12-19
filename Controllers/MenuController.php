<?php

namespace Controllers;

use Core\BaseController;
use Core\Errors\ValidationsError;
use Core\Router;
use Core\Validator;
use Models\Menu;
use Traits\ErrorLogger;

/**
 * Clase contenedora de todas las acciones posibles para realizar con la gestión de menús
 */
class MenuController extends BaseController
{

    use ErrorLogger;

    function __construct()
    {
        $this->validator = new Validator([
            'nombre' => 'required|max:50',
            'descripcion' => 'required',
        ]);
    }
    /**
     * Método para renderizar la vista de la tabla de menus, donde se podrá realizar las operaciones de agregar, modificar y eliminar.
     *
     * @return void
     */
    public function index()
    {
        $messages = [];
        if (request()->get('new') != null) {
            $messages['success'] = [
                'Se ha registrado un nuevo elemento al menú',
            ];
        }
        $datos = Menu::getAllWithParentName();

        view('shared/head');
        view('ListMenus', [
            'data' => $datos,
            'messages' => $messages
        ]);
        view('shared/footer');
    }

    /**
     * Método que renderiza el formulario para registrar un nuevo menú
     *
     * @return void
     */
    public function alta()
    {
        $datos = Menu::all();
        view('shared/head');
        view('Form', [
            'select' => $datos,
            'action' => '/alta'
        ]);
        view('shared/footer');
    }

    /**
     * Método que permite visualizar la vista de edición y editar los datos modificados.
     *
     * @param  array $params Arreglo con los parametros de la url, por ejemplo el id.
     * @return void
     */
    public function editar($params)
    {
        $datos = Menu::all();

        $menu = Menu::find($params['id']);

        if (is_null($menu)) {
            view('errors/NotFound', [
                'message' => 'No se ha encontrado la opción del menú que desea editar.',
            ]);
        }

        if (request()->requestMethod == 'POST') {
            $messages = [
                'error' => [],
            ];

            try {
                $this->runValidations(request()->post());

                $menu->name = request()->post('nombre');
                $menu->description = request()->post('descripcion');
                $menu->parent_id = request()->post('padre');


                if ($menu->parent_id == $menu->id) {
                    throw new ValidationsError("No puedes relacionar el elemento consigo mismo.");
                }

                $menu->save();

                $messages['success'] = [
                    'Datos guardados con éxito.'
                ];

            } catch (ValidationsError $verror) {
                if (sizeof($verror->getErrors())>0) {
                    foreach ($verror->getErrors() as $key => $value) {
                        foreach ($value as $err) {
                            array_push($messages['error'], $err);
                        }
                    }
                }
            } catch (\Throwable $th) {
                array_push($messages['error'], 'Ocurrio un error al registrar la información.');
                $this->logError($th);
            }

            view('shared/head');
            view('Form', [
                'select' => $datos,
                'data' => $menu,
                'action' => "/editar/{$menu->id}",
                'messages' => $messages,
            ]);
            view('shared/footer');
        } else {

            view('shared/head');
            view('Form', [
                'select' => $datos,
                'action' => "/editar/{$menu->id}",
                'data' => $menu,
            ]);
            view('shared/footer');
        }
    }
    /*
     * Método para mostrar la vista de eliminación de menus y maneja la petición de eliminación.
     *
     * @param  mixed $params
     * @return void
     */
    public function elimina($params)
    {

        $found = Menu::find($params['id']);
        $data = Menu::all();

        if (is_null($found)) {
            view('errors/NotFound', [
                'message' => 'No se ha encontrado la opción del menú que desea eliminar.',
            ]);
        } else {
            if (request()->requestMethod == 'POST') {
                try {
                    //code...
                    $found->delete();
                    Router::redirect('/Menus');
                } catch (\Throwable $th) {
                    if (str_contains($th->getMessage(), "a foreign key constraint fails")) {
                        view('shared/head');
                        view('Elimina', [
                            'select' => $data,
                            'action' => "/elimina/{$found->id}",
                            'data' => $found,
                            'messages' => [
                                'error' => [
                                    'No se puede eliminar un menú que tiene menús hijos.'
                                ]
                            ]
                        ]);
                        view('shared/footer');
                    }
                }
            } else {
                view('shared/head');
                view('Elimina', [
                    'select' => $data,
                    'action' => "/elimina/{$found->id}",
                    'data' => $found,
                ]);
                view('shared/footer');
            }
        }
    }

    /**
     * Método para gestionar la petición post de guardado de un nuevo menú
     *
     * @return void
     */
    public function guarda()
    {
        $messages = [
            'error' => [],
        ];

        $datos = Menu::all();

        try {
            $this->runValidations(request()->post());

            $newMenu = new Menu([
                'name' => request()->post('nombre'),
                'description' => request()->post('descripcion'),
                'parent_id' => request()->post('padre')
            ]);

            $newMenu->save();
            $messages['success'] = [
                'Se ha registrado un nuevo elemento al menú'
            ];
        } catch (ValidationsError $verror) {
            if (sizeof($verror->getErrors())>0) {
                foreach ($verror->getErrors() as $key => $value) {
                    foreach ($value as $err) {
                        array_push($messages['error'], $err);
                    }
                }
            }
        } catch (\Throwable $th) {
            array_push($messages['error'], 'Ocurrio un error al registrar la información.');
            $this->logError($th);
        }
        view('shared/head');
        view('Form', [
            'select' => $datos,
            'data' => isset($data)? $data : [],
            'action' => '/alta',
            'messages' => $messages,
        ]);
        view('shared/footer');
    }
}
