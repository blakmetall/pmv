<!-- entry room -->
<div class="card">
    <div class="card-body">
        <span class="badge badge-primary r-badge mb-4">{{ __('ENTRY') }}</span>

        <!-- property_id -->
        @include('components.form.input', [
            'group' => 'property-check-list',
            'label' => __('Property'),
            'name' => 'property_id',
            'hidden' => 'true',
            'value' => $property->id
        ])

        <!-- entrance_locks_entry -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Entrance Locks'),
            'name' => 'entrance_locks_entry',
            'values' => $values,
            'default' => $row->entrance_locks_entry, 
        ])

        <!-- door_entry -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Door'),
            'name' => 'door_entry',
            'values' => $values,
            'default' => $row->door_entry, 
        ])

        <!-- walls_and_trim_entry -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Walls and Trim'),
            'name' => 'walls_and_trim_entry',
            'values' => $values,
            'default' => $row->walls_and_trim_entry, 
        ])

        <!-- ceiling_entry -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Ceiling'),
            'name' => 'ceiling_entry',
            'values' => $values,
            'default' => $row->ceiling_entry, 
        ])

        <!-- lighting_fixtures_entry -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Lighting fixtures, ceiling fans and light bulbs'),
            'name' => 'lighting_fixtures_entry',
            'values' => $values,
            'default' => $row->lighting_fixtures_entry, 
        ])

        <!-- door_mat_entry -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Door Mat'),
            'name' => 'door_mat_entry',
            'values' => $values,
            'default' => $row->door_mat_entry, 
        ])

        <!-- electrical_outlets_entry -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Electrical outlets'),
            'name' => 'electrical_outlets_entry',
            'values' => $values,
            'default' => $row->electrical_outlets_entry, 
        ])

        <!-- floor_entry -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Floor'),
            'name' => 'floor_entry',
            'values' => $values,
            'default' => $row->floor_entry, 
        ])

        <!-- comments_entry -->
        @include('components.form.textarea', [
            'group' => 'property-check-list',
            'label' => __('Comments'),
            'name' => 'comments_entry',
            'value' => $row->comments_entry,
        ])
    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>

<!-- living room -->
<div class="card">
    <div class="card-body">
        <span class="badge badge-primary r-badge mb-4">{{ __('LIVING ROOM') }}</span>

        <!-- ceiling_living_room -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Ceiling'),
            'name' => 'ceiling_living_room',
            'values' => $values,
            'default' => $row->ceiling_living_room, 
        ])

        <!-- walls_and_trim_living_room -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Walls and Trim'),
            'name' => 'walls_and_trim_living_room',
            'values' => $values,
            'default' => $row->walls_and_trim_living_room, 
        ])

        <!-- floor_living_room -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Floor'),
            'name' => 'floor_living_room',
            'values' => $values,
            'default' => $row->floor_living_room, 
        ])

        <!-- windows_living_room -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Windows, coverings and screens'),
            'name' => 'windows_living_room',
            'values' => $values,
            'default' => $row->windows_living_room, 
        ])

        <!-- internet_living_room -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Internet/modem'),
            'name' => 'internet_living_room',
            'values' => $values,
            'default' => $row->internet_living_room, 
        ])

        <!-- electronics_living_room -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Electronics (TV, DVD players, etc.)'),
            'name' => 'electronics_living_room',
            'values' => $values,
            'default' => $row->electronics_living_room, 
        ])

        <!-- furniture_living_room -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Furniture (in good condition)'),
            'name' => 'furniture_living_room',
            'values' => $values,
            'default' => $row->furniture_living_room, 
        ])

        <!-- ac_living_room -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Air Conditioner/cover'),
            'name' => 'ac_living_room',
            'values' => $values,
            'default' => $row->ac_living_room, 
        ])

        <!-- electrical_outlets_living_room -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Electrical outlets'),
            'name' => 'electrical_outlets_living_room',
            'values' => $values,
            'default' => $row->electrical_outlets_living_room, 
        ])

        <!-- cable_living_room -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Cable and satellite signal'),
            'name' => 'cable_living_room',
            'values' => $values,
            'default' => $row->cable_living_room, 
        ])

        <!-- remote_controls_living_room -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('All remote controls/batteries'),
            'name' => 'remote_controls_living_room',
            'values' => $values,
            'default' => $row->remote_controls_living_room, 
        ])

        <!-- comments_living_room -->
        @include('components.form.textarea', [
            'group' => 'property-check-list',
            'label' => __('Comments'),
            'name' => 'comments_living_room',
            'value' => $row->comments_living_room,
        ])
    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>

