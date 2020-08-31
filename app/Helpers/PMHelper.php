<?php 

namespace App\Helpers;

use Config;
use App\Models\PropertyManagementTransaction;
use App\Models\PropertyManagement;

class PMHelper
{
    public static function getInitialBalance($pmID) {
        $pm = PropertyManagement::find($pmID);
        
        if($pm) {
            return $pm->initial_balance;
        }

        return 0;
    }

    public static function getTotalCredit($pmID, $config = []) {
        $shouldFilterByYear = isset($config['filterByYear']) ? $config['filterByYear'] : '';
        $shouldFilterByMonth = isset($config['filterByMonth']) ? $config['filterByMonth'] : '';

        $query = PropertyManagementTransaction::
            where('property_management_id', $pmID)
            ->where('operation_type', config('constants.operation_types.credit'));

        if (isset($config['skipAudited']) && $config['skipAudited']) {
            $query->whereNull('audit_user_id');
        }

        if (isset($config['skipNotAudited']) && $config['skipNotAudited']) {
            $query->whereNotNull('audit_user_id');
        }

        if($shouldFilterByYear && $shouldFilterByMonth) {
            $filterDate = $config['filterByYear'] . '-' . $config['filterByMonth'] . '-01';
            $query->where('post_date', '<', $filterDate);
        }
        
        return $query->sum('amount');
    }

    public static function getTotalCharge($pmID, $config = []) {
        $shouldFilterByYear = isset($config['filterByYear']) ? $config['filterByYear'] : '';
        $shouldFilterByMonth = isset($config['filterByMonth']) ? $config['filterByMonth'] : '';
        $skipOldNotAudited = isset($config['skipOldNotAudited']) ? $config['skipOldNotAudited'] : '';

        $query = PropertyManagementTransaction::
            where('property_management_id', $pmID)
            ->where('operation_type', config('constants.operation_types.charge'));

        if (isset($config['skipAudited']) && $config['skipAudited']) {
            $query->whereNull('audit_user_id');
        }

        if (isset($config['skipNotAudited']) && $config['skipNotAudited']) {
            $query->whereNotNull('audit_user_id');
        }

        if($shouldFilterByYear && $shouldFilterByMonth) {
            $filterDate = $config['filterByYear'] . '-' . $config['filterByMonth'] . '-01';
            $query->where('post_date', '<', $filterDate);

            if($skipOldNotAudited) {
                $query->whereNotNull('audit_user_id');
            }
        }

        return $query->sum('amount');
    }

    public static function getBalance($pmID, $config = []) {
        $baseConfig = $config;

        $initialBalance = self::getInitialBalance($pmID);

        $config = array_merge($baseConfig, ['skipNotAudited' => true]);
        $totalCredit = self::getTotalCredit($pmID, $config);
        $totalCharge = self::getTotalCharge($pmID, $config);
        $balance = $initialBalance + $totalCredit - $totalCharge;

        $config = array_merge($baseConfig, ['skipAudited' => true]);
        $totalCredit = self::getTotalCredit($pmID, $config);
        $totalCharge = self::getTotalCharge($pmID, $config);
        $pendingAudit = $initialBalance + $totalCredit - $totalCharge;

        return [
            'balance' => $balance,
            'pendingAudit' => $pendingAudit,
            'estimatedBalance' => $balance + $pendingAudit,
        ];
    }
}