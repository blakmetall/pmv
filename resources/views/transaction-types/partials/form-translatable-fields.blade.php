@php
    $label = isset($label) ? $label : '';
@endphp

<div class="card">
    <div class="card-body">

        @if ($label)
            <span class="badge badge-primary r-badge mb-4">{{ $label }}</span>
        @endif 
        
        <!-- name -->
        @include('components.form.input', [
            'group' => 'transaction-type',
            'label' => __('Name'),
            'name' => 'name',
            'lang' => $lang,
            'required' => true,
            'value' => $row->{$lang}->name
        ])

    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>