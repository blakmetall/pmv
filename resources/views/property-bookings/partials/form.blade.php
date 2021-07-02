@php
    $disabled = (isset($disabled) && $disabled === true) ? "disabled='disabled'" : '';
@endphp

@include('partials.form-error-alert')

<fieldset {{ $disabled }}>

    <!-- load fields -->
    @include('property-bookings.partials.form-fields', ['row' => $row])

</fieldset>

@php
    $skipDelete = false;
    $skipEdit = false;

    if(isRole('owner')) {
        if($row->register_by != 'Owner'){
            $skipDelete = true;
            $skipEdit = true;
        }
    }else{
        if(!can('edit', 'property-bookings')) {
            $skipDelete = true;
            $skipEdit = true;
        }
    }
    
    $skipDelete = false;
    $skipEdit = false;

    if(!can('edit', 'property-bookings')) {
        $skipEdit = true;
    }

    if(!can('delete', 'property-bookings')) {
        $skipDelete = true;
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
