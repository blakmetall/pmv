@php
    $disabled = (isset($disabled) && $disabled === true) ? "disabled='disabled'" : '';
@endphp

@include('partials.form-error-alert')

<fieldset {{ $disabled }}>

    <!-- load english fields -->
    @include('amenities.partials.form-fields', [
        'label' => __('ENGLISH'),
        'lang' => 'en',
        'row' => $row
    ])

    <!-- load spanish fields -->
    @include('amenities.partials.form-fields', [
        'label' => __('SPANISH'),
        'lang' => 'es',
        'row' => $row
    ])

</fieldset>

<!-- form actions -->
@include('partials.form-actions', [
    'id' => $row->id,
    'disabled' => $disabled,
    'edit_route' => 'amenities.edit',
    'cancel_route' => 'amenities',
    'delete_route' => 'amenities.destroy',
])