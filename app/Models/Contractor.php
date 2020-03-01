<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AppModel;

class Contractor extends Model {

    use AppModel;
    
    protected $table = 'contractors';
    public $timestamps = true;

    public function city() {
        return $this->belongsToMany('App\Models\City');
    }

    public function services() {
        return $this->hasMany('App\Models\ContractorService');
    }

}