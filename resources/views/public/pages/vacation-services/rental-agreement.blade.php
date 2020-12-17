@extends('layouts.public-master')

@section('main-content')

    @include('public.pages.partials.content-top')

    @php
    $title = __('RENTAL AGREEMENT');
    @endphp

    @include('public.pages.partials.main-content-start')

    <div class="panel-display panel-1col clearfix">
        <div class="panel-panel panel-col">
            <div>
                <div class="panel-pane pane-custom pane-1">
                    <div class="pane-content">
                        <h4>Deposit and Final Payment</h4>
                        <p>Initial Deposit: The initial deposit is due within 5 business days from the date of the booking
                            accordingly to the following conditions.</p>
                        <ul class="list">
                            <li>50% deposit is due at time of booking if your reservation arrival date is more than 30 days
                                from the booking date.</li>
                            <li>100% payment is due at time of booking if your reservation arrival date is within 30 days
                                from the booking date.</li>
                        </ul>
                        <p><strong>Final Payment</strong></p>
                        <ul class="list">
                            <li>Final payment is due 30 days before the arrival if your reservation arrival date is between
                                January 4th. and November 19th.</li>
                            <li>Final payment is due 60 days before the arrival if your reservation arrival date is between
                                November 20th. and January 3rd.</li>
                        </ul>
                        <p>Some properties have their own reservation and/or cancellation policies and this information is
                            included in the "Property Policy" section of the reservation document. Whenever this is the case
                            the policies stated in the "Property Policy" will take precedent over the above policy.</p>
                        <p>We strongly suggest for you to purchase Accidental Rental Damage Insurance, if you decide not to
                            use Accidental Rental Damage Insurance, you will then be required to make a $500 usd damage
                            deposit with your final payment. Said deposit will be kept for a week after your checkout for
                            any damage, missing items or unusual cleaning required and if there is a complete absence of
                            debt verified you will then receive your deposit back within a two week period unless there are
                            phone bill charges or property inventory to be purchased, then it could be held up to 30 days
                            after your departure.</p>
                        <h4>Payment Methods Accepted</h4>
                        <ul class="list">
                            <li>We accept VISA, MasterCard and American Express online through PayPal or by phone calling
                                our office toll free number: </li>
                            <ul class="list">
                                <li>Puerto Vallarta: 1-800-881-8176</li>
                                <li>Mazatlán: 1-888-688-1577</li>
                            </ul>
                            <li>Window bank deposits.</li>
                            <li>Wire transfers.</li>
                        </ul>
                        <h4>Cancellation Policy</h4>
                        <p>Reservations cancelled more than 60 days before the arrival date will receive an 80% refund of
                            the initial deposit. All cancellations less than 60 days before the arrival date will not
                            receive a refund. In addition, there will be no refunds due to weather, construction, loud
                            neighbors or natural disasters.</p>
                        <h4>Property Policy</h4>
                        <p>Each property owner and/or representative may have different policies and internal obligated
                            rules established for their properties which guests are to be aware of and must abide by.
                            Palmera Vacations under no circumstance be held responsible for any guest who does not respect
                            said policies, failure to abide will result in the cancellation of the reservation and/or
                            eviction from the vacation property without any right of refund.</p>
                        <p>All guests may request Palmera Vacations further information of the individual property's
                            policies, if applicable.</p>
                        <h4>Check-in / Check-out</h4>
                        <p>The normal check-in time is 3:00 p.m. and check-out time is 12:00 p.m. We will meet you at the
                            property and give you one set of keys and inspect the property with you to assure that all is
                            well. If you will need more than one set of keys or if you need a special check-in or check-out
                            time please let us know and we will do our best to accommodate you.</p>
                        <p><strong>Very Important!</strong></p>
                        <p>In the event that your check in to the property is after 8:00 p.m. or check out from the property
                            is before 8:00 a.m. you will be subject to a $20.00 usd (twenty) fee which must be paid to our
                            Concierge upon arrival or departure.</p>
                        <p>In the event that your check in to the property is after 11:00 p.m. or check out from the
                            property is before 6:00 a.m. you will be subject to a $40.00 usd (forty) fee which must be paid
                            to our Concierge upon arrival or departure.</p>
                        <p>Be advised that private properties do not have 24 hrs staff therefore we are unable to provide
                            check in or out services between 1:00 a.m. and 5:00 a.m. Please make your arrangements according
                            to this policy.</p>
                        <p>Palmera Vacation's team must attend other check in's and out's therefore it's extremely important
                            for you to be punctual for the scheduled check in or out times otherwise if delayed more than 30
                            minutes of the stipulated time you will be subject to a $20.00 usd (twenty) fee which must be
                            paid to our Concierge upon arrival or departure.</p>
                        <p>Said charges will be exempt only if there is a written authorization agreement by a Palmera
                            Vacations Supervisor.</p>
                        <h4>Hold Harmless</h4>
                        <p>Palmera Vacations and the property owners will be held harmless for any problems, injuries, loss
                            or damage to the property or to any persons occupying the rental property. Problems relating to
                            construction and construction noises are not controllable by Palmera Vacations or the property
                            owners and we will in no way be held responsible.</p>
                        <h4>Number of Guests</h4>
                        <p>The number of guests shown on your booking confirmation is the maximum allowed to occupy the
                            rental property. If you exceed the max capacity of the unit you will be charged an additional
                            $50 USD per night per additional person and will be allowed to occupy the property only if the
                            property owner and/or representative approves and if the property can properly accommodate you.
                            If guest fails to notify Palmera Vacations or anyone and brings more people into the property,
                            the guest will have to leave the property immediately without any refund including the security
                            deposit if applicable.</p>
                        <h4>Children Policy</h4>
                        <p>Absolutely NO children allowed on any property unless agreed upon in writing by the owner, the
                            property representative or otherwise noted on the property details page.</p>
                        <h4>Pet Policy</h4>
                        <p>Absolutely NO pets allowed on any property unless agreed upon in writing by the owner, the
                            property representative or otherwise noted on the property details page.</p>
                        <h4>Lost and Found</h4>
                        <p>Palmera Vacations is not responsible for forgotten, lost, damaged or stolen personal items.
                            Should any guest forget or loose personal belongings at a property, if recovered, the item will
                            be kept in a designated lost and found area for a period of thirty (30) days after checkout
                            date. We will ship items back at the owner's expense. At the end of thirty (30) days any item
                            not claimed will be donated to a local charity or discarded.</p>
                        <h4>General Rules</h4>
                        <p>For security reasons and to ensure better coexistence with other owners and guests, we inform you
                            the regulations that you and your companions must meet while staying within the facility ,
                            agreeing to comply fully , failure to do so, the staff of these condos and / or Palmera
                            Vacations may ask the abandonment of facilities without any refund even if your stay is
                            continuing.</p>
                        <ul class="list">
                            <li>Help us save energy with the moderate use of air conditioning.</li>
                            <li>Smoking is not permitted inside or outside this unit, a smoking fee of $150.00usd will be
                                charged for violation of this policy.</li>
                            <li>Do not use / sale of any kind of drug.</li>
                            <li>No loud music or loud noise at any time of day within the property or common areas is
                                allowed.</li>
                            <li>The renters are not allowed to receive visitors or guests. (Unless prior writing agreement
                                with Palmera Vacations and owner).</li>
                            <li>It is not permitted to reserve loungers and pool furniture and objects using crystal pools.
                            </li>
                            <li>Any form of exhibitionism including nudity and erotic acts are prohibited in view of other
                                guests and common areas.</li>
                            <li>In case of any situation with other owners, guests or property staff please immediately
                                contact Palmera Vacations as your representative to follow up.</li>
                        </ul>
                        <p><small>* All credit card disputes must be made in writing at least 30 days prior to arrival
                                date.</small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('public.pages.partials.main-content-end')

    @include('public.pages.partials.footer')

@endsection
