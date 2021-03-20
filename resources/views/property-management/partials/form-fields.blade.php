<!-- fields form -->
<div class="card">
    <div class="card-body">

        <!-- property_id -->
        @include('components.form.select', [
            'group' => 'property-rate',
            'label' => __('Property'),
            'name' => 'property_id',
            'required' => true,
            'value' => $row->property_id,
            'options' => [$property],
            'optionValueRef' => 'id',
            'optionLabelRef' => 'name',
            'translatable' => true,
            'disableDefaultOption' => true
        ])

        <!-- start_date -->
        @include('components.form.datepicker', [
            'group' => 'property-rate',
            'label' => __('Start Date'),
            'name' => 'start_date',
            'value' => $row->start_date,
            'required' => true,
            'maxDaysLimitFromNow' => 1000,
        ])

        <!-- end_date -->
        @include('components.form.datepicker', [
            'group' => 'property-rate',
            'label' => __('End Date'),
            'name' => 'end_date',
            'value' => $row->end_date,
            'maxDaysLimitFromNow' => 4000,
        ])

        <!-- management_fee -->
        @include('components.form.input', [
            'group' => 'property-rate',
            'label' => __('Fee') . ' USD',
            'name' => 'management_fee',
            'value' => $row->management_fee,
            'required' => true,
        ])

        <!-- average_month -->
        @include('components.form.input', [
            'group' => 'property-management',
            'label' => __('Avg. Month') . ' MXN',
            'name' => 'average_month',
            'value' => $row->average_month,
            'required' => true,
        ])

        <!-- initial_balance -->
        @include('components.form.input', [
            'group' => 'property-management',
            'label' => __('Initial balance') . ' MXN',
            'name' => 'initial_balance',
            'value' => $row->initial_balance,
        ])

        <!-- is_finished -->
        @include('components.form.checkbox', [
            'group' => 'property-management',
            'label' => __('Finished'),
            'name' => 'is_finished',
            'value' => 1,
            'default' => $row->is_finished,
        ])

    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>
