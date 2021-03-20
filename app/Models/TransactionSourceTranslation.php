<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AppModel;

class TransactionSourceTranslation extends Model
{

    use AppModel;

    protected $table = 'transaction_sources_translations';
    public $timestamps = false;
    protected $fillable = [
        'name'
    ];

    public function language()
    {
        return $this->belongsTo('App\Models\Language');
    }

    public function transactionSource()
    {
        return $this->belongsTo('App\Models\TransactionSource');
    }
}
