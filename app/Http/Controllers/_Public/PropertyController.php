<?php

namespace App\Http\Controllers\_Public;

use App;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use App\Helpers\LanguageHelper;
use App\Helpers\RatesHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Repositories\AmenitiesRepositoryInterface;
use App\Models\PropertyBooking;
use App\Models\DamageDeposit;
use App\Models\PropertyTranslation;
use App\Models\City;
use App\Repositories\PropertiesRepositoryInterface;
use App\Repositories\PropertyImagesRepositoryInterface;
use App\Repositories\PropertyBookingsRepositoryInterface;
use App\Repositories\ZonesRepositoryInterface;
use App\Repositories\DamageDepositsRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;

class PropertyController extends Controller
{

    private $propertiesRepository;
    private $propertiyBookingsRepository;
    private $propertyImagesRepositoryInterface;
    private $zonesRepository;
    private $amenitiesRepository;
    private $damagesDepositsRepository;

    public function __construct(
        PropertiesRepositoryInterface $propertiesRepository,
        PropertyImagesRepositoryInterface $propertyImagesRepositoryInterface,
        PropertyBookingsRepositoryInterface $propertiyBookingsRepository,
        ZonesRepositoryInterface $zonesRepository,
        AmenitiesRepositoryInterface $amenitiesRepository,
        DamageDepositsRepositoryInterface $damagesDepositsRepository
    ) {
        $this->propertiesRepository = $propertiesRepository;
        $this->propertyImagesRepositoryInterface = $propertyImagesRepositoryInterface;
        $this->propertiyBookingsRepository = $propertiyBookingsRepository;
        $this->zonesRepository = $zonesRepository;
        $this->amenitiesRepository = $amenitiesRepository;
        $this->damagesDepositsRepository = $damagesDepositsRepository;
    }

    public function availabilityResults(Request $request)
    {
        SEOTools::setTitle(__('Palmera Vacations Property Finder'));
        SEOTools::setDescription(__('Choose the most likable property for your vacations'));
        SEOTools::opengraph()->setUrl(url()->full());

        $rules = [];
        $messages = [];

        $rules['adults']   = 'required|numeric';
        $rules['bedrooms'] = 'required|numeric';

        $messages['adults.required']   = __('Required adults');
        $messages['adults.numeric']     = __('Required number');
        $messages['bedrooms.required'] = __('Required bedrooms');
        $messages['bedrooms.numeric']   = __('Required number');

        if (!$request->property_name) {
            $validator = Validator::make($request->all(), $rules, $messages);
        }

        $lang = LanguageHelper::current();

        $occupancy = (int) $request->adults + (int) $request->children;
        $propertiesArray = $this->propertiesRepository->all($request->property_name, [
            'filterOnline' => true,
            'filterByPropertyType' => $request->property_type,
            'filterByCity' => $request->city,
            'filterByZone' => $request->zone,
            'filterByOccupancy' => $occupancy,
            'filterByBedrooms' => $request->bedrooms,
            'pet_friendly' => $request->pet_friendly ? true : false,
            'adults_only' => $request->adults_only ? true : false,
            'beachfront' => $request->beach_front ? true : false,
            'paginate' => false,
        ]);

        if (count($propertiesArray) == 0) {
            $request->session()->flash('error', __('No Records Found'));
        }

        $config = [
            'filterOnline' => true,
            'filterByNews' => true,
            'paginate' => false,
        ];
        $propertiesNews = $this->propertiesRepository->all('', $config);
        $city = City::find($request->city);

        $getProperties = [];
        foreach ($propertiesArray as $property) {
            $availabilityProperty = getAvailabilityProperty($property->property_id, $request->arrival, $request->departure);
            $propertyRate = RatesHelper::getPropertyRate($property->property, $property->property->rates, $request->arrival, $request->departure);

            $saving = 0;
            if ($propertyRate['nightlyAvgRate'] > $propertyRate['nightlyAppliedRate']) {
                $savingDailyAmount = $propertyRate['nightlyAvgRate'] - $propertyRate['nightlyAppliedRate'];
                $saving = $propertyRate['totalDays'] * $savingDailyAmount;
            }


            // $property->hasValidRate = $propertyRate['hasValidRate'];
            $property->propertyRate = $propertyRate;
            $property->saving = round($saving);
            $property->availabilityProperty = $availabilityProperty;
            $getProperties[] = $property;
        }

        usort($getProperties, function ($a, $b) {
            return $a['propertyRate']['total'] <=> $b['propertyRate']['total'];
        });

        foreach ($getProperties as $index => $property) {
            if ($property->availabilityProperty == 'some') {
                unset($getProperties[$index]);
                $getProperties[] = $property;
            }
        }

        foreach ($getProperties as $index => $property) {
            if ($property->availabilityProperty == 'none') {
                unset($getProperties[$index]);
                $getProperties[] = $property;
            }
        }

        $properties = collect($getProperties)->paginate(config('constants.pagination.per-page'));

        return view('public.pages.properties.availability-results')
            ->with('city', $city)
            ->with('bedrooms', (int) $request->bedrooms)
            ->with('adults', (int) $request->adults)
            ->with('children', (int) $request->children)
            ->with('properties', $properties)
            ->with('propertiesNews', $propertiesNews)
            ->with('arrival', $request->arrival ? $request->arrival : date('Y-m-d', strtotime('now')))
            ->with('departure', $request->departure ? $request->departure :  date('Y-m-d', strtotime('+7 days')));
    }


