<?php

namespace App\Exports;

use App\Models\User;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PsrRecruitmentSummaryReportExport implements  FromView, ShouldAutoSize, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
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
        return view('back-end.premium.hr-reports.psr-recruitment-summary.psr-recruitment-summary-report', [
            'data' => $this->data,
        ]);
    }
}
