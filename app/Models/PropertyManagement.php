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
    ];

    public function transactions() {
        return $this->hasMany('App\Models\PropertyManagementTransaction');
    }

    public function payments() {
        return $this->hasMany('App\Models\PropertyManagementPayment');
    }

    public function property() {
        return $this->belongsTo('App\Models\Property');
    }

    public static function setFinishedStatusHandler() {
        self::where('end_date', '<', getCurrentDate())->update(['is_finished' => 1]);
        self::where('end_date', '>=', getCurrentDate())->update(['is_finished' => 0]);
    }
}