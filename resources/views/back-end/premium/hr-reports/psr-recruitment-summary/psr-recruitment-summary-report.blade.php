@php
    use App\Models\WorkExperience;
    use App\Models\Qualification;
@endphp
<style>

</style>
<table>
    <thead>
        <tr>
            <td rowspan=3 style="vertical-align: middle; text-align: center; border: 1px solid black">SL</td>
            <td rowspan=3
                style="vertical-align: middle; background-color:#0070C0; text-align: center; border: 1px solid black">
                Month </td>
            <td rowspan=3 style="vertical-align: middle; text-align: center; border: 1px solid black">Assigned Terrrtory
            </td>
            <td rowspan=3 style="vertical-align: middle;text-align: center; border: 1px solid black"> Assigned SE Area
            </td>
            <td rowspan=3 style="vertical-align: middle;text-align: center; border: 1px solid black">Placement DB </td>
            <td rowspan=3 style="vertical-align: middle;text-align: center; border: 1px solid black">Candidates Name
            </td>
            <td rowspan=3
                style="vertical-align: middle; background-color:#FFFF00; text-align: center; border: 1px solid black">ID
            </td>
            <td rowspan=3
                style="vertical-align: middle; background-color:#90EE90; text-align: center; border: 1px solid black">DOJ
            </td>
            <td rowspan=3 style="vertical-align: middle; text-align: center; border: 1px solid black">Mobile </td>
            <td colspan=2 style="vertical-align: middle; text-align: center; border: 1px solid black">Total Year of
                Experience Year </td>
            <td rowspan=3 style="vertical-align: middle; text-align: center; border: 1px solid black">Current/Last
                Company </td>
            <td rowspan=3
                style="vertical-align: middle;text-align: center; background-color:#FF0000;  width: 250px; border: 1px solid black">
                Current/Last Salary including TA DA (Without Incentive) </td>
            <td rowspan=3 style="vertical-align: middle;text-align: center; border: 1px solid black">Date of Birth </td>
            <td colspan=4
                style="vertical-align: middle; text-align: center; background-color:#FFFF00; border: 1px solid black">
                Education </td>
        </tr>
        <tr>
            <td rowspan=2
                style="background-color:#FF0000;text-align: center; vertical-align: middle;  border: 1px solid black">
                Fresh candidates </td>

            <td rowspan=2 style="vertical-align: middle;text-align: center; border: 1px solid black">Total Years </td>
            <td colspan=2 style="vertical-align: middle;text-align: center; width: 100px; border: 1px solid black">Under
                graduate </td>
            <td colspan=2 style="vertical-align: middle;text-align: center; border: 1px solid black"></td>
        </tr>
        <tr>
            <td style="vertical-align: middle;text-align: center; border: 1px solid black">SSC </td>
            <td style="vertical-align: middle;text-align: center; border: 1px solid black">HSC </td>
            <td style="vertical-align: middle;text-align: center; border: 1px solid black">Pass/ Hons Master </td>
            <td style="vertical-align: middle;text-align: center; border: 1px solid black"> Institution </td>
        </tr>
    </thead>
    {{-- Tbody Start --}}
    <tbody>
        @foreach ($data['employees'] as $employee)
            <tr>
                <td style=" border: 1px solid black">{{ $loop->iteration }} </td>
                <td style=" border: 1px solid black">{{ date('M-y', strtotime($employee->joining_date)) }} </td>
                <td style=" border: 1px solid black">{!! htmlentities($employee->userterritory->territory_name ?? '', ENT_QUOTES) !!}</td>
                <td style=" border: 1px solid black">{!! htmlentities($employee->userarea->area_name ?? '', ENT_QUOTES) !!} </td>
                <td style=" border: 1px solid black">
                    @if ($employee->userdbhouse)
                        {!! htmlentities($employee->userdbhouse->db_house_name ?? '', ENT_QUOTES) !!}
                    @endif
                </td>
                <td style=" border: 1px solid black">{{ $employee->first_name . ' ' . $employee->last_name }} </td>
                <td style=" border: 1px solid black">{{ $employee->company_assigned_id }} </td>
                <td style=" border: 1px solid black">{{ $employee->joining_date }} </td>
                <td style=" border: 1px solid black">{{ $employee->phone }} </td>
                <td style="background-color:#FF0000;  border: 1px solid black">
                    @if ($employee->emoloyeedetail)
                        @if ($employee->emoloyeedetail->previous_organization == '')
                            {{ 'Fresh' }}
                        @endif
                    @endif
                </td>

                <td style=" border: 1px solid black">
                    @php
                        $work_expriences = WorkExperience::where('work_experience_employee_id', $employee->id)->sum('total_year_of_experience');
                        echo $work_expriences;
                    @endphp
                </td>
                <td style=" border: 1px solid black">
                    @if ($employee->emoloyeedetail)
                        {!! htmlentities($employee->emoloyeedetail->previous_organization ?? '', ENT_QUOTES) !!}
                    @endif
                </td>
                <td style="background-color:#FF0000;  border: 1px solid black">
                    @if ($employee->emoloyeedetail)
                        {{ $employee->emoloyeedetail->last_salary ?? '' }}
                    @endif
                </td>
                <td style=" border: 1px solid black">{{ $employee->date_of_birth }} </td>
                <td style=" border: 1px solid black">@php
                    $qualification = Qualification::where('qualification_employee_id', $employee->id)->get();
                    foreach ($qualification as $item) {
                        if ($item->qualification_education_level == 'SSC') {
                            echo $item->qualification_education_level;
                        }
                    }
                @endphp </td>
                <td style=" border: 1px solid black">@php
                    $qualification = Qualification::where('qualification_employee_id', $employee->id)->get();
                    foreach ($qualification as $item) {
                        if ($item->qualification_education_level == 'HSC') {
                            echo $item->qualification_education_level;
                        }
                    }
                @endphp </td>
                <td style=" border: 1px solid black">@php
                    $qualification = Qualification::where('qualification_employee_id', $employee->id)->get();
                    foreach ($qualification as $item) {
                        if ($item->qualification_education_level == 'BA' || $item->qualification_education_level == 'Dakhil' || $item->qualification_education_level == 'BBS' || $item->qualification_education_level == 'BBA' || $item->qualification_education_level == 'MBA') {
                            echo $item->qualification_education_level;
                        }
                    }
                @endphp </td>
                <td style=" border: 1px solid black">
                    {!! e($employee->educationdetail->qualification_institute_name ?? '') !!}</td>
            </tr>
        @endforeach
    </tbody>
</table>
