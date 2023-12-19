@extends('back-end.premium.layout.employee-setting-main')
@section('content')
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
                <h1 class="card-title text-center"> {{ ucfirst($userName->user->first_name) }}
                    {{ ucfirst($userName->user->last_name) }}'s Development Plan Details</h1>
                <ol id="breadcrumb1">
                    <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                    <li><a href="{{ route('employee-objectives') }}"><span class="fa fa-list"> </span> List</a></li>
                    <li><a href="#">Show - {{ 'Development Plan Details' }} </a></li>
                </ol>
            </div>
        </div>

        <div class="objective-contant">
            <div class="content-box">
                <div class="">
                        <h6>2. DEVELOPMENT PLAN FOR THE PERIOD UNDER REVIEW (To be filled by the Employee and approved by the Supervisor)</h6>
                        <p>This section should capture your Development Plans for the year. Please focus on 1-3 important development goals ie areas you want to improve upon.
                             Your development goals should support you in achieving your individual objectives above. The development plan should capture activities through on-the-job experience,
                             exposure by working on cross-functional projects and networking assignments; and classroom training provided by internal or external providers.  </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">

                    <div class="table-responsive">

                        @php($i = 1)

                        <form action="{{ route('update-development-plans', $userName->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <table class="form-table" id="development_plan">
                                <tbody>
                                    <tr valign="top">

                                        <th>
                                            Development Plan (Please fill this at the beginning of the year)
                                        </th>
                                        <th>
                                            Measures of Success (Please specify metrics for measuring the development plan. Please fill this at the beginning of the year)
                                        </th>
                                        <th>
                                            Actions Taken (Please mention actions taken against the plan. Please fill it at the year end)
                                        </th>
                                        <th>
                                            <a href="javascript:void(0);" class="addOB btn"> <i class="fa fa-plus"
                                                    aria-hidden="true"></i> </a>
                                        </th>


                                    </tr>
                                    <input type="hidden" name="development_dept_id"
                                        value="{{ $userName->development_dept_id }}" />

                                    <input type="hidden" name="development_desig_id"
                                        value="{{ $userName->development_desig_id }}" />

                                    <input type="hidden" name="development_emp_id"
                                        value="{{ $userName->development_emp_id }}" />

                                    @foreach ($detailsDevelopment as $value)
                                    <tr>
                                        <td><textarea class="code" name="development_name[]" id="customFieldName"
                                                placeholder="Development Name">{{ $value->development_name }}</textarea>
                                        </td>
                                        <td> <textarea class="code" id="customFieldValue" name="meassure_of_success[]"
                                                placeholder="Meassure Of Success">{{ $value->development_meassure_of_success }}</textarea>
                                        </td>
                                        <td> <textarea type="text" class="code" id="customFieldValue"
                                                name="action_taken[]" placeholder="Action Taken"
                                                readonly> {{ $value->development_action_taken ?? ''}}</textarea></td>
                                        <input type="hidden" class="code" id="customFieldValue"
                                            name="development_details__id[]"
                                            value="{{ $value->development_details__id }} " required />
                                        <td class="remBtn"> <a href="javascript:void(0);" class="remOB btn"><i
                                                    class="fa fa-minus" aria-hidden="true"></i></a> </td>
                                    </tr>
                                </tbody>
                                @endforeach
                            </table>
                            @if($userName->status == "Approve")

                            @else
                            <button class="btn btn-grad">Save</button>
                            @endif
                            @if(Auth::user()->company_profile == 'Yes' || Auth::user()->user_admin_status ==
                            'Yes')
                            <input type="submit" name="status" class="btn btn-grad " value="{{__('Approve')}}" />
                            <button type="button" class="edit-btn btn btn-grad mr-2" data-toggle="modal"
                                data-target="#addReviewModal">
                                {{__('Review
                                ')}}
                            </button>
                            @endif
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
                                    <form action="{{ route('supervisor-review-developments', $userName->id) }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="development_emp_id"
                                            value="{{ $userName->development_emp_id }}" />
                                        <textarea class="code" id="customFieldValue"
                                            name="development_supervisor_review" value=""
                                            placeholder="Supervisor Review">{{ $development_review->development_supervisor_review ?? null }}</textarea>
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
</section>
<script>
    $(document).ready(function() {
            $(".addOB").click(function() {
                $("#development_plan").append(`
                <tr valign="top">

                    <td><textarea  name="development_name[]" class="code" id="customFieldName" value=""
                            placeholder="Development Name" required ></textarea></td>
                    <td><textarea name="meassure_of_success[]" class="code" id="customFieldName" value=""
                            placeholder="Measure of Success" required ></textarea></td>
                    <td> <textarea class="code" id="customFieldValue" name="action_taken[]" value="" placeholder="Action Taken"
                            readonly ></textarea> </td>
                    <td class="remBtn"> <a href="javascript:void(0);" class="remOP btn"><i class="fa fa-minus" aria-hidden="true"></i></a>
                    </td>
                </tr>
                `);
            });
            $("#development_plan").on('click', '.remOB', function() {
                $(this).parent().parent().remove();
            });

        });
</script>
@endsection
