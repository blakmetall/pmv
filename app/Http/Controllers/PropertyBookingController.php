<?php

namespace App\Http\Controllers;

use App;
use App\Helpers\LanguageHelper;
use Illuminate\Http\Request;
use App\Models\PropertyBooking;
use App\Models\Property;
use App\Models\PropertyTranslation;
use App\Models\User;
use App\Repositories\PropertiesRepositoryInterface;
use App\Repositories\PropertyBookingsRepositoryInterface;
use App\Repositories\DamageDepositsRepositoryInterface;
use App\Repositories\CitiesRepositoryInterface;
use App\Repositories\PropertyRatesRepositoryInterface;
use App\Helpers\UserHelper;
use App\Helpers\RatesHelper;
use App\Models\PropertyManagementTransaction;
use Carbon\Carbon;

class PropertyBookingController extends Controller
{
    private $repository;
    private $propertiesRepository;
    private $damagesDepositsRepository;
    private $citiesRepository;
    private $ratesRepository;

    public function __construct(
        PropertyBookingsRepositoryInterface $repository,
        PropertiesRepositoryInterface $propertiesRepository,
        DamageDepositsRepositoryInterface $damagesDepositsRepository,
        CitiesRepositoryInterface $citiesRepository,
        PropertyRatesRepositoryInterface $ratesRepository
    ) {
        $this->repository = $repository;
        $this->propertiesRepository = $propertiesRepository;
        $this->damagesDepositsRepository = $damagesDepositsRepository;
        $this->citiesRepository = $citiesRepository;
        $this->ratesRepository = $ratesRepository;
    }

    public function index(Request $request)
    {
        $search = [
            'from_date' => $request->from_date,
            'to_date' => $request->to_date,
            'location' => $request->location,
            'register_by' => $request->register_by,
        ];

        if (isRole('owner')) {
            $config = [
                'paginate' => true,
                'filterByOwner' => true,
                'reservation_id' => $request->reservation_id,
                'orderByArrival' => false,
                'orderByDeparture' => false,
            ];
        } else {
            $config = [
                'paginate' => true,
                'reservation_id' => $request->reservation_id,
                'orderByArrival' => false,
                'orderByDeparture' => false,
                'propertyID' => $request->property_id
            ];
        }


        $bookings = $this->repository->all($search, $config);
        $locations = $this->citiesRepository->all('');
        $searchedRegister = isset($request->register_by) ? $request->register_by : '';

        if (isRole('owner')) {
            $isOwner = \Auth::id();
        } else {
            $isOwner = false;
        }

        $properties = $this->propertiesRepository->all('', [
            'filterByEnabled' => true,
            'filterByUserId' => $isOwner,
        ]);

        $registers = [];
        $registers[] = ['name' => 'Owner'];
        $registers[] = ['name' => 'Client'];

        return view('property-bookings.index')
            ->with('properties', $properties)
            ->with('bookings', $bookings)
            ->with('locations', $locations)
            ->with('registers', $registers)
            ->with('searchedRegister', $searchedRegister)
            ->with('propertyId', null)
            ->with('search', $search);
    }

    public function arrivalsDepartures(Request $request)
    {
        $currentDate = date('Y-m-d', strtotime('now'));
        $tomorrowDate = date('Y-m-d', strtotime('now + 1 day'));
        $fromDate = (isset($request->from_date)) ? $request->from_date : $currentDate;
        $toDate = (isset($request->to_date)) ? $request->to_date : $tomorrowDate;
        $getLocation = 1;
        $searchedLocation = isset($request->location) ? $request->location : $getLocation;
        $propertyId = isset($request->property_id) ? $request->property_id : false;
        $search = [
            'from_date' => $fromDate,
            'to_date' => $toDate,
            'location' => $searchedLocation,
            'property_id' => $propertyId,
        ];
        $properties = $this->propertiesRepository->all('', [
            'filterByEnabled' => true,
            'filterByUserId' => \Auth::id(),
        ]);
        $arrivals = $this->getArrivals($search);
        $departures = $this->getDepartures($search);
        $locations = $this->citiesRepository->all('');

        return view('property-bookings.arrivals-departures')
            ->with('arrivals', $arrivals)
            ->with('departures', $departures)
            ->with('locations', $locations)
            ->with('properties', $properties)
            ->with('search', $search);
    }

