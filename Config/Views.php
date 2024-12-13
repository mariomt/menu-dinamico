<?php


/**
 * Clase para resolver las vistas e inyectarles variables.
 */
class View {    
    /**
     * Método que permite buscar una vista, para posteriormente idratarla con formación.
     * Este método busca las vistas en el directorio de vistas.
     * @param  mixed $name nombre de la vista, el nombre puede contener la palabra View al final u omitirlo.
     * @param  mixed $data
     * @return void
     */
    public static function getView($name, $data = []) {
        $viewPath = VIEWS_PATH.$name;
        if (file_exists($viewPath.".php")) {
            $viewPath.= ".php";
        } elseif (file_exists($viewPath."View.php")) {
            $viewPath.= "View.php";
        } else {
            throw new ErrorViewNotFound("No se encontró la vista " . $name . ".php, ni la vista ". $name . "View.php");
        }

        extract($data);

        require $viewPath;
    }
}

/**
 * Error personalizado para cuando no se encuentra una vista.
 */
class ErrorViewNotFound extends Exception {
    public function __construct($message, $code = 0, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}