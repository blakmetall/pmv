@php
    $label = isset($label) ? $label : '';
@endphp

<div class="card">
    <div class="card-body app-form-fields-container">

        @if ($label)
            <span class="badge badge-primary r-badge mb-4">{{ $label }}</span>
        @endif 

        <!-- zone_id -->
        @include('components.form.select', [
            'group' => 'zone',
            'label' => __('City'),
            'name' => 'city_id',
            'required' => true,
            'value' => $row->city_id,
            'options' => $cities,
            'optionValueRef' => 'id',
            'optionLabelRef' => 'name',
        ])
        
    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>