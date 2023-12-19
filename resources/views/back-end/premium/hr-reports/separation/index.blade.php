@extends('back-end.premium.layout.premium-main')

@section('content')
    <section class="main-contant-section">

    <div class="">
        <div class="card mb-0">

            <div class="card mb-0">
                <div class="card-header with-border">
                    <h1 class="card-title text-center"> {{ __('Separation  Report') }} </h1>
                    <ol id="breadcrumb1">
                        <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                        <li> <a href="{{ route('separation-report-downlaods') }}"><span class="fa fa-arrow-down"> Excel Download</span></a></li>
                        <li><a href="#">{{ 'Separation Report' }} </a></li>
                    </ol>
                </div>

                {{-- <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="start_date">{{__('Month')}}</label>
                            <input class="form-control" name="month_year" type="month">
                        </div>
                    </div>
                    <div class="col-md-4 mt-2">
                        <div class="form-group">
                            <br>
                            <a href="{{ route('separation-report-downlaods') }}"><span class="fa fa-arrow-down"> Excel Download</span></a>
                        </div>
                    </div>
                </div> --}}
        </div>
    </div>

    <div class="content-box">

        <div class="table-responsive">
          <table id="user-table" class="table table-bordered table-hover table-striped display nowrap" id="example"
                style="width:100%">
                <thead>
                    <tr>
                        <th colspan="10"></th>
                        <th colspan="4"> Reason of Close/Termination </th>
                        <th rowspan="2"> Total Termination </th>
                        <th colspan="5">Reason of Resignation/ Absent </th>
                        <th rowspan="2"> Total Resignation </th>
                        <th rowspan="2"> Total </th>
                        <th rowspan="2"> Effective date </th>
                        <th rowspan="2"> Vendors </th>
                        <th rowspan="2"> Specific Reason </th>
                        <th rowspan="2"> DBBL/AC </th>
                    </tr>
                    <tr>
                        <th> Separation Month </th>
                        <th> Sl </th>
                        <th> ID no. </th>
                        <th> Name of PSR </th>
                        <th> Territory </th>
                        <th> SE_Area </th>
                        <th> Joining Date. </th>
                        <th> Name of Distributors </th>
                        <th> Location </th>

                        <th> Mobile No. of PSR </th>
                        <th> Poor Performance </th>
                        <th> Integrity Problem </th>
                        <th> Habitual Absent/attendance </th>
                        <th> Indecent Behavior </th>
                        <th> Work Pressure/ Office Time </th>
                        <th>Rude Behaviours by Supervisor </th>
                        <th> Better Opportunity </th>
                        <th> Doing business/ Others (Mention) </th>
                        <th>Absent </th>
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
                    @foreach ($separations as $item)
                    <tr>
                        <td>{{ date("M'y", strtotime($item->date)) }}</td>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->separationEmployee->company_assigned_id }}</td>
                        <td>{{ $item->separationEmployee->first_name }} {{ $item->separationEmployee->last_name }}
                        </td>
                        <td>{{ $item->separationEmployee->userregion->region_name ?? ''}}</td>
                        <td>{{ $item->separationEmployee->userarea->area_name ?? ''}}</td>
                        <td>{{ $item->separationEmployee->joining_date ?? ''}}</td>
                        <td>{{ $item->separationEmployee->userterritory->territory_name ?? ''}}</td>
                        <td>
                            {{ $item->separationEmployee->userregion->region_name ?? ''}}
                            {{ $item->separationEmployee->userarea->area_name ?? ''}}
                            {{ $item->separationEmployee->userterritory->territory_name ?? ''}}
                            {{ $item->separationEmployee->usertown->town_name ?? '' }}
                        </td>

                        <td>{{ $item->separationEmployee->phone ?? '' }}</td>

                        <td>{{ $item->terminationEmployee->poor_performance ?? '' }}</td>
                        <td>{{ $item->terminationEmployee->integrity_problem ?? '' }}</td>
                        <td>{{ $item->terminationEmployee->habitual_absent_attendance ?? '' }}</td>
                        <td>{{ $item->terminationEmployee->indecent_behavior ?? '' }}</td>
                        <td>
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

                        <td>{{ $item->resignationEmployee->work_pressure_or_office_time ?? '' }}</td>
                        <td>{{ $item->resignationEmployee->rude_behaviours_by_supervisor ?? '' }}</td>
                        <td>{{ $item->resignationEmployee->better_oppurtunity ?? '' }}</td>
                        <td>{{ $item->resignationEmployee->doing_bussiness_or_others_mention ?? '' }}</td>
                        <td>{{ $item->resignationEmployee->absent ?? '' }}</td>
                        <td>
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

                        <td>

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
                        <td>{{ date('d-M-y', strtotime($item->date)) }}</td>
                        <td>PLA</td>
                        <td>
                            pro
                        </td>
                        <td>{{ $item->separationEmployee->bankaccount->bank_account_number ?? '' }}</td>
                    </tr>
                    @php
                    $total_termination_poor_performance += $item->terminationEmployee->poor_performance ?? 0;
                    $total_termination_integrity_problem += $item->terminationEmployee->integrity_problem ?? 0;
                    $total_termination_habitual_absent_attendance +=
                    $item->terminationEmployee->habitual_absent_attendance ?? 0;
                    $total_termination_indecent_behavior += $item->terminationEmployee->indecent_behavior ?? 0;
                    $total_number_of_termination += $total_termination ?? 0;

                    $total_resignation_work_pressure_or_office_time +=
                    $item->resignationEmployee->work_pressure_or_office_time ?? 0;
                    $total_resignation_rude_behaviours_by_supervisor +=
                    $item->resignationEmployee->rude_behaviours_by_supervisor ?? 0;
                    $total_resignation_better_oppurtunity += $item->resignationEmployee->better_oppurtunity ?? 0;
                    $total_resignation_doing_bussiness_or_others_mention +=
                    $item->resignationEmployee->doing_bussiness_or_others_mention ?? 0;
                    $total_resignation_absent += $item->resignationEmployee->absent ?? 0;
                    $total_number_of_regignation += $total_resignation ?? 0;
                    @endphp
                    @endforeach
                </tbody>
                {{-- <tfoot>
                    <tr>
                        <th colspan="11" class="text-right"></th>
                        <th class="text-right">{{ $total_termination_poor_performance ?? 0 }}</th>
                        <th class="text-right">{{ $total_termination_integrity_problem ?? 0 }}</th>
                        <th class="text-right">{{ $total_termination_habitual_absent_attendance ?? 0 }}</th>
                        <th class="text-right">{{ $total_termination_indecent_behavior ?? 0 }}</th>
                        <th class="text-right">{{ $total_number_of_termination }}</th>


                        <th class="text-right">{{ $total_resignation_work_pressure_or_office_time }}</th>
                        <th class="text-right">{{ $total_resignation_rude_behaviours_by_supervisor }}</th>
                        <th class="text-right">{{ $total_resignation_better_oppurtunity }}</th>
                        <th class="text-right">{{ $total_resignation_doing_bussiness_or_others_mention }}</th>
                        <th class="text-right">{{ $total_resignation_absent }}</th>
                        <th class="text-right">{{ $total_number_of_regignation }}</th>
                        <th>{{ $total_number_of_termination + $total_number_of_regignation}}</th>
                        <th></th>
                    </tr>
                </tfoot> --}}
            </table>
        </div>
    </div>
</section>



@endsection
