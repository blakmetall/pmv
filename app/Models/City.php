<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AppModel;

class City extends Model {

    use AppModel;
    
    protected $table = 'cities';
    public $timestamps = false;
    protected $fillable = [
        'state_id',
        'name'
    ];

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