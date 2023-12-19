<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PSRMasterReportExport implements WithTitle, FromView, ShouldAutoSize, WithStyles
{

    protected $activeData;

    public function __construct($activeData)
    {
        $this->activeData = $activeData;
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('H3')->getAlignment()->setWrapText(true);
    }

    public function view(): View
    {
        return view('back-end.premium.hr-reports.psr-master-report.psr-master-report', [
            'activeData' => $this->activeData,
        ]);
    }

    public function title(): string
    {
        return 'Active PSR';
    }
}
