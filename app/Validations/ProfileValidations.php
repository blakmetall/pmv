<?php

namespace App\Validations;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProfileValidations
{  
    public static function validateOnEdit(Request $request)
    {
        return self::validate('edit', $request);
    }

    public static function getDefaultValidations()
    {
        $defaultValidations = [
            'firstname' => 'required',
            'lastname' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'street' => 'required',
            'emergency_phone' => 'required',
            'zip' => 'required|numeric',
            'config_agent_commission' => 'nullable|numeric|between:0,100',
        ];

        return $defaultValidations;
    }

    public static function validate($validateEvent, Request $request)
    {
        $redirectRoute = '';
        $validations = [];

        switch($validateEvent)   {
            case 'edit':
                $redirectRoute = 'profile';
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