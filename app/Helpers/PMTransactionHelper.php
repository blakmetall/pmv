<?php 

namespace App\Helpers;

use Config;

class PMTransactionHelper
{
    public static function getTypes()
    {
        return [
            '1' => (object) ['id' => 1, 'label' => __('Payment')],
            '2' => (object) ['id' => 2, 'label' => __('Income')],
        ];
    }

    public static function getTypeById($id) 
    {
        $validTypes = [1, 2];
        $hasValidTypes = in_array($id, $validTypes);

        $types = self::getTypes();

        if($hasValidTypes) {
            return $types[$id]->label;
        }
        return 'operation undefined';
    }
}