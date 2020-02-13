<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyType extends Model {

    protected $table = 'property_types';
    public $timestamps = false;

    protected $guarded = [
        'id',
    ];

    public function properties() {
        return $this->hasMany('App\Models\Property');
    }

    public function translations() {
        return $this->hasMany('App\Models\PropertyTypeTranslation');
    }
}
