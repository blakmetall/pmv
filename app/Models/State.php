<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model {

    protected $table = 'states';
    public $timestamps = false;

    public function cities() {
        return $this->hasMany('App\Models\City');
    }
}
