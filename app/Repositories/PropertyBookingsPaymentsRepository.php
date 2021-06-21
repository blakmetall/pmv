<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Helpers\LanguageHelper;
use App\Repositories\PropertyBookingsPaymentsRepositoryInterface;
use App\Repositories\PropertyManagementTransactionsRepositoryInterface;
use App\Models\{Property, PropertyBookingPayment, DamageDeposit, PropertyBooking, PropertyManagementTransaction};
use App\Validations\PropertyBookingsPaymentsValidations;

class PropertyBookingsPaymentsRepository implements PropertyBookingsPaymentsRepositoryInterface
{
    protected $model;
    protected $validation;

    public function __construct(PropertyBookingPayment $payment)
    {
        $this->model = $payment;
        $this->validation = new PropertyBookingsPaymentsValidations();
    }

    public function all($search = '', $config = [])
    {

        $shouldPaginate = isset($config['paginate']) ? $config['paginate'] : true;

        $query = PropertyBookingPayment::query();
        $query->where('booking_id', $config['bookingID']);
        $query->orderBy('created_at', 'desc');

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
        $property = Property::find($request->property_id);
        $booking = PropertyBooking::find($request->booking_id);

        if ($is_new) {
            $payment = $this->blueprint();
            $edit = false;
        } else {
            $payment = $this->find($id);
            $edit = true;
        }

        $total    = $booking->total;
        $payments = $booking->payments;
        $reduced  = 0;
        foreach ($payments as $pay) {
            if ($edit && $pay->id == $id) {
                $payReduced = $request->amount;
            } else {
                $payReduced = $pay->amount;
            }
            $reduced += $payReduced;
        }
        $balance = $total - $reduced;
        if ($balance < 0) {
            $request->session()->flash('error', __('The current payment exceed the total balance due'));
            return $payment;
        }

        $data = [
            'is_paid' => 0,
        ];

        $requestData = array_merge($data, $request->all());

        $payment->fill($requestData);

        // audit
        $hasPreviousAudit = $payment->audit_user_id;

        if ($request->is_paid) {
            if (!$hasPreviousAudit) {
                $user = auth()->user();
                $payment->audit_user_id = $user->id;
                $payment->audit_datetime = getCurrentDateTime();
            }
        } else {
            $payment->audit_user_id = null;
            $payment->audit_datetime = null;
        }

        if ($payment->save()) {
            // add pm transaction if applies
            if($request->add_pm_transaction) {
                if ($property->management()->count()) {
                    foreach ($property->management as $pm) {
                        if (!$pm->is_finished) {
                            if ($request->credit_amount) {
                                $transaction = new PropertyManagementTransaction();
                                $transaction->property_management_id = $pm->id;
                                $transaction->transaction_type_id = 18;
                                $transaction->amount = $request->credit_amount;
                                $transaction->post_date = $request->post_date;
                                $transaction->operation_type = 2;
                                $transaction->description = $request->credit_notes;
                                $transaction->save();
                            }
                        }
                    }
                }
            }
        }

        $request->session()->flash('success', __('Record updated successfully'));
        return $payment;
    }

    public function find($id_or_obj)
    {
        $is_obj = is_object($id_or_obj);
        $payment = ($is_obj) ? $id_or_obj : $this->model->find($id_or_obj);

        if (!$payment) {
            throw new ModelNotFoundException("Booking not found");
        }

        return $payment;
    }

    public function delete($id)
    {
        $payment = $this->model->find($id);

        if ($payment && $this->canDelete($id)) {
            $payment->delete();
        }

        return $payment;
    }

    public function canDelete($id)
    {
        $payment = $this->model->find($id);

        if ($payment) {
        }

        return true;
    }

    public function blueprint()
    {
        return new PropertyBookingPayment;
    }
}
