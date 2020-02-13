<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contractor extends Model {

    protected $table = 'contractors';
    public $timestamps = true;

    public function city() {
        return $this->belongsToMany('App\Models\City');
    }

    public function services() {
        return $this->hasMany('App\Models\ContractorService');
    }

}