    public function propertyDetail(Request $request, $locale, $zone, $slug)
    {
        $config = ['filterBySlug' => $slug, 'paginate' => false];
        $property = $this->propertiesRepository->all('', $config)[0];
        if (\App::getLocale() == 'en') {
            $locale = 'en_US';
            $alternate = 'es_ES';
        } else {
            $locale = 'es_ES';
            $alternate = 'en_US';
        }
        $image = asset(getFeaturedImage($property->property_id, 'large'));

        SEOTools::setTitle($property->name . ' - ' . 'Palmera Vacations');
        SEOTools::setDescription(getSubstring(removeP($property->description), 120));
        SEOTools::opengraph()->setUrl(url()->full());
        SEOTools::setCanonical(url()->full());
        SEOTools::opengraph()->addImage($image, ['height' => 500, 'width' => 500]);
        SEOTools::opengraph()->addProperty('type', 'website');
        SEOTools::opengraph()->addProperty('locale', $locale);
        SEOTools::opengraph()->addProperty('locale:alternate', [$alternate]);

        $propertyRate =
            RatesHelper::getPropertyRate($property->property, $property->rates, $request->arrival_alt_sing, $request->departure_alt_sing);

        $prw = [];
        $prw['id'] = $property->property_id;
        $prw['name'] = $property->name;
        $prw['baths'] = $property->property->baths;
        $prw['beds'] = $property->property->bedrooms;
        $prw['pax'] = $property->property->pax;
        $prw['route'] = 'property/' . $zone . '/' . $slug;
        $prw['image'] = getFeaturedImage($property->property_id);
        $prw['rate'] = $propertyRate['nightlyAppliedRate'];
        $prw = json_encode($prw);
        $paxExceeded = false;
        if ($request->arrival_alt_sing && $request->departure_alt_sing) {
            $pax = $request->adults_sing + $request->children_sing;
            if ($pax > $property->property->pax) {
                $request->session()->flash('error', __('The number of people exceeds the maximum occupancy for the property'));
                $paxExceeded = true;
            }
            $arrivalDeparture = [
                'adults' => $request->adults_sing,
                'children' => $request->children_sing,
                'arrival' => $request->arrival_alt_sing,
                'arrivalTxt' => $request->arrival_sing,
                'departure' => $request->departure_alt_sing,
                'departureTxt' => $request->departure_sing,
            ];
        } else {
            $arrivalDeparture = [
                'adults' => null,
                'children' => null,
                'arrival' => null,
                'arrivalTxt' => null,
                'departure' => null,
                'departureTxt' => null
            ];
        }

        $config = ['property_id' => $property->property_id];
        $images = $this->propertyImagesRepositoryInterface->all($config);

        // if dates for booking not saved in cookies redirect to search results
        if (!isset($_COOKIE['datesProperty']) && !isset($_COOKIE['singleProperty'])) {
            return redirect()->route('public.availability-results', [App::getLocale()]);
        }

        $amenities = $this->amenitiesRepository->all('', $config);

        return view('public.pages.properties.property-detail')
            ->with('property', $property)
            ->with('images', $images)
            ->with('arrivalDeparture', $arrivalDeparture)
            ->with('paxExceeded', $paxExceeded)
            ->with('amenities', $amenities)
            ->with('prw', $prw);
    }

    public function zones($city)
    {
        $zones = $this->zonesRepository->all('', [], $city);

        return $zones;
    }

