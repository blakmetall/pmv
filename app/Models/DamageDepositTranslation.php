<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AppModel;

class DamageDepositTranslation extends Model {

    use AppModel;
    
    protected $table = 'damage_deposits_translations';
    public $timestamps = false;

    public function damageDeposits() {
        return $this->belongsTo('App\Models\DamageDeposit');
    }
}