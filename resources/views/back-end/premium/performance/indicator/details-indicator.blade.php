@extends('back-end.premium.layout.premium-main')
@section('content')
<?php
    use App\Models\User;
    use App\Models\ObjectiveTypeConfig;
    use App\Models\Objective;
    use App\Models\ObjectiveDetails;
?>

<section class="main-contant-section">
    <div class="">

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
                <h1 class="card-title text-center"> {{ $userName->userfromobjective->first_name ?? '' }}
                    {{ $userName->userfromobjective->last_name ?? '' }}'s Objective Details  </h1>
                <ol id="breadcrumb1">
                    <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                    <li><a href="{{ route('indicators') }}"><span class="icon icon-list"> </span> List</a></li>
                    <li><a href="#">Show - {{ 'Objective Details' }} </a></li>
                </ol>
            </div>
        </div>


        <div class="content-box">
        <div class="objective-contant">
            <p>1. OBJECTIVES FOR THE PERIOD UNDER REVIEW (To be filled by the Employee and approved by the Supervisor at the beginning of the year)</p>
            <div class="row">
                <div class="col-md-12">
                    <p>This section should report the objectives that have been cascaded to you by your supervisor for the year. Please write a minimum of 1 and a
                        maximum of 5 SMART (Specific, Measurable, Achievable, Realistic, Time Based) objectives in each section and total objectives will be minimum 3 and maximum 8.</p>
                    <div class="table-responsive">

                        <form action="{{ route('update-objectives', $userName->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <table class="form-table" id="Objective_plan">
                                <tbody>
                                    @foreach ($detailsObjective->unique(fn($p) =>
                                    $p->objectiveTypeConfig->userobjectivetypefromobjectiveconfig->objective_type_name)
                                    as $objective)

                                    <?php
                                            $Objdetails = ObjectiveDetails::where('objective_obj_type_id', $objective->objective_obj_type_id)
                                                ->where('objective_id', $objective->objective_id)
                                                ->where('obj_detail_com_id', Auth::user()->com_id)
                                                ->get();
                                            ?>

                                    <tr>
                                        <th colspan="5" class="text-center">
                                            {{
                                            $objective->objectiveTypeConfig->userobjectivetypefromobjectiveconfig->objective_type_name
                                            ?? null }}
                                            -
                                            {{ $objective->objectiveTypeConfig->obj_config_percent ?? null }}%
                                        </th>
                                    </tr>
                                    <tr valign="top">
                                        <th>
                                            Individual Objective With Timeline (Please fill this at the beginning of the year. Please specify your objectives here)
                                        </th>
                                        <th>
                                            Measures Of Success (Please specify metrics for measuring the objectives)
                                        </th>

                                        <th>
                                            <a href="javascript:void(0);" class="addOB btn"
                                                onclick="addMoreOb(`{{ $objective->objective_obj_type_id }}`)"> <i
                                                    class="fa fa-plus" aria-hidden="true"></i> </a>
                                        </th>

                                    </tr>

                                    <input type="hidden" name="objective_dept_id"
                                        value="{{ $userName->objective_dept_id }}" />

                                    <input type="hidden" name="objective_desig_id"
                                        value="{{ $userName->objective_desig_id }}" />

                                    <input type="hidden" name="objective_emp_id"
                                        value="{{ $userName->objective_emp_id }}" />
                                    @foreach ($Objdetails as $value)

                                    <tr id="after{{ $value->objective_obj_type_id }}">
                                        <td><textarea name="objective_name[]" class="code" id="customFieldName" value=""
                                                placeholder="Objective Name">{{ $value->objective_name }}</textarea>
                                        </td>
                                        <td> <textarea class="code" id="customFieldValue" name="objective_success[]"
                                                value=""
                                                placeholder="Objective Name Succes">{{ $value->objective_success }} </textarea>
                                        </td>
                                        <input type="hidden" name="objective_id[]" value="{{ $value->objective_id }}"
                                            class="code" placeholder="Individual Objective" />

                                        <input type="hidden" name="obj_detail_com_id"
                                            value="{{ $value->obj_detail_com_id }}" class="code" />

                                        <input type="hidden" name="obj_config_obj_typ_id[]"
                                            value="{{ $value->objective_obj_type_id }}" />

                                        <td class="remBtn"> <a href="javascript:void(0);" class="remOB btn"><i
                                                    class="fa fa-minus" aria-hidden="true"></i></a> </td>
                                    </tr>
                                </tbody>
                                @endforeach
                                @endforeach
                            </table>
                            <div class="form-group mt-4">
                            <button class="btn btn-grad mr-2">Save</button>
                            <input type="submit" name="status" class="btn btn-grad mr-2" value="{{ __('Approve') }}" />
                            <button type="button" class="edit-btn btn btn-grad mr-2" data-toggle="modal"
                                data-target="#addReviewModal">
                                {{__('Review
                                ')}}
                            </button>
                            <a style="" href="{{ route('details-objective-plans-pdf',$userName->id) }}"
                                class="btn btn-grad">Download</a>
                            </div>
                        </form>
                    </div>

                    <div id="addReviewModal" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-lg" style="width: 100%;">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 id="exampleModalLabel" class="modal-title">{{__('Supervisor Review
                                        ')}}</h5>
                                    <button type="button" data-dismiss="modal" id="close" aria-label="Close"
                                        class="close"><i class="dripicons-cross"></i></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('supervisor-review-objectives', $userName->id) }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="objective_emp_id"
                                            value="{{ $userName->objective_emp_id }}" />
                                        <textarea class="code" id="customFieldValue" name="objective_supervisor_review"
                                            value=""
                                            placeholder="Supervisor Review">{{ $review->objective_supervisor_review ?? null }}</textarea>

                                        <button class="btn btn-grad">Review</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</section>
<script>
    function addMoreOb(id) {

            var objective_obj_type_id = id;

            $('#after' + id).after(`
           <tr valign="top">
           <td><textarea  name="objective_name[]" class="code" id="customFieldName"  value="" placeholder="Objective Name" required ></textarea></td>
           <td> <textarea  class="code" id="customFieldValue" name="objective_success[]" value="" placeholder="Objective Name Succes" required></textarea>
            <input type="hidden" name="obj_config_obj_typ_id[]" value="${id}"/> </td>
            <td class="remBtn"> <a href="javascript:void(0);" class="remOB btn"><i class="fa fa-minus" aria-hidden="true"></i></a> </td>
       </tr> `);
        }
        $("#Objective_plan").on('click', '.remOB', function() {
            $(this).parent().parent().remove();
        });
</script>
@endsection