    public function firstsAvailability(Request $request)
    {
        $year = $request->source['year'];

        $currYear = isset($year) ? $year : Carbon::now()->year;
        $startingMonth = date('m', strtotime('now'));
        $monthsCols = 12;
        $displayMonths = 3;

        $calendar = generateCalendar(
            $year,
            $monthsCols,
            $this->propertiyBookingsRepository->all('', ['propertyID' => $request->source['id'], 'currentYear' => $currYear, 'filterByNotCancelled' => 1]),
            $startingMonth,
            $displayMonths,
        );

        $data = [
            'calendar' => $calendar,
        ];

        return $data;
    }

    public function availabilityModal(Request $request)
    {
        $year = $request->source['year'];

        $lang = LanguageHelper::current();

        $property = PropertyTranslation::where("property_id", $request->source['id'])->where('language_id', $lang->id)->get()[0];

        $currYear = isset($year) ? $year : Carbon::now()->year;
        $prevYear = Carbon::create($currYear)->subYear()->year;
        $nextYear = Carbon::create($currYear)->addYear()->year;

        $calendar = generateCalendar(
            $year,
            12,
            $this->propertiyBookingsRepository->all('', ['propertyID' => $request->source['id'], 'filterByNotCancelled' => 1])
        );

        $data = [
            'calendar' => $calendar,
            'prev'     => $prevYear,
            'current'  => $currYear,
            'next'     => $nextYear,
            'name'     => $property->name,
        ];

        return $data;
    }

