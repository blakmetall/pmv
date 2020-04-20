@php
    $label = isset($label) ? $label : '';
@endphp

<div class="card">
    <div class="card-body app-form-fields-container">

        @if ($label)
            <span class="badge badge-primary r-badge mb-4">{{ $label }}</span>
        @endif 

        <!-- user_id -->
        @include('components.form.select', [
            'group' => 'property',
            'label' => __('Owner'),
            'name' => 'user_id',
            'required' => true,
            'value' => $row->user_id,
            'options' => $users,
            'optionValueRef' => 'id',
            'optionLabelRef' => 'email',
        ])

        <!-- city_id -->
        @include('components.form.select', [
            'group' => 'property',
            'label' => __('City'),
            'name' => 'city_id',
            'required' => true,
            'value' => $row->city_id,
            'options' => $cities,
            'optionValueRef' => 'id',
            'optionLabelRef' => 'name',
        ])

        <!-- zone_id -->
        @include('components.form.select', [
            'group' => 'property',
            'label' => __('Zone'),
            'name' => 'zone_id',
            'required' => true,
            'value' => $row->zone_id,
            'options' => $zones,
            'optionValueRef' => 'id',
            'optionLabelRef' => 'id',
        ])

        <!-- cleaning_option_id -->
        @include('components.form.select', [
            'group' => 'property',
            'label' => __('Cleaning Option'),
            'name' => 'cleaning_option_id',
            'required' => true,
            'value' => $row->cleaning_option_id,
            'options' => $cleaningOptions,
            'optionValueRef' => 'id',
            'optionLabelRef' => 'id',
        ])

        <!-- property_type_id -->
        @include('components.form.select', [
            'group' => 'property',
            'label' => __('Type'),
            'name' => 'property_type_id',
            'required' => true,
            'value' => $row->property_type_id,
            'options' => $propertyTypes,
            'optionValueRef' => 'id',
            'optionLabelRef' => 'id',
        ])

        <!-- bedrooms -->
        @include('components.form.input', [
            'group' => 'property',
            'label' => __('Bedrooms'),
            'name' => 'bedrooms',
            'required' => true,
            'value' => $row->bedrooms
        ])

        <!-- baths -->
        @include('components.form.input', [
            'group' => 'property',
            'label' => __('Baths'),
            'name' => 'baths',
            'required' => true,
            'value' => $row->baths
        ])

        <!-- sleeps -->
        @include('components.form.input', [
            'group' => 'property',
            'label' => __('Sleeps'),
            'name' => 'sleeps',
            'value' => $row->sleeps
        ])

        <!-- floors -->
        @include('components.form.input', [
            'group' => 'property',
            'label' => __('Floors'),
            'name' => 'floors',
            'value' => $row->floors
        ])
        
        <!-- building -->
        @include('components.form.input', [
            'group' => 'property',
            'label' => __('Building'),
            'name' => 'building',
            'value' => $row->building
        ])

        <!-- rental_commission -->
        @include('components.form.input', [
            'group' => 'property',
            'label' => __('Rental Commission'),
            'name' => 'rental_commission',
            'required' => true,
            'value' => $row->rental_commission
        ])

        <!-- maid_fee -->
        @include('components.form.input', [
            'group' => 'property',
            'label' => __('Maid Fee'),
            'name' => 'maid_fee',
            'required' => true,
            'value' => $row->maid_fee
        ])

        <!-- lot_size_sqft -->
        @include('components.form.input', [
            'group' => 'property',
            'label' => __('Lot Size (sqft)'),
            'name' => 'lot_size_sqft',
            'value' => $row->lot_size_sqft
        ])

        <!-- construction_size_sqft -->
        @include('components.form.input', [
            'group' => 'property',
            'label' => __('Construction Size (sqft)'),
            'name' => 'construction_size_sqft',
            'value' => $row->construction_size_sqft
        ])

        <!-- phone -->
        @include('components.form.input', [
            'group' => 'property',
            'label' => __('Phone'),
            'name' => 'phone',
            'value' => $row->phone
        ])

        <!-- address -->
        @include('components.form.textarea', [
            'group' => 'property',
            'label' => __('Address'),
            'name' => 'address',
            'required' => true,
            'value' => $row->address,
        ])

        <!-- has_parking -->
        @include('components.form.checkbox', [
            'group' => 'property',
            'label' => __('Parking'),
            'name' => 'has_parking',
            'value' => 1,
            'default' => $row->has_parking,
        ])

        <!-- is_featured -->
        @include('components.form.checkbox', [
            'group' => 'property',
            'label' => __('Featured'),
            'name' => 'is_featured',
            'value' => 1,
            'default' => $row->is_featured,
        ])

        <!-- is_enabled -->
        @include('components.form.checkbox', [
            'group' => 'property',
            'label' => __('Enabled'),
            'name' => 'is_enabled',
            'value' => 1,
            'default' => $row->is_enabled,
        ])

        <!-- is_online -->
        @include('components.form.checkbox', [
            'group' => 'property',
            'label' => __('Online'),
            'name' => 'is_online',
            'value' => 1,
            'default' => $row->is_online,
        ])

    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>