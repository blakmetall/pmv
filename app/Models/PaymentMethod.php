<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AppModel;

class PaymentMethod extends Model {

    use AppModel;

    protected $table = 'payment_methods';
    public $timestamps = false;

    protected $fillable = [
        'icon',
    ];
    
    public $en;
    public $es;

    public function languages() {
        return $this->belongsToMany('App\Models\Language', 'payment_methods_translations')
            ->withPivot('title');
    }

    public function translations() {
        return $this->hasMany('App\Models\PaymentMethodTranslation');
    }
}