    public function reservations($locale, $id)
    {

        $captcha = rand(100000, 999999);
        $lang = LanguageHelper::current()->code;
        $slug = $this->propertiesRepository->find($id)->$lang->slug;

        $config = ['filterBySlug' => $slug, 'paginate' => false];
        $property = $this->propertiesRepository->all('', $config)[0];

        SEOTools::setTitle($property->name . ' - ' . 'Palmera Vacations');
        SEOTools::setDescription(getSubstring(removeP($property->description), 120));
        SEOTools::opengraph()->setUrl(url()->full());

        $damageDeposits = $this->damagesDepositsRepository->all('');

        $countries = [
            "Afghanistan",
            "Albania",
            "Algeria",
            "American Samoa",
            "Andorra",
            "Angola",
            "Anguilla",
            "Antarctica",
            "Antigua and Barbuda",
            "Argentina",
            "Armenia",
            "Aruba",
            "Australia",
            "Austria",
            "Azerbaijan",
            "Bahamas",
            "Bahrain",
            "Bangladesh",
            "Barbados",
            "Belarus",
            "Belgium",
            "Belize",
            "Benin",
            "Bermuda",
            "Bhutan",
            "Bolivia",
            "Bosnia and Herzegovina",
            "Botswana",
            "Bouvet Island",
            "Brazil",
            "British Indian Ocean Territory",
            "Brunei",
            "Bulgaria",
            "Burkina Faso",
            "Burundi",
            "Cambodia",
            "Cameroon",
            "Canada",
            "Cape Verde",
            "Cayman Islands",
            "Central African Republic",
            "Chad",
            "Chile",
            "China",
            "Christmas Island",
            "Cocos (Keeling) Islands",
            "Colombia",
            "Comoros",
            "Congo",
            "Cook Islands",
            "Costa Rica",
            "Cote d'Ivoire (Ivory Coast)",
            "Croatia",
            "Cuba",
            "Cyprus",
            "Czech Republic",
            "Denmark",
            "Djibouti",
            "Dominica",
            "Dominican Republic",
            "East Timor",
            "Ecuador",
            "Egypt",
            "El Salvador",
            "Equatorial Guinea",
            "Eritrea",
            "Estonia",
            "Ethiopia",
            "Falkland Islands",
            "Faroe Islands",
            "Fiji Islands",
            "Finland",
            "France",
            "French Guiana",
            "French Polynesia",
            "French Southern Territories",
            "Gabon",
            "Gambia",
            "Georgia",
            "Germany",
            "Ghana",
            "Gibraltar",
            "Greece",
            "Greenland",
            "Grenada",
            "Guadeloupe",
            "Guam",
            "Guatemala",
            "Guinea",
            "Guinea-Bissau",
            "Guyana",
            "Haiti",
            "Heard Island/McDonald Islands",
            "Honduras",
            "Hong Kong",
            "Hungary",
            "Iceland",
            "India",
            "Indonesia",
            "Iran",
            "Iraq",
            "Ireland",
            "Israel",
            "Italy",
            "Jamaica",
            "Japan",
            "Jordan",
            "Kazakhstan",
            "Kenya",
            "Kiribati",
            "Korea, North",
            "Korea, South",
            "Kuwait",
            "Kyrgyzstan",
            "Lao Peoples Democratic Republic",
            "Latvia",
            "Lebanon",
            "Lesotho",
            "Liberia",
            "Libyan Arab Jamahiriya",
            "Liechtenstein",
            "Lithuania",
            "Luxembourg",
            "Macau",
            "Macedonia",
            "Madagascar",
            "Malawi",
            "Malaysia",
            "Maldives",
            "Mali",
            "Malta",
            "Marshall Islands",
            "Martinique",
            "Mauritania",
            "Mauritius",
            "Mayotte",
            "Mexico",
            "Micronesia",
            "Moldova",
            "Monaco",
            "Mongolia",
            "Morocco",
            "Mozambique",
            "Myanmar",
            "Namibia",
            "Nauru",
            "Nepal",
            "Netherlands",
            "Netherlands Antilles",
            "New Caledonia",
            "New Zealand",
            "Nicaragua",
            "Niger",
            "Nigeria",
            "Niue",
            "Norfolk Island",
            "Northern Mariana Islands",
            "Norway",
            "Oman",
            "Pakistan",
            "Palau",
            "Palestinian Territory",
            "Panama",
            "Papua New Guinea",
            "Paraguay",
            "Peru",
            "Philippines",
            "Pitcairn Island",
            "Poland",
            "Portugal",
            "Puerto Rico",
            "Qatar",
            "Republic of Congo",
            "Reunion",
            "Romania",
            "Russia",
            "Rwanda",
            "Saint Helena",
            "Saint Kitts and Nevis",
            "Saint Lucia",
            "Samoa",
            "San Marino",
            "Sao Tome and Principe",
            "Saudi Arabia",
            "Senegal",
            "Serbia and Montenegro",
            "Seychelles",
            "Sierra Leone",
            "Singapore",
            "Slovakia",
            "Slovenia",
            "Solomon Islands",
            "Somalia",
            "South Africa",
            "South Georgia/Sandwich Islands",
            "Spain",
            "Sri Lanka",
            "St. Pierre and Miquelon",
            "St. Vincent and Grenadines",
            "Sudan",
            "Suriname",
            "Svalbard and Jan Mayen",
            "Swaziland",
            "Sweden",
            "Switzerland",
            "Syrian Arab Republic",
            "Taiwan",
            "Tajikistan",
            "Tanzania",
            "Thailand",
            "Togo",
            "Tokelau",
            "Tonga",
            "Trinidad and Tobago",
            "Tunisia",
            "Turkey",
            "Turkmenistan",
            "Turks and Caicos Islands",
            "Tuvalu",
            "U.S. Minor Outlying Islands",
            "Uganda",
            "Ukraine",
            "United Arab Emirates",
            "United Kingdom",
            "United States",
            "Uruguay",
            "Uzbekistan",
            "Vanuatu",
            "Vatican City",
            "Venezuela",
            "Vietnam",
            "Virgin Islands, British",
            "Virgin Islands, U.S.",
            "Wallis and Futuna Islands",
            "Western Sahara",
            "Yemen",
            "Zambia",
            "Zimbabwe",
        ];

        // if dates for booking not saved in cookies redirect to search results
        if (!isset($_COOKIE['datesProperty']) && !isset($_COOKIE['singleProperty'])) {
            return redirect()->route('public.availability-results');
        }

        return view('public.pages.properties.property-booking')
            ->with('captcha', $captcha)
            ->with('property', $property)
            ->with('countries', $countries)
            ->with('damageDeposits', $damageDeposits);
    }

