@php
    $disabled = (isset($disabled) && $disabled === true) ? "disabled='disabled'" : '';
@endphp

@include('partials.form-error-alert')

<fieldset {{ $disabled }}>

    <!-- load fields -->
    @include('agents.partials.form-fields', [
        'label' => __('Account'),
        'row' => $row,
        'roles' => $roles,
    ])

</fieldset>

<!-- form actions -->
@include('components.form.actions', [
    'id' => $row->id,
    'disabled' => $disabled,
    'edit_route' => 'agents.edit',
    'cancel_route' => 'agents',
    'delete_route' => 'agents.destroy',
])