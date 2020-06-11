<?php

namespace App\Validations;

use Illuminate\Http\Request;

class HumanResourcesValidations extends Validation
{  
    public function __construct()
    {
        $this->setDefaultValidations([
            'city_id'   => 'required',
            'firstname' => 'required',
            'lastname'  => 'required',
            'address'   => 'required',
            'entry_at'  => 'nullable|date_format:Y-m-d',
            'birthday'  => 'nullable|date_format:Y-m-d',
            'vacation_start_date'  => 'nullable|date_format:Y-m-d',
            'vacation_end_date'  => 'nullable|date_format:Y-m-d',
            'vacation_days'  => 'nullable|integer',
            'children'  => 'nullable|integer',
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
