<div class="card">
    <div class="card-body app-form-fields-container">

        <span class="badge badge-primary r-badge mb-4" style="text-transform: uppercase">{{ __('Accomodations') }}</span>

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

        <!-- rental_commission -->
        @include('components.form.input', [
            'group' => 'property',
            'label' => __('Rental Commision'),
            'name' => 'rental_commission',
            'value' => $row->rental_commission
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

        <!-- bedrooms -->
        @include('components.form.input', [
            'group' => 'property',
            'label' => __('Bedrooms'),
            'name' => 'bedrooms',
            'required' => true,
            'value' => $row->bedrooms
        ])

        <!-- pax -->
        @include('components.form.input', [
            'group' => 'property',
            'label' => __('Pax'),
            'name' => 'pax',
            'value' => $row->pax
        ])

        <!-- baths -->
        @include('components.form.input', [
            'group' => 'property',
            'label' => __('Baths'),
            'name' => 'baths',
            'required' => true,
            'value' => $row->baths
        ])

        <!-- floors -->
        @include('components.form.input', [
            'group' => 'property',
            'label' => __('Floors'),
            'name' => 'floors',
            'value' => $row->floors
        ])

        <!-- lot_size -->
        @include('components.form.input', [
            'group' => 'property',
            'label' => __('Lot Size'),
            'name' => 'lot_size',
            'value' => $row->lot_size
        ])

        <!-- construction_size -->
        @include('components.form.input', [
            'group' => 'property',
            'label' => __('Construction Size'),
            'name' => 'construction_size',
            'value' => $row->construction_size
        ])

    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>
        
<div class="card">
    <div class="card-body">

        <span class="badge badge-primary r-badge mb-4" style="text-transform: uppercase">{{ __('Amenities') }}</span>

        <!-- pet_friendly -->
        @include('components.form.checkbox', [
            'group' => 'property',
            'label' => __('Pet Friendly'),
            'name' => 'pet_friendly',
            'value' => 1,
            'default' => $row->pet_friendly,
        ])

        <!-- adults_only -->
        @include('components.form.checkbox', [
            'group' => 'property',
            'label' => __('Adults Only'),
            'name' => 'adults_only',
            'value' => 1,
            'default' => $row->adults_only,
        ])

        <!-- beachfront -->
        @include('components.form.checkbox', [
            'group' => 'property',
            'label' => __('Beachfront'),
            'name' => 'beachfront',
            'value' => 1,
            'default' => $row->beachfront,
        ])

        <!-- has_parking -->
        @include('components.form.checkbox', [
            'group' => 'property',
            'label' => __('Parking'),
            'name' => 'has_parking',
            'value' => 1,
            'default' => $row->has_parking,
        ])

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

        @foreach($beddingOptions as $k => $beddingOption)
            <!-- maid_fee -->
            @include('components.form.input', [
                'group' => 'property',
                'type' => 'number',
                'label' => __($beddingOption),
                'name' => 'bedding_options[' . $beddingOption . ']',
                'value' => isset($row->bedding[$beddingOption]) ? $row->bedding[$beddingOption] : '',
            ])
        @endforeach

    </div>
</div>
<!-- separator -->
<div class="mb-4"></div>
        
<div class="card">
    <div class="card-body">

        <span class="badge badge-primary r-badge mb-4" style="text-transform: uppercase">{{ __('Property Management') }}</span>

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

    </div>
</div>

        <!-- separator -->
<div class="mb-4"></div>
        
<div class="card">
    <div class="card-body">

        <span class="badge badge-primary r-badge mb-4" style="text-transform: uppercase">{{ __('Address') }}</span>

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

        <!-- phone -->
        @include('components.form.input', [
            'group' => 'property',
            'label' => __('Phone'),
            'name' => 'phone',
            'value' => $row->phone
        ])

        <!-- country -->
        @include('components.form.input', [
            'group' => 'property',
            'label' => __('Country'),
            'name' => 'country',
            'value' => $row->country,
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

        <!-- zip -->
        @include('components.form.input', [
            'group' => 'property',
            'label' => __('Zip'),
            'name' => 'zip',
            'value' => $row->zip,
        ])


    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>

<div class="card">
    <div class="card-body">

        <span class="badge badge-primary r-badge mb-4" style="text-transform: uppercase">{{ __('Map') }}</span>

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

