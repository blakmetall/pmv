<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AppModel;

class Contact extends Model
{

    use AppModel;

    protected $table = 'contacts';
    public $timestamps = true;
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'phone',
        'emergency_phone',
        'mobile',
        'address',
        'is_active',
        'contact_type',
        'owner_id'
    ];

    // mutator: full_name
    public function getFullNameAttribute()
    {
        return "{$this->firstname} {$this->lastname}";
    }

    public function properties()
    {
        return $this->belongsToMany('App\Models\Property', 'properties_has_contacts');
    }

    public function owner()
    {
        return $this->belongsTo('App\Models\User', 'owner_id');
    }
}
