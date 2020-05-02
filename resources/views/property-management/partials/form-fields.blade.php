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
        @include('components.form.input', [
            'group' => 'property-rate',
            'label' => __('Start Date'),
            'name' => 'start_date',
            'value' => $row->start_date,
            'required' => true,
        ])

        <!-- end_date -->
        @include('components.form.input', [
            'group' => 'property-rate',
            'label' => __('End Date'),
            'name' => 'end_date',
            'value' => $row->end_date,
        ])

        <!-- management_fee -->
        @include('components.form.input', [
            'group' => 'property-rate',
            'label' => __('Fee'),
            'name' => 'management_fee',
            'value' => $row->management_fee,
            'required' => true,
        ])

    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>
