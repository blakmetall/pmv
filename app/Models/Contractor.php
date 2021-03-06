<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AppModel;

class Contractor extends Model {

    use AppModel;
    
    protected $table = 'contractors';
    public $timestamps = true;
    protected $fillable = [
        'city_id',
        'company',
        'contact_name',
        'phone',
        'mobile',
        'email',
        'address'
    ];

    public function city() {
        return $this->belongsTo('App\Models\City');
    }

    public function services() {
        return $this->hasMany('App\Models\ContractorService');
    }
    
}
