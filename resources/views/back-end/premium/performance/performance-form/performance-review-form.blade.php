@extends('back-end.premium.layout.premium-main')
@section('content')
    <?php
    use App\Models\User;
    use App\Models\ObjectiveTypeConfig;
    use App\Models\Objective;
    use App\Models\ObjectiveDetails;
    ?>
    <section class="main-contant-section">


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
                    {{ $objectiveUsers->userfromobjective->last_name ?? '' }}'s Yearly Performance Review Form </h1>
                <ol id="breadcrumb1">

                    <li><a href="#" class="toggle_down tip" data-toggle="tooltip" title=" Show Form "
                            data-original-title="Show Form">
                            <i class="icon fa fa-toggle-down"></i>
                        </a></li>
                    <li> <a href="#" class="toggle_up tip" data-toggle="tooltip" title="Hide Form"
                            data-original-title="Hide Form">
                            <i class="icon fa fa-toggle-up"></i>
                        </a></li>

                    <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                    <li><a href="{{ route('performance-forms') }}"><span class="icon icon-list"> </span> List</a></li>
                    <li><a href="#">Show - {{ 'Yearly Review' }} </a></li>
                </ol>
            </div>
        </div>

        <div id="form" style="display: block;">
            <div class="content-box">
                <div class="table-responsive">
                    <table id="user-table" class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Objective Rating</th>
                                <th> Rating Defination</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($ratingDefination as $key => $value)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $value->point }}</td>
                                    <td>{{ $value->defination }}</td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="content-box">
            <div class="objective-contant">
                <div class="row">
                    <div class="col-md-12">
                        <p>This section should review overall performance against all objectives including any changes
                            made during the course of the year. The Employee should complete his/her
                            section first. This should be followed by a conversation between the Employee and Supervisor
                            after which the Supervisor completes his/her sections.Supervisor needs
                            to complete the ratings and share this with the employee. Once both have signed off, the
                            supervisor may include his/her recommendations
                            in section 8i (to be kept confidential from employee) and arrange for the next level
                            supervisor's sign off and send to HR for their comments and
                            further processing.</p>
                    </div>
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
                                                <textarea name="obj_name[]" class="code" id="customFieldName" placeholder="Individual Objective" readonly> {{ $value->objective_name ?? '' }}</textarea>
                                            </td>
                                            <td>
                                                <textarea class="code" name="messure_of_succ[]" placeholder="Measures Of Success" readonly>{{ $value->objective_success ?? '' }}</textarea>
                                            </td>
                                            <td>
                                                <textarea class="code" name="action_taken[]" readonly value="" placeholder="Action Taken" required>{{ $value->action_taken ?? '' }}</textarea>
                                            </td>
                                            <td>
                                                <textarea class="code" name="super_comments[]" value="" placeholder="Comments" required>{{ $value->super_comments ?? '' }}</textarea>
                                            </td>
                                            <td> <input type="text" class="code get_point" id="rating" name="rating[]"
                                                    required value=" {{ $value->rating ?? '' }}" placeholder="Marking" />
                                            </td>
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

                                            <input type="hidden" name="objective_id[]"
                                                value="{{ $value->objective_id }}" class="code"
                                                placeholder="Individual Objective" />
                                            <input type="hidden" name="objective_obj_type_id[]"
                                                value="{{ $value->objective_obj_type_id }}" />
                                            <input type="hidden" name="obj_config_id[]"
                                                value="{{ $value->obj_config_id }}" />
                                            <input type="hidden" name="id" value="{{ $value->id }}" />
                                        </tr>
                                    @endforeach
                                @endforeach

                                <tr>
                                    <td class="grand_total text-right " colspan="4">Average Rating for Objectives :
                                    </td>
                                    <td><input type="text" class="code" name="point" id="sum"
                                            value="{{round ($marking_rating) }}"
                                            placeholder="Mark" readonly /></td>
                                    <td><input type="text" class="code" name="messure_of_succ[]"
                                            value="{{ round($total_rating) }}"
                                            placeholder="Mark" readonly /> </td>

                                </tr>
                            </table>

                            <button class="btn btn-grad mt-4">Submit</button>

                            <input type="submit" name="review_status" class="btn btn-grad mt-4" value='Approve' />
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <script>
        $('#form').hide();
        $('.toggle_down').click(function() {
            $("#form").slideDown();
            return false;
        });
        $('.toggle_up').click(function() {
            $("#form").slideUp();
            return false;
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
            var sum = 0;
            var objective_id = $('input[name="objective_id[]"]').length;
            console.log(objective_id);
            $("input[name='rating[]']").each(function() {
                sum += +this.value || 0;
            });
            // console.log(sum/4);
         $("#sum").val(Math.round(sum / objective_id));
            console.log(Math.round(sum / objective_id));
        });
    </script>
@endsection
