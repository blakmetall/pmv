<div class="panel-pane pane-block pane-featured-listings-featured-listings-block pt-3">
    <h2 class="pane-title mb-5 pb-3">{{ __('Featured listings') }}</h2>
    <div class="pane-content">
        <div class="featured-listings">
            @foreach ($propertiesFeatured as $propertyFeatured)
                @php
                    $zone = getZone($propertyFeatured->property_id);
                @endphp

                <div class="item mb-5">
                    <img src="{{ getFeaturedImage($propertyFeatured->property_id) }}" />

                    <div class="box_mid">
                        <h4 class="title">{{ $propertyFeatured->name }}</h4>
                        <div class="description mb-2">{{ getSubString($propertyFeatured->description, 200) }}</div>
                        <div class="rate mb-4">
                            {{ __('From') }} ${{ getLowerRate($propertyFeatured->property_id) }} USD
                            /
                            {{ __('Night') }}
                        </div>
                    </div>
                    <p>
                        <a href="{{ route('public.property-detail', [$zone, $propertyFeatured->slug]) }}" title="{{ __('READ MORE') }}">
                            {{ __('VIEW') }}
                        </a>
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</div>
