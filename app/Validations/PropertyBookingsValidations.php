<?php

namespace App\Validations;

use Illuminate\Http\Request;

class PropertyBookingsValidations extends Validation
{
    public function __construct()
    {
        $this->setDefaultValidations([
            'property_id'       => 'required',
            'firstname'         => 'required',
            'lastname'          => 'required',
            'email'             => 'required|email',
            'alternate_email'   => 'nullable|email',
            'arrival_date'      => 'required',
            'departure_date'    => 'required',
            'adults'            => 'required',
            'register_by'       => 'required',
        ]);
    }

    public function validate($validateEvent = '', Request $request, $id = '')
    {
        $eventValidations = [];
        $customValidationMessages = [];

        switch ($validateEvent) {
            case 'create':
                break;
            case 'edit':
                break;
        }

        $validations = array_merge($this->getDefaultValidations(), $eventValidations);

        $this->runValidations($request->all(), $validations, $customValidationMessages);
    }
}
