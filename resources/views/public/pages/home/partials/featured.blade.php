<div class="panel-pane pane-block pane-featured-listings-featured-listings-block">
    <h2 class="pane-title">Featured listings</h2>
    <div class="pane-content">
        <div class="featured-listings row">
            @foreach ($propertiesFeatured as $propertyFeatured)
                <div class="item col-xs-3">
                    <img src="{{ getFeaturedImage($propertyFeatured->property_id) }}" />
                    <div class="box_mid">
                        <h4 class="title">{{ $propertyFeatured->name }}</h4>
                        <div class="description">{{ getSubString($propertyFeatured->description, 200) }}</div>
                        <div class="rate">{{ __('From') }} ${{ getLowerRate($propertyFeatured->property_id) }} USD /
                            night</div>
                    </div>
                    <p><a href="/old-town-zona-romantica/v177-207"
                            title="{{ __('READ MORE') }}">{{ __('READ MORE') }}</a></p>
                </div>
            @endforeach
        </div>
    </div>
</div>
