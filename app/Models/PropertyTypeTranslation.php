<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AppModel;

class PropertyTypeTranslation extends Model {

    use AppModel;

    protected $table = 'property_types_translations';
    public $timestamps = false;

    protected $guarded = [
        'id',
    ];


    public function language() {
        return $this->belongsTo('App\Models\Language');
    }

    public function propertyType() {
        return $this->hasMany('App\Models\PropertyType');
    }
}