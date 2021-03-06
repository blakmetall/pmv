<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AppModel;

class ReservationRequest extends Model {

    use AppModel;

    protected $table = 'reservation_requests';
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

    public function damageDeposit() {
        return $this->belongsTo('App\Models\DamageDeposit');
    }

    public function booking() {
        return $this->hasOne('App\Models\PropertyBooking');
    }

}