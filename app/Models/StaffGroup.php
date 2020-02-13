<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaffGroup extends Model {

    protected $table = 'staff_groups';
    public $timestamps = false;

    public function cleaningStaff() {
        return $this->hasMany('App\Models\CleaningStaff');
    }

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function city() {
        return $this->belongsTo('App\Models\City');
    }

}
