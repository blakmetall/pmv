<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AppModel;

class ContractorService extends Model {

    use AppModel;
    
    protected $table = 'contractors_services';
    public $timestamps = true;

    public function languages() {
        return $this->belongsToMany('App\Models\Language', 'contractors_services_translations')
            ->withPivot('name', 'description');
    }

    public function translations() {
        return $this->hasMany('App\Models\ContractorServiceTranslation', 'contractor_service_id');
    }

    public function contractor() {
        return $this->belongsToMany('App\Models\Contractor');
    }

    public function propertyManagementTransactions() {
        return $this->hasMany('App\Models\PropertyManagementTransaction');
    }

}