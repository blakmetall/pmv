<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AppModel;

class PropertyContact extends Model {

    use AppModel;
        
    protected $table = 'property_contacts';
    public $timestamps = false;

    public function property() {
        return $this->belongsTo('App\Models\Property');
    }
}