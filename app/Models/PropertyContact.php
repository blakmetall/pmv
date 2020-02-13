<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyContact extends Model {

    protected $table = 'property_contacts';
    public $timestamps = false;

    public function property() {
        return $this->belongsTo('App\Models\Property');
    }
}
