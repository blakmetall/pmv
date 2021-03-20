@php
    $label = isset($label) ? $label : '';
@endphp

<div class="card">
    <div class="card-body app-form-fields-container">

        @if ($label)
            <span class="badge badge-primary r-badge mb-4">{{ $label }}</span>
        @endif 

        <!-- price -->
        @include('components.form.input', [
            'group' => 'damage-deposit',
            'label' => __('Price'),
            'name' => 'price',
            'required' => true,
            'value' => $row->price
        ])

        <!-- is_refundable -->
        @include('components.form.checkbox', [
            'group' => 'damage-deposit',
            'label' => __('Refundable'),
            'name' => 'is_refundable',
            'value' => 1,
            'default' => $row->is_refundable,
        ])
        
    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>