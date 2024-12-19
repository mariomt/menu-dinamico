<?php

namespace Core;

class Validator 
{
    public static function validate(array $data, array $rules)
    {
        $errors = [];

        foreach ($rules as $field => $fieldRules) {
            $value = $data[$field] ?? null;
            $fieldRules = explode('|', $fieldRules);

            foreach ($fieldRules as $rule) {
                $ruleParts = explode(':', $rule);
                $ruleName = $ruleParts[0];
                $ruleParam = $ruleParts[1] ?? null;

                if ($ruleName == 'required' && is_null($value)) {
                    $errors[$field][] = "El campo {$field} es obligatorio";
                }

                if ($ruleName == 'string' && !is_null($value) && !is_string($value)) {
                    $errors[$field][] = "El campo {$field} debe ser una cadena de texto.";
                }

                if ($ruleName == 'max' && !is_null($value) && is_string($value) && strlen($value) > (int)$ruleParam) {
                    $errors[$field][] = "El campo {$field} no debe ser mayor a {$ruleParam} caracteres.";
                }
            }
        }

        return $errors;
    }
}
