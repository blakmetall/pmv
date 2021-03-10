<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AppModel;

class AgencyTranslation extends Model {

    use AppModel;

    protected $table = 'agencies_translations';
    public $timestamps = false;
    protected $fillable = [
        'title',
        'description',
    ];

    public function language() {
        return $this->belongsTo('App\Models\Language');
    }

    public function agency() {
        return $this->belongsTo('App\Models\Agency');
    }

}