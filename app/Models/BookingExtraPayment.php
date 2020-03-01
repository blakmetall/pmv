<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AppModel;

class BookingExtraPayment extends Model {

    use App\Model;

    protected $table = 'booking_extra_payments';
    public $timestamps = true;

    public function booking() {
        return $this->belongsTo('App\Models\Booking');
    }

    public function auditedBy() {
        return $this->belongsTo('App\Models\User', 'audit_user_id');
    }
    
}