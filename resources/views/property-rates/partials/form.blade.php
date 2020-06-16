@php
    $disabled = (isset($disabled) && $disabled === true) ? "disabled='disabled'" : '';
@endphp

@include('partials.form-error-alert')

<fieldset {{ $disabled }}>

    <!-- load fields -->
    @include('property-rates.partials.form-fields', ['row' => $row])

</fieldset>

<!-- form actions -->
@include('components.form.actions', [
    'id' => $row->id,
    'disabled' => $disabled,
    'edit_route' => 'property-rates.edit',
    'cancel_route' => 'property-rates',
    'delete_route' => 'property-rates.destroy',
    'routeParams' => [$property->id],
    'skipEdit' => isRole('owner'),
    'skipDelete' => isRole('owner'),
])