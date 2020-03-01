<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AppModel;

class CleaningOptionTranslation extends Model {

    use AppModel;
    
    protected $table = 'cleaning_options_translations';
    public $timestamps = false;

    public function language() {
        return $this->belongsTo('App\Models\Language');
    }

    public function amenities() {
        return $this->belongsTo('App\Models\CleaningOption');
    }

}