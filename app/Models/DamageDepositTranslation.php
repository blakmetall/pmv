<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DamageDepositTranslation extends Model {

    protected $table = 'damage_deposits_translations';
    public $timestamps = false;

    public function damageDeposits() {
        return $this->belongsTo('App\Models\DamageDeposit');
    }
}
