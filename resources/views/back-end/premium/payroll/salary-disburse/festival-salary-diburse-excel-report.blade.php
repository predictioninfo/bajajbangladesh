<div class="table-responsive">
    <table>
        <thead>
            <tr>
                <th></th>
                <th></th>
                <th style="font-weight:bold;text-align:center;">Festival Bounus for the Month of-{{ $data['month'] }}'{{
                    $data['year'] }}</th>
            </tr>
        </thead>
    </table>
</div>
<div class="table-responsive">
    <table>
        <thead>
            <tr>
                <th></th>
                <th></th>
                <th style="font-weight:bold;text-align:center;">Bank Advice-{{ $data['bank_type'] }}</th>
            </tr>
        </thead>
    </table>
</div>
<div class="table-responsive">
    <table id="user-table" class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th
                    style="background-color: #12ad27; color:white; font-weight:bold; border:1px solid black; text-align:center;">
                    SL</th>
                <th
                    style="background-color: #12ad27;color:white;font-weight:bold; border:1px solid black;text-align:center;">
                    Employee
                </th>
                <th
                    style="background-color: #12ad27;color:white;font-weight:bold; border:1px solid black;text-align:center;">
                    Employee ID
                </th>
                <th
                    style="background-color: #12ad27;color:white;font-weight:bold; border:1px solid black;text-align:center;">
                    Amount</th>
                <th
                    style="background-color: #12ad27;color:white;font-weight:bold; border:1px solid black;text-align:center;">
                    Bank Account
                </th>
            </tr>
        </thead>
        <tbody>
            @php($i=1)
            @foreach($data['payment_histories'] as $payment_historiy)
            <tr>
                <td style="font-weight:bold;border:1px solid black;text-align:center;">{{$i++}}</td>
                <td style="font-weight:bold;border:1px solid black;text-align:center;">{{
                    $payment_historiy->first_name.'
                    '.$payment_historiy->last_name}}</td>
                <td style="font-weight:bold;border:1px solid black;text-align:center;">{{
                    $payment_historiy->company_assigned_id }}</td>
                <td style="font-weight:bold;border:1px solid black;text-align:center;">{{
                    number_format((float)$payment_historiy->festival_payment_amount , 2, '.', '')}} </td>
                <td style="font-weight:bold;border:1px solid black;text-align:center;">{{
                    $payment_historiy->bank_account_number }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="table-responsive">
    <table>
        <thead>
            <tr>
                <th style="font-weight:bold;border:1px solid black;text-align:center;"></th>
                <th style="font-weight:bold;border:1px solid black;text-align:center;"></th>
                <th style="font-weight:bold;border:1px solid black;text-align:center;">Total</th>
                <th style="font-weight:bold;border:1px solid black;text-align:center;">{{
                    number_format((float)$data['paymen_total'], 2,
                    '.',
                    '') }}</th>
                <th style="font-weight:bold;border:1px solid black;text-align:center;"></th>
            </tr>
        </thead>
    </table>
</div>