<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{PropertyBooking, Property, User};
use App\Repositories\PropertiesRepositoryInterface;
use App\Repositories\PropertyBookingsRepositoryInterface;
use App\Repositories\DamageDepositsRepositoryInterface;
use App\Repositories\CitiesRepositoryInterface;

class PropertyBookingController extends Controller
{
    private $repository;
    private $propertiesRepository;
    private $damagesDepositsRepository;
    private $citiesRepository;

    public function __construct(
        PropertyBookingsRepositoryInterface $repository,
        PropertiesRepositoryInterface $propertiesRepository,
        DamageDepositsRepositoryInterface $damagesDepositsRepository,
        CitiesRepositoryInterface $citiesRepository
    ) {
        $this->repository = $repository;
        $this->propertiesRepository = $propertiesRepository;
        $this->damagesDepositsRepository = $damagesDepositsRepository;
        $this->citiesRepository = $citiesRepository;
    }

    public function index(Request $request)
    {
        $search = [
            'from_date' => $request->from_date,
            'to_date' => $request->to_date,
            'location' => $request->location,
        ];

        $bookings = $this->repository->all($search);
        $locations = $this->citiesRepository->all('');

        return view('property-bookings.index')
            ->with('bookings', $bookings)
            ->with('locations', $locations)
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
        $search = [
            'from_date' => $fromDate,
            'to_date' => $toDate,
            'location' => $searchedLocation,
        ];
        $arrivals = $this->getArrivals($search);
        $departures = $this->getDepartures($search);
        $locations = $this->citiesRepository->all('');

        return view('property-bookings.arrivals-departures')
            ->with('arrivals', $arrivals)
            ->with('departures', $departures)
            ->with('locations', $locations)
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
        $query->whereHas('property', function ($q) use ($search) {
            $q->where('city_id', 'like', '%' . $search['location'] . '%');
        });

        $result = $query->get();

        return $result;
    }

    public function getDepartures($search)
    {
        $query = PropertyBooking::query();
        $query->where(function ($query) use ($search) {
            $query->whereBetween('departure_date', [$search['from_date'], $search['to_date']]);
        });
        $query->whereHas('property', function ($q) use ($search) {
            $q->where('city_id', 'like', '%' . $search['location'] . '%');
        });

        $result = $query->get();

        return $result;
    }

    public function propertyBookings(Request $request, Property $property)
    {
        $search = trim($request->s);
        $bookings = $this->repository->all($search, ['propertyID' => $property->id]);
        $locations = $this->citiesRepository->all('');
        return view('property-bookings.index')
            ->with('bookings', $bookings)
            ->with('property', $property)
            ->with('locations', $locations)
            ->with('search', $search);
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

        return view('property-bookings.create')
            ->with('booking', $booking)
            ->with('property', $property)
            ->with('damageDeposits', $damageDeposits);
    }

    public function store(Request $request)
    {
        $bookings = Property::find($request->property_id)->bookings;
        $bookingExist = false;
        foreach ($bookings as $booking) {
            if (($request->arrival_date > $booking->arrival_date) && ($request->arrival_date < $booking->departure_date)) {
                $bookingExist = true;
            }
            if (($request->departure_date > $booking->arrival_date) && ($request->departure_date < $booking->departure_date)) {
                $bookingExist = true;
            }
        }
        if ($bookingExist) {
            $request->session()->flash('success', __('A Booking actually have same date successfully'));
            return redirect()->back();
        } else {
            $booking = $this->repository->create($request);
            $request->session()->flash('success', __('Record created successfully'));
            return redirect(route('property-bookings.edit', [$booking->id]));
        }
    }

    public function show(PropertyBooking $id)
    {
        $booking = $this->repository->find($id);
        $property = $this->propertiesRepository->find($booking->property_id);
        $damageDeposits = $this->damagesDepositsRepository->all('');

        return view('property-bookings.show')
            ->with('booking', $booking)
            ->with('property', $property)
            ->with('damageDeposits', $damageDeposits);
    }

    public function edit(PropertyBooking $id)
    {
        $booking = $this->repository->find($id);
        $property = $this->propertiesRepository->find($booking->property_id);
        $damageDeposits = $this->damagesDepositsRepository->all('');

        return view('property-bookings.edit')
            ->with('booking', $booking)
            ->with('property', $property)
            ->with('damageDeposits', $damageDeposits);
    }

    public function update(Request $request, $id)
    {
        $bookings = Property::find($request->property_id)->bookings;
        $bookingExist = false;
        foreach ($bookings as $booking) {
            if (($request->arrival_date > $booking->arrival_date) && ($request->arrival_date < $booking->departure_date) && ($booking->id != $id)) {
                $bookingExist = true;
            }
            if (($request->departure_date > $booking->arrival_date) && ($request->departure_date < $booking->departure_date) && ($booking->id != $id)) {
                $bookingExist = true;
            }
        }
        if ($bookingExist) {
            $request->session()->flash('success', __('A Booking actually have same date successfully'));
            return redirect()->back();
        } else {
            $this->repository->update($request, $id);
            $request->session()->flash('success', __('Record updated successfully'));
            return redirect(route('property-bookings.edit', [$id]));
        }
    }

    public function destroy(Request $request, $id)
    {
        if ($this->repository->canDelete($id)) {

            $this->repository->delete($id);
            $request->session()->flash('success', __('Record deleted successfully'));

            return redirect()->back();
        }

        $request->session()->flash('error', __("This record can't be deleted"));

        return redirect()->back();
    }

    // get the partial section to select property; used to create new transaction url
    public function getPropertySelection()
    {
        $config = [
            'filterByWorkgroup' => true,
            'filterByEnabled' => true,
        ];
        $properties = $this->propertiesRepository->all('', $config);

        return view('property-bookings.get-property-selection')->with('properties', $properties);
    }

    // generates the url and redirects to create new transaction for specific property
    public function generateBookingUrl(Property $property)
    {
        return redirect(route('property-bookings.create', $property->id));
    }
}
