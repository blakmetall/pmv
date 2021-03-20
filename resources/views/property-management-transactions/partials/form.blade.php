@php
    $disabled = (isset($disabled) && $disabled === true) ? "disabled='disabled'" : '';
@endphp

@include('partials.form-error-alert')

<fieldset {{ $disabled }}>

    <!-- load fields -->
    @include('property-management-transactions.partials.form-fields', ['row' => $row])

</fieldset>

@php
    $skipEdit   = isRole('owner') ? true : false;
    $skipCancel = isset($withModal) ? true : false;
    $skipDelete = isset($withModal) || isRole('owner') ? true : false;
@endphp

<!-- form actions -->
@include('components.form.actions', [
'id' => $row->id,
'disabled' => $disabled,
'edit_route' => 'property-management-transactions.edit',
'cancel_route' => 'property-management-transactions',
'delete_route' => 'property-management-transactions.destroy',
'routeParams' => [$pm->id],
'skipEdit' => $skipEdit,
'skipDelete' => $skipDelete,
'skipCancel' => $skipCancel,
])