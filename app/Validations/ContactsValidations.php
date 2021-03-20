<?php

namespace App\Validations;

use Illuminate\Http\Request;

class ContactsValidations extends Validation
{  
    public function __construct()
    {
        $this->setDefaultValidations([
            'firstname' => 'required',
            'lastname' => 'required',
            'emergency_phone' => 'required',
            'email'     => 'required|email',
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
