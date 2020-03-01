<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AppModel;

class PropertyManagementPayment extends Model {

    use AppModel;
    
    protected $table = 'property_management_payments';
    public $timestamps = true;

    public function management() {
        return $this->belongsTo('App\Models\PropertyManagement');
    }

    public function transaction() {
        return $this->hasOne('App\Models\PropertyManagementTransaction');
    }
}