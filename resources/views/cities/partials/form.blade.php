@php
    $disabled = (isset($disabled) && $disabled === true) ? "disabled='disabled'" : '';
@endphp

@include('partials.form-error-alert')

<fieldset {{ $disabled }}>

    @include('cities.partials.form-fields', [
        'row' => $row,
        'states' => $states,
    ])

</fieldset>

<!-- form actions -->
@include('components.form.actions', [
    'id' => $row->id,
    'disabled' => $disabled,
    'edit_route' => 'cities.edit',
    'cancel_route' => 'cities',
    'delete_route' => 'cities.destroy',
])