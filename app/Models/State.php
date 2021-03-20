<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AppModel;

class State extends Model
{

    use AppModel;

    protected $table = 'states';
    public $timestamps = false;

    public function cities()
    {
        return $this->hasMany('App\Models\City');
    }

    public function properties()
    {
        return $this->hasMany('App\Models\Property');
    }
}
