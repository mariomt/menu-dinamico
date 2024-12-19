<?php

namespace Core\Errors;

use Exception;
use Throwable;
use Traits\ErrorLogger;

class FileNotFound extends Exception {

    use ErrorLogger;

    public function __construct($message, $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->logError($message);
    }
}
