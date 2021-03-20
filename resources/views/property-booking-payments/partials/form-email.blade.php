@php
    $disabled = (isset($disabled) && $disabled === true) ? "disabled='disabled'" : '';
@endphp

@include('partials.form-error-alert')

<fieldset {{ $disabled }}>
    <!-- load fields -->
    @include('property-booking-payments.partials.form-email-fields', ['row' => $row])

</fieldset>

<!-- form actions -->
@include('components.form.actions-email', [
    'id' => $row->id,
    'disabled' => $disabled,
    'edit_route' => '',
    'cancel_route' => 'property-booking-payments.edit',
    'routeParams' => [],
    'cancelParams' => [$payment->id],
    'skipDelete' => isRole('owner'),
])
