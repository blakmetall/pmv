<!-- english -->

<div class="card">
    <div class="card-body">       

        <div class="row">
            @if(count($cities))                
                <div class="col-md-6 form-group mb-3">
                    <label for="field_city_id">
                        {{ __('City') }}
                    </label>
                    <select class="form-control" name="city_id" id="field_city_id">
                        @foreach($cities  as $city)                            
                            <option value="{{ $city->id }}" {{ ( ($property->city_id == $city->id) ? 'selected' : '' ) }}>
                                {{ $city->name }}
                            </option>
                        @endforeach
                    </select>
                </div>             
            @endif

            @if(count($zones))                
                <div class="col-md-6 form-group mb-3">
                    <label for="field_zone_id">
                        {{ __('Zone') }}
                    </label>
                    <select class="form-control" name="zone_id" id="field_zone_id">
                        @foreach($zones as $zone)  
                            @php 
                                $selected = ($property->zone_id == $zone->id) ? 'selected' : '';
                            @endphp                          
                            <option value="{{ $zone->id }}" {{ $selected }}>
                                {{ $zone->translations->first()->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endif 

            @if(count($property_types))                
                <div class="col-md-6 form-group mb-3">
                    <label for="field_property_type_id">
                        {{ __('Property Type') }}
                    </label>
                    <select class="form-control" name="property_type_id" id="field_property_type_id">
                        @foreach($property_types as $property_type) 
                            @php
                                $selected = ($property->property_type_id == $property_type->id) ? 'selected' : '';
                            @endphp                           
                            <option value="{{ $property_type->id }}" {{ $selected }}>
                                {{ $property_type->translations->first()->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endif 
            
            @if(count($cleaning_option))                
                <div class="col-md-6 form-group mb-3">
                    <label for="field_cleaning_option_id">
                        {{ __('Cleaning Option') }}
                    </label>
                    <select class="form-control" name="cleaning_option_id" id="field_cleaning_option_id">
                        @foreach($cleaning_option as $clean_option)
                            @php
                                $selected = ($property->cleaning_option_id == $clean_option->id) ? 'selected' : '';
                            @endphp
                            <option value="{{ $clean_option->id }}" {{ $selected }}>
                                {{ $clean_option->translations->first()->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endif 

             
            <div class="card-body">
                <label class="switch pr-5 switch-primary mr-3">
                    <span>{{ __('Featured') }}</span>

                    @php $checked = isset($property->is_featured) ? 'checked="checked"' : ''; @endphp
                    <input  type="checkbox" {{ $checked }}  name="is_featured" />
                    <span class="slider"></span>
                </label>

                <label class="switch pr-5 switch-primary mr-3">
                    <span>{{ __('Enabled') }}</span>

                    @php $checked = isset($property->is_enabled) ? 'checked="checked"' : ''; @endphp
                    <input type="checkbox"  name="is_enabled" {{ $checked }}/>
                    <span class="slider"></span>
                </label>

                <label class="switch pr-5 switch-primary mr-3">
                    <span>{{ __('Online') }}</span>

                    @php $checked = isset($property->is_online) ? 'checked="checked"' : ''; @endphp
                    <input type="checkbox" name="is_online" {{ $checked }}/>
                    <span class="slider"></span>
                </label>

                <label class="switch pr-5 switch-primary mr-3">
                    <span>{{ __('Has Parking') }}</span>
                    
                    @php $checked = isset($property->has_parking) ? 'checked="checked"' : ''; @endphp
                    <input type="checkbox" name="has_parking" {{ $checked }}/>
                    <span class="slider"></span>
                </label>
            </div>

            <div class="col-md-6 form-group mb-3">
                <label for="field_building">
                    {{ __('Building') }}
                </label>

                <input
                    id="field_building"
                    class="form-control"  
                    type="text" 
                    name="building" 
                    value="{{ old(('property.' . $lang), (isset($property) ? $property->building : '')) }}"/>
            </div>

            <div class="col-md-6 form-group mb-3">
                <label for="field_rental_comission">
                    {{ __('Rental Comission') }}
                </label>
                 <input 
                    id="field_rental_comission"
                    class="form-control" 
                    type="text" 
                    name="rental_comission" 
                    value="{{ old(('property.' . $lang), (isset($property) ? $property->rental_comission : '')) }}"/>
            </div>  
                
            <div class="col-md-6 form-group mb-3">
                <label for="field_maid_fee">
                    {{ __('Maid Fee') }}
                </label>
                <input 
                    id="field_maid_fee"
                    class="form-control" 
                    type="number" 
                    name="maid_fee"
                    value="{{ old(('property.' . $lang), (isset($property) ? $property->maid_fee : '')) }}" />
            </div>
            <div class="col-md-6 form-group mb-3">
                <label for="field_bedrooms">
                    {{ __('Bedrooms') }}
                </label>
                <input 
                    id="field_bedrooms"
                    class="form-control" 
                    type="number" 
                    name="bedrooms" 
                    value="{{ old(('property.' . $lang), (isset($property) ? $property->bedrooms : '')) }}"/>
            </div>
            <div class="col-md-6 form-group mb-3">
                <label for="field_bedding_json">
                    {{ __('Bedding') }}
                </label>
                <input 
                    id="field_bedding_json"
                    class="form-control" 
                    type="number" 
                    name="bedding_JSON" 
                    value="{{ old(('property.' . $lang), (isset($property) ? $property->bedding_JSON : '')) }}"/>
            </div>
            <div class="col-md-6 form-group mb-3">
                <label for="field_baths">
                    {{ __('Baths') }}
                </label>
                <input 
                    id="field_baths"
                    class="form-control" 
                    type="number" 
                    name="baths" 
                    value="{{ old(('property.' . $lang), (isset($property->baths) ? $property->baths : '')) }}"/>
            </div>
            <div class="col-md-6 form-group mb-3">
                <label for="field_sleeps">
                    {{ __('Sleeps') }}
                </label>
                <input 
                    id="field_sleeps"
                    class="form-control" 
                    type="number" 
                    name="sleeps" 
                    value="{{ old(('property.' . $lang), (isset($property) ? $property->sleeps : '')) }}"/>
            </div>
            <div class="col-md-6 form-group mb-3">
                <label for="field_floors">
                    {{ __('Floors') }}
                </label>
                <input 
                    id="field_floors"
                    class="form-control"  
                    type="number" 
                    name="floors" 
                    value="{{ old(('property.' . $lang), (isset($property) ? $property->floors : '')) }}"/>
            </div>
            
            <div class="col-md-6 form-group mb-3">
                <label for="field_lot_size_sqft">
                    {{ __('Lot Size (sqft)') }}
                </label>
                <input 
                    id="field_lot_size_sqft"
                    class="form-control"  
                    type="number" 
                    name="lot_size_sqft" 
                    value="{{ old(('property.' . $lang), (isset($property) ? $property->lot_size_sqft : '')) }}"/>
            </div>
            <div class="col-md-6 form-group mb-3">
                <label for="field_construction_size_sqft">
                    {{ __('Construction Size (sqft)') }}
                </label>
                <input 
                    id="field_construction_size_sqft"
                    class="form-control" 
                    type="number" 
                    name="construction_size_sqft" 
                    value="{{ old(('property.' . $lang), (isset($property) ? $property->construction_size_sqft : '')) }}"/>
            </div>
            <div class="col-md-6 form-group mb-3">
                <label for="field_phone">
                    {{ __('Phone') }}
                </label>
                <input 
                    id="field_phone"
                    class="form-control" 
                    type="text" 
                    name="phone" 
                    value="{{ old(('property.' . $lang), (isset($property) ? $property->phone : '')) }}"/>
            </div>
            <div class="col-md-6 form-group mb-3">
                <label for="field_address">
                    {{ __('Address') }}
                </label>
                <input 
                    id="field_address"
                    class="form-control"  
                    type="text" 
                    name="address" 
                    value="{{ old(('property.' . $lang), (isset($property) ? $property->address : '')) }}"/>
            </div>

            <div class="col-md-12 card-title">{{ __('Google Maps') }}</div>
            <div class="col-md-6 form-group mb-3">
                <label for="field_latitude">
                    {{ __('Latitude') }}
                </label>

                <input 
                    id="field_latitude"
                    class="form-control" 
                    type="number" 
                    name="gmaps_lat" 
                    value="{{ old(('property.' . $lang), (isset($property) ? $property->gmaps_lat : '')) }}"/>
            </div>
            <div class="col-md-6 form-group mb-3">
                <label for="field_longitude">
                    {{ __('Longitude') }}
                </label>
                <input 
                    id="field_longitude"
                    class="form-control"  
                    type="number" 
                    name="gmaps_lon" 
                    value="{{ old(('property.' . $lang), (isset($property) ? $property->gmaps_lon : '')) }}"/>
            </div>

        </div>

    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>