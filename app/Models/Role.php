<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\RoleHelper;
use App\Traits\AppModel;

class Role extends Model {

    use AppModel;

    protected $table = 'roles';
    public $timestamps = false;

    private $allowedSections = [];

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

    public function isAllowed($section, $sub) {
        $hasAllowedSections = !! count($this->allowedSections);

        if (! $hasAllowedSections) {
            $this->setAllowedSections();
        }

        return RoleHelper::isAllowed($this->id, $section, $sub, $this->allowedSections );
    }

    private function setAllowedSections() {
        $this->allowedSections = RoleHelper::getAllowedSections();
    }

}