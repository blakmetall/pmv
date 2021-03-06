<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AppModel;

class PropertyTranslation extends Model {

    use AppModel;

    protected $table = 'properties_translations';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    public function language() {
        return $this->belongsTo('App\Models\Language');
    }

    public function property() {
        return $this->belongsTo('App\Models\Property');
    }
}