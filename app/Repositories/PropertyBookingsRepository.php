<?php

namespace App\Repositories;

use Notification;
use App\Notifications\DetailsBooking;
use App\Helpers\LanguageHelper;
use App\Helpers\RatesHelper;
use App\Models\DamageDeposit;
use App\Models\Property;
use App\Models\PropertyBooking;
use App\Validations\PropertyBookingsValidations;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class PropertyBookingsRepository implements PropertyBookingsRepositoryInterface
{
    protected $model;
    protected $validation;

    public function __construct(PropertyBooking $booking)
    {
        $this->model = $booking;
        $this->validation = new PropertyBookingsValidations();
    }

    public function all($search = '', $config = [])
    {
        $lang = LanguageHelper::current();

        $shouldPaginate       = isset($config['paginate']) ? $config['paginate'] : true;
        $hasPropertyID        = isset($config['propertyID']) ? $config['propertyID'] : '';
        $filterById           = isset($config['filterById']) ? $config['filterById'] : false;
        $filterByOwner        = isset($config['filterByOwner']) ? $config['filterByOwner'] : '';
        $currentYear          = isset($config['currentYear']) ? $config['currentYear'] : '';
        $filterByNotCancelled = isset($config['filterByNotCancelled']) ? $config['filterByNotCancelled'] : '';
        $filterById           = isset($config['reservation_id']) ? $config['reservation_id'] : '';
        $orderByArrival           = isset($config['orderByArrival']) ? $config['orderByArrival'] : '';

        if (isset($search['from_date']) && $search['from_date'] != '' || isset($search['to_date']) && $search['to_date'] != '' || isset($search['location']) && $search['location'] != '' || isset($search['register_by']) && $search['register_by']) {
            $query = PropertyBooking::query();

            // if will be filtering only by booking id
            if(!$filterById) {
                $query->where(function ($query) use ($search) {
                    if ($search['from_date'] != '' || $search['to_date'] != '') {
                        $query->whereBetween('arrival_date', [$search['from_date'], $search['to_date']]);
                    }
                    if ($search['register_by'] != '') {
                        $query->where('register_by', $search['register_by']);
                    }
                });
                if ($search['location'] != '') {
                    $query->whereHas('property', function ($q) use ($search) {
                        $q->where('city_id', 'like', '%' . $search['location'] . '%');
                    });
                }
            }
        } else {
            $query = PropertyBooking::query();
            $query->with('property');
        }

        if($filterById) {
            $query->where('property_bookings.id', $filterById);
        } else {
            if ($hasPropertyID) {
                $query->where('property_id', $hasPropertyID);
            } else {
                $query->select('property_bookings.*');
                $query->join('properties', 'property_bookings.property_id', '=', 'properties.id');
                $query->join('properties_translations', 'properties.id', '=', 'properties_translations.property_id');
                $query->where('language_id', $lang->id);
                $query->orderBy('name', 'asc');
            }

            if ($filterByOwner) {
                $query->whereHas('property', function ($q) {
                    $q->whereHas('users', function($q2) {
                        $q2->where('user_id', \Auth::id());
                    });
                });
            }
    
            if ($currentYear) {
                $query->whereYear('arrival_date', $currentYear);
            }
    
            if ($filterByNotCancelled) {
                $query->where('is_cancelled', 0);
            }
        }

        if($orderByArrival) {
            $query->orderBy('arrival_date', 'desc');
        }

        if ($shouldPaginate) {
            $result = $query->paginate(9999);
        } else {
            $result = $query->get();
        }

        return $result;
    }

    public function create(Request $request)
    {
        $this->validation->validate('create', $request);

        return $this->save($request);
    }

    public function update(Request $request, $id)
    {
        $this->validation->validate('edit', $request, $id);

        return $this->save($request, $id);
    }

    public function save(Request $request, $id = '')
    {
        $is_new = !$id;
        $user = auth()->user();

        if ($is_new) {
            $booking = $this->blueprint();
        } else {
            $booking = $this->find($id);
        }

        $data = [
            'user_id' => $user->id,
            'is_confirmed' => 1,
            'is_paid' => 0,
            'is_refundable' => 0,
            'is_cancelled' => 0,
            'arrival_transportation' => 0,
            'departure_transportation' => 0,
        ];

        $requestData = array_merge($data, $request->all());

        $booking->fill($requestData);

        if ($booking->save()) {

            $property = Property::find($booking->property_id);
            $arrival_date = $booking->arrival_date;
            $departure_date = $booking->departure_date;
            
            if ($booking->damage_deposit_id) {
                $damage_deposit = DamageDeposit::find($booking->damage_deposit_id);
                $damageDeposit = $damage_deposit->price;
            } else {
                $damageDeposit = 0;
            }

            $propertyRate = RatesHelper::getPropertyRate($property, $property->rates, $arrival_date, $departure_date);
            $nights = $propertyRate['totalDays'];

            $price_per_night = $propertyRate['nightlyAppliedRate'];
            $subtotal_nights = $propertyRate['total'];

            // audit
            $hasPreviousAudit = $booking->audit_user_id;
            $hasPreviousAuditRefundable = $booking->audit_refund_user_id;

            if ($request->is_confirmed) {
                if (!$hasPreviousAudit) {
                    $user = auth()->user();
                    $booking->audit_user_id = $user->id;
                    $booking->audit_datetime = getCurrentDateTime();
                }
            } else {
                $booking->audit_user_id = null;
                $booking->audit_datetime = null;
            }

            if ($request->is_refundable) {
                if (!$hasPreviousAuditRefundable) {
                    $user = auth()->user();
                    $booking->audit_refund_user_id = $user->id;
                    $booking->audit_refund_datetime = getCurrentDateTime();
                }
            } else {
                $booking->audit_refund_user_id = null;
                $booking->audit_refund_datetime = null;
            }

            $booking->nights = $nights;
            $booking->price_per_night = $price_per_night;
            $booking->subtotal_nights = $subtotal_nights;
            $booking->subtotal_damage_deposit = $damageDeposit;
            $booking->total = $subtotal_nights;

            // $booking->total =  $subtotal_nights + $damage_deposit->price;
            // el deposito para daños creo no se debe poner en el total directamente por que el depósito se está manejando en dolares
            // considero que debe tener su propio control de pago (unos campos más tal vez)
            // -- -- no tengo propuestas de momento; pero por lo pronto unir el daño por depósito no funcionaría ;(

            if ($booking->save()) {
                $contacts = $booking->property->contacts;
                $concierge = false;
                foreach ($contacts as $contact) {
                    if ($contact->contact_type == 'property-manager') {
                        $concierge = $contact->email;
                    }
                }

                if(isProduction()) {
                    if ($request->guest) {
                        sendEmail($booking, $booking->email);
                    }
    
                    if ($request->office) {
                        sendEmail($booking, $booking->property->office->email);
                    }
    
                    if ($concierge) {
                        if ($request->concierge) {
                            sendEmail($booking, $concierge);
                        }
                    }
    
                    if ($request->home_owner) {
                        $owners = $booking->property->users;
                        foreach ($owners as $owner) {
                            sendEmail($booking, $owner->email);
                        }
                    }
    
                    sendEmail($booking, 'reservaciones@palmeravacations.com');
                    sendEmail($booking, 'info@palmeravacations.com');
                    sendEmail($booking, 'contabilidad@palmeravacations.com');
                }
            }
        }

        return $booking;
    }

    public function email($booking, $email)
    {
        Notification::route('mail', $email)->notify(new DetailsBooking($booking));
    }

    public function find($id_or_obj)
    {
        $is_obj = is_object($id_or_obj);
        $booking = ($is_obj) ? $id_or_obj : $this->model->find($id_or_obj);

        if (!$booking) {
            throw new ModelNotFoundException('Booking not found');
        }

        return $booking;
    }

    public function delete($id)
    {
        $booking = $this->model->find($id);

        if ($booking && $this->canDelete($id)) {
            $booking->delete();
        }

        return $booking;
    }

    public function canDelete($id)
    {
        $booking = $this->model->find($id);

        if ($booking) {
        }

        return true;
    }

    public function blueprint()
    {
        return new PropertyBooking();
    }
}
