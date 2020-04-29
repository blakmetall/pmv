@php
    $disabled = (isset($disabled) && $disabled === true) ? "disabled='disabled'" : '';
@endphp

@include('partials.form-error-alert')

<fieldset {{ $disabled }}>

    <!-- load fields -->
    @include('property-management.partials.form-fields', ['row' => $row])

</fieldset>

<!-- form actions -->
@include('components.form.actions', [
    'id' => $row->id,
    'disabled' => $disabled,
    'edit_route' => 'property-management.edit',
    'cancel_route' => 'property-management',
    'delete_route' => 'property-management.destroy',
    'routeParams' => [$property->id]
])