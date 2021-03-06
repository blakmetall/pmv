<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AppModel;

class CleaningService extends Model
{

    use AppModel;

    protected $table = 'cleaning_services';
    public $timestamps = true;
    protected $fillable = [
        'property_id',
        'date',
        // 'hour',
        'description',
        'maid_fee',
        'is_finished',
        'notes',
        'sunday_bonus',
    ];

    // accessor: total_cost
    public function getTotalCostAttribute()
    {
        $total_cost = $this->maid_fee + $this->sunday_bonus;
        return $total_cost;
    }

    public function cleaningStaff()
    {
        return $this->belongsToMany('App\Models\HumanResource', 'cleaning_services_has_cleaning_staff', 'cleaning_service_id', 'cleaning_staff_id');
    }

    public function cleaningServicesStatus()
    {
        return $this->belongsToMany('App\Models\CleaningServiceStatus', 'cleaning_services_has_status', 'cleaning_service_id', 'cleaning_service_status_id');
    }

    public function property()
    {
        return $this->belongsTo('App\Models\Property');
    }

    public function propertyManagementTransaction()
    {
        return $this->belongsTo('App\Models\PropertyManagementTransaction');
    }

    public function booking()
    {
        return $this->belongsTo('App\Models\PropertyBooking');
    }

    public function auditedBy()
    {
        return $this->belongsTo('App\Models\User', 'audit_user_id');
    }
}
