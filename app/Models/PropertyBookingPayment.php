<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\AppModel;

class PropertyBookingPayment extends Model
{

    use AppModel;
    use SoftDeletes;

    protected $table = 'property_booking_payments';
    public $timestamps = true;

    protected $fillable = [
        'booking_id',
        'transaction_source_id',
        'amount',
        'exchange_rate',
        'damage_insurance',
        'comission',
        'bank_fees',
        'net_comission',
        'post_date',
        'comments',
        'is_paid',
        'audit_datetime',
        'audit_user_id',
    ];

    public function booking()
    {
        return $this->belongsTo('App\Models\PropertyBooking');
    }

    public function transactionSource()
    {
        return $this->belongsTo('App\Models\TransactionSource');
    }

    public function auditedBy()
    {
        return $this->belongsTo('App\Models\User', 'audit_user_id');
    }
}
