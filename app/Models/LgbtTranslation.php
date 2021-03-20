<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AppModel;

class LgbtTranslation extends Model {

    use AppModel;

    protected $table = 'lgbts_translations';
    public $timestamps = false;
    protected $fillable = [
        'title',
        'description',
    ];

    public function language() {
        return $this->belongsTo('App\Models\Language');
    }

    public function lgbt() {
        return $this->belongsTo('App\Models\Lgbt');
    }

}