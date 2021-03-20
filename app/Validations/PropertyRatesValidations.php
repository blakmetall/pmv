<?php

namespace App\Validations;

use Illuminate\Http\Request;

class PropertyRatesValidations extends Validation
{  
    public function __construct()
    {
        $this->setDefaultValidations([
            'property_id' => 'required',
            'start_date' => 'required|date_format:Y-m-d',
            'end_date' => 'required|date_format:Y-m-d',
            'nightly' => 'nullable|numeric|min:0',
            'weekly' => 'nullable|numeric|min:0',
            'monthly' => 'nullable|numeric|min:0',
            'min_stay' => 'nullable|integer|min:0'
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