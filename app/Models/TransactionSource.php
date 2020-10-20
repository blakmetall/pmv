<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AppModel;

class TransactionSource extends Model
{

    use AppModel;

    protected $table = 'transaction_sources';
    public $timestamps = false;

    public $en;
    public $es;

    public function languages()
    {
        return $this->belongsToMany('App\Models\Language', 'transaction_sources_translations')
            ->withPivot('name');
    }

    public function translations()
    {
        return $this->hasMany('App\Models\TransactionSourceTranslation');
    }
}
