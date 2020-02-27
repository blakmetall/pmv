<!-- english -->

<div class="card">
    <div class="card-body">       

        <div class="row">
            @if(count($cities))                
                <div class="col-md-6 form-group mb-3">
                    <label for="picker1">{{ __('City') }}</label>
                    <select class="form-control" 
                    name="city_id">
                        @foreach($cities  as $city)                            
                            <option value="{{ $city->id }}" {{ ( ($property->city_id == $city->id) ? 'selected' : '' ) }}>{{ $city->name }}</option>
                        @endforeach
                    </select>
                </div>             
            @endif

            @if(count($zones))                
                <div class="col-md-6 form-group mb-3">
                    <label for="picker1">{{ __('Zone') }}</label>
                    <select class="form-control"
                     name="zone_id">
                        @foreach($zones as $zone)                            
                            <option value="{{ $zone->id }}" {{ ( ($property->zone_id == $zone->id) ? 'selected' : '' ) }}>
                                {{ $zone->translations->first()->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endif 

            @if(count($properties_types))                
                <div class="col-md-6 form-group mb-3">
                    <label for="picker1">{{ __('Property Type') }}</label>
                    <select class="form-control" 
                    name="property_type_id">
                        @foreach($properties_types as $property_type)                            
                            <option value="{{ $property_type->id }}" {{ ( ($property->property_type_id == $property_type->id) ? 'selected' : '' ) }}>
                                {{ $property_type->translations->first()->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endif 
            
            @if(count($cleaning_option))                
                <div class="col-md-6 form-group mb-3">
                    <label for="picker1">{{ __('Cleaning Option') }}</label>
                    <select class="form-control" name="cleaning_option_id">
                        @foreach($cleaning_option as $clean_option)
                            <option value="{{ $clean_option->id }}" {{ ( ($property->cleaning_option_id == $clean_option->id) ? 'selected' : '' ) }}>
                                {{ $clean_option->translations->first()->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endif 

             
            <div class="card-body">
                <label class="switch pr-5 switch-primary mr-3"><span>{{ __('Featured') }}</span>
                    <input  type="checkbox"  {{ (isset($property->is_featured) ? 'checked="checked"' : '' ) }}  name="is_featured" /><span class="slider"></span>
                </label>
                <label class="switch pr-5 switch-primary mr-3"><span>{{ __('Enabled') }}</span>
                    <input type="checkbox"  name="is_enabled" {{ (isset($property->is_enabled) ? 'checked="checked"' : '' ) }}/><span class="slider"></span>
                </label>
                <label class="switch pr-5 switch-primary mr-3"><span>{{ __('Online') }}</span>
                    <input type="checkbox" name="is_online" {{ (isset($property->is_online) ? 'checked="checked"' : '' ) }}/><span class="slider"></span>
                </label>
                <label class="switch pr-5 switch-primary mr-3"><span>{{ __('Has Parking') }}</span>
                    <input type="checkbox" name="has_parking" {{ (isset($property->has_parking) ? 'checked="checked"' : '' ) }}/><span class="slider"></span>
                </label>
            </div>

            <div class="col-md-6 form-group mb-3">
                <label for="firstName1">{{ __('Building') }}</label>
                <input class="form-control"  type="text" placeholder="Building"  name="building" 
                 value="{{ old(('property.' . $lang), (isset($property) ? $property->building : '')) }}"/>
            </div>

            <div class="col-md-6 form-group mb-3">
                <label for="picker1">{{ __('Rental Comission') }}</label>
                 <input class="form-control"  type="text" placeholder="Rental Comission"  name="rental_comission" 
                 value="{{ old(('property.' . $lang), (isset($property) ? $property->rental_comission : '')) }}"/>
            </div>  
                
            <div class="col-md-6 form-group mb-3">
                <label for="firstName1">{{ __('Maid Fee') }}</label>
                <input class="form-control"  type="number" placeholder="Maid Fee" name="maid_fee"
                value="{{ old(('property.' . $lang), (isset($property) ? $property->maid_fee : '')) }}" />
            </div>
            <div class="col-md-6 form-group mb-3">
                <label for="firstName1">{{ __('Bedrooms') }}</label>
                <input class="form-control"  type="number" placeholder="Bedrooms" name="bedrooms" 
                value="{{ old(('property.' . $lang), (isset($property) ? $property->bedrooms : '')) }}"/>
            </div>
            <div class="col-md-6 form-group mb-3">
                <label for="firstName1">{{ __('Bedding') }}</label>
                <input class="form-control"  type="number" placeholder="Bedding" name="bedding_JSON" 
                value="{{ old(('property.' . $lang), (isset($property) ? $property->bedding_JSON : '')) }}"/>
            </div>
            <div class="col-md-6 form-group mb-3">
                <label for="firstName1">{{ __('Baths') }}</label>
                <input class="form-control"  type="number" placeholder="Baths" name="baths" 
                value="{{ old(('property.' . $lang), (isset($property->baths) ? $property->baths : '')) }}"/>
            </div>
            <div class="col-md-6 form-group mb-3">
                <label for="firstName1">{{ __('Sleeps') }}</label>
                <input class="form-control"  type="number" placeholder="Sleeps" name="sleeps" 
                value="{{ old(('property.' . $lang), (isset($property) ? $property->sleeps : '')) }}"/>
            </div>
            <div class="col-md-6 form-group mb-3">
                <label for="firstName1">{{ __('Floors') }}</label>
                <input class="form-control"  type="number" placeholder="Floors" name="floors" 
                value="{{ old(('property.' . $lang), (isset($property) ? $property->floors : '')) }}"/>
            </div>
            
            <div class="col-md-6 form-group mb-3">
                <label for="firstName1">{{ __('Lot Size (sqft)') }}</label>
                <input class="form-control"  type="number" placeholder="lot_size_sqft" name="lot_size_sqft" 
                value="{{ old(('property.' . $lang), (isset($property) ? $property->lot_size_sqft : '')) }}"/>
            </div>
            <div class="col-md-6 form-group mb-3">
                <label for="firstName1">{{ __('Construction Size (sqft)') }}</label>
                <input class="form-control"  type="number" placeholder="construction_size_sqft" name="construction_size_sqft" 
                value="{{ old(('property.' . $lang), (isset($property) ? $property->construction_size_sqft : '')) }}"/>
            </div>
            <div class="col-md-6 form-group mb-3">
                <label for="firstName1">{{ __('Phone') }}</label>
                <input class="form-control"  type="text" placeholder="Phone" name="phone" 
                value="{{ old(('property.' . $lang), (isset($property) ? $property->phone : '')) }}"/>
            </div>
            <div class="col-md-6 form-group mb-3">
                <label for="firstName1">{{ __('Address') }}</label>
                <input class="form-control"  type="text" placeholder="Address" name="address" 
                value="{{ old(('property.' . $lang), (isset($property) ? $property->address : '')) }}"/>
            </div>
            <div class="col-md-12 card-title">{{ __('Google Maps') }}</div>
            <div class="col-md-6 form-group mb-3">
                <label for="firstName1">{{ __('Latitude') }}</label>
                <input class="form-control"  type="number" placeholder="Latitude" name="gmaps_lat" 
                value="{{ old(('property.' . $lang), (isset($property) ? $property->gmaps_lat : '')) }}"/>
            </div>
            <div class="col-md-6 form-group mb-3">
                <label for="firstName1">{{ __('Longitude') }}</label>
                <input class="form-control"  type="number" placeholder="Longitude" name="gmaps_lon" 
                value="{{ old(('property.' . $lang), (isset($property) ? $property->gmaps_lon : '')) }}"/>
            </div>

        </div>

    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>