<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyNote extends Model {

    protected $table = 'property_notes';
    public $timestamps = true;

    public function property() {
        return $this->belongsTo('App\Models\Property');
    }
}
