<table id="user-table" class="table table-bordered table-hover table-striped">
    <thead>
        <tr style="background-color:#20898f; color:white;">
            <th colspan="10"></th>
            <th colspan="4"
                style="vertical-align: middle; text-align: center; border: 1px solid black; background-color:#228B22;">
                Reason of Close/Termination </th>
            <th rowspan="2"
                style="vertical-align: middle; text-align: center; border: 1px solid black; background-color:#8EAADB;">
                Total <br /> Termination </th>
            <th colspan="5"
                style="vertical-align: middle; text-align: center; border: 1px solid black; background-color:#228B22;">
                Reason of Resignation/ Absent </th>
            <th rowspan="2"
                style="vertical-align: middle; text-align: center; border: 1px solid black; background-color:#FFFF00;">
                Total <br /> Resignation </th>
            <th rowspan="2"
                style="vertical-align: middle; text-align: center; border: 1px solid black; background-color:#228B22;">
                Total </th>
            <th rowspan="2"
                style="vertical-align: middle; text-align: center; border: 1px solid black; background-color:#E6E6E6;">
                Effective date </th>
            <th rowspan="2"
                style="vertical-align: middle; text-align: center; border: 1px solid black; background-color:#FFFF00;">
                Vendors </th>
            <th rowspan="2"
                style="vertical-align: middle; text-align: center; border: 1px solid black; background-color:#FFFF00;">
                Specific Reason </th>
            <th rowspan="2" style="vertical-align: middle; text-align: center; border: 1px solid black;"> DBBL/AC
            </th>
        </tr>
        <tr>
            <th style="vertical-align: middle; text-align: center; border: 1px solid black; background-color:#E6E6E6;">
                Separation <br /> Month </th>
            <th style="vertical-align: middle; text-align: center; border: 1px solid black; background-color:#E6E6E6;">
                Sl </th>
            <th style="vertical-align: middle; text-align: center; border: 1px solid black; background-color:#E6E6E6;">
                ID no. </th>
            <th style="vertical-align: middle; text-align: center; border: 1px solid black; background-color:#E6E6E6;">
                Name of PSR </th>
            <th style="vertical-align: middle; text-align: center; border: 1px solid black; background-color:#E6E6E6;">
                Territory </th>
            <th style="vertical-align: middle; text-align: center; border: 1px solid black; background-color:#E6E6E6;">
                SE_Area </th>
            <th style="vertical-align: middle; text-align: center; border: 1px solid black; background-color:#E6E6E6;">
                Joining <br /> Date. </th>
            <th style="vertical-align: middle; text-align: center; border: 1px solid black; background-color:#E6E6E6;">
                Name of Distributors </th>
            <th style="vertical-align: middle; text-align: center; border: 1px solid black; background-color:#E6E6E6;">
                Location </th>

            <th style="vertical-align: middle; text-align: center; border: 1px solid black; background-color:#E6E6E6;">
                Mobile No. of <br /> PSR </th>
            <th style="vertical-align: middle; text-align: center; border: 1px solid black;"> Poor Performance </th>
            <th style="vertical-align: middle; text-align: center; border: 1px solid black;"> Integrity <br /> Problem
            </th>
            <th style="vertical-align: middle; text-align: center; border: 1px solid black;"> Habitual <br />
                Absent/attendance </th>
            <th style="vertical-align: middle; text-align: center; border: 1px solid black;"> Indecent <br /> Behavior
            </th>
            <th style="vertical-align: middle; text-align: center; border: 1px solid black;"> Work Pressure/ <br />
                Office Time </th>
            <th style="vertical-align: middle; text-align: center; border: 1px solid black;">Rude Behaviours <br /> by
                Supervisor </th>
            <th style="vertical-align: middle; text-align: center; border: 1px solid black;"> Better Opportunity </th>
            <th style="vertical-align: middle; text-align: center; border: 1px solid black;"> Doing business/ Others
                (Mention) </th>
            <th style="vertical-align: middle; text-align: center; border: 1px solid black;">Absent </th>
        </tr>
    </thead>
    <tbody>
        @php
            $total_termination_poor_performance = 0;
            $total_termination_integrity_problem = 0;
            $total_termination_habitual_absent_attendance = 0;
            $total_termination_indecent_behavior = 0;
            $total_number_of_termination = 0;

            $total_resignation_work_pressure_or_office_time = 0;
            $total_resignation_rude_behaviours_by_supervisor = 0;
            $total_resignation_better_oppurtunity = 0;
            $total_resignation_doing_bussiness_or_others_mention = 0;
            $total_resignation_absent = 0;
            $total_number_of_regignation = 0;
        @endphp
        {!! htmlentities($employee->userarea->area_name ?? '', ENT_QUOTES) !!}
        @foreach ($data['separations'] as $item)
            <tr>
                <td style="border: 1px solid black;">{{ date("M'y", strtotime($item->date)) }}</td>
                <td style="border: 1px solid black;">{{ $loop->iteration }}</td>
                <td style="border: 1px solid black;">{{ $item->separationEmployee->company_assigned_id }}</td>
                <td style="border: 1px solid black;">{!! htmlentities($item->separationEmployee->first_name, ENT_QUOTES) !!} {!! htmlentities($item->separationEmployee->last_name, ENT_QUOTES) !!}
                </td>
                <td style="border: 1px solid black;">{!! htmlentities($item->separationEmployee->userregion->region_name ?? '', ENT_QUOTES) !!}</td>
                <td style="border: 1px solid black;">{!! htmlentities($item->separationEmployee->userarea->area_name ?? '', ENT_QUOTES) !!}</td>
                <td style="border: 1px solid black;">{!! htmlentities($item->separationEmployee->joining_date ?? '', ENT_QUOTES) !!}</td>
                <td style="border: 1px solid black;">{!! htmlentities($item->separationEmployee->userterritory->territory_name ?? '', ENT_QUOTES) !!}</td>
                <td style="border: 1px solid black;">
                    {!! htmlentities($item->separationEmployee->userregion->region_name ?? '', ENT_QUOTES) !!}
                    {!! htmlentities($item->separationEmployee->userarea->area_name ?? '', ENT_QUOTES) !!}
                    {!! htmlentities($item->separationEmployee->userterritory->territory_name ?? '', ENT_QUOTES) !!}
                    {!! htmlentities($item->separationEmployee->usertown->town_name ?? '', ENT_QUOTES) !!}
                </td>

                <td style="border: 1px solid black;">{{ $item->separationEmployee->phone ?? '' }}</td>
                {{-- @if ($item->termination_id) --}}
                <td style="border: 1px solid black;">{{ $item->terminationEmployee->poor_performance ?? '' }}</td>
                <td style="border: 1px solid black;">{{ $item->terminationEmployee->integrity_problem ?? '' }}</td>
                <td style="border: 1px solid black;">{{ $item->terminationEmployee->habitual_absent_attendance ?? '' }}
                </td>
                <td style="border: 1px solid black;">{{ $item->terminationEmployee->indecent_behavior ?? '' }}</td>
                <td style="border: 1px solid black;">
                    @if ($item->terminationEmployee)
                        @if (
                            $item->terminationEmployee->poor_performance ||
                                $item->terminationEmployee->integrity_problem ||
                                $item->terminationEmployee->habitual_absent_attendance ||
                                $item->terminationEmployee->indecent_behavior)
                            @php
                                $total_termination = 1;
                            @endphp
                            {{ $total_termination }}
                        @endif
                    @endif
                </td>
                {{-- @endif --}}

                {{-- @if ($item->resignation_id) --}}
                <td style="border: 1px solid black;">
                    {{ $item->resignationEmployee->work_pressure_or_office_time ?? '' }}</td>
                <td style="border: 1px solid black;">
                    {{ $item->resignationEmployee->rude_behaviours_by_supervisor ?? '' }}</td>
                <td style="border: 1px solid black;">{{ $item->resignationEmployee->better_oppurtunity ?? '' }}</td>
                <td style="border: 1px solid black;">
                    {{ $item->resignationEmployee->doing_bussiness_or_others_mention ?? '' }}</td>
                <td style="border: 1px solid black;">{{ $item->resignationEmployee->absent ?? '' }}</td>
                <td style="border: 1px solid black;">
                    @if ($item->resignationEmployee)
                        @if (
                            $item->resignationEmployee->work_pressure_or_office_time ||
                                $item->resignationEmployee->rude_behaviours_by_supervisor ||
                                $item->resignationEmployee->better_oppurtunity ||
                                $item->resignationEmployee->doing_bussiness_or_others_mention ||
                                $item->resignationEmployee->absent)
                            @php
                                $total_resignation = 1;
                            @endphp
                            {{ $total_resignation }}
                        @endif
                    @endif
                </td>
                {{-- @endif --}}
                <td style="border: 1px solid black;">
                    @if ($item->resignationEmployee)
                        @if (
                            $item->resignationEmployee->work_pressure_or_office_time ||
                                $item->resignationEmployee->rude_behaviours_by_supervisor ||
                                $item->resignationEmployee->better_oppurtunity ||
                                $item->resignationEmployee->doing_bussiness_or_others_mention ||
                                $item->resignationEmployee->absent)
                            {{ 1 }}
                        @endif
                    @elseif($item->terminationEmployee)
                        @if (
                            $item->terminationEmployee->poor_performance ||
                                $item->terminationEmployee->integrity_problem ||
                                $item->terminationEmployee->habitual_absent_attendance ||
                                $item->terminationEmployee->indecent_behavior)
                            {{ 1 }}
                        @endif
                    @endif
                </td>
                <td style="border: 1px solid black;">{{ date('d-M-y', strtotime($item->date)) }}</td>
                <td style="border: 1px solid black;">PLA</td>
                <td style="border: 1px solid black;">
                    Pro
                    {{-- @if ($item->resignation_id)
                        @if ($item->resignationEmployee->other == 1)
                            {{ $item->resignationEmployee->showthis ?? '' }}
                        @else
                            {{ $item->terminationEmployee->termination_desc ?? '' }}
                        @endif
                    @endif --}}
                </td>
                <td style="border: 1px solid black;">
                    {{ $item->separationEmployee->bankaccount->bank_account_number ?? '' }}</td>
            </tr>
            @php
                $total_termination_poor_performance += $item->terminationEmployee->poor_performance ?? 0;
                $total_termination_integrity_problem += $item->terminationEmployee->integrity_problem ?? 0;
                $total_termination_habitual_absent_attendance += $item->terminationEmployee->habitual_absent_attendance ?? 0;
                $total_termination_indecent_behavior += $item->terminationEmployee->indecent_behavior ?? 0;
                $total_number_of_termination += $total_termination ?? 0;

                $total_resignation_work_pressure_or_office_time += $item->resignationEmployee->work_pressure_or_office_time ?? 0;
                $total_resignation_rude_behaviours_by_supervisor += $item->resignationEmployee->rude_behaviours_by_supervisor ?? 0;
                $total_resignation_better_oppurtunity += $item->resignationEmployee->better_oppurtunity ?? 0;
                $total_resignation_doing_bussiness_or_others_mention += $item->resignationEmployee->doing_bussiness_or_others_mention ?? 0;
                $total_resignation_absent += $item->resignationEmployee->absent ?? 0;
                $total_number_of_regignation += $total_resignation ?? 0;
            @endphp
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th colspan="11" class="text-right"></th>
            <th class="text-right"
                style="vertical-align: middle; text-align: center; border: 1px solid black; background-color:#8EAADB;">
                {{ $total_termination_poor_performance ?? 0 }}</th>
            <th class="text-right"
                style="vertical-align: middle; text-align: center; border: 1px solid black; background-color:#8EAADB;">
                {{ $total_termination_integrity_problem ?? 0 }}</th>
            <th class="text-right"
                style="vertical-align: middle; text-align: center; border: 1px solid black; background-color:#8EAADB;">
                {{ $total_termination_habitual_absent_attendance ?? 0 }}</th>
            <th class="text-right"
                style="vertical-align: middle; text-align: center; border: 1px solid black; background-color:#8EAADB;">
                {{ $total_termination_indecent_behavior ?? 0 }}</th>
            <th class="text-right"
                style="vertical-align: middle; text-align: center; border: 1px solid black; background-color:#8EAADB;">
                {{ $total_number_of_termination }}</th>


            <th class="text-right"
                style="vertical-align: middle; text-align: center; border: 1px solid black; background-color:#8EAADB;">
                {{ $total_resignation_work_pressure_or_office_time }}</th>
            <th class="text-right"
                style="vertical-align: middle; text-align: center; border: 1px solid black; background-color:#8EAADB;">
                {{ $total_resignation_rude_behaviours_by_supervisor }}</th>
            <th class="text-right"
                style="vertical-align: middle; text-align: center; border: 1px solid black; background-color:#8EAADB;">
                {{ $total_resignation_better_oppurtunity }}</th>
            <th class="text-right"
                style="vertical-align: middle; text-align: center; border: 1px solid black; background-color:#8EAADB;">
                {{ $total_resignation_doing_bussiness_or_others_mention }}</th>
            <th class="text-right"
                style="vertical-align: middle; text-align: center; border: 1px solid black; background-color:#8EAADB;">
                {{ $total_resignation_absent }}</th>
            <th class="text-right"
                style="vertical-align: middle; text-align: center; border: 1px solid black; background-color:#8EAADB;">
                {{ $total_number_of_regignation }}</th>
            <th style="vertical-align: middle; text-align: center; border: 1px solid black; background-color:#8EAADB;">
                {{ $total_number_of_termination + $total_number_of_regignation }}</th>
            <th></th>
        </tr>
    </tfoot>
</table>
