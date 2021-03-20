<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AppModel;

class BookingCommission extends Model {

    use AppModel;
    
    protected $table = 'booking_commissions';
    public $timestamps = true;

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function booking() {
        return $this->belongsTo('App\Models\Booking');
    }

    public function auditedBy() {
        return $this->belongsTo('App\Models\User', 'audit_user_id');
    }
    
}