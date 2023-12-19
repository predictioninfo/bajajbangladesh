<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class ActivePsrReportExport implements  FromView ,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct($data)
    {
       $this->data = $data ;
    }

    public function view(): View {
      return view('back-end.premium.hr-reports.active-psr-report.active-psr-report', ['data' => $this->data,]);
    }
}
