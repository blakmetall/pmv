<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\AppModel;

class PropertyBooking extends Model
{

    use AppModel;
    use SoftDeletes;

    protected $table = 'property_bookings';
    public $timestamps = true;

    protected $fillable = [
        'property_id',
        'user_id',
        'user_agent_id',
        'firstname',
        'lastname',
        'country',
        'state',
        'city',
        'street',
        'zip',
        'phone',
        'mobile',
        'comments',
        'arrival_airline',
        'arrival_date',
        'arrival_flight_number',
        'arrival_time',
        'departure_airline',
        'departure_date',
        'departure_flight_number',
        'departure_time',
        'audit_datetime',
        'audit_user_id',
        'price_per_night',
        'price_rate_type',
        'nights',
        'subtotal_nights',
        'subtotal_damage_deposit',
        'damage_deposit_id',
        'total',
        'adults',
        'kids',
        'is_refundable',
        'is_property_damaged',
        'audit_refund_datetime',
        'audit_refund_user_id',
        'is_confirmed',
        'is_cancelled',
        'is_paid',
        'is_finished',
    ];

    public function property()
    {
        return $this->belongsTo('App\Models\Property');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function auditedBy()
    {
        return $this->belongsTo('App\Models\User', 'audit_user_id');
    }

    public function refundAuditedBy()
    {
        return $this->belongsTo('App\Models\User', 'audit_refund_user_id');
    }

    public function commission()
    {
        return $this->hasOne('App\Models\PropertyBookingCommission');
    }

    public function rentalAgent()
    {
        return $this->belongsTo('App\Models\User', 'user_agent_id');
    }

    public function payments()
    {
        return $this->hasMany('App\Models\PropertyBookingPayment');
    }

    public function damageDeposit()
    {
        return $this->belongsTo('App\Models\DamageDeposit');
    }
}
