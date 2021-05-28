<aside class="col-sm-3" role="complementary">
    <div class="region region-sidebar-second">
        <section id="block-recent-views-recent-views-block" class="block block-recent-views clearfix">
            <div id="reservations-details-block">
                <div class="price-box">
                    <img src="{{ $featuredImage }}" width="100%">
                    <div class="rate-night text-center"><sup>$</sup>{{ $propertyRate['nightlyAppliedRate'] }}</div>
                    <div class="price-txt text-center"><span>USD {{ __('Night') }}</span></div>
                    <div class="total-stay text-center">{{ priceFormat($propertyRate['total']) }}</div>
                    <div class="total-stay-text text-center">
                        USD {{ __('Total Stay') }} ({{ $nightsDate }} {{ __('Nights') }})
                    </div>
                </div>
                <div class="success"> <i class="far fa-calendar-alt"></i>
                    <div>{{ __('Arrival') }}</div>
                    <div><span class="arrival-single">{{ $arrivalTxt }}</span></div>
                </div>
                <div class="success"> <i class="far fa-calendar-alt"></i>
                    <div>{{ __('Departure') }}</div>
                    <div><span class="departure-single">{{ $departureTxt }}</span></div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <div class="success"><i class="fa fa-male"></i>{{ __('Adults') }}<br><span
                                class="adults-single">{{ $adults }}</span>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="success"><i class="fa fa-child"></i>{{ __('Children') }}<br><span
                                class="children-single">{{ $children }}</span></div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</aside>
