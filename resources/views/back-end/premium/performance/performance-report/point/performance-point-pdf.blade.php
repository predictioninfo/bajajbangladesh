<?php
use App\Models\ValueTypeDetail;
use App\Models\valueTypeConfigDetail;
use App\Models\ObjectiveDetails;
use App\Models\ObjectiveTypeConfig;

$employee_rating = 0;
$supervisor_rating = 0;
$getPoint = 0;
$totalPoint = 0;
?>
@foreach ($data as $item)
    @php
        $value_type_config_details = valueTypeConfigDetail::with('valuetype')
            ->where('value_type_config_detail_com_id', Auth::user()->com_id)
            ->where('value_type_config_detail_emp_id', $item->objective_emp_id)
            ->get();
        $value_employee_rating = valueTypeConfigDetail::where('value_type_config_detail_com_id', Auth::user()->com_id)
            ->where('value_type_config_detail_emp_id', $item->objective_emp_id)
            // ->select('value_type_config_details.*',  'value_points.value_marks')
            ->groupBy('value_type_config_id')
            ->avg('value_type_config_employee_rating');
        
        $value_supervisor_rating = valueTypeConfigDetail::where('value_type_config_detail_com_id', Auth::user()->com_id)
            ->where('value_type_config_detail_emp_id', $item->objective_emp_id)
            ->groupBy('value_type_config_id')
            ->avg('value_type_config_supervisor_rating');
        
        $marking_rating = ObjectiveDetails::where('obj_detail_com_id', Auth::user()->com_id)
            ->where('objective_id', $item->id)
            ->groupBy('objective_id')
            ->avg('rating');
        
        $total_rating = ObjectiveTypeConfig::where('obj_config_com_id', Auth::user()->com_id)
            ->groupBy('obj_config_desig_id')
            ->avg('obj_config_target_point');
        
        $objectivesMarking = ObjectiveDetails::with('objectiveTypes', 'objectiveTypeConfig')
            ->where('objective_id', $item->id)
            ->where('obj_detail_com_id', Auth::user()->com_id)
            ->get();
    @endphp
    <table class="responsive-table">
        <thead>
            <tr>
                <td scope="col">Name Of The Staff:</td>
                <td scope="col">{{ $item->userfromobjective->first_name }}
                    {{ $item->userfromobjective->last_name }}</td>

            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Designation:</td>
                <td scope="col">{{ $item->userdepartmentfromobjective->department_name }}</td>
            </tr>
            <tr>
                <td>Joining Date:</td>
                <td scope="col">{{ $item->userfromobjective->joining_date }}</td>
            </tr>

        </tbody>
    </table>
    @if ($value_type_config_details->isNotEmpty())
        <h1 style="text-align: center"> Objective Details </h1>
        <table style="width:100%">
            <tr>
                <th>Value</th>
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
            </tr>

            @foreach ($value_type_config_details->unique(fn($p) => $p->valuetype->value_type_name) as $variable_type)
                <?php
                $value_type_details = valueTypeConfigDetail::where('value_type_config_type_id', $variable_type->value_type_config_type_id)
                    ->where('value_type_config_id', $variable_type->value_type_config_id)
                    ->get();
                
                ?>
                <tr>
                    <th colspan="5" style="text-align: center; background-color: #04AA6D">
                        {{ $variable_type->valuetype->value_type_name }}

                    </th>
                </tr>

                <tr valign="top">



                    @foreach ($value_type_details as $value_type_detail)
                <tr valign="top">

                    <td style="text-align: center; border: 1px solid;">
                        {{ $value_type_detail->valueTypDeatils->value_type_detail_value ?? null }}
                    </td>
                    <td style="text-align: center; border: 1px solid;">
                        {{ $value_type_detail->value_type_config_Employee_behaviour ?? null }}</td>
                    <td style="text-align: center; border: 1px solid;">
                        {{ $value_type_detail->value_type_config_supervisor_comment ?? null }} </td>
                    <td style="text-align: center; border: 1px solid;">
                        {{ $value_type_detail->value_type_config_employee_rating }} </td>
                    <td style="text-align: center; border: 1px solid;">
                        {{ $value_type_detail->value_type_config_supervisor_rating }} </td>
                </tr>
            @endforeach
            </tr>
    @endforeach

    <tr>
        <td class=" text-right" colspan="3">
            <hr> Value Point Average
        </td>
        <td class=" text-center">
            @if ($value_employee_rating == 3)
                <hr> {{ __('A') }}
            @elseif($value_employee_rating >= 2)
                <hr> {{ __('B') }}
            @elseif($value_employee_rating >= 1)
                <hr> {{ __('C') }}
            @endif
        </td>
        <td class=" text-center">
            @if ($value_supervisor_rating == 3)
                <hr> {{ __('A') }}
            @elseif($value_supervisor_rating >= 2)
                <hr> {{ __('B') }}
            @elseif($value_supervisor_rating >= 1)
                <hr> {{ __('C') }}
            @endif
        </td>
    </tr>
    </table>
@endif
<h1 style="text-align: center">Yearly Performance Review</h1>
<table class="form-table" style="page-break-after: always;">
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
                <td style="text-align: center">
                    {{ $value->action_taken ?? '' }}
                </td>
                <td style="text-align: center">
                    {{ $value->super_comments ?? '' }}
                </td>
                <td style="text-align: center">{{ $value->rating ?? '' }} </td>
                <td style="text-align: center"> {{ $value->objectiveTypeConfig->obj_config_target_point ?? '' }}
                </td>
            </tr>
        @endforeach
    @endforeach

    <tr>
        <td class="grand_total text-right " colspan="4">Average Rating for Objectives :
        </td>
        <td style="text-align: center">{{ number_format((float) $marking_rating, 1, '.', '') }}</td>
        <td style="text-align: center">{{ number_format((float) $total_rating, 1, '.', '') }} </td>

    </tr>
</table>
@endforeach
