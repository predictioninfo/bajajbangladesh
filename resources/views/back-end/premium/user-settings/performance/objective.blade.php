@extends('back-end.premium.layout.employee-setting-main')
@section('content')
<?php
    use App\Models\User;
    use App\Models\ObjectiveTypeConfig;
    use App\Models\Objective;
    use App\Models\DevelopmentPlan;

    $users = User::where('id', Session::get('employee_setup_id'))->first(['designation_id', 'department_id', 'id','first_name','last_name']);

    $users_objectives = ObjectiveTypeConfig::where('obj_config_com_id', Auth::user()->com_id)
        ->where('obj_config_desig_id', $users->designation_id)
        ->get();

    $exist_check_objective = Objective::where('objective_com_id', Auth::user()->com_id)
        ->where('objective_emp_id',Session::get('employee_setup_id'))
        ->whereYear('created_at', date("Y"))
        ->exists();

    $exist_check_development = DevelopmentPlan::where('development_com_id', Auth::user()->com_id)
        ->where('development_emp_id', Session::get('employee_setup_id'))
        ->whereYear('created_at', date("Y"))
        ->exists();

    ?>


<section class="main-contant-section">
    <div class="container-fluid">
        @if (Session::get('message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
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

        <div class="card mb-0">
            <div class="card-header with-border">
                <h1 class="card-title text-center"> {{ $users->first_name ?? '' }}
                    {{ $users->last_name ?? ''}}'s  Objective & Development Plan List</h1>
                <ol id="breadcrumb1">
                    <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                    <li><a href="#">List - {{ 'Objective & Development Plans' }} </a></li>
                </ol>
            </div>
        </div>

    <div class="objective-contant">
        <div class="row">
            <div class="col-md-12">
                <div class="tab">
                    <button class="tablinks" onclick="openCity(event, 'Objective')"> Objective Plan </button>
                    <button class="tablinks" onclick="openCity(event, 'Development')"> Development Plan </button>
                </div>


                <div id="Objective" class="tabcontent" style="display: block;">
                    @if(!$exist_check_objective)

                    <div class="content-box">
                        <div class="">
                            <h6>1. OBJECTIVES FOR THE PERIOD UNDER REVIEW (To be filled by the Employee and approved by the Supervisor at the beginning of the year)</h6>
                            <p>This section should report the objectives that have been cascaded to you by your supervisor for the year. Please write a minimum of 1 and a maximum of
                                5 SMART (Specific, Measurable, Achievable, Realistic, Time Based) objectives in each section and total objectives will be minimum 3 and maximum 8. </p>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('add-objective-plans') }}" enctype="multipart/form-data">
                        <table class="form-table objective" id="Objective_plan">
                            @csrf
                            @foreach ($users_objectives as $users_objective)
                            <input type="hidden" name="objective_emp_id" class="code" id="customFieldName"
                                value="{{ Session::get('employee_setup_id') }}" />
                            <input type="hidden" name="objective_desig_id" class="code" id="customFieldName"
                                value="{{ $users->designation_id }}" />
                            <input type="hidden" name="objective_dept_id" class="code" id="customFieldName"
                                value="{{ $users->department_id }}" />

                            <tr>
                                <th colspan="5" class="text-center">
                                    {{ $users_objective->userobjectivetypefromobjectiveconfig->objective_type_name
                                    }}
                                    - {{ $users_objective->obj_config_percent }}
                                    %</th>
                            </tr>

                            <tr valign="top" id="after{{ $users_objective->obj_config_obj_typ_id }}">

                                <th>
                                    Individual Objective With Timeline (Please fill this at the beginning of the year. Please specify your objectives here)
                                </th>
                                <th>
                                    Measures Of Success (Please specify metrics for measuring the objectives)
                                </th>
                                <th>
                                    <a href="javascript:void(0);" class="addOB btn"
                                        onclick="addOB(`{{ $users_objective->obj_config_obj_typ_id }}`)"> <i
                                            class="fa fa-plus" aria-hidden="true"></i> </a>
                                </th>
                            </tr>
                            @endforeach

                        </table>
                        <table class="form-table objective" id="Objective_plan">

                        </table>
                        <button type="submit" class="btn btn-grad "> save </button>
                    </form>
                    @endif
                    <table id="user-table" class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>{{ __('SL') }}</th>
                                <th>{{ __('Employee') }}</th>
                                <th>{{ __('Department') }}</th>
                                <th>{{ __('Designation') }}</th>
                                <th>{{ __('Year') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i = 1)
                            @foreach ($objectivePlans as $value)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ ucfirst($value->userfromobjective->first_name ?? '') }}
                                    {{ ucfirst($value->userfromobjective->last_name ?? '') }}</td>
                                <td>{{ $value->userdepartmentfromobjective->department_name ?? '' }}</td>
                                <td>{{ $value->userdesignationfromobjective->designation_name ?? '' }}</td>
                                <td>{{$value->created_at->format('Y')}}</td>
                                <td>
                                    <a href="{{  route('employee-details-objective-plans', $value->id) }}" class="btn edit" data-toggle="tooltip" title="Show Details"
                                        data-original-title="Marking" > <i class="fa fa-pencil-square-o" aria-hidden="true"></i> </a>

                                        <a href="{{ route('objective-details-plans-views', $value->id) }}" class="btn view" data-toggle="tooltip" title="View"
                                            data-original-title="View" > <i class="fa fa-eye" aria-hidden="true"></i> </a>

                                </td>

                            </tr>
                            @endforeach
                        </tbody>

                    </table>

                    <div class="card mb-4">
                        <div class="card-header with-border">
                            <h1 class="card-title text-center">Supervisor Objective Review</h1>

                        </div>
                    </div>
                    <table id="user-table" class="table table-bordered table-hover table-striped">
                        <thead >
                            <tr>
                                <th>{{ __('SL') }}</th>
                                <th>{{ __('Supervisor Objective Review') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i = 1)
                            @foreach ($objectivePlans as $value)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ ucfirst($value->objective_supervisor_review ?? '') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>

                <div id="Development" class="tabcontent">
                    @if(!$exist_check_development)
                    <div class="content-box">
                        <div class="">
                                <h6>2. DEVELOPMENT PLAN FOR THE PERIOD UNDER REVIEW (To be filled by the Employee and approved by the Supervisor)</h6>
                                <p>This section should capture your Development Plans for the year. Please focus on 1-3 important development goals ie areas you want to improve upon.
                                     Your development goals should support you in achieving your individual objectives above. The development plan should capture activities through on-the-job experience,
                                     exposure by working on cross-functional projects and networking assignments; and classroom training provided by internal or external providers.  </p>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('add-development-plans') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="development_emp_id" class="code" id="customFieldName"
                            value="{{ $users->id ?? null }}" />
                        <input type="hidden" name="development_desig_id" class="code" id="customFieldName"
                            value="{{ $users->designation_id ?? null }}" />
                        <input type="hidden" name="development_dept_id" class="code" id="customFieldName"
                            value="{{ $users->department_id ?? null }}" />
                        <table class="form-table" id="development_plan">
                            <tr>

                                <th>
                                    Development Plan (Please fill this at the beginning of the year)
                                </th>
                                <th>
                                    Measures Of Success (Please specify metrics for measuring the development plan. Please fill this at the beginning of the year)
                                </th>
                                <th>
                                    Action Taken (Please mention actions taken against the plan. Please fill it at the year end)
                                </th>

                                <th>
                                    <a href="javascript:void(0);" class="addOP btn" onclick="addOP()"> <i
                                            class="fa fa-plus" aria-hidden="true"></i> </a>
                                </th>
                            </tr>
                        </table>

                        <button type="submit" class="btn btn-grad"> save </button>
                    </form>
                    @endif
                    <table id="user-table" class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>{{ __('SL') }}</th>
                                <th>{{ __('Employee') }}</th>
                                <th>{{ __('Department') }}</th>
                                <th>{{ __('Designation') }}</th>
                                <th>{{ __('Year') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php($i = 1)
                            @foreach ($developmentPlans as $value)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $value->user->first_name ?? null}} {{ $value->user->last_name ??
                                    null}}</td>
                                <td>{{ $value->userdepartment->department_name ?? null}}</td>
                                <td>{{ $value->userdesignation->designation_name ?? null}}</td>
                                <td>{{$value->created_at->format('Y')}}</td>
                                <td>
                                   <a href="{{   route('employee-details-development-plans', $value->id) }}" class="btn edit" data-toggle="tooltip" title="Show Details"
                                    data-original-title="Marking" > <i class="fa fa-pencil-square-o" aria-hidden="true"></i> </a>
                                    <a href="{{ route('employee-development-details-plans-views', $value->id) }}" class="btn view" data-toggle="tooltip" title="Show Details"
                                        data-original-title="View" > <i class="fa fa-eye" aria-hidden="true"></i> </a>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>

                    </table>

                    <div class="card mb-4">
                        <div class="card-header with-border">
                            <h1 class="card-title text-center">Supervisor Development Review</h1>

                        </div>
                    </div>
                        <table id="user-table" class="table table-bordered table-hover table-striped">
                            <thead></thead>
                            <tr>
                                <th>{{ __('SL') }}</th>
                                <th>{{ __('Supervisor Review') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i = 1)
                            @foreach ($developmentPlans as $value)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ ucfirst($value->development_supervisor_review ?? '') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>


    </div>
</section>


<script>
    function openCity(evt, cityName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
        }




        function addOB(id) {
            var obj_config_obj_typ_id = id;
            $('#after' + id).after(`

            <tr valign="top">

                <td><textarea  name="objective_name[]" class="code" id="customFieldName"  value="" placeholder=" Individual Objective" required></textarea></td>
                <td> <textarea  class="code" id="customFieldValue" name="objective_success[]" value="" placeholder="Measures Of Success" required></textarea> </td>
                <input type="hidden" name="obj_config_obj_typ_id[]" value="${id}"/> </td>

                <input type="hidden" name="objective_emp_id" value="{{ Session::get('employee_setup_id') }}"/> </td>
                <input type="hidden" name="objective_desig_id" value="{{ $users->designation_id }}"/> </td>
                <input type="hidden" name="objective_dept_id" value="{{ $users->department_id }}"/> </td>

                <td class="remBtn"> <a href="javascript:void(0);" class="remOB btn"><i class="fa fa-minus" aria-hidden="true"></i></a> </td>
            </tr> `);
        }
        $("#Objective_plan").on('click', '.remOB', function() {
            $(this).parent().parent().remove();
        });

        $(document).ready(function() {

            $(".addOP").click(function() {
                $("#development_plan").append(`
                <tr valign="top"><td><textarea name="development_name[]" class="code" id="customFieldName"  value="" placeholder="Development Name" required ></textarea></td>
                    <td><textarea name="meassure_of_success[]" class="code" id="customFieldName"  value="" placeholder="Measure of Success" required></textarea></td>
                    <td> <textarea class="code" id="customFieldValue" name="action_taken[]" value="" placeholder="Action Taken" readonly></textarea> </td>
                    <td class="remBtn"> <a href="javascript:void(0);" class="remOP btn"><i class="fa fa-minus" aria-hidden="true"></i></a> </td>
                </tr>
            `);
            });

            $("#development_plan").on('click', '.remOP', function() {
                $(this).parent().parent().remove();
            });

        });
</script>
@endsection
