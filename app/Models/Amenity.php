<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AppModel;
use App\Helpers\LanguageHelper;

class Amenity extends Model {

    use AppModel;

    protected $table = 'amenities';
    public $timestamps = false;
    
    public $en;
    public $es;

    public function languages() {
        return $this->belongsToMany('App\Models\Language', 'amenities_translations')
            ->withPivot('name');
    }

    public function translations() {
        return $this->hasMany('App\Models\AmenityTranslation');
    }

    public function properties() {
        return $this->belongsToMany('App\Models\Property', 'properties_has_amenities');
    }

    public function getLabel() {
        $lang = LanguageHelper::current();
        $amenity = $this->translations()->where('language_id', $lang->id)->first();
        if($amenity) {
            return $amenity->name;
        }
        return '';
    }
}