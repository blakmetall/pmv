@php
    $disabled = (isset($disabled) && $disabled === true) ? "disabled='disabled'" : '';
@endphp

@include('partials.form-error-alert')

<fieldset {{ $disabled }}>

    <!-- load fields -->
    @include('cleaning-services.partials.form-fields-modal', ['row' => $row])

</fieldset>

@php
    $skipCancel = isset($withModal) ? true : false;
    $skipDelete = false;
    $isModal = true;
@endphp

<!-- form actions -->
@include('components.form.actions', [
    'id' => $row->id,
    'disabled' => $disabled,
    'edit_route' => 'cleaning-services.edit',
    'cancel_route' => 'cleaning-services',
    'delete_route' => 'cleaning-services.destroy-ajax',
    'skipEdit' => isRole('owner'),
    'skipDelete' => $skipDelete,
    'skipCancel' => $skipCancel,
    'isModal' => $isModal,
])
