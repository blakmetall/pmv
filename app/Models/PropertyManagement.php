<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AppModel;

class PropertyManagement extends Model {

    use AppModel;
    
    protected $table = 'property_management';
    public $timestamps = true;

    public function transactions() {
        return $this->hasMany('App\Models\PropertyManagementTransaction');
    }

    public function payments() {
        return $this->hasMany('App\Models\PropertyManagementPayment');
    }

    public function property() {
        return $this->belongsTo('App\Models\Property');
    }
}