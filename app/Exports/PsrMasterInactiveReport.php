<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;


class PsrMasterInactiveReport implements WithTitle,FromView , ShouldAutoSize
{
   
    protected $inactiveData;

    public function __construct($inactiveData)
    {
        $this->inactiveData = $inactiveData;
    }


       public function view(): View
    {
        return view('back-end.premium.hr-reports.psr-master-report.psr-master-inactive-report', [
            'inactiveData' => $this->inactiveData,
        ]);
    }
    public function title(): string
    {
        return 'Resign PSR';
    }


}
