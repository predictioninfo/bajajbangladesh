<!DOCTYPE html>
<html>

<head>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid black;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table td {
            line-height: 25px;
            padding-left: 15px;
            border: 1px solid black;
        }

        table th {
            background-color: #fbc403;
            color: #363636;
            border: 1px solid black;
        }
    </style>

</head>
<?php
 use App\Models\Company;
 $company_names = Company::where('id',Auth::user()->com_id)->first(['company_name']);

?>

<body>

    <table id="user-table" class="table table-bordered table-hover table-striped"
        style="margin-left:0%;margin-right:0%;">
        <thead style="background-color:#00695c; color:white;">
            <tr>
                {{-- <th>{{ __('SL') }}</th>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Company ID') }}</th>
                <th>{{ __('Phone') }}</th>
                <th>{{ __('Joining Date') }}</th>
                <th>{{ __('Gross') }}</th>
                <th>{{ __('Basic') }}</th>
                <th>{{ __('Bonus Amount') }}</th>
                <th>{{ __('Bonus Type') }}</th>
                <th>{{ __('Bonus Percentage') }}</th>
                <th>{{ __('Bonus Month') }}</th>
                <th>{{ __('Bonus Title') }}</th> --}}

                <th>SL</th>
                <th>Company</th>
                <th>Employee</th>
                <th>ID</th>
                <th>Joining Date</th>
                <th>Department</th>
                <th>Designation</th>
                <th>Salary Type</th>
                <th>Gross Salary</th>
                <th>Basic Salary</th>
                <th>Total Working Hour</th>
                <th>Per Hour Rate</th>
                <th>House Rent</th>
                <th>Medical</th>
                <th>Conveyance</th>
                <th>Bonus Type </th>
                <th>Bonus Percentage</th>
                <th>Bonus Amount</th>
                <th>Net Overtime</th>
                <th>Commission</th>
                <th>Other Payment</th>
                <th>Tax </th>
                <th>PF Contribution</th>
                <th>Statutory Deduction</th>
                <th>Bonus Tilte</th>
                <th>Month</th>
                <th>Year</th>
                <th>Working Days</th>
                <th>Mobile Bill</th>
                <th>TA/DA</th>
                <th>Net Payment</th>
                <th>Payroll Charge</th>
                <th>Tax</th>
                <th>CTC(Cost To Company)</th>
                <th>Exchange Risk</th>
                <th>Total Payable</th>

            </tr>
        </thead>
        <tbody>
            @php($i=1)
            @php($total_tax_deduction=0)
            @php($total_net_payable=0)
            @php($total_bonus_amount=0)
            @foreach($payment_histories as $payment_histories_value)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ Auth::user()->Company->company_name }}</td>
                <td>{{ $payment_histories_value->festivalPaymentUser->first_name ?? null}} {{
                    $payment_histories_value->festivalPaymentUser->last_name ?? null}}
                </td>
                <td>{{ $payment_histories_value->festivalPaymentUser->company_assigned_id ?? null}}</td>
                <td>{{ $payment_histories_value->festivalPaymentUser->joining_date ?? null}}</td>
                <td>{{ $payment_histories_value->festivalPaymentDepartment->department_name ?? null}}</td>
                <td>{{ $payment_histories_value->festivalPaymentUser->userdesignation->designation_name ?? null}}</td>

                <td>{{ $payment_histories_value->festivalPaymentUser->salary_type ?? null}}</td>
                <td>{{ $payment_histories_value->festivalPaymentUser->gross_salary }}</td>
                <td>{{
                    ($payment_histories_value->festivalPaymentUser->gross_salary*$salary_configs->salary_config_basic_salary)/100
                    }}
                </td>
                <td>{{__('0')}}</td>
                <td>{{__('0')}}</td>

                <td>{{
                    ($payment_histories_value->festivalPaymentUser->gross_salary*$salary_configs->salary_config_house_rent_allowance)/100
                    }}
                <td>{{
                    ($payment_histories_value->festivalPaymentUser->gross_salary*$salary_configs->salary_config_medical_allowance)/100
                    }}</td>
                <td>{{
                    ($payment_histories_value->festivalPaymentUser->gross_salary*$salary_configs->salary_config_conveyance_allowance)/100
                    }}</td>
                <td>{{ $payment_histories_value->festivalPaymentBonusConfig->festival_config_salary_type }}</td>
                <td>{{ $festival_config->festival_config_festival_bonus_percentage }}%</td>
                <td>
                    @if($festival_config->festival_config_salary_type == "Gross")
                    {{
                    $bonus =
                    ($payment_histories_value->festivalPaymentUser->gross_salary*$festival_config->festival_config_festival_bonus_percentage)/100}}

                    @endif

                    @if($festival_config->festival_config_salary_type == "Basic")
                    {{
                    $bonus =
                    ((($payment_histories_value->festivalPaymentUser->gross_salary*$salary_configs->salary_config_basic_salary)/100)*$festival_config->festival_config_festival_bonus_percentage)/100
                    }}

                    @endif
                </td>


                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>
                    {{$tax = number_format((float)$payment_histories_value->festival_payment_tax_deduction, 2, '.',
                    '')}}
                </td>
                <td>0</td>
                <td>0</td>
                <td>{{ $payment_histories_value->festivalPaymentBonus->festival_bonus_title }}</td>
                <td>{{ $month_name }}</td>
                <td>{{ $previous_month_year }}</td>

                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>{{$bonus-$tax }}</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>{{$bonus-$tax }}</td>
            </tr>
            <?php
             $total_tax_deduction += number_format((float)$payment_histories_value->festival_payment_tax_deduction, 2, '.',
            '');
             $total_net_payable += $bonus-$tax;

             $total_bonus_amount += $bonus;
             ?>

            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td>
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>

                <td></td>
                <td></td>
                <td>
                </td>
                <td></td>
                <td></td>
                <td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    {{ $total_bonus_amount }}
                </td>


                <td></td>
                <td></td>
                <td></td>
                <td>
                    {{ $total_tax_deduction }}
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>

                <td></td>
                <td></td>
                <td></td>
                <td>{{$total_net_payable}}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>{{$total_net_payable}}</td>
            </tr>
        </tbody>
    </table>
</body>

</html>