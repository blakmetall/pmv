<?php

namespace App\Traits;

trait AppModel {

    public function _getTable() { 
        return $this->table; 
    }

}