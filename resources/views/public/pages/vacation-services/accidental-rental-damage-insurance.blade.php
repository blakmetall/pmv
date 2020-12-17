@extends('layouts.public-master')

@section('main-content')

    @include('public.pages.partials.content-top')

    @php
    $title = __('ACCIDENTAL RENTAL DAMAGE INSURANCE (ARDI)');
    @endphp

    @include('public.pages.partials.main-content-start')

    <div class="panel-display panel-1col clearfix">
        <div class="panel-panel panel-col">
            <div>
                <div class="panel-pane pane-custom pane-1">
                    <div class="pane-content">
                        <p>We are proud to make Accidental Rental Damage Insurance available to our clients for as low as
                            $45.00 USD per property, we want you to relax and enjoy your vacation so we now offer coverage
                            for accidental damages to your vacation rental property during your stay, in place of a security
                            deposit.</p>
                    </div>
                </div>
                <div class="panel-separator"></div>
                <div class="panel-pane pane-custom pane-2">
                    <div class="pane-content">
                        <div id="prop" class="row text-center">
                            <div class="col-xs-6">
                                <div class="prop pp3">
                                    <div class="fa">45</div>
                                    <div class="title">$45 USD</div>
                                    <p>Per property and covers up to $1,500.00 USD in accidental damages.</p>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="prop pp4">
                                    <div class="fa">69</div>
                                    <div class="title">$69 USD</div>
                                    <p>Per property and covers up to $3,000.00 USD in accidental damages.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-separator"></div>
                <div class="panel-pane pane-custom pane-3">
                    <div class="pane-content">
                        <h4>Why purchase the ARDI plan?</h4>
                        <ul class="list">
                            <li>With ARDI, you no longer have to worry about putting up a security deposit or how much will
                                be returned when you get home.</li>
                            <li>Return home with vacation memories, not repair costs. When you include ARDI with your
                                reservations, the cost and repair of covered accidental damage will be handled between the
                                rental property and the insurance company.</li>
                            <li>Stay balanced. The ARDI plan can save you from typing up your credit card with a hefty
                                authorization while you are on vacation.</li>
                        </ul>
                        <h4>What does the ARDI plan cover?</h4>
                        <ul class="list">
                            <li>ARDI covers unintentional damage to your vacation rental property during your stay. Renters
                                commonly use ARDI to cover things like carpet spills, furniture tears, broken lamps and
                                more.</li>
                            <li>Staying in a pet-friendly home? ARDI provides coverage for damages caused by pets!</li>
                            <h4>What is not covered by the ARDI plan?</h4>
                            <ul class="list">
                                <li>Intentional property damage.</li>
                                <li>Pet damage in non-pet friendly vacation homes.</li>
                                <li>Please see the Description of Coverage for full terms and conditions.</li>
                            </ul>
                            <h4>When do I purchase the ARDI plan?</h4>
                            <p>At time of booking, when you make your payment to guarantee your reservation you can include
                                the ARDI costs in your payment instead of the $500.00 USD damage deposit required.</p>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('public.pages.partials.main-content-end')

    @include('public.pages.partials.footer')

@endsection
