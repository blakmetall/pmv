<!-- english -->



<div class="card">
    <div class="card-body">       

        <div class="row">
            @if(count($cities ?? ''))                
                <div class="col-md-6 form-group mb-3">
                    <label for="picker1">{{ __('City') }}</label>
                    <select class="form-control" 
                    name="city_id">
                        @foreach($cities ?? '' as $city)
                            <option value="{{ $city->id }}">{{ $city->name }}</option>
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
                            <option value="{{ $zone->id }}">{{ $zone->name }}</option>
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
                            <option value="{{ $property_type->id }}">{{ $property_type->name }}</option>
                        @endforeach
                    </select>
                </div>
            @endif 
            
            @if(count($cleaning_option))                
                <div class="col-md-6 form-group mb-3">
                    <label for="picker1">{{ __('Cleaning Option') }}</label>
                    <select class="form-control" name="cleaning_option_id">
                        @foreach($cleaning_option as $clean_option)
                            <option value="{{ $clean_option->id }}">{{ $clean_option->name }}</option>
                        @endforeach
                    </select>
                </div>
            @endif 

             
            <div class="card-body">
                <label class="switch pr-5 switch-primary mr-3"><span>{{ __('Featured') }}</span>
                    <input type="checkbox" checked="checked" name="is_featured" /><span class="slider"></span>
                </label>
                <label class="switch pr-5 switch-primary mr-3"><span>{{ __('Enabled') }}</span>
                    <input type="checkbox" checked="checked" name="is_enabled" /><span class="slider"></span>
                </label>
                <label class="switch pr-5 switch-primary mr-3"><span>{{ __('Online') }}</span>
                    <input type="checkbox" checked="checked" name="is_online" /><span class="slider"></span>
                </label>
                <label class="switch pr-5 switch-primary mr-3"><span>{{ __('Has Parking') }}</span>
                    <input type="checkbox" checked="checked" name="has_parking" /><span class="slider"></span>
                </label>
            </div>

            <div class="col-md-6 form-group mb-3">
                <label for="firstName1">{{ __('Building') }}</label>
                <input class="form-control"  type="text" placeholder="Building"  name="building" />
            </div>
            <div class="col-md-6 form-group mb-3">
                <label for="picker1">{{ __('Rental Comission') }}</label>
                <select class="form-control" name="rental_comission">
                    <option>100.00</option>
                    <option>400.00</option>
                    <option>700.00</option>
                </select>
            </div>  
                
            <div class="col-md-6 form-group mb-3">
                <label for="firstName1">{{ __('Maid Fee') }}</label>
                <input class="form-control"  type="number" placeholder="Maid Fee" name="maid_fee" />
            </div>
            <div class="col-md-6 form-group mb-3">
                <label for="firstName1">{{ __('Bedrooms') }}</label>
                <input class="form-control"  type="number" placeholder="Bedrooms" name="bedrooms" />
            </div>
            <div class="col-md-6 form-group mb-3">
                <label for="firstName1">{{ __('Bedding') }}</label>
                <input class="form-control"  type="number" placeholder="Bedding" name="bedding_JSON" />
            </div>
            <div class="col-md-6 form-group mb-3">
                <label for="firstName1">{{ __('Baths') }}</label>
                <input class="form-control"  type="number" placeholder="Baths" name="baths" />
            </div>
            <div class="col-md-6 form-group mb-3">
                <label for="firstName1">{{ __('Sleeps') }}</label>
                <input class="form-control"  type="number" placeholder="Sleeps" name="sleeps" />
            </div>
            <div class="col-md-6 form-group mb-3">
                <label for="firstName1">{{ __('Floors') }}</label>
                <input class="form-control"  type="number" placeholder="Floors" name="floors" />
            </div>
            
            <div class="col-md-6 form-group mb-3">
                <label for="firstName1">{{ __('Lot Size (sqft)') }}</label>
                <input class="form-control"  type="number" placeholder="lot_size_sqft" name="lot_size_sqft" />
            </div>
            <div class="col-md-6 form-group mb-3">
                <label for="firstName1">{{ __('Construction Size (sqft)') }}</label>
                <input class="form-control"  type="number" placeholder="construction_size_sqft" name="construction_size_sqft" />
            </div>
            <div class="col-md-6 form-group mb-3">
                <label for="firstName1">{{ __('Phone') }}</label>
                <input class="form-control"  type="text" placeholder="Phone" name="phone" />
            </div>
            <div class="col-md-6 form-group mb-3">
                <label for="firstName1">{{ __('Address') }}</label>
                <input class="form-control"  type="text" placeholder="Address" name="address" />
            </div>
            <div class="col-md-12 card-title">{{ __('Google Maps') }}</div>
            <div class="col-md-6 form-group mb-3">
                <label for="firstName1">{{ __('Latitude') }}</label>
                <input class="form-control"  type="number" placeholder="Latitude" name="gmaps_lat" />
            </div>
            <div class="col-md-6 form-group mb-3">
                <label for="firstName1">{{ __('Longitude') }}</label>
                <input class="form-control"  type="number" placeholder="Longitude" name="gmaps_lon" />
            </div>

        </div>

    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>