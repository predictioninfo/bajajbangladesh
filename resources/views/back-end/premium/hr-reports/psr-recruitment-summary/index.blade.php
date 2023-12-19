@extends('back-end.premium.layout.premium-main')

@section('content')


<section class="main-contant-section">

    <div class=""><span id="general_result"></span></div>

    @php
    use App\Models\WorkExperience;
    use App\Models\Qualification;
    @endphp

    <div class="">
        <div class="card mb-0">

            <div class="card mb-0">
                <div class="card-header with-border">
                    <h1 class="card-title text-center"> {{ __('PSR Recruitment Summary Report') }} </h1>
                    <ol id="breadcrumb1">
                        <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                        <li> <a href="{{ route('psr-recruitment-summary-report-downloads') }}"><span class="fa fa-arrow-down"> Excel Download</span></a></li>
                        <li><a href="#">{{ 'PSR Recruitment Report' }} </a></li>
                    </ol>
                </div>


        </div>
    </div>

    <div class="content-box">

        <div class="table-responsive">
            <table id="user-table" class="table table-bordered table-hover table-striped">
                <thead style="background-color:#20898f; color:white;">
                    <tr>
                        <td rowspan=3>SL</td>
                        <td rowspan=3>ID </td>
                        <td rowspan=3>Candidates Name </td>
                        <td rowspan=3> Month </td>
                        <td rowspan=3>Assigned Terrrtory</td>
                        <td rowspan=3> Assigned SE Area</td>
                        <td rowspan=3>Placement DB </td>
                        <td rowspan=3>DOJ </td>
                        <td rowspan=3>Mobile </td>
                        <td colspan=2>Total Year of Experience Year </td>
                        <td rowspan=3>Current/Last Company </td>
                        <td rowspan=3>Current/Last Salary including TA DA (Without Incentive) </td>
                        <td rowspan=3>Date of Birth </td>
                        <td colspan=4> Education </td>
                    </tr>
                    <tr>
                        <td rowspan=2>Fresh candidates </td>
                        <td rowspan=2>Total Years </td>

                        <td colspan=2>Under graduate</td>
                        <td colspan=2></td>
                    </tr>
                    <tr>
                        <td>SSC </td>
                        <td>HSC </td>
                        <td>Pass/ Hons Master </td>
                        <td> Institution </td>
                    </tr>


                </thead>
                {{-- Tbody Start --}}
                <tbody>
                    @foreach ($employees as $employee)
                    <tr>
                        <td>{{ $loop->iteration }} </td>
                        <td>{{ $employee->company_assigned_id }} </td>
                        <td>{{ $employee->first_name . ' ' . $employee->last_name }} </td>
                        <td>{{ date('M-y', strtotime($employee->joining_date)) }} </td>
                        <td>{{ $employee->userterritory->territory_name ?? '' }} </td>
                        <td>{{ $employee->userarea->area_name ?? '' }} </td>
                        <td>
                            @if ($employee->userdbhouse)
                            {{ $employee->userdbhouse->db_house_name ?? '' }}
                            @endif
                        </td>


                        <td>{{ $employee->joining_date }} </td>
                        <td>{{ $employee->phone }} </td>
                        <td>
                            @if ($employee->emoloyeedetail)
                            @if ($employee->emoloyeedetail->previous_organization == '')
                            {{ 'Fresh' }}
                            @endif
                            @endif
                        </td>
                        <td>
                            @php
                            $work_expriences = WorkExperience::where('work_experience_employee_id',
                            $employee->id)->sum('total_year_of_experience');
                            echo $work_expriences;
                            @endphp
                        </td>
                        <td>
                            @if ($employee->emoloyeedetail)
                            {{ $employee->emoloyeedetail->previous_organization ?? '' }}
                            @endif
                        </td>

                        <td>
                            @if ($employee->emoloyeedetail)
                            {{ $employee->emoloyeedetail->last_salary ?? '' }}
                            @endif
                        </td>
                        <td>{{ $employee->date_of_birth }} </td>
                        <td>@php
                            $qualification = Qualification::where('qualification_employee_id', $employee->id)->get();
                            foreach ($qualification as $item) {
                            if ($item->qualification_education_level == 'SSC') {
                            echo $item->qualification_education_level;
                            }
                            }
                            @endphp </td>
                        <td>@php
                            $qualification = Qualification::where('qualification_employee_id', $employee->id)->get();
                            foreach ($qualification as $item) {
                            if ($item->qualification_education_level == 'HSC') {
                            echo $item->qualification_education_level;
                            }
                            }
                            @endphp </td>
                        <td>@php
                            $qualification = Qualification::where('qualification_employee_id', $employee->id)->get();
                            foreach ($qualification as $item) {
                            if ($item->qualification_education_level == 'BA' || $item->qualification_education_level ==
                            'Dakhil' || $item->qualification_education_level == 'BBS' ||
                            $item->qualification_education_level == 'BBA' || $item->qualification_education_level ==
                            'MBA') {
                            echo $item->qualification_education_level;
                            }
                            }
                            @endphp </td>
                        <td>{{ $employee->educationdetail->qualification_institute_name ?? '' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>


<script type="text/javascript">
    $(document).ready( function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

            $('#user-table').DataTable({
                    "aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],
                    "iDisplayLength": 25,

                    dom: '<"row"lfB>rtip',

                    buttons: [
                        {
                            extend: 'pdf',
                            text: '<i title="export to pdf" class="fa fa-file-pdf-o"></i>',
                            exportOptions: {
                                columns: ':visible:Not(.not-exported)',
                                rows: ':visible'
                            },
                        },
                        {
                            extend: 'csv',
                            text: '<i title="export to csv" class="fa fa-file-text-o"></i>',
                            exportOptions: {
                                columns: ':visible:Not(.not-exported)',
                                rows: ':visible'
                            },
                        },
                        {
                            extend: 'print',
                            text: '<i title="print" class="fa fa-print"></i>',
                            exportOptions: {
                                columns: ':visible:Not(.not-exported)',
                                rows: ':visible'
                            },
                        },
                        {
                            extend: 'colvis',
                            text: '<i title="column visibility" class="fa fa-eye"></i>',
                            columns: ':gt(0)'
                        },
                    ],
                });
   });

</script>
@endsection
