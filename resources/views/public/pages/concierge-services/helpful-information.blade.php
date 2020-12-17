@extends('layouts.public-master')

@section('main-content')

    @include('public.pages.partials.content-top')

    @php
    $title = __('HELPFUL INFORMATION');
    @endphp

    @include('public.pages.partials.main-content-start')

    <div class="panel-2col-stacked clearfix panel-display">
        <div class="panel-col-top panel-panel">
            <div class="inside">
                <div class="panel-pane pane-custom pane-3">
                    <div class="pane-content">
                        <p>In preparation for your Vacation Getaway, we have a few reminders, suggestions and other
                            information you might find helpful.</p>
                        <h4>Customs</h4>
                        <p>Upon arrival at your destination airport you will be asked to push a button that will determine
                            if you are searched or not. At random the system either gives you a green light meaning you can
                            go on or a red light meaning you must stay and be searched. Please check at the Mexican
                            consulate in your city for proper documentation and requirements.</p>
                        <h4>Ground Transportation</h4>
                        <p>Buses<br>
                            Getting around the city on a bus is an inexpensive way to travel. (This is recommended for those
                            who are familiar with the destination). Fares from one point to another in town are $5 pesos,
                            roughly equivalent to .50 cents in USD. Urban buses travel through town from early morning until
                            11:30 pm. Suburban buses reaching southern points (Mismaloya, Boca de Tomatlán, El Tuito) and
                            northern points (Punta Mita, Bucerias, La Cruz, Sayulita) are also available, departing from the
                            South Side and from Wal-Mart, across from the Maritime Terminal. Buses traveling to other
                            cities, such as Guadalajara or Mexico City, depart from the bus terminal throughout the day.</p>
                        <p>Cabs<br>
                            There are over a 1,000 cabs licensed. Needless to say, they are easy to come by. They are all
                            painted yellow and are safe and reliable. Cabs have no meters; fares are based on a zone system.
                            Always ask about the fare before you get in to avoid any problems. Taxi fares are very
                            reasonable and there is no surcharge at night or for extra passengers. Tipping is generally not
                            necessary, but always appreciated. If the driver helps you with luggage or packages, you should
                            always tip him. You may find it helpful to write down the name and address of your destination
                            and where you are staying.</p>
                        <p>Some restaurants offer cab drivers a commission for delivering tourists to their location.
                            Drivers have been known to divert passengers to another restaurant that pays them commission. If
                            you feel this is the case, simply insist on being taken to your original destination.</p>
                        <h4>Alcohol Consumption</h4>
                        <p>You must be at least 18 years old to purchase beer and liquor at supermarkets, liquor and
                            specialty stores. It is against the law to drink and to be drunk in public in México.</p>
                        <h4>Hospitals and Health Care Coverage</h4>
                        <p>There are excellent medical care facilities in our destinations. Contact your insurance carrier
                            before your visit Mexico and confirm that your policy applies overseas and covers emergency
                            services.</p>
                        <h4>Normal Business hours</h4>
                        <p>Monday to Friday: 10:00 AM - 8:00 PM, usually with a two-hour break from 2:00 PM - 4:00 PM.
                            Shopping malls are normally open from 9:00 AM to 8:00 PM.</p>
                        <p>México has a more relaxed view of working schedules. Shops can have working schedules that vary
                            quite a bit from the norm, opening earlier, closing later. Supermarkets and Banks are the
                            exception with set business hours of operation.</p>
                        <h4>Sales Tax - Departure tax</h4>
                        <p>There is a 16% tax applied to all purchases, (restaurants, stores, hotels, tours, etc.)<br>
                            There is an additional 2% tax on your hotel stay used for the promotion of tourism.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="center-wrapper">
            <div class="panel-col-first panel-panel">
                <div class="inside">
                    <div class="panel-pane pane-custom pane-1">
                        <h4 class="pane-title">
                            Weights and measures </h4>
                        <div class="pane-content">
                            <ul class="list">
                                <li>1 centimeter = 0.3937 inches</li>
                                <li>(Degrees C° + 17.8) x 1.8 = Degrees F°</li>
                                <li>(Degrees F° -32) x 0.5555 = Degrees C°</li>
                                <li>1 foot = 0.3048 meter</li>
                                <li>1 gallon = 3.7854 liters</li>
                                <li>1 gram = 0.0353 ounce</li>
                                <li>1 inch = 2.54 centimeters</li>
                                <li>1 kilogram = 2.2046 pounds</li>
                                <li>1 kilometer = 0.6214 miles</li>
                                <li>1 liter = 0.2612 gallons</li>
                                <li>1 meter = 3.2808 feet</li>
                                <li>1 mile = 1.6093 kilometers</li>
                                <li>1 ounce = 28.35 grams</li>
                                <li>1 pound = 0.4536 kilograms
                                </li>
                                <li>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-col-last panel-panel">
                <div class="inside">
                    <div class="panel-pane pane-custom pane-2">
                        <h4 class="pane-title">
                            Helpful Spanish Phrases </h4>
                        <div class="pane-content">
                            <ul class="list">
                                <li>Gracias ------ Thank you</li>
                                <li>De nada ----- You're welcome</li>
                                <li>Por Favor ---- Please</li>
                                <li>¿Cuánto cuesta? --------- How much is it?</li>
                                <li>La cuenta por favor -------- Check please... (restaurant)</li>
                                <li>¿Dónde estoy? -------- Where am I?</li>
                                <li>¿Dónde esta la playa? ------ Where is the beach?</li>
                                <li>Con permiso --------- Excuse me (when getting by someone)</li>
                                <li>¿Qué hora es? -------- What time is it?</li>
                                <li>¿Hablas Inglés? No hablo Español -------- Do you speak English? I don't speak Spanish
                                </li>
                                <li>Necesito ayuda por favor -------- I need help please</li>
                                <li>Necesito cambio por favor -------- I need change please</li>
                                <li>¿Dónde está el baño? -------- Where is the restroom?</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    @include('public.pages.partials.main-content-end')

    @include('public.pages.partials.footer')

@endsection
