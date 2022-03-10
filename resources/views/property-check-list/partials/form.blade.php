@php
    $disabled = (isset($disabled) && $disabled === true) ? "disabled='disabled'" : '';
@endphp

@include('partials.form-error-alert')

<fieldset {{ $disabled }}>

    <!-- load fields -->
    @include('property-check-list.partials.form-fields', ['row' => $row])

</fieldset>

<!-- form actions -->
@include('components.form.actions', [
    'id' => $row->id,
    'disabled' => $disabled,
    'edit_route' => 'property-check-list.edit',
    'cancel_route' => 'property-check-list',
    'routeParams' => [$property->id],
    'skipDelete' => isRole('owner'),
    'skipEdit' => isRole('owner'),
])
