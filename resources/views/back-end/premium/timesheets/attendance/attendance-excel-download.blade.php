<table>
    <thead>
        <tr>
            <th colspan="6"
                style="width: 85px; height: 50px; background-color: #8eb4e2; text-align:center; vertical-align: center;">
                {{ __('Attendance Report') }}</th>
            <th colspan="4"
                style="width: 85px; height: 50px; background-color: #db9972; text-align:center; vertical-align: center;">
                {{ __('Sat') }}</th>
            <th colspan="4"
                style="width: 85px; height: 50px; background-color: #8eb4e2; text-align:center; vertical-align: center;">
                {{ __('Sun') }}</th>
        </tr>
        <tr>
            <th rowspan="2" style="background-color:  #8eb4e2; text-align:center; vertical-align: center;">{{ __('SL')
                }}</th>
            <th rowspan="2" style="background-color: #8eb4e2; text-align:center; vertical-align: center;">
                {{ __('Employee ID') }}</th>
            <th rowspan="2" style="background-color: #8eb4e2; text-align:center; vertical-align: center;">
                {{ __('Employee Name') }}</th>
            <th rowspan="2" style="background-color: #8eb4e2; text-align:center; vertical-align: center;">{{
                __('Department') }}</th>
            <th rowspan="2" style="background-color: #8eb4e2; text-align:center; vertical-align: center;">{{
                __('Designation') }}</th>
            <th rowspan="2" style="background-color: #8eb4e2; text-align:center; vertical-align: center;">{{
                __('Date Of Joining') }}</th>
            <th colspan="4"
                style="width: 85px; height: 50px; background-color: #db9972; text-align:center; vertical-align: center;">
                {{ __('1-1-2023') }}</th>
            <th colspan="4"
                style="width: 85px; height: 50px; background-color: #8eb4e2; text-align:center; vertical-align: center;">
                {{ __('01-01-2023') }}</th>
        </tr>
        <tr>
            <th style="background-color:  #db9972; text-align:center; vertical-align: center;">{{ __('Status') }}</th>
            <th style="background-color: #db9972; text-align:center; vertical-align: center;">{{ __('InTime') }}</th>
            <th style="background-color: #db9972; text-align:center; vertical-align: center;">{{ __('OutTime') }}</th>
            <th style="background-color: #db9972; text-align:center; vertical-align: center;">{{ __('Work Hours') }}
            </th>

            <th style="background-color:  #8eb4e2; text-align:center; vertical-align: center;">{{ __('Status') }}</th>
            <th style="background-color: #8eb4e2; text-align:center; vertical-align: center;">{{ __('InTime') }}</th>
            <th style="background-color: #8eb4e2; text-align:center; vertical-align: center;">{{ __('OutTime') }}</th>
            <th style="background-color: #8eb4e2; text-align:center; vertical-align: center;">{{ __('Work Hours') }}
            </th>
        </tr>
    </thead>
    <tbody>
        @php($i=1)
        @foreach ($data['attendances'] as $attendancesValue)
        <tr>
            <td>{{ $i++ }}</td>
            <td>13003</td>
            <td>{{ $attendancesValue->first_name.' '.$attendancesValue->last_name}}</td>
            <td>IT</td>
            <td>S</td>
            <td>222</td>
            <td>p</td>
            <td>555</td>
            <td>66</td>
            <td>777</td>
            <td>p</td>
            <td>555</td>
            <td>66</td>
            <td>777</td>
        </tr>
        @endforeach
    </tbody>

</table>
