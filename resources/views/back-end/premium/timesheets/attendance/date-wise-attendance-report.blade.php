<table>
    <thead>
        <tr>
            <th>SL</th>
            <th>Employee</th>
            <th>Employee ID</th>
            {{-- <th>Company</th> --}}
            <th>Date</th>
            <th>Status</th>
            <th>Clock In</th>
            {{-- <th>IN LC</th> --}}
            <th>Clock Out</th>
            {{-- <th>OUT LC</th> --}}
            <th>Late</th>
            <th>Early Leaving</th>
            <th>Overtime</th>

            <th>Check In Latitude</th>
            <th>Check In Longitude</th>
            <th>Check Out Latitude</th>

            <th>Check Out Longitude</th>

            <th>Total Work</th>

        </tr>
    </thead>
    <tbody>
        @foreach($data['attendances'] as $attendancesValue)
        <tr>

            <td>{{$loop->iteration}}</td>
            <td>{{ $attendancesValue->first_name.' '.$attendancesValue->last_name}}</td>
            <td>{{ $attendancesValue->company_assigned_id }}</td>
            {{-- <td>{{ $attendancesValue->company_name}}</td> --}}
            <td>{{ $attendancesValue->attendance_date}}</td>
            <td>@if($attendancesValue->check_in_out === 1){{__('Present')}}@else{{__('Absent')}}@endif
            </td>
            <td>{{ $attendancesValue->clock_in }}</td>
            <td>{{ $attendancesValue->clock_out }}</td>
            <td>{{$attendancesValue->time_late}}</td>
            <td>{{$attendancesValue->early_leaving}}</td>
            <td>{{ $attendancesValue->overtime }}</td>
            <td>{{ $attendancesValue->check_in_latitude }}</td>
            <td>{{ $attendancesValue->check_in_longitude }}</td>
            <td>{{ $attendancesValue->check_out_latitude }}</td>

            <td>{{ $attendancesValue->check_out_longitude }}</td>
            @if($attendancesValue->clock_out == NULL || $attendancesValue->clock_out == '')
            <td>00:00:00</td>
            @else
            <td>
                {{ $attendancesValue->total_work }}
            </td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>