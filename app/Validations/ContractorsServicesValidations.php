<?php

namespace App\Validations;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

class ContractorsServicesValidations
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
            'contractor_id' => 'required',
            'base_price' => 'required|numeric',
            'en.name' => 'required',
            'es.name' => 'required',
        ];

        return $defaultValidations;
    }

    public static function validate($validateEvent, Request $request, $id = '')
    {
        $redirectRoute = '';
        $validations = [];

        switch($validateEvent)   {
            case 'create':
                $redirectRoute = 'contractors-services.create';
                $validations = [];
            break;
            case 'edit':
                $redirectRoute = 'contractors-services.edit';
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