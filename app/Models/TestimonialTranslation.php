<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AppModel;

class TestimonialTranslation extends Model {

    use AppModel;

    protected $table = 'testimonials_translations';
    public $timestamps = false;
    protected $fillable = [
        'title',
        'description',
        'location',
        'occupation',
    ];

    public function language() {
        return $this->belongsTo('App\Models\Language');
    }

    public function testimonial() {
        return $this->belongsTo('App\Models\Testimonial');
    }

}