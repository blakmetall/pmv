<!-- entry room -->
<div class="card">
    <div class="card-body">
        <span class="badge badge-primary r-badge mb-4">{{ __('ENTRY') }}</span>

        @if($row->updated_at)
            <!-- id -->
            @include('components.form.input', [
                'group' => 'property-check-list',
                'label' => __('ID'),
                'name' => 'check_list_id',
                'disabled' => true,
                'value' => $row->id
            ])

            <!-- date -->
            @include('components.form.input', [
                'group' => 'property-check-list',
                'label' => __('Date'),
                'name' => 'check_list_id',
                'disabled' => true,
                'value' => $row->updated_at->format('d/M/Y H:i:s')
            ])
        @endif

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
            'label' => __('Walls and trim'),
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
            'label' => __('Walls and trim'),
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
            'label' => __('Stock: Dish towels, paper towels, dish soap, dishwasher soap'),
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
            'label' => __('Fridge Door (exterior)'),
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

        <!-- electrical_outlets_kitchen -->
        @include('components.form.radio', [
            'group' => 'property-check-list',
            'label' => __('Electrical outlets'),
            'name' => 'electrical_outlets_kitchen',
            'values' => $values,
            'default' => $row->electrical_outlets_kitchen, 
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

        <div class="container-bedrooms">
            @if(isset($row->bedrooms) && $row->bedrooms)
                @php
                    $bedrooms = json_decode($row->bedrooms, true);
                @endphp
                @foreach ($bedrooms as $index => $bedroom)
                    <div class="container-bedroom card-body">
                        <span class="badge badge-primary r-badge mb-4">{{ __('labelBedroom') }}</span>
                        @if(!$disabled)
                            <div>{!! __('labelLegend') !!}</div>
                            <br/>
                        @endif
                        <div class="form-group row mb-3">
                            <label class="col-sm-2 col-form-label">
                                {{ __('labelType') }}
                            </label>
                
                            <div class="col-sm-10">
                                <select name="bedroomsList[{{ $index+1 }}][type_bedroom]" class="form-control">
                                        <option value="Bedding area" {{ ($bedroom['type_bedroom'] == 'Bedding area')?'selected':'' }}>
                                            {{ __('labelBedding') }}
                                        </option>
                                        <option value="Master bedroom" {{ ($bedroom['type_bedroom'] == 'Master bedroom')?'selected':'' }}>
                                            {{ __('labelMaster') }}
                                        </option>
                                        <option value="Guest bedroom" {{ ($bedroom['type_bedroom'] == 'Guest bedroom')?'selected':'' }}>
                                            {{ __('labelGuest') }}
                                        </option>
                                        <option value="Two bed bedroom" {{ ($bedroom['type_bedroom'] == 'Two bed bedroom')?'selected':'' }}>
                                            {{ __('labelTwoBed') }}
                                        </option>
                                        <option value="Bunk bed bedroom" {{ ($bedroom['type_bedroom'] == 'Bunk bed bedroom')?'selected':'' }}>
                                            {{ __('labelBunkBed') }}
                                        </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-2 col-form-label">
                                {{ __('labelDoor') }}
                            </label>
                
                            <div class="col-sm-10">
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="1" name="bedroomsList[{{ $index+1 }}][door_bedroom]" {{ (isset($bedroom['door_bedroom']) && $bedroom['door_bedroom'] == '1')?'checked':'checked' }}>
                                    <span class="checkmark app-checkmark"></span>
                                    <div class="app-form-checkbox-label">
                                        OK
                                    </div>
                                </label>
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="2" name="bedroomsList[{{ $index+1 }}][door_bedroom]" {{ (isset($bedroom['door_bedroom']) && $bedroom['door_bedroom'] == '2')?'checked':'' }}>
                                    <span class="checkmark app-checkmark"></span><div class="app-form-checkbox-label">
                                        {{ __('labelAttention') }}
                                    </div>
                                </label>
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="3" name="bedroomsList[{{ $index+1 }}][door_bedroom]" {{ (isset($bedroom['door_bedroom']) && $bedroom['door_bedroom'] == '3')?'checked':'' }}>
                                    <span class="checkmark app-checkmark"></span>
                                    <div class="app-form-checkbox-label">
                                        N/A
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-2 col-form-label">
                                {{ __('labelCeiling') }}
                            </label>
                
                            <div class="col-sm-10">
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="1" name="bedroomsList[{{ $index+1 }}][ceiling_bedroom]" {{ (isset($bedroom['ceiling_bedroom']) && $bedroom['ceiling_bedroom'] == '1')?'checked':'checked' }}>
                                    <span class="checkmark app-checkmark"></span>
                                    <div class="app-form-checkbox-label">
                                        OK
                                    </div>
                                </label>
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="2" name="bedroomsList[{{ $index+1 }}][ceiling_bedroom]" {{ (isset($bedroom['ceiling_bedroom']) && $bedroom['ceiling_bedroom'] == '2')?'checked':'' }}>
                                    <span class="checkmark app-checkmark"></span><div class="app-form-checkbox-label">
                                        {{ __('labelAttention') }}
                                    </div>
                                </label>
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="3" name="bedroomsList[{{ $index+1 }}][ceiling_bedroom]" {{ (isset($bedroom['ceiling_bedroom']) && $bedroom['ceiling_bedroom'] == '3')?'checked':'' }}>
                                    <span class="checkmark app-checkmark"></span>
                                    <div class="app-form-checkbox-label">
                                        N/A
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-2 col-form-label">
                                {{ __('labelWalls') }}
                            </label>
                
                            <div class="col-sm-10">
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="1" name="bedroomsList[{{ $index+1 }}][walls_bedroom]" {{ (isset($bedroom['walls_bedroom']) && $bedroom['walls_bedroom'] == '1')?'checked':'checked' }}>
                                    <span class="checkmark app-checkmark"></span>
                                    <div class="app-form-checkbox-label">
                                        OK
                                    </div>
                                </label>
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="2" name="bedroomsList[{{ $index+1 }}][walls_bedroom]" {{ (isset($bedroom['walls_bedroom']) && $bedroom['walls_bedroom'] == '2')?'checked':'' }}>
                                    <span class="checkmark app-checkmark"></span><div class="app-form-checkbox-label">
                                        {{ __('labelAttention') }}
                                    </div>
                                </label>
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="3" name="bedroomsList[{{ $index+1 }}][walls_bedroom]" {{ (isset($bedroom['walls_bedroom']) && $bedroom['walls_bedroom'] == '3')?'checked':'' }}>
                                    <span class="checkmark app-checkmark"></span>
                                    <div class="app-form-checkbox-label">
                                        N/A
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-2 col-form-label">
                                {{ __('labelFloor') }}
                            </label>
                
                            <div class="col-sm-10">
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="1" name="bedroomsList[{{ $index+1 }}][floor_bedroom]" {{ (isset($bedroom['floor_bedroom']) && $bedroom['floor_bedroom'] == '1')?'checked':'checked' }}>
                                    <span class="checkmark app-checkmark"></span>
                                    <div class="app-form-checkbox-label">
                                        OK
                                    </div>
                                </label>
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="2" name="bedroomsList[{{ $index+1 }}][floor_bedroom]" {{ (isset($bedroom['floor_bedroom']) && $bedroom['floor_bedroom'] == '2')?'checked':'' }}>
                                    <span class="checkmark app-checkmark"></span><div class="app-form-checkbox-label">
                                        {{ __('labelAttention') }}
                                    </div>
                                </label>
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="3" name="bedroomsList[{{ $index+1 }}][floor_bedroom]" {{ (isset($bedroom['floor_bedroom']) && $bedroom['floor_bedroom'] == '3')?'checked':'' }}>
                                    <span class="checkmark app-checkmark"></span>
                                    <div class="app-form-checkbox-label">
                                        N/A
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-2 col-form-label">
                                {{ __('labelClosets') }}
                            </label>
                
                            <div class="col-sm-10">
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="1" name="bedroomsList[{{ $index+1 }}][closets_bedroom]" {{ (isset($bedroom['closets_bedroom']) && $bedroom['closets_bedroom'] == '1')?'checked':'checked' }}>
                                    <span class="checkmark app-checkmark"></span>
                                    <div class="app-form-checkbox-label">
                                        OK
                                    </div>
                                </label>
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="2" name="bedroomsList[{{ $index+1 }}][closets_bedroom]" {{ (isset($bedroom['closets_bedroom']) && $bedroom['closets_bedroom'] == '2')?'checked':'' }}>
                                    <span class="checkmark app-checkmark"></span><div class="app-form-checkbox-label">
                                        {{ __('labelAttention') }}
                                    </div>
                                </label>
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="3" name="bedroomsList[{{ $index+1 }}][closets_bedroom]" {{ (isset($bedroom['closets_bedroom']) && $bedroom['closets_bedroom'] == '3')?'checked':'' }}>
                                    <span class="checkmark app-checkmark"></span>
                                    <div class="app-form-checkbox-label">
                                        N/A
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-2 col-form-label">
                                {{ __('labelLighting') }}
                            </label>
                
                            <div class="col-sm-10">
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="1" name="bedroomsList[{{ $index+1 }}][lighting_bedroom]" {{ (isset($bedroom['lighting_bedroom']) && $bedroom['lighting_bedroom'] == '1')?'checked':'checked' }}>
                                    <span class="checkmark app-checkmark"></span>
                                    <div class="app-form-checkbox-label">
                                        OK
                                    </div>
                                </label>
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="2" name="bedroomsList[{{ $index+1 }}][lighting_bedroom]" {{ (isset($bedroom['lighting_bedroom']) && $bedroom['lighting_bedroom'] == '2')?'checked':'' }}>
                                    <span class="checkmark app-checkmark"></span><div class="app-form-checkbox-label">
                                        {{ __('labelAttention') }}
                                    </div>
                                </label>
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="3" name="bedroomsList[{{ $index+1 }}][lighting_bedroom]" {{ (isset($bedroom['lighting_bedroom']) && $bedroom['lighting_bedroom'] == '3')?'checked':'' }}>
                                    <span class="checkmark app-checkmark"></span>
                                    <div class="app-form-checkbox-label">
                                        N/A
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-2 col-form-label">
                                {{ __('labelWindows') }}
                            </label>
                
                            <div class="col-sm-10">
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="1" name="bedroomsList[{{ $index+1 }}][windows_bedroom]" {{ (isset($bedroom['windows_bedroom']) && $bedroom['windows_bedroom'] == '1')?'checked':'checked' }}>
                                    <span class="checkmark app-checkmark"></span>
                                    <div class="app-form-checkbox-label">
                                        OK
                                    </div>
                                </label>
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="2" name="bedroomsList[{{ $index+1 }}][windows_bedroom]" {{ (isset($bedroom['windows_bedroom']) && $bedroom['windows_bedroom'] == '2')?'checked':'' }}>
                                    <span class="checkmark app-checkmark"></span><div class="app-form-checkbox-label">
                                        {{ __('labelAttention') }}
                                    </div>
                                </label>
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="3" name="bedroomsList[{{ $index+1 }}][windows_bedroom]" {{ (isset($bedroom['windows_bedroom']) && $bedroom['windows_bedroom'] == '3')?'checked':'' }}>
                                    <span class="checkmark app-checkmark"></span>
                                    <div class="app-form-checkbox-label">
                                        N/A
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-2 col-form-label">
                                {{ __('labelBed') }}
                            </label>
                
                            <div class="col-sm-10">
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="1" name="bedroomsList[{{ $index+1 }}][bed_bedroom]" {{ (isset($bedroom['bed_bedroom']) && $bedroom['bed_bedroom'] == '1')?'checked':'checked' }}>
                                    <span class="checkmark app-checkmark"></span>
                                    <div class="app-form-checkbox-label">
                                        OK
                                    </div>
                                </label>
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="2" name="bedroomsList[{{ $index+1 }}][bed_bedroom]" {{ (isset($bedroom['bed_bedroom']) && $bedroom['bed_bedroom'] == '2')?'checked':'' }}>
                                    <span class="checkmark app-checkmark"></span><div class="app-form-checkbox-label">
                                        {{ __('labelAttention') }}
                                    </div>
                                </label>
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="3" name="bedroomsList[{{ $index+1 }}][bed_bedroom]" {{ (isset($bedroom['bed_bedroom']) && $bedroom['bed_bedroom'] == '3')?'checked':'' }}>
                                    <span class="checkmark app-checkmark"></span>
                                    <div class="app-form-checkbox-label">
                                        N/A
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-2 col-form-label">
                                {{ __('labelSheets') }}
                            </label>
                
                            <div class="col-sm-10">
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="1" name="bedroomsList[{{ $index+1 }}][sheets_bedroom]" {{ (isset($bedroom['sheets_bedroom']) && $bedroom['sheets_bedroom'] == '1')?'checked':'checked' }}>
                                    <span class="checkmark app-checkmark"></span>
                                    <div class="app-form-checkbox-label">
                                        OK
                                    </div>
                                </label>
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="2" name="bedroomsList[{{ $index+1 }}][sheets_bedroom]" {{ (isset($bedroom['sheets_bedroom']) && $bedroom['sheets_bedroom'] == '2')?'checked':'' }}>
                                    <span class="checkmark app-checkmark"></span><div class="app-form-checkbox-label">
                                        {{ __('labelAttention') }}
                                    </div>
                                </label>
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="3" name="bedroomsList[{{ $index+1 }}][sheets_bedroom]" {{ (isset($bedroom['sheets_bedroom']) && $bedroom['sheets_bedroom'] == '3')?'checked':'' }}>
                                    <span class="checkmark app-checkmark"></span>
                                    <div class="app-form-checkbox-label">
                                        N/A
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-2 col-form-label">
                                {{ __('labelComforters') }}
                            </label>
                
                            <div class="col-sm-10">
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="1" name="bedroomsList[{{ $index+1 }}][comforters_bedroom]" {{ (isset($bedroom['comforters_bedroom']) && $bedroom['comforters_bedroom'] == '1')?'checked':'checked' }}>
                                    <span class="checkmark app-checkmark"></span>
                                    <div class="app-form-checkbox-label">
                                        OK
                                    </div>
                                </label>
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="2" name="bedroomsList[{{ $index+1 }}][comforters_bedroom]" {{ (isset($bedroom['comforters_bedroom']) && $bedroom['comforters_bedroom'] == '2')?'checked':'' }}>
                                    <span class="checkmark app-checkmark"></span><div class="app-form-checkbox-label">
                                        {{ __('labelAttention') }}
                                    </div>
                                </label>
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="3" name="bedroomsList[{{ $index+1 }}][comforters_bedroom]" {{ (isset($bedroom['comforters_bedroom']) && $bedroom['comforters_bedroom'] == '3')?'checked':'' }}>
                                    <span class="checkmark app-checkmark"></span>
                                    <div class="app-form-checkbox-label">
                                        N/A
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-2 col-form-label">
                                {{ __('labelPillows') }}
                            </label>
                
                            <div class="col-sm-10">
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="1" name="bedroomsList[{{ $index+1 }}][pillows_bedroom]" {{ (isset($bedroom['pillows_bedroom']) && $bedroom['pillows_bedroom'] == '1')?'checked':'checked' }}>
                                    <span class="checkmark app-checkmark"></span>
                                    <div class="app-form-checkbox-label">
                                        OK
                                    </div>
                                </label>
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="2" name="bedroomsList[{{ $index+1 }}][pillows_bedroom]" {{ (isset($bedroom['pillows_bedroom']) && $bedroom['pillows_bedroom'] == '2')?'checked':'' }}>
                                    <span class="checkmark app-checkmark"></span><div class="app-form-checkbox-label">
                                        {{ __('labelAttention') }}
                                    </div>
                                </label>
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="3" name="bedroomsList[{{ $index+1 }}][pillows_bedroom]" {{ (isset($bedroom['pillows_bedroom']) && $bedroom['pillows_bedroom'] == '3')?'checked':'' }}>
                                    <span class="checkmark app-checkmark"></span>
                                    <div class="app-form-checkbox-label">
                                        N/A
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-2 col-form-label">
                                {{ __('labelElectronics') }}
                            </label>
                
                            <div class="col-sm-10">
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="1" name="bedroomsList[{{ $index+1 }}][electronics_bedroom]" {{ (isset($bedroom['electronics_bedroom']) && $bedroom['electronics_bedroom'] == '1')?'checked':'checked' }}>
                                    <span class="checkmark app-checkmark"></span>
                                    <div class="app-form-checkbox-label">
                                        OK
                                    </div>
                                </label>
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="2" name="bedroomsList[{{ $index+1 }}][electronics_bedroom]" {{ (isset($bedroom['electronics_bedroom']) && $bedroom['electronics_bedroom'] == '2')?'checked':'' }}>
                                    <span class="checkmark app-checkmark"></span><div class="app-form-checkbox-label">
                                        {{ __('labelAttention') }}
                                    </div>
                                </label>
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="3" name="bedroomsList[{{ $index+1 }}][electronics_bedroom]" {{ (isset($bedroom['electronics_bedroom']) && $bedroom['electronics_bedroom'] == '3')?'checked':'' }}>
                                    <span class="checkmark app-checkmark"></span>
                                    <div class="app-form-checkbox-label">
                                        N/A
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-2 col-form-label">
                                {{ __('labelFurniture') }}
                            </label>
                
                            <div class="col-sm-10">
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="1" name="bedroomsList[{{ $index+1 }}][furniture_bedroom]" {{ (isset($bedroom['furniture_bedroom']) && $bedroom['furniture_bedroom'] == '1')?'checked':'checked' }}>
                                    <span class="checkmark app-checkmark"></span>
                                    <div class="app-form-checkbox-label">
                                        OK
                                    </div>
                                </label>
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="2" name="bedroomsList[{{ $index+1 }}][furniture_bedroom]" {{ (isset($bedroom['furniture_bedroom']) && $bedroom['furniture_bedroom'] == '2')?'checked':'' }}>
                                    <span class="checkmark app-checkmark"></span><div class="app-form-checkbox-label">
                                        {{ __('labelAttention') }}
                                    </div>
                                </label>
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="3" name="bedroomsList[{{ $index+1 }}][furniture_bedroom]" {{ (isset($bedroom['furniture_bedroom']) && $bedroom['furniture_bedroom'] == '3')?'checked':'' }}>
                                    <span class="checkmark app-checkmark"></span>
                                    <div class="app-form-checkbox-label">
                                        N/A
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-2 col-form-label">
                                {{ __('labelElectrical') }}
                            </label>
                
                            <div class="col-sm-10">
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="1" name="bedroomsList[{{ $index+1 }}][electrical_bedroom]" {{ (isset($bedroom['electrical_bedroom']) && $bedroom['electrical_bedroom'] == '1')?'checked':'checked' }}>
                                    <span class="checkmark app-checkmark"></span>
                                    <div class="app-form-checkbox-label">
                                        OK
                                    </div>
                                </label>
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="2" name="bedroomsList[{{ $index+1 }}][electrical_bedroom]" {{ (isset($bedroom['electrical_bedroom']) && $bedroom['electrical_bedroom'] == '2')?'checked':'' }}>
                                    <span class="checkmark app-checkmark"></span><div class="app-form-checkbox-label">
                                        {{ __('labelAttention') }}
                                    </div>
                                </label>
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="3" name="bedroomsList[{{ $index+1 }}][electrical_bedroom]" {{ (isset($bedroom['electrical_bedroom']) && $bedroom['electrical_bedroom'] == '3')?'checked':'' }}>
                                    <span class="checkmark app-checkmark"></span>
                                    <div class="app-form-checkbox-label">
                                        N/A
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-2 col-form-label">
                                {{ __('labelAir') }}
                            </label>
                
                            <div class="col-sm-10">
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="1" name="bedroomsList[{{ $index+1 }}][air_bedroom]" {{ (isset($bedroom['air_bedroom']) && $bedroom['air_bedroom'] == '1')?'checked':'checked' }}>
                                    <span class="checkmark app-checkmark"></span>
                                    <div class="app-form-checkbox-label">
                                        OK
                                    </div>
                                </label>
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="2" name="bedroomsList[{{ $index+1 }}][air_bedroom]" {{ (isset($bedroom['air_bedroom']) && $bedroom['air_bedroom'] == '2')?'checked':'' }}>
                                    <span class="checkmark app-checkmark"></span><div class="app-form-checkbox-label">
                                        {{ __('labelAttention') }}
                                    </div>
                                </label>
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="3" name="bedroomsList[{{ $index+1 }}][air_bedroom]" {{ (isset($bedroom['air_bedroom']) && $bedroom['air_bedroom'] == '3')?'checked':'' }}>
                                    <span class="checkmark app-checkmark"></span>
                                    <div class="app-form-checkbox-label">
                                        N/A
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-2 col-form-label">
                                {{ __('labelRemote') }}
                            </label>
                
                            <div class="col-sm-10">
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="1" name="bedroomsList[{{ $index+1 }}][remote_bedroom]" {{ (isset($bedroom['remote_bedroom']) && $bedroom['remote_bedroom'] == '1')?'checked':'checked' }}>
                                    <span class="checkmark app-checkmark"></span>
                                    <div class="app-form-checkbox-label">
                                        OK
                                    </div>
                                </label>
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="2" name="bedroomsList[{{ $index+1 }}][remote_bedroom]" {{ (isset($bedroom['remote_bedroom']) && $bedroom['remote_bedroom'] == '2')?'checked':'' }}>
                                    <span class="checkmark app-checkmark"></span><div class="app-form-checkbox-label">
                                        {{ __('labelAttention') }}
                                    </div>
                                </label>
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="3" name="bedroomsList[{{ $index+1 }}][remote_bedroom]" {{ (isset($bedroom['remote_bedroom']) && $bedroom['remote_bedroom'] == '3')?'checked':'' }}>
                                    <span class="checkmark app-checkmark"></span>
                                    <div class="app-form-checkbox-label">
                                        N/A
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">
                                {{ __('labelComments') }}
                            </label>
                
                            <div class="col-sm-10">
                                <textarea name="bedroomsList[{{ $index+1 }}][comments_bedroom]" class="form-control ckeditor" rows="3" style="resize: none;">{{ $bedroom['comments_bedroom'] }}</textarea>
                            </div>
                        </div>
                        @if(!$disabled)
                            <a href="#" class="btn-remove-bedroom btn  btn-secondary m-1">
                                {{ __('labelRemove') }}
                            </a>
                        @endif
                    </div>
                @endforeach
            @endif
        </div>

        @if(!$disabled)
            <a href="#" id="btn-add-bedroom" class="btn  btn-primary m-1">
                {{ __('Add another bedroom') }}
            </a>
        @endif
    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>

<!-- bathrooms -->
<div class="card">
    <div class="card-body">
        <span class="badge badge-primary r-badge mb-4">{{ __('BATHROOMS') }}</span>


        <div class="container-bathrooms">
            @if(isset($row->bathrooms) && $row->bathrooms)
                @php
                    $bathrooms = json_decode($row->bathrooms, true);
                @endphp
                @foreach ($bathrooms as $index => $bathroom)
                    <div class="container-bathroom card-body">
                        <span class="badge badge-primary r-badge mb-4">{{ __('labelBathroom') }}</span>
                        @if(!$disabled)
                            <div>{!! __('labelLegend') !!}</div>
                            <br/>
                        @endif
                        <div class="form-group row mb-3">
                            <label class="col-sm-2 col-form-label">
                                {{ __('labelType') }}
                            </label>
                
                            <div class="col-sm-10">
                                <select name="bathroomsList[{{ $index+1 }}][type_bathroom]" class="form-control">
                                        <option value="Main bathroom" {{ ($bathroom['type_bathroom'] == 'Main bathroom')?'selected':'' }}>
                                            {{ __('labelMainBath') }}
                                        </option>
                                        <option value="Master bedroom bathroom" {{ ($bathroom['type_bathroom'] == 'Master bedroom bathroom')?'selected':'' }}>
                                            {{ __('labelMasterBath') }}
                                        </option>
                                        <option value="Guest bedroom bathroom" {{ ($bathroom['type_bathroom'] == 'Guest bedroom bathroom')?'selected':'' }}>
                                            {{ __('labelGuestBath') }}
                                        </option>
                                        <option value="Two bed bedroom bathroom" {{ ($bathroom['type_bathroom'] == 'Two bed bedroom bathroom')?'selected':'' }}>
                                            {{ __('labelTwoBedBath') }}
                                        </option>
                                        <option value="Bunk bed bedroom bathroom" {{ ($bathroom['type_bathroom'] == 'Bunk bed bedroom bathroom')?'selected':'' }}>
                                            {{ __('labelBunkBedBath') }}
                                        </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-2 col-form-label">
                                {{ __('labelDoor') }}
                            </label>
                
                            <div class="col-sm-10">
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="1" name="bathroomsList[{{ $index+1 }}][door_bathroom]" {{ (isset($bathroom['door_bathroom']) && $bathroom['door_bathroom'] == '1')?'checked':'checked' }}>
                                    <span class="checkmark app-checkmark"></span>
                                    <div class="app-form-checkbox-label">
                                        OK
                                    </div>
                                </label>
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="2" name="bathroomsList[{{ $index+1 }}][door_bathroom]" {{ (isset($bathroom['door_bathroom']) && $bathroom['door_bathroom'] == '2')?'checked':'' }}>
                                    <span class="checkmark app-checkmark"></span><div class="app-form-checkbox-label">
                                        {{ __('labelAttention') }}
                                    </div>
                                </label>
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="3" name="bathroomsList[{{ $index+1 }}][door_bathroom]" {{ (isset($bathroom['door_bathroom']) && $bathroom['door_bathroom'] == '3')?'checked':'' }}>
                                    <span class="checkmark app-checkmark"></span>
                                    <div class="app-form-checkbox-label">
                                        N/A
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-2 col-form-label">
                                {{ __('labelCeiling') }}
                            </label>
                
                            <div class="col-sm-10">
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="1" name="bathroomsList[{{ $index+1 }}][ceiling_bathroom]" {{ (isset($bathroom['ceiling_bathroom']) && $bathroom['ceiling_bathroom'] == '1')?'checked':'checked' }}>
                                    <span class="checkmark app-checkmark"></span>
                                    <div class="app-form-checkbox-label">
                                        OK
                                    </div>
                                </label>
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="2" name="bathroomsList[{{ $index+1 }}][ceiling_bathroom]" {{ (isset($bathroom['ceiling_bathroom']) && $bathroom['ceiling_bathroom'] == '2')?'checked':'' }}>
                                    <span class="checkmark app-checkmark"></span><div class="app-form-checkbox-label">
                                        {{ __('labelAttention') }}
                                    </div>
                                </label>
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="3" name="bathroomsList[{{ $index+1 }}][ceiling_bathroom]" {{ (isset($bathroom['ceiling_bathroom']) && $bathroom['ceiling_bathroom'] == '3')?'checked':'' }}>
                                    <span class="checkmark app-checkmark"></span>
                                    <div class="app-form-checkbox-label">
                                        N/A
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-2 col-form-label">
                                {{ __('labelWalls') }}
                            </label>
                
                            <div class="col-sm-10">
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="1" name="bathroomsList[{{ $index+1 }}][walls_bathroom]" {{ (isset($bathroom['walls_bathroom']) && $bathroom['walls_bathroom'] == '1')?'checked':'checked' }}>
                                    <span class="checkmark app-checkmark"></span>
                                    <div class="app-form-checkbox-label">
                                        OK
                                    </div>
                                </label>
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="2" name="bathroomsList[{{ $index+1 }}][walls_bathroom]" {{ (isset($bathroom['walls_bathroom']) && $bathroom['walls_bathroom'] == '2')?'checked':'' }}>
                                    <span class="checkmark app-checkmark"></span><div class="app-form-checkbox-label">
                                        {{ __('labelAttention') }}
                                    </div>
                                </label>
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="3" name="bathroomsList[{{ $index+1 }}][walls_bathroom]" {{ (isset($bathroom['walls_bathroom']) && $bathroom['walls_bathroom'] == '3')?'checked':'' }}>
                                    <span class="checkmark app-checkmark"></span>
                                    <div class="app-form-checkbox-label">
                                        N/A
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-2 col-form-label">
                                {{ __('labelFloor') }}
                            </label>
                
                            <div class="col-sm-10">
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="1" name="bathroomsList[{{ $index+1 }}][floor_bathroom]" {{ (isset($bathroom['floor_bathroom']) && $bathroom['floor_bathroom'] == '1')?'checked':'checked' }}>
                                    <span class="checkmark app-checkmark"></span>
                                    <div class="app-form-checkbox-label">
                                        OK
                                    </div>
                                </label>
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="2" name="bathroomsList[{{ $index+1 }}][floor_bathroom]" {{ (isset($bathroom['floor_bathroom']) && $bathroom['floor_bathroom'] == '2')?'checked':'' }}>
                                    <span class="checkmark app-checkmark"></span><div class="app-form-checkbox-label">
                                        {{ __('labelAttention') }}
                                    </div>
                                </label>
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="3" name="bathroomsList[{{ $index+1 }}][floor_bathroom]" {{ (isset($bathroom['floor_bathroom']) && $bathroom['floor_bathroom'] == '3')?'checked':'' }}>
                                    <span class="checkmark app-checkmark"></span>
                                    <div class="app-form-checkbox-label">
                                        N/A
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-2 col-form-label">
                                {{ __('labelCabinet') }}
                            </label>
                
                            <div class="col-sm-10">
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="1" name="bathroomsList[{{ $index+1 }}][cabinet_bathroom]" {{ (isset($bathroom['cabinet_bathroom']) && $bathroom['cabinet_bathroom'] == '1')?'checked':'checked' }}>
                                    <span class="checkmark app-checkmark"></span>
                                    <div class="app-form-checkbox-label">
                                        OK
                                    </div>
                                </label>
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="2" name="bathroomsList[{{ $index+1 }}][cabinet_bathroom]" {{ (isset($bathroom['cabinet_bathroom']) && $bathroom['cabinet_bathroom'] == '2')?'checked':'' }}>
                                    <span class="checkmark app-checkmark"></span><div class="app-form-checkbox-label">
                                        {{ __('labelAttention') }}
                                    </div>
                                </label>
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="3" name="bathroomsList[{{ $index+1 }}][cabinet_bathroom]" {{ (isset($bathroom['cabinet_bathroom']) && $bathroom['cabinet_bathroom'] == '3')?'checked':'' }}>
                                    <span class="checkmark app-checkmark"></span>
                                    <div class="app-form-checkbox-label">
                                        N/A
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-2 col-form-label">
                                {{ __('labelClosets') }}
                            </label>
                
                            <div class="col-sm-10">
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="1" name="bathroomsList[{{ $index+1 }}][closets_bathroom]" {{ (isset($bathroom['closets_bathroom']) && $bathroom['closets_bathroom'] == '1')?'checked':'checked' }}>
                                    <span class="checkmark app-checkmark"></span>
                                    <div class="app-form-checkbox-label">
                                        OK
                                    </div>
                                </label>
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="2" name="bathroomsList[{{ $index+1 }}][closets_bathroom]" {{ (isset($bathroom['closets_bathroom']) && $bathroom['closets_bathroom'] == '2')?'checked':'' }}>
                                    <span class="checkmark app-checkmark"></span><div class="app-form-checkbox-label">
                                        {{ __('labelAttention') }}
                                    </div>
                                </label>
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="3" name="bathroomsList[{{ $index+1 }}][closets_bathroom]" {{ (isset($bathroom['closets_bathroom']) && $bathroom['closets_bathroom'] == '3')?'checked':'' }}>
                                    <span class="checkmark app-checkmark"></span>
                                    <div class="app-form-checkbox-label">
                                        N/A
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-2 col-form-label">
                                {{ __('labelSafety') }}
                            </label>
                
                            <div class="col-sm-10">
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="1" name="bathroomsList[{{ $index+1 }}][safety_bathroom]" {{ (isset($bathroom['safety_bathroom']) && $bathroom['safety_bathroom'] == '1')?'checked':'checked' }}>
                                    <span class="checkmark app-checkmark"></span>
                                    <div class="app-form-checkbox-label">
                                        OK
                                    </div>
                                </label>
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="2" name="bathroomsList[{{ $index+1 }}][safety_bathroom]" {{ (isset($bathroom['safety_bathroom']) && $bathroom['safety_bathroom'] == '2')?'checked':'' }}>
                                    <span class="checkmark app-checkmark"></span><div class="app-form-checkbox-label">
                                        {{ __('labelAttention') }}
                                    </div>
                                </label>
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="3" name="bathroomsList[{{ $index+1 }}][safety_bathroom]" {{ (isset($bathroom['safety_bathroom']) && $bathroom['safety_bathroom'] == '3')?'checked':'' }}>
                                    <span class="checkmark app-checkmark"></span>
                                    <div class="app-form-checkbox-label">
                                        N/A
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-2 col-form-label">
                                {{ __('labelTub') }}
                            </label>
                
                            <div class="col-sm-10">
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="1" name="bathroomsList[{{ $index+1 }}][tub_bathroom]" {{ (isset($bathroom['tub_bathroom']) && $bathroom['tub_bathroom'] == '1')?'checked':'checked' }}>
                                    <span class="checkmark app-checkmark"></span>
                                    <div class="app-form-checkbox-label">
                                        OK
                                    </div>
                                </label>
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="2" name="bathroomsList[{{ $index+1 }}][tub_bathroom]" {{ (isset($bathroom['tub_bathroom']) && $bathroom['tub_bathroom'] == '2')?'checked':'' }}>
                                    <span class="checkmark app-checkmark"></span><div class="app-form-checkbox-label">
                                        {{ __('labelAttention') }}
                                    </div>
                                </label>
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="3" name="bathroomsList[{{ $index+1 }}][tub_bathroom]" {{ (isset($bathroom['tub_bathroom']) && $bathroom['tub_bathroom'] == '3')?'checked':'' }}>
                                    <span class="checkmark app-checkmark"></span>
                                    <div class="app-form-checkbox-label">
                                        N/A
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-2 col-form-label">
                                {{ __('labelLighting') }}
                            </label>
                
                            <div class="col-sm-10">
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="1" name="bathroomsList[{{ $index+1 }}][lighting_bathroom]" {{ (isset($bathroom['lighting_bathroom']) && $bathroom['lighting_bathroom'] == '1')?'checked':'checked' }}>
                                    <span class="checkmark app-checkmark"></span>
                                    <div class="app-form-checkbox-label">
                                        OK
                                    </div>
                                </label>
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="2" name="bathroomsList[{{ $index+1 }}][lighting_bathroom]" {{ (isset($bathroom['lighting_bathroom']) && $bathroom['lighting_bathroom'] == '2')?'checked':'' }}>
                                    <span class="checkmark app-checkmark"></span><div class="app-form-checkbox-label">
                                        {{ __('labelAttention') }}
                                    </div>
                                </label>
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="3" name="bathroomsList[{{ $index+1 }}][lighting_bathroom]" {{ (isset($bathroom['lighting_bathroom']) && $bathroom['lighting_bathroom'] == '3')?'checked':'' }}>
                                    <span class="checkmark app-checkmark"></span>
                                    <div class="app-form-checkbox-label">
                                        N/A
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-2 col-form-label">
                                {{ __('labelWindows') }}
                            </label>
                
                            <div class="col-sm-10">
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="1" name="bathroomsList[{{ $index+1 }}][windows_bathroom]" {{ (isset($bathroom['windows_bathroom']) && $bathroom['windows_bathroom'] == '1')?'checked':'checked' }}>
                                    <span class="checkmark app-checkmark"></span>
                                    <div class="app-form-checkbox-label">
                                        OK
                                    </div>
                                </label>
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="2" name="bathroomsList[{{ $index+1 }}][windows_bathroom]" {{ (isset($bathroom['windows_bathroom']) && $bathroom['windows_bathroom'] == '2')?'checked':'' }}>
                                    <span class="checkmark app-checkmark"></span><div class="app-form-checkbox-label">
                                        {{ __('labelAttention') }}
                                    </div>
                                </label>
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="3" name="bathroomsList[{{ $index+1 }}][windows_bathroom]" {{ (isset($bathroom['windows_bathroom']) && $bathroom['windows_bathroom'] == '3')?'checked':'' }}>
                                    <span class="checkmark app-checkmark"></span>
                                    <div class="app-form-checkbox-label">
                                        N/A
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-2 col-form-label">
                                {{ __('labelSink') }}
                            </label>
                
                            <div class="col-sm-10">
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="1" name="bathroomsList[{{ $index+1 }}][sink_bathroom]" {{ (isset($bathroom['sink_bathroom']) && $bathroom['sink_bathroom'] == '1')?'checked':'checked' }}>
                                    <span class="checkmark app-checkmark"></span>
                                    <div class="app-form-checkbox-label">
                                        OK
                                    </div>
                                </label>
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="2" name="bathroomsList[{{ $index+1 }}][sink_bathroom]" {{ (isset($bathroom['sink_bathroom']) && $bathroom['sink_bathroom'] == '2')?'checked':'' }}>
                                    <span class="checkmark app-checkmark"></span><div class="app-form-checkbox-label">
                                        {{ __('labelAttention') }}
                                    </div>
                                </label>
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="3" name="bathroomsList[{{ $index+1 }}][sink_bathroom]" {{ (isset($bathroom['sink_bathroom']) && $bathroom['sink_bathroom'] == '3')?'checked':'' }}>
                                    <span class="checkmark app-checkmark"></span>
                                    <div class="app-form-checkbox-label">
                                        N/A
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-2 col-form-label">
                                {{ __('labelStock') }}
                            </label>
                
                            <div class="col-sm-10">
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="1" name="bathroomsList[{{ $index+1 }}][stock_bathroom]" {{ (isset($bathroom['stock_bathroom']) && $bathroom['stock_bathroom'] == '1')?'checked':'checked' }}>
                                    <span class="checkmark app-checkmark"></span>
                                    <div class="app-form-checkbox-label">
                                        OK
                                    </div>
                                </label>
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="2" name="bathroomsList[{{ $index+1 }}][stock_bathroom]" {{ (isset($bathroom['stock_bathroom']) && $bathroom['stock_bathroom'] == '2')?'checked':'' }}>
                                    <span class="checkmark app-checkmark"></span><div class="app-form-checkbox-label">
                                        {{ __('labelAttention') }}
                                    </div>
                                </label>
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="3" name="bathroomsList[{{ $index+1 }}][stock_bathroom]" {{ (isset($bathroom['stock_bathroom']) && $bathroom['stock_bathroom'] == '3')?'checked':'' }}>
                                    <span class="checkmark app-checkmark"></span>
                                    <div class="app-form-checkbox-label">
                                        N/A
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-2 col-form-label">
                                {{ __('labelHotTub') }}
                            </label>
                
                            <div class="col-sm-10">
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="1" name="bathroomsList[{{ $index+1 }}][hottub_bathroom]" {{ (isset($bathroom['hottub_bathroom']) && $bathroom['hottub_bathroom'] == '1')?'checked':'checked' }}>
                                    <span class="checkmark app-checkmark"></span>
                                    <div class="app-form-checkbox-label">
                                        OK
                                    </div>
                                </label>
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="2" name="bathroomsList[{{ $index+1 }}][hottub_bathroom]" {{ (isset($bathroom['hottub_bathroom']) && $bathroom['hottub_bathroom'] == '2')?'checked':'' }}>
                                    <span class="checkmark app-checkmark"></span><div class="app-form-checkbox-label">
                                        {{ __('labelAttention') }}
                                    </div>
                                </label>
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="3" name="bathroomsList[{{ $index+1 }}][hottub_bathroom]" {{ (isset($bathroom['hottub_bathroom']) && $bathroom['hottub_bathroom'] == '3')?'checked':'' }}>
                                    <span class="checkmark app-checkmark"></span>
                                    <div class="app-form-checkbox-label">
                                        N/A
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-2 col-form-label">
                                {{ __('labelElectrical') }}
                            </label>
                
                            <div class="col-sm-10">
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="1" name="bathroomsList[{{ $index+1 }}][electrical_bathroom]" {{ (isset($bathroom['electrical_bathroom']) && $bathroom['electrical_bathroom'] == '1')?'checked':'checked' }}>
                                    <span class="checkmark app-checkmark"></span>
                                    <div class="app-form-checkbox-label">
                                        OK
                                    </div>
                                </label>
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="2" name="bathroomsList[{{ $index+1 }}][electrical_bathroom]" {{ (isset($bathroom['electrical_bathroom']) && $bathroom['electrical_bathroom'] == '2')?'checked':'' }}>
                                    <span class="checkmark app-checkmark"></span><div class="app-form-checkbox-label">
                                        {{ __('labelAttention') }}
                                    </div>
                                </label>
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="3" name="bathroomsList[{{ $index+1 }}][electrical_bathroom]" {{ (isset($bathroom['electrical_bathroom']) && $bathroom['electrical_bathroom'] == '3')?'checked':'' }}>
                                    <span class="checkmark app-checkmark"></span>
                                    <div class="app-form-checkbox-label">
                                        N/A
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-2 col-form-label">
                                {{ __('labelShower') }}
                            </label>
                
                            <div class="col-sm-10">
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="1" name="bathroomsList[{{ $index+1 }}][shower_bathroom]" {{ (isset($bathroom['shower_bathroom']) && $bathroom['shower_bathroom'] == '1')?'checked':'checked' }}>
                                    <span class="checkmark app-checkmark"></span>
                                    <div class="app-form-checkbox-label">
                                        OK
                                    </div>
                                </label>
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="2" name="bathroomsList[{{ $index+1 }}][shower_bathroom]" {{ (isset($bathroom['shower_bathroom']) && $bathroom['shower_bathroom'] == '2')?'checked':'' }}>
                                    <span class="checkmark app-checkmark"></span><div class="app-form-checkbox-label">
                                        {{ __('labelAttention') }}
                                    </div>
                                </label>
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="3" name="bathroomsList[{{ $index+1 }}][shower_bathroom]" {{ (isset($bathroom['shower_bathroom']) && $bathroom['shower_bathroom'] == '3')?'checked':'' }}>
                                    <span class="checkmark app-checkmark"></span>
                                    <div class="app-form-checkbox-label">
                                        N/A
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-2 col-form-label">
                                {{ __('labelCarpets') }}
                            </label>
                
                            <div class="col-sm-10">
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="1" name="bathroomsList[{{ $index+1 }}][carpets_bathroom]" {{ (isset($bathroom['carpets_bathroom']) && $bathroom['carpets_bathroom'] == '1')?'checked':'checked' }}>
                                    <span class="checkmark app-checkmark"></span>
                                    <div class="app-form-checkbox-label">
                                        OK
                                    </div>
                                </label>
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="2" name="bathroomsList[{{ $index+1 }}][carpets_bathroom]" {{ (isset($bathroom['carpets_bathroom']) && $bathroom['carpets_bathroom'] == '2')?'checked':'' }}>
                                    <span class="checkmark app-checkmark"></span><div class="app-form-checkbox-label">
                                        {{ __('labelAttention') }}
                                    </div>
                                </label>
                                <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                                    <input type="radio" value="3" name="bathroomsList[{{ $index+1 }}][carpets_bathroom]" {{ (isset($bathroom['carpets_bathroom']) && $bathroom['carpets_bathroom'] == '3')?'checked':'' }}>
                                    <span class="checkmark app-checkmark"></span>
                                    <div class="app-form-checkbox-label">
                                        N/A
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">
                                {{ __('labelComments') }}
                            </label>
                
                            <div class="col-sm-10">
                                <textarea name="bathroomsList[{{ $index+1 }}][comments_bathroom]" class="form-control ckeditor" rows="3" style="resize: none;">{{ $bathroom['comments_bathroom'] }}</textarea>
                            </div>
                        </div>
                        @if(!$disabled)
                            <a href="#" class="btn-remove-bathroom btn  btn-secondary m-1">
                                {{ __('labelRemove') }}
                            </a>
                        @endif
                    </div>
                @endforeach
            @endif
        </div>

        @if(!$disabled)
            <a href="#" id="btn-add-bathroom" class="btn  btn-primary m-1">
                {{ __('Add another bathroom') }}
            </a>
        @endif
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
            'label' => __('Interior/Exterior plants (trimmed, dead leaves removed, plague free)'),
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
            'label' => __('Water plants and check basics (hot water, air conditioners, internet, tv’s cable or streaming apps and safe)'),
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

<!-- separator -->
<div class="mb-4"></div>