@php
    $disabled = (isset($disabled) && $disabled === true) ? "disabled='disabled'" : '';
@endphp

@include('partials.form-error-alert')

<fieldset {{ $disabled }}>

    <!-- load fields -->
    @include('staff-groups.partials.form-fields', ['row' => $row])

</fieldset>

<!-- form actions -->
@include('components.form.actions', [
    'id' => $row->id,
    'disabled' => $disabled,
    'edit_route' => 'staff-groups.edit',
    'cancel_route' => 'staff-groups',
    'delete_route' => 'staff-groups.destroy',
])
