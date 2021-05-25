<div class="panel-pane pane-block pane-new-listings-new-listings-block pt-3">
    <h2 class="pane-title mb-5 pb-3">{{ __('New listings') }}</h2>

    <div class="pane-content">
        <div class="row-fluid new-listings">
            @foreach ($propertiesNews as $index => $propertyNews)
                @php
                    $zone = getZone($propertyNews->property_id);
                @endphp
                
                @if ($index == 4)
                    @php
                        break;
                    @endphp
                @endif

                <div class="col-xs-6 first-row pl-0">
                    <div class="row">
                        <div class="col-xs-4 mb-4">
                            <img src="{{ getFeaturedImage($propertyNews->property_id, 'large') }}" width="100%" />
                        </div>

                        <div class="col-xs-8">
                            <h5>{{ $propertyNews->name }}</h5>
                            
                            <p class="mb-5">{{ getSubString($propertyNews->description, 200) }}</p>

                            <a href="{{ route('public.property-detail', [$zone, $propertyNews->slug]) }}" class="btn btn-primary btn-xs" role="button">
                                {{ __('VIEW') }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
