<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class EmployeeReportExport implements FromView, ShouldAutoSize, WithStyles
{
    public function __construct($data)
    {
        $this->data = $data;
    }
    public function styles(Worksheet $sheet)
    {
        // $sheet->getStyle('U2')->getAlignment()->setWrapText(true);
        // $sheet->getStyle('AA1')->getAlignment()->setWrapText(true);
        // $sheet->getStyle('AE1')->getAlignment()->setWrapText(true);
        // $sheet->getStyle('AF1')->getAlignment()->setWrapText(true);
    }
    public function view(): View
    {
        return view('back-end.premium.hr-reports.employee-report.employee-bulk-report-excel', [
            'data' => $this->data,
        ]);
    }
}
