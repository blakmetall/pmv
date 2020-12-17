@extends('layouts.public-master')

@section('main-content')

    @include('public.pages.partials.content-top')

    @php
    $title = __('PAYMENT METHODS');
    @endphp

    @include('public.pages.partials.main-content-start')

    <div class="panel-display panel-1col clearfix">
        <div class="panel-panel panel-col">
            <div>
                <div class="panel-pane pane-custom pane-1">
                    <div class="pane-content">
                        <div id="prop" class="row text-center">
                            <div class="col-xs-4">
                                <div class="prop">
                                    <div class="prop-container">
                                        <div class="fa"><i class="fas fa-credit-card"></i></div>
                                        <div class="title">Credit Card</div>
                                        <p>We accept VISA,<br>
                                            MasterCard and American Express</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="prop pp1">
                                    <div class="prop-container">
                                        <div class="fa"><i class="fab fa-paypal"></i></div>
                                        <div class="title">Paypal</div>
                                        <p>We accept online payments<br>
                                            through PayPal</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="prop pp2">
                                    <div class="prop-container">
                                        <div class="fa"><i class="fas fa-university"></i></div>
                                        <div class="title">Bank Payments</div>
                                        <p>Window bank deposits<br>
                                            and wire transfers</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-separator"></div>
                <div class="panel-pane pane-custom pane-2">
                    <div class="pane-content">
                        <p>Once your reservation request has been approved, please use any of these methods to make your
                            payment, we accept VISA, MasterCard and American Express online thru PayPal or by phone calling
                            our office toll free number:</p>
                        <ul class="list">
                            <li>Puerto Vallarta: 1-800-881-8176</li>
                            <li>Mazatlán: 1-888-688-1577</li>
                        </ul>
                        <p>Window bank deposits and wire transfers, please email or call our office for the bank
                            information.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('public.pages.partials.main-content-end')

    @include('public.pages.partials.footer')

@endsection
