<?php

namespace App\Validations;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class WorkgroupsValidations extends Validation
{  
    public function validate($validateEvent, Request $request, $id = '')
    {
        $eventValidations = [];
        $customValidationMessages = [
            'city_id.unique' => __('The city you\'ve selected already belongs to another Workgroup')
        ];

        switch($validateEvent)   {
            case 'create':
                $eventValidations = [
                    'city_id' => [
                        'required',
                        Rule::unique('workgroups')
                    ],
                ];
            break;
            case 'edit':
                $eventValidations = [
                    'city_id' => [
                        'required',
                        Rule::unique('workgroups')->ignore($id)
                    ],
                ];
            break;
        }

        $validations = array_merge($this->getDefaultValidations(), $eventValidations);

        $this->runValidations($request->all(), $validations, $customValidationMessages);
    }
}