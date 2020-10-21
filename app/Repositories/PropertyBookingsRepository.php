<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Helpers\LanguageHelper;
use App\Repositories\PropertyBookingsRepositoryInterface;
use App\Models\{Property, PropertyBooking, DamageDeposit};
use App\Validations\PropertyBookingsValidations;

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

        $shouldPaginate = isset($config['paginate']) ? $config['paginate'] : true;
        $hasPropertyID = isset($config['propertyID']) ? $config['propertyID'] : '';
        $filterByCity = isset($config['filterByCity']) ? $config['filterByCity'] : '';
        $filterByOwner = isset($config['filterByOwner']) ? $config['filterByOwner'] : '';

        if ($search || $filterByCity) {
            $query = PropertyBooking::query();
            $query->where(function ($query) use ($search) {
                $query->where('start_date', 'like', '%' . $search . '%');
                $query->orWhere('end_date', 'like', '%' . $search . '%');
            });
        } else {
            $query = PropertyBooking::query();
            $query->with('property');
        }

        if ($filterByCity) {
            $query->whereHas('property', function ($q) use ($filterByCity) {
                $q->where('city_id', 'like', '%' . $filterByCity . '%');
            });
        }

        if ($filterByOwner) {
            $query->whereHas('property', function ($q) {
                $q->where('user_id', \Auth::id());
            });
        }


        if ($hasPropertyID) {
            $query->where('property_id', $config['propertyID']);
            $query->orderBy('created_at', 'desc');
        } else {
            $query->select('property_bookings.*');
            $query->join('properties', 'property_bookings.property_id', '=', 'properties.id');
            $query->join('properties_translations', 'properties.id', '=', 'properties_translations.property_id');
            $query->where('language_id', $lang->id);
            $query->orderBy('name', 'asc');

            if ($search) {
                $query->orWhere('properties_translations.name', 'like', '%' . $search . '%');
            }
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
            'is_confirmed' => 0,
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
            $damage_deposit = DamageDeposit::find($booking->damage_deposit_id);
            $subtotal_nights = 0;
            $nights = 1;
            $rates = $property->rates;
            foreach ($rates as $rate) {
                if (($arrival_date >= $rate->start_date) && ($arrival_date <= $rate->end_date)) {
                    $current_arrival_date = new \DateTime($arrival_date);
                    $current_end_date = new \DateTime($rate->end_date);
                    $interval_arrival = $current_arrival_date->diff($current_end_date);
                    $days_arrival = $interval_arrival->format('%a') + 1;
                    $rate_arrival = $rate->nightly * $days_arrival;
                    $subtotal_nights += $rate_arrival;
                    $nights += $days_arrival;
                }

                if (($departure_date >= $rate->start_date) && ($departure_date <= $rate->end_date)) {
                    $current_departure_date = new \DateTime($departure_date);
                    $current_start_date = new \DateTime($rate->start_date);
                    $interval_departure = $current_departure_date->diff($current_start_date);
                    $days_departure = $interval_departure->format('%a') + 1;
                    $rate_departure = $rate->nightly * $days_departure;
                    $subtotal_nights += $rate_departure;
                    $nights += $days_departure;
                }
            }

            $price_per_night = $subtotal_nights / $nights;

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
            $booking->subtotal_damage_deposit = $damage_deposit->price;
            $booking->total =  $subtotal_nights + $damage_deposit->price;

            $booking->save();
        }

        return $booking;
    }

    public function find($id_or_obj)
    {
        $is_obj = is_object($id_or_obj);
        $booking = ($is_obj) ? $id_or_obj : $this->model->find($id_or_obj);

        if (!$booking) {
            throw new ModelNotFoundException("Booking not found");
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
        return new PropertyBooking;
    }
}