    public function generalAvailability(Request $request)
    {
        $currentDate = date('Y-m-d', strtotime('now'));
        $fromDate = (isset($request->from_date)) ? $request->from_date : $currentDate;
        $endDate = date('Y-m-d', strtotime($fromDate . '+ 13 days'));
        $getLocation = 1;
        $searchedLocation = isset($request->location) ? $request->location : $getLocation;
        $search = [
            'from_date' => $fromDate,
            'to_date'   => $endDate,
            'location'  => $searchedLocation,
            'beds'      => $request->beds,
            'baths'     => $request->baths,
            'pax'       => $request->pax,
            'managed'   => $request->managed,
        ];
        $properties = $this->bookingsAvailability($search);
        $locations = $this->citiesRepository->all('');

        return view('property-bookings.general-availability')
            ->with('properties', $properties)
            ->with('locations', $locations)
            ->with('search', $search);
    }

    public function bookingsAvailability($search)
    {
        $query = Property::query();
        if ($search['location']) {
            $query->where('city_id', 'like', '%' . $search['location'] . '%');
        }
        if ($search['beds']) {
            $query->where('beds', 'like', '%' . $search['beds'] . '%');
        }
        if ($search['baths']) {
            $query->where('baths', 'like', '%' . $search['baths'] . '%');
        }

        if ($search['pax']) {
            $query->where('pax', 'like', '%' . $search['pax'] . '%');
        }
        if ($search['managed']) {
            $query->whereHas('management');
        }
        $query->whereHas('bookings', function ($q) use ($search) {
            $q->whereBetween('arrival_date', [$search['from_date'], $search['to_date']]);
            $q->orWhereBetween('departure_date', [$search['from_date'], $search['to_date']]);
        });
        $result = $query->get();

        return $result;
    }

    public function getArrivals($search)
    {
        $query = PropertyBooking::query();
        $query->where(function ($query) use ($search) {
            $query->whereBetween('arrival_date', [$search['from_date'], $search['to_date']]);
        });
        $query->whereHas('property', function ($qy) use ($search) {
            $qy->where('city_id', 'like', '%' . $search['location'] . '%');
            if (isRole('owner')) {
                $qy->whereHas('users', function ($q) {
                    $q->where('properties_has_users.user_id', UserHelper::getCurrentUserID());
                });
                if (isset($search['property_id']) && $search['property_id']) {
                    $qy->where('property_id', $search['property_id']);
                }
            }
        });
        $query->where('is_cancelled', 0);

        $result = $query->get();

        return $result;
    }

    public function getDepartures($search)
    {
        $query = PropertyBooking::query();
        $query->where(function ($query) use ($search) {
            $query->whereBetween('departure_date', [$search['from_date'], $search['to_date']]);
        });
        $query->whereHas('property', function ($qy) use ($search) {
            $qy->where('city_id', 'like', '%' . $search['location'] . '%');
            if (isRole('owner')) {
                $qy->whereHas('users', function ($q) {
                    $q->where('properties_has_users.user_id', UserHelper::getCurrentUserID());
                });
                if (isset($search['property_id']) && $search['property_id']) {
                    $qy->where('property_id', $search['property_id']);
                }
            }
        });

        $query->where('is_cancelled', 0);

        $result = $query->get();

        return $result;
    }

    public function propertyBookings(Request $request, Property $property)
    {
        // $search = trim($request->s);
        $search = [
            'from_date' => $request->from_date,
            'to_date' => $request->to_date,
            'location' => $request->location,
            'register_by' => $request->register_by,
        ];

        $bookings = $this->repository->all($search, ['propertyID' => $property->id]);
        $locations = $this->citiesRepository->all('');
        $searchedRegister = isset($request->register_by) ? $request->register_by : '';

        $registers = [];
        $registers[] = ['name' => 'Owner'];
        $registers[] = ['name' => 'Client'];

        return view('property-bookings.index')
            ->with('bookings', $bookings)
            ->with('property', $property)
            ->with('locations', $locations)
            ->with('registers', $registers)
            ->with('searchedRegister', $searchedRegister)
            ->with('propertyId', $property->id)
            ->with('search', $search);
    }

    public function calendar(Request $request, Property $property)
    {
        $currYear = isset($request->year) ? $request->year : Carbon::now()->year;
        $prevYear = Carbon::create($currYear)->subYear()->year;
        $nextYear = Carbon::create($currYear)->addYear()->year;
        $config = [
            'currentYear' => $currYear,
            'orderByDeparture' => true,
            'propertyID' => $property->id
        ];
        $bookings = $this->repository->all('', $config);
        $calendar = $this->generateCalendar($property, $request);

        return view('property-bookings.calendar')
            ->with('bookings', $bookings)
            ->with('property', $property)
            ->with('currYear', $currYear)
            ->with('prevYear', $prevYear)
            ->with('nextYear', $nextYear)
            ->with('calendar', $calendar);
    }

