<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AppModel;

class TransactionTypeTranslation extends Model {

    use AppModel;

    protected $table = 'transaction_types_translations';
    public $timestamps = false;

    public function language() {
        return $this->belongsTo('App\Models\Language');
    }

    public function transactionType() {
        return $this->belongsTo('App\Models\TransactionType');
    }
}