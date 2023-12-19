@extends('back-end.premium.layout.premium-main')
@section('content')
    <section class="main-contant-section">
        <div class="content-box">
            <?php
            use App\Models\User;
            use App\Models\ObjectiveTypeConfig;
            use App\Models\Objective;
            use App\Models\ObjectiveDetails;
            ?>

            <?php
            use App\Models\ValueTypeDetail;
            use App\Models\valueTypeConfigDetail;
            ?>
            <?php
            $employee_rating = 0;
            $supervisor_rating = 0;
            ?>

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
    font-weight: 700;
    text-align: center;
    padding: 5px;
    text-transform: lowercase;
}

                .performance-report-pdf .section-title {
                    text-align: center;
                }
            </style>

            <div class="performance-report-pdf">
                <div class="header-info">
                    <div class="header-logo">
                        <img height="50" width="100px" src="{{ asset($company_logo->company_logo) }}" />
                        <p>STRICTLY CONFIDENTIAL WHEN COMPLETED</p>
                    </div>
                    <div class="section-title">
                        <h4>ANNUAL PERFORMANCE APPRAISAL FORM FOR BI (Form B)</h4>
                    </div>
                    <article>
                        <p>
                            You are requested to go through the PMS Handbook to get a detailed
                            understanding of the Performance Management Process and guidance on how
                            to complete the form. This form is for levels 11- 17 in BI HO and in
                            countries it is applicable to country management teams (programme and
                            departments in charge) and regional managers. The form is to be kept
                            with the employee throughout the year and submitted to the supervisor at
                            the end of the year.
                        </p>
                    </article>
                    <div class="check-box-content">
                        <div class="check-box">
                            <p>Annual <input type="text" /></p>
                            <p>Special <input type="text" /></p>
                            <p>Confirmation <input type="text" /></p>
                        </div>
                        <div class="date-info">
                            <p>Review Period</p>
                            <p>From <span> 2/ 4/ 2005 </span></p>
                            <p>To <span> 2/ 4/ 2005 </span></p>
                        </div>
                    </div>
                </div>
                <table class="responsive-table">
                    <tbody>
                        <tr>
                            <td colspan="6">
                                <h4>Staff Infomation</h4>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">Name Of The Staff:</td>
                            <td>{{ ucfirst($employee_info->objectiveReport->userfromobjective->first_name) }}
                                {{ ucfirst($employee_info->objectiveReport->userfromobjective->last_name) }}</td>
                            <td colspan="2">PIN:</td>
                            <td >{{ $employee_info->objectiveReport->userfromobjective->company_assigned_id }}
                            </td>
                        </tr>
                        <tr>
                            <td >Designation in use (including function):</td>
                            <td colspan="2">{{ $employee_info->objectiveReport->userdesignationfromobjective->designation_name }}</td>
                            <td >Last Performance related salary increase Date:</td>
                            <td colspan="2">
                                @if ($employee_info->objectiveReport->userfromobjective->salaryIncrement)
                                    @if ($employee_info->objectiveReport->userfromobjective->salaryIncrement->salary_history_approval_status == 1)
                                        {{ $employee_info->objectiveReport->userfromobjective->salaryIncrement->salary_history_increment_date }}
                                    @else
                                        {{ 'Not Applicable' }}
                                    @endif
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td >Organizational Unit (Program/Department):</td>
                            <td colspan="2">Loan Review Unit</td>
                            <td>Date of last Promotion:</td>
                            <td colspan="2">{{ $employee_info->objectiveReport->userfromobjective->promotion->promotion_date ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <td>Date of joining BRAC:</td>
                            <td colspan="2">{{ $employee_info->objectiveReport->userfromobjective->joining_date }}</td>
                            <td>Country:</td>
                            <td colspan="2">
                                {{ $employee_info->objectiveReport->userfromobjective->emoloyeedetail->userNationality->name ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">Date of joining BRAC International:</td>
                            <td>10.06.2009</td>
                            <td>Base Location:</td>
                            <td colspan="2">
                                {{ $employee_info->objectiveReport->userfromobjective->userregion->region_name ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                Educational Qualification: Graduate/Post Graduate/Professional/Others:
                            </td>
                            <td> {{ $employee_info->objectiveReport->userfromobjective->qualification->qualification_education_level ?? 'Not Selected' }}
                            </td>
                            <td>Contract/Regular:</td>
                            <td colspan="2">{{ $employee_info->objectiveReport->userfromobjective->job_nature ?? '' }}</td>
                        </tr>
                        <tr>
                            <td colspan="2">Present Level (HO):</td>
                            <td>XI</td>
                            <td colspan="2">Contract End Date:</td>
                            <td>
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
                            <td colspan="2">{{ $supervisor->first_name ?? 'Not Selected' }}
                                {{ $supervisor->last_name ?? 'Not Selected' }}</td>
                            <td>Last Contract Renewal Date:</td>
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
                            <td>Supervisor Designation:</td>
                            <td colspan="2">{{ $supervisor->userdesignation->designation_name ?? 'Not Selected' }}</td>
                            <td>Supervisor PIN:</td>
                            <td colspan="2">{{ ucfirst($supervisor->company_assigned_id ?? 'Not Selected') }}</td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <h4>
                                    02. OBJECTIVES FOR THE PERIOD UNDER REVIEW (To be filled by the
                                    Employee and approved by the Supervisor at the beginning of the
                                    year)
                                </h4>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                This section should report the objectives that have been cascaded to
                                you by your supervisor for the year. Please write a minimum of 1 and a
                                maximum of 5 SMART (Specific, Measurable, Achievable, Realistic, Time
                                Based) objectives in each section and total objectives will be minimum
                                3 and maximum 8.
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                Individual Objectives with Timeline (Please fill this at the beginning
                                of the year. Please specify your objectives here)
                            </td>
                            <td colspan="3">
                                Measures of Success (Please specify metrics for measuring the
                                objectives)
                            </td>
                        </tr>
                        @php($i = 1)
                        @foreach ($objectiveDetails->unique(fn($p) => $p->objectiveTypeConfig->userobjectivetypefromobjectiveconfig->objective_type_name) as $objective)
                            <?php //dd($objective);
                            ?>
                            <?php
                            $Objdetails = ObjectiveDetails::where('objective_obj_type_id', $objective->objective_obj_type_id)
                                ->where('objective_id', $objective->objective_id)
                                ->where('obj_detail_com_id', Auth::user()->com_id)
                                ->get();
                            ?>

                            <tr>
                                <td colspan="6">
                                    {{ $objective->objectiveTypeConfig->userobjectivetypefromobjectiveconfig->objective_type_name ?? null }}
                                    -
                                    {{ $objective->objectiveTypeConfig->obj_config_percent ?? null }}%
                                </td>
                            </tr>

                            @foreach ($Objdetails as $value)
                                <tr>
                                    <td colspan="3">{{ $value->objective_name }}</td>
                                    <td colspan="3"> {{ $value->objective_success }}</td>
                                </tr>
                    </tbody>
                    @endforeach
                    @endforeach
                    @if ($detailsDevelopment)
                        <tr>
                            <td colspan="6">
                                <h4>
                                    03. DEVELOPMENT PLAN FOR THE PERIOD UNDER REVIEW (To be filled by
                                    the Employee and approved by the Supervisor)
                                </h4>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">
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
                            <td >
                                Development Plan (Please fill this at the beginning of the year)
                            </td>
                            <td colspan="3">
                                Measures of Success (Please specify metrics for measuring the
                                development plan. Please fill this at the beginning of the year)
                            </td>
                            <td colspan="2">
                                Actions Taken (Please mention actions taken against the plan. Please
                                fill it at the year end)
                            </td>
                        </tr>
                        @foreach ($detailsDevelopment->developmentPlanDetails as $value)
                            <tr>
                                <td colspan="2">{{ $value->development_name }}</td>
                                <td colspan="3" style="text-align: center; border: 1px solid;">
                                    {{ $value->development_meassure_of_success }}
                                </td>
                                <td> {{ $value->development_action_taken }}
                                </td>
                            </tr>
                        @endforeach

                        <tr>
                            <td colspan="6">
                                <div class="singnature">
                                    <p>Employee Name</p>
                                    <p>Employee Signature</p>
                                    <p>Date</p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <div class="singnature">
                                    <p>Supervisor Name</p>
                                    <p>Supervisor Signature</p>
                                    <p>Date</p>
                                </div>
                            </td>
                        </tr>
                    @endif
                    <tr>
                        <td colspan="6">
                            <h4>4.YEARLY REVIEW</h4>
                        </td>
                    </tr>
                    <tr>
                        <td >
                            Individual Objectives with Timeline (Copy your set objectives here)
                        </td>
                        <td>Measures of Success (Copy your measures here)</td>
                        <td >
                            Actions Taken by Employee(Please fill this out. Specify your actual
                            achievements against set objectives)
                        </td>
                        <td>Supervisor Comments</td>
                        <td>Rating</td>
                        <td>Target Point</td>

                    </tr>
                    @foreach ($objectiveDetails->unique(fn($p) => $p->objectiveTypeConfig->userobjectivetypefromobjectiveconfig->objective_type_name) as $objective)
                        <?php //dd($objective);
                        ?>
                        <?php
                        $Objdetails = ObjectiveDetails::where('objective_obj_type_id', $objective->objective_obj_type_id)
                            ->where('objective_id', $objective->objective_id)
                            ->where('obj_detail_com_id', Auth::user()->com_id)
                            ->get();
                        ?>

                        <tr>
                            <th colspan="6" style="background-color: #04AA6D; text-align:center; color:#fff; font-size: 14px;">
                                {{ $objective->objectiveTypeConfig->userobjectivetypefromobjectiveconfig->objective_type_name ?? null }}
                                -
                                {{ $objective->objectiveTypeConfig->obj_config_percent ?? null }}%
                            </th>
                        </tr>


                        @foreach ($Objdetails as $value)
                            <tr style="">
                                <td style="text-align: center; border: 1px solid;">{{ $value->objective_name }}</td>
                                <td style="text-align: center; border: 1px solid;"> {{ $value->objective_success }}</td>
                                <td style="text-align: center; border: 1px solid;"> {{ $value->action_taken }}</td>
                                <td style="text-align: center; border: 1px solid;"> {{ $value->super_comments }}</td>
                                <td style="text-align: center; border: 1px solid;"> {{ $value->rating }}</td>
                                <td style="text-align: center; border: 1px solid;">
                                    {{ $value->objectiveTypeConfig->obj_config_target_point }}</td>

                            </tr>
                        @endforeach
                    @endforeach
                    <tr>
                        <td style="background-color: #eaee0c" colspan="4">Average Point:</td>
                        <td style="background-color: #eaee0c">{{ number_format((float) $marking_rating, 1, '.', '') }}</td>
                        <td style="background-color: #eaee0c">{{ number_format((float) $total_rating, 1, '.', '') }} </td>
                    </tr>

                    <tr>
                        <td colspan="6">
                            <div class="singnature">
                                <p>Employee Name: {{ $employee_info->objectiveReport->userfromobjective->first_name }}
                                    {{ $employee_info->objectiveReport->userfromobjective->last_name }}</p>
                                <p>Employee Signature</p>
                                <p>Date</p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            <div class="singnature">
                                <p>Supervisor Name: {{ $supervisor->first_name ?? 'Not Selected' }}
                                    {{ $supervisor->last_name ?? 'Not Selected' }}</p>
                                <p>Supervisor Signature</p>
                                <p>Date</p>
                            </div>
                        </td>
                    </tr>
                    @if (!$value_type_config_details->isEmpty())
                        <tr>
                            <td colspan="6">
                                <h4>iii) ASSESSMENT ON VALUES - YEAR END REVIEW</h4>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                The Supervisor should write comment on how they assessed the employee
                                on these values based on evidence of observed behaviors, and where the
                                employee needs improvement. Please provide one comment per value, but
                                each behavior statement must be rated using the rating scale of 3 - 1.
                            </td>
                        </tr>
                        <tr>
                            <td>Values</td>
                            <td colspan="2">Employee Comments with examples of behaviors</td>
                            <td colspan="">
                                Supervisor Comments with examples of behavior displayed or not
                                displayed
                            </td>
                            <td>Employee Ratings</td>
                            <td>Supervisor Rating (3 -1)</td>
                        </tr>
                        <?php
                        $employee_rating = 0;
                        $supervisor_rating = 0;
                        ?>
                        @foreach ($value_type_config_details->unique(fn($p) => $p->valuetype->value_type_name) as $variable_type)
                            <?php
                            $value_type_details = valueTypeConfigDetail::where('value_type_config_type_id', $variable_type->value_type_config_type_id)
                                ->where('value_type_config_id', $variable_type->value_type_config_id)
                                ->get();

                            ?>
                            <tr>
                                <th colspan="6" style="background-color: #04AA6D; text-align:center; color:#fff; font-size: 14px;">
                                    {{ $variable_type->valuetype->value_type_name }}

                                </th>
                            </tr>

                            <tr valign="top">
                                @foreach ($value_type_details as $value_type_detail)
                            <tr valign="top">

                                <td style="text-align: center; border: 1px solid;">
                                    {{ $value_type_detail->valueTypDeatils->value_type_detail_value ?? null }}</td>
                                <td style="text-align: center; border: 1px solid;">
                                    {{ $value_type_detail->value_type_config_Employee_behaviour ?? null }} </td>
                                <td style="text-align: center; border: 1px solid;">
                                    {{ $value_type_detail->value_type_config_supervisor_comment ?? null }}</td>
                                <td></td>
                                <td style="text-align: center; border: 1px solid;">
                                    {{ $value_type_detail->value_type_config_employee_rating == 3 ? 'A' : '' }}
                                    {{ $value_type_detail->value_type_config_employee_rating == 2 ? 'B' : '' }}
                                    {{ $value_type_detail->value_type_config_employee_rating == 1 ? 'C' : '' }}

                                </td>
                                <td style="text-align: center; border: 1px solid;">
                                    {{ $value_type_detail->value_type_config_supervisor_rating == 3 ? 'A' : '' }}
                                    {{ $value_type_detail->value_type_config_supervisor_rating == 2 ? 'B' : '' }}
                                    {{ $value_type_detail->value_type_config_supervisor_rating == 1 ? 'C' : '' }}

                                </td>
                            </tr>
                        @endforeach
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="4" style="background-color: #eaee0c">Value Point Average</td>
                        <td style="background-color: #eaee0c">
                            @if ($value_employee_rating == 3)
                                {{ __('A') }}
                            @elseif($value_employee_rating >= 2)
                                {{ __('B') }}
                            @elseif($value_employee_rating >= 1)
                                {{ __('C') }}
                            @endif
                        </td>
                        <td style="background-color: #eaee0c">
                            @if ($value_supervisor_rating == 3)
                                {{ __('A') }}
                            @elseif($value_supervisor_rating >= 2)
                                {{ __('B') }}
                            @elseif($value_supervisor_rating >= 1)
                                {{ __('C') }}
                            @endif
                        </td>
                    </tr>
                    @endif
                    <tr>
                        <td colspan="6">
                            <h4>07. OVERALL ASSESSMENT (To be completed by supervisor)</h4>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <ul>
                                <li>i) Overall Objective Rating</li>
                                <li>ii) Overall Values Rating</li>
                                <li>iii) Total Rating</li>
                                <li>iV) Supervisor Comments:</li>
                            </ul>
                        </td>
                        <td colspan="3">
                            <ul>
                                <li>
                                    (Please refer to the rating given from the objectives section)
                                </li>
                                <li>
                                    (Please refer to the values grid in section 7 below. A, B, or C
                                    rating to be mentioned here.)
                                </li>
                                <li>
                                    (Combine the Overall Ratings of Objectives and Values above to get
                                    a Total Rating)
                                </li>
                            </ul>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table style="width: 100%">
                <tbody>
                    <tr>
                        <td colspan="6">
                            <h4>08.OBJECTIVE RATING SCALE:</h4>
                        </td>
                    </tr>
                    <tr>
                        <th colspan="3">Objective Rating</th>
                        <th colspan="3"> Rating Defination</th>
                     </tr>
                 
                 
                     @foreach ($rating_scale as $item)
                     <tr>
                         <td colspan="3">{{ $item->point }} </td>
                         <td colspan="3">{{ $item->defination }} </td>
                     </tr>
                     @endforeach
                </tbody>
            </table>
            <table style="width: 100%">
                <tbody>
                    <tr>
                        <td colspan="6">
                            <h4>VALUES SCORING SCALE - to be given against each statement</h4>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">Consistently and always displays the values</td>
                        <td colspan="2">3</td>
                    </tr>
                    <tr>
                        <td colspan="4">Displays the Values however falls short sometimes</td>
                        <td colspan="2">2</td>
                    </tr>
                    <tr>
                        <td colspan="4">Displays the values to a little or no extent</td>
                        <td colspan="2">1</td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            <h4>VALUES FINAL SCORING GRID</h4>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            Grade A - Consistently and always displays the values
                        </td>
                        <td colspan="2">3</td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            Grade B- Displays the values however falls short sometimes
                        </td>
                        <td colspan="2">2</td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            Grade C - Displays the values to a little or no extent
                        </td>
                        <td colspan="2">1</td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            <h4>VALUES FINAL SCORING GRID</h4>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            <div class="comment-section"></div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            <h4>
                                8 i) SUPERVISOR'S RECOMMENDATION ON STAFF PERFORMANCE (To be
                                completed by supervisor)
                            </h4>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">Transfer</td>
                        <td colspan="4">
                            <p>Location:</p>
                            <p>Reason for:</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">Promotion</td>
                        <td colspan="4">
                            <div class="flex-content">
                                <p>New Level/New position:</p>
                                <p>Budget availability:</p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">Allowance</td>
                        <td colspan="4">
                            <div class="flex-content">
                                <p>Technical: <span> </span></p>
                                <p>Performance: <span> </span></p>
                                <p>Special: <span> </span></p>
                                <p>Others: <span> </span></p>
                            </div>
                            <p>reason:</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">Contract Renewal</td>
                        <td colspan="4">
                            <p>New Level/New position:</p>
                            <p>Duration:</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">Confirmation</td>
                        <td colspan="4">Level/Designation:</td>
                    </tr>
                    <tr>
                        <td colspan="2">Others</td>
                        <td colspan="4">Details</td>
                    </tr>
                    <tr>
                        <td colspan="2">If none of the above</td>
                        <td colspan="4">Reason</td>
                    </tr>
                    <tr>
                        <td colspan="2">If none of the above</td>
                        <td colspan="4">
                            <div class="singnature">
                                <p>Signature</p>
                                <p>Date</p>
                                <p>PIN</p>
                                <p>Designation</p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">2nd Level Supervisor Name Comments (if any)</td>
                        <td colspan="4">
                            <div class="singnature">
                                <p>Signature</p>
                                <p>Date</p>
                                <p>PIN</p>
                                <p>Designation</p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            <h4>
                                iii) COMMENTS OF ADDITIONAL SUPERVISOR (in case of dotted line
                                reporting)
                            </h4>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">Name</td>
                        <td colspan="4">
                            <div class="singnature">
                                <p>Signature</p>
                                <p>Date</p>
                                <p>PIN</p>
                                <p>Designation</p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            <h4>iv) HRD COMMENTS</h4>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">Name of HR Official</td>
                        <td colspan="4">
                            <div class="singnature">
                                <p>Signature</p>
                                <p>Date</p>
                                <p>PIN</p>
                                <p>Designation</p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            <h4>v)</h4>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <p>Recommendation/Approval: (where applicable)</p>
                            <div class="singnature">
                                <p>PH/CR/AD/Anchor/Director/Sr. Director</p>
                                <p>Date</p>
                            </div>
                        </td>
                        <td colspan="3">
                            <p>Approval: (where applica</p>
                            <div class="singnature">
                                <p>ED</p>
                                <p>Date</p>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

    </section>

@endsection
