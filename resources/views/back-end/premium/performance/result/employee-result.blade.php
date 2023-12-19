@extends('back-end.premium.layout.premium-main')
@section('content')
    <?php
    use App\Models\valueTypeConfigDetail;
    use App\Models\ObjectiveDetails;
    ?>
    <section class="main-contant-section">


        <div class="">

            @if (Session::get('message'))
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <strong>{{ Session::get('message') }}</strong>
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

        <div class="card mb-0">
            <div class="card-header with-border">
                <h1 class="card-title text-center">Eligible P/D Employees List</h1>
                <ol id="breadcrumb1">
                    <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                    <li><a href="{{ route('employee-performance-results') }}"><span class="icon icon-list"> </span> List</a></li>
                    <li><a href="#">List - {{ ' Eligible P/D' }} </a></li>
                </ol>
            </div>
        </div>

        <div class="content-box">
            <form method="post" action="{{ route('employee-performance-result-searches') }}" class="container-fluid">
                @csrf
                <div class="row align-items-end">
                    <div class="col-md-4 form-group">
                        <label>{{ __('Employee') }} </label>
                        <select name="employee_id" class="form-control selectpicker" data-live-search="true"
                            data-live-search-style="begins" title='Employee'>
                            @foreach ($employee_list as $employees_value)
                                <option value="{{ $employees_value->id }}"
                                    data-subtext="<img class='rounded-circle' width='60' height='40'' src='{{ $employees_value->profile_photo }}'>">
                                    {{ $employees_value->company_assigned_id }}
                                    {{ $employees_value->first_name }}
                                    {{ $employees_value->last_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="form-actions">
                                <button type="submit" class="btn btn-grad"><i class="fa fa-search"></i>
                                    {{ __('Search') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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
                            <th>Eleigble Promotion/Demotion</th>

                        </tr>
                    </thead>
                    <tbody>

                        @php($i = 1)
                        @foreach ($employees as $employee)
                            <?php
                            $value_details = valueTypeConfigDetail::where('value_type_config_detail_com_id', Auth::user()->com_id)
                                ->where('value_type_config_detail_emp_id', $employee->id)
                                ->get();

                            ?>
                            @foreach ($value_details->unique(fn($p) => $p->value_type_config_id) as $value_detail)
                                <?php
                                $value_supervisor_rating = valueTypeConfigDetail::where('value_type_config_detail_com_id', Auth::user()->com_id)
                                    ->where('value_type_config_detail_emp_id', $value_detail->value_type_config_detail_emp_id)
                                    ->groupBy('value_type_config_id')
                                    ->avg('value_type_config_supervisor_rating');

                                $marking_rating = ObjectiveDetails::join('objectives', 'objectives.id', '=', 'objective_details.objective_id')
                                    ->select('objective_details*', 'objectives.id', 'objectives.objective_id', 'objectives.objective_id', 'objectives.objective_emp_id')
                                    ->where('objective_details.obj_detail_com_id', Auth::user()->com_id)
                                    ->where('objectives.objective_emp_id', $value_detail->value_type_config_detail_emp_id)
                                    ->groupBy('objective_details.objective_id')
                                    ->avg('rating');
                                ?>
                                <tr>

                                    <td>{{ $i++ }}</td>
                                    <td>{{ $employee->userdepartment->department_name ?? null }}</td>
                                    <td>{{ $employee->userdesignation->designation_name ?? null }}</td>
                                    <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                                    <td>{{ $employee->company_assigned_id }}</td>
                                    <td>{{ $employee->created_at->format('Y') }} </td>
                                    <td>

                                        {{ round($marking_rating) }}
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
                                    <td>
                                        {{ round($marking_rating) }}
                                        @if ($value_supervisor_rating == 3)
                                            {{ __('A') }}
                                        @elseif($value_supervisor_rating >= 2)
                                            {{ __('B') }}
                                        @elseif($value_supervisor_rating >= 1)
                                            {{ __('C') }}
                                        @endif
                                    </td>
                                    {{--  rakib  --}}
                                    {{-- <td>
                                        <div style="display: none;">
                                            @foreach ($promotion_demotion_points as $promotion_demotion_point)
                                            {{$category = $promotion_demotion_point->pd_point_cat }}
                                            {{$objective_point = $promotion_demotion_point->pd_point_min_objective_point }}
                                            {{$value_point = $promotion_demotion_point->pd_point_min_value_point }}
                                            <br>
                                            @endforeach
                                            <br>
                                        </div>
                                        @if ($category == 'Promotion' && $objective_point <= $marking_rating && $value_point <= $value_supervisor_rating) Promtion @elseif($objective_point>=
                                            $marking_rating )
                                            @if ($value_point >= $value_supervisor_rating) Demotion

                                            @endif
                                            @endif
                                    </td> --}}
                                    {{--  rakib  --}}

                                    <td>
                                        @foreach ($promotion_demotion_points as $promotion_demotion_point)
                                            @if (
                                                $promotion_demotion_point->pd_point_cat == 'Promotion' &&
                                                    round($marking_rating) == $promotion_demotion_point->pd_point_min_objective_point &&
                                                    round($value_supervisor_rating) == $promotion_demotion_point->pd_point_min_value_point)
                                                {{ 'Promtion' }}
                                            @elseif(
                                                $promotion_demotion_point->pd_point_cat == 'Demotion' &&
                                                    round($marking_rating) == $promotion_demotion_point->pd_point_min_objective_point &&
                                                    round($value_supervisor_rating) == $promotion_demotion_point->pd_point_min_value_point)
                                                {{ 'Demotion' }}
                                            @endif
                                        @endforeach
                                    </td>

                                </tr>
                            @endforeach
                        @endforeach

                    </tbody>

                </table>

            </div>
        </div>
    </section>
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var i = 1;
            $('#user-table').DataTable({
                "aLengthMenu": [
                    [25, 50, 100, -1],
                    [25, 50, 100, "All"]
                ],
                "iDisplayLength": 25,
                dom: '<"row"lfB>rtip',
                buttons: [{
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
    <script>
        $('.date-own').datepicker({
            // minViewMode: 2,
            format: 'yyyy'
        });
    </script>
@endsection
