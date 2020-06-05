<?php 

namespace App\Helpers;

use Config;
use App\Models\PropertyManagementTransaction;

class PMTransactionHelper
{
    public static function getTypes()
    {
        $chargeID = config('constants.operation_types.charge');
        $creditID = config('constants.operation_types.credit');

        return [
            $chargeID => (object) ['id' => $chargeID, 'label' => __('Charge')],
            $creditID => (object) ['id' => $creditID, 'label' => __('Credit')],
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