

<!-- property_id -->
<div class="app-pm-property-select-wrapper" 
    data-generate-pm-transaction-url="{{ route('property-management.generate-pm-transaction-url') }}">

    @include('components.form.select', [
        'group' => 'properties',
        'label' => __('Property'),
        'name' => 'property_id',
        'required' => true,
        'value' => '',
        'options' => $properties,
        'optionValueRef' => 'property_id',
        'optionLabelRef' => 'name',
    ])
    
</div>