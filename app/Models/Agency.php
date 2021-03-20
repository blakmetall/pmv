<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AppModel;

class Agency extends Model {

    use AppModel;

    protected $table = 'agencies';
    public $timestamps = false;

    protected $fillable = [
        'file_slug',
        'file_extension',
        'file_original_name',
        'file_name',
        'file_path',
        'file_url',
    ];
    
    public $en;
    public $es;

    public function languages() {
        return $this->belongsToMany('App\Models\Language', 'agencies_translations')
            ->withPivot('title');
    }

    public function translations() {
        return $this->hasMany('App\Models\AgencyTranslation');
    }
}