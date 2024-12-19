<?php

namespace Core;

use Core\Request;
use Core\Validator;

abstract class BaseController {

        
    /**
     * validate
     *
     * @param  mixed $request
     * @param  mixed $rules
     * @return void
     */
    function validate(Request $request, array $rules) {
        if ($request->requestMethod == 'POST') {
            Validator::validate($request->post(), $rules);
        } else {
            Validator::validate($request->get(), $rules);
        }
    }
}
