<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {

    protected $table = 'roles';
    public $timestamps = false;

    public function languages() {
        return $this->belongsToMany('App\Models\Language', 'roles_translations')
            ->withPivot('name');
    }

    public function translations() {
        return $this->hasMany('App\Models\RoleTranslation');
    }

    public function users(){
        return $this->belongsToMany('App\Models\User', 'user_has_roles');
    }
}
