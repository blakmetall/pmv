<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyRate extends Model {

    protected $table = 'property_rates';
    public $timestamps = true;

    public function property() {
        return $this->belongsTo('App\Models\Property');
    }
}
