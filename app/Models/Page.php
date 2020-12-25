<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AppModel;

class Page extends Model {

    use AppModel;

    protected $table = 'pages';
    public $timestamps = false;

    public $en;
    public $es;

    public function languages() {
        return $this->belongsToMany('App\Models\Language', 'pages_translations')
            ->withPivot('title');
    }

    public function translations() {
        return $this->hasMany('App\Models\PageTranslation');
    }
}