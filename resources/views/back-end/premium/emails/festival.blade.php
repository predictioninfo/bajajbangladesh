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
    use App\Models\FestivalPayment;
    use App\Models\BankAccount;
    use Carbon\Carbon;
    use App\Models\FestivalBonus;
    use App\Models\FestivalConfig;
    use App\Models\SalaryConfig;


?>

<body>

    <table table-border="1">



        <tr height="100px" style="background-color:#363636;text-align:center;font-size:24px; font-weight:600;">
            <td colspan='4' style="color:white;">@foreach($company_name as
                $company_name_value){{$company_name_value}}@endforeach</td>
        </tr>
        <tr>
            <th>ID NO:</th>
            <td>@foreach($stuff_id as $stuff_id) {{ $stuff_id}} @endforeach</td>
            <th>Name</th>
            <td>
                @foreach($employee_name as $employee_names){{ $employee_names}}@endforeach
            </td>
        </tr>
        <!-----2 row--->
        <tr>
            <th>Bank</th>
            <td> @foreach($company_bank_account_name as
                $company_bank_account_name){{$company_bank_account_name}}@endforeach </td>
            <th>Bank A/C No.</th>
            <td>
                @foreach($employee_bank_account_number as $number) {{$number}} @endforeach
            </td>
        </tr>
        <!------3 row---->
        <tr>

            <th>Bank Branch</th>
            <td>@foreach($company_bank_account_branch as
                $company_bank_account_branch){{$company_bank_account_branch}}@endforeach </td>
            <th>Payment Date</th>
            <td>@foreach($payment_date as $date){{ $date}}@endforeach</td>

        </tr>
        <tr>
            <th>Festival Month</th>
            <td>@foreach($payment_date as $date){{ date('F',strtotime($date))}}@endforeach</td>
            <th>Festival Tilte</th>
            <td>@foreach($festival_bounus_title as $festival_bounus_title){{ $festival_bounus_title}}@endforeach</td>
        </tr>

        <!------4 row---->
        <tr>
            <th>DOB</th>
            <td>@foreach($date_of_birth as $date_of_birth){{ $date_of_birth}}@endforeach</td>
            <th>Working Days</th>
            <td>0</td>
        </tr>
        <!------5 row---->

        <!------6 row---->
        <tr>
            <th>Department</th>
            <td>@foreach($departments as $departments){{$departments}}@endforeach</td>
            <th>Designation</th>
            <td>@foreach($designation_name as $designation_name_value){{$designation_name_value}}@endforeach</td>
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
            <td>0</td>
            <td>Provident Fund</td>
            <td>0</td>
        </tr>
        <tr>
            <td>House Rent Allowance</td>
            <td>0</td>
            <td>Income Tax</td>
            <td>@foreach($festival_payment_tax_deduction as $festival_payment_tax_deduction)
                {{$festival_payment_tax_deduction}} @endforeach</td>
        </tr>
        <tr>
            <td>Medical Allowance</td>
            <td>0</td>
            <td>Loan</td>
            <td>0</td>
        </tr>
        <tr>
            <td>Conveyance</td>
            <td>0</td>
            <td>Statutory Deduction</td>
            <td>0</td>
        </tr>

        <tr>
            <td>Festival Bonus</td>
            <td>@foreach($festival_payment_amount as $amount){{
                $amount}}@endforeach</td>
        </tr>

        <tr>
            <td>Commission</td>
            <td>0</td>
        </tr>
        <tr>
            <td>Other Payment</td>
            <td>0</td>
        </tr>
        <tr>
            <td>Over Time</td>
            <td>0</td>
        </tr>
        <tr>
            <td>Mobile Bill</td>
            <td>0</td>
        </tr>
        <tr>
            <td>Transport Allowance</td>
            <td>0</td>
        </tr>
        <tr>
            <th>Gross Earnings</th>
            <td>Tk.0</td>
            <th></th>
            <td></td>
        </tr>
        <tr>
            <td></td>

            <td><strong>NET PAY</strong></td>
            <td>Tk.@foreach($festival_payment_net_bonus as $festival_payment_net_bonus){{
                $festival_payment_net_bonus}}@endforeach</td>
            <td></td>
        </tr>

    </table>

    <br />
</body>

</html>