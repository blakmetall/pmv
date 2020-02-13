<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DamageDeposit extends Model {

    protected $table = 'damage_deposits';
    public $timestamps = false;

    public function languages() {
        return $this->belongsToMany('App\Models\Language', 'damage_deposits_translations')
            ->withPivot('description');
    }

    public function translations() {
        return $this->hasMany('App\Models\DamageDepositTranslation');
    }

    public function reservationRequests() {
        return $this->hasMany('App\Models\ReservationRequest');
    }

    public function bookings() {
        return $this->hasMany('App\Models\Booking');
    }
}
