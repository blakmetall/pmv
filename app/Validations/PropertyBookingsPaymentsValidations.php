<?php

namespace App\Validations;

use Illuminate\Http\Request;

class PropertyBookingsPaymentsValidations extends Validation
{
    public function __construct()
    {
        $this->setDefaultValidations([
            'booking_id'            => 'required',
            'transaction_source_id' => 'required',
            'amount'                => 'required',
            'exchange_rate'         => 'required',
            'damage_insurance'      => 'required',
            'comission'             => 'required',
            'bank_fees'             => 'required',
            'post_date'             => 'required',
        ]);
    }

    public function validate($validateEvent = '', Request $request, $id = '')
    {
        $eventValidations = [];
        $customValidationMessages = [];

        switch ($validateEvent) {
            case 'create':
                break;
            case 'edit':
                break;
        }

        $validations = array_merge($this->getDefaultValidations(), $eventValidations);

        $this->runValidations($request->all(), $validations, $customValidationMessages);
    }
}
