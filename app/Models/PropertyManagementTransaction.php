<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AppModel;

class PropertyManagementTransaction extends Model {

    use AppModel;
    
    protected $table = 'property_management_transactions';
    public $timestamps = true;
    protected $fillable = [
        'property_management_id',
        'transaction_type_id',
        'contractor_service_id',
        'period_start_date',
        'period_end_date',
        'post_date',
        'amount',
        'description',
    ];

    public function propertyManagement() {
        return $this->belongsTo('App\Models\PropertyManagement');
    }

    public function type() {
        return $this->hasOne('App\Models\TransactionType');
    }

    public function auditedBy() {
        return $this->belongsTo('App\Models\User', 'audit_user_id');
    }

    public function cleaningServices() {
        return $this->hasMany('App\Models\CleaningService');
    }

    public function contractorService() {
        return $this->belongsTo('App\Models\ContractorService', 'contractor_service_id');
    }

    public function payment() {
        return $this->belongsTo('App\Models\PropertyManagementPayment');
    }
}