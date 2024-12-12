<?php
class View {
    public static function getView($name) {
        $viewPath = VIEWS_PATH.$name;
        if (file_exists($viewPath.".php")) {
            require $viewPath.".php";
        } elseif (file_exists($viewPath."View.php")) {
            require $viewPath."View.php";
        } else {
            throw new ErrorViewNotFound("No se encontró la vista " . $name . ".php, ni la vista ". $name . "View.php");
        }
    }
}

class ErrorViewNotFound extends Exception {
    public function __construct($message, $code = 0, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}