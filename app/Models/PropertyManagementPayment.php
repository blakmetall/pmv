<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyManagementPayment extends Model {

    protected $table = 'property_management_payments';
    public $timestamps = true;

    public function management() {
        return $this->belongsTo('App\Models\PropertyManagement');
    }

    public function transaction() {
        return $this->hasOne('App\Models\PropertyManagementTransaction');
    }
}
