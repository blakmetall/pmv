<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AppModel;

class TransactionType extends Model {

    use AppModel;

    protected $table = 'transaction_types';
    public $timestamps = false;

    public $en;
    public $es;

    public function languages() {
        return $this->belongsToMany('App\Models\Language', 'transaction_types_translations')
            ->withPivot('name');
    }

    public function translations() {
        return $this->hasMany('App\Models\TransactionTypeTranslation');
    }

    public function managementTransactions(){
        return $this->hasMany('App\Models\PropertyManagementTransaction');
    }
}