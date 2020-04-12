@php
    $disabled = (isset($disabled) && $disabled === true) ? "disabled='disabled'" : '';
@endphp

@include('partials.form-error-alert')

<fieldset {{ $disabled }}>

    <!-- load english fields -->
    @include('cleaning-options.partials.form-translatable-fields', [
        'label' => __('ENGLISH'),
        'lang' => 'en',
        'row' => $row
    ])

    <!-- load spanish fields -->
    @include('cleaning-options.partials.form-translatable-fields', [
        'label' => __('SPANISH'),
        'lang' => 'es',
        'row' => $row
    ])

</fieldset>

<!-- form actions -->
@include('components.form.actions', [
    'id' => $row->id,
    'disabled' => $disabled,
    'edit_route' => 'cleaning-options.edit',
    'cancel_route' => 'cleaning-options',
    'delete_route' => 'cleaning-options.destroy',
])