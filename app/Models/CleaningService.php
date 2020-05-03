<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AppModel;

class CleaningService extends Model {

    use AppModel;

    protected $table = 'cleaning_services';
    public $timestamps = true;
    protected $fillable = [
        'property_id',
        //'property_management_transaction_id',
        //'booking_id',
        'date',
        'hour',
        'description',
        'maid_fee',
        'is_finished',
        'audit_datetime',
        'audit_user_id',
        'notes',
    ];

    public function cleaningStaff(){
        return $this->belongsToMany('App\Models\CleaningStaff', 'cleaning_services_has_cleaning_staff');
    }

    public function property() {
        return $this->belongsTo('App\Models\Property');
    }

    public function propertyManagementTransaction() {
        return $this->belongsTo('App\Models\PropertyManagementTransaction');
    }

    public function booking() {
        return $this->belongsTo('App\Models\Booking');
    }

    public function auditedBy() {
        return $this->belongsTo('App\Models\User', 'audit_user_id');
    }

}
