<?php

namespace Core\Errors;

use Exception;
use Throwable;

/**
 * Error personalizado para cuando no se encuentra una vista.
 */
class ViewNotFound extends Exception
{
    public function __construct($message, $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
