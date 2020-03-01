<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AppModel;

class CleaningStaff extends Model {

    use AppModel;
    
    protected $table = 'cleaning_staff';
    public $timestamps = true;

    public function staffGroup() {
        return $this->belongsTo('App\Models\StaffGroup');
    }

    public function services() {
        return $this->hasMany('App\Models\CleaningService');
    }

}