<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AppModel;

class StaffGroup extends Model {

    use AppModel;

    protected $table = 'staff_groups';
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'city_id',
        'location'
    ];

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
