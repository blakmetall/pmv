<?php 

namespace App\Helpers;

use Config;
use App\Models\PropertyManagementTransaction;

class PMHelper
{
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
        }

        return $query->sum('amount');
    }

    public static function getBalance($pmID, $config = []) {

        $config = array_merge($config, ['skipNotAudited' => true]);
        $totalCredit = self::getTotalCredit($pmID, $config);
        $totalCharge = self::getTotalCharge($pmID, $config);
        $balance = $totalCredit - $totalCharge;

        $config = array_merge($config, ['skipAudited' => true]);
        $totalCredit = self::getTotalCredit($pmID, $config);
        $totalCharge = self::getTotalCharge($pmID, $config);
        $pendingAudit = $totalCredit - $totalCharge;
        // exclude month date??        

        return [
            'balance' => $balance,
            'pendingAudit' => $pendingAudit,
            'estimatedBalance' => $balance + $pendingAudit,
        ];
    }
}