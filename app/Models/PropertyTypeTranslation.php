<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AppModel;

class PropertyTypeTranslation extends Model {

    use AppModel;

    protected $table = 'property_types_translations';
    public $timestamps = false;

    public function language() {
        return $this->belongsTo('App\Models\Language');
    }

    public function propertyType() {
        return $this->belongsTo('App\Models\PropertyType');
    }
}