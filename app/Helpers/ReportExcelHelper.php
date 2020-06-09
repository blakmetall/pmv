<?php 

namespace App\Helpers;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\GenerateCollectionToExport;



class ReportExcelHelper
{
    public static function generate($data, $fileName) {   
        return Excel::download(new GenerateCollectionToExport($data, $fileName), $fileName.'_'.strtotime("now").'.xls');
    }

    public static function getHeadings($heding){
        $hedings = [
            'human-resources'  => [
                'id',
                'city_id',
                'address',
                'firstname',
                'lastname',
                'department',
                'entry_at',
                'birthday',
                'vacations_start_at',
                'vacations_end_at',
                'days_vacations',
                'children',
                'is_active'
            ],
            'properties'  => [
                'Colum_1',
                'Colum_2',
                'Colum_3',
                'name',
                'description',
                'description'
            ]            
        ];
        
        return $hedings[$heding];
    }
}