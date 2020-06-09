<?php

namespace App\Exports;



use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use App\Helpers\ReportExcelHelper;

class GenerateCollectionToExport implements FromCollection, WithHeadings
{

    protected $collection; 
    //protected $heading;

    public function __construct($collections, $heading)
    {
        $this->collection = $collections;
        $this->heading = $heading;
    }
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings(): array {
        return ReportExcelHelper::getHeadings($this->heading);
    }
    public function collection()
    {         
         return $this->collection;        
    }
}