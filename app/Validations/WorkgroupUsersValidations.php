<?php

namespace App\Validations;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\WorkgroupUser;

class WorkgroupUsersValidations
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
            'workgroup_id' => 'required',
        ];

        return $defaultValidations;
    }

    public static function getDefaultMessages()
    {
        $defaultMessages = [
            'user_id.unique_with' => __('This user already belongs to the current Workgroup.')
        ];

        return $defaultMessages;
    }

    public static function validate($validateEvent, Request $request, $id = '')
    {
        $redirectRoute = '';
        $validations = [];

        $workgroupTemplate = new WorkgroupUser;
        $table = $workgroupTemplate->_getTable();

        switch($validateEvent)   {
            case 'create':
                $redirectRoute = 'workgroup-users.create';
                $validations = [
                    'user_id' => "required|unique_with:{$table},workgroup_id"
                ];
            break;
            case 'edit':
                $skipID = $id;
                $redirectRoute = 'workgroup-users.edit';
                $validations = [
                    'user_id' => "required|unique_with:{$table},workgroup_id,{$skipID}"
                ];
            break;
        }

        $validations = array_merge(self::getDefaultValidations(), $validations);
        $validator = Validator::make($request->all(), $validations, self::getDefaultMessages());

        if( $validator->fails() ) {
            throw new ValidationException($validator);
        }
    }
}