<!DOCTYPE html>
<html>

<head>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid black;
        }

        table td {
            line-height: 25px;
            padding-left: 15px;
        }

        table th {
            background-color: #fbc403;
            color: #363636;
        }
    </style>

</head>
<?php
// use App\Models\BankAccount;

 //echo json_encode($data);
        //  foreach($employee_name as $employee_name_value){
        //        echo $employee_name_value;
        //        }

        //        foreach($stuff_id as $stuff_id_value){
        //         echo $stuff_id_value;
        //         }

                //      foreach($employee_bank_details as $employee_bank_details_value){
                // echo "hi". $employee_bank_details_value->stuff_id;
                // }

          // exit;
?>

<body>
    <table table-border="1">

        <tr height="100px" style="background-color:#363636;text-align:center;font-size:24px; font-weight:600;">
            <td colspan='4' style="color:white;">@foreach($company_name as
                $company_name_value){{$company_name_value}}@endforeach</td>
        </tr>
        <tr>
            <th>ID NO:</th>
            <td>@foreach($stuff_id as $stuff_id_value){{$stuff_id_value}}@endforeach</td>
            <th>Name</th>
            <td>
                <?php foreach($employee_name as $employee_name_value){ echo $employee_name_value;} ?>
            </td>
        </tr>
        <!-----2 row--->
        <tr>
            <th>Bank</th>
            <td>@foreach($bank_name as $bank_name_value){{$bank_name_value}}@endforeach</td>
            <th>Bank A/C No.</th>
            <td>@foreach($bank_account_number as $bank_account_number_value){{$bank_account_number_value}}@endforeach
            </td>
        </tr>
        <!------3 row---->
        <tr>

            <th>Bank Branch</th>
            <td>@foreach($bank_branch as $bank_branch_value){{$bank_branch_value}}@endforeach</td>
            <th>Payment Date</th>
            <td>@foreach($payment_date as $payment_date){{$payment_date}}@endforeach</td>

        </tr>
          <!------4 row---->
        <tr>
            <th>Salary Month</th>
            <td>@foreach($salary_month as $salary_month){{$salary_month}}@endforeach</td>
            <th>Working Days</th>
            <td>@foreach($working_days as $working_days_value){{$working_days_value}}@endforeach</td>
           
        </tr>
        <!------6 row---->
        <tr>
            <th>Department</th>
            <td>@foreach($department_name as $department_name_value){{$department_name_value}}@endforeach</td>
            <th>Designation</th>
            <td>@foreach($designation_name as $designation_name_value){{$designation_name_value}}@endforeach</td>
        </tr>
         <!------5 row---->
         <tr>
            <th>DOB</th>
            <td>@foreach($date_of_birth as $date_of_birth_value){{$date_of_birth_value}}@endforeach</td>
            <th>Salary Type</th>
            <td>@foreach($salary_type as $salary_type_value){{$salary_types = $salary_type_value}}@endforeach</td>
        </tr>
      
       
    </table>
    <tr></tr>

    <br />

    <table table-border="1">
        <tr>
            <th>Earnings</th>
            <th>Amount</th>
            <th>Deductions</th>
            <th>Amount</th>
        </tr>
        <tr>
            <td>Basic</td>
            <td>@foreach($basic as $basic_value){{$basic_value}}@endforeach</td>
            <td>Provident Fund</td>
            <td>@foreach($pf_contribution as $pf_contribution_value){{$pf_contribution_value}}@endforeach</td>
        </tr>
        <tr>
            <td>House Rent Allowance</td>
            <td>@foreach($house_rent as $house_rent_value){{$house_rent_value}}@endforeach</td>
            <td>Income Tax</td>
            <td>@foreach($tax_deduction as $tax_deduction_value){{$tax_deduction_value}}@endforeach</td>
        </tr>
        <tr>
            <td>Medical Allowance</td>
            <td>@foreach($medical_allowance as $medical_allowance_value){{$medical_allowance_value}}@endforeach</td>
            <td>Loan</td>
            <td>@foreach($loans as $loans_value){{$loans_value}}@endforeach</td>
        </tr>
        <tr>
            <td>Conveyance</td>
            <td>@foreach($conveyance_allowance as $conveyance_allowance_value){{$conveyance_allowance_value}}@endforeach
            </td>
            <td>Statutory Deduction</td>
            <td>@foreach($statutory_deduction as $statutory_deduction_value){{$statutory_deduction_value}}@endforeach
            </td>
        </tr>
        <tr>
            <td>Festival Bonus</td>
            <td>@foreach($festival_bonus as $festival_bonus_value){{$festival_bonus_value}}@endforeach</td>
            <td>Lunch Allowance</td>
            <td>@foreach($pay_slip_lunch_allowance as
                $pay_slip_lunch_allowance_value){{$pay_slip_lunch_allowance_value}}@endforeach
            </td>
        </tr>
        <tr>
            <td>Commission</td>
            <td>@foreach($commissions as $commissions_value){{$commissions_value}}@endforeach</td>
            <td>Late Time Salary Deduction</td>
            <td>@foreach($pay_slip_late_day_salary_deduct as $pay_slip_late_day_salary_deduct)
                {{$pay_slip_late_day_salary_deduct}}
                @endforeach</td>
        </tr>
        <tr>
            <td>Other Payment</td>
            <td>@foreach($other_payments as $other_payments_value){{$other_payments_value}}@endforeach</td>
        </tr>
        <tr>
            <td>Over Time</td>
            <td>@foreach($overtimes as $overtimes_value){{$overtimes_value}}@endforeach</td>
        </tr>
        <tr>
            <td>Mobile Bill</td>
            <td>@foreach($mobile_bill as $mobile_bill_value){{$mobile_bill_value}}@endforeach</td>
        </tr>
        <tr>
            <td>Transport Allowance</td>
            <td>@foreach($transport_allowance as $transport_allowance_value){{$transport_allowance_value}}@endforeach
            </td>
        </tr>
        <tr>
            <td>Total Working Hour</td>
            <td>@foreach($total_working_hour as $total_working_hour_value){{$total_working_hour_value}}@endforeach</td>
        </tr>
        <tr>
            <td>Per Hour Rate</td>
            <td>@foreach($per_hour_rate as $per_hour_rate_value){{$per_hour_rate_value}}@endforeach</td>
        </tr>
        <tr>

            @if($salary_types == "Monthly")

            <th>Gross Earnings</th>
            <td>Tk.@foreach($gross_earning as $gross_earning_value){{$gross_earning_value}}@endforeach</td>
            @else
            <th>Gross Earnings</th>
            <td>Tk.@foreach($net_salary as $net_salary_value){{$net_salary_value}}@endforeach</td>
            @endif

            <th>Gross Deductions</th>
            <td>Tk.@foreach($gross_deduction as $gross_deduction_value){{$gross_deduction_value}}@endforeach</td>
        </tr>
        <tr>
            <td></td>
            <td><strong>NET PAY</strong></td>
            <td>Tk.@foreach($net_salary as $net_salary_value){{$net_salary_value}}@endforeach</td>
            <td></td>
        </tr>

    </table>
</body>

</html>