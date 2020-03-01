<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AppModel;

class Zone extends Model {

    use AppModel;

    protected $table = 'zones';
    public $timestamps = false;

    public function languages() {
        return $this->belongsToMany('App\Models\Language', 'zones_translations')
            ->withPivot('name');
    }

    public function translations() {
        return $this->hasMany('App\Models\ZoneTranslation');
    }

    public function city() {
        return $this->belongsTo('App\Models\City');
    }

    public function properties() {
        return $this->hasMany('App\Models\Property');
    }
}