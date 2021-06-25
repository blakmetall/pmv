@php
    $disabled = (isset($disabled) && $disabled === true) ? "disabled='disabled'" : '';
@endphp

@include('partials.form-error-alert')

<fieldset {{ $disabled }}>

    <!-- load fields -->
    @include('property-bookings.partials.form-fields', ['row' => $row])

</fieldset>

@php
    $skipEdit = $row->id ? true : false;
    $skipDelete = $row->id ? false : true;
    
    if($row->id){
        $skipEdit = isRole('owner') && $row->register_by != 'Owner' && !can('edit', 'property-bookings');
        $skipDelete = isRole('owner') && $row->register_by != 'Owner' && !can('edit', 'property-bookings');
    }
    
@endphp

<!-- form actions -->
@include('components.form.actions', [
    'id' => $row->id,
    'disabled' => $disabled,
    'edit_route' => 'property-bookings.edit',
    'cancel_route' => 'property-bookings',
    'delete_route' => 'property-bookings.destroy',
    'routeParams' => [],
    'skipDelete' => $skipDelete,
    'skipEdit' => $skipEdit,
])
