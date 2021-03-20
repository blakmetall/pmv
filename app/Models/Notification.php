<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AppModel;

class Notification extends Model {

    use AppModel;
    
    protected $table = 'notifications';
    public $timestamps = true;

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

}