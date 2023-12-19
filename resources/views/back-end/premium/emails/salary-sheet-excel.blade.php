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
        style="margin-left:-10%;margin-right:-10%;">
        <thead style="background-color:#00695c; color:white;">
            <tr>
                <th>SL</th>
                <th>Payslip Number</th>
                <th>Company</th>
                <th>Employee</th>
                <th>Employee Id</th>
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
                <th>Festival Bonus</th>
                <th>Net Overtime</th>
                <th>Commission</th>
                <th>Other Payment</th>
                <th>Tax Per Month</th>
                <th>Loan</th>
                <th>PF Contribution</th>
                <th>Statutory Deduction</th>
                <th>Month</th>
                <th>Year</th>
                <th>Working Days</th>
                <th>late Time Days</th>
                <th>late Time Salary Deduction</th>
                <th>Lunch Allowance</th>
                <th>Mobile Bill</th>
                <th>TA/DA</th>
                <th>Net Salary</th>
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
            @php($total_net_salary=0)
            @php($total_payroll_charge=0)
            @php($total_payable_amount=0)
            @foreach($data['payment_histories'] as $payment_histories_value)
            <tr>
                <td>{{$i++}}</td>
                <td>{{$payment_histories_value->pay_slip_number}}</td>
                <td>{{$payment_histories_value->company_name}}</td>
                <td>{{$payment_histories_value->first_name." ".$payment_histories_value->last_name}}</td>
                <td>{{$payment_histories_value->company_assigned_id ?? null}}</td>
                <td>{{$payment_histories_value->joining_date ?? null}}</td>
                <td>{{$payment_histories_value->department_name}}</td>
                <td>{{$payment_histories_value->designation_name}}</td>
                <td>{{$payment_histories_value->pay_slip_payment_type}}</td>
                <td>{{$payment_histories_value->pay_slip_gross_salary}}</td>

                <td>@php ($basic_salary = ($payment_histories_value->pay_slip_basic_salary))
                    {{number_format((float)$basic_salary, 2, '.', '')}}</td>
                <td>{{$payment_histories_value->pay_slip_working_days}}</td>
                <td>{{number_format((float)$payment_histories_value->pay_slip_per_hour_rate),2, '.', ''}}</td>
                <td>{{$payment_histories_value->pay_slip_house_rent}}</td>
                <td>{{$payment_histories_value->pay_slip_medical_allowance}}</td>
                <td>{{$payment_histories_value->pay_slip_conveyance_allowance}}</td>
                <td>{{$payment_histories_value->pay_slip_festival_bonus}}</td>
                <td>{{$payment_histories_value->pay_slip_overtimes}}</td>
                <td>{{$payment_histories_value->pay_slip_commissions}}</td>
                <td>{{$payment_histories_value->pay_slip_other_payments}}</td>
                <td>{{number_format((float)$payment_histories_value->pay_slip_tax_deduction),2, '.', ''}}</td>
                <td>{{$payment_histories_value->pay_slip_loans}}</td>
                <td>{{$payment_histories_value->pay_slip_provident_fund}}</td>
                <td>{{$payment_histories_value->pay_slip_statutory_deduction}}</td>
                <td>{{date("F", strtotime($payment_histories_value->pay_slip_month_year))}}</td>
                <td>{{date('Y', strtotime($payment_histories_value->pay_slip_month_year))}}</td>
                <td>{{$payment_histories_value->pay_slip_working_days}}</td>

                <td>{{$payment_histories_value->pay_slip_late_days ?? 0}}</td>
                <td>{{$payment_histories_value->pay_slip_late_day_salary_deduct}}</td>

                <td>{{$payment_histories_value->pay_slip_lunch_allowance ?? 0}}</td>
                <td>{{$payment_histories_value->pay_slip_mobile_bill}}</td>
                <td>{{$payment_histories_value->pay_slip_transport_allowance}}</td>
                <td>@php ($net_salary = ($payment_histories_value->pay_slip_net_salary))
                    {{number_format((float)$net_salary, 2, '.', '')}}</td>
                <td>@php ($payroll_charge = ($payment_histories_value->pay_slip_net_salary*15)/100)
                    {{number_format((float)$payroll_charge, 2, '.', '')}}</td>
                {{--<td>{{$insurance = 0}}</td>--}}
                @php ($insurance = 0)
                <td>@php ($tax_on_payrol_charge = ((($payroll_charge*10)/100) +
                    $payment_histories_value->pay_slip_net_salary + $payroll_charge + $insurance)*1.5/100)
                    {{number_format((float)$tax_on_payrol_charge, 2, '.', '')}}</td>
                <td>@php($total_ctc = $payment_histories_value->pay_slip_net_salary + $payroll_charge + $insurance +
                    $tax_on_payrol_charge){{number_format((float)$total_ctc, 2, '.', '')}}</td>
                <td>{{$exchange_risk = 365.42}}</td>
                <td>@php($total_payable = $total_ctc + $exchange_risk){{number_format((float)$total_payable, 2, '.',
                    '')}}</td>
            </tr>
            @php($total_tax_deduction += $payment_histories_value->pay_slip_tax_deduction)
            @php($total_net_salary += $payment_histories_value->pay_slip_net_salary)
            @php($total_payroll_charge += $payroll_charge)
            @php($total_payable_amount += $total_payable)
            @endforeach
            <tr>
                <td colspan="22"></td>

                <td style="font-weight: bold;">{{number_format((float)$total_tax_deduction, 2, '.', '')}}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="font-weight: bold;"> {{number_format((float)$total_net_salary, 2, '.', '')}} </td>
                <td style="font-weight: bold;"> {{number_format((float)$total_payroll_charge, 2, '.', '')}}</td>
                <td></td>
                <td></td>
                <td></td>
                <td style="font-weight: bold;"> {{number_format((float)$total_payable_amount, 2, '.', '')}}</td>

            </tr>
        </tbody>
    </table>
</body>

</html>