@php
    $label = isset($label) ? $label : '';
@endphp

<div class="card">
    <div class="card-body">

        @if ($label)
            <span class="badge badge-primary r-badge mb-4">{{ $label }}</span>
        @endif 

        <!-- description -->
        @include('components.form.textarea', [
            'group' => 'damage-deposit',
            'label' => __('Description'),
            'name' => 'description',
            'lang' => $lang,
            'required' => true,
            'value' => $row->{$lang}->description,
        ])

    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>