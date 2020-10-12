<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AppModel;

class Office extends Model {

    use AppModel;

    protected $table = 'offices';
    public $timestamps = false;
    protected $fillable = [
        'state_id',
        'name'
    ];

    public function state() {
        return $this->belongsTo('App\Models\State');
    }

    public function properties() {
        return $this->hasMany('App\Models\Property');
    }

}
