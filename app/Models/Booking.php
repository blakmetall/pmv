<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model {

    protected $table = 'bookings';
    public $timestamps = true;

    public function property() {
        return $this->belongsTo('App\Models\Property');
    }

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function auditedBy() {
        return $this->belongsTo('App\Models\User', 'audit_user_id');
    }

    public function refundAuditedBy() {
        return $this->belongsTo('App\Models\User', 'audit_refund_user_id');
    }

    public function cleaningServices() {
        return $this->hasMany('App\Models\CleaningService');
    }

    public function commission() {
        return $this->hasOne('App\Models\BookingCommission');
    }

    public function rentalAgent() {
        return $this->belongsTo('App\Models\User', 'user_agent_id');
    }

    public function reservationRequest() {
        return $this->belongsTo('App\Models\ReservationRequest');
    }

    public function extraPayments() {
        return $this->hasMany('App\Models\BookingExtraPayment');
    }

}
