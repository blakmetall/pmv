<?php

namespace App\Validations;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class HumanResourcesValidations
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
            'city_id'   => 'required',
            'firstname' => 'required',
            'lastname'  => 'required',
            'address'   => 'required',
            'entry_at'  => 'nullable|date_format:Y-m-d',
            'birthday'  => 'nullable|date_format:Y-m-d',
            'vacations_start_at'  => 'nullable|date_format:Y-m-d',
            'vacations_end_at'  => 'nullable|date_format:Y-m-d',
            'days_vacations'  => 'nullable|integer',
            'children'  => 'nullable|integer',
        ];

        return $defaultValidations;
    }

    public static function validate($validateEvent, Request $request, $id = '')
    {
        $redirectRoute = '';
        $validations = [];

        switch($validateEvent)   {
            case 'create':
                $redirectRoute = 'human-resources.create';
                $validations = [];
            break;
            case 'edit':
                $redirectRoute = 'human-resources.edit';
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
