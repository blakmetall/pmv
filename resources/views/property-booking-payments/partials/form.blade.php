@php
    $disabled = (isset($disabled) && $disabled === true) ? "disabled='disabled'" : '';
@endphp

@include('partials.form-error-alert')

<fieldset {{ $disabled }}>
    <!-- load fields -->
    @include('property-booking-payments.partials.form-fields', ['row' => $row])

</fieldset>

<!-- form actions -->
@include('components.form.actions-payments', [
    'id' => $row->id,
    'disabled' => $disabled,
    'edit_route' => 'property-booking-payments.edit',
    'cancel_route' => 'property-booking-payments',
    'routeParams' => [],
    'cancelParams' => [$booking->id],
    'skipDelete' => isRole('owner'),
])
