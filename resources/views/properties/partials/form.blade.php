@php
    $disabled = (isset($disabled) && $disabled === true) ? "disabled='disabled'" : '';
@endphp

@include('partials.form-error-alert')

<fieldset {{ $disabled }}>

    <!-- load english fields -->
    @include('properties.partials.form-translatable-fields', [
        'label' => __('ENGLISH'),
        'lang' => 'en',
        'row' => $row
    ])

    <!-- load spanish fields -->
    @include('properties.partials.form-translatable-fields', [
        'label' => __('SPANISH'),
        'lang' => 'es',
        'row' => $row
    ])

    <!-- load rates fields -->
    @include('properties.partials.form-rates', [
        'label' => __('RATES'),
        'row' => $row
    ])

    <!-- load regular fields -->
    @include('properties.partials.form-fields', [
        'label' => __('SHARED'),
        'row' => $row,
        'beddingOptions' => $beddingOptions,
    ])

</fieldset>

<!-- form actions -->
@include('components.form.actions', [
    'id' => $row->id,
    'disabled' => $disabled,
    'edit_route' => 'properties.edit',
    'cancel_route' => 'properties',
    'delete_route' => 'properties.destroy',
    'skipEdit' => isRole('owner') || !can('edit', 'properties'),
    'skipDelete' => isRole('owner') || !can('edit', 'properties'),
])