<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AppModel;

class Workgroup extends Model {

    use AppModel;
    
    protected $table = 'workgroups';
    public $timestamps = false;
    protected $fillable = [
        'city_id',
    ];

    public function city() {
        return $this->belongsTo('App\Models\City');
    }

    public function users() {
        return $this->belongsToMany('App\Models\User', 'workgroup_has_users');
    }

}