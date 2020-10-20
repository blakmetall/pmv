<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Helpers\LanguageHelper;
use App\Repositories\PropertyBookingsPaymentsRepositoryInterface;
use App\Models\{Property, PropertyBookingPayment, DamageDeposit};
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

        if ($is_new) {
            $payment = $this->blueprint();
        } else {
            $payment = $this->find($id);
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

        $payment->save();

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
