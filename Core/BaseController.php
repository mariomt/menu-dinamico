<?php

namespace Core;

use Core\Errors\ValidationsError;
use Core\Request;
use Core\Validator;
abstract class BaseController {

    protected ?Validator $validator = null;

    /**
     * validate
     *
     * @param  mixed $request
     * @param  mixed $rules
     * @return array<string, string[]>
     */
    function validate(Request $request, array $rules) {
        if ($request->requestMethod == 'POST') {
            $err = Validator::validate($request->post(), $rules);
        } else {
            $err = Validator::validate($request->get(), $rules);
        }

        if (sizeof($err)>0) {
            throw new ValidationsError($err);
        }

        return true;
    }

    function runValidations(array $data) {
        if ( is_null($this->validator) ) {
            return false;
        } else {
            $err = $this->validator->run($data);

            if (sizeof($err)>0) {
                throw new ValidationsError($err);
            }

            return true;
        }
    }
}