    private function generateCalendar($property, $request)
    {
        $currYear = isset($request->year) ? $request->year : Carbon::now()->year;
        $count_cols = 0;
        $cols_needed = 3;

        $bookings       = $this->repository->all('', ['propertyID' => $property->id, 'filterByNotCancelled' => 1]);
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

        if (LanguageHelper::getLocale() == 'en') {
            setlocale(LC_ALL, 'en_EN');
        } else {
            setlocale(LC_ALL, 'es_ES');
        }

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
            $calendar .= '<th colspan="7" align="center" valign="top">' .  ucfirst($month) . ' ' . $currYear . '</th>';
            $calendar .= '</tr>';
            $calendar .= '<tr>
                <th>' . __('Su') . '</th>
                <th>' . __('Mo') . '</th>
                <th>' . __('Tu') . '</th>
                <th>' . __('We') . '</th>
                <th>' . __('Th') . '</th>
                <th>' . __('Fr') . '</th>
                <th>' . __('Sa') . '</th>
            </tr>';

            $calendar .= '<tr>';

            if ($first_weekday != 0) {
                $calendar .= '<td colspan="' . $first_weekday . '">&nbsp;</td>';
            }

            $count_fields = $first_weekday;
            for ($d = 1; $d <= $days_month; $d++) {
                $addzero = ($d < 10) ? '0' . $d : $d;
                $formatYear = isset($request->year) ? $request->year : Carbon::now()->year;
                $formatYear = substr($formatYear, 2);
                $day = $addzero . '-' . date('M', $cm) . '-' . $formatYear;

                if (in_array($day, $bookingDays)) {
                    $occupied = true;
                } else {
                    $occupied = false;
                }

                if (in_array($day, $firstDays) && in_array($day, $endDays)) {
                    $classDay = 'arrival-departure-both';
                } else if (in_array($day, $firstDays)) {
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

        return $calendar;
    }

    public function ownerBookings(Request $request, User $owner)
    {
        echo 'owner bookings will be here';
        echo '<hr><pre>', print_r($userOwner), '<pre>';
        exit;
    }

    public function clientBookings(Request $request, User $client)
    {
        echo 'client bookings will be here';
        echo '<hr><pre>', print_r($userOwner), '<pre>';
        exit;
    }

    public function create(Property $property)
    {
        $booking = $this->repository->blueprint();
        $damageDeposits = $this->damagesDepositsRepository->all('');

        $registers = [];
        $registers[] = ['name' => 'Owner'];

        if (!isRole('owner')) {
            $registers[] = ['name' => 'Client'];
        }

        return view('property-bookings.create')
            ->with('booking', $booking)
            ->with('property', $property)
            ->with('registers', $registers)
            ->with('damageDeposits', $damageDeposits);
    }

    public function calendarModal(Request $request)
    {
        $propertyID = $request->source['id'];
        $year = $request->source['year'];

        $currYear = isset($year) ? $year : Carbon::now()->year;
        $prevYear = Carbon::create($currYear)->subYear()->year;
        $nextYear = Carbon::create($currYear)->addYear()->year;
        $bookings = $this->repository->all('', ['propertyID' => $propertyID, 'currentYear' => $currYear, 'filterByNotCancelled' => 1]);
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

                if (in_array($day, $firstDays) && in_array($day, $endDays)) {
                    $classDay = 'arrival-departure-both';
                } else if (in_array($day, $firstDays)) {
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

    public function store(Request $request)
    {
        // permission control
        if (!isRole('owner') && !can('edit', 'property-bookings')) {
            $request->session()->flash('error', __("You don't have access to this area"));
            return redirect()->back();
        }

        $availability = getAvailabilityProperty($request->property_id, $request->arrival_date, $request->departure_date);

        if ($availability === 'none' || $availability == 'some') {
            $request->session()->flash('error', __('There is a booking dates conflict, review availability calendar'));
            return redirect()->back();
        } else {
            $booking = $this->repository->create($request);

            $msg = __('Reservation created with ID') . ' #' . $booking->id;

            $confirmationRecipients = $this->getNotificationEmails($request, $booking);
            if ($confirmationRecipients) {
                $msg .= '. ' . __('Email recipients notified:') . ' ' . $confirmationRecipients;
            }

            $request->session()->flash('success', $msg);
            return redirect(route('property-bookings.edit', [$booking->id]));
        }
    }

    public function show(PropertyBooking $id)
    {
        $booking = $this->repository->find($id);
        $property = $this->propertiesRepository->find($booking->property_id);
        $damageDeposits = $this->damagesDepositsRepository->all('');

        $registers = [];
        $registers[] = ['name' => 'Owner'];
        $registers[] = ['name' => 'Client'];

        return view('property-bookings.show')
            ->with('booking', $booking)
            ->with('property', $property)
            ->with('registers', $registers)
            ->with('damageDeposits', $damageDeposits);
    }

    public function edit(Request $request, PropertyBooking $id)
    {
        $booking = $this->repository->find($id);
        $property = $this->propertiesRepository->find($booking->property_id);
        $damageDeposits = $this->damagesDepositsRepository->all('');

        // permission control
        if ((isRole('owner') && $booking->register_by != 'Owner') && !can('edit', 'property-bookings')) {
            $request->session()->flash('error', __("You don't have access to this area"));
            return redirect()->back();
        }

        $transactions = [];

        if ($property->management()->count()) {
            foreach ($property->management as $pm) {
                if (!$pm->is_finished) {
                    $transactions = PropertyManagementTransaction::where('property_management_id', $pm->id)->where('transaction_type_id', 18)->get();
                }
            }
        }

        $registers = [];
        $registers[] = ['name' => 'Owner'];

        if (!isRole('owner')) {
            $registers[] = ['name' => 'Client'];
        }

        return view('property-bookings.edit')
            ->with('booking', $booking)
            ->with('property', $property)
            ->with('registers', $registers)
            ->with('transactions', $transactions)
            ->with('damageDeposits', $damageDeposits);
    }

    public function update(Request $request, $id)
    {
        $booking = $this->repository->find($id);

        // permission control
        if ((isRole('owner') && $booking->register_by != 'Owner') && !can('edit', 'property-bookings')) {
            $request->session()->flash('error', __("You don't have access to this area"));
            return redirect()->back();
        }

        $availability = getAvailabilityProperty($request->property_id, $request->arrival_date, $request->departure_date, $id);

        if ($availability === 'none' || $availability == 'some') {
            $request->session()->flash('error', __('There is a booking dates conflict, review availability calendar'));
            return redirect()->back();
        } else {
            $this->repository->update($request, $id);

            $msg = __('Reservation updated with ID') . ' #' . $booking->id;

            $confirmationRecipients = $this->getNotificationEmails($request, $booking);
            if ($confirmationRecipients) {
                $msg .= '. ' . __('Email recipients notified:') . ' ' . $confirmationRecipients;
            }

            $request->session()->flash('success', $msg);
            return redirect(route('property-bookings.edit', [$id]));
        }
    }

    public function destroy(Request $request, $id)
    {
        $booking = $this->repository->find($id);

        // permission control
        // if((isRole('owner') && $booking->register_by != 'Owner') && !can('edit', 'property-bookings')){
        //     $request->session()->flash('error', __("You don't have access to this area"));
        //     return redirect()->back();
        // }
        if (!can('delete', 'property-bookings')) {
            $request->session()->flash('error', __("You don't have access to this area"));
            return redirect()->back();
        }

        if ($this->repository->canDelete($id)) {
            $booking = $this->repository->find($id);

            // cancel first and then delete
            $booking->is_cancelled = true;
            $booking->save();

            $isNew = false;
            $isTeam = true;
            $isDeleted = true;

            if (isProduction()) {
                sendBookingDetailsEmail($booking, 'reservaciones@palmeravacations.com', $isNew, $isTeam, $isDeleted);
                sendBookingDetailsEmail($booking, 'info@palmeravacations.com', $isNew, $isTeam, $isDeleted);
                sendBookingDetailsEmail($booking, 'contabilidad@palmeravacations.com', $isNew, $isTeam, $isDeleted);

                $msg = __('Confirmation recipents delete') . ' reservaciones@palmeravacations.com, info@palmeravacations.com, contabilidad@palmeravacations.com';
                $request->session()->flash('success', $msg);
            } else {
                sendBookingDetailsEmail($booking, 'blakmetall@gmail.com', $isNew, $isTeam, $isDeleted);
                $request->session()->flash('success', __('Record deleted successfully'));
            }

            $this->repository->delete($id);

            return redirect(route('property-bookings'));
        }

        $request->session()->flash('error', __("This record can't be deleted"));

        return redirect(route('property-bookings'));
    }

    // get the partial section to select property; used to create new booking url
    public function getPropertySelection()
    {
        $config = [
            'filterByWorkgroup' => true,
            'filterByWorkgroup' => true,
            'filterByEnabled' => true,
            'filterByUserId' => isRole('owner') ? UserHelper::getCurrentUserID() : false,
            'paginate' => false,
        ];

        $properties = $this->propertiesRepository->all('', $config);

        return view('property-bookings.get-property-selection')->with('properties', $properties);
    }

    // generates the url and redirects to create new transaction for specific property
    public function generateBookingUrl(Property $property)
    {
        return redirect(route('property-bookings.create', $property->id));
    }

    //check availability from property
    public function checkAvailability(Request $request)
    {
        $lang = LanguageHelper::current();
        $year = Carbon::parse(strtotime($request->arrival_date))->year;
        $arrival = $request->arrival_date;

        $departure = $request->departure_date;
        $property_id = $request->property_id;

        $property = PropertyTranslation::where("property_id", $property_id)->where('language_id', $lang->id)->get()[0];

        $minStay = getMinStay($property_id);
        $availabilityProperty = getAvailabilityProperty($property_id, $arrival, $departure);
        $propertyRate = RatesHelper::getPropertyRate($property->property, $property->rates, $arrival, $departure);
        $nights = $propertyRate['totalDays'];
        $total = $propertyRate['total'];

        $data = [];
        $data['afirmation'] = $availabilityProperty;
        $data['name'] = $property->name;
        $data['id'] = $property_id;
        $data['type'] = $property->property->type->getLabel();
        $data['beds'] = $property->property->bedrooms;
        $data['baths'] = $property->property->baths;
        $data['pax'] = $property->property->pax;
        $data['nightlyRate'] = priceFormat($propertyRate['nightlyAppliedRate']) . ' ' . __('avg. night');
        $data['nights'] = $nights;
        $data['total'] = priceFormat($total);
        $data['cleaning'] = $property->property->cleaningOption->getLabel();
        $data['address'] = getCity($property->property->city_id) . ' / ' . $property->property->zone->getLabel();
        $data['arrival'] = $arrival;
        $data['departure'] = $departure;
        $data['year'] = $year;
        $data['minStay'] = $minStay;
        $data['route'] = route('property-bookings.create', [$property_id]);

        return $data;
    }

    public function ratesCalculator(Request $request)
    {
        $rates = [];
        $propertyRate = [
            'totalDays' => '',
            'total' => 0,
            'nightlyAvgRate' => '',
            'nightlyAppliedRate' => '',
        ];

        $properties = $this->propertiesRepository->all('', [
            'filterByEnabled' => true,
            'paginate' => false,
        ]);

        if ($request->property_id) {
            $property = $this->propertiesRepository->find($request->property_id);
            $rates = $this->ratesRepository->all('',  ['property_id' => $request->property_id]);
            $propertyRate = RatesHelper::getPropertyRate($property, $rates, $request->from_date, $request->to_date);
        }

        return view('property-bookings.rates-calculator')
            ->with('from_date', $request->from_date)
            ->with('to_date', $request->to_date)
            ->with('propertyID', $request->property_id)
            ->with('propertyRate', $propertyRate)
            ->with('rates', $rates)
            ->with('properties', $properties);
    }

    private function getNotificationEmails($request, $booking)
    {
        $emails = [];
        $sendDefaultEmails = (isProduction() && $request->send_pmv_notification);

        // guest email
        if ($request->guest) {
            $emails[] = $booking->email;

            if ($booking->alternate_email) {
                $emails[] = $booking->alternate_email;
            }
        }

        // concierge
        if ($request->concierge) {
            $emails[] = 'concierge@palmeravacations.com';
        }

        // office email
        if ($request->office && $booking->property->office->email) {
            $emails[] = $booking->property->office->email;
        }

        // home owners email
        if ($request->home_owner) {
            $owners = $booking->property->users;
            foreach ($owners as $owner) {
                $emails[] = $owner->email;
            }
        }

        // extra emails
        if (isProduction() && (!$request->disable_default_email || $sendDefaultEmails)) {
            $emails[] = 'reservaciones@palmeravacations.com';
            $emails[] = 'info@palmeravacations.com';

            if ($booking->register_by == 'Client') {
                $emails[] = 'accounting@palmeravacations.com';
            }
        }

        // if booking inside next 24hrs send email to:
        $arrival = Carbon::create($booking->arrival_date);
        $now = Carbon::now();

        // extra emails
        if ($arrival->diffInHours($now) <= 24) {
            if (isProduction() && (!$request->disable_default_email || $sendDefaultEmails)) {
                $emails[] = 'pmd@palmeravacations.com';
                $emails[] = 'maidsupervisor@palmeramail.com';
            }
        }

        $emails = array_unique($emails);

        return implode(',', $emails);
    }
}