<!-- dining room -->
<div class="card">
    <div class="card-body">
        <span class="badge badge-primary r-badge mb-4">{{ __('DINING ROOM') }}</span>

        <!-- ceiling_dinning_room -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Ceiling'),
            'name' => 'ceiling_dinning_room',
            'values' => $values,
            'default' => $row->ceiling_dinning_room, 
        ])

        <!-- walls_and_trim_dinning_room -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Walls and trim'),
            'name' => 'walls_and_trim_dinning_room',
            'values' => $values,
            'default' => $row->walls_and_trim_dinning_room, 
        ])

        <!-- floor_dinning_room -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Floor'),
            'name' => 'floor_dinning_room',
            'values' => $values,
            'default' => $row->floor_dinning_room, 
        ])

        <!-- furniture_dinning_room -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Furniture (in good condition)'),
            'name' => 'furniture_dinning_room',
            'values' => $values,
            'default' => $row->furniture_dinning_room, 
        ])

        <!-- placematts_dinning_room -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Placematts (in good condition)'),
            'name' => 'placematts_dinning_room',
            'values' => $values,
            'default' => $row->placematts_dinning_room, 
        ])

        <!-- lighting_fixtures_dinning_room -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Lighting fixtures, ceiling fans and light bulbs'),
            'name' => 'lighting_fixtures_dinning_room',
            'values' => $values,
            'default' => $row->lighting_fixtures_dinning_room, 
        ])

        <!-- windows_dinning_room -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Windows, coverings and screens'),
            'name' => 'windows_dinning_room',
            'values' => $values,
            'default' => $row->windows_dinning_room, 
        ])

        <!-- electrical_outlets_dinning_room -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Electrical outlets'),
            'name' => 'electrical_outlets_dinning_room',
            'values' => $values,
            'default' => $row->electrical_outlets_dinning_room, 
        ])

        <!-- comments_dinning_room -->
        @include('components.form.textarea', [
            'group' => 'property-check-list',
            'label' => __('Comments'),
            'name' => 'comments_dinning_room',
            'value' => $row->comments_dinning_room,
        ])
    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>

