<?php 

namespace App\Helpers;

use Config;

class AppHelper
{
    public static function shouldApplyHttps() {
        return in_array(Config::get('app.env'), ['production', 'staging']);
    }
}