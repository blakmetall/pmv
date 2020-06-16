<?php 

namespace App\Helpers;

class AppHelper
{
    public static function shouldApplyHttps() {
        return hasSSL();
    }
}