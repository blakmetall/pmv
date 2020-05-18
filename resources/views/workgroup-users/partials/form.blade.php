@php
    $disabled = (isset($disabled) && $disabled === true) ? "disabled='disabled'" : '';
@endphp

@include('partials.form-error-alert')

<fieldset {{ $disabled }}>

    <!-- load fields -->
    @include('workgroup-users.partials.form-fields', ['row' => $row])

</fieldset>

<!-- form actions -->
@include('components.form.actions', [
    'id' => $row->id,
    'disabled' => $disabled,
    'edit_route' => 'workgroup-users.edit',
    'cancel_route' => 'workgroup-users',
    'delete_route' => 'workgroup-users.destroy',
    'routeParams' => [$workgroup->id]
])