@extends('layouts.public-master')

@section('page-css')
    {{-- property details css --}}
    <link rel="stylesheet" href="{{ asset('assets/public/css/flexslider.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/public/css/property-details.css') }}">
@endsection

@section('main-content')

    @include('public.pages.partials.content-top')

    @php
    $title = 'Reservations';
    $datesProperty = explode(',', $_COOKIE['datesProperty']);
    $arrival = $datesProperty[0];
    $arrivalTxt = $datesProperty[1];
    $departure = $datesProperty[2];
    $departureTxt = $datesProperty[3];
    $bothDates = $arrivalTxt . ' - ' . $departureTxt;
    $total = \RatesHelper::getNightsSubtotalCost($property->property, $arrival, $departure);
    $availabilityProperty = getAvailabilityProperty($property->property_id, $arrival, $departure);
    $nightlyRate = \RatesHelper::getNightlyRate($property->property, null, $arrival, $departure);
    $nightsDate = \RatesHelper::getTotalBookingDays($arrival, $departure);
    $modalID = 'calendar-availability-' . strtotime('now') . rand(1, 99999);
    $latitude = $property->property->gmaps_lat;
    $longitude = $property->property->gmaps_lon;
    @endphp

    @include('public.pages.partials.main-content-start')

    <div id="reservations">
        <div class="form-header"> <i class="glyphicon glyphicon-calendar"></i> Booking - {{ $property->name }} <br>
            <span class="form-header-sub">Condo / Bedrooms 2 / Baths 1 / Sleeps 4</span>
        </div>
        <form action="/reservations" method="post" id="bookings-form" accept-charset="UTF-8">
            <div>
                <div class="row">
                    <div class="col-xs-6">
                        <div class="hr-tagline"><span>Guest Details</span></div>
                        <div class="form-item form-item-b-first-name form-type-textfield form-group">
                            <div class="input-group"><span class="input-group-addon"><span
                                        class="glyphicon glyphicon-user"></span></span><input placeholder="First name"
                                    class="form-control form-text" type="text" id="edit-b-first-name" name="b_first_name"
                                    value="" size="60" maxlength="128"></div> <label class="control-label element-invisible"
                                for="edit-b-first-name">First name</label>
                        </div>
                        <div class="form-item form-item-b-last-name form-type-textfield form-group">
                            <div class="input-group"><span class="input-group-addon"><span
                                        class="glyphicon glyphicon-user"></span></span><input placeholder="Last name"
                                    class="form-control form-text" type="text" id="edit-b-last-name" name="b_last_name"
                                    value="" size="60" maxlength="128"></div> <label class="control-label element-invisible"
                                for="edit-b-last-name">Last Name</label>
                        </div>
                        <div class="form-item form-item-b-email form-type-textfield form-group">
                            <div class="input-group"><span class="input-group-addon"><span
                                        class="glyphicon glyphicon-envelope"></span></span><input
                                    placeholder="Email address" class="form-control form-text" type="text" id="edit-b-email"
                                    name="b_email" value="" size="60" maxlength="128"></div> <label
                                class="control-label element-invisible" for="edit-b-email">Email address</label>
                        </div>
                        <div class="form-item form-item-b-email-confirm form-type-textfield form-group">
                            <div class="input-group"><span class="input-group-addon"><span
                                        class="glyphicon glyphicon-envelope"></span></span><input
                                    placeholder="Confirm email" class="form-control form-text" type="text"
                                    id="edit-b-email-confirm" name="b_email_confirm" value="" size="60" maxlength="128">
                            </div> <label class="control-label element-invisible" for="edit-b-email-confirm">Confirm email
                                address</label>
                        </div>
                        <div class="form-item form-item-b-phone form-type-textfield form-group">
                            <div class="input-group"><span class="input-group-addon"><span
                                        class="glyphicon glyphicon-phone-alt"></span></span><input placeholder="Telephone"
                                    class="form-control form-text" type="text" id="edit-b-phone" name="b_phone" value=""
                                    size="60" maxlength="128"></div> <label class="control-label element-invisible"
                                for="edit-b-phone">Telephone</label>
                        </div>
                        <div class="form-item form-item-b-mobil form-type-textfield form-group">
                            <div class="input-group"><span class="input-group-addon"><span
                                        class="glyphicon glyphicon-phone"></span></span><input placeholder="Mobil"
                                    class="form-control form-text" type="text" id="edit-b-mobil" name="b_mobil" value=""
                                    size="60" maxlength="128"></div> <label class="control-label element-invisible"
                                for="edit-b-mobil">Mobil</label>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="hr-tagline"><span>Address</span></div>
                        <div class="form-item form-item-b-address form-type-textfield form-group">
                            <div class="input-group"><span class="input-group-addon"><span
                                        class="glyphicon glyphicon-home"></span></span><input placeholder="Street address"
                                    class="form-control form-text" type="text" id="edit-b-address" name="b_address" value=""
                                    size="60" maxlength="128"></div> <label class="control-label element-invisible"
                                for="edit-b-address">Street address</label>
                        </div>
                        <div class="form-item form-item-b-city form-type-textfield form-group">
                            <div class="input-group"><span class="input-group-addon"><span
                                        class="glyphicon glyphicon-stats"></span></span><input placeholder="City"
                                    class="form-control form-text" type="text" id="edit-b-city" name="b_city" value=""
                                    size="60" maxlength="128"></div> <label class="control-label element-invisible"
                                for="edit-b-city">City</label>
                        </div>
                        <div class="form-item form-item-b-state form-type-textfield form-group">
                            <div class="input-group"><span class="input-group-addon"><span
                                        class="glyphicon glyphicon-map-marker"></span></span><input placeholder="State"
                                    class="form-control form-text" type="text" id="edit-b-state" name="b_state" value=""
                                    size="60" maxlength="128"></div> <label class="control-label element-invisible"
                                for="edit-b-state">State</label>
                        </div>
                        <div class="form-item form-item-b-postal form-type-textfield form-group">
                            <div class="input-group"><span class="input-group-addon"><span
                                        class="glyphicon glyphicon-pushpin"></span></span><input placeholder="Postal code"
                                    class="form-control form-text" type="text" id="edit-b-postal" name="b_postal" value=""
                                    size="60" maxlength="128"></div> <label class="control-label element-invisible"
                                for="edit-b-postal">Postal code</label>
                        </div>
                        <div class="form-item form-item-b-country form-type-select form-group">
                            <div class="input-group"><span class="input-group-addon"><span
                                        class="glyphicon glyphicon-globe"></span></span><select
                                    class="form-control form-select" id="edit-b-country" name="b_country">
                                    <option value="">Select country...</option>
                                    <option value="1">Afghanistan</option>
                                    <option value="2">Albania</option>
                                    <option value="3">Algeria</option>
                                    <option value="4">American Samoa</option>
                                    <option value="5">Andorra</option>
                                    <option value="6">Angola</option>
                                    <option value="7">Anguilla</option>
                                    <option value="8">Antarctica</option>
                                    <option value="9">Antigua and Barbuda</option>
                                    <option value="10">Argentina</option>
                                    <option value="11">Armenia</option>
                                    <option value="12">Aruba</option>
                                    <option value="13">Australia</option>
                                    <option value="14">Austria</option>
                                    <option value="15">Azerbaijan</option>
                                    <option value="16">Bahamas</option>
                                    <option value="17">Bahrain</option>
                                    <option value="18">Bangladesh</option>
                                    <option value="19">Barbados</option>
                                    <option value="20">Belarus</option>
                                    <option value="21">Belgium</option>
                                    <option value="22">Belize</option>
                                    <option value="23">Benin</option>
                                    <option value="24">Bermuda</option>
                                    <option value="25">Bhutan</option>
                                    <option value="26">Bolivia</option>
                                    <option value="27">Bosnia and Herzegovina</option>
                                    <option value="28">Botswana</option>
                                    <option value="29">Bouvet Island</option>
                                    <option value="30">Brazil</option>
                                    <option value="31">British Indian Ocean Territory</option>
                                    <option value="32">Brunei</option>
                                    <option value="33">Bulgaria</option>
                                    <option value="34">Burkina Faso</option>
                                    <option value="35">Burundi</option>
                                    <option value="36">Cambodia</option>
                                    <option value="37">Cameroon</option>
                                    <option value="38">Canada</option>
                                    <option value="39">Cape Verde</option>
                                    <option value="40">Cayman Islands</option>
                                    <option value="41">Central African Republic</option>
                                    <option value="42">Chad</option>
                                    <option value="43">Chile</option>
                                    <option value="44">China</option>
                                    <option value="45">Christmas Island</option>
                                    <option value="46">Cocos (Keeling) Islands</option>
                                    <option value="47">Colombia</option>
                                    <option value="48">Comoros</option>
                                    <option value="49">Congo</option>
                                    <option value="50">Cook Islands</option>
                                    <option value="51">Costa Rica</option>
                                    <option value="52">Cote d'Ivoire (Ivory Coast)</option>
                                    <option value="53">Croatia</option>
                                    <option value="54">Cuba</option>
                                    <option value="55">Cyprus</option>
                                    <option value="56">Czech Republic</option>
                                    <option value="57">Denmark</option>
                                    <option value="58">Djibouti</option>
                                    <option value="59">Dominica</option>
                                    <option value="60">Dominican Republic</option>
                                    <option value="61">East Timor</option>
                                    <option value="62">Ecuador</option>
                                    <option value="63">Egypt</option>
                                    <option value="64">El Salvador</option>
                                    <option value="65">Equatorial Guinea</option>
                                    <option value="66">Eritrea</option>
                                    <option value="67">Estonia</option>
                                    <option value="68">Ethiopia</option>
                                    <option value="69">Falkland Islands</option>
                                    <option value="70">Faroe Islands</option>
                                    <option value="71">Fiji Islands</option>
                                    <option value="72">Finland</option>
                                    <option value="73">France</option>
                                    <option value="74">French Guiana</option>
                                    <option value="75">French Polynesia</option>
                                    <option value="76">French Southern Territories</option>
                                    <option value="77">Gabon</option>
                                    <option value="78">Gambia</option>
                                    <option value="79">Georgia</option>
                                    <option value="80">Germany</option>
                                    <option value="81">Ghana</option>
                                    <option value="82">Gibraltar</option>
                                    <option value="83">Greece</option>
                                    <option value="84">Greenland</option>
                                    <option value="85">Grenada</option>
                                    <option value="86">Guadeloupe</option>
                                    <option value="87">Guam</option>
                                    <option value="88">Guatemala</option>
                                    <option value="89">Guinea</option>
                                    <option value="90">Guinea-Bissau</option>
                                    <option value="91">Guyana</option>
                                    <option value="92">Haiti</option>
                                    <option value="93">Heard Island/McDonald Islands</option>
                                    <option value="94">Honduras</option>
                                    <option value="95">Hong Kong</option>
                                    <option value="96">Hungary</option>
                                    <option value="97">Iceland</option>
                                    <option value="98">India</option>
                                    <option value="99">Indonesia</option>
                                    <option value="100">Iran</option>
                                    <option value="101">Iraq</option>
                                    <option value="102">Ireland</option>
                                    <option value="103">Israel</option>
                                    <option value="104">Italy</option>
                                    <option value="105">Jamaica</option>
                                    <option value="106">Japan</option>
                                    <option value="107">Jordan</option>
                                    <option value="108">Kazakhstan</option>
                                    <option value="109">Kenya</option>
                                    <option value="110">Kiribati</option>
                                    <option value="111">Korea, North</option>
                                    <option value="112">Korea, South</option>
                                    <option value="113">Kuwait</option>
                                    <option value="114">Kyrgyzstan</option>
                                    <option value="115">Lao Peoples Democratic Republic</option>
                                    <option value="116">Latvia</option>
                                    <option value="117">Lebanon</option>
                                    <option value="118">Lesotho</option>
                                    <option value="119">Liberia</option>
                                    <option value="120">Libyan Arab Jamahiriya</option>
                                    <option value="121">Liechtenstein</option>
                                    <option value="122">Lithuania</option>
                                    <option value="123">Luxembourg</option>
                                    <option value="124">Macau</option>
                                    <option value="125">Macedonia</option>
                                    <option value="126">Madagascar</option>
                                    <option value="127">Malawi</option>
                                    <option value="128">Malaysia</option>
                                    <option value="129">Maldives</option>
                                    <option value="130">Mali</option>
                                    <option value="131">Malta</option>
                                    <option value="132">Marshall Islands</option>
                                    <option value="133">Martinique</option>
                                    <option value="134">Mauritania</option>
                                    <option value="135">Mauritius</option>
                                    <option value="136">Mayotte</option>
                                    <option value="137">Mexico</option>
                                    <option value="138">Micronesia</option>
                                    <option value="139">Moldova</option>
                                    <option value="140">Monaco</option>
                                    <option value="141">Mongolia</option>
                                    <option value="142">Morocco</option>
                                    <option value="143">Mozambique</option>
                                    <option value="144">Myanmar</option>
                                    <option value="145">Namibia</option>
                                    <option value="146">Nauru</option>
                                    <option value="147">Nepal</option>
                                    <option value="148">Netherlands</option>
                                    <option value="149">Netherlands Antilles</option>
                                    <option value="150">New Caledonia</option>
                                    <option value="151">New Zealand</option>
                                    <option value="152">Nicaragua</option>
                                    <option value="153">Niger</option>
                                    <option value="154">Nigeria</option>
                                    <option value="155">Niue</option>
                                    <option value="156">Norfolk Island</option>
                                    <option value="157">Northern Mariana Islands</option>
                                    <option value="158">Norway</option>
                                    <option value="159">Oman</option>
                                    <option value="160">Pakistan</option>
                                    <option value="161">Palau</option>
                                    <option value="162">Palestinian Territory</option>
                                    <option value="163">Panama</option>
                                    <option value="164">Papua New Guinea</option>
                                    <option value="165">Paraguay</option>
                                    <option value="166">Peru</option>
                                    <option value="167">Philippines</option>
                                    <option value="168">Pitcairn Island</option>
                                    <option value="169">Poland</option>
                                    <option value="170">Portugal</option>
                                    <option value="171">Puerto Rico</option>
                                    <option value="172">Qatar</option>
                                    <option value="173">Republic of Congo</option>
                                    <option value="174">Reunion</option>
                                    <option value="175">Romania</option>
                                    <option value="176">Russia</option>
                                    <option value="177">Rwanda</option>
                                    <option value="178">Saint Helena</option>
                                    <option value="179">Saint Kitts and Nevis</option>
                                    <option value="180">Saint Lucia</option>
                                    <option value="183">Samoa</option>
                                    <option value="184">San Marino</option>
                                    <option value="185">Sao Tome and Principe</option>
                                    <option value="186">Saudi Arabia</option>
                                    <option value="187">Senegal</option>
                                    <option value="188">Serbia and Montenegro</option>
                                    <option value="189">Seychelles</option>
                                    <option value="190">Sierra Leone</option>
                                    <option value="191">Singapore</option>
                                    <option value="192">Slovakia</option>
                                    <option value="193">Slovenia</option>
                                    <option value="194">Solomon Islands</option>
                                    <option value="195">Somalia</option>
                                    <option value="196">South Africa</option>
                                    <option value="197">South Georgia/Sandwich Islands</option>
                                    <option value="198">Spain</option>
                                    <option value="199">Sri Lanka</option>
                                    <option value="181">St. Pierre and Miquelon</option>
                                    <option value="182">St. Vincent and Grenadines</option>
                                    <option value="200">Sudan</option>
                                    <option value="201">Suriname</option>
                                    <option value="202">Svalbard and Jan Mayen</option>
                                    <option value="203">Swaziland</option>
                                    <option value="204">Sweden</option>
                                    <option value="205">Switzerland</option>
                                    <option value="206">Syrian Arab Republic</option>
                                    <option value="207">Taiwan</option>
                                    <option value="208">Tajikistan</option>
                                    <option value="209">Tanzania</option>
                                    <option value="210">Thailand</option>
                                    <option value="211">Togo</option>
                                    <option value="212">Tokelau</option>
                                    <option value="213">Tonga</option>
                                    <option value="214">Trinidad and Tobago</option>
                                    <option value="215">Tunisia</option>
                                    <option value="216">Turkey</option>
                                    <option value="217">Turkmenistan</option>
                                    <option value="218">Turks and Caicos Islands</option>
                                    <option value="219">Tuvalu</option>
                                    <option value="226">U.S. Minor Outlying Islands</option>
                                    <option value="220">Uganda</option>
                                    <option value="221">Ukraine</option>
                                    <option value="222">United Arab Emirates</option>
                                    <option value="223">United Kingdom</option>
                                    <option value="224">United States</option>
                                    <option value="225">Uruguay</option>
                                    <option value="227">Uzbekistan</option>
                                    <option value="228">Vanuatu</option>
                                    <option value="229">Vatican City</option>
                                    <option value="230">Venezuela</option>
                                    <option value="231">Vietnam</option>
                                    <option value="232">Virgin Islands, British</option>
                                    <option value="233">Virgin Islands, U.S.</option>
                                    <option value="234">Wallis and Futuna Islands</option>
                                    <option value="235">Western Sahara</option>
                                    <option value="236">Yemen</option>
                                    <option value="237">Zambia</option>
                                    <option value="238">Zimbabwe</option>
                                </select></div> <label class="control-label element-invisible"
                                for="edit-b-country">Country</label>
                        </div>
                    </div>
                </div>
                <div class="row b-comments">
                    <div class="col-xs-12">
                        <div class="form-item form-item-b-comments form-type-textarea form-group">
                            <div class="input-group"><span class="input-group-addon"><span
                                        class="glyphicon glyphicon-comment"></span></span>
                                <div class="form-textarea-wrapper resizable textarea-processed resizable-textarea"><textarea
                                        placeholder="Comments" class="form-control form-textarea" id="edit-b-comments"
                                        name="b_comments" cols="60" rows="4"></textarea>
                                    <div class="grippie"></div>
                                </div>
                            </div> <label class="control-label element-invisible" for="edit-b-comments">Comments</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="hr-tagline"><span>Flight Information</span></div>
                        <div class="alert alert-info">If you don't have your flight information at this time please leave
                            the fields blank, you can give us this information at a later time.</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-4">
                        <div class="form-item form-item-b-arrival-airline form-type-textfield form-group">
                            <div class="input-group"><span class="input-group-addon"><span
                                        class="glyphicon glyphicon-plane"></span></span><input placeholder="Arrival airline"
                                    class="form-control form-text" type="text" id="edit-b-arrival-airline"
                                    name="b_arrival_airline" value="" size="60" maxlength="128"></div> <label
                                class="control-label element-invisible" for="edit-b-arrival-airline">Arrival airline</label>
                        </div>
                        <div class="form-item form-item-b-departure-airline form-type-textfield form-group">
                            <div class="input-group"><span class="input-group-addon"><span
                                        class="glyphicon glyphicon-plane"></span></span><input
                                    placeholder="Departure airline" class="form-control form-text" type="text"
                                    id="edit-b-departure-airline" name="b_departure_airline" value="" size="60"
                                    maxlength="128"></div> <label class="control-label element-invisible"
                                for="edit-b-departure-airline">Departure airline</label>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-item form-item-b-arrival-flight form-type-textfield form-group">
                            <div class="input-group"><span class="input-group-addon"><span
                                        class="glyphicon glyphicon-info-sign"></span></span><input
                                    placeholder="Arrival flight number" class="form-control form-text" type="text"
                                    id="edit-b-arrival-flight" name="b_arrival_flight" value="" size="60" maxlength="128">
                            </div> <label class="control-label element-invisible" for="edit-b-arrival-flight">Arrival flight
                                number</label>
                        </div>
                        <div class="form-item form-item-b-departure-flight form-type-textfield form-group">
                            <div class="input-group"><span class="input-group-addon"><span
                                        class="glyphicon glyphicon-info-sign"></span></span><input
                                    placeholder="Departure flight number" class="form-control form-text" type="text"
                                    id="edit-b-departure-flight" name="b_departure_flight" value="" size="60"
                                    maxlength="128"></div> <label class="control-label element-invisible"
                                for="edit-b-departure-flight">Departure flight number</label>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-item form-item-b-arrival-time form-type-textfield form-group">
                            <div class="input-group"><span class="input-group-addon"><span
                                        class="glyphicon glyphicon-time"></span></span><input placeholder="Arrival time"
                                    class="form-control form-text" type="text" id="edit-b-arrival-time"
                                    name="b_arrival_time" value="" size="60" maxlength="128"></div> <label
                                class="control-label element-invisible" for="edit-b-arrival-time">Arrival time</label>
                        </div>
                        <div class="form-item form-item-b-departure-time form-type-textfield form-group">
                            <div class="input-group"><span class="input-group-addon"><span
                                        class="glyphicon glyphicon-time"></span></span><input placeholder="Departure time"
                                    class="form-control form-text" type="text" id="edit-b-departure-time"
                                    name="b_departure_time" value="" size="60" maxlength="128"></div> <label
                                class="control-label element-invisible" for="edit-b-departure-time">Departure time</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="hr-tagline"><span>Damage Deposit</span></div>
                        <div class="alert alert-info">We strongly suggest for you to purchase <a
                                href="/accidental-rental-damage-insurance" title="Accidental Rental Damage Insurance"
                                target="_blank">Accidental Rental Damage Insurance</a>, if you decide not to use Accidental
                            Rental Damage Insurance, you will then be required to make a $500.00 USD damage deposit with
                            your payment.</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-item form-item-b-insurance form-type-radios form-group">
                            <div id="edit-b-insurance" class="form-radios">
                                <div class="form-item form-item-b-insurance form-type-radio radio"> <label
                                        class="control-label" for="edit-b-insurance-2"><input type="radio"
                                            id="edit-b-insurance-2" name="b_insurance" value="2" checked="checked"
                                            class="form-radio">$45.00 USD per property plan (Covers up to: $1,500.00
                                        USD)</label>
                                </div>
                                <div class="form-item form-item-b-insurance form-type-radio radio"> <label
                                        class="control-label" for="edit-b-insurance-3"><input type="radio"
                                            id="edit-b-insurance-3" name="b_insurance" value="3" class="form-radio">$69.00
                                        USD per property plan (Covers up to: $3,000.00 USD)</label>
                                </div>
                                <div class="form-item form-item-b-insurance form-type-radio radio"> <label
                                        class="control-label" for="edit-b-insurance-4"><input type="radio"
                                            id="edit-b-insurance-4" name="b_insurance" value="4" class="form-radio">$500.00
                                        USD Damage deposit (refundable)</label>
                                </div>
                            </div> <label class="control-label element-invisible" for="edit-b-insurance">Accidental Rental
                                Damage Insurance</label>
                        </div>
                    </div>
                </div>
                <div class="row agreement">
                    <div class="col-xs-12">
                        <div class="alert alert-info">
                            <div class="form-item form-item-agreement form-type-checkbox checkbox"> <label
                                    class="control-label" for="edit-agreement"><input type="checkbox" id="edit-agreement"
                                        name="agreement" value="1" class="form-checkbox">Please read and agree to our <a
                                        href="/rental-agreement" title="Rental Agreement" target="_blank">Rental
                                        Agreement</a>, our <a href="/privacy-policy" title="Privacy Policy"
                                        target="_blank">Privacy Policy</a> and our <a href="/terms-of-use"
                                        title="Terms of Use" target="_blank">Terms of Use</a> to complete your reservation
                                    request.</label>
                            </div>
                        </div>
                    </div>
                </div><input type="hidden" name="pid" value="1161">
                <input type="hidden" name="form_build_id" value="form-85LIyE5J9HPd2xzsAVP02Aodzh7FaEiRphPewfQtp5I">
                <input type="hidden" name="form_id" value="bookings_form">
                <div class="captcha"><input type="hidden" name="captcha_sid" value="55269">
                    <input type="hidden" name="captcha_token" value="5402bdeb3b207692e22b5553319c6a40">
                    <img src="/image_captcha?sid=55269&amp;ts=1613890417" width="180" height="60" alt="Image CAPTCHA"
                        title="Image CAPTCHA">
                    <div class="form-item form-item-captcha-response form-type-textfield form-group"> <label
                            class="control-label" for="edit-captcha-response">What code is in the image? <span
                                class="form-required" title="This field is required.">*</span></label>
                        <input class="form-control form-text required" title="" data-toggle="tooltip" type="text"
                            id="edit-captcha-response" name="captcha_response" value="" size="15" maxlength="128"
                            autocomplete="off" data-original-title="Enter the characters shown in the image.">
                    </div>
                </div>
                <div class="form-actions form-wrapper form-group" id="edit-actions"><button title="Make Booking"
                        class="btn btn-success btn-loading form-submit"
                        data-loading-text="<i class=&quot;fa fa-spinner fa-spin&quot;></i> ... one moment please"
                        type="submit" id="edit-submit" name="op" value="Make Booking">Make Booking</button>
                </div>
            </div>
        </form>
    </div>

    @include('public.pages.partials.main-content-end-booking')

    @include('public.pages.partials.footer')

@endsection

@section('bottom-js')
    <script>
        var property = JSON.parse('<?= $prw ?>');

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDmvl4FUJzyTt-JWxurpF7Tx0f-5kK2MJs" async defer>
    </script>
    <script src="{{ asset('assets/public/js/gmaps.js') }}"></script>
    <script src="{{ asset('assets/public/js/jquery.flexslider.js') }}"></script>
    <script src="{{ asset('assets/public/js/property-detail.js') }}"></script>

@endsection
