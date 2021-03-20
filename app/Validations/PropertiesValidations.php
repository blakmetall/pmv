<?php

namespace App\Validations;

use Illuminate\Http\Request;

class PropertiesValidations extends Validation
{
    public function __construct()
    {
        $this->setDefaultValidations([
            'en.name' => 'required',
            'en.description' => 'required',
            'en.cancellation_policies' => 'required',
            'es.name' => 'required',
            'es.description' => 'required',
            'es.cancellation_policies' => 'required',

            'users_ids' => 'required',
            'city_id' => 'required',
            'zone_id' => 'required',
            'property_type_id' => 'required',
            'gmaps_lat' => 'nullable|numeric',
            'gmaps_lon' => 'nullable|numeric',
            'cleaning_option_id' => 'required',
            'rental_commission' => 'nullable|numeric|between:0,100',
            'maid_fee' => 'nullable|numeric',
            'bedrooms' => 'required|numeric',
            'baths' => 'required|numeric',
            'sleeps' => 'nullable|integer',
            'floors' => 'nullable|integer',
            'lot_size_sqft' => 'nullable|numeric',
            'construction_size_sqft' => 'nullable|numeric',
        ]);
    }

    public function validate($validateEvent, Request $request, $id = '')
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
