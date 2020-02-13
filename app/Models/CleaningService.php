<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CleaningService extends Model {

    protected $table = 'cleaning_services';
    public $timestamps = true;

    public function staff() {
        return $this->belongsTo('App\Models\CleaningStaff');
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
