<?php

namespace Core\Errors;

use Exception;
use Throwable;

class HelperNotFound extends FileNotFound {
    public function __construct($helperName, $filePath, $code = 0, Throwable $prev = null)
    {
        parent::__construct(
            "El herper '{$helperName}' no existe en la ruta {$filePath}", 
            $code,
            $prev
        );
    }
}