<!-- kitchen -->
<div class="card">
    <div class="card-body">
        <span class="badge badge-primary r-badge mb-4">{{ __('KITCHEN') }}</span>

        <!-- ceiling_kitchen -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Ceiling'),
            'name' => 'ceiling_kitchen',
            'values' => $values,
            'default' => $row->ceiling_kitchen, 
        ])

        <!-- walls_and_trim_kitchen -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Walls and trim'),
            'name' => 'walls_and_trim_kitchen',
            'values' => $values,
            'default' => $row->walls_and_trim_kitchen, 
        ])

        <!-- floor_kitchen -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Floor'),
            'name' => 'floor_kitchen',
            'values' => $values,
            'default' => $row->floor_kitchen, 
        ])

        <!-- countertop_kitchen -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Countertop'),
            'name' => 'countertop_kitchen',
            'values' => $values,
            'default' => $row->countertop_kitchen, 
        ])

        <!-- cabinets_kitchen -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Cabinets and doors'),
            'name' => 'cabinets_kitchen',
            'values' => $values,
            'default' => $row->cabinets_kitchen, 
        ])

        <!-- dish_towels_kitchen -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Dish towels/paper towels'),
            'name' => 'dish_towels_kitchen',
            'values' => $values,
            'default' => $row->dish_towels_kitchen, 
        ])

        <!-- dishes_kitchen -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Dishes (good shape, appropriate quantity)'),
            'name' => 'dishes_kitchen',
            'values' => $values,
            'default' => $row->dishes_kitchen, 
        ])

        <!-- pots_kitchen -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Pots and pans (good shape, appropriate quantity)'),
            'name' => 'pots_kitchen',
            'values' => $values,
            'default' => $row->pots_kitchen, 
        ])

        <!-- glasses_kitchen -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Glasses (good shape, appropriate quantity)'),
            'name' => 'glasses_kitchen',
            'values' => $values,
            'default' => $row->glasses_kitchen, 
        ])

        <!-- stove_kitchen -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Stove/stove top'),
            'name' => 'stove_kitchen',
            'values' => $values,
            'default' => $row->stove_kitchen, 
        ])

        <!-- oven_kitchen -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Oven/microwave'),
            'name' => 'oven_kitchen',
            'values' => $values,
            'default' => $row->oven_kitchen, 
        ])

        <!-- exhaust_hood_kitchen -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Exhaust hood and fan'),
            'name' => 'exhaust_hood_kitchen',
            'values' => $values,
            'default' => $row->exhaust_hood_kitchen, 
        ])

        <!-- cooking_utensils_kitchen -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Cooking utensils/cutlery (good shape, appropriate quantity)'),
            'name' => 'cooking_utensils_kitchen',
            'values' => $values,
            'default' => $row->cooking_utensils_kitchen, 
        ])

        <!-- taps_kitchen -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Taps, sink and stoppers'),
            'name' => 'taps_kitchen',
            'values' => $values,
            'default' => $row->taps_kitchen, 
        ])

        <!-- fridge_kitchen -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Fridge crisper/shelves'),
            'name' => 'fridge_kitchen',
            'values' => $values,
            'default' => $row->fridge_kitchen, 
        ])

        <!-- freezer_kitchen -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Freezer'),
            'name' => 'freezer_kitchen',
            'values' => $values,
            'default' => $row->freezer_kitchen, 
        ])

        <!-- door_exterior_kitchen -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Door (exterior)'),
            'name' => 'door_exterior_kitchen',
            'values' => $values,
            'default' => $row->door_exterior_kitchen, 
        ])

        <!-- floor_beside_refrigerator_kitchen -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Floor beside refrigerator'),
            'name' => 'floor_beside_refrigerator_kitchen',
            'values' => $values,
            'default' => $row->floor_beside_refrigerator_kitchen, 
        ])

        <!-- floor_under_refrigerator_kitchen -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Floor under refrigerator'),
            'name' => 'floor_under_refrigerator_kitchen',
            'values' => $values,
            'default' => $row->floor_under_refrigerator_kitchen, 
        ])

        <!-- pantry_kitchen -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Pantry'),
            'name' => 'pantry_kitchen',
            'values' => $values,
            'default' => $row->pantry_kitchen, 
        ])

        <!-- dishwasher_kitchen -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Dishwasher'),
            'name' => 'dishwasher_kitchen',
            'values' => $values,
            'default' => $row->dishwasher_kitchen, 
        ])

        <!-- lighting_fixtures_kitchen -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Lighting fixtures, ceiling fans and light bulbs'),
            'name' => 'lighting_fixtures_kitchen',
            'values' => $values,
            'default' => $row->lighting_fixtures_kitchen, 
        ])

        <!-- lighting_fixtures_kitchen -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Electrical outlets'),
            'name' => 'lighting_fixtures_kitchen',
            'values' => $values,
            'default' => $row->lighting_fixtures_kitchen, 
        ])

        <!-- appliances_kitchen -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('All appliances (in good condition and working)'),
            'name' => 'appliances_kitchen',
            'values' => $values,
            'default' => $row->appliances_kitchen, 
        ])

        <!-- comments_kitchen -->
        @include('components.form.textarea', [
            'group' => 'property-check-list',
            'label' => __('Comments'),
            'name' => 'comments_kitchen',
            'value' => $row->comments_kitchen,
        ])
        
    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>

<!-- bedrooms -->
<div class="card">
    <div class="card-body">
        <span class="badge badge-primary r-badge mb-4">{{ __('BEDROOMS') }}</span>
    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>

<!-- bathrooms -->
<div class="card">
    <div class="card-body">
        <span class="badge badge-primary r-badge mb-4">{{ __('BATHROOMS') }}</span>
    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>

<!-- terrace / deck -->
<div class="card">
    <div class="card-body">
        <span class="badge badge-primary r-badge mb-4">{{ __('TERRACE / DECK') }}</span>

        <!-- ceiling_terrace -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Ceiling'),
            'name' => 'ceiling_terrace',
            'values' => $values,
            'default' => $row->ceiling_terrace, 
        ])

        <!-- walls_and_trim_terrace -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Walls and trim'),
            'name' => 'walls_and_trim_terrace',
            'values' => $values,
            'default' => $row->walls_and_trim_terrace, 
        ])

        <!-- floor_terrace -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Floor'),
            'name' => 'floor_terrace',
            'values' => $values,
            'default' => $row->floor_terrace, 
        ])

        <!-- lighting_fixtures_terrace -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Lighting fixtures, ceiling fans and light bulbs'),
            'name' => 'lighting_fixtures_terrace',
            'values' => $values,
            'default' => $row->lighting_fixtures_terrace, 
        ])

        <!-- furniture_terrace -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Furniture (in good condition)'),
            'name' => 'furniture_terrace',
            'values' => $values,
            'default' => $row->furniture_terrace, 
        ])

        <!-- railings_terrace -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Railings (clean and in good condition)'),
            'name' => 'railings_terrace',
            'values' => $values,
            'default' => $row->railings_terrace, 
        ])

        <!-- comments_terrace -->
        @include('components.form.textarea', [
            'group' => 'property-check-list',
            'label' => __('Comments'),
            'name' => 'comments_terrace',
            'value' => $row->comments_terrace,
        ])
    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>

