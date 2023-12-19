@extends('back-end.premium.layout.employee-setting-main')
@section('content')
<?php
    use App\Models\User;
    use App\Models\ObjectiveTypeConfig;
    use App\Models\ObjectiveDetails;
    use App\Models\Objective;
     $users = User::where('id', Session::get('employee_setup_id'))->first(['designation_id','department_id','id']);
     $users_objectives = ObjectiveTypeConfig::where('obj_config_com_id',
    Auth::user()->com_id)->where('obj_config_desig_id',$users->designation_id)->get();
    $exist_check_objective = Objective::where('objective_com_id', Auth::user()->com_id)
        ->where('objective_emp_id',Session::get('employee_setup_id'))
        ->whereYear('created_at', date("Y"))
        ->exists();

    $date = new DateTime('now', new \DateTimeZone('Asia/Dhaka'));
    $current_date = $date->format('Y-m-d');
    $current_month = $date->format('m');
    $current_day = $date->format('d');
    $lastDay = $date->modify('last day of this month');
    $lastDays = $lastDay->format('d');

    $review_permission = 'Not-Permitted';
    $year_end_review_permission = 'Not-Permitted';
    $review_visible_days = 0;
    $current_day_number = $current_day;
    $current_month_number = $current_month;
    $lastDayOfcurrentMonth = $lastDays;

    foreach ($yearly_reviews as $yearly_reviews_value) {
        if ($current_month_number == $yearly_reviews_value->yearly_review_after_months && $current_day_number >= $yearly_reviews_value->yearly_review_upto) {
            $review_permission = 'Permitted';
        } else {
            $year_end_review_permission = 'Not-Permitted';
        }

    }

    ?>

<section class="main-contant-section">
    <div class="container-fluid">


        <div class="card mb-0">
            <div class="card-header with-border">
                <h1 class="card-title text-center">{{ $objectiveUsers->userfromobjective->first_name ?? '' }}
                    {{ $objectiveUsers->userfromobjective->last_name ?? ''}}'s Yearly Performance Review Form</h1>
                <ol id="breadcrumb1">
                    <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                    <li><a href="#">List - Yearly Performance Review</a></li>
                </ol>
            </div>
        </div>

        @if ($review_permission == 'Permitted')
        @if(!$exist_check_objective )
        <div class="objective-contant">
            <div class="row">
                <div class="col-md-12">
                    @php
                    $getPoint = 0;
                    $totalPoint = 0;

                    @endphp

                    <form method="POST" action="{{ route('add-performance-reviews') }}" enctype="multipart/form-data">
                        @csrf
                        @php($i = 1)

                        <table class="form-table" id="Objective_plan">
                            @foreach ($objectivesMarking->unique(fn($p) => $p->objectiveTypes->objective_type_name) as
                            $objective)
                            <?php
                                    $Objdetails = ObjectiveDetails::where('objective_obj_type_id', $objective->objective_obj_type_id)
                                        ->where('objective_id', $objective->objective_id)
                                        ->where('obj_detail_com_id', Auth::user()->com_id)
                                        ->get();
                                    ?>
                            <tr>
                                <th colspan="8" class="text-center"> <b>

                                        {{ $objective->objectiveTypes->objective_type_name ?? '' }} -
                                        {{ $objective->objectiveTypeConfig->obj_config_percent ?? '' }} %</b> </th>
                            </tr>
                            <tr valign="top">
                                <th>
                                    SL
                                </th>
                                <th>
                                    Individual Objective With Timeline
                                </th>
                                <th>
                                    Measures Of Success
                                </th>
                                <th>
                                    Action Taken
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



                            @foreach ($Objdetails as $value)
                            <?php
                                        $getPoint += $value->rating;
                                        $totalPoint += $value->objectiveTypeConfig->obj_config_target_point;

                                        ?>

                            <tr valign="top">


                                <td> {{ $i++ }} </td>
                                <td><input type="text" name="obj_name[]" class="code" id="customFieldName"
                                        value=" {{ $value->objective_name ?? '' }}" placeholder="Individual Objective"
                                        readonly /></td>
                                <td> <input type="text" class="code" name="messure_of_succ[]"
                                        value=" {{ $value->objective_success ?? '' }}" placeholder="Measures Of Success"
                                        readonly /> </td>
                                <td> <input type="text" class="code" name="action_taken[]"
                                        value=" {{ $value->action_taken ?? '' }}" placeholder="Action Taken" required />
                                </td>
                                <td> <input type="text" class="code" name="super_comments[]"
                                        value=" {{ $value->super_comments ?? '' }}" placeholder="Comments" readonly />
                                </td>
                                <td> <input type="text" class="code get_point" name="rating[]" readonly
                                        value=" {{ $value->rating ?? '' }}" placeholder="Marking" /> </td>
                                <td> <input type="text" class="code totalPoint" name="total_rating[]"
                                        value=" {{ $value->objectiveTypeConfig->obj_config_target_point ?? '' }}"
                                        placeholder="Total Marking" readonly />

                                </td>
                                <input type="hidden" name="review_dept_id" class="code"
                                    placeholder="Individual Objective" />
                                <input type="hidden" name="review_desi_id" class="code"
                                    value="{{ $objectiveUsers->objective_desig_id }}"
                                    placeholder="Individual Objective" />
                                <input type="hidden" name="review_emp_id" class="code"
                                    value="{{ $objectiveUsers->objective_emp_id }}"
                                    placeholder="Individual Objective" />
                                <input type="hidden" name="objective_id[]" value="{{ $value->objective_id }}"
                                    class="code" placeholder="Individual Objective" />
                                <input type="hidden" name="objective_obj_type_id[]"
                                    value="{{ $value->objective_obj_type_id }}" />
                                <input type="hidden" name="obj_config_id[]" value="{{ $value->obj_config_id }}" />
                                <input type="hidden" name="id" value="{{ $value->id }}" />

                            </tr>
                            @endforeach
                            @endforeach

                            <tr>
                                <td class="grand_total text-right " colspan="5">Point:</td>
                                <td><input type="text" class="code" name="messure_of_succ[]" value=" {{ $getPoint }}"
                                        placeholder="Mark" readonly /></td>

                                <td><input type="text" class="code" name="messure_of_succ[]" value=" {{  $totalPoint }}"
                                        placeholder="Mark" readonly /> </td>

                            </tr>
                        </table>

                        <input type="submit" id="submit" value="{{ __('Submit') }}" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
        @endif
        @endif
        <div class="content-box">
            <div class="table-responsive">
        <table id="user-table" class="table table-bordered">
            <thead>
                <tr>
                    <th>{{ __('SL') }} </th>
                    <th>{{ __('Department') }}</th>
                    <th>{{ __('Designation') }}</th>
                    <th>{{ __('Employee') }}</th>
                    <th>{{ __('Year') }}</th>
                    <th>{{ __('Action') }}</th>

                </tr>
            </thead>
            <tbody>
                @php($i = 1)
                @foreach ($objectives as $value)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $value->userdepartmentfromobjective->department_name ?? '' }}</td>
                    <td>{{ $value->userdesignationfromobjective->designation_name ?? '' }}</td>
                    <td>{{ $value->userfromobjective->first_name ?? '' }} {{ $value->userfromobjective->last_name ??
                        '' }}</td>
                    <td>{{$value->created_at->format('Y')}}</td>
                    <td>
                        <a href="{{route('employee-objective-reviews',['id'=>$value->id])}}" class="btn edit" data-toggle="tooltip" title="Performance Review "
                            data-original-title="Marking" > <i class="fa fa-pencil-square-o" aria-hidden="true"></i> </a>

                        <a href="{{ route('employee-objective-review-views', $value->id) }}" class="btn view" data-toggle="tooltip" title="View"
                            data-original-title="Marking" > <i class="fa fa-eye" aria-hidden="true"></i> </a>
                    </td>
                </tr>
                @endforeach


            </tbody>
        </table>
    </div>
    </div>
    </div>
