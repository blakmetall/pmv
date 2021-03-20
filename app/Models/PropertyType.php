<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AppModel;
use App\Helpers\LanguageHelper;

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

    public function getLabel() {
        $lang = LanguageHelper::current();
        $type = $this->translations()->where('language_id', $lang->id)->first();
        if($type) {
            return $type->name;
        }
        return '';
    }
}