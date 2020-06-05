<?php

namespace App\Validations;

use Illuminate\Http\Request;

class TransactionTypesValidations extends Validation
{  
    public function __construct()
    {
        $this->setDefaultValidations([
            'en.name' => 'required',
            'es.name' => 'required',
        ]);
    }

    public function validate($validateEvent, Request $request, $id = '')
    {
        $eventValidations = [];
        $customValidationMessages = [];

        switch($validateEvent)   {
            case 'create': break;
            case 'edit': break;
        }

        $validations = array_merge($this->getDefaultValidations(), $eventValidations);

        $this->runValidations($request->all(), $validations, $customValidationMessages);
    }
}