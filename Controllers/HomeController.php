<?php

namespace Controllers;

use Core\BaseController;
use Models\MenuModel;

/**
 * BaseController
 *
 * Controlador base que se utiliza para los endpoints principales
 */
class HomeController extends BaseController
{
    /**
     * Método que renderiza la vista HomeView.
     * La vista HomeView contiene dos botones para dirigirnos a la opción adecuada.
     * @return void
     */
    public function index()
    {
        view('HomeView');
    }


    /**
     * Este método renderiza la vista del menu general o menú seleccionado
     *
     * @param  array $params
     * @return void
     */
    public function inicio($params)
    {
        $menuModel = new MenuModel();
        $data = $menuModel->getAll();

        if (sizeof($params) > 0) {
            $found_key = array_search($params['id'], array_column($data, 'id'));
            if ($found_key === false) {
                $description = 'No se encontró la opción buscada';
            } else {
                $description = $data[$found_key]['description'];
            }
        } else {
            $description = 'No se ha seleccionado opción del menú 🙄';
        }

        helper('Menu');
        $menu = buildMenuHierarchy($data);

        view('shared/head');
        view('Menu', [
            'menu' => renderMenu($menu),
            'description' => $description,
        ]);
        view('shared/footer');
    }
}
