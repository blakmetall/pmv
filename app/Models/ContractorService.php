<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AppModel;

class ContractorService extends Model {

    use AppModel;
    
    protected $table = 'contractors_services';
    public $timestamps = true;
    protected $fillable = [
        'contractor_id',
        'base_price',
    ];

    public $en;
    public $es;

    public function languages() {
        return $this->belongsToMany('App\Models\Language', 'contractors_services_translations')
            ->withPivot('name', 'description');
    }

    public function translations() {
        return $this->hasMany('App\Models\ContractorServiceTranslation', 'contractor_service_id');
    }

    public function contractor() {
        return $this->belongsTo('App\Models\Contractor');
    }

    public function propertyManagementTransactions() {
        return $this->hasMany('App\Models\PropertyManagementTransaction');
    }

}