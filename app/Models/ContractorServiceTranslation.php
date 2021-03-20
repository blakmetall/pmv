<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AppModel;

class ContractorServiceTranslation extends Model {

    use AppModel;
    
    protected $table = 'contractors_services_translations';
    public $timestamps = true;
    protected $fillable = [
        'name',
        'description'
    ];

    public function language() {
        return $this->belongsTo('App\Models\Language');
    }

    public function contractorService() {
        return $this->belongsTo('App\Models\ContractorService', 'contractor_service_id');
    }

}