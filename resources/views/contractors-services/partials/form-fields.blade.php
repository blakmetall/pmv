@php
    $label = isset($label) ? $label : '';
@endphp

<div class="card">
    <div class="card-body app-form-fields-container">

        @if ($label)
            <span class="badge badge-primary r-badge mb-4">{{ $label }}</span>
        @endif 

        <!-- contractor_id -->
        @include('components.form.select', [
            'group' => 'contractor-service',
            'label' => __('Contractor'),
            'name' => 'contractor_id',
            'required' => true,
            'value' => $row->contractor_id,
            'options' => $contractors,
            'optionValueRef' => 'id',
            'optionLabelRef' => 'company',
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