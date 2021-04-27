<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\RoleHelper;
use App\Traits\AppModel;

class RoleSectionPermission extends Model {

    use AppModel;

    protected $table = 'roles_sections_permissions';
    public $timestamps = false;

    private $allowedSections = [];

    // public function isAllowed($section, $sub) {
    //     $hasAllowedSections = !! count($this->allowedSections);

    //     if (! $hasAllowedSections) {
    //         $this->setAllowedSections();
    //     }

    //     return RoleHelper::isAllowed($this->id, $section, $sub, $this->allowedSections );
    // }

    private function setAllowedSections() {
        // $this->allowedSections = RoleHelper::getAllowedSections();
    }

}