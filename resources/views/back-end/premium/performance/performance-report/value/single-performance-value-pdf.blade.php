<table class="responsive-table">
    <thead>
        <tr>
            <td scope="col">Name Of The Staff:</td>
            <td scope="col">{{ $userName->valueUser->first_name }}
                {{ $userName->valueUser->last_name }}</td>

        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Designation:</td>
            <td scope="col">{{ $userName->valueDesignation->designation_name }}</td>
        </tr>
        <tr>
            <td>Joining Date:</td>
            <td scope="col">{{ $userName->valueUser->joining_date }}</td>
        </tr>

    </tbody>
</table>
<?php
use App\Models\ValueTypeDetail;
use App\Models\valueTypeConfigDetail;
?>

<?php
$employee_rating = 0;
$supervisor_rating = 0;
?>
<h1 style="text-align: center"> Objective Details </h1>
<table style="width:100%">
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

            <td style="text-align: center; border: 1px solid;"> {{ $value_type_detail->valueTypDeatils->value_type_detail_value ?? null }}
            </td>
            <td style="text-align: center; border: 1px solid;"> {{ $value_type_detail->value_type_config_Employee_behaviour ?? null }}</td>
            <td style="text-align: center; border: 1px solid;"> {{ $value_type_detail->value_type_config_supervisor_comment ?? null }} </td>
            <td style="text-align: center; border: 1px solid;"> {{ $value_type_detail->value_type_config_employee_rating }} </td>
            <td style="text-align: center; border: 1px solid;"> {{ $value_type_detail->value_type_config_supervisor_rating }} </td>
        </tr>
    @endforeach
    </tr>
    @endforeach

    <tr>
        <td class=" text-right" colspan="3"><hr>  Value Point Average</td>
        <td class=" text-center">
            @if ($value_employee_rating == 5)
                <hr> {{ __('A') }}
            @elseif($value_employee_rating >= 4)
                <hr> {{ __('B') }}
            @elseif($value_employee_rating >= 3)
                <hr> {{ __('C') }}
            @elseif($value_employee_rating >= 2)
                <hr> {{ __('D') }}
            @elseif($value_employee_rating >= 1)
                <hr> {{ __('F') }}
            @endif
        </td>
        <td class=" text-center">
            @if ($value_supervisor_rating == 5)
                <hr> {{ __('A') }}
            @elseif($value_supervisor_rating >= 4)
                <hr> {{ __('B') }}
            @elseif($value_supervisor_rating >= 3)
                <hr> {{ __('C') }}
            @elseif($value_supervisor_rating >= 2)
                <hr> {{ __('D') }}
            @elseif($value_supervisor_rating >= 1)
                <hr> {{ __('F') }}
            @endif
        </td>
    </tr>
</table>
