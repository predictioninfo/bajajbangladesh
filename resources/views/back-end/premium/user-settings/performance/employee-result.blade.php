@extends('back-end.premium.layout.employee-setting-main')
@section('content')
<?php
use App\Models\valueTypeConfigDetail;
use App\Models\ObjectiveDetails;
?>
<section class="main-contant-section">


    <div class="mb-3">

        @if(Session::get('message'))
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            <strong>{{Session::get('message')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        @foreach ($errors->all() as $error)
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong class="text-danger">{{ $error }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endforeach
    </div>

    <div class="content-box">
        <div style="text-align:center; ">
            <h4>Employee Performance Result</h4>
        </div>
        <div class="table-responsive">
            <table id="user-table" class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Depertment</th>
                        <th>Designation</th>
                        <th>Employee</th>
                        <th>Employee ID</th>
                        <th>Year</th>
                        <th>Objective Point</th>
                        <th>Value Point</th>
                        <th>Total Point</th>

                    </tr>
                </thead>
                <tbody>

                    @php($i=1)
                    @foreach($employees as $employee)
                    <?php
                    $value_details = valueTypeConfigDetail::where('value_type_config_detail_com_id', Auth::user()->com_id)->where('value_type_config_detail_emp_id', Session::get('employee_setup_id'))->get();
                    ?>
                    @foreach ($value_details->unique(fn ($p) =>
                    $p->value_type_config_id) as $value_detail)
                    <?php
                         $value_supervisor_rating = valueTypeConfigDetail::
                            where('value_type_config_detail_com_id',
                            Auth::user()->com_id)
                            ->where('value_type_config_detail_emp_id', Session::get('employee_setup_id'))
                           // ->select('value_type_config_details.*', 'value_points.value_marks')
                            ->groupBy('value_type_config_id')
                            ->avg('value_type_config_supervisor_rating');

                            $marking_rating = ObjectiveDetails::join('objectives','objectives.id', '=','objective_details.objective_id')
                            ->select('objective_details*','objectives.id','objectives.objective_id','objectives.objective_id','objectives.objective_emp_id')
                            ->where('objective_details.obj_detail_com_id', Auth::user()->com_id)
                            ->where('objectives.objective_emp_id', Session::get('employee_setup_id'))
                            ->groupBy('objective_details.objective_id')
                            ->avg('rating');
                    ?>
                    <tr>

                        <td>{{$i++}}</td>
                        <td>{{ $employee->userdepartment->department_name ?? null }}</td>
                        <td>{{ $employee->userdesignation->designation_name ?? null }}</td>
                        <td>{{$employee->first_name}} {{$employee->last_name}}</td>
                        <td>{{$employee->company_assigned_id}}</td>
                        <td>{{$employee->created_at->format('Y')}} </td>
                        <td>

                            {{ number_format((float)$marking_rating, 1, '.',
                            '') }}
                        </td>
                        <td>
                            @if($value_supervisor_rating == 5) {{__('A') }}
                            @elseif($value_supervisor_rating >= 4) {{__('B') }}
                            @elseif($value_supervisor_rating >= 3) {{__('C') }}
                            @elseif($value_supervisor_rating >= 2) {{__('D') }}
                            @elseif($value_supervisor_rating >= 1) {{__('F') }}
                            @endif
                            {{-- {{ number_format((float)$value_supervisor_rating, 1, '.',
                            '') }} --}}
                        </td>
                        <td>
                            {{ number_format((float)$marking_rating, 1, '.',
                            '')}}
                            @if($value_supervisor_rating == 5) {{__('A') }}
                            @elseif($value_supervisor_rating >= 4) {{__('B') }}
                            @elseif($value_supervisor_rating >= 3) {{__('C') }}
                            @elseif($value_supervisor_rating >= 2) {{__('D') }}
                            @elseif($value_supervisor_rating >= 1) {{__('F') }}
                            @endif
                        </td>


                    </tr>
                    @endforeach
                    @endforeach

                </tbody>

            </table>

        </div>
    </div>
</section>
<script>
    $('.date-own').datepicker({
   // minViewMode: 2,
    format: 'yyyy'
    });
</script>
@endsection
