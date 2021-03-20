@php
    $disabled = (isset($disabled) && $disabled === true) ? "disabled='disabled'" : '';
@endphp

@include('partials.form-error-alert')

<fieldset {{ $disabled }}>

    <!-- load fields -->
    @include('cleaning-services.partials.form-fields', ['row' => $row])

    {{-- display cleaning staff if assigned --}}
    @include('cleaning-services.partials.assigned-cleaning-staff', ['cleaning-service', $row])

</fieldset>

@php
    $skipCancel = isset($withModal) ? true : false;
    $skipEdit   = isRole('owner') ? true : false;
    $skipDelete = isset($withModal) || isRole('owner') ? true : false;
@endphp

<!-- form actions -->
@include('components.form.actions', [
    'id' => $row->id,
    'disabled' => $disabled,
    'edit_route' => 'cleaning-services.edit',
    'cancel_route' => 'cleaning-services',
    'delete_route' => 'cleaning-services.destroy',
    'skipEdit'   => $skipEdit,
    'skipDelete' => $skipDelete,
    'skipDelete' => $skipDelete,
    'skipCancel' => $skipCancel,
])
