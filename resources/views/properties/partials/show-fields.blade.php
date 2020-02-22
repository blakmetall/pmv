<div class="row">                    
    <div class="col-md-12 form-group mb-3">
        @if ($label)
            <span class="badge badge-primary r-badge mb-4">{{ $label }}</span>
        @endif 
    </div>

    <div class="col-md-12 form-group mb-3">
        <label for="name">{{ __('Property Name') }}</label>
        <span class="form-control">  {{  $row[$lang]->translations->first()->name }} </span>
    </div>

    <div class="col-md-12 form-group mb-3">
        <label for="description">{{ __('Description') }}</label>
        <span class="form-control">  {{  $row[$lang]->translations->first()->description }}</span>    
    </div>
    <div class="col-md-12 form-group mb-3">
        <label for="cancellation">{{ __('Cancellation Policies') }}</label>
        <span class="form-control">  {{  $row[$lang]->translations->first()->cancellation_policies }} </span>         
    </div>

    <div class="col-md-4 form-group mb-3">
        <label for="cancellation">{{ __('Property Type') }}</label>
        <span class="form-control"> {{ $row->type->translations->first()->name }} </span>         
    </div>
    <div class="col-md-4 form-group mb-3">
        <label for="cancellation">{{ __('City') }}</label>
        <span class="form-control"> {{ $row->city->name }} </span>         
    </div>
    <div class="col-md-4 form-group mb-3">
        <label for="cancellation">{{ __('Clean Option') }}</label>
        <span class="form-control"> {{ $row->cleaningOption->translations->first()->name }} </span>         
    </div>

    <div class="col-md-3 form-group mb-3">
        <label for="cancellation">{{ __('Is Featured') }}</label>
        <span class="form-control"> {{ (($row->is_featured == 1) ? __('Yes') : __('No')) }} </span>         
    </div>
    <div class="col-md-3 form-group mb-3">
        <label for="cancellation">{{ __('Is Enabled') }}</label>
        <span class="form-control"> {{ (($row->is_enabled == 1) ? __('Yes') : __('No')) }} </span>         
    </div>
    <div class="col-md-3 form-group mb-3">
        <label for="cancellation">{{ __('Is Online') }}</label>
        <span class="form-control"> {{ (($row->is_online == 1) ? __('Yes') : __('No')) }} </span>         
    </div>
    <div class="col-md-3 form-group mb-3">
        <label for="cancellation">{{ __('Has Parking') }}</label>
        <span class="form-control"> {{ (($row->has_parking == 1) ? __('Yes') : __('No')) }} </span>         
    </div>

    <div class="col-md-4 form-group mb-3">
        <label for="cancellation">{{ __('Building') }}</label>
        <span class="form-control"> {{ $row->building }} </span>         
    </div>
    <div class="col-md-4 form-group mb-3">
        <label for="cancellation">{{ __('Rental Comission') }}</label>
        <span class="form-control"> {{ $row->rental_comission }} </span>         
    </div>
    <div class="col-md-4 form-group mb-3">
        <label for="cancellation">{{ __('Maid Fee') }}</label>
        <span class="form-control"> {{ $row->maid_fee }} </span>         
    </div>
    <div class="col-md-4 form-group mb-3">
        <label for="cancellation">{{ __('Bedrooms') }}</label>
        <span class="form-control"> {{ $row->bedrooms }} </span>         
    </div>

    <div class="col-md-4 form-group mb-3">
        <label for="cancellation">{{ __('Bedding') }}</label>
        <span class="form-control"> {{ $row->bedding_JSON }} </span>         
    </div>
    <div class="col-md-4 form-group mb-3">
        <label for="cancellation">{{ __('Baths') }}</label>
        <span class="form-control"> {{ $row->baths }} </span>         
    </div>
    <div class="col-md-4 form-group mb-3">
        <label for="cancellation">{{ __('Sleeps') }}</label>
        <span class="form-control"> {{ $row->sleeps }} </span>         
    </div>
    <div class="col-md-4 form-group mb-3">
        <label for="cancellation">{{ __('Floors') }}</label>
        <span class="form-control"> {{ $row->floors }} </span>         
    </div>

    <div class="col-md-4 form-group mb-3">
        <label for="cancellation">{{ __('Lot Size (Sqft)') }}</label>
        <span class="form-control"> {{ $row->lot_size_sqft }} </span>         
    </div>
    <div class="col-md-4 form-group mb-3">
        <label for="cancellation">{{ __('Construction Size (Sqft)') }}</label>
        <span class="form-control"> {{ $row->construction_size_sqft }} </span>         
    </div>
    <div class="col-md-4 form-group mb-3">
        <label for="cancellation">{{ __('Phone') }}</label>
        <span class="form-control"> {{ $row->phone }} </span>         
    </div>
    <div class="col-md-4 form-group mb-3">
        <label for="cancellation">{{ __('Address') }}</label>
        <span class="form-control"> {{ $row->address }} </span>         
    </div>

    <div class="col-md-6 form-group mb-3">
        <label for="cancellation">{{ __('Google Map Latitude') }}</label>
        <span class="form-control"> {{ $row->gmaps_lat }} </span>         
    </div>
    <div class="col-md-6 form-group mb-3">
        <label for="cancellation">{{ __('Google Map Longitude') }}</label>
        <span class="form-control"> {{ $row->gmaps_lon }} </span>         
    </div>

    <!--
    <div class="col-md-3 form-group mb-3">
        <label for="cancellation">{{ __('Property Type') }}</label>
        <span class="form-control"> {{ $row->type->translations[0]->name }} </span>         
    </div>
    <div class="col-md-3 form-group mb-3">
        <label for="cancellation">{{ __('City') }}</label>
        <span class="form-control"> {{ $row->city->name }} </span>         
    </div>
    <div class="col-md-3 form-group mb-3">
        <label for="cancellation">{{ __('Clean Option') }}</label>
        <span class="form-control"> {{ $row->cleaningOption->translations[0]->name }} </span>         
    </div>
    <div class="col-md-3 form-group mb-3">                                
    </div>

    <div class="col-md-3 form-group mb-3">
        <label for="cancellation">{{ __('Is Featured') }}</label>
        <span class="form-control"> {{ (($row->is_featured == 1) ? __('Yes') : __('No')) }} </span>         
    </div>
    <div class="col-md-3 form-group mb-3">
        <label for="cancellation">{{ __('Is Enabled') }}</label>
        <span class="form-control"> {{ (($row->is_enabled == 1) ? __('Yes') : __('No')) }} </span>         
    </div>
    <div class="col-md-3 form-group mb-3">
        <label for="cancellation">{{ __('Is Online') }}</label>
        <span class="form-control"> {{ (($row->is_online == 1) ? __('Yes') : __('No')) }} </span>         
    </div>
    <div class="col-md-3 form-group mb-3">
        <label for="cancellation">{{ __('Has Parking') }}</label>
        <span class="form-control"> {{ (($row->has_parking == 1) ? __('Yes') : __('No')) }} </span>         
    </div>

    <div class="col-md-3 form-group mb-3">
        <label for="cancellation">{{ __('Building') }}</label>
        <span class="form-control"> {{ $row->building }} </span>         
    </div>
    <div class="col-md-3 form-group mb-3">
        <label for="cancellation">{{ __('Rental Comission') }}</label>
        <span class="form-control"> {{ $row->rental_comission }} </span>         
    </div>
    <div class="col-md-3 form-group mb-3">
        <label for="cancellation">{{ __('Maid Fee') }}</label>
        <span class="form-control"> {{ $row->maid_fee }} </span>         
    </div>
    <div class="col-md-3 form-group mb-3">
        <label for="cancellation">{{ __('Bedrooms') }}</label>
        <span class="form-control"> {{ $row->bedrooms }} </span>         
    </div>

    <div class="col-md-3 form-group mb-3">
        <label for="cancellation">{{ __('Bedding') }}</label>
        <span class="form-control"> {{ $row->bedding_JSON }} </span>         
    </div>
    <div class="col-md-3 form-group mb-3">
        <label for="cancellation">{{ __('Baths') }}</label>
        <span class="form-control"> {{ $row->baths }} </span>         
    </div>
    <div class="col-md-3 form-group mb-3">
        <label for="cancellation">{{ __('Sleeps') }}</label>
        <span class="form-control"> {{ $row->sleeps }} </span>         
    </div>
    <div class="col-md-3 form-group mb-3">
        <label for="cancellation">{{ __('Floors') }}</label>
        <span class="form-control"> {{ $row->floors }} </span>         
    </div>

    <div class="col-md-3 form-group mb-3">
        <label for="cancellation">{{ __('Lot Size (Sqft)') }}</label>
        <span class="form-control"> {{ $row->lot_size_sqft }} </span>         
    </div>
    <div class="col-md-3 form-group mb-3">
        <label for="cancellation">{{ __('Construction Size (Sqft)') }}</label>
        <span class="form-control"> {{ $row->construction_size_sqft }} </span>         
    </div>
    <div class="col-md-3 form-group mb-3">
        <label for="cancellation">{{ __('Phone') }}</label>
        <span class="form-control"> {{ $row->phone }} </span>         
    </div>
    <div class="col-md-3 form-group mb-3">
        <label for="cancellation">{{ __('Address') }}</label>
        <span class="form-control"> {{ $row->address }} </span>         
    </div>

    <div class="col-md-6 form-group mb-3">
        <label for="cancellation">{{ __('Google Map Latitude') }}</label>
        <span class="form-control"> {{ $row->gmaps_lat }} </span>         
    </div>
    <div class="col-md-6 form-group mb-3">
        <label for="cancellation">{{ __('Google Map Longitude') }}</label>
        <span class="form-control"> {{ $row->gmaps_lon }} </span>         
    </div>
    -->


</div>
