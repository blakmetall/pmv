<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AppModel;

class WorkgroupUser extends Model {

    use AppModel;
    
    protected $table = 'workgroup_has_users';
    public $timestamps = false;
    protected $fillable = [
        'workgroup_id',
        'user_id',
    ];

    public function workgroup() {
        return $this->belongsTo('App\Models\Workgroup');
    }

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

}