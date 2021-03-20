<?php

namespace App\Helpers;

use App\Models\Workgroup;

class WorkgroupHelper
{

    public static function getAllowedCities()
    {
        $allowedCities = [];
        $user = auth()->user();

        if ($user) {
            $workgroups = $user->workgroups;
            if ($workgroups) {
                foreach ($workgroups as $workgroup) {
                    $allowedCities[] = $workgroup->city_id;
                }
            }
        }

        return $allowedCities;
    }

    public static function hasAccess($city_id)
    {
        if ($city_id) {
            return in_array($city_id, self::getAllowedCities());
        }
        return false;
    }

    public static function shouldFilterByCity()
    {
        $user = auth()->user();

        if ($user) {
            $totalWorkgroups = Workgroup::count();
            $totalUserWorkgroups = $user->workgroups()->count();

            return $totalWorkgroups === $totalUserWorkgroups ? false : true;
        }

        return true;
    }
}
