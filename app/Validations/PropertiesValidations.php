<?php

namespace App\Validations;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

class PropertiesValidations
{  
    public static function validateOnCreate(Request $request)
    {
        return self::validate('create', $request);
    }

    public static function validateOnEdit(Request $request, $id = '')
    {
        return self::validate('edit', $request, $id);
    }

    public static function getDefaultValidations()
    {
        $defaultValidations = [
            'en.name' => 'required',
            'en.description' => 'required',
            'en.cancellation_policies' => 'required',
            'es.name' => 'required',
            'es.description' => 'required',
            'es.cancellation_policies' => 'required',

            'user_id' => 'required',
            'city_id' => 'required',
            'zone_id' => 'required',
            'property_type_id' => 'required',
            'cleaning_option_id' => 'required',
            'rental_commission' => 'nullable|numeric|between:0,100',
            'maid_fee' => 'nullable|numeric',
            'bedrooms' => 'required|numeric',
            'baths' => 'required|numeric',
            'sleeps' => 'nullable|integer',
            'floors' => 'nullable|integer',
            'lot_size_sqft' => 'nullable|numeric',
            'construction_size_sqft' => 'nullable|numeric',
        ];

        return $defaultValidations;
    }

    public static function validate($validateEvent, Request $request, $id = '')
    {
        $redirectRoute = '';
        $validations = [];

        switch($validateEvent)   {
            case 'create':
                $redirectRoute = 'properties.create';
                $validations = [];
            break;
            case 'edit':
                $redirectRoute = 'properties.edit';
                $validations = [];
            break;
        }

        $validations = array_merge(self::getDefaultValidations(), $validations);

        $validator = Validator::make($request->all(), $validations);

        if( $validator->fails() ) {
            throw new ValidationException($validator);
        }
    }
}