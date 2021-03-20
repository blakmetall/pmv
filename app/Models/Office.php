<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AppModel;

class Office extends Model {

    use AppModel;

    protected $table = 'offices';
    public $timestamps = false;
    protected $fillable = [
        'state_id',
        'name',
        'email',
        'phone',
        'phone_us_can',
        'phone_free',
        'address',
        'gmaps_lat',
        'gmaps_lon',
    ];

    public function state() {
        return $this->belongsTo('App\Models\State');
    }

    public function properties() {
        return $this->hasMany('App\Models\Property');
    }

}
