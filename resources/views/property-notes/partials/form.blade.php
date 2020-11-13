@php
    $disabled = (isset($disabled) && $disabled === true) ? "disabled='disabled'" : '';
@endphp

@include('partials.form-error-alert')

<fieldset {{ $disabled }}>

    <!-- load fields -->
    @include('property-notes.partials.form-fields', ['row' => $row])

</fieldset>

<!-- form actions -->
@include('components.form.actions', [
    'id' => $row->id,
    'disabled' => $disabled,
    'edit_route' => 'property-notes.edit',
    'cancel_route' => 'property-notes',
    'delete_route' => 'property-notes.destroy',
    'routeParams' => [$property->id],
    'skipEdit' => isRole('owner') || isRole('contact'),
    'skipDelete' => isRole('owner') || isRole('contact'),
])