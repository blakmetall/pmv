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
            //'cleaning_staff_id'                  => 'required',
            //'property_management_transaction_id' => 'required',
            //'booking_id'                         => 'required',
            'date'                               => 'required',
            'hour'                               => 'required',
            'description'                        => 'required',
            'maid_fee'                           => 'required',
            'audit_datetime'                     => 'required',
            'audit_user_id'                      => 'required',
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
            dd($validator->errors());
            throw new ValidationException($validator->errors());
        }
    }
}
