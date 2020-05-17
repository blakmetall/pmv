<?php

namespace App\Validations;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class WorkgroupsValidations
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
        $defaultValidations = [];

        return $defaultValidations;
    }

    public static function getDefaultMessages()
    {
        $defaultMessages = [
            'city_id.unique' => __('The city you\'ve selected already belongs to another Workgroup')
        ];

        return $defaultMessages;
    }

    public static function validate($validateEvent, Request $request, $id = '')
    {
        $redirectRoute = '';
        $validations = [];

        switch($validateEvent)   {
            case 'create':
                $redirectRoute = 'workgroups.create';
                $validations = [
                    'city_id' => [
                        'required',
                        Rule::unique('workgroups')
                    ],
                ];
            break;
            case 'edit':
                $redirectRoute = 'workgroups.edit';
                $validations = [
                    'city_id' => [
                        'required',
                        Rule::unique('workgroups')->ignore($id)
                    ],
                ];
            break;
        }

        $defaultMessages = self::getDefaultMessages();
        $validations = array_merge(self::getDefaultValidations(), $validations);

        $validator = Validator::make($request->all(), $validations, $defaultMessages);

        if( $validator->fails() ) {
            throw new ValidationException($validator);
        }

        // VALIDATION CUSTOM MESSAGE
    }
}