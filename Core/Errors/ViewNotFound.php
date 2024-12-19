<?php

namespace Core\Errors;

use Exception;
use Throwable;

/**
 * Error personalizado para cuando no se encuentra una vista.
 */
class ViewNotFound extends FileNotFound
{
    public function __construct($viewName, $code = 0, Throwable $previous = null)
    {
        if (!str_ends_with($viewName, 'View')) {
            $viewName .= 'View';
        }
        
        parent::__construct(
            "No se encontró la vista " . $viewName . ".php, ni la vista " . $viewName . ".php", 
            $code, $previous
        );
    }
}
