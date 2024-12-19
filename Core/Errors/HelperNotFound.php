<?php

namespace Core\Errors;

use Exception;
use Throwable;

class HelperNotFound extends Exception {
    public function __construct($message, $code = 0, Throwable $prev = null)
    {
        parent::__construct($message, $code, $prev);
    }
}