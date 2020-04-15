<?php 

namespace App\Helpers;

use App\Models\User;
use App\Models\Role;
use App\Helpers\RoleHelper;

class UserHelper
{
    public static function isSuper() {
        return RoleHelper::hasValidRoleId( config('constants.roles.super') );
    }
}