<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AppModel;
use App\Helpers\LanguageHelper;

class Zone extends Model {

    use AppModel;

    protected $table = 'zones';
    public $timestamps = false;
    protected $fillable = [
        'city_id'
    ];

    public $en;
    public $es;

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

    public function getLabel() {
        $lang = LanguageHelper::current();
        $zone = $this->translations()->where('language_id', $lang->id)->first();
        if($zone) {
            return $zone->name;
        }
        return '';
    }
}