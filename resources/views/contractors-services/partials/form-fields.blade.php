@php
    $label = isset($label) ? $label : '';
@endphp

<div class="card">
    <div class="card-body app-form-fields-container">

        @if ($label)
            <span class="badge badge-primary r-badge mb-4">{{ $label }}</span>
        @endif 

        <!-- contractor_id -->
        @include('components.form.fast-select', [
            'group' => 'contractor-service',
            'label' => __('Contractor'),
            'multiple' => false,
            'name' => 'contractor_id',
            'required' => true,
            'options' => prepareSelectValuesFromRows($contractors, ['valueRef' => 'id', 'labelRef' => 'company']),
            'default' => prepareSelectDefaultValues([$row->contractor], ['valueRef' => 'id']),
        ])

        <!-- base_price -->
        @include('components.form.input', [
            'group' => 'contractor-service',
            'label' => __('Price'),
            'name' => 'base_price',
            'required' => true,
            'value' => $row->base_price
        ])

        <!-- previous_base_price -->
        @if ($row->previous_base_price)
            @include('components.form.input', [
                'group' => 'contractor-service',
                'label' => __('Previous Price'),
                'name' => 'previous_base_price',
                'value' => $row->previous_base_price,
                'disabled' => true
            ])
        @endif
        
    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>