<style>
    th,
    td {
        padding: 5px;
    }

    th {
        text-align: left;
    }
</style>


<div>

    <div class="header-logo">
        <div>
            <img style="max-height: 70px;" src="{{ public_path($probation->company->company_logo ?? null) }}" />
        </div>
    </div>
<br>
<?php
$date = date('j F, Y');

?>

    Date: {{ $date }} <br><br>
    Name: {{ $probation->first_name . ' ' . $probation->last_name }} <br>
    Designation: {{ $probation->userdesignation->designation_name ?? null }} <br>
    Department: {{ $probation->userdepartment->department_name ?? null }} <br><br>
    <span style="font-weight:bold;"> Subject: {{ $probation->probationLetter->probation_letter_format_subject ?? null }}</span><br><br>

    Dear {{ $probation->first_name . ' ' . $probation->last_name }} ,<br><br>

    <div>{!! $probation->probationLetter->probation_letter_format_body ?? null !!}</div>


    @foreach($employees as $value)
    <span> Amount of salary increased is BDT. {{  $incrementSalary->increment_amount ?? ''}} /- </span><span>
    <span > with the following particulars: </span> <span><br><br>

        @if($probation->salaryconfig->salary_config_basic_salary>0)
        <div style="padding-left:120px">
        <table class="table" style="width:70%">
            <tbody>
                <?php
                if ($probation->gross_salary) {
                    $gross_salary = $probation->gross_salary ?? null;
                }else{
                    $gross_salary = 0;
                }

                 $basic_salay = 0;
                 $medical_allowence = 0;
                 $house_rent = 0;
                 $mobile_bill = 0;
                 $convence_allowance = 0;
                 $festival_bonus = 0;
                ?>
                @if($probation->salaryconfig->salary_config_basic_salary>0)
                <tr style="border: 1px solid black; border-collapse: collapse;">
                    <td style="border: 1px solid black;font-size: 12px;" colspan="4">Basic Salary</td>
                    <td style="border: 1px solid black;text-align:right;font-size: 12px; " colspan="4">{{ $basic_salay =
                        ($gross_salary*$probation->salaryconfig->salary_config_basic_salary)/100
                        }} BDT</td>
                </tr>
                @endif

                @if($probation->salaryconfig->salary_config_medical_allowance>0)
                <tr style="border: 1px solid black; border-collapse: collapse;">
                    <td style="border: 1px solid black;font-size: 12px;" colspan="4">Medical allowance</td>
                    <td style="border: 1px solid black;text-align:right;font-size: 12px; " colspan="4">{{ $medical_allowence =
                        ($gross_salary*$probation->salaryconfig->salary_config_medical_allowance)/100}} BDT
                    </td>
                </tr>
                @endif
                @if($probation->salaryconfig->salary_config_house_rent_allowance>0)
                <tr style="border: 1px solid black; border-collapse: collapse;">
                    <td style="border: 1px solid black;font-size: 12px;" colspan="4">House Rent</td>
                    <td style="border: 1px solid black;text-align:right;font-size: 12px; " colspan="4">{{ $house_rent =
                        ($gross_salary*$probation->salaryconfig->salary_config_house_rent_allowance)/100}} BDT
                    </td>
                </tr>
                @endif

                @if($probation->salaryconfig->salary_config_conveyance_allowance>0)
                <tr style="border: 1px solid black; border-collapse: collapse;">
                    <td style="border: 1px solid black;font-size: 12px;" colspan="4">Convence Allowance</td>
                    <td style="border: 1px solid black;text-align:right;font-size: 12px; " colspan="4">{{ $convence_allowance =
                        ($gross_salary*$probation->salaryconfig->salary_config_conveyance_allowance)/100}} BDT
                    </td>
                </tr>
                @endif

                <tr style="border: 1px solid black; border-collapse: collapse;">
                    <td style="border: 1px solid black;font-size: 12px;" colspan="4">Total</td>
                    <td style="border: 1px solid black;text-align:right;font-size: 12px; " colspan="4">{{$basic_salay+$medical_allowence+$house_rent+$convence_allowance}} BDT
                    </td>
                </tr>

            </tbody>
        </table>
        </div>

            @else

            @endif
            @endforeach
    </div>
    <br><br>

    <span > These changes will come into effect  from {{  $incrementSalary->increment_date ?? ''}} .</span> <span><br><br>

    <div>{!! $probation->probationLetter->probation_letter_format_extra_feature ?? null !!}</div> <br><br>

    Yours sincerely,<br><br>

    <div class="col-md-12" id="draggable13">
            <img src="{{public_path($probation->probationLetter->probation_letter_format_signature ?? '')}}" alt="Signature"
                style="width:50px;height:20px; padding-left:30px;"><br>
            <span style="background-color:white;color:black;font-weight:bold;">__________________________</span><br>
        </div>
    <div>
        {{ $probation->probationLetter->probitionSignatory->first_name ?? null }}
        {{ $probation->probationLetter->probitionSignatory->last_name ?? null }}
        <br><br>
        {{ $probation->company->company_name ?? null }}<br>
    </div>


</div>
