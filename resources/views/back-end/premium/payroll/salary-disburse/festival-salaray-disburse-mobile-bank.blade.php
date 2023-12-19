<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <style>
        html,
        body,
        div {
            font-family: nikosh;
            font-size: 14px;
            line-height: 100%;
        }
    </style>
</head>

<body>
    <div style="">
        <br>
        <p>
            <?php $date=date('d-m-Y'); ?>
            Date: {{ $date }}
        </p>
        <p>
            To,
        </p>
        <p>
            The manager
        </p>
        <p>
            @foreach($payment_histories->unique(fn($p) => $p->company_bank_account_name) as $key =>
            $payment_history) {{
            $payment_history->company_bank_account_name ?? null }}
            @endforeach
            <br>
            @foreach($payment_histories->unique(fn($p) => $p->company_bank_account_branch) as $key =>
            $payment_history) {{
            $payment_history->company_bank_account_branch ?? null }}
            @endforeach
        </p>

        <p>Sub: Request to disburse festival bonus {{ $month }}, {{ $year }}</p>
        <br>
        Dear Sir,
        <br>
        Please transfer BDT. {{ $number }}/- ({{ $numberToWord }}) to our following employee’s bank
        accounts by
        debiting
        our account no: @foreach($payment_histories->unique(fn($p) =>
        $p->company_bank_account_number) as $key =>
        $payment_history) {{ $payment_history->company_bank_account_number ?? null }}
        @endforeach in the name of @foreach($payment_histories->unique(fn($p) =>
        $p->company_name) as $key =>
        $payment_history)
        {{
        $payment_history->company_name ?? null }}
        @endforeach maintained with you.

        For better clarification we have provided you the soft copy of data through email from
        @foreach($communication_employee as $employee)
        {{$employee->bankAccountCommunication->email ?? null}},
        @endforeach sender name: @foreach($communication_employee as $employee)
        {{$employee->bankAccountCommunication->first_name.' '.$employee->bankAccountCommunication->last_name }},
        @endforeach you that the soft copy of data is true & exact with hard copy of data submitted to you. For any
        deviation with hard copy & soft copy we will be held responsible. For any query, please contact
        with @foreach($communication_employee as $employee)
        {{$employee->bankAccountCommunication->first_name.' '.$employee->bankAccountCommunication->last_name }},
        @endforeach; Mobile: @foreach($communication_employee as $employee)
        {{$employee->bankAccountCommunication->phone }},
        @endforeach.
        <br><br>
        Thanking You.
        <br><br>
        ________________________
        <br>
        Authorized Signature
        <br>
    </div>
</body>

</html>