</section>

<script>
    $(document).ready(function() {
            $(".addOB").click(function() {
                $("#Objective_plan").append(`
            <tr valign="top">

                <td> 1 </td>

                <td><input type="text" name="payment_method[]" class="code" id="customFieldName" value="" placeholder="Individual Objective" requird readonly/></td>
                <td> <input type="text" class="code" id="customFieldValue" name="methodInfo[]" value="" placeholder="Measures Of Success" readonly/> </td>
                <td> <input type="text" class="code" id="customFieldValue" name="methodInfo[]" value="" placeholder="Action Taken" required/> </td>
                <td> <input type="text" class="code" id="customFieldValue" name="methodInfo[]" value="" placeholder="Comments" required/> </td>
                <td> <input type="text" class="code" id="customFieldValue" name="methodInfo[]" value="" placeholder="Marking" required/> </td>
                <td> <input type="text" class="code" id="customFieldValue" name="methodInfo[]" value="" placeholder="Total Marking" readonly/> </td>

            </tr>
            `);
            });
            $("#Objective_plan").on('click', '.remOB', function() {
                $(this).parent().parent().remove();
            });

        });


        $(document).on('keyup', '.get_point', function() {


            var getPoint = parseFloat($(this).val() - 0);
            var totalPoint = parseFloat($(".totalPoint").val() - 0);

            if (totalPoint > getPoint) {
                $(this).removeClass("border border-danger");
                $(this).addClass("border border-success");

            } else if (totalPoint < getPoint) {
                Swal.fire('Warning!', 'Rating Can not Grater Then Total Rating.', 'warning');
                $(this).val(totalPoint);
                $(this).removeClass("border border-success");
                $(this).addClass("border border-danger");
            }


        });
</script>
@endsection
