<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AppModel;

class CleaningStaff extends Model {

    use AppModel;
    
    protected $table = 'cleaning_staff';
    public $timestamps = true;
    protected $fillable = [
        'firstname',
        'lastname',
        'file_original_name',
        'file_name',
        'file_path',
        'file_url',
    ];

    public function cleaningServices() {
        return $this->belongsToMany('App\Models\CleaningService', 'cleaning_services_has_cleaning_staff');
    }

    public function properties() {
        return $this->belongsToMany('App\Models\Property', 'properties_has_amenities');
    }

    public function services() {
        return $this->hasMany('App\Models\CleaningService');
    }

}
