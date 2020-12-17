@extends('layouts.public-master')

@section('page-css')
    {{-- property details css --}}
    <link rel="stylesheet" href="{{ asset('assets/public/css/property-details.css') }}">
@endsection

@section('main-content')

    @include('public.pages.partials.content-top')

    @php
    $title = __('V177 - 503');
    @endphp

    @include('public.pages.partials.main-content-start')

    <div id="property-details">
        <div id="property-gallery-info">
            <div class="cssload-thecube" style="display: none;">
                <div class="cssload-cube cssload-c1"></div>
                <div class="cssload-cube cssload-c2"></div>
                <div class="cssload-cube cssload-c4"></div>
                <div class="cssload-cube cssload-c3"></div>
            </div>
            <div id="slider" class="flexslider flexslider-loading">
                <div class="flex-viewport" style="overflow: hidden; position: relative; height: 344px;">
                    <ul class="slides"
                        style="width: 1600%; transition-duration: 0s; transform: translate3d(0px, 0px, 0px);">
                        <li style="width: 848px; margin-right: 0px; float: left; display: block;" class="flex-active-slide">
                            <img src="/images/property-images/1193/original/img-u94mExsV-1604445401.jpg" draggable="false">
                        </li>
                        <li style="width: 848px; margin-right: 0px; float: left; display: block;"><img
                                src="/images/property-images/1193/original/img-LP877Tc6-1604445403.jpg" draggable="false">
                        </li>
                        <li style="width: 848px; margin-right: 0px; float: left; display: block;"><img
                                src="/images/property-images/1193/original/img-gEmWD7uS-1604445402.jpg" draggable="false">
                        </li>
                        <li style="width: 848px; margin-right: 0px; float: left; display: block;"><img
                                src="/images/property-images/1193/original/img-I6U36Rn4-1604445402.jpg" draggable="false">
                        </li>
                        <li style="width: 848px; margin-right: 0px; float: left; display: block;"><img
                                src="/images/property-images/1193/original/img-te3w0io9-1604445402.jpg" draggable="false">
                        </li>
                        <li style="width: 848px; margin-right: 0px; float: left; display: block;"><img
                                src="/images/property-images/1193/original/img-WESZBqse-1604445403.jpg" draggable="false">
                        </li>
                        <li style="width: 848px; margin-right: 0px; float: left; display: block;"><img
                                src="/images/property-images/1193/original/img-idUGHTOC-1604445404.jpg" draggable="false">
                        </li>
                        <li style="width: 848px; margin-right: 0px; float: left; display: block;"><img
                                src="/images/property-images/1193/original/img-mG72t1C7-1604445404.jpg" draggable="false">
                        </li>
                    </ul>
                </div>
                <ul class="flex-direction-nav">
                    <li class="flex-nav-prev"><a class="flex-prev flex-disabled" href="#" tabindex="-1"></a></li>
                    <li class="flex-nav-next"><a class="flex-next" href="#"></a></li>
                </ul>
            </div>
            <div id="carousel" class="flexslider">
                <div class="flex-viewport" style="overflow: hidden; position: relative; height: 100px;">
                    <ul class="slides"
                        style="width: 1600%; transition-duration: 0s; transform: translate3d(0px, 0px, 0px);">
                        <li style="width: 140px; margin-right: 5px; float: left; display: block;" class="flex-active-slide">
                            <img src="/images/property-images/1193/thumbs/img-u94mExsV-1604445401.jpg" draggable="false">
                        </li>
                        <li style="width: 140px; margin-right: 5px; float: left; display: block;"><img
                                src="/images/property-images/1193/thumbs/img-LP877Tc6-1604445403.jpg" draggable="false">
                        </li>
                        <li style="width: 140px; margin-right: 5px; float: left; display: block;"><img
                                src="/images/property-images/1193/thumbs/img-gEmWD7uS-1604445402.jpg" draggable="false">
                        </li>
                        <li style="width: 140px; margin-right: 5px; float: left; display: block;"><img
                                src="/images/property-images/1193/thumbs/img-I6U36Rn4-1604445402.jpg" draggable="false">
                        </li>
                        <li style="width: 140px; margin-right: 5px; float: left; display: block;"><img
                                src="/images/property-images/1193/thumbs/img-te3w0io9-1604445402.jpg" draggable="false">
                        </li>
                        <li style="width: 140px; margin-right: 5px; float: left; display: block;"><img
                                src="/images/property-images/1193/thumbs/img-WESZBqse-1604445403.jpg" draggable="false">
                        </li>
                        <li style="width: 140px; margin-right: 5px; float: left; display: block;"><img
                                src="/images/property-images/1193/thumbs/img-idUGHTOC-1604445404.jpg" draggable="false">
                        </li>
                        <li style="width: 140px; margin-right: 5px; float: left; display: block;"><img
                                src="/images/property-images/1193/thumbs/img-mG72t1C7-1604445404.jpg" draggable="false">
                        </li>
                    </ul>
                </div>
                <ul class="flex-direction-nav">
                    <li class="flex-nav-prev"><a class="flex-prev flex-disabled" href="#" tabindex="-1"></a></li>
                    <li class="flex-nav-next"><a class="flex-next" href="#"></a></li>
                </ul>
            </div>
        </div>
        <div id="property-rate-info">
            <div class="alert alert-danger text-center"> Not available for dates: <strong>Saturday 12/December/2020 -
                    Saturday 19/December/2020</strong>,<br> please check the <a
                    href="http://palmeravacations.com/_availability_calendar.php?id=1193" title="Availability Calendar"
                    target="_blank">Availability Calendar</a> and edit your search. </div>
        </div>
        <form action="/old-town-zona-romantica/v177-503" method="post" id="property-details-form" accept-charset="UTF-8">
            <div>
                <fieldset class="bg-success collapsible panel panel-default form-wrapper collapse-processed"
                    id="edit-details-form">
                    <legend class="panel-heading">
                        <a href="#edit-details-form-body" class="panel-title fieldset-legend collapsed"
                            data-toggle="collapse"><span class="fieldset-legend-prefix element-invisible">Hide</span>Check
                            Availability</a>
                    </legend>
                    <div class="panel-body panel-collapse collapse fade collapsed" id="edit-details-form-body">
                        <div class="row">
                            <div class="col-xs-3">
                                <div class="form-item form-item-arrival-sing form-type-textfield form-group"> <label
                                        class="control-label" for="edit-arrival-sing">Check-in-date</label>
                                    <input class="text-center form-control form-text hasDatepicker" readonly="readonly"
                                        type="text" id="edit-arrival-sing" name="arrival_sing"
                                        value="Saturday 12/December/2020" size="60" maxlength="128">
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="form-item form-item-departure-sing form-type-textfield form-group"> <label
                                        class="control-label" for="edit-departure-sing">Check-out-date</label>
                                    <input class="text-center form-control form-text hasDatepicker" readonly="readonly"
                                        type="text" id="edit-departure-sing" name="departure_sing"
                                        value="Saturday 19/December/2020" size="60" maxlength="128">
                                </div>
                            </div>
                            <div class="col-xs-2">
                                <div class="form-item form-item-adults-sing form-type-textfield form-group"> <label
                                        class="control-label" for="edit-adults-sing">Adults</label>
                                    <input class="form-control form-text" type="text" id="edit-adults-sing"
                                        name="adults_sing" value="3434" size="60" maxlength="128">
                                </div>
                            </div>
                            <div class="col-xs-2">
                                <div class="form-item form-item-children-sing form-type-textfield form-group"> <label
                                        class="control-label" for="edit-children-sing">Children</label>
                                    <input class="form-control form-text" type="text" id="edit-children-sing"
                                        name="children_sing" value="" size="60" maxlength="128">
                                </div>
                            </div>
                            <div class="col-xs-2 text-right"><button title="Check Availability"
                                    class="btn btn-success btn-loading form-submit"
                                    data-loading-text="<i class=&quot;fa fa-spinner fa-spin&quot;></i>" type="submit"
                                    id="edit-submit" name="op" value="<i class=&quot;fas fa-search&quot;></i>"><i
                                        class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <span class="summary"></span>
                </fieldset>
                <input id="arrival-alt-sing" type="hidden" name="arrival_alt_sing" value="2020-12-12">
                <input id="departure-alt-sing" type="hidden" name="departure_alt_sing" value="2020-12-19">
                <input id="max-pax" type="hidden" name="max_pax" value="2">
                <input type="hidden" name="form_build_id" value="form-PxAclmvDeMRn5FkIDzm-C4uCw5XgJqv345M5ggIJqXo">
                <input type="hidden" name="form_id" value="property_details_form">
            </div>
        </form>
        <div id="property-details-info">
            <h2 class="section-title">Property Details</h2>
            <div class="row">
                <div class="col-xs-6">
                    <h4 class="sub-section">Property Type</h4>
                    <p>Condo</p>
                </div>
                <div class="col-xs-6">
                    <h4 class="sub-section">Location</h4>
                    <p>Puerto Vallarta / Old Town/Zona Romántica / V177</p>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <h4 class="sub-section">Bedrooms / Bathrooms</h4>
                    <p>1 / 1</p>
                </div>
                <div class="col-xs-6">
                    <h4 class="sub-section">Maid Service</h4>
                    <p>Once a week</p>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <h4 class="sub-section">Occupancy</h4>
                    <p><span class="max-pax">2</span> guests max. (including children under 12 and babies)</p>
                </div>
                <div class="col-xs-6">
                    <h4 class="sub-section">Bedding</h4>
                    <p>King bed: 1<br></p>
                </div>
            </div>
        </div>
        <div id="property-description-info">
            <h2 class="section-title">Highlights</h2>Palmera Vacations is glad to present V177 - 503 studio, located in the
            heart of Puerto Vallarta, just one short block from the most popular beach in town. This Beautifully Furnished
            Condominium offers all the amenities you would expect in a Luxury Hotel while at the same time you can live like
            a local. Enjoy the privacy and comfort that this condominium provides while being smack dab in the middle of
            Puerto Vallarta’s most desired location.<br>
            <br>
            Ambiance and amenities are in abundance in this romantic vacation getaway.<br>
            <br>
            Enjoy your morning coffee or an evening cocktail on the roof top common area that sports a beautiful heated
            infinity pool, jacuzzi, dinning and socializing areas all complete with a 360 View of the Ocean, City and
            Mountains. If that sounds a little too laid back for your active life, get a real workout in the Well-Equipped
            Rooftop Gym.<br>
            <br>
            When you’re ready to hit the streets, you’ll find that this condominium is conveniently located just a short and
            easy walk to dozens of fine Restaurants, Sidewalk Coffee Shops, Night Life, Shopping and only one block from the
            famous ‘Playa Los Muertos’ Beach. Zona Romantica offers limitless opportunities to explore, dine, relax and join
            in the fun.<br>
            <br>
            Dec 01, 2020 to April 30, 2021 Monthly Rate: $3,500 USD **Minimum 3 Months** Plus Electricity <br>
            May 01, 2021 to Nov 30, 2021 Monthly Rate: $2,600 USD **Minimum 3 Months** Plus Electricity <br>
        </div>
        <div id="property-features-info">
            <h2 class="section-title">Features and Amenities</h2>
            <div class="row">
                <div class="col-xs-3">
                    <ul class="list">
                        <li>24 hour building security</li>
                        <li>Air Conditioning</li>
                        <li>Alarm Clock</li>
                        <li>Balcony</li>
                        <li>Beach Towels</li>
                        <li>Blender</li>
                        <li>Cable</li>
                        <li>Ceiling Fans</li>
                    </ul>
                </div>
                <div class="col-xs-3">
                    <ul class="list">
                        <li>City View</li>
                        <li>Coffee Maker</li>
                        <li>Dryer</li>
                        <li>Elevator</li>
                        <li>Exercise Room</li>
                        <li>Furnished</li>
                        <li>Hair Dryer</li>
                        <li>Heated Pool</li>
                    </ul>
                </div>
                <div class="col-xs-3">
                    <ul class="list">
                        <li>Kids Allowed</li>
                        <li>Linens</li>
                        <li>Microwave</li>
                        <li>Mountain View</li>
                        <li>No Smoking</li>
                        <li>Pets Not Allowed</li>
                        <li>Pool</li>
                        <li>Purified Water System</li>
                    </ul>
                </div>
                <div class="col-xs-3">
                    <ul class="list">
                        <li>Refrigerator</li>
                        <li>Satellite TV</li>
                        <li>Toaster</li>
                        <li>Towels</li>
                        <li>TV</li>
                        <li>Wifi in Common Areas</li>
                        <li>Wireless Internet</li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="property-rates-info">
            <h2 class="section-title">Rates</h2>
            <table class="table table-striped table-hover property-rates">
                <thead>
                    <tr>
                        <th class="col-xs-4">Period</th>
                        <th class="col-xs-2">Nightly</th>
                        <th class="col-xs-2">Weekly</th>
                        <th class="col-xs-2">Monthly</th>
                        <th class="col-xs-2">Min. Stay</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1/Nov/2020 to 19/Dec/2020</td>
                        <td class="text-center">$150.00</td>
                        <td class="text-center">$910.00</td>
                        <td class="text-center">--</td>
                        <td>3 nights</td>
                    </tr>
                    <tr>
                        <td>20/Dec/2020 to 3/Jan/2021</td>
                        <td class="text-center">$250.00</td>
                        <td class="text-center">$1,470.00</td>
                        <td class="text-center">--</td>
                        <td>7 nights</td>
                    </tr>
                    <tr>
                        <td>4/Jan/2021 to 31/Jan/2021</td>
                        <td class="text-center">$180.00</td>
                        <td class="text-center">$1,050.00</td>
                        <td class="text-center">--</td>
                        <td>3 nights</td>
                    </tr>
                    <tr>
                        <td>1/Feb/2021 to 28/Feb/2021</td>
                        <td class="text-center">$180.00</td>
                        <td class="text-center">$1,190.00</td>
                        <td class="text-center">--</td>
                        <td>3 nights</td>
                    </tr>
                    <tr>
                        <td>1/Mar/2021 to 27/Mar/2021</td>
                        <td class="text-center">$150.00</td>
                        <td class="text-center">$910.00</td>
                        <td class="text-center">--</td>
                        <td>3 nights</td>
                    </tr>
                    <tr class="toggle-table-rates">
                        <td>28/Mar/2021 to 3/Apr/2021</td>
                        <td class="text-center">$250.00</td>
                        <td class="text-center">$1,540.00</td>
                        <td class="text-center">--</td>
                        <td>3 nights</td>
                    </tr>
                    <tr class="toggle-table-rates">
                        <td>4/Apr/2021 to 30/Apr/2021</td>
                        <td class="text-center">$120.00</td>
                        <td class="text-center">$700.00</td>
                        <td class="text-center">--</td>
                        <td>3 nights</td>
                    </tr>
                    <tr class="toggle-table-rates">
                        <td>1/May/2021 to 10/Jul/2021</td>
                        <td class="text-center">$100.00</td>
                        <td class="text-center">$665.00</td>
                        <td class="text-center">--</td>
                        <td>3 nights</td>
                    </tr>
                    <tr class="toggle-table-rates">
                        <td>11/Jul/2021 to 10/Aug/2021</td>
                        <td class="text-center">$120.00</td>
                        <td class="text-center">$805.00</td>
                        <td class="text-center">--</td>
                        <td>3 nights</td>
                    </tr>
                    <tr class="toggle-table-rates">
                        <td>11/Aug/2021 to 28/Sep/2021</td>
                        <td class="text-center">$100.00</td>
                        <td class="text-center">$630.00</td>
                        <td class="text-center">--</td>
                        <td>3 nights</td>
                    </tr>
                    <tr class="toggle-table-rates">
                        <td>29/Oct/2021 to 31/Oct/2021</td>
                        <td class="text-center">$150.00</td>
                        <td class="text-center">$980.00</td>
                        <td class="text-center">--</td>
                        <td>3 nights</td>
                    </tr>
                    <tr class="toggle-table-rates">
                        <td>1/Nov/2021 to 19/Dec/2021</td>
                        <td class="text-center">$150.00</td>
                        <td class="text-center">$910.00</td>
                        <td class="text-center">--</td>
                        <td>3 nights</td>
                    </tr>
                    <tr class="toggle-table-rates">
                        <td>20/Dec/2021 to 3/Jan/2022</td>
                        <td class="text-center">$250.00</td>
                        <td class="text-center">$1,470.00</td>
                        <td class="text-center">--</td>
                        <td>7 nights</td>
                    </tr>
                </tbody>
            </table>
            <div class="row rates-footer">
                <div class="col-xs-9"><small><i>* All rates in USD tax included.</i></small></div>
                <div class="col-xs-3 text-right"><small><a href="# " id="toggle-rates" title="more rates"
                            class="show-rates">more rates</a></small></div>
            </div>
        </div>
        <div id="property-calendar-info">
            <h2 class="section-title">Availability Calendar</h2>
            <div class="row">
                <div class="col-xs-4">
                    <div class="cal-month">
                        <table width="100%">
                            <thead>
                                <tr>
                                    <th colspan="7">December 2020</th>
                                </tr>
                                <tr>
                                    <th width="15%">Sun</th>
                                    <th width="14%">Mon</th>
                                    <th width="14%">Tue</th>
                                    <th width="14%">Wed</th>
                                    <th width="14%">Thu</th>
                                    <th width="14%">Fri</th>
                                    <th width="15%">Sat</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="2">&nbsp;</td>
                                    <td class="cal-occupied">1</td>
                                    <td class="cal-occupied">2</td>
                                    <td class="cal-occupied">3</td>
                                    <td class="cal-occupied">4</td>
                                    <td class="cal-occupied">5</td>
                                </tr>
                                <tr>
                                    <td class="cal-occupied">6</td>
                                    <td class="cal-occupied">7</td>
                                    <td class="cal-occupied">8</td>
                                    <td class="cal-occupied">9</td>
                                    <td class="cal-occupied">10</td>
                                    <td class="cal-occupied">11</td>
                                    <td class="cal-occupied">12</td>
                                </tr>
                                <tr>
                                    <td class="cal-occupied">13</td>
                                    <td class="cal-occupied">14</td>
                                    <td class="cal-occupied">15</td>
                                    <td class="cal-occupied">16</td>
                                    <td class="cal-occupied">17</td>
                                    <td class="cal-occupied">18</td>
                                    <td class="cal-occupied">19</td>
                                </tr>
                                <tr>
                                    <td class="cal-occupied">20</td>
                                    <td class="cal-occupied">21</td>
                                    <td class="cal-occupied">22</td>
                                    <td class="cal-occupied">23</td>
                                    <td class="cal-occupied">24</td>
                                    <td class="cal-occupied">25</td>
                                    <td class="cal-occupied">26</td>
                                </tr>
                                <tr>
                                    <td class="cal-occupied">27</td>
                                    <td class="cal-occupied">28</td>
                                    <td class="cal-occupied">29</td>
                                    <td class="cal-occupied">30</td>
                                    <td class="cal-occupied">31</td>
                                    <td colspan="2">&nbsp;</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="cal-month">
                        <table width="100%">
                            <thead>
                                <tr>
                                    <th colspan="7">January 2021</th>
                                </tr>
                                <tr>
                                    <th width="15%">Sun</th>
                                    <th width="14%">Mon</th>
                                    <th width="14%">Tue</th>
                                    <th width="14%">Wed</th>
                                    <th width="14%">Thu</th>
                                    <th width="14%">Fri</th>
                                    <th width="15%">Sat</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="5">&nbsp;</td>
                                    <td class="cal-occupied">1</td>
                                    <td class="cal-occupied">2</td>
                                </tr>
                                <tr>
                                    <td class="cal-occupied">3</td>
                                    <td class="cal-departure-only">4</td>
                                    <td class="cal-vacant">5</td>
                                    <td class="cal-vacant">6</td>
                                    <td class="cal-vacant">7</td>
                                    <td class="cal-vacant">8</td>
                                    <td class="cal-vacant">9</td>
                                </tr>
                                <tr>
                                    <td class="cal-vacant">10</td>
                                    <td class="cal-vacant">11</td>
                                    <td class="cal-vacant">12</td>
                                    <td class="cal-vacant">13</td>
                                    <td class="cal-vacant">14</td>
                                    <td class="cal-vacant">15</td>
                                    <td class="cal-vacant">16</td>
                                </tr>
                                <tr>
                                    <td class="cal-vacant">17</td>
                                    <td class="cal-vacant">18</td>
                                    <td class="cal-vacant">19</td>
                                    <td class="cal-vacant">20</td>
                                    <td class="cal-vacant">21</td>
                                    <td class="cal-vacant">22</td>
                                    <td class="cal-vacant">23</td>
                                </tr>
                                <tr>
                                    <td class="cal-vacant">24</td>
                                    <td class="cal-vacant">25</td>
                                    <td class="cal-vacant">26</td>
                                    <td class="cal-vacant">27</td>
                                    <td class="cal-vacant">28</td>
                                    <td class="cal-vacant">29</td>
                                    <td class="cal-vacant">30</td>
                                </tr>
                                <tr>
                                    <td class="cal-vacant">31</td>
                                    <td colspan="6">&nbsp;</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="cal-month">
                        <table width="100%">
                            <thead>
                                <tr>
                                    <th colspan="7">February 2021</th>
                                </tr>
                                <tr>
                                    <th width="15%">Sun</th>
                                    <th width="14%">Mon</th>
                                    <th width="14%">Tue</th>
                                    <th width="14%">Wed</th>
                                    <th width="14%">Thu</th>
                                    <th width="14%">Fri</th>
                                    <th width="15%">Sat</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="1">&nbsp;</td>
                                    <td class="cal-vacant">1</td>
                                    <td class="cal-vacant">2</td>
                                    <td class="cal-vacant">3</td>
                                    <td class="cal-vacant">4</td>
                                    <td class="cal-vacant">5</td>
                                    <td class="cal-vacant">6</td>
                                </tr>
                                <tr>
                                    <td class="cal-vacant">7</td>
                                    <td class="cal-vacant">8</td>
                                    <td class="cal-vacant">9</td>
                                    <td class="cal-vacant">10</td>
                                    <td class="cal-vacant">11</td>
                                    <td class="cal-vacant">12</td>
                                    <td class="cal-vacant">13</td>
                                </tr>
                                <tr>
                                    <td class="cal-vacant">14</td>
                                    <td class="cal-vacant">15</td>
                                    <td class="cal-vacant">16</td>
                                    <td class="cal-vacant">17</td>
                                    <td class="cal-vacant">18</td>
                                    <td class="cal-vacant">19</td>
                                    <td class="cal-vacant">20</td>
                                </tr>
                                <tr>
                                    <td class="cal-vacant">21</td>
                                    <td class="cal-vacant">22</td>
                                    <td class="cal-vacant">23</td>
                                    <td class="cal-vacant">24</td>
                                    <td class="cal-vacant">25</td>
                                    <td class="cal-vacant">26</td>
                                    <td class="cal-vacant">27</td>
                                </tr>
                                <tr>
                                    <td class="cal-vacant">28</td>
                                    <td colspan="6">&nbsp;</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="text-right cal-more-dates"><a
                    href="http://www.palmeravacations.com/_availability_calendar.php?id=1193" title="More Dates"
                    target="_blank" class="btn btn-warning">More Dates</a></div>
        </div>
        <div id="property-map-info">
            <h2 class="section-title">Location Map</h2><iframe
                src="https://www.google.com/maps/d/u/1/embed?mid=1R4iiei3X-lalmkRHWsf4VFKe6yrqS8DS"
                width="&amp;z=15&quot;100%&quot;" height="370"></iframe>
        </div>
    </div>

    @include('public.pages.partials.main-content-end')

    @include('public.pages.partials.footer')

@endsection
