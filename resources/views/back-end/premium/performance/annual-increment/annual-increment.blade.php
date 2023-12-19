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
                <h1 class="card-title text-center">Employees Annual Increment List</h1>
                <ol id="breadcrumb1">
                    <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                    <li><a href="#">List - {{ 'Annual Increment' }} </a></li>
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
                            <th>Employee ID</th>
                            <th>Employee Name</th>
                            <th>Department</th>
                            <th>Designation</th>
                            <th>Point Earned</th>
                            <th>Promotion Eligibility</th>
                            <th>Demotion Eligibility</th>
                            <th>Increment %</th>
                            <th>Gross</th>
                            <th>Total Increment with Percentage</th>
                            <th>Total Gross with increment</th>
                            <th>Year</th>
                            <th> Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @php
                            $i = 1;
                            $increment_salary_percentage = 0;
                        @endphp

                    @foreach($objectives as $users_value)
                    <?php //$staus = SalaryHistory::where('salary_history_com_id', Auth::user()->com_id)->where('salary_history_emp_id',$users_value->objective_emp_id)->where('salary_history_increment_status', 1)->where('salary_history_approval_status',0)->first();?>
                    {{-- @if($staus) --}}
                    <?php
                        $value_supervisor_rating = valueTypeConfigDetail::
                    //  join('value_points', 'value_points.id', '=',
                    //     'value_type_config_details.value_type_config_supervisor_rating')->
                        where('value_type_config_detail_com_id',
                        Auth::user()->com_id)
                        ->where('value_type_config_detail_emp_id', $users_value->objective_emp_id)
                        // ->select('value_type_config_details.*', 'value_points.value_marks')
                        ->groupBy('value_type_config_id')
                        ->avg('value_type_config_supervisor_rating');
                   // dd( $value_supervisor_rating);
                        $marking_rating = ObjectiveDetails::join('objectives','objectives.id', '=','objective_details.objective_id')
                        ->select('objective_details*','objectives.id','objectives.objective_id','objectives.objective_id','objectives.objective_emp_id')
                        ->where('objective_details.obj_detail_com_id', Auth::user()->com_id)
                        ->where('objectives.objective_emp_id', $users_value->objective_emp_id)
                        ->groupBy('objective_details.objective_id')
                        ->avg('rating');
                    ?>
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$users_value->userfromobjective->company_assigned_id ?? null}}</td>
                                    <td>{{$users_value->userfromobjective->first_name ?? null}}
                                        {{$users_value->userfromobjective->last_name ?? null}}</td>
                                    <td>{{$users_value->userdepartmentfromobjective->department_name ?? null}}</td>
                                    <td>{{$users_value->userdesignationfromobjective->designation_name ?? null}}</td>
                                    <td>
                                        {{ round( $marking_rating ) }}
                                        @if($value_supervisor_rating == 3) {{__('A') }}
                                        @elseif($value_supervisor_rating >= 2) {{__('B') }}
                                        @elseif($value_supervisor_rating >= 1) {{__('C') }}

                                        @endif
                                    </td>

                                    <td>
                                        @foreach ($promotion_demotion_points as $promotion_demotion_point)
                                            @if (
                                                $promotion_demotion_point->pd_point_cat == 'Promotion' &&
                                                    round($marking_rating) == $promotion_demotion_point->pd_point_min_objective_point &&
                                                    round($value_supervisor_rating) == $promotion_demotion_point->pd_point_min_value_point)
                                                {{ 'Promtion' }}
                                            @else
                                                {{ '' }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($promotion_demotion_points as $promotion_demotion_point)
                                            @if (
                                                $promotion_demotion_point->pd_point_cat == 'Demotion' &&
                                                    round($marking_rating) == $promotion_demotion_point->pd_point_min_objective_point &&
                                                    round($value_supervisor_rating) == $promotion_demotion_point->pd_point_min_value_point)
                                                {{ 'Demotion' }}
                                            @else
                                                {{ '' }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($increment_configs as $increment_config)
                                            @if (  round($marking_rating) == $increment_config->increment_config_objective_point &&
                                                    round($value_supervisor_rating) == $increment_config->increment_config_value_point)
                                                {{ $increment_salary_percentage = $increment_config->increment_config_salary_percentage }}%
                                            @else
                                                {{ ' ' }}
                                            @endif
                                        @endforeach
                                    </td>

                                    <?php $value = $increment_salary_percentage; ?>

                                    <td>{{$gross = $users_value->userfromobjective->gross_salary ?? null}}</td>
                                    <td>
                                        @if(round($marking_rating) && round($value_supervisor_rating) )
                                         {{ ($users_value->userfromobjective->gross_salary*$value)/100 }}

                                         @elseif(isset($value))

                                         {{" 0" }}
                                        @else
                                         {{ "0" }}
                                         @endif
                                    </td>
                                    <td>
                                        @if(round($marking_rating) && round($value_supervisor_rating) )
                                         {{ ($users_value->userfromobjective->gross_salary*$value)/100 + $gross }}
                                        @else
                                         {{ $gross = $users_value->userfromobjective->gross_salary ?? null }}
                                         @endif
                                    </td>
                                    <td>{{ $users_value->updated_at->format(date('Y')) ?? null}}</td>
                                    <td>
                                        @if( round($marking_rating) && round($value_supervisor_rating))


                                            <a href="#" class="btn btn-success "  data-target="#addIncrementModal{{ $users_value->id }}" data-id="" data-toggle="modal" title=" Increment "
                                                data-original-title="Edit" > <i class="fa fa-check" aria-hidden="true"></i> </a>

                                            <a href="#" class="btn edit"   data-target="#addCustomizeIncrementModal{{ $users_value->id }}" data-id="" data-toggle="modal" title="Customize Increment "
                                                data-original-title="Edit" > <i class="fa fa-edit" aria-hidden="true"></i> </a>
                                        @else
                                        <label for="" style=" color: white; padding: 8px;font-family: Arial;  background-color: #ff9800;">
                                            {{ "No increment" }}
                                        </label>
                                        @endif
                                        <div id="addIncrementModal{{ $users_value->id }}" class="modal fade" role="dialog">
                                            <div class="modal-dialog modal-md">
                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <h5 id="exampleModalLabel" class="modal-title">{{__('Increment
                                                            Date')}}</h5>
                                                        <button type="button" data-dismiss="modal" id="close" aria-label="Close"
                                                            class="close"><i class="dripicons-cross"></i></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('add-annual-increments') }}">
                                                            <input type="hidden" name="emp_id"
                                                                value="{{$users_value->userfromobjective->id  }}">
                                                            <input type="hidden" name="previous_gross" value="{{$gross}}">
                                                            <input type="hidden" name="salary_historiy_increment_salary"
                                                                value="{{ ($users_value->userfromobjective->gross_salary*$value)/100 }}">
                                                            <input type="hidden" name="salary_history_gross"
                                                                value="{{ ($users_value->userfromobjective->gross_salary*$value)/100 + $gross}}">
                                                                <div class="row">
                                                            <div class="col-md-6"> <input type="date"
                                                                    name="salary_history_incremnt_date" class="form-control" required>
                                                            </div>
                                                            <div class="col-md-6">
                                                                    <button class="btn btn-info"
                                                                type="submit">Save</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div id="addCustomizeIncrementModal{{ $users_value->id }}" class="modal fade" role="dialog">
                                            <div class="modal-dialog modal-md">
                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <h5 id="exampleModalLabel" class="modal-title">{{__('Increment
                                                           Date & Rate')}}</h5>
                                                        <button type="button" data-dismiss="modal" id="close" aria-label="Close"
                                                            class="close"><i class="dripicons-cross"></i></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" action="{{route('add-customize-increments')}}"
                                                            class="form-horizontal" enctype="multipart/form-data">
                                                            @csrf

                                                            <div class="row">
                                                                <input type="hidden" name="emp_id"
                                                                    value="{{$users_value->userfromobjective->id  }}">
                                                                <input type="hidden" name="previous_gross" value="{{$gross}}">
                                                                <input type="hidden" name="increment_percentage"
                                                                    value="{{$value = $increment_salary_percentage ?? null}}">
                                                                <input type="hidden" name="salary_historiy_increment_salary"
                                                                    value="{{ ($users_value->userfromobjective->gross_salary*$value)/100 }}">
                                                                <div class="col-md-12"> <input type="date"
                                                                        name="salary_history_incremnt_date" class="form-control"
                                                                        required></div>
                                                                <div class="col-md-12">
                                                                    <div class="input-group mb-3">
                                                                        <label>{{__('Total Increment
                                                                            ')}}<span class="text-danger">*</span></label>
                                                                        <div class="input-group-prepend">
                                                                        </div>
                                                                        <input type="number" name="salary_history_gross" value=""
                                                                            class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12 mt-4">
                                                                    <button class="edit-btn btn btn-grad mr-2"
                                                                        type="submit">Save</button>

                                                                </div>
                                                           </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
            <script type="text/javascript">
                $(document).ready( function () {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                  $('#user-table').DataTable({

                        "aLengthMenu": [
                            [25, 50, 100, -1],
                            [25, 50, 100, "All"]
                            ],
                            "iDisplayLength": 25,
                          dom: '<"row"lfB>rtip',

                          buttons: [
                              {
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

              } );


            </script>



            @endsection
