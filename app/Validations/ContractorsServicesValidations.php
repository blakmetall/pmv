<?php

namespace App\Validations;

use Illuminate\Http\Request;

class ContractorsServicesValidations extends Validation
{  
    public function __construct()
    {
        $this->setDefaultValidations([
            'contractor_id' => 'required',
            'base_price' => 'required|numeric',
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

        $validations = array_merge(self::getDefaultValidations(), $eventValidations);

        $this->runValidations($request->all(), $validations, $customValidationMessages);
    }
}