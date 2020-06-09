<?php

namespace App\Exports;

use App\Helpers\ReportExcelHelper;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class HumanResourcesExport
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public static function generate($data) {

        $fileName = 'human_resources_' . strtotime('now');        
        //$columns = self::getColumns();
        $collection = collect($data);

        return ReportExcelHelper::generate($collection, $fileName);
        
    }

    public static function getColumns() {
        $columns = [
            'firstname' => 'FirstName',
            'lastname' => 'LastName',
            'address' => 'Address',
        ];

        return $columns;
    }
}