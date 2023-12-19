@extends('back-end.premium.layout.premium-main')
@section('content')
    <?php
    use App\Models\User;
    use App\Models\ObjectiveTypeConfig;
    use App\Models\Objective;
    use App\Models\ObjectiveDetails;

     $users = User::where('id', Session::get('employee_setup_id'))->first(['designation_id','department_id','id']);
     $users_objectives = ObjectiveTypeConfig::where('obj_config_com_id',
    Auth::user()->com_id)->where('obj_config_desig_id',$users->designation_id)->get();

    ?>
    <section class="main-contant-section">
        <div class="container-fluid">
            
            <div class="card mb-4">
                <div class="card-header with-border">
                    <h1 class="card-title text-center">{{ $objectiveUsers->userfromobjective->first_name ?? '' }}
                        {{ $objectiveUsers->userfromobjective->last_name  ?? ''}}'s Performance Form </h1>

                    {{-- <input type="hidden" name="review_desi_id" class="code" placeholder="Individual Objective" />
                        <input type="hidden" name="review_emp_id" class="code" placeholder="Individual Objective" /> --}}
                </div>
            </div>
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
                                                    value=" {{ $value->objective_name ?? '' }}"
                                                    placeholder="Individual Objective" readonly /></td>
                                            <td> <input type="text" class="code" name="messure_of_succ[]"
                                                    value=" {{ $value->objective_success ?? '' }}"
                                                    placeholder="Measures Of Success" readonly /> </td>
                                            <td> <input type="text" class="code" name="action_taken[]"
                                                    value=" {{ $value->action_taken ?? '' }}" placeholder="Action Taken"
                                                    required /> </td>
                                            <td> <input type="text" class="code" name="super_comments[]"
                                                    value=" {{ $value->super_comments ?? '' }}" placeholder="Comments"
                                                    readonly /> </td>
                                            <td> <input type="text" class="code get_point" name="rating[]"
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
                                            <input type="hidden" name="obj_config_id[]"
                                                value="{{ $value->obj_config_id }}" />
                                            <input type="hidden" name="id" value="{{ $value->id }}" />

                                        </tr>
                                    @endforeach
                                @endforeach

                                <tr>
                                    <td class="grand_total text-right " colspan="5">Point:</td>
                                    <td><input type="text" class="code" name="messure_of_succ[]"
                                            value=" {{ $getPoint }}" placeholder="Mark" readonly /></td>

                                    <td><input type="text" class="code" name="messure_of_succ[]"
                                        value=" {{  $totalPoint }}" placeholder="Mark" readonly /> </td>

                                </tr>
                            </table>


                            <input type="submit" id="submit" value="{{ __('Submit') }}" class="btn btn-primary">
                        </form>
                    </div>
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
