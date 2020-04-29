<?php

namespace App\Validations;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PropertyRatesValidations
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
            'property_id' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'nightly' => 'nullable|numeric|min:0',
            'weekly' => 'nullable|numeric|min:0',
            'monthly' => 'nullable|numeric|min:0',
            'min_stay' => 'nullable|integer|min:0'
        ];

        return $defaultValidations;
    }

    public static function validate($validateEvent, Request $request, $id = '')
    {
        $redirectRoute = '';
        $validations = [];

        switch($validateEvent)   {
            case 'create':
                $redirectRoute = 'property-contacts.create';
                $validations = [];
            break;
            case 'edit':
                $redirectRoute = 'property-contacts.edit';
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