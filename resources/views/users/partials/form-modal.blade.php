@php
    $disabled = (isset($disabled) && $disabled === true) ? "disabled='disabled'" : '';
@endphp

@include('partials.form-error-alert')

<fieldset {{ $disabled }}>

    <!-- load fields -->
    @include('users.partials.form-fields', [
        'label' => __('Account'),
        'row' => $row,
        'roles' => $roles,
        'workgroups' => $workgroups,
    ])

</fieldset>

<ul id="errors-modal">
    
</ul>

@php
    $skipCancel = true;
    $skipDelete = true;
    $isModal = true;
@endphp

<!-- form actions -->
@include('components.form.actions', [
    'id' => $row->id,
    'disabled' => $disabled,
    'edit_route' => 'users.edit',
    'cancel_route' => 'users',
    'delete_route' => 'users.destroy',
    'skipEdit' => isRole('owner'),
    'skipDelete' => $skipDelete,
    'skipCancel' => $skipCancel,
    'isModal' => $isModal,
])