    public function makeReservation(Request $request)
    {
        $rules = [];
        $messages = [];

        $rules['firstname']          = 'required';
        $rules['lastname']           = 'required';
        $rules['email']              = 'required|email';
        $rules['email_confirmation'] = 'required|email|same:email';
        $rules['phone']              = 'required';
        $rules['street']             = 'required';
        $rules['city']               = 'required';
        $rules['state']              = 'required';
        $rules['zip']                = 'required';
        $rules['damage_deposit_id']  = 'required';
        $rules['agreement']          = 'accepted';

        $messages['firstname.required']         = __('Required firstname');
        $messages['lastname.required']          = __('Required lastname');
        $messages['email.required']             = __('Required email');
        $messages['email.email']                = __('Bad Format email');
        $messages['email_confirmation.same']    = __('Required email confirmation');
        $messages['phone.required']             = __('Required phone');
        $messages['street.required']            = __('Required street');
        $messages['city.required']              = __('Required city');
        $messages['state.required']             = __('Required state');
        $messages['zip.required']               = __('Required zip');
        $messages['damage_deposit_id.required'] = __('Required damage');
        $messages['agreement.accepted']         = __('You must accept the terms');

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($request->code_catpcha != $request->captcha_response) {
            $request->session()->flash('error', __('Code image wrong'));
        } else {
            if (!$validator->fails()) {
                $booking = new PropertyBooking;

                if ($request->damage_deposit_id) {
                    $damage_deposit = DamageDeposit::find($request->damage_deposit_id);
                    $damageDeposit = $damage_deposit->price;
                } else {
                    $damageDeposit = 0;
                }

                $booking->property_id             = $request->property_id;
                $booking->firstname               = $request->firstname;
                $booking->lastname                = $request->lastname;
                $booking->email                   = $request->email;
                $booking->country                 = $request->country;
                $booking->state                   = $request->state;
                $booking->city                    = $request->city;
                $booking->street                  = $request->street;
                $booking->zip                     = $request->zip;
                $booking->phone                   = $request->phone;
                $booking->mobile                  = $request->mobile;
                $booking->comments                = $request->comments;
                $booking->arrival_airline         = $request->arrival_airline;
                $booking->arrival_date            = $request->arrival_date;
                $booking->arrival_flight_number   = $request->arrival_flight_number;
                $booking->arrival_time            = $request->arrival_time;
                $booking->departure_airline       = $request->departure_airline;
                $booking->departure_date          = $request->departure_date;
                $booking->departure_flight_number = $request->departure_flight_number;
                $booking->departure_time          = $request->departure_time;
                $booking->price_per_night         = $request->price_per_night;
                $booking->nights                  = $request->nights;
                $booking->subtotal_nights         = $request->subtotal_nights;
                $booking->subtotal_damage_deposit = $damageDeposit;
                $booking->damage_deposit_id       = $request->damage_deposit_id;
                $booking->total                   = $request->subtotal_nights;
                $booking->adults                  = $request->adults;
                $booking->kids                    = $request->children;
                $booking->register_by             = 'Client';

                $isNew = true;

                if ($booking->save()) {
                    // guest email
                    $isTeam = false;
                    sendBookingDetailsEmail($booking, $request->email, $isNew, $isTeam);

                    // owner notification emails
                    $owners = $booking->property->users;
                    foreach ($owners as $owner) {
                        sendBookingDetailsEmail($booking, $owner->email, $isNew);
                    }

                    // default emails
                    if (isProduction()) {
                        sendBookingDetailsEmail($booking, 'reservaciones@palmeravacations.com', $isNew);
                        sendBookingDetailsEmail($booking, 'concierge@palmeravacations.com', $isNew);
                        sendBookingDetailsEmail($booking, 'info@palmeravacations.com', $isNew);
                    }

                    if (isProduction()) {
                        // if booking inside next 24hrs send email to:
                        $arrival = Carbon::create($request->arrival_date);
                        $now = Carbon::now();

                        // extra emails
                        if ($arrival->diffInHours($now) <= 24) {
                            if (isProduction() && !$request->disable_default_email) {
                                sendBookingDetailsEmail($booking, 'pmd@palmeravacations.com', $isNew);
                                sendBookingDetailsEmail($booking, 'maidsupervisor@palmeramail.com', $isNew);
                            }
                        }
                    }

                    return redirect(route('public.thank-you', [App::getLocale(), $booking]))->withInput();
                } else {
                    $request->session()->flash('error', __('Something wrong happen'));
                }
            } else {
                $errors = '';
                foreach ($validator->errors()->get('*') as $error) {
                    $errors .= $error[0] . '<br>';
                }
                $request->session()->flash('error', $errors);
            }
        }
        return redirect()->back()->withInput();
    }

    public function thankYou(Request $request, $locale, $booking)
    {
        $request->session()->flash('success', __('Reservation successful sent'));
        $booking = PropertyBooking::find($booking);

        return view('public.pages.properties.thank-you')
            ->with('booking', $booking);
    }
}
