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
        'group' => 'property',
        'label' => __('Property'),
        'name' => 'name',
        'lang' => $lang,
        'required' => true,
        'value' => $row->{$lang}->name
        ])

        <!-- slug -->
        @include('components.form.input', [
        'group' => 'property',
        'label' => __('Slug'),
        'name' => 'slug',
        'lang' => $lang,
        'value' => $row->{$lang}->slug
        ])

        <!-- description -->
        @include('components.form.textarea', [
        'group' => 'property',
        'label' => __('Description'),
        'name' => 'description',
        'lang' => $lang,
        'required' => true,
        'value' => $row->{$lang}->description,
        ])

        <!-- cancellation_policies -->
        @include('components.form.textarea', [
        'group' => 'property',
        'label' => __('Cancellation Policies'),
        'name' => 'cancellation_policies',
        'lang' => $lang,
        'required' => true,
        'value' => $row->{$lang}->cancellation_policies,
        ])
    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>
