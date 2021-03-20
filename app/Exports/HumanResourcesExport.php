<?php

namespace App\Exports;

// use Maatwebsite\Excel\Excel;
// use Maatwebsite\Excel\Concerns\FromCollection;
// use Maatwebsite\Excel\Concerns\Exportable;
// use Maatwebsite\Excel\Concerns\WithMapping;

class HumanResourcesExport // implements WithMapping, FromCollection
{
    // use Exportable;

    // private $writerType = Excel::XLSX;
    // private $headers = ['Content-Type' => 'text/csv'];
    
    // protected $collection = [];
    // protected $fileName = '';

    // public function __construct($collection)
    // {
    //     $this->collection = $collection;
    //     $this->fileName = 'human-resources-' . strtotime('now') . '.xlsx';
    // }

    // public function map($row): array
    // {
    //     return [
    //         $row->firstname,
    //         $row->lastname,
    //         $row->address,
    //         $row->department,
    //         $row->entry_at,
    //         $row->birthday,
    //         $row->vacation_start_at,
    //         $row->vacation_end_at,
    //         $row->vacation_days,
    //         $row->children,
    //         $row->is_active,
    //         $row->created_at,
    //         $row->updated_at,
    //     ];
    // }

    // // public function columnFormats(): array
    // // {
    // //     return [
    // //         'A' => NumberFormat::FORMAT_DATE_DDMMYYYY,
    // //         'B' => NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE,
    // //     ];
    // // }

    // public function collection()
    // {
    //     return $this->collection;
    // }
}