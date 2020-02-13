<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CleaningOption extends Model {

    protected $table = 'cleaning_options';
    public $timestamps = false;

    public function languages() {
        return $this->belongsToMany('App\Models\Language', 'cleaning_options_translations')
            ->withPivot('name');
    }

    public function properties() {
        return $this->belongsTo('App\Models\Property');
    }

    public function translations() {
        return $this->hasMany('App\Models\CleaningOptionTranslation');
    }
}
