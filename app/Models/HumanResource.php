<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AppModel;

class HumanResource extends Model
{
    use AppModel;

    protected $table = 'human_resources';
    public $timestamps = false;
    protected $fillable = [
        'city_id',
        'address',
        'firstname',
        'lastname',
        'department',
        'entry_at',
        'birthday',
        'vacations_start_at',
        'vacations_end_at',
        'days_vacations',
        'children',
        'is_active'
    ];

    public function cleaningServices() {
        return $this->belongsToMany('App\Models\CleaningService', 'cleaning_services_has_cleaning_staff', 'cleaning_staff_id', 'cleaning_service_id');
    }

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function city() {
        return $this->belongsTo('App\Models\City');
    }

    // mutator: full_name
    public function getFullNameAttribute()
    {
        return "{$this->firstname} {$this->lastname}";
    }
}
