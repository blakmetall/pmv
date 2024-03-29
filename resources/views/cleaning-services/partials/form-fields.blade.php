<!-- fields form -->
<div class="card">
    <div class="card-body">

        <!-- property_id -->
        @include('components.form.select', [
            'group' => 'cleaning-service',
            'label' => __('Property'),
            'name' => 'property_id',
            'required' => true,
            'value' => $row->property_id,
            'options' => $properties,
            'optionValueRef' => 'property_id',
            'optionLabelRef' => 'name',
        ])

        <!-- date -->
        @include('components.form.datepicker', [
            'group' => 'cleaning-service',
            'label' => __('Date'),
            'name' => 'date',
            'required' => true,
            'value' => $row->date,
            'maxDaysLimitFromNow' => 3600,
        ])

        <!-- status -->
        @include('components.form.fast-select', [
            'group' => 'property',
            'label' => __('Status'),
            'multiple' => true,
            'name' => 'status_ids',
            'disableDefaultOption' => true,
            'options' => prepareSelectValuesFromRows($status, [
                'valueRef' => 'id'
            ]),
            'default' => prepareSelectDefaultValues($row->cleaningServicesStatus, [
                'valueRef' => 'id',
            ]),
        ])

        <!-- maid_fee -->
        @include('components.form.number', [
            'group' => 'cleaning-service',
            'type' => 'number',
            'label' => __('Cost'),
            'name' => 'maid_fee',
            'required' => true,
            'value' => $row->maid_fee
        ])

        <!-- sunday_bonus -->
        @include('components.form.number-bonus', [
            'group' => 'property',
            'type' => 'number',
            'label' => __('Extra cost'),
            'name' => 'sunday_bonus',
            'required' => true,
            'value' => $row->sunday_bonus
        ])

        <!-- description -->
        @include('components.form.textarea', [
            'group' => 'cleaning-service',
            'label' => __('Description'),
            'name' => 'description',
            'required' => true,
            'value' => $row->description
        ])

        <!-- is_finished -->
        @include('components.form.checkbox', [
            'group' => 'cleaning-service',
            'label' => __('Finished'),
            'name' => 'is_finished',
            'value' => 1,
            'default' => $row->is_finished,
        ])

        <!-- audit -->
        @if ($row->auditedBy)
            @include('components.form.input', [
                'group' => 'cleaning-service',
                'label' => __('Audited by'),
                'name' => 'audited_by',
                'value' => $row->auditedBy->profile->full_name,
                'disabled' => true,
            ])
        @endif

    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>
