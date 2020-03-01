<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AppModel;

class Profile extends Model {

    use AppModel;
    
    protected $table = 'profiles';
    public $timestamps = true;

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}