<?php

namespace App\Traits;

use App\Helpers\LanguageHelper;

trait AppModel {

    public function _getTable() { 
        return $this->table; 
    }

    public function hasTranslation() {
        $language_id = LanguageHelper::getId( LanguageHelper::getLocale() );
        return $this->translations()->where('language_id', $language_id)->count();
    }

    public function translate() {
        $language_id = LanguageHelper::getId( LanguageHelper::getLocale() );
        return $this->translations()->where('language_id', $language_id)->first();
    }
    
}