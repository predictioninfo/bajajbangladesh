<style>
    th,
    td {
        padding: 5px;
    }

    th {
        text-align: left;
    }
</style>

@if( $employees->cirtificate_format_id)
<div>

    <?php
$date = date('j F, Y');

?>

    {{-- <div class="header-logo">
        <div>
            <img style="max-height: 50px;" src="{{ asset($user->company->company_logo ?? null) }}" />
        </div>
    </div> --}}
    <br>

    Date: {{ $date }} <br><br>
    Name: {{ $user->first_name . ' ' . $user->last_name }} <br>
    Designation: {{ $employees->designationdetails->designation_name ?? null }} <br>
    Department: {{ $employees->departmentdetails->department_name ?? null }} <br><br>
    <span style="font-weight:bold;"> Subject: <b>{{ $employees->letterFormat->subject ?? ''}}</b></span><br><br>

    Dear {{ $user->first_name . ' ' . $user->last_name }} ,<br><br>

    <p> {!! strip_tags($employees->letterFormat->body) ?? null !!}</p>
    <p>The amount of your salary increased is BDT. {{ $employees->increment_amount ?? ''}} TK.</p>

    <br>

    @if($user->salaryconfig->salary_config_basic_salary>0)
    <div style="padding-left:120px">
        <table class="table" style="width:70%">
            <tbody>
                <?php
                if ($user->gross_salary) {
                    $gross_salary = $user->gross_salary ?? null;
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
                @if($user->salaryconfig->salary_config_basic_salary>0)
                <tr style="border: 1px solid black; border-collapse: collapse;">
                    <td style="border: 1px solid black;font-size: 12px;" colspan="4">Basic Salary</td>
                    <td style="border: 1px solid black;text-align:right;font-size: 12px; " colspan="4">{{ $basic_salay =
                        ($gross_salary*$user->salaryconfig->salary_config_basic_salary)/100
                        }} BDT</td>
                </tr>
                @endif

                @if($user->salaryconfig->salary_config_medical_allowance>0)
                <tr style="border: 1px solid black; border-collapse: collapse;">
                    <td style="border: 1px solid black;font-size: 12px;" colspan="4">Medical allowance</td>
                    <td style="border: 1px solid black;text-align:right;font-size: 12px; " colspan="4">{{
                        $medical_allowence =
                        ($gross_salary*$user->salaryconfig->salary_config_medical_allowance)/100}} BDT
                    </td>
                </tr>
                @endif
                @if($user->salaryconfig->salary_config_house_rent_allowance>0)
                <tr style="border: 1px solid black; border-collapse: collapse;">
                    <td style="border: 1px solid black;font-size: 12px;" colspan="4">House Rent</td>
                    <td style="border: 1px solid black;text-align:right;font-size: 12px; " colspan="4">{{ $house_rent =
                        ($gross_salary*$user->salaryconfig->salary_config_house_rent_allowance)/100}} BDT
                    </td>
                </tr>
                @endif

                @if($user->salaryconfig->salary_config_conveyance_allowance>0)
                <tr style="border: 1px solid black; border-collapse: collapse;">
                    <td style="border: 1px solid black;font-size: 12px;" colspan="4">Convence Allowance</td>
                    <td style="border: 1px solid black;text-align:right;font-size: 12px; " colspan="4">{{
                        $convence_allowance =
                        ($gross_salary*$user->salaryconfig->salary_config_conveyance_allowance)/100}} BDT
                    </td>
                </tr>
                @endif

                <tr style="border: 1px solid black; border-collapse: collapse;">
                    <td style="border: 1px solid black;font-size: 12px;" colspan="4">Total</td>
                    <td style="border: 1px solid black;text-align:right;font-size: 12px; " colspan="4">
                        {{$basic_salay+$medical_allowence+$house_rent+$convence_allowance}} BDT
                    </td>
                </tr>

            </tbody>
        </table>
    </div>

    @else

    @endif

</div>
<br><br>

<span> These changes will come into effect from {{ $employees->salary_incre_date ?? ''}} .</span> <span><br><br>

    <span>{!! strip_tags($employees->letterFormat->extra_feture) ?? null !!}</span> <br><br>


    <div style="width:1200px;">
        <div style="float:left;width:50%;">
            <p>Yours Sincerely,<br><br><br>

                <span><img style="height:30px;width:70px;" src="{{asset($employees->letterFormat->signature)}}"></span>
            </p>
            <p style="padding-top:-35px;">__________________ </P>
            <span>
                {{ $user->salaryIncrementLetter->signatory->first_name ?? null }}
                {{ $user->salaryIncrementLetter->signatory->last_name ?? null }}

                <br>
                {{ $user->company->company_name }}<br>
            </span>
        </div>
    </div>


    </div>
    @else
    <div>

        <?php
    $date = date('j F, Y');

    ?>
        <div class="header-logo">
            <div>
                <img style="max-height: 30px;" src="{{ asset($user->company->company_logo ?? null) }}" />
            </div>
        </div><br>

        Date: {{ $date }} <br><br>
        Name: {{ $user->first_name . ' ' . $user->last_name ?? ''}} <br>
        Designation: {{ $employees->designationdetails->designation_name ?? null }} <br>
        Department: {{ $employees->departmentdetails->department_name ?? null }} <br><br>
        <span style="font-weight:bold;"> Subject: <b>Yearly Salary Increment</b></span><br><br>

        Dear {{ $user->first_name . ' ' . $user->last_name }} ,<br><br>

        <p>We would like to congratulate you on completion of the year of 2023 with us. We are pleased to inform you
            that your salary has been increased by management. The amount of your salary increased is BDT.
            {{$employees->increment_amount }}. Now your monthly gross salary with the following particulars:</p>

        <br>

        @if($user->salaryconfig->salary_config_basic_salary>0)
        <div style="padding-left:120px">
            <table class="table" style="width:70%">
                <tbody>
                    <?php
                    if ($user->gross_salary) {
                        $gross_salary = $user->gross_salary ?? null;
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
                    @if($user->salaryconfig->salary_config_basic_salary>0)
                    <tr style="border: 1px solid black; border-collapse: collapse;">
                        <td style="border: 1px solid black;font-size: 12px;" colspan="4">Basic Salary</td>
                        <td style="border: 1px solid black;text-align:right;font-size: 12px; " colspan="4">{{
                            $basic_salay =
                            ($gross_salary*$user->salaryconfig->salary_config_basic_salary)/100
                            }} BDT</td>
                    </tr>
                    @endif

                    @if($user->salaryconfig->salary_config_medical_allowance>0)
                    <tr style="border: 1px solid black; border-collapse: collapse;">
                        <td style="border: 1px solid black;font-size: 12px;" colspan="4">Medical allowance</td>
                        <td style="border: 1px solid black;text-align:right;font-size: 12px; " colspan="4">{{
                            $medical_allowence =
                            ($gross_salary*$user->salaryconfig->salary_config_medical_allowance)/100}} BDT
                        </td>
                    </tr>
                    @endif
                    @if($user->salaryconfig->salary_config_house_rent_allowance>0)
                    <tr style="border: 1px solid black; border-collapse: collapse;">
                        <td style="border: 1px solid black;font-size: 12px;" colspan="4">House Rent</td>
                        <td style="border: 1px solid black;text-align:right;font-size: 12px; " colspan="4">{{
                            $house_rent =
                            ($gross_salary*$user->salaryconfig->salary_config_house_rent_allowance)/100}} BDT
                        </td>
                    </tr>
                    @endif

                    @if($user->salaryconfig->salary_config_conveyance_allowance>0)
                    <tr style="border: 1px solid black; border-collapse: collapse;">
                        <td style="border: 1px solid black;font-size: 12px;" colspan="4">Convence Allowance</td>
                        <td style="border: 1px solid black;text-align:right;font-size: 12px; " colspan="4">{{
                            $convence_allowance =
                            ($gross_salary*$user->salaryconfig->salary_config_conveyance_allowance)/100}} BDT
                        </td>
                    </tr>
                    @endif

                    <tr style="border: 1px solid black; border-collapse: collapse;">
                        <td style="border: 1px solid black;font-size: 12px;" colspan="4">Total</td>
                        <td style="border: 1px solid black;text-align:right;font-size: 12px; " colspan="4">
                            {{$basic_salay+$medical_allowence+$house_rent+$convence_allowance}} BDT
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>

        @else

        @endif

    </div>
    <br><br>

    <span> These changes will come into effect from {{ $employees->salary_incre_date ?? ''}} .</span> <span><br><br>

        <span>All terms mentioned in appointment letter will remain unchanged, continue to be applicable to your
            permanent status.</span> <br><br>
        <span>We wish you a successful career in our organization.</span> <br><br>


        <div style="width:1200px;">
            <div style="float:left;width:50%;">
                <p>Yours Sincerely,<br>
                    <span><img style="height:30px;width:70px;" src="{{asset('idcard/signature.png')}}"></span>
                </p>
                <p style="padding-top:-35px;">__________________ </P>
                <span>
                    Md. Ariful Islam
                    <br>
                    Managing Director
                    <br>
                    Prediction Learning Associates Ltd.(PLA)<br>
                </span>
            </div>
        </div>


        </div>

        @endif
