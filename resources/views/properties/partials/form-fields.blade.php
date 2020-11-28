@php
    $label = isset($label) ? $label : '';
@endphp

<div class="card">
    <div class="card-body app-form-fields-container">

        @if ($label)
            <span class="badge badge-primary r-badge mb-4">{{ $label }}</span>
        @endif

        <!-- users_id --->
        @include('components.form.fast-select', [
            'group' => 'property',
            'label' => __('Owner'),
            'multiple' => true,
            'name' => 'users_ids',
            'required' => true,
            'options' => prepareSelectValuesFromRows($users, ['valueRef' => 'id', 'depthRef' => true, 'labelRef' => 'profile,full_name']),
            'default' => prepareSelectDefaultValues($row->users, ['valueRef' => 'id'])
        ])

        <!-- office_id -->
        @include('components.form.select', [
            'group' => 'property',
            'label' => __('Office'),
            'name' => 'office_id',
            'value' => $row->office_id,
            'options' => $offices,
            'optionValueRef' => 'id',
            'optionLabelRef' => 'name',
        ])

        <!-- state_id -->
        @include('components.form.select', [
            'group' => 'property',
            'label' => __('State'),
            'name' => 'state_id',
            'required' => true,
            'value' => $row->state_id,
            'options' => $states,
            'optionValueRef' => 'id',
            'optionLabelRef' => 'name',
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
            'optionValueRef' => 'zone_id',
            'optionLabelRef' => 'name',
        ])

        <!-- building_id -->
        @include('components.form.select', [
            'group' => 'property',
            'label' => __('Building'),
            'name' => 'building_id',
            'value' => $row->building_id,
            'options' => $buildings,
            'optionValueRef' => 'id',
            'optionLabelRef' => 'name',
        ])

        <!-- unit -->
        @include('components.form.input', [
            'group' => 'property',
            'label' => __('Unit'),
            'name' => 'unit',
            'value' => $row->unit,
        ])

        <!-- property_type_id -->
        @include('components.form.select', [
            'group' => 'property',
            'label' => __('Property Type'),
            'name' => 'property_type_id',
            'required' => true,
            'value' => $row->property_type_id,
            'options' => $propertyTypes,
            'optionValueRef' => 'property_type_id',
            'optionLabelRef' => 'name',
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

        <!-- rental_commission -->
        @include('components.form.input', [
            'group' => 'property',
            'label' => __('Rental Commision'),
            'name' => 'rental_commission',
            'value' => $row->rental_commission
        ])

        <!-- pax -->
        @include('components.form.input', [
            'group' => 'property',
            'label' => __('Pax'),
            'name' => 'pax',
            'value' => $row->pax
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

        @if(isRole('super'))
            <!-- is_special -->
            @include('components.form.checkbox', [
                'group' => 'property',
                'label' => __('Special'),
                'name' => 'is_special',
                'value' => 1,
                'default' => $row->is_special,
            ])
        @endif

        <!-- amenities -->
        @include('components.form.fast-select', [
            'group' => 'property',
            'label' => __('Amenities'),
            'multiple' => true,
            'name' => 'amenities_ids',
            'disableDefaultOption' => true,
            'options' => prepareSelectValuesFromRows($amenities, [
                'valueRef' => 'amenity_id'
            ]),
            'default' => prepareSelectDefaultValues($row->amenities, [
                'valueRef' => 'id',
            ]),
        ])

        <hr>

         <!-- cleaning_option_id -->
         @include('components.form.select', [
            'group' => 'property',
            'label' => __('Cleaning Option'),
            'name' => 'cleaning_option_id',
            'required' => true,
            'value' => $row->cleaning_option_id,
            'options' => $cleaningOptions,
            'optionValueRef' => 'cleaning_option_id',
            'optionLabelRef' => 'name',
        ])

        <!-- maid_fee -->
        @include('components.form.input', [
            'group' => 'property',
            'type' => 'number',
            'label' => __('Maid Fee'),
            'name' => 'maid_fee',
            'required' => true,
            'value' => $row->maid_fee
        ])

        <!-- cleaning_sunday_bonus -->
        @include('components.form.number', [
            'group' => 'property',
            'type' => 'number',
            'label' => __('Sunday Bonus'),
            'name' => 'cleaning_sunday_bonus',
            'required' => true,
            'value' => $row->cleaning_sunday_bonus,
        ])

        <!-- cleaning_staff_ids -->
        @include('components.form.checkbox-multiple', [
            'group' => 'user',
            'label' => __('Cleaning Staff'),
            'name' => 'cleaning_staff_ids',
            'values' => prepareCheckboxValuesFromRows($hr, [
                'valueRef' => 'id',
                'labelRef' => 'firstname',
                'secondLabelRef' => 'lastname'
            ]),
            'default' => $row->cleaning_staff_ids,
        ])

        <hr>

        <!-- country -->
        @include('components.form.input', [
            'group' => 'property',
            'label' => __('Country'),
            'name' => 'country',
            'value' => $row->country,
        ])

        <!-- state -->
        @include('components.form.input', [
            'group' => 'property',
            'label' => __('State'),
            'name' => 'state',
            'value' => $row->state,
        ])

        <!-- city -->
        @include('components.form.input', [
            'group' => 'property',
            'label' => __('City'),
            'name' => 'city',
            'value' => $row->city,
        ])

        <!-- street -->
        @include('components.form.input', [
            'group' => 'property',
            'label' => __('Street'),
            'name' => 'street',
            'value' => $row->street,
        ])

        <!-- exterior_number -->
        @include('components.form.input', [
            'group' => 'property',
            'label' => __('Exterior Number'),
            'name' => 'exterior_number',
            'value' => $row->exterior_number,
        ])

        <!-- interior_number -->
        @include('components.form.input', [
            'group' => 'property',
            'label' => __('Interior Number'),
            'name' => 'interior_number',
            'value' => $row->interior_number,
        ])

        <!-- address -->
        @include('components.form.input', [
            'group' => 'property',
            'label' => __('Zip'),
            'name' => 'zip',
            'value' => $row->zip,
        ])

        <?php /* cambiado campo de dirección único a separados
            <!-- address -->
            @include('components.form.textarea', [
                'group' => 'property',
                'label' => __('Address'),
                'name' => 'address',
                'required' => true,
                'value' => $row->address,
            ])
        */ ?>

        <!-- google_map -->
        @include('components.form.map', [
            'group' => 'property',
            'label' => __('Location'),
            'latitudeName' => 'gmaps_lat',
            'longitudeName' => 'gmaps_lon',
            'latitude' => $row->gmaps_lat,
            'longitude' => $row->gmaps_lon
        ])

    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>
