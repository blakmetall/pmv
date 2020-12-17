@extends('layouts.public-master')

@section('main-content')

    @include('public.pages.partials.content-top')

    @php
    $title = __('CONTACT US');
    @endphp

    @include('public.pages.partials.main-content-start')

    <div class="panel-display panel-1col clearfix">
        <div class="panel-panel panel-col">
            <div>
                <div class="panel-pane pane-custom pane-1">
                    <div class="pane-content">
                        <p>Do you have a comment or question about our services? Please contact the appropriated office at
                            the numbers listed below or send us a message using the contact form on this page.</p>
                        <h2><i class="fa fa-comments"></i> Get in touch</h2>
                    </div>
                </div>
                <div class="panel-separator"></div>
                <div class="panel-pane pane-contact">
                    <div class="pane-content">
                        <form class="user-info-from-cookie contact-form user-info-from-cookie-processed" action="/contact"
                            method="post" id="contact-site-form" accept-charset="UTF-8">
                            <div>
                                <div class="form-item form-item-name form-type-textfield form-group"> <label
                                        class="control-label" for="edit-name">Your name <span class="form-required"
                                            title="This field is required.">*</span></label>
                                    <input class="form-control form-text required" type="text" id="edit-name" name="name"
                                        value="" size="60" maxlength="255">
                                </div>
                                <div class="form-item form-item-mail form-type-textfield form-group"> <label
                                        class="control-label" for="edit-mail">Your e-mail address <span
                                            class="form-required" title="This field is required.">*</span></label>
                                    <input class="form-control form-text required" type="text" id="edit-mail" name="mail"
                                        value="" size="60" maxlength="255">
                                </div>
                                <div class="form-item form-item-subject form-type-textfield form-group"> <label
                                        class="control-label" for="edit-subject">Subject <span class="form-required"
                                            title="This field is required.">*</span></label>
                                    <input class="form-control form-text required" type="text" id="edit-subject"
                                        name="subject" value="" size="60" maxlength="255">
                                </div>
                                <div class="form-item form-item-cid form-type-select form-group"> <label
                                        class="control-label" for="edit-cid">Category <span class="form-required"
                                            title="This field is required.">*</span></label>
                                    <select class="form-control form-select required" id="edit-cid" name="cid">
                                        <option value="0">- Please choose -</option>
                                        <option value="2">Accounting</option>
                                        <option value="3">Concierge</option>
                                        <option value="4">Property Management</option>
                                        <option value="5">Vacation Services / Reservations</option>
                                        <option value="1">Website feedback</option>
                                    </select>
                                </div>
                                <div class="form-item form-item-message form-type-textarea form-group"> <label
                                        class="control-label" for="edit-message">Message <span class="form-required"
                                            title="This field is required.">*</span></label>
                                    <div class="form-textarea-wrapper resizable textarea-processed resizable-textarea">
                                        <textarea class="form-control form-textarea required" id="edit-message"
                                            name="message" cols="60" rows="5"></textarea>
                                        <div class="grippie"></div>
                                    </div>
                                </div><input type="hidden" name="form_build_id"
                                    value="form-89liuq2UrsxfUQsn8p9CBr4ewADoe-D5kew2JIBjdhU">
                                <input type="hidden" name="form_id" value="contact_site_form">
                                <div class="captcha"><input type="hidden" name="captcha_sid" value="47850">
                                    <input type="hidden" name="captcha_token" value="f3bd6655c7635cfe6e93b4487b76fb28">
                                    <img src="/image_captcha?sid=47850&amp;ts=1608181509" width="180" height="60"
                                        alt="Image CAPTCHA" title="Image CAPTCHA">
                                    <div class="form-item form-item-captcha-response form-type-textfield form-group"> <label
                                            class="control-label" for="edit-captcha-response">What code is in the image?
                                            <span class="form-required" title="This field is required.">*</span></label>
                                        <input class="form-control form-text required" title="" data-toggle="tooltip"
                                            type="text" id="edit-captcha-response" name="captcha_response" value=""
                                            size="15" maxlength="128" autocomplete="off"
                                            data-original-title="Enter the characters shown in the image.">
                                    </div>
                                </div>
                                <div class="form-actions form-wrapper form-group" id="edit-actions"><button type="submit"
                                        id="edit-submit" name="op" value="Send message"
                                        class="btn btn-default form-submit">Send message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="panel-separator"></div>
                <div class="panel-pane pane-custom pane-2">
                    <div class="pane-content">
                        <div class="hr-tagline"><span>Our Locations</span></div>
                    </div>
                </div>
                <div class="panel-separator"></div>
                <div class="panel-pane pane-custom pane-3">
                    <div class="pane-content">
                        <div class="row">
                            <div class="col-xs-6">
                                <p>Rodolfo Gómez 118<br>
                                    Puerto Vallarta, Jalisco, México 48380<br>
                                    <span>Local:</span> +52 (322) 223-0101<br>
                                    <span>US &amp; CAN:</span> (323) 250-7721<br>
                                    <span>Call toll free:</span> 1-800-881-8176<br>
                                    <span>E-mail:</span> <a href="mailto:vallarta@palmeravacations.com"
                                        title="Contact our Puerto Vallarta office">vallarta@palmeravacations.com</a>
                                </p>
                            </div>
                            <div class="col-xs-6">
                                <p>Ave. Playa Gaviotas 409 Local 27<br>
                                    Mazatlán, Sinaloa, México 82110<br>
                                    <span>Local:</span> +52 (669) 913-5188<br>
                                    <span>US &amp; CAN:</span> (714) 988-7903<br>
                                    <span>Call toll free:</span> 1-888-688-1577<br>
                                    <span>E-mail:</span> <a href="mailto:mazatlan@palmeravacations.com"
                                        title="Contact our Mazatlán office">mazatlan@palmeravacations.com</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-separator"></div>
                <div class="panel-pane pane-custom pane-4">
                    <div class="pane-content">
                        <div class="row">
                            <div class="col-xs-6">
                                <h4>Location Map</h4>
                                <iframe width="100%" height="300" frameborder="0" scrolling="no" marginheight="0"
                                    marginwidth="0"
                                    src="http://maps.google.com/maps/ms?msa=0&amp;msid=215828438168196305246.0004ab57c7a8020adb702&amp;ie=UTF8&amp;t=m&amp;ll=20.600731,-105.239239&amp;spn=0.016068,0.030813&amp;z=14&amp;output=embed"></iframe>
                            </div>
                            <div class="col-xs-6">
                                <h4>Location Map</h4>
                                <iframe width="100%" height="300" frameborder="0" scrolling="no" marginheight="0"
                                    marginwidth="0"
                                    src="http://maps.google.com/maps/ms?msa=0&amp;msid=215828438168196305246.0004bb128d73e82c8369b&amp;ie=UTF8&amp;t=m&amp;ll=23.243081,-106.45031&amp;spn=0.031546,0.061626&amp;z=13&amp;output=embed"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('public.pages.partials.main-content-end')

    @include('public.pages.partials.footer')

@endsection
