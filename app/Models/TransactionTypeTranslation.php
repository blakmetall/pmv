<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionTypeTranslation extends Model {

    protected $table = 'transaction_types_translations';
    public $timestamps = false;

    public function language() {
        return $this->belongsTo('App\Models\Language');
    }

    public function transactionType() {
        return $this->belongsTo('App\Models\TransactionType');
    }
}
