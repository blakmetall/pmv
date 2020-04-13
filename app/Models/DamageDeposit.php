<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AppModel;

class DamageDeposit extends Model {

    use AppModel;
    
    protected $table = 'damage_deposits';
    public $timestamps = false;
    protected $fillable = [
        'price',
        'is_refundable'
    ];
    
    public $en;
    public $es;

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