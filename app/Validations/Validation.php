<?php

namespace App\Validations;

use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

class Validation
{  
    private $defaultValidations = [];

    public function __construct($defaultValidations = []) {
        $this->setDefaultValidations($defaultValidations);
    }

    public function setDefaultValidations($defaultValidations) {
        $this->defaultValidations = $defaultValidations;
    }

    public function getDefaultValidations() {
        return $this->defaultValidations;
    }

    public function runValidations($requestData, $validations = [], $customValidationMessages = [])
    {
        $validations = array_merge($this->getDefaultValidations(), $validations);

        $validator = Validator::make($requestData, $validations, $customValidationMessages);
 
        if( $validator->fails() ) {
            throw new ValidationException($validator);
        }
    }
}