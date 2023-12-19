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
            The Head of Mobile Banking Division
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
            <br>
            Head office <br>
            @foreach($payment_histories->unique(fn($p) => $p->company_bank_account_address) as $key =>
            $payment_history) {{
            $payment_history->company_bank_account_address ?? null }}
            @endforeach
        </p>

        <p>Sub: Request to Disburse Salary {{ $month }}, {{ $year }}</p>
        <br>
        Dear Sir,
        <br>
        With due respect we are requesting to you please disburse the net payable
        @foreach($payment_histories->unique(fn($p) =>
        $p->department_name) as $key =>
        $payment_history) {{
        $payment_history->department_name ?? null }}
        @endforeach Salary {{ $month }}, {{ $year }} BDT. {{ $number
        }}/- In
        words ({{ $numberToWord }}) <br> to account holder as per @foreach($payment_histories->unique(fn($p) =>
        $p->department_name) as $key =>
        $payment_history) {{
        $payment_history->department_name ?? null }}
        @endforeach Salary from mother account No. @foreach($payment_histories->unique(fn($p) =>
        $p->company_bank_account_number) as $key =>
        $payment_history) {{ $payment_history->company_bank_account_number ?? null }}
        @endforeach
        Company name (@foreach($payment_histories->unique(fn($p) =>
        $p->company_name) as $key =>
        $payment_history)
        {{
        $payment_history->company_name ?? null }}
        @endforeach)
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