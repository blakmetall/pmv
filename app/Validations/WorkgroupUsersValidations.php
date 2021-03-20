<?php

namespace App\Validations;

use Illuminate\Http\Request;
use App\Models\WorkgroupUser;

class WorkgroupUsersValidations extends Validation
{  
    public function __construct()
    {
        $this->setDefaultValidations([
            'workgroup_id' => 'required',
        ]);
    }

    public function validate($validateEvent, Request $request, $id = '')
    {
        $eventValidations = [];
        $customValidationMessages = [
            'user_id.unique_with' => __('This user already belongs to the current Workgroup.')
        ];

        $workgroupUserObj = new WorkgroupUser;
        $table = $workgroupUserObj->_getTable();

        switch($validateEvent)   {
            case 'create':
                $eventValidations = [
                    'user_id' => "required|unique_with:{$table},workgroup_id"
                ];
            break;
            case 'edit':
                $skipID = $id;
                $eventValidations = [
                    'user_id' => "required|unique_with:{$table},workgroup_id,{$skipID}"
                ];
            break;
        }

        $validations = array_merge($this->getDefaultValidations(), $eventValidations);

        $this->runValidations($request->all(), $validations, $customValidationMessages);
    }
}