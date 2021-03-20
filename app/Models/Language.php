<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AppModel;

class Language extends Model {

    use AppModel;
    
    protected $table = 'languages';
    public $timestamps = false;

    public function roles() {
        return $this->belongsToMany('App\Models\Role', 'roles_translations')
            ->withPivot('name');
    }

    public function amenities() {
        return $this->belongsToMany('App\Models\Amenity', 'amenities_translations')
            ->withPivot('name');
    }

    public function cleaningOptions() {
        return $this->belongsToMany('App\Models\CleaningOption', 'cleaning_options_translations')
            ->withPivot('name');
    }

    public function damageDeposits() {
        return $this->belongsToMany('App\Models\DamageDeposit', 'damage_deposits_translations')
            ->withPivot('description');
    }

    public function properties() {
        return $this->belongsToMany('App\Models\Property', 'properties_translations')
            ->withPivot('name', 'description', 'cancellation_policies');
    }

    public function transactionTypes() {
        return $this->belongsToMany('App\Models\TransactionType', 'transaction_types_translations')
            ->withPivot('name');
    }

    public function zones() {
        return $this->belongsToMany('App\Models\Zone', 'zones_translations')
            ->withPivot('name');
    }

    public function contractorsServices() {
        return $this->belongsToMany('App\Models\ContractorService', 'contractors_services_translations', 'contractor_service_id')
            ->withPivot('name', 'description');
    }
}