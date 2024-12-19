<?php

namespace Core\Errors;

use Exception;
use Interfaces\ValidationsErrorInterface;

class ValidationsError extends Exception implements ValidationsErrorInterface
{
    private array $errors = [];

    public function __construct(array|string $errors)
    {
        if (is_string($errors)) {
            $this->errors[] = [$errors];
        } else {
            $this->errors = $errors;
        }
    }

    public function getErrors()
    {
        return $this->errors;
    }
}