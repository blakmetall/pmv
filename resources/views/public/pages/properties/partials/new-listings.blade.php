<section id="block-new-listings-new-listings-results-block" class="block block-new-listings clearfix">
    <h2 class="block-title">{{ __('New listings') }}</h2>
    <div class="row new-listings-results">
        @foreach ($propertiesNews as $index => $propertyNews)
            @php
                $zone = getZone($propertyNews->property_id);
                $propertyRate = getPropertyRate($propertyNews->property, $propertyNews->property->rates);
            @endphp
            
            @if ($index == 4)
                @php
                    break;
                @endphp
            @endif
            <div class="col-xs-3 col-sm-3"> 
                <img src="{{ getFeaturedImage($propertyNews->property_id) }}" width="100%" />
                
                <h4>{{ $propertyNews->name }}</h4>

                <div class="rate-info">
                   {{ priceFormat($propertyRate['nightlyAppliedRate']) }} USD <span>/ {{ __('Night') }}</span>
                </div>
                
                <p>{{ getSubString($propertyNews->description, 100) }}</p>
                
                <p class="mb-5">
                    <i class="glyphicon glyphicon-play"></i> <a
                        href="{{ route('public.property-detail', [App::getLocale(), $zone, $propertyNews->slug]) }}"
                        title="{{ __('READ MORE') }}" class="read-more-results">{{ __('READ MORE') }}</a>
                </p>
            </div>
        @endforeach
    </div>
</section>
