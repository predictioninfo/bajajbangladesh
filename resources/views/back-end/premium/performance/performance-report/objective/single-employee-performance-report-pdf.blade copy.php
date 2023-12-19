<style>
    .row {
        box-sizing: border-box;
    }


    .column {
        float: left;
        width: 40%;
        padding: 5px;
    }

    /* Clearfix (clear floats) */
    .row::after {
        content: "";
        clear: both;
        display: table;
    }

    .responsive-table {
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
        /* border: 1px solid #ddd; */
    }

</style>
<table class="responsive-table">
        <tbody>
            <tr>
                <td colspan="4">
                    <h4> Staff Infomation </h4>
                </td>
            </tr>
            <tr>
                <td>Name Of The Staff:</td>
                <td>{{ $employee_info->objectiveReport->userfromobjective->first_name }}
                    {{ $employee_info->objectiveReport->userfromobjective->last_name }}</td>
                <td>ID:</td>
                <td> {{ $employee_info->objectiveReport->userfromobjective->company_assigned_id }}</td>
            </tr>
            <tr>
                <td>Designation:</td>
                <td> {{ $employee_info->objectiveReport->userdesignationfromobjective->designation_name }}</td>
                <td>Last Performance related salary increase Date:</td>
                <td>
                    @if ($employee_info->objectiveReport->userfromobjective->salaryIncrement)
                        @if ($employee_info->objectiveReport->userfromobjective->salaryIncrement->salary_history_approval_status == 1)
                            {{ $employee_info->objectiveReport->userfromobjective->salaryIncrement->salary_history_increment_date ?? '' }}
                        @else
                            {{ 'Not Applicable' }}
                        @endif
                    @endif
                </td>
            </tr>
            <tr>
                <td>Joining Date:</td>
                <td>{{ $employee_info->objectiveReport->userfromobjective->joining_date }}</td>
                <td>Date of last Promotion:</td>
                <td>
                    {{ $employee_info->objectiveReport->userfromobjective->promotion->promotion_date ?? '' }}
                </td>
            </tr>
            <tr>
                <td>Educational Qualification:</td>
                <td>
                    {{ $employee_info->objectiveReport->userfromobjective->qualification->qualification_education_level ?? 'Not Selected' }}
                </td>
                <td>Country:</td>
                <td>
                    {{ $employee_info->objectiveReport->userfromobjective->emoloyeedetail->userNationality->name ?? '' }}
                </td>
            </tr>
            <tr>
                <td>Supervisor Name:</td>
                <td>{{ $supervisor->first_name ?? 'Not Selected' }}
                    {{ $supervisor->last_name ?? ' ' }}</td>
                <td>Base Location:</td>
                <td> {{ $employee_info->objectiveReport->userfromobjective->userregion->region_name ?? '' }}</td>
            </tr>
            <tr>
                <td>Supervisor Designation:</td>
                <td>{{ $supervisor->userdesignation->designation_name ?? 'Not Selected' }}</td>
                <td>Contract/Regular:</td>
                <td>{{ $employee_info->objectiveReport->userfromobjective->job_nature ?? '' }}</td>
            </tr>
            <tr>
                <td>Supervisor ID:</td>
                <td>{{ ucfirst($supervisor->company_assigned_id ?? 'Not Selected') }}</td>
                <td>Contract End Date:</td>
                @if ($employee_info->objectiveReport->userfromobjective->employment_type == 'Contactual')
                    <td>{{ $employee_info->objectiveReport->userfromobjective->expiry_date }}</td>
                @else
                    <td> {{ 'Not Applicable' }} </td>
                @endif
            </tr>
        </tbody>
    </table>

<?php
use App\Models\User;
use App\Models\ObjectiveTypeConfig;
use App\Models\Objective;
use App\Models\ObjectiveDetails;
?>
@php($i = 1)

<table style="width:100%">
    <tbody>
        <tr>
            <td colspan="2">
                <h4> Objective Details </h4>
            </td>
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
                <td colspan="2">
                    {{ $objective->objectiveTypeConfig->userobjectivetypefromobjectiveconfig->objective_type_name ?? null }}
                    -
                    {{ $objective->objectiveTypeConfig->obj_config_percent ?? null }}%
                </td>
            </tr>
            <tr>
                <td>
                    Individual Objective With Timeline
                </td>
                <td>
                    Measures Of Success
                </td>
            </tr>

            @foreach ($Objdetails as $value)
                <tr>
                    <td>{{ $value->objective_name }}</td>
                    <td> {{ $value->objective_success }}</td>
                </tr>
    </tbody>
    @endforeach
    @endforeach
</table>
@if ($detailsDevelopment)
    <table style="width:100%">
        <tbody>
            <tr>
                <td colspan="3">
                    <h4> Development Details </h4>
                </td>
            </tr>
            <tr>
                <td>
                    Individual Objective With Timeline
                </td>
                <td>
                    Measures Of Success
                </td>
                <td>
                    Action Taken
                </td>
            </tr>

            @foreach ($detailsDevelopment->developmentPlanDetails as $value)
                <tr>
                    <td>{{ $value->development_name }}</td>
                    <td>{{ $value->development_meassure_of_success }}
                    </td>
                    <td> {{ $value->development_action_taken }}</td>
                </tr>
        </tbody>
