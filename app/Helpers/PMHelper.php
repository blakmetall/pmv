<?php 

namespace App\Helpers;

use Config;
use App\Models\PropertyManagementTransaction;

class PMHelper
{
    public static function getTotalCredit($propertyManagementId) {
        return PropertyManagementTransaction::
            where('property_management_id', $propertyManagementId)
            ->where('operation_type', config('constants.operation_types.credit'))
            ->sum('amount');
    }

    public static function getTotalCharge($propertyManagementId) {
        return PropertyManagementTransaction::
            where('property_management_id', $propertyManagementId)
            ->where('operation_type', config('constants.operation_types.charge'))
            ->sum('amount');
    }

    public static function getPendingAuditsSubtotal($propertyManagementId) {
        $pendingCredit = PropertyManagementTransaction::
            where('property_management_id', $propertyManagementId)
            ->where('operation_type', config('constants.operation_types.credit'))
            ->where('audit_user_id', null)
            ->sum('amount');

        $pendingCharge = PropertyManagementTransaction::
            where('property_management_id', $propertyManagementId)
            ->where('operation_type', config('constants.operation_types.charge'))
            ->where('audit_user_id', null)
            ->sum('amount');

        return $pendingCredit - $pendingCharge;
    }

    public static function getOperationsSubtotal($propertyManagementId) {
        return self::getTotalCredit($propertyManagementId) -  self::getTotalCharge($propertyManagementId);
    }

    public static function getPropertyManagementBalance($propertyManagementId) {
        $totalCredit = self::getTotalCredit($propertyManagementId);
        $totalCharge = self::getTotalCharge($propertyManagementId);
        $subtotal = $totalCredit - $totalCharge;
        $pendingAuditsSubtotal = self::getPendingAuditsSubtotal($propertyManagementId);

        return [
            'totalCredit' => $totalCredit,
            'totalCharge' => $totalCharge,
            'pendingAuditsSubtotal' => $pendingAuditsSubtotal,
            'subtotal' => $subtotal,
        ];
    }
}