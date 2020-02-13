<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model {

    protected $table = 'cities';
    public $timestamps = false;

    public function state() {
        return $this->belongsTo('App\Models\State');
    }

    public function zones() {
        return $this->hasMany('App\Models\Zone');
    }

    public function properties() {
        return $this->hasMany('App\Models\Property');
    }

    public function contractors() {
        return $this->hasMany('App\Models\Contractor');
    }
}
