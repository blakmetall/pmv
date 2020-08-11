<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AppModel;

class Building extends Model
{

    use AppModel;

    protected $table = 'buildings';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'description'
    ];

    public function properties()
    {
        return $this->hasMany('App\Models\Property', 'building_id', 'id');
    }
}
