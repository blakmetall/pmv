<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AppModel;

class Profile extends Model
{

    use AppModel;

    protected $table = 'profiles';
    public $timestamps = true;
    protected $fillable = [
        'owner_id',
        'firstname',
        'lastname',
        'country',
        'state',
        'city',
        'street',
        'zip',
        'phone',
        'emergency_phone',
        'mobile',
        'config_language',
        'config_agent_commission',
        'config_agent_is_enabled',
        'contact_type',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function owner()
    {
        return $this->belongsTo('App\Models\User', 'owner_id');
    }

    // mutator: full_name 
    public function getFullNameAttribute()
    {
        return "{$this->firstname} {$this->lastname}";
    }

    public function getNameInitialsAttribute()
    {
        return ucfirst(substr($this->firstname, 0, 1)) . '. ' . ucfirst(substr($this->lastname, 0, 1)) . '.';
    }
}
