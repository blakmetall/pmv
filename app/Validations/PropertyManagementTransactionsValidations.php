<?php

namespace App\Validations;

use Illuminate\Http\Request;

class PropertyManagementTransactionsValidations extends Validation
{  
    public function __construct()
    {
        $this->setDefaultValidations([
            'period_start_date' => 'nullable|date_format:Y-m-d',
            'period_end_date' => 'nullable|date_format:Y-m-d',
            'post_date' => 'nullable|date_format:Y-m-d',
            'amount' => 'required|numeric|min:0',
            'operation_type' => 'required|numeric|between:1,2',
            'transaction_file' => '' // validation types
        ]);
    }

    public function validate($validateEvent, Request $request, $id = '')
    {
        $eventValidations = [];
        $customValidationMessages = [];

        switch($validateEvent)   {
            case 'create': break;
            case 'edit': break;
        }

        $validations = array_merge($this->getDefaultValidations(), $eventValidations);

        $this->runValidations($request->all(), $validations, $customValidationMessages);
    }
}