<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AppModel;
use App\Helpers\LanguageHelper;

class CleaningOption extends Model {

    use AppModel;

    protected $table = 'cleaning_options';
    public $timestamps = false;
    
    public $en;
    public $es;

    public function languages() {
        return $this->belongsToMany('App\Models\Language', 'cleaning_options_translations')
            ->withPivot('name');
    }

    public function translations() {
        return $this->hasMany('App\Models\CleaningOptionTranslation');
    }
    
    public function properties() {
        return $this->hasMany('App\Models\Property');
    }

    public function getLabel() {
        $lang = LanguageHelper::current();
        $cleaningOption = $this->translations()->where('language_id', $lang->id)->first();
        if($cleaningOption) {
            return $cleaningOption->name;
        }
        return '';
    }

}