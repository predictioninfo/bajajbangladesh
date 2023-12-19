@extends('back-end.premium.layout.employee-setting-main')
@section('content')
    <?php
    use App\Models\User;
    use App\Models\ObjectiveTypeConfig;
    use App\Models\ObjectiveDetails;
    use App\Models\Objective;
    $users = User::where('id', Session::get('employee_setup_id'))->first(['designation_id', 'department_id', 'id']);
    $users_objectives = ObjectiveTypeConfig::where('obj_config_com_id', Auth::user()->com_id)
        ->where('obj_config_desig_id', $users->designation_id)
        ->get();

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
                    <h1 class="card-title text-center"> {{ $objectiveUsers->userfromobjective->first_name ?? '' }}
                        {{ $objectiveUsers->userfromobjective->last_name ?? '' }}'s Yearly Performance Review Form</h1>
                    <ol id="breadcrumb1">
                        <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                        <li><a href="{{ route('employee-performance-review') }}"><span class="fa fa-list"> </span> List</a></li>
                        <li><a href="#">Show - {{ 'Yearly Performance
                            Review' }} </a></li>
                    </ol>
                </div>
            </div>

            <div class="objective-contant">
                <div class="row">
                    <div class="col-md-12">
                        @php
                            $getPoint = 0;
                            $totalPoint = 0;

                        @endphp

                        <form method="POST" action="{{ route('update-performance-reviews', $objectiveUsers->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @php($i = 1)

                            <table class="form-table" id="Objective_plan">
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
                                        <th colspan="8" class="text-center"> <b>

                                                {{ $objective->objectiveTypes->objective_type_name ?? '' }} -
                                                {{ $objective->objectiveTypeConfig->obj_config_percent ?? '' }} %</b> </th>
                                    </tr>




                                    @foreach ($Objdetails as $value)
                                        <?php
                                        $getPoint += $value->rating;
                                        $totalPoint += $value->objectiveTypeConfig->obj_config_target_point;

                                        ?>

                                        <tr valign="top">


                                            <td> {{ $i++ }} </td>
                                            <td>
                                                <textarea name="obj_name[]" class="code" id="customFieldName" placeholder="Individual Objective" readonly> {{ $value->objective_name ?? '' }}</textarea>
                                            </td>
                                            <td>
                                                <textarea class="code" name="messure_of_succ[]" placeholder="Measures Of Success" readonly> {{ $value->objective_success ?? '' }}</textarea>
                                            </td>
                                            <td>
                                                <textarea class="code" name="action_taken[]" placeholder="Action Taken" required>{{ $value->action_taken ?? '' }}</textarea>
                                            </td>
                                            <td>
                                                <textarea class="code" name="super_comments[]" placeholder="Comments" readonly>{{ $value->super_comments ?? '' }}</textarea>
                                            </td>
                                            <td> <input type="text" class="code get_point" name="rating[]" readonly
                                                    value=" {{ $value->rating ?? '' }}" placeholder="Marking" /> </td>
                                            <td> <input type="text" class="code totalPoint" name="total_rating[]"
                                                    value=" {{ $value->objectiveTypeConfig->obj_config_target_point ?? '' }}"
                                                    placeholder="Total Marking" readonly />

                                            </td>

                                            <input type="hidden" name="review_dept_id" class="code"
                                                placeholder="Individual Objective"
                                                value="{{ $objectiveUsers->objective_dept_id }}" />
                                            <input type="hidden" name="review_desi_id" class="code"
                                                value="{{ $objectiveUsers->objective_desig_id }}"
                                                placeholder="Individual Objective" />
                                            <input type="hidden" name="review_emp_id" class="code"
                                                value="{{ $objectiveUsers->objective_emp_id }}"
                                                placeholder="Individual Objective" />

                                            <input type="hidden" name="review_dept_id1[]" class="code"
                                                placeholder="Individual Objective"
                                                value="{{ $objectiveUsers->objective_dept_id }}" />
                                            <input type="hidden" name="review_desi_id1[]" class="code"
                                                value="{{ $objectiveUsers->objective_desig_id }}"
                                                placeholder="Individual Objective" />
                                            <input type="hidden" name="review_emp_id1[]" class="code"
                                                value="{{ $objectiveUsers->objective_emp_id }}"
                                                placeholder="Individual Objective" />


                                            <input type="hidden" name="objective_id[]" value="{{ $value->objective_id }}"
                                                class="code" placeholder="Individual Objective" />
                                            <input type="hidden" name="objective_obj_type_id[]"
                                                value="{{ $value->objective_obj_type_id }}" />
                                            <input type="hidden" name="obj_config_id[]"
                                                value="{{ $value->obj_config_id }}" />
                                            <input type="hidden" name="id" value="{{ $value->id }}" />

                                        </tr>
                                    @endforeach
                                @endforeach

                                <tr>
                                    <td class="grand_total text-right " colspan="5">Average Rating for Objectives:</td>
                                    <td><input type="text" class="code" name="messure_of_succ[]"
                                            value="{{round( $marking_rating) }}"
                                            placeholder="Mark" readonly /></td>

                                    <td><input type="text" class="code" name="messure_of_succ[]"
                                            value="{{round( $total_rating) }}"
                                            placeholder="Mark" readonly /> </td>

                                </tr>
                            </table>
                            @if ($objectiveUsers->review_status == 'Approve')
                            @else
                                <button class="btn btn-grad">Save</button>
                            @endif
                            <button type="button" class="edit-btn btn btn-grad mr-2" data-toggle="modal"
                                data-target="#addCommentsModal">
                                {{ __('Comments') }}
                            </button>

                        </form>
                    </div>
                </div>
            </div>
            </table>


            <div id="addCommentsModal" class="modal fade" role="dialog">
                <div class="modal-dialog modal-lg" style="width: 100%;">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 id="exampleModalLabel" class="modal-title">{{__('Employee Comments
                                ')}}</h5>
                            <button type="button" data-dismiss="modal" id="close" aria-label="Close"
                                class="close"><i class="dripicons-cross"></i></button>
                        </div>

                        <div class="modal-body">
                            <form action="{{ route('employee-objective-comments', $objectiveUsers->id) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="objective_comments_emp_id"
                                    value="{{ $objectiveUsers->objective_emp_id }}" />
                                <textarea class="code" id="customFieldValue"
                                    name="employee_comments" value=""
                                    placeholder="Employee Comments"></textarea>

                                <button class="btn btn-grad">Save</button>
                            </form>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>

    <script>
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
