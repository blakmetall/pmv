<?php

namespace App\Validations;

use Illuminate\Http\Request;

class CleaningServicesValidations extends Validation
{  
    public function __construct()
    {
        $this->setDefaultValidations([
            'property_id'                        => 'required',
            'date'                               => 'required|date_format:Y-m-d',
            'hour'                               => 'nullable|date_format:H:i',
            'description'                        => 'required',
            'maid_fee'                           => 'required|numeric',
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
