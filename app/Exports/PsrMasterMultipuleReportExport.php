<?php

namespace App\Exports;
use Auth;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;


class PsrMasterMultipuleReportExport implements WithMultipleSheets ,ShouldAutoSize

{


    public function sheets(): array
    {
        $sheets = [];

        $activeData =  User::with('userdepartment','userDivision','userDistrict','userUpazila','userUnion','bankaccount','salaryconfig', 'educationdetail','userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory','emoloyeedetail', 'emergencyContact','bankaccount')
        ->where('com_id', Auth::user()->com_id)
        ->whereNull('company_profile')
        ->where('is_active', 1)
        ->get();

        $inactiveData =  User::with('userdepartment','userDivision','userDistrict','userUpazila','userUnion','bankaccount','salaryconfig', 'educationdetail','userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory','emoloyeedetail', 'emergencyContact','bankaccount')
        ->where('com_id', Auth::user()->com_id)
        ->whereNull('company_profile')
        ->where('is_active', 0)
        ->get();

        $sheets[] = new PSRMasterReportExport($activeData);
        $sheets[] = new PsrMasterInactiveReport($inactiveData);

        return $sheets;
    }

}