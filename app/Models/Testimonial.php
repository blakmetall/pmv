<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AppModel;

class Testimonial extends Model {

    use AppModel;

    protected $table = 'testimonials';
    public $timestamps = true;

    public $en;
    public $es;

    public function languages() {
        return $this->belongsToMany('App\Models\Language', 'testimonials_translations')
            ->withPivot('title');
    }

    public function translations() {
        return $this->hasMany('App\Models\TestimonialTranslation');
    }
}