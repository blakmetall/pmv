<aside class="col-sm-3" role="complementary">
    <div class="region region-sidebar-second">
        <section id="block-recent-views-recent-views-block" class="block block-recent-views clearfix">
            <div id="reservations-details-block">
                <div class="price-box">
                    <img src="{{ $featuredImage }}" width="100%">
                    <div class="rate-night text-center"><sup>$</sup>{{ $nightlyRate }}</div>
                    <div class="price-txt text-center"><span>USD Night</span></div>
                    <div class="total-stay text-center">${{ $subtotal }}</div>
                    <div class="total-stay-text text-center">USD Total stay ({{ $nightsDate }} nights)</div>
                </div>
                <div class="success"> <i class="far fa-calendar-alt"></i>
                    <div>Arrival</div>
                    <div><span class="arrival-single">{{ $arrivalTxt }}</span></div>
                </div>
                <div class="success"> <i class="far fa-calendar-alt"></i>
                    <div>Departure</div>
                    <div><span class="departure-single">{{ $departureTxt }}</span></div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <div class="success"><i class="fa fa-male"></i>Adults<br><span
                                class="adults-single">{{ $adults }}</span>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="success"><i class="fa fa-child"></i>Children<br><span
                                class="children-single">{{ $children }}</span></div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</aside>
