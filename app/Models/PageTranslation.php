<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AppModel;

class PageTranslation extends Model {

    use AppModel;

    protected $table = 'pages_translations';
    public $timestamps = false;
    protected $fillable = [
        'title',
        'slug',
        'description',
        'mid_description',
        'bot_description',
        'left_col',
        'right_col',
    ];

    public function language() {
        return $this->belongsTo('App\Models\Language');
    }

    public function page() {
        return $this->belongsTo('App\Models\Page');
    }

}