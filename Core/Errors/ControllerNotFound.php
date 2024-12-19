<?php

namespace Core\Errors;

use Throwable;

class ControllerNotFound extends FileNotFound {

    public function __construct($controllerName, $code = 0, Throwable $previous = null)
    {
        if (!str_ends_with($controllerName, "Helper")) {
            $controllerName .= "Helper";
        }

        parent::__construct(
            "No se encontró el controlador '{$controllerName}'.",
            $code,
            $previous
        );
    }
}