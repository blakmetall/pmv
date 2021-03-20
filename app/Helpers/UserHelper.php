<?php 

namespace App\Helpers;

class UserHelper
{
    public static function getCurrentUserID() {
        $user = auth()->user();
    
        if($user) {
            return $user->id;
        }

        return null;
    }
}