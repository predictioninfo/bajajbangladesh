{{-- <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"> --}}

<?php
use App\Models\User;
use App\Models\ObjectiveTypeConfig;
use App\Models\Objective;
use App\Models\ObjectiveDetails;
?>
<h1 style="text-align: center">{{ $userName->userfromobjective->first_name ?? '' }}
    {{ $userName->userfromobjective->last_name ?? '' }}'s Objective Details </h1>
@php($i = 1)

<table style="width:100%">
    <tbody>
        @foreach ($detailsObjective->unique(fn($p) => $p->objectiveTypeConfig->userobjectivetypefromobjectiveconfig->objective_type_name) as $objective)
            <?php //dd($objective);
            ?>
            <?php
            $Objdetails = ObjectiveDetails::where('objective_obj_type_id', $objective->objective_obj_type_id)
                ->where('objective_id', $objective->objective_id)
                ->where('obj_detail_com_id', Auth::user()->com_id)
                ->get();
            ?>

            <tr>
                <th colspan="2" style="background-color: #04AA6D">
                    {{ $objective->objectiveTypeConfig->userobjectivetypefromobjectiveconfig->objective_type_name ?? null }}
                    -
                    {{ $objective->objectiveTypeConfig->obj_config_percent ?? null }}%
                </th>
            </tr>
            <tr valign="top" style="text-align:center">
                <th style="text-align: center">
                    Individual Objective With Timeline
                </th>
                <th style="text-align: center">
                    Measures Of Success
                </th>
            </tr>

            @foreach ($Objdetails as $value)
                <tr style="">
                    <td style="text-align: center; border: 1px solid;">{{ $value->objective_name }}</td>
                    <td style="text-align: center; border: 1px solid;"> {{ $value->objective_success }}</td>
                </tr>
    </tbody>
    @endforeach
    @endforeach
</table>
