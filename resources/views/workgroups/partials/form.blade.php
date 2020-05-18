@php
    $disabled = (isset($disabled) && $disabled === true) ? "disabled='disabled'" : '';
@endphp

@include('partials.form-error-alert')

<fieldset {{ $disabled }}>

    @include('workgroups.partials.form-fields', [
        'row' => $row,
        'cities' => $cities,
    ])

</fieldset>

<!-- form actions -->
@include('components.form.actions', [
    'id' => $row->id,
    'disabled' => $disabled,
    'edit_route' => 'workgroups.edit',
    'cancel_route' => 'workgroups',
    'delete_route' => 'workgroups.destroy',
])