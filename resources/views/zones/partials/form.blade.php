@php
    $disabled = (isset($disabled) && $disabled === true) ? "disabled='disabled'" : '';
@endphp

@include('partials.form-error-alert')

<fieldset {{ $disabled }}>

    <!-- load regular fields -->
    @include('zones.partials.form-fields', [
        'row' => $row,
        'cities' => $cities
    ])

    <!-- load english fields -->
    @include('zones.partials.form-translatable-fields', [
        'label' => __('ENGLISH'),
        'lang' => 'en',
        'row' => $row
    ])

    <!-- load spanish fields -->
    @include('zones.partials.form-translatable-fields', [
        'label' => __('SPANISH'),
        'lang' => 'es',
        'row' => $row
    ])

</fieldset>

<!-- form actions -->
@include('components.form.actions', [
    'id' => $row->id,
    'disabled' => $disabled,
    'edit_route' => 'zones.edit',
    'cancel_route' => 'zones',
    'delete_route' => 'zones.destroy',
])