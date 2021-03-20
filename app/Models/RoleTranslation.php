<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AppModel;

class RoleTranslation extends Model {

    use AppModel;

    protected $table = 'roles_translations';
    public $timestamps = false;

    public function language() {
        return $this->belongsTo('App\Models\Language');
    }

    public function role() {
        return $this->belongsTo('App\Models\Role');
    }
}