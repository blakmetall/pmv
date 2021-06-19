@php
    $disabled = (isset($disabled) && $disabled === true) ? "disabled='disabled'" : '';
@endphp

@include('partials.form-error-alert')

<fieldset {{ $disabled }}>

    <!-- load fields -->
    @include('property-images.partials.form-fields', ['row' => $row])

</fieldset>

<!-- form actions -->
@include('components.form.actions', [
    'id' => $row->id,
    'disabled' => $disabled,
    'edit_route' => 'property-images.edit',
    'cancel_route' => 'property-images',
    'delete_route' => 'property-images.destroy',
    'routeParams' => [$property->id],
    'skipEdit' => !can('edit', 'property-images'),
    'skipDelete' => !can('delete', 'property-images'),
])
