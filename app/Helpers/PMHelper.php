<?php 

namespace App\Helpers;

use Config;
use App\Models\PropertyManagementTransaction;

class PMHelper
{
    public static function getTotalCredit($pmID, $config = []) {
        $query = PropertyManagementTransaction::
            where('property_management_id', $pmID)
            ->where('operation_type', config('constants.operation_types.credit'));

        if (isset($config['skipAudited']) && $config['skipAudited']) {
            $query->whereNull('audit_user_id');
        }

        if (isset($config['skipNotAudited']) && $config['skipNotAudited']) {
            $query->whereNotNull('audit_user_id');
        }
        
        return $query->sum('amount');
    }

    public static function getTotalCharge($pmID, $config = []) {
        $query = PropertyManagementTransaction::
            where('property_management_id', $pmID)
            ->where('operation_type', config('constants.operation_types.charge'));

        if (isset($config['skipAudited']) && $config['skipAudited']) {
            $query->whereNull('audit_user_id');
        }

        if (isset($config['skipNotAudited']) && $config['skipNotAudited']) {
            $query->whereNotNull('audit_user_id');
        }

        return $query->sum('amount');
    }

    public static function getBalance($pmID, $config = []) {

        $config = ['skipNotAudited' => true];
        $totalCredit = self::getTotalCredit($pmID, $config);
        $totalCharge = self::getTotalCharge($pmID, $config);
        $balance = $totalCredit - $totalCharge;

        $config = ['skipAudited' => true];
        $totalCredit = self::getTotalCredit($pmID, $config);
        $totalCharge = self::getTotalCharge($pmID, $config);
        $pendingAudit = $totalCredit - $totalCharge;

        return [
            'balance' => $balance,
            'pendingAudit' => $pendingAudit,
            'estimatedBalance' => $balance + $pendingAudit,
        ];
    }
}