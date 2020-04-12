<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AppModel;

class ZoneTranslation extends Model {

    use AppModel;

    protected $table = 'zones_translations';
    public $timestamps = false;
    protected $fillable = [
        'zone_id',
        'name'
    ];

    public function language() {
        return $this->belongsTo('App\Models\Language');
    }

    public function zone() {
        return $this->belongsTo('App\Models\Zone');
    }
}