<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AppModel;

class PropertyRate extends Model {

    use AppModel;
    
    protected $table = 'property_rates';
    public $timestamps = true;

    public function property() {
        return $this->belongsTo('App\Models\Property');
    }
}