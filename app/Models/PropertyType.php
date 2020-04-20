<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AppModel;

class PropertyType extends Model {

    use AppModel;

    protected $table = 'property_types';
    public $timestamps = false;

    public function properties() {
        return $this->hasMany('App\Models\Property');
    }

    public function translations() {
        return $this->hasMany('App\Models\PropertyTypeTranslation');
    }
}