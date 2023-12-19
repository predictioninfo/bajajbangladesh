@extends('back-end.premium.layout.premium-main')
@section('content')

<section class="main-contant-section">
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
                <h1 class="card-title text-center"> {{ __('Resignation List') }} </h1>
                <ol id="breadcrumb1">
                    <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                    @if ($add_permission == 'Yes')
                    <li><a href="#" type="button" data-toggle="modal" data-target="#addModal"><span
                                class="icon icon-plus"> </span>Add</a></li>
                    @endif
                    <li><a href="#">List - Resignation </a></li>
                </ol>
            </div>
        </div>



        {{-- <div class="d-flex flex-row">

            @if ($delete_permission == 'Yes')
            <div class="p-2">
                <form method="post" action="{{ route('bulk-delete-resignations') }}" id="sample_form"
                    class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="bulk_delete_com_id" value="{{ Auth::user()->com_id }}"
                        class="form-check-input">
                    <input type="submit" class="btn btn-danger w-100" value="{{ __('Bulk Delete') }}" />
                </form>
            </div>
            @endif
        </div> --}}

    </div>


    <!-- Add Modal Starts -->

    <div id="addModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header" style="background-color:#61c597;">
                    <h5 id="exampleModalLabel" class="modal-title">{{ _('Add Resignation') }}</h5>
                    <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i
                            class="dripicons-cross"></i></button>
                </div>

                <div class="modal-body">
                    <form method="post" action="{{ route('add-resignations') }}" class="form-horizontal" id="form"
                        enctype="multipart/form-data" onsubmit="return validateForm()">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label>Department</label>
                                <select class="form-control" name="resignation_department_id"
                                    id="resignation_department_id" required>
                                    <option value="">Select-a-Department</option>
                                    @foreach ($departments as $departments_value)
                                    <option value="{{ $departments_value->id }}">
                                        {{ $departments_value->department_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label class="text-bold">{{ __('Designation') }} <span
                                        class="text-danger">*</span></label>
                                <select class="form-control" name="designation_id" id="designation_id" required>
                                    <option value="">Choose Designation</option>
                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label class="text-bold">{{ __('Employee') }} <span class="text-danger">*</span></label>
                                <select class="form-control selectpicker" name="resignation_employee_id"
                                    id="resignation_employee_id" data-live-search="true" data-live-search-style="begins"
                                    data-dependent="resignation_employee_id"
                                    title="{{ __('Selecting Employee Name') }}..." required>
                                    <option value="">Choose an Employee</option>
                                </select>
                            </div>
                            <div class="col-md-1 form-group">
                            </div>
                            <div class="col-md-2 form-group">
                                <input type="checkbox" class="form-check-input" name="work_pressure_or_office_time"
                                    value="1">
                                <label><strong>Work Pressure/ Office Time</strong></label>
                            </div>
                            <div class="col-md-2 form-group">
                                <input type="checkbox" class="form-check-input" name="rude_behaviours_by_supervisor"
                                    value="1">
                                <label><strong>Rude Behaviours by Supervisor
                                    </strong></label>
                            </div>
                            <div class="col-md-2 form-group">
                                <input type="checkbox" class="form-check-input" name="better_oppurtunity" value="1">
                                <label><strong>Better Opportunity
                                    </strong></label>
                            </div>
                            <div class="col-md-2 form-group">
                                <input type="checkbox" class="form-check-input" name="doing_bussiness_or_others_mention"
                                    value="1">
                                <label><strong>Doing business/ Others (Mention)
                                    </strong></label>
                            </div>
                            <div class="col-md-2 form-group">
                                <input type="checkbox" class="form-check-input" name="absent" value="1">
                                <label><strong>Absent
                                    </strong></label>
                            </div>
                            <div class="col-md-1 form-group">
                                <input type="checkbox" class="form-check-input" name="other" id="other" value="1">
                                <label><strong>Specific Reason
                                    </strong></label>
                                <span id="orthers_reason"></span>
                            </div>
                            <div class="col-md-12 text-center">
                                <span id="error-message" style="display:none; color:red; font-style: italic;"></span>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Notice Date</label>
                                <input type="date" name="resignation_notice_date" class="form-control date" value="">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Resignation Date</label>
                                <input type="date" name="resignation_date" class="form-control date" value="">
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="my-textarea">Description</label>
                                <textarea class="form-control" name="resignation_desc" rows="3"></textarea>
                            </div>
                            <br>

                            <div class="col-sm-12">

                                <input type="submit" name="action_button" class="btn btn-primary btn-block"
                                    value="{{ __('Add') }}" />

                            </div>
                        </div>

                    </form>
                </div>

            </div>

        </div>
    </div>

    <!-- Add Modal Ends -->

    <div class="content-box">

        <div class="table-responsive">
            <table id="user-table" class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>{{ __('SL') }}</th>
                        <th>{{ __('Department') }}</th>
                        <th>{{ __('Designation') }}</th>
                        <th>{{ __('Employee') }}</th>
                        <th>{{ __('Work Pressure/ Office Time') }}</th>
                        <th>{{ __('Rude Behaviours by Supervisor') }}</th>
                        <th>{{ __('Better Opportunity') }}</th>
                        <th>{{ __('Doing business/ Others (Mention)') }}</th>
                        <th>{{ __('Absent') }}</th>
                        <th>{{ __('Specific Reason') }}</th>
                        <th>{{ __('Notice Date') }}</th>
                        <th>{{ __('Resignation Date') }}</th>
                        <th>{{ __('Description') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th>{{ __('Download Resignation Letter') }}</th>
                        <th>{{ __('Download Resignation Acceptance Letter') }}</th>
                        @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                        <th>{{ __('Action') }}</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @php($i = 1)
                    @foreach ($resignations as $resignations_value)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $resignations_value->department_name }}</td>
                        <td>{{ $resignations_value->designation_name }}</td>
                        <td>{{ $resignations_value->first_name . ' ' . $resignations_value->last_name }}</td>
                        <td>{{ $resignations_value->work_pressure_or_office_time ?? '' }}</td>
                        <td>{{ $resignations_value->rude_behaviours_by_supervisor ?? '' }}</td>
                        <td>{{ $resignations_value->better_oppurtunity ?? '' }}</td>
                        <td>{{ $resignations_value->doing_bussiness_or_others_mention ?? '' }}</td>
                        <td>{{ $resignations_value->absent ?? '' }}</td>
                        <td>
                            @if ($resignations_value->other)
                            {{ $resignations_value->showthis ?? '' }}
                            @endif
                        </td>
                        <td>{{ $resignations_value->resignation_notice_date }}</td>
                        <td>{{ $resignations_value->resignation_date }}</td>
                        <td>{!! $resignations_value->resignation_desc !!}</td>
                        <td>
                            @if ($resignations_value->status == 0)
                            {{ 'Pending' }}
                            @else
                            {{ 'Approved' }}
                            @endif

                        </td>

                        <td>
                            <form method="post"
                                action="{{route('resignation-letter-downloads',['id'=>$resignations_value->id])}}">
                                @csrf
                                <input type="hidden" name="id" value="{{$resignations_value->id}}">
                                <button type="submit">{{__('Download')}}</button>
                            </form>
                        </td>
                        <td>
                            @if ($resignations_value->status == 1)
                            <form method="post"
                                action="{{route('resignation-acception-letter-downloads',['id'=>$resignations_value->resignation_letter_acceptance_id])}}">
                                @csrf
                                <input type="hidden" name="id" value="{{$resignations_value->id}}">
                                <button type="submit">{{__('Download')}}</button>
                            </form>
                            @endif
                        </td>
                        <td>
                            @if ($resignations_value->status == 0)
                            @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                            @if ($resignations_value->status == 0)
                            <a href="#" id="edit-post" class="btn btn-info" data-toggle="modal"
                                data-target="#approveModal{{ $resignations_value->id }}" title=""
                                data-original-title=" Approve "><i class="fa fa-check"></i></a>
                            @endif

                            @if ($edit_permission == 'Yes')
                            <a href="javascript:void(0)" class="btn btn-primary edit"
                                data-id="{{ $resignations_value->id }}" data-toggle="tooltip" title=""
                                data-original-title=" Edit "><i class="fa fa-edit"></i></a>
                            @endif
                            @if ($delete_permission == 'Yes')
                            <a href="{{ route('delete-resignations', ['id' => $resignations_value->id]) }}"
                                class="btn btn-danger delete-post" data-toggle="tooltip" title=""
                                data-original-title=" Delete "><i class="fa fa-trash"></i></a>
                            @endif
                            @endif
                            @endif
                        </td>
                    </tr>
                    <div id="approveModal{{ $resignations_value->id }}" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 id="exampleModalLabel" class="modal-title">{{ _('Resignation Approve') }}
                                    </h5>
                                    <button type="button" data-dismiss="modal" id="close" aria-label="Close"
                                        class="close"><i class="dripicons-cross"></i></button>
                                </div>

                                <div class="modal-body">
                                    <form method="post"
                                        action="{{ route('approve-resignations', ['id' => $resignations_value->id]) }}"
                                        class="form-horizontal" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="" class="text-bold">Replace Employee Name:</label>
                                                <select name="replace_employee_id" id="replace_employee_id"
                                                    class="form-control  region" data-live-search="true"
                                                    data-live-search-style="begins" data-dependent="area_name"
                                                    title="{{ __('Selecting Employee Name') }}...">
                                                    <option value="">Select Replace Employee</option>
                                                    @foreach ($active_users as $active_user)
                                                    <option value="{{ $active_user->id }}">
                                                        {{ $active_user->first_name }}
                                                        {{ $active_user->last_name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-6 form-group">
                                                <label for="" class="text-bold">Resignation Acceptance Letter
                                                    Format:</label>
                                                <select name="resignation_letter_acceptance_id"
                                                    class="form-control  region" data-live-search="true"
                                                    data-live-search-style="begins" data-dependent="area_name"
                                                    title="{{ __('Selecting Employee Name') }}..." required>
                                                    <option value="">Select Resignation Acceptance Letter
                                                        Format</option>
                                                    @foreach ($resignation_letters as $resignation_letter)
                                                    <option value="{{ $resignation_letter->id }}">
                                                        {{ $resignation_letter->resignation_letter_subject }}

                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-sm-12 mt-4">

                                                <input type="submit" name="action_button"
                                                    class="btn btn-primary btn-block" value="{{ __('Approve') }}" />

                                            </div>
                                        </div>

                                    </form>
                                </div>

                            </div>

                        </div>
                    </div>
                    @endforeach


                </tbody>

            </table>
        </div>
    </div>
</section>




<!-- edit boostrap model -->
<div class="modal fade" id="edit-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="ajaxModelTitle"></h4>
            </div>
            <div class="modal-body">
                <form method="post" id="edit_form" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label>Department</label>
                            <select class="form-control" name="edit_resignation_department_id"
                                id="edit_resignation_department_id" required>
                                <option value="">Select-a-Department</option>
                                @foreach ($departments as $departments_value)
                                <option value="{{ $departments_value->id }}">
                                    {{ $departments_value->department_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 form-group">
                            <label class="text-bold">{{ __('Designation') }} <span class="text-danger">*</span></label>
                            <select class="form-control" name="edit_designation_id" id="edit_designation_id" required>
                                <option value="">Choose Designation</option>
                            </select>
                        </div>
                        <div class="col-md-4 form-group">
                            <label class="text-bold">{{ __('Employee') }} <span class="text-danger">*</span></label>
                            <select class="form-control" name="edit_employee_id" id="edit_employee_id"></select>
                        </div>
                        <div class="col-md-1 form-group">
                        </div>
                        <div class="col-md-2 form-group">
                            <input type="checkbox" class="form-check-input" name="work_pressure_or_office_time"
                                id="work_pressure_or_office_time" value="1">
                            <label><strong>Work Pressure/ Office Time</strong></label>
                        </div>
                        <div class="col-md-2 form-group">
                            <input type="checkbox" class="form-check-input" name="rude_behaviours_by_supervisor"
                                id="rude_behaviours_by_supervisor" value="1">
                            <label><strong>Rude Behaviours by Supervisor
                                </strong></label>
                        </div>
                        <div class="col-md-2 form-group">
                            <input type="checkbox" class="form-check-input" name="better_oppurtunity"
                                id="better_oppurtunity" value="1">
                            <label><strong>Better Opportunity
                                </strong></label>
                        </div>
                        <div class="col-md-2 form-group">
                            <input type="checkbox" class="form-check-input" name="doing_bussiness_or_others_mention"
                                id="doing_bussiness_or_others_mention" value="1">
                            <label><strong>Doing business/ Others (Mention)
                                </strong></label>
                        </div>
                        <div class="col-md-2 form-group">
                            <input type="checkbox" class="form-check-input" name="absent" id="absent" value="1">
                            <label><strong>Absent
                                </strong></label>
                        </div>
                        <div class="col-md-1 form-group">
                            <input type="checkbox" class="form-check-input" name="other" id="edit_other" value="1">
                            <label><strong>Specific Reason
                                </strong></label>
                            <input type="text" name="edit_specific_reason" id="edit_specific_reason">
                            <span id="edit_orthers_reason"></span>
                        </div>
                        <div class="col-md-12 text-center">
                            <span id="error-message" style="display:none; color:red; font-style: italic;"></span>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Notice Date</label>
                            <input type="date" name="resignation_notice_date" id="resignation_notice_date"
                                class="form-control" value="">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Resignation Date</label>
                            <input type="date" name="resignation_date" id="resignation_date" class="form-control"
                                value="">
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="my-textarea">Description</label>
                            <textarea class="form-control" name="resignation_desc" id="resignation_desc"
                                rows="3"></textarea>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
<!-- end bootstrap model -->



<script type="text/javascript">
    $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#user-table').DataTable({


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


            //value retriving and opening the edit modal starts

            $('.edit').on('click', function() {
                var id = $(this).data('id');
                var work_pressure_or_office_time = document.getElementById('work_pressure_or_office_time');
                var rude_behaviours_by_supervisor = document.getElementById(
                'rude_behaviours_by_supervisor');
                var better_oppurtunity = document.getElementById('better_oppurtunity');
                var doing_bussiness_or_others_mention = document.getElementById(
                    'doing_bussiness_or_others_mention');
                var absent = document.getElementById('absent');
                var edit_other = document.getElementById('edit_other');


                $.ajax({
                    type: "POST",
                    url: 'resignation-by-id',
                    data: {
                        id: id
                    },
                    dataType: 'json',

                    success: function(res) {
                        $('#ajaxModelTitle').html("Edit");
                        $('#edit-modal').modal('show');
                        $('#id').val(res.id);
                        $('#edit_resignation_department_id').val(res.resignation_department_id);
                        $('#edit_resignation_employee_id').val(res.resignation_employee_id);
                        if (res.work_pressure_or_office_time === 1) {
                            work_pressure_or_office_time.checked = true;
                        } else {
                            work_pressure_or_office_time.checked = false;
                        }
                        if (res.rude_behaviours_by_supervisor === 1) {
                            rude_behaviours_by_supervisor.checked = true;
                        } else {
                            rude_behaviours_by_supervisor.checked = false;
                        }
                        if (res.better_oppurtunity === 1) {
                            better_oppurtunity.checked = true;
                        } else {
                            better_oppurtunity.checked = false;
                        }
                        if (res.doing_bussiness_or_others_mention === 1) {
                            doing_bussiness_or_others_mention.checked = true;
                        } else {
                            doing_bussiness_or_others_mention.checked = false;
                        }
                        if (res.absent === 1) {
                            absent.checked = true;
                        } else {
                            absent.checked = false;
                        }
                        if (res.other === 1) {
                            edit_other.checked = true;
                            $('#edit_specific_reason').val(res.showthis);
                        } else {
                            edit_other.checked = false;
                            $('#edit_specific_reason').hide();
                        }


                        $('#resignation_notice_date').val(res.resignation_notice_date);
                        $('#resignation_date').val(res.resignation_date);
                        $('#resignation_desc').val(res.resignation_desc);
                    }
                });
            });

            //value retriving and opening the edit modal ends

            // edit form submission starts

            $('#edit_form').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                console.log(formData);
                $('#error-message').text('');

                $.ajax({
                    type: 'POST',
                    url: `/update-resignation`,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                    toastr.success(response.success, 'Data successfully updated!!');
                    window.location.reload(true);
                },
                error: function(response) {
                    toastr.error(response.error, 'Please Entry Valid Data!!');

                }
                });
            });

            // edit form submission ends


            $('#resignation_department_id').on('change', function() {
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
                                    '<option hidden value="">Choose Designation</option>');
                                $.each(data, function(key, designations) {
                                    $('select[name="designation_id"]').append(
                                        '<option value="' + designations.id + '">' +
                                        designations.designation_name + '</option>');
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

            $('#designation_id').on('change', function() {
                var departmentID = $(this).val();
                if (departmentID) {
                    $.ajax({
                        url: '/get-employee-for-resignation/' + departmentID,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#resignation_employee_id').empty();
                                $('#resignation_employee_id').append(
                                    '<option hidden value="" >Choose an Employee</option>');
                                $.each(data, function(key, employees) {
                                    $('select[name="resignation_employee_id"]').append(
                                        '<option value="' + employees.id + '">' +
                                        employees.company_assigned_id + ' ' +
                                        employees.first_name + ' ' + employees
                                        .last_name + '</option>');
                                    $(".selectpicker").selectpicker('refresh');
                                });
                            } else {
                                $('#employees').empty();
                            }
                        }
                    });
                } else {
                    $('#employees').empty();
                }
            });
            $(function() {
                $('#orthers_reason').hide();

                //show it when the checkbox is clicked
                $('#other').on('click', function() {
                    if ($(this).prop('checked')) {
                        $('#orthers_reason').html(`<input id="showthis" name="showthis" type="text" value=""
                                        placeholder="Type Here" required  />`).fadeIn();
                    } else {
                        $('#orthers_reason').html(``).hide();
                    }
                });
            });
            $(function() {
                $('#edit_orthers_reason').hide();

                //show it when the checkbox is clicked
                $('#edit_other').on('click', function() {
                    if ($(this).prop('checked')) {
                        $('#edit_orthers_reason').html(`<input id="showthis" name="showthis" type="text" value=""
                                        placeholder="Type Here" required  />`).fadeIn();
                    } else {
                        $('#edit_orthers_reason').hide();
                        $('#edit_specific_reason').html(``).hide();
                    }
                });
            });
            $('#form').submit(function(event) {
                if ($('input[type="checkbox"]:checked').length === 0) {
                    // No checkbox is checked
                    event.preventDefault(); // Prevent the form from submitting
                    $('#error-message').text('Please select at least one checkbox.').show();

                } else {
                    $('#error-message').hide();
                }
            });

            $('#edit_resignation_department_id').on('change', function() {
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
                                $('#edit_designation_id').empty();
                                $('#edit_designation_id').append(
                                    '<option hidden value="">Choose Designation</option>');
                                $.each(data, function(key, designations) {
                                    $('select[name="edit_designation_id"]').append(
                                        '<option value="' + designations.id + '">' +
                                        designations.designation_name + '</option>');
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

            $('#edit_designation_id').on('change', function() {
                var departmentID = $(this).val();
                if (departmentID) {
                    $.ajax({
                        url: '/get-employee-for-resignation/' + departmentID,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#edit_employee_id').empty();
                                $('#edit_employee_id').append(
                                    '<option hidden value="" >Choose an Employee</option>');
                                $.each(data, function(key, employees) {
                                    $('select[name="edit_employee_id"]').append(
                                        '<option value="' + employees.id + '">' +
                                        employees.company_assigned_id + ' ' +
                                        employees.first_name + ' ' + employees
                                        .last_name + '</option>');
                                    $(".selectpicker").selectpicker('refresh');
                                });
                            } else {
                                $('#employees').empty();
                            }
                        }
                    });
                } else {
                    $('#employees').empty();
                }
            });

        });
</script>
@endsection