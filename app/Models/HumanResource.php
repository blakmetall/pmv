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
        'firstname',
        'lastname',
        'address',
        'phone',
        'emergency_phone',
        'mobile',
        'department',
        'entry_at',
        'birthday',
        'vacation_start_date',
        'vacation_end_date',
        'vacation_days',
        'children',
        'is_active',
        'is_cleaning_staff',
    ];

    public function cleaningServices()
    {
        return $this->belongsToMany('App\Models\CleaningService', 'cleaning_services_has_cleaning_staff', 'cleaning_staff_id', 'cleaning_service_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function filterPublic()
    {
        return $this->select('name', 'phone');
    }

    public function filterPrivate()
    {
        return $this->select('name', 'phone', 'address', 'email');
    }

    // mutator: full_name
    public function getFullNameAttribute()
    {
        return "{$this->firstname} {$this->lastname}";
    }
}
