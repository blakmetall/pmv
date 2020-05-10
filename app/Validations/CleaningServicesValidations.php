<?php

namespace App\Validations;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CleaningServicesValidations
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
            'property_id'                        => 'required',
            'date'                               => 'required|date_format:Y-m-d',
            'hour'                               => 'nullable|date_format:H:i:s',
            'description'                        => 'required',
            'maid_fee'                           => 'required|numeric',
        ];

        return $defaultValidations;
    }

    public static function validate($validateEvent, Request $request, $id = '')
    {
        $redirectRoute = '';
        $validations = [];

        switch($validateEvent)   {
            case 'create':
                $redirectRoute = 'cleaning-services.create';
                $validations = [];
            break;
            case 'edit':
                $redirectRoute = 'cleaning-services.edit';
                $validations = [];
            break;
        }

        $validations = array_merge(self::getDefaultValidations(), $validations);
        $validator = Validator::make($request->all(), $validations);

        if( $validator->fails() ) {
            throw new ValidationException($validator->errors());
        }
    }
}