@endforeach
</table>
@endif

<table style="width:100%">
    <tbody>
        <tr>
            <td colspan="2">
                <h4> Yearly Review </h4>
            </td>
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
                <th colspan="6">
                    {{ $objective->objectiveTypeConfig->userobjectivetypefromobjectiveconfig->objective_type_name ?? null }}
                    -
                    {{ $objective->objectiveTypeConfig->obj_config_percent ?? null }}%
                </th>
            </tr>
            <tr valign="top">
                <th >
                    Individual Objective With Timeline
                </th>
                <th >
                    Measures Of Success
                </th>
                <th>
                    Action Token
                </th>
                <th>
                    Supervisor Comments
                </th>
                <th>
                    Ratings
                </th>
                <th>
                    Total Markings
                </th>
            </tr>

            @foreach ($Objdetails as $value)
                <tr>
                    <td>{{ $value->objective_name }}</td>
                    <td> {{ $value->objective_success }}</td>
                    <td> {{ $value->action_taken }}</td>
                    <td> {{ $value->super_comments }}</td>
                    <td> {{ $value->rating }}</td>
                    <td>
                        {{ $value->objectiveTypeConfig->obj_config_target_point }}</td>
                </tr>

    </tbody>
    @endforeach
    @endforeach
    <tr>
        <td>Average Point:</td>
        <td>{{ number_format((float) $marking_rating, 1, '.', '') }}</td>
        <td>{{ number_format((float) $total_rating, 1, '.', '') }} </td>
    </tr>

    <tr>
        <td class="" colspan="">Employee Name</td>
        <td> {{ $employee_info->objectiveReport->userfromobjective->first_name }}
            {{ $employee_info->objectiveReport->userfromobjective->last_name }}
            <hr>
        </td>

        <td>Employee Signature</td>
        <td>
            <hr>
        </td>

        <td>Date</td>
        <td>
            <hr>
        </td>
    </tr>
    <tr>
        <td class="" colspan="">Supervisor name</td>
        <td> {{ $supervisor->first_name ?? 'Not Selected' }} {{ $supervisor->last_name ?? ' ' }}
            <hr>
        </td>

        <td>Supervisor Signature</td>
        <td>
            <hr>
        </td>

        <td>Date</td>
        <td>
            <hr>
        </td>
    </tr>
</table>
<?php
use App\Models\ValueTypeDetail;
use App\Models\valueTypeConfigDetail;
?>
<?php
$employee_rating = 0;
$supervisor_rating = 0;
?>
@if (!$value_type_config_details->isEmpty())
    <table style="width: 100%">
    <tr>
        <td colspan="2">
            <h4>
            Value Review
            </h4>
        </td>
    </tr>
        <tr>
            <th>Value</th>
            <th>
                Employee Comments with examples of behaviors
            </th>
            <th>
                Supervisor Comments with examples of behavior displayed or not displayed
            </th>
            <th>
                Employee Rating
            </th>
            <th>
                Supervisor Rating
            </th>
        </tr>
        @foreach ($value_type_config_details->unique(fn($p) => $p->valuetype->value_type_name) as $variable_type)
            <?php
            $value_type_details = valueTypeConfigDetail::where('value_type_config_type_id', $variable_type->value_type_config_type_id)
                ->where('value_type_config_id', $variable_type->value_type_config_id)
                ->get();

            ?>
            <tr>
                <th colspan="6">
                    {{ $variable_type->valuetype->value_type_name }}

                </th>
            </tr>

            <tr valign="top">
                @foreach ($value_type_details as $value_type_detail)
            <tr valign="top">

                <td>
                    {{ $value_type_detail->valueTypDeatils->value_type_detail_value ?? null }}</td>
                <td>
                    {{ $value_type_detail->value_type_config_Employee_behaviour ?? null }} </td>
                <td>
                    {{ $value_type_detail->value_type_config_supervisor_comment ?? null }}</td>
                <td>
                    {{ $value_type_detail->value_type_config_employee_rating == 3 ? 'A' : '' }}
                    {{ $value_type_detail->value_type_config_employee_rating == 2 ? 'B' : '' }}
                    {{ $value_type_detail->value_type_config_employee_rating == 1 ? 'C' : '' }}

                </td>
                <td>
                    {{ $value_type_detail->value_type_config_supervisor_rating == 3 ? 'A' : '' }}
                    {{ $value_type_detail->value_type_config_supervisor_rating == 2 ? 'B' : '' }}
                    {{ $value_type_detail->value_type_config_supervisor_rating == 1 ? 'C' : '' }}

                </td>
            </tr>
        @endforeach
        </tr>
@endforeach
<tr>
    <td colspan="3">Value Point Average</td>
    <td>
        @if ($value_employee_rating == 3)
            {{ __('A') }}
        @elseif($value_employee_rating >= 2)
            {{ __('B') }}
        @elseif($value_employee_rating >= 1)
            {{ __('C') }}
        @endif
    </td>
    <td>
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
@endif
