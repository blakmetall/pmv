<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContractorServiceTranslation extends Model {

    protected $table = 'contractors_services_translations';
    public $timestamps = true;

    public function language() {
        return $this->belongsTo('App\Models\Language');
    }

    public function contractorService() {
        return $this->belongsTo('App\Models\ContractorService', 'contractor_service_id');
    }

}
