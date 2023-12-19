@extends('back-end.premium.layout.premium-main')
@section('content')
    <section class="main-contant-section">

        <style>
            /* checkbox-rect */
            .checkbox-rect input[type="checkbox"] {
                display: none;
            }

            .checkbox-rect input[type="checkbox"]+label {
                display: block;
                position: relative;
                padding-left: 35px;
                margin-bottom: 20px;
                font: 14px/20px "Open Sans", Arial, sans-serif;
                cursor: pointer;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
            }

            .checkbox-rect input[type="checkbox"]:hover+label:hover {
                color: rgb(23, 86, 228);
            }

            .checkbox-rect input[type="checkbox"]:hover+label:before {
                background: #50565a;
                box-shadow: inset 0px 0px 0px 2px #f7f2f2;
            }

            .checkbox-rect input[type="checkbox"]+label:last-child {
                margin-bottom: 0;
            }

            .checkbox-rect input[type="checkbox"]+label:before {
                content: "";
                display: block;
                width: 1.4em;
                height: 1.4em;
                border: 1px solid #343a3f;
                border-radius: 0.2em;
                position: absolute;
                left: 0;
                top: 0;
                -webkit-transition: all 0.2s, background 0.2s ease-in-out;
                transition: all 0.2s, background 0.2s ease-in-out;
                background: #f3f3f3;
            }

            .checkbox-rect input[type="checkbox"]:checked+label:before {
                width: 1.3em;
                height: 1.3em;
                border-radius: 0.2em;
                border: 2px solid #fff;
                -webkit-transform: rotate(90deg);
                transform: rotate(90deg);
                background: #50565a;
                box-shadow: 0 0 0 1px #000;
            }

            @keyframes animate {
                0% {
                    color: #f00808;
                    text-shadow: none;
                    transform: scale(1);

                }

                90% {
                    color: #484848;
                    text-shadow: none;
                    transform: scale(1);

                }

                100% {
                    color: #fff900;
                    text-shadow: 0 0 7px #fff900, 0 0 50px #ff6c00;
                    transform: scale(1.5);

                }
            }

            .dot {
                width: 5px;
                height: 5px;
                border-radius: 50%;
                background: #f10606;
                position: relative;
                top: -10px;
                left: 0px;
                animation: blinking 1s steps(5) infinite;
                -webkit-animation: blinking 1s steps(5) infinite;
                -moz-animation: blinking 1s steps(5) infinite;
                -o-animation: blinking 1s steps(5) infinite;
            }

            @keyframes blinking {
                from {
                    opacity: 1;
                }

                to {
                    opacity: 0;
                }
            }

            @-webkit-keyframes blinking {
                from {
                    opacity: 1;
                }

                to {
                    opacity: 0;
                }
            }

            @-moz-keyframes blinking {
                from {
                    opacity: 1;
                }

                to {
                    opacity: 0;
                }
            }

            @-o-keyframes blinking {
                from {
                    opacity: 1;
                }

                to {
                    opacity: 0;
                }
            }
        </style>

        <div class=" mb-3">

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
            <div class="card mb-4">
                <div class="card-header with-border">
                    <h1 class="card-title text-center"> {{ __('Recommendation List') }} </h1>
                    <ol id="breadcrumb1">
                        <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>

                        <li><a href="#" type="button" data-toggle="modal" data-target="#nocEmployeeListModal"><span
                                    class="icon icon-plus"> </span>Recommendation List</a></li>

                    </ol>
                </div>
            </div>
        </div>

        <div class="content-box">
            <div class="table-responsive">
                <table id="user-table" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>{{ __('SL') }}</th>
                            <th>{{ __('Employee Name') }}</th>
                            <th>{{ __('Department') }}</th>
                            <th>{{ __('Designation') }}</th>
                            <th>{{ __('Joining Date') }}</th>
                            <th>{{ __('Probation Month') }}</th>
                            <th>{{ __('Probation Expairy Date') }}</th>
                            <th>{{ __('New Salary') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($i = 1)
                        @foreach ($recommendations as $recommendation)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $recommendation->receEployee->first_name }}
                                    {{ $recommendation->receEployee->last_name }}</td>
                                <td>{{ $recommendation->recDepartment->department_name ?? '' }}</td>
                                <td>{{ $recommendation->recDesignation->designation_name ?? '' }}</td>
                                <td>{{ $recommendation->pro_joining_date }}</td>
                                <td>{{ $recommendation->pro_month }}</td>
                                <td>{{ $recommendation->pro_expi_date }}</td>
                                <td>{{ $recommendation->pro_old_salary }}</td>
                                <td>
                                    @if ($recommendation->status == 1)
                                        <label class="btn btn-info" for="">
                                            {{ __('Approved') }}
                                        </label>
                                    @elseif($recommendation->status == 0)
                                        <label class="btn btn-danger" for="">
                                            {{ __('Pending') }}
                                        </label>
                                        @if (Auth::user()->company_profile == 'Yes' || Auth::user()->userrole->roles_admin_status == 'Yes')
                                            @if ($recommendation->supervisor_status == 1)
                                                <span class="dot"></span>
                                            @endif
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    @if (Auth::user()->company_profile == 'Yes' || Auth::user()->userrole->roles_admin_status == 'Yes')
                                        @if ($recommendation->status == 1)
                                            <a href="javascript:void(0)" class="btn view"
                                                data-id="{{ $recommendation->id }}" data-toggle="tooltip" title=" View"
                                                data-original-title="View"> <i class="fa fa-eye" aria-hidden="true"></i></a>
                                            <a href="{{ route('recommendation-download', $recommendation->id) }}"
                                                class="btn btn-info" data-toggle="tooltip" title=" PDF Download"
                                                data-original-title="PDF Download"> <i class="fa fa-file"
                                                    aria-hidden="true"></i></a>
                                        @else
                                            <a href="javascript:void(0)" data-toggle="modal"
                                                data-id="{{ $recommendation->id }}" class="btn edit"
                                                title=" Edit & Approve" data-original-title="Edit"><i
                                                    class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                        @endif
                                    @else
                                        @if ($recommendation->supervisor_status == 0)
                                            @if ($recommendation->status == 0)
                                                <a href="javascript:void(0)" class="btn btn-info approve"
                                                    onclick="openModalForm('{{ $recommendation->id }}')"
                                                    data-toggle="tooltip" title="Review" data-original-title="Review">
                                                    <i class="fa fa-check" aria-hidden="true"></i>
                                                </a>
                                            @elseif($recommendation->status == 1)
                                                <a href="javascript:void(0)" class="btn view"
                                                    data-id="{{ $recommendation->id }}" data-toggle="tooltip"
                                                    title=" View" data-original-title="View"> <i class="fa fa-eye"
                                                        aria-hidden="true"></i></a>
                                            @endif
                                        @else
                                            <a href="javascript:void(0)" class="btn btn-info" data-toggle="tooltip"
                                                title="Reviewed" data-original-title="Reviewed" disabled>
                                                <i class="fa fa-spinner fa-pulse" aria-hidden="true"></i>
                                            </a>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Modal Form for Review Start-->
    <div class="modal fade" id="modal-form">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="ajaxModelReview"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Input field to receive recommendation_id value -->
                <div class="modal-body">
                    <form method="post" action="{{ route('review-employee') }}" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="recommendation_id" id="id" value="">
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <table id="user-table">
                                    <thead>
                                        <tr>
                                            <th> SL</th>
                                            <th class="text-center">Details</th>
                                            <th>Remark</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Leave availed during probation period
                                            </td>
                                            <td> <input class="form-control" type="text" name="question_1"
                                                    id="question_1"> </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Disciplinary action taken or verbal warning given to the employee during
                                                probation period
                                            </td>
                                            <td> <input class="form-control" type="text" name="question_2"
                                                    id="question_2"> </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Probation period extended before or not
                                            </td>
                                            <td> <input class="form-control" type="text" name="question_3"
                                                    id="question_3"> </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-5 form-group check-box" style="margin-left:20px;">
                                    <h4 for="">Recommendation For</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 form-group check-box" style="margin-left:20px;">
                                    <div class="box">
                                        <div class="item">
                                            <div class="checkbox-rect">
                                                <input type="checkbox" id="checkbox-rect1-supervisor"
                                                    name="check1supervisor">
                                                <label for="checkbox-rect1-supervisor"> Confirmed</label>
                                            </div>
                                        </div>
                                        <span class="checkbox-rect" id="salary-supervisor"></span>
                                        <span class="checkbox-rect" id="increment_salary_value"></span>
                                    </div>
                                </div>
                                <div class="col-md-5 form-group check-box" style="margin-left:20px;">
                                    <div class="box">
                                        <div class="item">
                                            <div class="checkbox-rect">
                                                <input type="checkbox" id="checkbox-rect2-supervisor"
                                                    name="check2supervisor" value="yes">
                                                <label for="checkbox-rect2-supervisor"> Terminated</label>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-5 form-group check-box" style="margin-left:20px;">
                                    <div class="box">
                                        <div class="item">
                                            <div class="checkbox-rect">
                                                <input type="checkbox" id="checkbox-rect3-supervisor"
                                                    name="check3supervisor">
                                                <label for="checkbox-rect3-supervisor">Extend</label>
                                            </div>
                                        </div>
                                        <span id="extend-supervisor"></span>
                                    </div>
                                </div>
                                <div class="col-md-5 form-group check-box" style="margin-left:20px;">
                                    <div class="box">
                                        <div class="item">
                                            <div class="checkbox-rect">
                                                <input type="checkbox" id="checkbox-rect4-supervisor"
                                                    name="check4supervisor" value="yes">
                                                <label for="checkbox-rect4-supervisor">Promoted</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="">Description</label>
                            <input class="form-control" type="text" name="description" id="description1">
                        </div>



                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" id="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Form for Review End-->

    <!-- Modal Form for View Start-->
    <div class="modal fade" id="view-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="ajaxModelView"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <table id="user-table">
                                <thead>
                                    <tr>
                                        <th> SL</th>
                                        <th class="text-center">Details</th>
                                        <th>Remark</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Leave availed during probation period
                                        </td>
                                        <td id="question_1_view"> </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Disciplinary action taken or verbal warning given to the employee during
                                            probation period
                                        </td>
                                        <td id="question_2_view"> </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Probation period extended before or not
                                        </td>
                                        <td id="question_3_view"> </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="">New Salary</label>
                            <input class="form-control" type="text" name="pro_old_salary" id="pro_old_salary"
                                readonly>
                        </div>

                        <div class="col-md-6 form-group">
                            <span id="pro_incre_salary"></span>
                        </div>

                        <div class="col-md-12 form-group">
                            <label>Description : </label>
                            <textarea class="form-control" rows="5" readonly id="description_view" readonly></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
    <!-- Modal Form for View End-->

    <!-- Modal Form for Edit Start-->
    <div class="modal fade" id="edit-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="ajaxModelEdit"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('update-review-employee') }}" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="edit_id" value="">
                        <input type="hidden" name="pro_emp_id" id="pro_emp_id" value="">
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <table id="user-table">
                                    <thead>
                                        <tr>
                                            <th> SL</th>
                                            <th class="text-center">Details</th>
                                            <th>Remark</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Leave availed during probation period
                                            </td>
                                            <td> <input class="form-control" type="text" name="question_1"
                                                    id="edit_question_1"> </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Disciplinary action taken or verbal warning given to the employee during
                                                probation period
                                            </td>
                                            <td> <input class="form-control" type="text" name="question_2"
                                                    id="edit_question_2"> </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Probation period extended before or not
                                            </td>
                                            <td> <input class="form-control" type="text" name="question_3"
                                                    id="edit_question_3"> </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="">Old Salary</label>
                                <input class="form-control" type="text" name="pro_old_salary"
                                    id="edit_pro_old_salary" readonly>
                            </div>

                            <div class="col-md-4 form-group">
                                <span id="edit_pro_incre_salary"></span>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="">Template</label>
                                <select name="template_id" id="template_id" class="form-control">
                                    <option value="">Select Template</option>
                                    @foreach ($probation_templates as $probation_template)
                                        <option value="{{ $probation_template->id }}">
                                            {{ $probation_template->probation_letter_format_subject }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5 form-group check-box" style="margin-left:20px;">
                                <div class="box">
                                    <div class="item">
                                        <div class="checkbox-rect">
                                            <input type="checkbox" id="checkbox-rect1-admin" name="check1">
                                            <label for="checkbox-rect1-admin">Confirmation</label>
                                        </div>
                                    </div>
                                    <span class="checkbox-rect" id="salary-admin"></span>
                                    <span class="checkbox-rect" id="increment_salary_for_admin"></span>
                                </div>
                            </div>
                            <div class="col-md-5 form-group check-box" style="margin-left:20px;">
                                <div class="box">
                                    <div class="item">
                                        <div class="checkbox-rect">
                                            <input type="checkbox" id="checkbox-rect2-admin" name="check2"
                                                value="yes">
                                            <label for="checkbox-rect2-admin">Terminate</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 form-group check-box" style="margin-left:20px;">
                                <div class="box">
                                    <div class="item">
                                        <div class="checkbox-rect">
                                            <input type="checkbox" id="checkbox-rect3-admin" name="check3">
                                            <label for="checkbox-rect3-admin">Extend</label>
                                        </div>
                                    </div>
                                    <span id="extend-admin"></span>
                                </div>
                            </div>

                            <div class="col-md-5 form-group check-box" style="margin-left:20px;">
                                <div class="box">
                                    <div class="item">
                                        <div class="checkbox-rect">
                                            <input type="checkbox" id="checkbox-rect4-admin" name="check4"
                                                value="yes">
                                            <label for="checkbox-rect4-admin">Promoted</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 form-group mt-3">
                                <label for="">Approve Date :</label>
                                <input class="form-control" type="date" name="accept_date" id="accept_date"
                                    onchange="showConfirmation()" readonly>
                                <span id="confirmation-message" class="confirm-message"
                                    style="display: none; color: red;
                                font-weight: bold;"></span>

                                <span id="att_name" style="color: red; font-weight: bold;"></span>

                            </div>
                            <div class="col-md-6 form-group mt-3">
                                <label>Description : </label>
                                <textarea name="description" class="form-control" rows="5" id="edit_description"></textarea>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="submit-admin" type="submit" class="btn btn-primary">Save & Approve</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function showConfirmation() {
            var checkbox = document.getElementById('accept_date');
            var confirmationMessage = document.getElementById('confirmation-message');

            if (checkbox) {
                confirmationMessage.style.display = 'block';
                confirmationMessage.textContent =
                    'Please ensure that this employee is present from the date of approval till the end of this month, otherwise net salary will be miss matched. এপ্রুভালের তারিখ থেকে ওই মাসের শেষ তারিখ পর্যন্ত এই কর্মচারীর attandence আছে কিনা নিশ্চিত হয়ে নিন। অন্যথায় বেতনে গরমিল হবে।';
            } else {
                confirmationMessage.style.display = 'none';
            }
        }
    </script>

    <!-- Modal Form for Edit End-->

    <!-- Modal Form for not allowed Start-->
    <div class="modal fade" id="not-allowed-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="ajaxModlNotApplicable"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <h1 class="text-center " style="font-family: Georgia, serif;"> Probation accept not allow for
                                <strong><span id="emp_name" class=""></span></strong>
                            </h1>
                            {{-- <p class="text-center" style="font-family: Arial, Helvetica, sans-serif;">Probation accept will be avaliable after <span id="available_date"></span> </p> --}}
                            {{-- <p class="text-center" style="font-size: 40px; color:cadetblue;font-family: Georgia, serif;">
                                Probation accept will be available after <span id="available_date"></span></p> --}}
                            <ol>
                                <li style="color: #f00808">Probation accept will be available after <span
                                        id="available_date"></span></li>
                                <li>If accept before Probation date his/her net salary don’t count properly.</li>
                                <li>Employ / Admin or any one if available for Probation his/ her check attendance and
                                    active status..</li>
                                <li>Admin must be check employ attendance full month after probation approve date. Other
                                    ways his/her attendance don’t count.</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Form for not allowed End-->
    <!--Promoted Modal For Admin-->
    <div class="modal fade" id="second-modal" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="ajaxModelEditDep"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('update-review-employee') }}" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        <input name="output_field1_admin" type="hidden" id="output_field1_admin">
                        <input name="output_field2_admin" type="hidden" id="output_field2_admin">
                        <input name="output_field3_admin" type="hidden" id="output_field3_admin">
                        <input name="description_field1_admin" type="hidden" id="description_field1_admin">
                        <input name="template_field1_admin" type="hidden" id="template_field1_admin">
                        <input type="hidden" name="employee_previous_designation_edit_id"
                            id="employee_previous_designation_edit_id" value="">
                        <input type="hidden" name="employee_previous_designation_pro_emp_id"
                            id="employee_previous_designation_pro_emp_id" value="">
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="">Previous Department</label>
                                <input class="form-control" type="text" name="employee_previous_designation"
                                    id="employee_previous_designation" readonly>
                                <input type="hidden" name="employee_previous_department_id"
                                    id="employee_previous_department_id">
                                <input type="hidden" name="employee_previous_designation_id"
                                    id="employee_previous_designation_id">
                                <input type="hidden" name="employee_previous_salary" id="employee_previous_salary">
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="">{{ __('New Department') }} <span
                                        class="text-danger">*</span></label>
                                <select class="form-control" name="new_department_id" id="new_department_id" required>
                                    <option value="">Select Department</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->department_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 form-group">
                                <label class="text-bold">{{ __('New Designation') }} <span
                                        class="text-danger">*</span></label>

                                <select class="form-control" name="new_designation" id="designation_id"
                                    required></select>

                            </div>
                            <div id="gross_salary" class="col-md-12 form-group">

                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="submit-change" type="submit" class="btn btn-primary" disabled>Update
                        Designation</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!--Promoted Modal For Supervisor-->
    <div class="modal fade" id="third-modal" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="ajaxModelEditDepSup"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('review-employee') }}" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        <input name="output_field1" type="hidden" id="output_field1">
                        <input name="output_field2" type="hidden" id="output_field2">
                        <input name="output_field3" type="hidden" id="output_field3">
                        <input name="description_field1" type="hidden" id="description_field1">
                        <input type="hidden" name="recommendation_id2" id="id2" value="">
                        <input type="hidden" name="employee_previous_designation_pro_emp_id_sup"
                            id="employee_previous_designation_pro_emp_id_sup" value="">
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="">Previous Department</label>
                                <input class="form-control" type="text" name="employee_previous_designation_sup"
                                    id="employee_previous_designation_sup" readonly>
                                <input type="hidden" name="employee_previous_department_sup_id"
                                    id="employee_previous_department_sup_id">
                                <input type="hidden" name="employee_previous_designation_id_sup"
                                    id="employee_previous_designation_id_sup">
                                <input type="hidden" name="employee_previous_salary_sup"
                                    id="employee_previous_salary_sup">
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="">{{ __('New Department') }} <span
                                        class="text-danger">*</span></label>
                                <select class="form-control" name="new_department_id_sup" id="new_department_id_sup"
                                    required>
                                    <option value="">Select Department</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->department_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 form-group">
                                <label class="text-bold">{{ __('New Designation') }} <span
                                        class="text-danger">*</span></label>

                                <select class="form-control" name="new_designation_sup" id="designation_id_sup"
                                    required></select>

                            </div>
                            <div id="gross_salary_sup" class="col-md-12 form-group">

                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="submit-sup" type="submit" class="btn btn-primary" disabled>Proposed
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        //For Rewiew

        function openModalForm(id) {
            // Set the value of recommendationId in the modal form
            $('#id').val(id);

            // Call the AJAX request
            $.ajax({
                url: 'review-show',
                type: 'POST',
                data: {
                    id: id
                },
                success: function(response) {
                    console.log(response);
                    $('#employee_previous_designation_sup').val(response.user_department.userdepartment
                        .department_name);
                    $('#id2').val(response.preview.id);
                    $('#employee_previous_department_sup_id').val(response.preview.pro_dep_id);
                    $('#employee_previous_designation_id_sup').val(response.preview.pro_desi_id);
                    $('#employee_previous_designation_pro_emp_id_sup').val(response.preview.pro_emp_id);
                    $('#employee_previous_salary_sup').val(response.preview.pro_old_salary);
                    // Open the modal form
                    $('#ajaxModelReview').html("Rewiew");
                    $('#modal-form').modal('show');
                    //For Supervisor Review
                    // Uncheck all checkboxes on page load
                    $('input[type="checkbox"]').prop("checked", false);
                    $('#checkbox-rect1-supervisor').on('click', function() {
                        $('#extend-supervisor').hide();
                        $('#increment_salary_value').hide();
                        if ($(this).prop('checked')) {
                            $('#salary-supervisor').html(
                                '<div class="row mt-3"><div class="col-md-6"><input id="increment_without_salary_supervisor" name="increment_without_salary_supervisor" class="" value="yes" type="checkbox"/><label for="increment_without_salary_supervisor">Without Salary</label> </div> <div class="col-md-6"><input id="increment_salary_supervisor" name="increment_salary_supervisor" class="checkbox-rect" type="checkbox" value="yes"/><label for="increment_salary_supervisor">With Salary</label></div></div>'
                            ).fadeIn();
                            $('#enxtend_month_supervisor, #output_field1, #output_field2, #output_field3, #description_field1')
                                .val('');
                        } else {
                            $('#salary-supervisor').html('').hide();
                        }

                        // Uncheck checkbox-rect2 when checkbox-rect1 is checked
                        $('#checkbox-rect2-supervisor, #checkbox-rect3-supervisor, #checkbox-rect4-supervisor')
                            .prop('checked',
                                false);
                        $('#increment_without_salary_supervisor').on('change', function() {
                            $('#increment_salary_value').val('');
                            $('#increment_salary_value').hide();
                            $('#submit').prop('disabled', !anyCheckboxChecked());
                            $('#increment_salary_supervisor').prop('checked', !$(this).is(
                                ':checked'));
                        });

                        $('#increment_salary_supervisor').on('change', function() {
                            $('#increment_without_salary_supervisor').val('');
                            $('#increment_without_salary_supervisor').prop('checked', !$(this)
                                .is(
                                    ':checked'));
                        });
                        $('#increment_without_salary_supervisor, #increment_salary_supervisor, #checkbox-rect1-supervisor')
                            .on('change', function() {
                                $('#submit').prop('disabled', !anyCheckboxChecked());
                            });

                        function anyCheckboxChecked() {
                            return $('#checkbox-rect1-supervisor').is(':checked') && ($(
                                '#increment_without_salary_supervisor').is(':checked') || $(
                                '#increment_salary_supervisor').is(':checked'));
                        }
                        $('#increment_salary_supervisor').on('change', function() {
                            if ($(this).prop('checked')) {
                                $('#increment_salary_value').html(
                                    '<input class="form-control mt-3" id="increment_salary_value" name="increment_salary_value" type="text"  placeholder="Enter amount"/>'
                                ).fadeIn();
                            } else {
                                $('#increment_salary_value').hide();
                                $('#increment_salary_value').fadeOut();
                            }
                        });
                    });


                    $('#checkbox-rect2-supervisor').on('click', function() {
                        $('#extend-supervisor').hide();
                        $('#salary-supervisor').hide();
                        $('#increment_salary_value').hide();
                        if ($(this).prop('checked')) {
                            $('#enxtend_month_supervisor, #increment_salary_supervisor, #increment_without_salary_supervisor, #increment_without_salary_supervisor,#increment_salary_value,, #output_field1, #output_field2, #output_field3, #description_field1')
                                .val('');
                        } else {
                            $('#increment_salary_value').hide();
                            $('#salary-supervisor').html('').hide();
                            $('#extend-supervisor').html('').hide();
                        }

                        // Uncheck checkbox-rect1 when checkbox-rect2 is checked
                        $('#checkbox-rect1-supervisor, #checkbox-rect3-supervisor, #checkbox-rect4-supervisor')
                            .prop('checked',
                                false);
                    });
                    $('#checkbox-rect3-supervisor').on('click', function() {
                        $('#salary-supervisor').hide();
                        $('#increment_salary_value').hide();
                        if ($(this).prop('checked')) {
                            $('#extend-supervisor').html(`
                        <select id="enxtend_month_supervisor" name="enxtend_month_supervisor" class="form-control" placeholder="Select an option">
                            <option value="1"> One Month</option>
                            <option value="2">Two Month</option>
                            <option value="3">Three Month</option>
                        </select>`).fadeIn();
                            $(' #increment_without_salary_supervisor,#increment_without_salary_supervisor,#increment_salary_value, #output_field1, #output_field2, #output_field3, #description_field1')
                                .val('');
                        } else {
                            $('#extend-supervisor').html('').hide();
                            $('#increment_salary_value').hide();
                        }

                        // Uncheck checkbox-rect2 when checkbox-rect3 is checked
                        $('#checkbox-rect1-supervisor, #checkbox-rect2-supervisor, #checkbox-rect4-supervisor')
                            .prop(
                                'checked',
                                false);
                    });

                    $('#checkbox-rect4-supervisor').on('click', function() {
                        // Retrieve the value from the `#question_1` element
                        const question1Value = $('#question_1').val();
                        const question2Value = $('#question_2').val();
                        const question3Value = $('#question_3').val();
                        const description1 = $('#description1').val();
                        // Set the `value` attribute of the `#output_field` element to the retrieved value
                        $('#output_field1').val(question1Value);
                        $('#output_field2').val(question2Value);
                        $('#output_field3').val(question3Value);
                        $('#description_field1').val(description1);
                        $('#third-modal').modal('show');
                        $('#ajaxModelEditDepSup').html("Update Designation");
                        $('#extend-supervisor').hide();
                        $('#salary-supervisor').hide();
                        $('#increment_salary_value').hide();
                        if ($(this).prop('checked')) {
                            $('#enxtend_month_supervisor, #increment_salary_supervisor, #increment_without_salary_supervisor, #increment_without_salary_supervisor,#increment_salary_value')
                                .val('');
                        } else {
                            $('#increment_salary_value').hide();
                            $('#salary-supervisor').html('').hide();
                            $('#extend-supervisor').html('').hide();
                        }

                        // Uncheck checkbox-rect1 when checkbox-rect2 is checked
                        $('#checkbox-rect1-supervisor, #checkbox-rect2-supervisor, #checkbox-rect3-supervisor')
                            .prop('checked',
                                false);
                    });

                    // Function to check if any checkbox is checked
                    function anyCheckboxChecked() {
                        return $('#checkbox-rect1-supervisor').is(':checked') || $(
                                '#checkbox-rect2-supervisor')
                            .is(':checked') || $('#checkbox-rect3-supervisor').is(':checked') ||
                            $(
                                '#checkbox-rect4-supervisor').is(':checked');
                    }

                    // Update Submit button state based on checkbox changes
                    $('input[type="checkbox"]').change(function() {
                        if (anyCheckboxChecked()) {
                            $('#submit').prop('disabled', false);
                        } else {
                            $('#submit').prop('disabled', true);
                        }
                    });

                    // Disable Submit button on page load
                    $('#submit').prop('disabled', true);


                    const dropdown1 = $("#new_department_id_sup");
                    const dropdown2 = $("#designation_id_sup");
                    const submitButton = $("#submit-sup");

                    function checkInputs() {
                        if (dropdown1.val() && dropdown2.val()) {
                            submitButton.prop("disabled", false);
                        } else {
                            submitButton.prop("disabled", true);
                        }
                    }
                    dropdown1.change(checkInputs);
                    dropdown2.change(checkInputs);
                },
                error: function(error) {
                    // Handle the error response
                }
            });

        }

        // For Supervisor
        $('#new_department_id_sup').on('change', function() {
            var departmentID = $(this).val();
            if (departmentID) {
                $.ajax({
                    url: '/designation/' + departmentID,
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data) {
                            $('#designation_id_sup').empty();
                            $('#designation_id_sup').append(
                                '<option hidden>Choose Designation</option>'
                            );
                            $.each(data, function(key,
                                designations) {
                                console.log(data);
                                $('select[name="new_designation_sup"]')
                                    .append(
                                        '<option value="' +
                                        designations
                                        .id + '">' +
                                        designations
                                        .designation_name +
                                        '</option>'
                                    );
                            });
                        } else {
                            $('#designations').empty();
                        }
                    }
                });
            } else {
                $('#designations').empty();
            }
        });

        $('#designation_id_sup').on('click', function() {
            if ($(this).val()) {
                $('#gross_salary_sup').html(
                    `<label>New Gross Salary </label> <input class="form-control" id="new_gross_salary" type="text" name="new_gross_salary" placeholder="New Gross Salary" />`
                ).fadeIn();
            } else {
                $('#gross_salary_sup').html('').hide();
            }
        });


        $(document).ready(function() {
            //For Preview
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.view').on('click', function() {
                var id = $(this).data('id');
                $.ajax({
                    type: "POST",
                    url: 'review-show',
                    data: {
                        id: id
                    },
                    dataType: 'json',

                    success: function(res) {
                        console.log(res);
                        $('#ajaxModelView').html("View");
                        $('#view-modal').modal('show');
                        $('#id').val(res.id);
                        $('#question_1_view').text(res.preview.question_1);
                        $('#question_2_view').text(res.preview.question_2);
                        $('#question_3_view').text(res.preview.question_3);
                        $('#description_view').val(res.preview.description);
                        $('#pro_old_salary').val(res.preview.pro_old_salary);
                        if (res.preview.without_salary_admin == 'yes') {
                            $('#pro_incre_salary').html(`<label for=""></label>
        <input class="form-control" type="text" name="" id="" value="Pronation Without Salary" readonly>`);
                        } else if (res.preview.pro_incre_salary) {
                            $('#pro_incre_salary').html(`<label for="">Increment Amount</label>
        <input class="form-control" type="text" name="" id="" value="${res.preview.pro_incre_salary}/-" readonly>`);
                        } else if (res.preview.termination_status == 1) {
                            $('#pro_incre_salary').html(`<label for=""></label>
        <input class="form-control" type="text" name="" id="" value="Terminate" readonly>`);
                        } else if (res.preview.pro_month_admin) {
                            $('#pro_incre_salary').html(`<label for="">Extend Month</label>
        <input class="form-control" type="text" name="" id="" value="${res.preview.pro_month_admin}" readonly>`);
                        } else if (res.preview.employee_previous_designation_admin) {
                            // Check if new_gross_salary exists in res.preview
                            const newGrossSalary = res.preview.pro_incre_salary_admin ? res
                                .preview
                                .pro_incre_salary_admin : '';

                            // Use newGrossSalary to conditionally show different content
                            const content = newGrossSalary ?
                                `From <strong> "${res.preview.rec_department.department_name}" </strong> Proposed To <strong>"${res.preview.rec_designation_admin.designation_name}" </strong> of <strong>"${res.preview.rec_department_admin.department_name}"</strong>, with new gross salary of <strong>"${newGrossSalary}/-"</strong>` :
                                `From <strong>"${res.preview.rec_department.department_name}"</strong> Proposed To <strong>"${res.preview.rec_designation_admin.designation_name}"</strong> of <strong>"${res.preview.rec_department_admin.department_name}"</strong> with out salary.`;
                            $('#pro_incre_salary').html(`<p>${content}</p>`);
                        }

                    }
                });
            });

            //For Edit
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.edit').on('click', function() {
                var id = $(this).data('id');
                console.log(id);
                $.ajax({
                    type: "POST",
                    url: 'review-show',
                    data: {
                        id: id
                    },
                    dataType: 'json',

                    success: function(res) {
                        console.log(res.preview.pro_expi_date);
                        // ######### expire date to next month first date find out start ########
                        // Your initial date in the format "YYYY-MM-DD"
                        var inputDate = res.preview.pro_expi_date;

                        // Create a JavaScript Date object from the input date
                        var dateObj = new Date(inputDate);

                        // Calculate the first day of the next month
                        dateObj.setMonth(dateObj.getMonth() + 1, 1);

                        // Convert the result to the "YYYY-MM-DD" format
                        var next_month_of_exp_date = dateObj.toISOString().slice(0, 10);

                        console.log("First day of next month:", next_month_of_exp_date);
                        // ######### expire date to next month first date find out end ########

                        //    #############     curent date find out   start ########
                        // Get the current date
                        var currentDate = new Date();

                        // Extract the year, month, and day components
                        var year = currentDate.getFullYear();
                        var month = String(currentDate.getMonth() + 1).padStart(2,
                            "0"); // Months are zero-indexed
                        var day = String(currentDate.getDate()).padStart(2, "0");

                        // Create the formatted date string
                        var Today = year + "-" + month + "-" + day;

                        console.log("Formatted date:", Today);
                        //    #############     curent date find out   end ########

                        // Convert next_month_of_exp_date to a Date object
                        var next_month_of_exp_date = new Date(next_month_of_exp_date);

                        // Convert Today to a Date object
                        var TodayObj = new Date(Today);


                        // var inputDate1 = "2023-09-24";

                        /// Get the first date of the month
                        var firstDate = new Date(inputDate);
                        firstDate.setDate(1);

                        // Get the last date of the month
                        var lastDate = new Date(firstDate.getFullYear(), firstDate.getMonth() +
                            1, 0);
                        lastDate.setDate(lastDate.getDate() + 1); // Add one day

                        // Format the dates as strings (YYYY-MM-DD)
                        var firstDateString = firstDate.toISOString().split('T')[0];
                        var lastDateString = lastDate.toISOString().split('T')[0];

                        console.log("First Date:", firstDateString);
                        console.log("Last Date:", lastDateString);


                        if (next_month_of_exp_date <= TodayObj) {
                            $('#ajaxModelEdit').html('Edit ' + '( '+  res.user_department.first_name + ' Probation )');
                            $('#edit-modal').modal('show');
                        } else {
                            $('#ajaxModlNotApplicable').html("Not Applicable");
                            $('#not-allowed-modal').modal('show');
                            $('#emp_name').html(res.user_department.first_name);
                            $('#available_date').html(next_month_of_exp_date.toISOString()
                                .slice(0, 10));
                        }
                        $('#edit_id').val(res.preview.id);
                        $('#pro_emp_id').val(res.preview.pro_emp_id);
                        $('#edit_question_1').val(res.preview.question_1);
                        $('#edit_question_2').val(res.preview.question_2);
                        $('#edit_question_3').val(res.preview.question_3);
                        $('#edit_description').val(res.preview.description);
                        $('#edit_pro_old_salary').val(res.preview.pro_old_salary);


                        $('#att_name').html('Check whether ' + res.user_department.first_name +
                            ' has Attendance from ' +'<i>' +firstDateString + '</i>'+ ' to ' + '<i>' + lastDateString + '</i>');

                        // Get the date string from res.preview.pro_expi_date
                        var dateString = res.preview.pro_expi_date;

                        // Parse the date string into a JavaScript Date object
                        var originalDate = new Date(dateString);

                        // Add one day to the date
                        originalDate.setDate(originalDate.getDate() + 1);

                        // Format the new date as a string in the desired format (e.g., "yyyy-mm-dd")
                        var newDate = originalDate.toISOString().split('T')[0];

                        // Set the value of the 'accept_date' input field to the new date
                        $('#accept_date').val(newDate);

                        if (res.preview.increment_salary_supervisor) {
                            $('#edit_pro_incre_salary').html(
                                `
                            <label for="">Increment  Salary (${res.preview.increment_salary_supervisor} )</label>
                             <input class="form-control" type="text" name="" id="" value="Proposed Salary ${res.preview.pro_incre_salary}/-" readonly>`
                            );
                        } else if (res.preview.check2supervisor == 'yes') {
                            $('#edit_pro_incre_salary').html(
                                `
                            <label for="">Terminate</label>
                             <input class="form-control" type="text" name="" id="" value="${res.preview.check2supervisor}" readonly>`
                            );
                        } else if (res.preview.check4supervisor == 'yes') {
                            $('#edit_pro_incre_salary').html(
                                `
                             <label for="edit_pro_incre_salary">Promated</label>
                            <input class="form-control" type="text" name="" id="" value="${res.preview.check4supervisor}" readonly>`
                            );
                        } else if (res.preview.without_salary_supervisor == 'yes') {
                            $('#edit_pro_incre_salary').html(
                                `
                                <label for="">Probation Without Salary</label>
                             <input class="form-control" type="text" name="" id="" value="Probation Without Salary" readonly>`
                            );
                        } else if (res.preview.enxtend_month_supervisor) {
                            $('#edit_pro_incre_salary').html(
                                `
                             <label for="">Extend</label>
                             <input class="form-control" type="text" name="" id="" value="${res.preview.enxtend_month_supervisor} Month(s)" readonly>`
                            );
                        } else if (res.preview.employee_previous_designation_pro_emp_id_sup) {
                            // Check if new_gross_salary exists in res.preview
                            const newGrossSalary = res.preview.new_gross_salary ? res.preview
                                .new_gross_salary : '';

                            // Use newGrossSalary to conditionally show different content
                            const content = newGrossSalary ?
                                `From <strong> "${res.preview.rec_department.department_name}" </strong> Proposed To <strong>"${res.preview.rec_designation_new.designation_name}" </strong> of <strong>"${res.preview.rec_department_new.department_name}"</strong>, with new gross salary of <strong>"${newGrossSalary}/-"</strong>` :
                                `From <strong>"${res.preview.rec_department.department_name}"</strong> Proposed To <strong>"${res.preview.rec_designation_new.designation_name}"</strong> of <strong>"${res.preview.rec_department_new.department_name}"</strong> with out salary.`;
                            $('#edit_pro_incre_salary').html(`<p>${content}</p>`);
                        }
                        $('#employee_previous_designation').val(res.user_department
                            .userdepartment.department_name);
                        $('#employee_previous_department_id').val(res.user_department
                            .userdepartment.id);
                        $('#employee_previous_designation_id').val(res.user_department
                            .userdesignation.id);
                        $('#employee_previous_designation_edit_id').val(res.preview.id);
                        $('#employee_previous_designation_pro_emp_id').val(res.preview
                            .pro_emp_id);
                        $('#employee_previous_salary').val(res.preview
                            .pro_old_salary);
                        // Uncheck all checkboxes on page load
                        // $('input[type="checkbox"]').prop("checked", false);
                        $('#checkbox-rect1-admin').on('click', function() {
                            $('#extend-admin').hide();
                            $('#increment_salary_value_admin').hide();
                            if ($(this).prop('checked')) {
                                $('#salary-admin').html(
                                    '<div class="row mt-3"><div class="col-md-6"><input id="increment_without_salary_admin" name="increment_without_salary_admin" class="" value="yes" type="checkbox"/><label for="increment_without_salary_admin">Without Salary</label> </div> <div class="col-md-6"><input id="increment_salary_admin" name="increment_salary_admin" class="checkbox-rect" type="checkbox" value="yes"/><label for="increment_salary_admin">With Salary</label></div></div>'
                                ).fadeIn();
                                $('#enxtend_month_admin #output_field1_admin, #output_field2_admin, #output_field3_admin, #description_field1_admin,#template_field1_admin')
                                    .val('');
                            } else {
                                $('#salary-admin').html('').hide();
                            }

                            // Uncheck checkbox-rect2 when checkbox-rect1 is checked
                            $('#checkbox-rect2-admin, #checkbox-rect3-admin, #checkbox-rect4-admin')
                                .prop('checked',
                                    false);
                            $('#increment_without_salary_admin').on('change',
                                function() {
                                    $('#increment_salary_value_admin').val('');
                                    $('#increment_salary_value_admin').hide();
                                    $('#submit').prop('disabled', !
                                        anyCheckboxChecked());
                                    $('#increment_salary_admin').prop('checked', !$(
                                        this).is(':checked'));
                                });

                            $('#increment_salary_admin').on('change', function() {
                                $('#increment_without_salary_admin').val('');
                                $('#increment_without_salary_admin').prop(
                                    'checked', !$(this).is(
                                        ':checked'));
                            });
                            $('#increment_without_salary_admin, #increment_salary_admin, #checkbox-rect1-admin')
                                .on('change', function() {
                                    $('#submit-admin').prop('disabled', !
                                        anyCheckboxChecked());
                                });

                            function anyCheckboxChecked() {
                                return $('#checkbox-rect1-admin').is(':checked') && ($(
                                    '#increment_without_salary_admin').is(
                                    ':checked') || $(
                                    '#increment_salary_admin').is(':checked'));
                            }
                            $('#increment_salary_admin').on('change', function() {
                                if ($(this).prop('checked')) {
                                    $('#increment_salary_for_admin').html(
                                        '<input id="increment_salary_value_admin" class="form-control mt-3" name="increment_salary_value_admin" type="text"  placeholder="Enter amount"/>'
                                    ).fadeIn();
                                } else {
                                    $('#increment_salary_admin').hide();
                                    $('#increment_salary_admin').fadeOut();
                                }
                            });
                        });


                        $('#checkbox-rect2-admin').on('click', function() {
                            $('#extend-admin').hide();
                            $('#salary-admin').hide();
                            $('#increment_salary_value_admin').hide();
                            $('#increment_salary_value').hide();
                            if ($(this).prop('checked')) {
                                $('#enxtend_month_admin, #increment_salary_admin, #increment_without_salary_admin, #increment_without_salary_admin,#increment_salary_value_admin#output_field1_admin, #output_field2_admin, #output_field3_admin, #description_field1_admin,#template_field1_admin')
                                    .val('');
                            } else {
                                $('#increment_salary_value_admin').hide();
                                $('#salary-admin').html('').hide();
                                $('#extend-admin').html('').hide();
                            }

                            // Uncheck checkbox-rect1 when checkbox-rect2 is checked
                            $('#checkbox-rect1-admin, #checkbox-rect3-admin, #checkbox-rect4-admin')
                                .prop('checked',
                                    false);
                        });
                        $('#checkbox-rect3-admin').on('click', function() {
                            $('#salary-admin').hide();
                            $('#increment_salary_value_admin').hide();
                            if ($(this).prop('checked')) {
                                $('#extend-admin').html(`
                        <select id="enxtend_month_admin" name="enxtend_month_admin" class="form-control" placeholder="Select an option">
                            <option value="1"> One Month</option>
                            <option value="2">Two Month</option>
                            <option value="3">Three Month</option>
                        </select>`).fadeIn();
                                $(' #increment_without_salary_admin,#increment_without_salary_admin,#increment_salary_value_admin, #output_field1_admin, #output_field2_admin, #output_field3_admin, #description_field1_admin')
                                    .val('');
                            } else {
                                $('#extend-admin').html('').hide();
                                $('#increment_salary_value_admin').hide();
                            }

                            // Uncheck checkbox-rect2 when checkbox-rect3 is checked
                            $('#checkbox-rect1-admin, #checkbox-rect2-admin, #checkbox-rect4-admin')
                                .prop(
                                    'checked',
                                    false);
                        });

                        $('#checkbox-rect4-admin').on('click', function() {
                            // Retrieve the value from the `#question_1` element
                            const question1ValueAdmin = $('#edit_question_1').val();
                            const question2ValueAdmin = $('#edit_question_2').val();
                            const question3ValueAdmin = $('#edit_question_3').val();
                            const description1Admin = $('#edit_description').val();
                            const template1Admin = $('#template_id').val();
                            // Set the `value` attribute of the `#output_field` element to the retrieved value
                            $('#output_field1_admin').val(question1ValueAdmin);
                            $('#output_field2_admin').val(question2ValueAdmin);
                            $('#output_field3_admin').val(question3ValueAdmin);
                            $('#description_field1_admin').val(description1Admin);
                            $('#template_field1_admin').val(template1Admin);

                            $('#second-modal').modal('show');
                            $('#ajaxModelEditDep').html("Update Designation");
                            $('#extend-admin').hide();
                            $('#salary-admin').hide();
                            $('#increment_salary_value_admin').hide();
                            $('#increment_salary_value').hide();
                            if ($(this).prop('checked')) {
                                $('#enxtend_month_admin, #increment_salary_admin, #increment_without_salary_admin, #increment_without_salary_admin,#increment_salary_value_admin')
                                    .val('');
                            } else {
                                $('#increment_salary_value').hide();
                                $('#salary-admin').html('').hide();
                                $('#extend-admin').html('').hide();
                            }

                            // Uncheck checkbox-rect1 when checkbox-rect2 is checked
                            $('#checkbox-rect1-admin, #checkbox-rect2-admin, #checkbox-rect3-admin')
                                .prop('checked',
                                    false);
                        });



                        // Function to check if any checkbox is checked
                        function anyCheckboxChecked() {
                            return $('#checkbox-rect1-admin').is(':checked') || $(
                                    '#checkbox-rect2-admin')
                                .is(':checked') || $('#checkbox-rect3-admin').is(':checked') ||
                                $(
                                    '#checkbox-rect4-admin').is(':checked');
                        }

                        // Update Submit button state based on checkbox changes
                        $('input[type="checkbox"]').change(function() {
                            if (anyCheckboxChecked()) {
                                $('#submit-admin').prop('disabled', false);
                            } else {
                                $('#submit-admin').prop('disabled', true);
                            }
                        });

                        // Disable Submit button on page load
                        $('#submit-admin').prop('disabled', true);


                        const dropdown1 = $("#new_department_id");
                        const dropdown2 = $("#designation_id");
                        const submitButton = $("#submit-change");

                        function checkInputs() {
                            if (dropdown1.val() && dropdown2.val()) {
                                submitButton.prop("disabled", false);
                            } else {
                                submitButton.prop("disabled", true);
                            }
                        }
                        dropdown1.change(checkInputs);
                        dropdown2.change(checkInputs);

                        // For Admin
                        $('#new_department_id').on('change', function() {
                            var departmentID = $(this).val();
                            if (departmentID) {
                                $.ajax({
                                    url: '/get-designation/' + departmentID,
                                    type: "GET",
                                    data: {
                                        "_token": "{{ csrf_token() }}"
                                    },
                                    dataType: "json",
                                    success: function(data) {
                                        if (data) {
                                            $('#designation_id').empty();
                                            $('#designation_id').append(
                                                '<option hidden>Choose Designation</option>'
                                            );
                                            $.each(data, function(key,
                                                designations) {
                                                $('select[name="new_designation"]')
                                                    .append(
                                                        '<option value="' +
                                                        designations
                                                        .id + '">' +
                                                        designations
                                                        .designation_name +
                                                        '</option>'
                                                    );
                                            });
                                        } else {
                                            $('#designations').empty();
                                        }
                                    }
                                });
                            } else {
                                $('#designations').empty();
                            }
                        });

                        $('#designation_id').on('click', function() {
                            if ($(this).val()) {
                                $('#gross_salary').html(
                                    `
                       <label>New Gross Salary </label> <input class="form-control" id="new_gross_salary" type="text" name="new_gross_salary" placeholder="New Gross Salary" />`
                                ).fadeIn();
                            } else {
                                $('#gross_salary').html('').hide();
                            }
                        });
                    }
                });
            });

            //For Approve
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
            $(document).ready(function() {
                $('.toggle-form').click(function() {
                    if ($('#form-container').is(':visible')) {
                        $('#form-container').slideUp();
                        var buttonIcon = '<i class="fa fa-plus"></i>';
                    } else {
                        $('#form-container').slideDown();
                        var buttonIcon = '<i class="fa fa-minus"></i>';
                    }
                    $(this).html(buttonIcon);
                });
            });
        });
    </script>
@endsection
