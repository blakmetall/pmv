@php
$offices = getOffices();
@endphp
<div class="footer-container">
    <footer class="footer container">
        <div class="region region-footer">
            <section id="block-panels-mini-footer" class="block block-panels-mini clearfix">
                <div class="panel-display panel-3col-33-stacked  clearfix" id="mini-panel-footer">
                    <div class="center-wrapper">
                        <div class="panel-panel panel-col-first">
                            <div class="inside">
                                <div class="panel-pane pane-block pane-mailchimp-mailchimp-block">
                                    <h2 class="pane-title">
                                        {{ __('Sign Up For Updates') }} </h2>
                                    <div class="pane-content">
                                        <form id="mc-embedded-subscribe-form" class="validate" target="_blank"
                                            action="http://palmeravacations.us2.list-manage.com/subscribe/post?u=3b1884317120ae49fbec5270e&amp;amp;id=706130937c"
                                            method="post" accept-charset="UTF-8">
                                            <div>
                                                <div class="form-item form-item-email form-type-textfield form-group">
                                                    <input id="mce-EMAIL" placeholder="E-mail"
                                                        class="form-control form-text required" type="text" name="EMAIL"
                                                        value="" size="60" maxlength="128" />
                                                </div><button id="mc-embedded-subscribe"
                                                    class="btn btn-warning form-submit" type="submit" name="op"
                                                    value="{{ __('Subscribe') }}">{{ __('Subscribe') }}</button>
                                                <input type="hidden" name="form_build_id"
                                                    value="form-_t0wDP3KPWKwt709AUPC1z7T0VAvo5IVBOoGHB_csgI" />
                                                <input type="hidden" name="form_id" value="mailchimp_form" />
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="panel-separator"></div>
                                <div class="panel-pane pane-custom pane-6 follow-links-container">

                                    <h2 class="pane-title">
                                        {{ __('Keep in Touch') }} </h2>
                                    <div class="pane-content">
                                        <div class="follow-links">
                                            <a href="https://facebook.com/PalmeraVacations"
                                                title="{{ __('Follow us on Facebook') }}" class="follow-link"
                                                target="_blank"><i class="fab fa-facebook-f"></i></a> <a
                                                href="https://twitter.com/PalmeraV"
                                                title="{{ __('Follow us on Twitter') }}" class="follow-link"
                                                target="_blank"><i class="fab fa-twitter"></i></a>
                                            <a href="https://www.instagram.com/palmeravacations/"
                                                title="{{ __('Follow us on Instagram') }}" class="follow-link"
                                                target="_blank"><i class="fab fa-instagram"></i></a>
                                        </div>
                                    </div>


                                </div>
                                <div class="panel-separator"></div>
                                <div class="panel-pane pane-custom pane-7">
                                    <div class="pane-content">
                                        <div class="row seals">
                                            <div class="col-xs-6">
                                                <div title="{{ __('Secured by PayPal') }}" class="paypal-dialog">
                                                    <img src="https://www.paypalobjects.com/webstatic/mktg/logo/bdg_secured_by_pp_2line.png"
                                                        alt="{{ __('Secured by PayPal') }}" class="paypal-logo-img" />
                                                </div>
                                            </div>
                                            <div class="col-xs-6">

                                                {{-- seal <script type="text/javascript"
                                                    src="https://sealserver.trustwave.com/seal.js?code=e2e61c21b4e648f4877e8815667a47f7">
                                                </script> --}}
                                            </div>
                                        </div>

                                        <div class="modal fade" id="paypalDialog" tabindex="-1" role="dialog"
                                            aria-labelledby="paypalDialog" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-hidden="true">&times;</button>
                                                        <h4 class="modal-title">{{ __('What is') }} <em>PayPal</em>?
                                                        </h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <ul class="list">
                                                            <li>{{ __('It is a payment method of easy, quick, and sure.') }}
                                                            </li>
                                                            <li>{{ __('Can make payment with credit and debit card.') }}
                                                            </li>
                                                            <li>{{ __('Register with PayPal your financial data only once. No need to repeat this step in subsequent purchases.') }}
                                                            </li>
                                                            <li>{{ __('More than 100 million people in the world use Paypal.') }}
                                                            </li>
                                                            <li>{{ __('PayPal protects your information. Do not share your financial data.') }}
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel-panel panel-col">
                            <div class="inside">
                                <div class="panel-pane pane-custom pane-8 offices-container">

                                    <h2 class="pane-title">
                                        {{ __('Find Us') }}</h2>

                                    <div class="pane-content">
                                        <div class="offices">
                                            @foreach ($offices as $office)
                                                <div class="office-item">
                                                    {{ $office->name }}<br />
                                                    {!! $office->address !!}<br />
                                                    <span>{{ __('Telephone') }}:</span> {{ $office->phone }}<br />
                                                    <span>{{ __('E-mail') }}:</span> <a
                                                        href="mailto:{{ $office->email }}">{{ $office->email }}</a><br /><br />
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel-panel panel-col-last">
                            <div class="inside">
                                <div class="panel-pane pane-custom pane-9">
                                    <div class="pane-content">
                                        <a href="https://twitter.com/PalmeraV" class="twitter-timeline"
                                            data-widget-id="530209480605052929" data-theme="dark" width="370"
                                            height="450" data-chrome="noborders transparent"
                                            data-aria-polite="polite">{{ __('Tweets by PalmeraV') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel-panel panel-col-bottom">
                        <div class="inside">
                            <div class="panel-pane pane-custom pane-5">
                                <div class="pane-content">
                                    <div class="copy text-center">
                                        <p>&copy; {{ __('Copy') }}</p>
                                        <p><a href="{{ route('public.about.privacy-policy') }}"
                                                title="{{ __('Privacy Policy') }}">{{ __('Privacy Policy') }}</a>
                                            - <a href="{{ route('public.about.terms-of-use') }}"
                                                title="{{ __('Terms of Use') }}">{{ __('Terms of Use') }}</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </footer>
</div>
