<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AppModel;

class PaymentMethodTranslation extends Model {

    use AppModel;

    protected $table = 'payment_methods_translations';
    public $timestamps = false;
    protected $fillable = [
        'title',
        'description',
    ];

    public function language() {
        return $this->belongsTo('App\Models\Language');
    }

    public function paymentMethod() {
        return $this->belongsTo('App\Models\PaymentMethod');
    }

}