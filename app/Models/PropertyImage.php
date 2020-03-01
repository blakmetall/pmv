<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AppModel;

class PropertyImage extends Model {

    use AppModel;
    
    protected $table = 'property_images';
    public $timestamps = false;

    public function property() {
        return $this->belongsTo('App\Models\Property');
    }
}