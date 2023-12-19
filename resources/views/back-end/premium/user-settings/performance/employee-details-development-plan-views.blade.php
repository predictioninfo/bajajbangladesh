@extends('back-end.premium.layout.premium-main')
@section('content')
    <section class="main-contant-section">
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
    font-size: 16px;
    text-align: center;
    font-weight: 700;
    padding: 5px;
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
                                <h1 class="card-title text-center">Employees Development Plans Details View </h1>
                                <ol id="breadcrumb1">
                                    <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                                    <li><a href="{{ route('employee-objectives') }}"><span
                                        class="icon icon-list"> </span> List</a></li>
                                    <li><a href="#">Show - {{ ' Development Plan Details' }} </a></li>
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
                                <td >Name Of The Staff:</td>
                                <td>{{ ucfirst($employee_info->developmentPlans->user->first_name) }}
                                    {{ ucfirst($employee_info->developmentPlans->user->last_name) }}</td>
                                <td>PIN:</td>
                                <td >{{ $employee_info->developmentPlans->user->company_assigned_id }}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">Designation in use (including function):</td>
                                <td colspan="2">{{ $employee_info->developmentPlans->userdesignation->designation_name }}</td>

                            </tr>

                            <tr>
                                <td>Date of joining :</td>
                                <td>{{ $employee_info->developmentPlans->user->joining_date }}</td>
                                <td>Country:</td>
                                <td >
                                    {{ $employee_info->developmentPlans->userfromobjective->emoloyeedetail->userNationality->name ?? '' }}
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    Educational Qualification: Graduate/Post Graduate/Professional/Others:
                                </td>
                                <td>{{ $employee_info->developmentPlans->userfromobjective->qualification->qualification_education_level ?? 'Not Selected' }}
                                </td>
                                <td>Contract/Regular:</td>
                                <td>{{ $employee_info->developmentPlans->user->job_nature ?? '' }}</td>
                            </tr>
                            <tr>

                                <td colspan="2">Contract End Date:</td>
                                <td colspan="2">
                                    @if ($employee_info->developmentPlans->user->employment_type == 'Contactual')
                                <td scope="col">
                                    {{ $employee_info->developmentPlans->user->expiry_date }}</td>
                            @else
                                {{ 'Not Applicable' }}
                                @endif
                                </td>
                            </tr>

                            <tr>

                        <tbody>
                            <tr>
                                <td colspan="4">
                                    <h4>
                                        03. DEVELOPMENT PLAN FOR THE PERIOD UNDER REVIEW (To be filled by
                                        the Employee and approved by the Supervisor)
                                    </h4>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    This section should capture your Development Plans for the year.
                                    Please focus on 1-3 important development goals ie areas you want to
                                    improve upon. Your development goals should support you in achieving
                                    your individual objectives above. The development plan should capture
                                    activities through on-the-job experience, exposure by working on
                                    cross-functional projects and networking assignments; and classroom
                                    training provided by internal or external providers.
                                </td>
                            </tr>
                            <tr>
                                <td style="background-color: #04AA6D; text-align:center; color:#fff;">
                                    Development Plan (Please fill this at the beginning of the year)
                                </td>
                                <td colspan="2" style="background-color: #04AA6D; text-align:center; color:#fff;">
                                    Measures of Success (Please specify metrics for measuring the
                                    development plan. Please fill this at the beginning of the year)
                                </td>
                                <td style="background-color: #04AA6D; text-align:center; color:#fff;">
                                    Actions Taken (Please mention actions taken against the plan. Please
                                    fill it at the year end)
                                </td>
                            </tr>

                            @foreach ($detailsDevelopment->developmentPlanDetails as $value)
                            <tr>
                                <td colspan="2">{{ $value->development_name }}</td>
                                <td style="text-align: center; border: 1px solid;">
                                    {{ $value->development_meassure_of_success }}
                                </td>
                                <td> {{ $value->development_action_taken }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
