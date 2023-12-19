<?php
use App\Models\User;
use App\Models\ObjectiveTypeConfig;
use App\Models\Objective;
use App\Models\ObjectiveDetails;
use App\Models\valueTypeConfigDetail;
?>
<section class="main-contant-section">
    <div class="">
        <div class="content-box">
            <div class="objective-contant">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="text-center">Yearly Performance Review</h2>
                        <p>This section should review overall performance against all objectives including any changes
                            made during the course of the year. The Employee should complete his/her
                            section first. This should be followed by a conversation between the Employee and Supervisor
                            after which the Supervisor completes his/her sections.Supervisor needs
                            to complete the ratings and share this with the employee. Once both have signed off, the
                            supervisor may include his/her recommendations
                            in section 8i (to be kept confidential from employee) and arrange for the next level
                            supervisor's sign off and send to HR for their comments and
                            further processing.</p>
                    </div>
                    <div class="col-md-12">
                        @php
                            $getPoint = 0;
                            $totalPoint = 0;
                            
                        @endphp
                        @php($i = 1)

                        <table class="form-table">
                            <tr valign="top">

                                <th>
                                    Individual Objective With Timeline
                                </th>
                                <th>
                                    Measures Of Success
                                </th>
                                <th>
                                    Actions Taken by Employee(Please fill this out. Specify your actual achievements
                                    against set objectives)
                                </th>
                                <th>
                                    Supervisor Comments
                                </th>
                                <th>
                                    Marking
                                </th>
                                <th>
                                    Total Marking
                                </th>
                            </tr>
                            @foreach ($objectivesMarking->unique(fn($p) => $p->objectiveTypes->objective_type_name) as $objective)
                                <?php
                                $Objdetails = ObjectiveDetails::where('objective_obj_type_id', $objective->objective_obj_type_id)
                                    ->where('objective_id', $objective->objective_id)
                                    ->where('obj_detail_com_id', Auth::user()->com_id)
                                    ->get();
                                
                                ?>

                                <tr>
                                    <td colspan="8" class="text-center"> <b>

                                            {{ $objective->objectiveTypes->objective_type_name ?? '' }} -
                                            {{ $objective->objectiveTypeConfig->obj_config_percent ?? '' }} %</b>
                                    </td>

                                </tr>

                                @foreach ($Objdetails as $value)
                                    <?php
                                    $getPoint += $value->rating;
                                    $totalPoint += $value->objectiveTypeConfig->obj_config_target_point;
                                    
                                    ?>

                                    <tr valign="top">

                                        <td>
                                            {{ $value->objective_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $value->objective_success ?? '' }}
                                        </td>
                                        <td>
                                            {{ $value->action_taken ?? '' }}
                                        </td>
                                        <td>
                                            {{ $value->super_comments ?? '' }}
                                        </td>
                                        <td> {{ $value->rating ?? '' }} </td>
                                        <td> {{ $value->objectiveTypeConfig->obj_config_target_point ?? '' }}
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach

                            <tr>
                                <td class="grand_total text-right " colspan="4">Average Rating for Objectives :
                                </td>
                                <td>{{ number_format((float) $marking_rating, 1, '.', '') }}</td>
                                <td>{{ number_format((float) $total_rating, 1, '.', '') }} </td>

                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            @if ($employee_id)
                <div class="content-box">
                    <div class="section-title">
                        <h1 class="text-center">ASSESSMENT ON VALUES - YEAR END REVIEW</h1>
                    </div>
                    <p>The Supervisor should write comment on how they assessed the employee on these values based
                        on evidence of observed behaviors,
                        and where the employee needs improvement. Please provide one comment per value, but each
                        behavior statement must be rated using the rating scale of A - C. </p>
                    <table class="form-table">


                        <th>Values</th>
                        <th class="text-center">
                            Employee Comments with examples of behaviors
                        </th>
                        <th class="text-center">
                            Supervisor Comments with examples of behavior displayed or not displayed
                        </th>
                        <th class="text-center">
                            Employee Rating
                        </th>
                        <th class="text-center">
                            Supervisor Rating
                        </th>
                        @foreach ($value_type_config_details->unique(fn($p) => $p->valuetype->value_type_name ?? '') as $variable_type)
                            <?php
                            $value_type_details = valueTypeConfigDetail::where('value_type_config_type_id', $variable_type->value_type_config_type_id)
                                ->where('value_type_config_id', $variable_type->value_type_config_id)
                                ->get();
                            
                            ?>

                            <tr>
                                <th colspan="7" class="text-center">
                                    {{ $variable_type->valuetype->value_type_name ?? '' }}

                                </th>
                            </tr>

                            <tr valign="top">
                                @foreach ($value_type_details as $value_type_detail)
                            <tr valign="top">
                                <td>{{ $value_type_detail->valueTypDeatils->value_type_detail_value ?? null }}
                                </td>
                                <td> {{ $value_type_detail->value_type_config_Employee_behaviour ?? null }}
                                </td>
                                <td> {{ $value_type_detail->value_type_config_supervisor_comment ?? null }}
                                </td>
                                @if ($value_type_detail->value_type_config_employee_rating == 3)
                                    <td> {{ 'A' }} </td>
                                @elseif($value_type_detail->value_type_config_employee_rating == 2)
                                    <td> {{ 'B' }} </td>
                                @elseif($value_type_detail->value_type_config_employee_rating == 1)
                                    <td> {{ 'C' }} </td>
                                @endif

                                <td>
                                    @if ($value_type_detail->value_type_config_supervisor_rating == 3)
                                        {{ 'A' }}
                                    @elseif($value_type_detail->value_type_config_supervisor_rating == 2)
                                        {{ 'B' }}
                                    @elseif($value_type_detail->value_type_config_supervisor_rating == 1)
                                        {{ 'C' }}
                                    @endif
                                </td>

                            </tr>
                        @endforeach
                        </tr>
            @endforeach
            <tr>
                <td class=" text-right" colspan="3">Total Values Score</td>
                <td class=" text-center">
                    @if ($value_employee_rating == 3)
                        {{ __('A') }}
                    @elseif($value_employee_rating >= 2)
                        {{ __('B') }}
                    @elseif($value_employee_rating >= 1)
                        {{ __('C') }}
                    @endif
                </td>
                <td class="text-center">
                    @if ($value_supervisor_rating == 3)
                        {{ __('A') }}
                    @elseif($value_supervisor_rating >= 2)
                        {{ __('B') }}
                    @elseif($value_supervisor_rating >= 1)
                        {{ __('C') }}
                    @endif
                </td>
            </tr>
            </table>
        </div>
        @endif
    </div>

</section>
