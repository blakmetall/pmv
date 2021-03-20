<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AppModel;

class AmenityTranslation extends Model {

    use AppModel;

    protected $table = 'amenities_translations';
    public $timestamps = false;
    protected $fillable = [
        'name'
    ];

    public function language() {
        return $this->belongsTo('App\Models\Language');
    }

    public function amenity() {
        return $this->belongsTo('App\Models\Amenity');
    }

}