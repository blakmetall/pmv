<?php

namespace App\Validations;

use Illuminate\Http\Request;

class PropertyManagementValidations extends Validation
{  
    public function __construct()
    {
        $this->setDefaultValidations([
            'property_id' => 'required',
            'start_date' => 'required|date_format:Y-m-d',
            'end_date' => 'nullable|date_format:Y-m-d|after:start_date',
            'management_fee' => 'required|numeric|min:0',
            'average_month' => 'required|numeric|min:0',
        ]);
    }

    public function validate($validateEvent = '', Request $request, $id = '')
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