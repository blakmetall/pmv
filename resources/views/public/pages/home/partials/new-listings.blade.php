<div class="panel-pane pane-block pane-new-listings-new-listings-block">
    <h2 class="pane-title">New listings</h2>
    <div class="pane-content">
        <div class="row new-listings">
            @foreach ($propertiesNews as $index => $propertyNews)
                @if ($index == 4)
                    @php
                    break;
                    @endphp
                @endif
                <div class="col-xs-6 first-row">
                    <div class="row">
                        <div class="col-xs-4">
                            <img src="{{ getFeaturedImage($propertyNews->property_id) }}" width="100%" height="110" />
                        </div>
                        <div class="col-xs-8">
                            <h5>{{ $propertyNews->name }}</h5>
                            <p>{{ getSubString($propertyNews->description, 200) }}</p>
                            <p><a href="/north-hotel-zone/hale-hoomaha" title="{{ __('READ MORE') }}"
                                    class="read-more">{{ __('READ MORE') }}</a></p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
