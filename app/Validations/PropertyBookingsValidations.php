<?php

namespace App\Validations;

use Auth;
use Illuminate\Http\Request;

class PropertyBookingsValidations extends Validation
{
    public function __construct()
    {
        $validations = [
            'property_id'       => 'required',
            'firstname'         => 'required',
            'lastname'          => 'required',
            'email'             => 'required|email',
            'alternate_email'   => 'nullable|email',
            'adults'            => 'required',
            'adults'            => 'required',
            'register_by'       => 'required',
            'damage_deposit_id' => 'required',
        ];

        $this->setDefaultValidations($validations);
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

        if (!isRole('owner')) {
            $validations['arrival_date'] = 'required';
            $validations['departure_date'] = 'required';
        }

        $this->runValidations($request->all(), $validations, $customValidationMessages);
    }
}
