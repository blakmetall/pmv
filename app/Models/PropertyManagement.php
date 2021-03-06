<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AppModel;

class PropertyManagement extends Model {

    use AppModel;
    
    protected $table = 'property_management';
    public $timestamps = true;
    protected $fillable = [
        'property_id',
        'management_fee',
        'start_date',
        'end_date',
        'average_month',
        'is_finished',
        'initial_balance',
    ];

    public function transactions() {
        return $this->hasMany('App\Models\PropertyManagementTransaction');
    }

    public function property() {
        return $this->belongsTo('App\Models\Property');
    }

    public function getActivePropertyManagementID() {
        $pm = $this->where('property_id', $this->property_id)->where('is_finished', 0)->first();
        
        return $pm ? $pm->id : '';
    }
}