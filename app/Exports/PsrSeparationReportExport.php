<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PsrSeparationReportExport implements FromView, ShouldAutoSize, WithStyles
{
    public function __construct($data)
    {
        $this->data = $data;
    }
    public function styles(Worksheet $sheet)
    {

        $sheet->getStyle('C1')->getAlignment()->setWrapText(true);
        $sheet->getStyle('J2')->getAlignment()->setWrapText(true);
        $sheet->getStyle('S1')->getAlignment()->setWrapText(true);
        $sheet->getStyle('T3')->getAlignment()->setWrapText(true);
        $sheet->getStyle('U2')->getAlignment()->setWrapText(true);
    }

    public function view(): View
    {
        return view('back-end.premium.hr-reports.separation.separation-report-downlaod', [
            'data' => $this->data,
        ]);
    }
}
