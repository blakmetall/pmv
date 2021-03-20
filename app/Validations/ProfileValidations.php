<?php

namespace App\Validations;

use Illuminate\Http\Request;

class ProfileValidations extends Validation
{  
    public function __construct()
    {
        $this->setDefaultValidations([
            'firstname' => 'required',
            'lastname' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'street' => 'required',
            'zip' => 'required|numeric',
        ]);
    }

    public function validate($validateEvent, Request $request)
    {
        $eventValidations = [];
        $customValidationMessages = [];

        switch($validateEvent)   {
            case 'edit': break;
        }

        $validations = array_merge($this->getDefaultValidations(), $eventValidations);

        $this->runValidations($request->all(), $validations, $customValidationMessages);
    }
}