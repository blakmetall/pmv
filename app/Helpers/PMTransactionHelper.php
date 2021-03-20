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

    public static function monthHasTransactions($pmID, $month, $year) {
        $foundTransactions = PropertyManagementTransaction::
            where('property_management_id', $pmID)
            ->whereYear('post_date', $year)
            ->whereMonth('post_date', $month)
            ->count();

        if($foundTransactions) {
            return true;
        } 

        return false;
    }
}