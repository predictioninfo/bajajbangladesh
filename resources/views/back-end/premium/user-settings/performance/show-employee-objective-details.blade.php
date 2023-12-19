@extends('back-end.premium.layout.premium-main')
@section('content')
    <section class="main-contant-section">
        <?php
        use App\Models\User;
        use App\Models\ObjectiveTypeConfig;
        use App\Models\Objective;
        use App\Models\ObjectiveDetails;
        ?>
        <div class="">
            <style>
                .performance-report-pdf .header-logo {
                    display: flex;
                    flex-direction: row;
                    justify-content: space-between;
                    align-items: center;
                }

                .performance-report-pdf .check-box {
                    display: flex;
                    flex-direction: row;
                    justify-content: space-between;
                    align-items: center;
                }

                .performance-report-pdf .date-info {
                    display: flex;
                    flex-direction: row;
                    justify-content: space-between;
                    align-items: center;
                }

                table tr td {
                    border: 1px solid #333;
                    padding: 3px 5px;
                }

                table tr th {
                    border: 1px solid #333;
                    padding: 3px 5px;

                }

                .singnature {
                    display: flex;
                    flex-direction: row;
                    justify-content: space-between;
                    align-items: end;
                    width: 100%;
                    gap: 20px;
                    text-align: center;
                }

                .singnature p {
                    border-top: 1px solid #000;
                    width: 100%;
                    margin-bottom: 0;
                }

                .flex-content {
                    display: flex;
                    flex-direction: row;
                    justify-content: space-between;
                    align-items: end;
                    width: 100%;
                    gap: 20px;
                    text-align: left;
                }

                .flex-content p {
                    width: 100%;
                    margin-bottom: 0;
                }

                table tr td h4 {
    margin: 0;
    font-size: 15px;
    padding: 4px;
    text-align: center;
    font-weight: 700;
}

                .performance-report-pdf .section-title {
                    text-align: center;
                }
            </style>

            <div class="performance-report-pdf">
                <div class="header-info">

                    <div class="section-title">


                         <div class="card mb-0">
                        <div class="card-header with-border">
                            <h1 class="card-title text-center"> Employees Objective Details View </h1>
                            <ol id="breadcrumb1">
                                <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                                <li><a href="{{ route('employee-objectives') }}"><span
                                    class="icon icon-list"> </span> List</a></li>
                                <li><a href="#">Show - {{ 'Objective Details' }} </a></li>
                            </ol>
                        </div>
                    </div>

                    </div>


                </div>
                <div class="content-box">
                    <div class="table-responsive">
                    <table class="">
                    <tbody>
                        <tr>
                            <td colspan="4">
                                <h4>Staff Infomation</h4>
                            </td>
                        </tr>
                        <tr>
                            <td>Name Of The Staff:</td>
                            <td>{{ ucfirst($employee_info->objectiveReport->userfromobjective->first_name) }}
                                {{ ucfirst($employee_info->objectiveReport->userfromobjective->last_name) }}</td>
                            <td>PIN:</td>
                            <td >{{ $employee_info->objectiveReport->userfromobjective->company_assigned_id }}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">Designation in use (including function):</td>
                            <td colspan="2">{{ $employee_info->objectiveReport->userdesignationfromobjective->designation_name }}</td>

                        </tr>

                        <tr>
                            <td>Date of joining :</td>
                            <td>{{ $employee_info->objectiveReport->userfromobjective->joining_date }}</td>
                            <td>Country:</td>
                            <td>
                                {{ $employee_info->objectiveReport->userfromobjective->emoloyeedetail->userNationality->name ?? '' }}
                            </td>
                        </tr>

                        <tr>
                            <td >
                                Educational Qualification: Graduate/Post Graduate/Professional/Others:
                            </td>
                            <td>{{ $employee_info->objectiveReport->userfromobjective->qualification->qualification_education_level ?? 'Not Selected' }}
                            </td>
                            <td >Contract/Regular:</td>
                            <td>{{ $employee_info->objectiveReport->userfromobjective->job_nature ?? '' }}</td>
                        </tr>
                        <tr>

                            <td colspan="2">Contract End Date:</td>
                            <td colspan="2">
                                @if ($employee_info->objectiveReport->userfromobjective->employment_type == 'Contactual')
                            <td scope="col">
                                {{ $employee_info->objectiveReport->userfromobjective->expiry_date }}</td>
                        @else
                            {{ 'Not Applicable' }}
                            @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Supervisor Name:</td>
                            <td>{{ $supervisor->first_name ?? 'Not Selected' }}
                                {{ $supervisor->last_name ?? 'Not Selected' }}</td>
                            <td>Last Contract Renewal Date:</td>
                            <td>
                                @if ($employee_info->objectiveReport->userfromobjective->employment_type == 'Contactual')
                            <td>
                                {{ $employee_info->objectiveReport->userfromobjective->expiry_date }}</td>
                        @else
                            {{ 'Not Applicable' }}
                            @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Supervisor Designation:</td>
                            <td>{{ $supervisor->userdesignation->designation_name ?? 'Not Selected' }}</td>
                            <td>Supervisor PIN:</td>
                            <td>{{ ucfirst($supervisor->company_assigned_id ?? 'Not Selected') }}</td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <h4>
                                    02. OBJECTIVES FOR THE PERIOD UNDER REVIEW (To be filled by the
                                    Employee and approved by the Supervisor at the beginning of the
                                    year)
                                </h4>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                This section should report the objectives that have been cascaded to
                                you by your supervisor for the year. Please write a minimum of 1 and a
                                maximum of 5 SMART (Specific, Measurable, Achievable, Realistic, Time
                                Based) objectives in each section and total objectives will be minimum
                                3 and maximum 8.
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                Individual Objectives with Timeline (Please fill this at the beginning
                                of the year. Please specify your objectives here)
                            </td>
                            <td colspan="2">
                                Measures of Success (Please specify metrics for measuring the
                                objectives)
                            </td>
                        </tr>
                        @php($i = 1)
                        @foreach ($objectiveDetails->unique(fn($p) => $p->objectiveTypeConfig->userobjectivetypefromobjectiveconfig->objective_type_name) as $objective)

                            <?php
                            $Objdetails = ObjectiveDetails::where('objective_obj_type_id', $objective->objective_obj_type_id)
                                ->where('objective_id', $objective->objective_id)
                                ->where('obj_detail_com_id', Auth::user()->com_id)
                                ->get();
                            ?>
                            <tr>
                                <td colspan="4" style="background-color: #04AA6D; text-align:center; color:#fff;">
                                    <h4>
                                    {{ $objective->objectiveTypeConfig->userobjectivetypefromobjectiveconfig->objective_type_name ?? null }}
                                    -
                                    {{ $objective->objectiveTypeConfig->obj_config_percent ?? null }}%
                                    </h4>
                                </td>
                            </tr>

                            @foreach ($Objdetails as $value)
                                <tr>
                                    <td colspan="2">{{ $value->objective_name }}</td>
                                    <td colspan="2"> {{ $value->objective_success }}</td>
                                </tr>
                    </tbody>
                    @endforeach
                    @endforeach

                </table>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
