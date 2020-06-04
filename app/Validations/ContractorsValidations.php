<?php

namespace App\Validations;

use Illuminate\Http\Request;

class ContractorsValidations extends Validation
{  
    public function __construct()
    {
        $this->setDefaultValidations([
            'city_id'      => 'required',
            'company'      => 'required',
            'contact_name' => 'required',
            'email'        => 'nullable|email'
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

        $validations = array_merge(self::getDefaultValidations(), $eventValidations);

        $this->runValidations($request->all(), $validations, $customValidationMessages);
    }
}