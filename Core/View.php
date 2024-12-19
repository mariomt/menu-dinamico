<?php

namespace Core;

use Core\Errors\ViewNotFound;

/**
 * Clase Abstracta para resolver las vistas e inyectarles variables.
 */
abstract class View
{
    /**
     * Método que permite buscar una vista, para posteriormente idratarla con formación.
     * Este método busca las vistas en el directorio de vistas.
     * @param  mixed $name nombre de la vista, el nombre puede contener la palabra View al final u omitirlo.
     * @param  mixed $data
     * @return void
     */
    public static function getView($name, $data = [])
    {
        $viewPath = VIEWS_PATH . $name;
        if (file_exists($viewPath . ".php")) {
            $viewPath .= ".php";
        } elseif (file_exists($viewPath . "View.php")) {
            $viewPath .= "View.php";
        } else {
            throw new ViewNotFound($name);
        }

        extract($data);

        require $viewPath;
    }
}
