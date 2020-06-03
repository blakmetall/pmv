<!-- fields form -->
<div class="card">
    <div class="card-body">

        <!-- property -->
        @include('components.form.input', [
            'group' => 'property-management-transaction',
            'label' => __('Property'),
            'name' => 'property_id',
            'value' => $pm->property->translate()->name,
            'disabled' => true,
        ]) 
       
        <!-- property_management_id -->
        @include('components.form.select', [
            'group' => 'property-management-transaction',
            'label' => __('Property Management'),
            'name' => 'property_management_id',
            'required' => true,
            'value' => $row->property_management_id,
            'options' => [$pm],
            'optionValueRef' => 'id',
            'optionLabelRef' => 'id',
            'hidden' => true,
            'disableDefaultOption' => true
        ]) 

        <!-- transaction_type_id -->
        @include('components.form.select', [
            'group' => 'property-management-transaction',
            'label' => __('Transaction'),
            'name' => 'transaction_type_id',
            'value' => $row->transaction_type_id,
            'options' => $transactionTypes,
            'optionValueRef' => 'transaction_type_id',
            'optionLabelRef' => 'transactionType:translate,name',
        ]) 

        <!-- amount -->
        @include('components.form.input', [
            'group' => 'property-management-transaction',
            'label' => __('Amount'),
            'name' => 'amount',
            'value' => $row->amount,
            'required' => true
        ])

        <!-- transaction_type_id -->
        @include('components.form.select', [
            'group' => 'property-management-transaction',
            'label' => __('Operation Type'),
            'name' => 'operation_type',
            'value' => $row->operation_type,
            'options' => $paymentTypes,
            'translatable' => false,
            'optionValueRef' => 'id',
            'optionLabelRef' => 'label',
            'required' => true,
            'disableDefaultOption' => true
        ]) 

        <!-- period_start_date -->
        @include('components.form.datepicker', [
            'group' => 'property-management-transaction',
            'label' => __('Period Start Date'),
            'name' => 'period_start_date',
            'value' => $row->period_start_date,
            'maxDaysLimitFromNow' => 360,
        ])

        <!-- period_end_date -->
        @include('components.form.datepicker', [
            'group' => 'property-management-transaction',
            'label' => __('Period End Date'),
            'name' => 'period_end_date',
            'value' => $row->period_end_date,
            'maxDaysLimitFromNow' => 360,
        ])

        <!-- post_date -->
        @include('components.form.datepicker', [
            'group' => 'property-management-transaction',
            'label' => __('Post Date'),
            'name' => 'post_date',
            'value' => $row->post_date,
            'maxDaysLimitFromNow' => 360,
        ])

        <!-- description -->
        @include('components.form.textarea', [
            'group' => 'property-management-transaction',
            'label' => __('Description'),
            'name' => 'description',
            'value' => $row->description,
        ])

    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>