<!-- utility room -->
<div class="card">
    <div class="card-body">
        <span class="badge badge-primary r-badge mb-4">{{ __('UTILITY ROOM') }}</span>

        <!-- door_utility_room -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Door'),
            'name' => 'door_utility_room',
            'values' => $values,
            'default' => $row->door_utility_room, 
        ])

        <!-- washer_utility_room -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Washer (clean, working and in good condition)'),
            'name' => 'washer_utility_room',
            'values' => $values,
            'default' => $row->washer_utility_room, 
        ])

        <!-- dryer_utility_room -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Dryer (clean, working and in good condition)'),
            'name' => 'dryer_utility_room',
            'values' => $values,
            'default' => $row->dryer_utility_room, 
        ])

        <!-- areas_clean_utility_room -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('All areas clean (behind and under)'),
            'name' => 'areas_clean_utility_room',
            'values' => $values,
            'default' => $row->areas_clean_utility_room, 
        ])

        <!-- shelves_utility_room -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Shelves/cabinets'),
            'name' => 'shelves_utility_room',
            'values' => $values,
            'default' => $row->shelves_utility_room, 
        ])

        <!-- lighting_fixtures_utility_room -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Lighting fixtures, ceiling fans and light bulbs'),
            'name' => 'lighting_fixtures_utility_room',
            'values' => $values,
            'default' => $row->lighting_fixtures_utility_room, 
        ])

        <!-- electrical_outlets_utility_room -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Electrical outlets'),
            'name' => 'electrical_outlets_utility_room',
            'values' => $values,
            'default' => $row->electrical_outlets_utility_room, 
        ])

        <!-- water_heater_utility_room -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Water heater'),
            'name' => 'water_heater_utility_room',
            'values' => $values,
            'default' => $row->water_heater_utility_room, 
        ])

        <!-- overall_plumbing_utility_room -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Overall plumbing condition'),
            'name' => 'overall_plumbing_utility_room',
            'values' => $values,
            'default' => $row->overall_plumbing_utility_room, 
        ])

        <!-- comments_utility_room -->
        @include('components.form.textarea', [
            'group' => 'property-check-list',
            'label' => __('Comments'),
            'name' => 'comments_utility_room',
            'value' => $row->comments_utility_room,
        ])
    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>

<!-- other -->
<div class="card">
    <div class="card-body">
        <span class="badge badge-primary r-badge mb-4">{{ __('OTHER') }}</span>

        <!-- building_entrance_other -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Building entrance/keys'),
            'name' => 'building_entrance_other',
            'values' => $values,
            'default' => $row->building_entrance_other, 
        ])

        <!-- interior_exterior_plants_other -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Interior/Exterior plants (trimmed, dead leaves removed)'),
            'name' => 'interior_exterior_plants_other',
            'values' => $values,
            'default' => $row->interior_exterior_plants_other, 
        ])

        <!-- interior_exterior_plants_pots_other -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Interior/Exterior plant pots (no cracks, no chips, painted)'),
            'name' => 'interior_exterior_plants_pots_other',
            'values' => $values,
            'default' => $row->interior_exterior_plants_pots_other, 
        ])

        <!-- plants_other -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Plants to be watered and maintenance'),
            'name' => 'plants_other',
            'values' => $values,
            'default' => $row->plants_other, 
        ])

        <!-- comments_other -->
        @include('components.form.textarea', [
            'group' => 'property-check-list',
            'label' => __('Comments'),
            'name' => 'comments_other',
            'value' => $row->comments_other,
        ])
    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>

<!-- general -->
<div class="card">
    <div class="card-body">
        <span class="badge badge-primary r-badge mb-4">{{ __('GENERAL') }}</span>

        <!-- comments_general -->
        @include('components.form.textarea', [
            'group' => 'property-check-list',
            'label' => __('Comments'),
            'name' => 'comments_general',
            'value' => $row->comments_general,
        ])
    </div>
</div>