@php
    $lang = LanguageHelper::current();
    $property = isset($property) ? $property : false;
    $propertyTranslation = $property->translations()->where('language_id', $lang->id)->first();
@endphp

@if($property)
    <div class="container app-container mb-4 app-property-info">
        <div class="card">
            <div class="card-body">
                
                    <div class="row row-xs">
                        <div class="col-md-1">
                            @if ($property->hasDefaultImage())
                                @php
                                    $propertyImg = $property->getDefaultImage();
                                @endphp

                                <a href="{{ route('properties.show', [$property->id]) }}">
                                    <img src="{{ asset(getUrlPath($propertyImg->file_url, 'small-ls')) }}" alt="" width="100">
                                </a>
                            @endif
                        </div>
                        <div class="col-md-4">
                            <div class="app-property-info-title">
                                <a href="{{ route('properties.show', [$property->id]) }}" class="text-primary">
                                    {{ $propertyTranslation->name }}
                                </a>                                    
                            </div>
                            <div class="app-property-info-details">
                                @if($property->bedrooms)
                                    <div>
                                        <b>{{ __('Bedrooms')}}: </b> {{ $property->bedrooms }}
                                    </div>
                                @endif

                                @if($property->baths)
                                    <div>
                                        <b>{{ __('Baths')}}: </b> {{ $property->baths }}
                                    </div>
                                @endif
                            </div>
                            <div class="app-property-info-details">
                                <div>
                                    <b>{{ __('Type')}}: </b> {{ $property->type->getLabel() }}
                                </div>
                                @if($property->sleeps)
                                    <div>
                                        <b>{{ __('Sleeps')}}: </b> {{ $property->sleeps }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-7 text-md-right app-property-info-icons">

                           <!-- property notes -->
                            <a 
                                href="{{ route('property-notes', $property->id) }}" 
                                class="text-primary app-icon-link"
                                title="{{ __('Notes') }}"
                                alt="{{ __('Notes') }}">
                                <i class="nav-icon i-Notepad font-weight-bold"></i>
                            </a>

                            <!-- property contacts -->
                            <a 
                                href="{{ route('property-contacts', $property->id) }}" 
                                class="text-primary app-icon-link"
                                title="{{ __('Contacts') }}"
                                alt="{{ __('Contacts') }}">
                                <i class="nav-icon i-Administrator font-weight-bold"></i>
                            </a>

                            <!-- property rates -->
                            @if( !isRole('owner') )
                                <a 
                                    href="{{ route('property-rates', $property->id) }}" 
                                    class="text-primary app-icon-link"
                                    title="{{ __('Rates') }}"
                                    alt="{{ __('Rates') }}">
                                    <i class="nav-icon i-Money-2 font-weight-bold"></i>
                                </a>
                            @endif

                            <!-- property images -->
                            @if( !isRole('owner') )
                                <a 
                                    href="{{ route('property-images', $property->id) }}"
                                    class="text-primary app-icon-link"
                                    title="{{ __('Images') }}"
                                    alt="{{ __('Images') }}">
                                    <i class="nav-icon i-Old-Camera font-weight-bold"></i>
                                </a>
                            @endif

                            <!-- bookings from specific to property -->
                            @if( !isRole('owner') )
                                <a 
                                    href="{{ route('bookings.by-property', $property->id) }}" 
                                    class="text-primary app-icon-link"
                                    title="{{ __('Bookings') }}"
                                    alt="{{ __('Bookings') }}">
                                    <i class="nav-icon i-Calendar-2 font-weight-bold"></i>
                                </a>
                            @endif

                            <!-- property management -->
                            <a 
                                href="{{ route('property-management', $property->id) }}" 
                                class="text-primary app-icon-link"
                                title="{{ __('Property Management') }}"
                                alt="{{ __('Property Management') }}">
                                <i class="nav-icon i-Building font-weight-bold"></i>
                            </a>

                        </div>
                    </div>

            </div>
        </div>
    </div>
@endif