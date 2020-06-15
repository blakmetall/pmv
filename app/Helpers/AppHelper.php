<?php 

namespace App\Helpers;

use Config;

class AppHelper
{
    public static function shouldApplyHttps() {
        return hasSSL();
    }
}