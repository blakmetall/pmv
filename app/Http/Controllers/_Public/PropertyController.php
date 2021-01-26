<?php

namespace App\Http\Controllers\_Public;

use App\Helpers\LanguageHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\PropertyTranslation;
use App\Repositories\PropertiesRepositoryInterface;
use App\Repositories\PropertyBookingsRepositoryInterface;
use App\Repositories\ZonesRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class PropertyController extends Controller
{

    private $propertiesRepository;
    private $propertiyBookingsRepository;
    private $zonesRepository;

    public function __construct(
        PropertiesRepositoryInterface $propertiesRepository,
        PropertyBookingsRepositoryInterface $propertiyBookingsRepository,
        ZonesRepositoryInterface $zonesRepository
    ) {
        $this->propertiesRepository = $propertiesRepository;
        $this->propertiyBookingsRepository = $propertiyBookingsRepository;
        $this->zonesRepository = $zonesRepository;
    }
    
    public function availabilityResults(Request $request)
    {
        $rules = [];
        $messages = [];

        $rules['adults']   = 'required|numeric';
        $rules['bedrooms'] = 'required|numeric';

        $messages['adults.required']   = __('Required adults');
        $messages['adults.numeric']     = __('Required number');
        $messages['bedrooms.required'] = __('Required bedrooms');
        $messages['bedrooms.numeric']   = __('Required number');

        $validator = Validator::make($request->all(), $rules, $messages);
        
        $lang = LanguageHelper::current();
        $query = PropertyTranslation::query();
        $pax = $request->adults + $request->children;
        $petsFriendly = ($request->pet_friendly)?65:0;
        $adultsOnly = ($request->adults_only)?50:0;
        $bechFront = ($request->beach_front)?14:0;
        $search = [
            'title' => ($request->property_name)?$request->property_name:false,
            'type' => ($request->property_type)?$request->property_type:false,
            'city' => ($request->city)?$request->city:false,
            'zone' => ($request->zone)?$request->zone:false,
            'arrival' => $request->arrival,
            'departure' => $request->departure,
            'pax' => $pax,
            'bedrooms' => ($request->bedrooms)?$request->bedrooms:0,
            'pet_friendly' => $petsFriendly,
            'adults_only' => $adultsOnly,
            'beach_front' => $bechFront,
        ];
        $query->where(function ($query) use ($lang, $search) {
            // $query->where('name', $search['title']);
            $query->whereHas('property', function ($query) use ($lang, $search) {
                if($search['type']){
                    $query->where('property_type_id', $search['type']);
                }
                if($search['city']){
                    $query->where('city_id', $search['city']);
                }
                if($search['zone']){
                    $query->where('zone_id', $search['zone']);
                }
                $query->where('bedrooms', '>=', $search['bedrooms']);
                $query->where('pax', '>=', $search['pax']);
                // if($search['pet_friendly'] || $search['adults_only'] || $search['beach_front']){
                //     $query->whereHas('amenities', function ($query) use ($search) {
                //         if($search['pet_friendly']){
                //             $query->where('amenities.id', $search['pet_friendly']);
                //         }
                //         if($search['adults_only']){
                //             $query->where('amenities.id', $search['adults_only']);
                //         }
                //         if($search['beach_front']){
                //             $query->where('amenities.id', $search['beach_front']);
                //         }
                //     });
                // }
            })->where('language_id', $lang->id);
        });
        $properties = $query->paginate(10);
        // foreach($properties as $index => $property){
        //     if($property->property->bookings){
        //         foreach($property->property->bookings as $booking){
        //             $startDate = Carbon::createFromFormat('Y-m-d', $booking->arrival_date);
        //             $endDate = Carbon::createFromFormat('Y-m-d', $booking->departure_date);
        //             $checkArrival = $startDate->between($search['arrival'], $search['departure']);
        //             $checkDeparture = $endDate->between($search['arrival'], $search['departure']);
        //             if($checkArrival || $checkDeparture){
        //                 unset($properties[$index]);
        //             }
        //         }
        //     }
        // }
        if ($properties->total() == 0) {
            $request->session()->flash('error', __('Not Records Found'));
            // if(!$request->is_home){
            //     return redirect()->back();
            // }
        }

        
        $config = ['filterByNews' => true, 'paginate' => false];
        $propertiesNews = $this->propertiesRepository->all('', $config);

        if ($validator->fails()) {
            $errors = '';
            foreach($validator->errors()->get('*') as $error){
                $errors .= $error[0].'<br>';
            }
            $request->session()->flash('error', $errors);
        }

        return view('public.pages.properties.availability-results')
            ->with('properties', $properties)
            ->with('propertiesNews', $propertiesNews);
    }


    public function propertyDetail(Request $request, $zone, $slug)
    {
        $config = ['filterBySlug' => $slug, 'paginate' => false];
        $property = $this->propertiesRepository->all('', $config)[0];
        $prw = [];
        $prw['id'] = $property->property_id;
        $prw['name'] = $property->name;
        $prw['baths'] = $property->property->baths;
        $prw['beds'] = $property->property->bedrooms;
        $prw['pax'] = $property->property->pax;
        $prw['route'] = 'property/'.$zone.'/'.$slug;
        $prw['image'] = getFeaturedImage($property->property_id);
        $prw['rate'] = getLowerRate($property->property_id);
        $prw = json_encode($prw);
        return view('public.pages.properties.property-detail')
            ->with('property', $property)
            ->with('prw', $prw);
    }

    public function zones($city)
    {
        $zones = $this->zonesRepository->all('', [], $city);

        return $zones;
    }

    public function availabilityModal(Request $request)
    {
        $propertyID = $request->source['id'];
        $year = $request->source['year'];

        $currYear = isset($year) ? $year : Carbon::now()->year;
        $prevYear = Carbon::create($currYear)->subYear()->year;
        $nextYear = Carbon::create($currYear)->addYear()->year;
        $bookings = $this->propertiyBookingsRepository->all('', ['propertyID' => $propertyID, 'currentYear' => $currYear, 'filterByNotCancelled' => 1]);
        $count_cols = 0;
        $cols_needed = 3;

        $bookingDaysArr = [];
        $firstDays      = [];
        $endDays        = [];
        foreach ($bookings as $booking) {
            $bookingDaysArr[] = getDatesFromRange($booking->arrival_date, $booking->departure_date, 'd-M-y');
            $bookingDaysSE    = getDatesFromRange($booking->arrival_date, $booking->departure_date, 'd-M-y');
            $firstDays[]      = reset($bookingDaysSE);
            $endDays[]        = end($bookingDaysSE);
        }
        $bookingDays = arrayFlatten($bookingDaysArr);

        $calendar  = '<table align="center" border="0" cellpadding="0" cellspacing="5">';
        $calendar .= '<tr>';
        $calendar .= '<td align="left" valign="top">';
        $calendar .= '<table border="0" cellpadding="0" cellspacing="2">';

        for ($i = 0; $i < 12; $i++) {
            $count_cols++;
            $cm = mktime(0, 0, 0, 1 + $i, 1, $currYear); //get curr month time string
            $days_month = date("t", $cm); //calculate number of days in month
            $first_weekday_unix = mktime(0, 0, 0, date('n', $cm), 1, date('Y', $cm));
            $first_weekday = date('w', $first_weekday_unix);
            $last_weekday_unix = mktime(0, 0, 0, date('n', $cm), $days_month, date('Y', $cm));
            $last_weekday = date('w', $last_weekday_unix);
            $monthLabel = Carbon::parse($cm);
            if (LanguageHelper::getLocale() == 'en') {
                setlocale(LC_ALL, 'en_EN');
                $month = $monthLabel->format('F');
            } else {
                setlocale(LC_ALL, 'es_MX', 'es', 'ES', 'es_MX.utf8');
                $month = $monthLabel->formatLocalized('%B');
            }

            $calendar .= '<tr>';
            $calendar .= '<th colspan="7" align="center" valign="top">' . ucfirst($month) . ' ' . $currYear . '</th>';
            $calendar .= '</tr>';
            $calendar .= '<tr>
                <th>Su</th>
                <th>Mo</th>
                <th>Tu</th>
                <th>We</th>
                <th>Th</th>
                <th>Fr</th>
                <th>Sa</th>
            </tr>';
            $calendar .= '<tr>';
            if ($first_weekday != 0) {
                $calendar .= '<td colspan="' . $first_weekday . '">&nbsp;</td>';
            }
            $count_fields = $first_weekday;
            for ($d = 1; $d <= $days_month; $d++) {
                $addzero = ($d < 10) ? '0' . $d : $d;
                $formatYear = isset($year) ? $year : Carbon::now()->year;
                $formatYear = substr($formatYear, 2);
                $day = $addzero . '-' . date('M', $cm) . '-' . $formatYear;
                if (in_array($day, $bookingDays)) {
                    $occupied = true;
                } else {
                    $occupied = false;
                }
                if (in_array($day, $firstDays)) {
                    $classDay = 'arrival-only';
                } elseif (in_array($day, $endDays)) {
                    $classDay = 'departure-only';
                } else {
                    $classDay = '';
                }

                $colorClass = ($occupied) ? '#D99694' : '#C3D69B';

                $calendar .= '<td class="' . $classDay . '" style="background-color:' . $colorClass . '">';
                $calendar .= '<span class="current-day">' . $d . '</span>';
                $calendar .= '</td>';

                $count_fields++;

                if ($d != $days_month) {
                    if (($count_fields % 7) == 0) {
                        $calendar .= '</tr><tr>';
                    }
                } else {
                    if ($last_weekday != 6) {
                        $calendar .= '<td colspan="' . (6 - $last_weekday) . '">&nbsp;</td>';
                    }

                    $calendar .= '</tr>';
                }
            }
            $calendar .= '</table>';
            $calendar .= '</td>';
            if ($count_cols != 12) {
                if (($count_cols % $cols_needed) == 0) {
                    $calendar .= '</tr><tr>';
                }

                $calendar .= '<td align="left" valign="top">';
                $calendar .= '<table border="0" cellpadding="0" cellspacing="2">';
            } else {
                $calendar .= '</tr>';
            }
        }
        $calendar .= '</table>';

        $data = [
            'calendar' => $calendar,
            'prev'     => $prevYear,
            'current'  => $currYear,
            'next'     => $nextYear,
        ];

        return $data;
    }
}
