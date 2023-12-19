@extends('back-end.premium.layout.premium-main')
@section('content')
    <?php
    use App\Models\Permission;
    use App\Models\Attendance;
    use App\Models\Package;
    $employee_sub_module_one_add = '2.1.1';
    $employee_sub_module_one_edit = '2.1.2';
    $employee_sub_module_one_delete = '2.1.3';
    $finger_print_module = 20;
    //use DateTime;
    $date = new DateTime('now', new \DateTimeZone('Asia/Kolkata'));
    $current_date = $date->format('Y-m-d');
    //$current_time = $date->format('H:i:s');
    $user_sub_module_one_add = '1.1.1';
    $user_sub_module_one_edit = '1.1.2';
    $user_sub_module_one_delete = '1.1.3';
    $organization_sub_module_four = '5.4';
    $organization_sub_module_five = '5.5';
    $organization_sub_module_six = '5.6';
    $organization_sub_module_seven = '5.7';
    $organization_sub_module_eight = '5.8';
    $organization_sub_module_twelve = '5.12';
    $organization_sub_module_thirteen = '5.13';
    $organization_sub_module_fourteen = '5.14';
    $organization_sub_module_fifteen = '5.15';
    $organization_sub_module_sixteen = '5.16';
    $organization_sub_module_seventeen = '5.17';
    $organization_sub_module_eighteen = '5.18';
    $organization_sub_module_nineteen = '5.19';
    $organization_sub_module_twenty = '5.20';
    $organization_sub_module_twentyone = '5.21';
    ?>
    <?php
    foreach ($locations as $location) {
        $location1 = $location->location1 ?? 'Location1';
        $location2 = $location->location2 ?? 'Location2';
        $location3 = $location->location3 ?? 'Location3';
        $location4 = $location->location4 ?? 'Location4';
        $location5 = $location->location5 ?? 'Location5';
        $location6 = $location->location6 ?? 'Location6';
        $location7 = $location->location7 ?? 'Location7';
        $location8 = $location->location8 ?? 'Location8';
        $location9 = $location->location9 ?? 'Location9';
        $location10 = $location->location10 ?? 'Location10';
        $location11 = $location->location11 ?? 'Location11';
    }
    ?>
    <style>
        .no-vacancy {
            color: red;
        }
    </style>
    <section class="main-contant-section">

        <div class=""><span id="general_result"></span></div>


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
        </div>
        <div class="">
            <form method="post" action="{{ route('employees-store') }}" id="sample_form"
                class="form-horizontal employee-profile" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-4 ">
                        <div class="card content-box">
                            <div class="card-header mb-10">
                                <h5>
                                    Profile Picture </h5>
                            </div>
                            <div class="card-body py-2 text-center">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for=""> &nbsp;</label>
                                        <img height="150px" width="150px" id="blah"
                                            src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png"
                                            alt="" />
                                    </div>
                                    <div class="col-md-12">
                                        <label for="logo">
                                            Profile Picture <span class="text-danger">*</span> </label>
                                        <div class="custom-file">
                                            <input type="file" id="profile_photo"
                                                class="form-control @error('photo') is-invalid @enderror"
                                                name="profile_photo"
                                                placeholder="{{ __('Upload', ['key' => trans('file.Photo')]) }}">
                                            <small class="text-left">
                                                Upload files only: gif,png,jpg,jpeg </small>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card mb-2 content-box">

                            <div class="card-header mb-10">
                                <h1 class="card-title"> {{ __('Add Employee') }} </h1>
                                <nav aria-label="breadcrumb">
                                    <ol id="breadcrumb1">
                                        <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                                        <li><a href="{{ route('employee-lists') }}"><span class="icon icon-list"> </span>
                                                List - Employee</a></li>
                                        <li><a href="#"> Add - Employee</a></li>
                                    </ol>
                                </nav>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="company_name">
                                            First Name <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text"><i
                                                        class="fa fa-user"></i></span></div>
                                            <input type="text" class="form-control" placeholder="First Name"
                                                id="first_name" name="first_name" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="last_name" class="control-label">
                                            Last Name <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text"><i
                                                        class="fa fa-user"></i></span></div>
                                            <input type="text" class="form-control" placeholder="Last Name"
                                                id="last_name" name="last_name" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="gender" class="control-label">
                                            Gender </label>
                                        <select name="gender" id="gender" required class="selectpicker form-control"
                                            data-live-search="true" data-live-search-style="begins"
                                            title="{{ __('Selecting', ['key' => trans('file.Gender')]) }}...">
                                            <option value="Male">{{ __('Male') }}</option>
                                            <option value="Female">{{ __('Female') }}</option>
                                            <option value="Other">{{ __('Other') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="employee_id">
                                            Blood Group </label>
                                        <span class="text-danger">*</span>
                                        <select name="blood_group" required class="selectpicker form-control"
                                            data-live-search="true" data-live-search-style="begins"
                                            title="{{ __('Selecting', ['key' => trans('file.Blood Group')]) }}...">
                                            <option value="A+">{{ __('A Positive') }}</option>
                                            <option value="A-">{{ __('A Negative') }}</option>
                                            <option value="B+">{{ __('B Positive') }}</option>
                                            <option value="B-">{{ __('B Negative') }}</option>
                                            <option value="AB+">{{ __('AB Positive') }}</option>
                                            <option value="AB-">{{ __('AB Negative') }}</option>
                                            <option value="O+">{{ __('O Positive') }}</option>
                                            <option value="O-">{{ __('O Negative') }}</option>
                                            <option value="unkown">{{ __('Unknown') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="date_of_birth">
                                            Date Of Birth <span class="text-danger">*</span></label>
                                        <input type="date" name="date_of_birth" required autocomplete="off"
                                            class="form-control date" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">
                                            Email <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text"><i
                                                        class="fa  fa-envelope"></i></span></div>
                                            <input type="email" name="email" id="email"
                                                placeholder="example@example.com" required class="form-control">
                                        </div>
                                        <span id="email_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">
                                            Phone <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text"><i
                                                        class="fa  fa-phone"></i></span></div>
                                            <input class="form-control" placeholder="Contact Number" name="phone"
                                                id="phone" type="text" required>
                                        </div>
                                        <span id="phone_error"></span>
                                        <span id="phone_input_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="website">
                                            Company <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <select name="company_id" id="company_id" required
                                                class="form-control selectpicker dynamic" data-live-search="true"
                                                data-live-search-style="begins" data-shift_name="shift_name"
                                                data-dependent="company_name"
                                                title="{{ __('Selecting', ['key' => trans('file.Company')]) }}...">
                                                @foreach ($companies as $company)
                                                    <option value="{{ $company->id }}">
                                                        {{ ucfirst($company->company_name) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="website">
                                            Department <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <select class="form-control  dynamic" required data-live-search="true"
                                                data-live-search-style="begins" data-shift_name="shift_name"
                                                data-dependent="department_name"
                                                title="{{ __('Selecting', ['key' => trans('file.Department')]) }}..."
                                                name="department_id" id="department_id"></select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="website">
                                            Designation <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <select class="form-control dynamic" data-live-search="true"
                                                data-live-search-style="begins" data-shift_name="shift_name"
                                                data-dependent="department_name"
                                                title="{{ __('Selecting', ['key' => trans('file.Department')]) }}..."
                                                name="designation_id" id="designation_id" required></select>
                                            <span id="parent-container"></span>
                                            <span id="error-message" style="color:red"></span>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-md-3">
                                <label class="text-bold">{{ __('Grade') }} <span class="text-danger">*</span></label>
                                <select name="gradesetup_id" id="gradesetup_id" class="form-control">
                                </select>
                            </div> --}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="website">
                                            Office Shift <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <select class="form-control dynamic" required data-live-search="true"
                                                data-live-search-style="begins" data-shift_name="shift_name"
                                                data-dependent="office_shift"
                                                title="{{ __('Selecting', ['key' => trans('file.Department')]) }}..."
                                                name="office_shift_id" id="office_shift_id"></select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="website">
                                            Role <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text"><i
                                                        class="fa fa-user-plus"></i></span></div>
                                            <select name="role_users_id" id="role_users_id" required
                                                class="selectpicker form-control" data-live-search="true"
                                                data-live-search-style="begins"
                                                title="{{ __('Selecting', ['key' => trans('file.Role')]) }}...">
                                                @foreach ($roles as $item)
                                                    <option value="{{ $item->id }}">{{ ucfirst($item->roles_name) }}
                                                    </option>
                                                @endforeach
                                                {{-- <option value="1">Admin</option>
                                            <option value="2">Employee</option> --}}
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="website">
                                            Employment Type <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <select name="employment_type" id="employment_type" required
                                                class="selectpicker form-control employee_type" data-live-search="true"
                                                data-live-search-style="begins"
                                                title="{{ __('Select An Employment Type...') }}" required>
                                                <option value="Permanent">{{ __('Permanent') }}</option>
                                                <option value="Contactual">{{ __('Contactual') }}</option>
                                                <option value="Project Based">{{ __('Project Based') }}</option>
                                                <option value="Part Time">{{ __('Part Time') }}</option>
                                                <option value="Trainee">{{ __('Trainee') }}</option>
                                                <option value="Intern">{{ __('Intern') }}</option>
                                                <option value="Probation">{{ __('Probation') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 expiry_date" style="display: none;">
                                </div>
                                <div class="col-md-4 train_month" style="display: none;">
                                </div>
                                <div class="col-md-4 probation_month" style="display: none;">
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="website">
                                            Attendance Type <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <select name="attendance_type" id="attendance_type" required
                                                class="form-control" data-live-search="true"
                                                data-live-search-style="begins" title="{{ __('Select An Attendance') }}">
                                                <option value="general">{{ __('General') }}</option>
                                                <option value="ip_based">{{ __('IP Based') }}</option>
                                                @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                                                            'json_contains(package_module,
                                                                                                    \'["' .
                                                                $finger_print_module .
                                                                '"]\')')->exists())
                                                    @if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                                                                'json_contains(permission_content,
                                                                                                        \'["' .
                                                                    $finger_print_module .
                                                                    '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                                                        <option value="finger_print">{{ __('Finger Print') }}</option>
                                                    @endif
                                                @endif

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6" id="device_area_div" style="display: none">
                                    <label for="" id="device_area_label" style="display: none">Device
                                        Area</label>
                                    <select name="device_area[]" id="device_area" class="form-control"
                                        style="display: none"></select>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="website">
                                            Staff Type <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text"><i
                                                        class="fa fa-calendar"></i></span></div>
                                            <select name="appointment_letter" required class="selectpicker form-control"
                                                data-live-search="true" data-live-search-style="begins"
                                                title="{{ __('Select Staff Type...') }}">
                                                <option value="management">Management</option>
                                                <option value="nonmanagement">Non Management</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="website">
                                            Salary Type <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text"><i
                                                        class="fa fa-calendar"></i></span></div>
                                            <select name="salary_type" class="selectpicker form-control"
                                                data-live-search="true" data-live-search-style="begins"
                                                title="{{ __('Select Salary Type...') }}" required>
                                                <option value="Monthly">Monthly</option>
                                                <option value="Hourly">Hourly</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="website">
                                            Appointment Letter Format<span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend"></div>
                                            <select name="appointment_letter_format_id" class="selectpicker form-control"
                                                data-live-search="true" data-live-search-style="begins"
                                                title="{{ __('Select Appointment Letter Format...') }}">
                                                @foreach ($appointment_letter_formats as $appointment_letter_format)
                                                    <option value="{{ $appointment_letter_format->id }}">
                                                        {{ $appointment_letter_format->appointment_template_subject }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="email">
                                            Username <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text"><i
                                                        class="fa  fa-user"></i></span></div>
                                            <input type="text" name="username" id="username" readonly
                                                placeholder="{{ __('Unique Value', ['key' => trans('file.Username')]) }}"
                                                required class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="website">
                                            Password <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text"><i
                                                        class="fa  fa-eye-slash"></i></span></div>
                                            <input type="password" name="password" id="password"
                                                placeholder="{{ __('Password') }}" required class="form-control"
                                                value="12345678">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="website">
                                            Confirm Password <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text"><i
                                                        class="fa  fa-eye-slash"></i></span></div>
                                            <input id="confirm_pass" type="password" class="form-control "
                                                name="confirm_password" placeholder="{{ __('Re-type Password') }}"
                                                required autocomplete="new-password" value="12345678">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="registrationFormAlert" id="divCheckPasswordMatch">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="office_shift_id" class="control-label">
                                            Date Of Joining </label>
                                        <span class="text-danger">*</span>
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text"><i
                                                        class="fa fa-calendar"></i></span></div>
                                            <input type="date" name="joining_date" id="joining_date" required
                                                class="form-control date">
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role">
                                            Overtime Rate(Times of Basic) <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text"><i
                                                        class="fa fa-calendar"></i></span></div>
                                            <input type="number" class="form-control" name="user_over_time_rate"
                                                value="" class="form-check-input">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group check-box">
                                        <input type="checkbox" name="over_time_payable" id="over_time_payable"
                                            value="Yes" class="form-check-input">
                                        <label class="col-form-label not-selectable" for="over_time_payable">Overtime
                                            Payable</label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group check-box">
                                        <input type="checkbox" name="is_active" id="is_active" value="1"
                                            class="form-check-input" checked="">
                                        <label class=" col-form-label not-selectable" for="is_active">Is Active</label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group check-box">
                                        <input type="checkbox" name="admin_status" id="admin_status" value="1"
                                            class="form-check-input">
                                        <label class=" col-form-label not-selectable" for="admin_status">Admin
                                            Status</label>
                                    </div>
                                </div>
                            </div>
                            {{--
                    </div> --}}
                            <div class=" text-left mt-4">
                                <a href="{{ route('employee-add') }}" class="btn btn-danger"
                                    aria-expanded="true">Reset</a>
                                &nbsp;
                                <button type="submit" id="abcd" class="btn btn-grad ladda-button"
                                    data-style="expand-right">
                                    <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                    <span class="ladda-label">
                                        Save </span><span class="ladda-spinner"></span></button>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </section>


    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            //value retriving and opening the edit modal starts
            $('.edit').on('click', function() {
                var id = $(this).data('id');
                $.ajax({
                    type: "POST",
                    url: 'user-by-id',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(res) {
                        $('#ajaxModelTitle').html("Edit");
                        $('#edit-modal').modal('show');
                        $('#id').val(res.id);
                        $('#edit_company_assigned_id').val(res.company_assigned_id);
                        $('#edit_first_name').val(res.first_name);
                        $('#edit_last_name').val(res.last_name);
                        $('#edit_username').val(res.username);
                        $('#edit_email').val(res.email);
                        $('#edit_contact_no').val(res.phone);
                        $('#edit_salary_type').val(res.salary_type);
                        $('#edit_address').val(res.address);
                        $('#edit_department_id').val(res.department_id);
                        $('#edit_designation_id').val(res.designation_id);
                        $('#edit_joining_date').val(res.joining_date);
                        $('#edit_appointment_letter').val(res.appointment_letter);
                        if (res.multi_attendance == 1) {
                            $("#multi_attendance").attr("checked", true);
                        } else {
                            $("#multi_attendance").attr("checked", false);
                        }
                    }
                });
            });
            //value retriving and opening the edit modal ends
            var i = 1;
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


            $(document).on('change', '.employee_type', function() {
                let employee_type = $(this).val();
                if (employee_type == 'Contactual') {
                    $('.expiry_date').show().html(
                        '<label for="website">Expiry Date(if the employee is not permanent) <span class="text-danger">*</span></label><div class="input-group"><div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-calendar"></i></span></div><input type="date" name="expiry_date" class="form-control"></div>'
                    );
                    $('.train_month').hide();
                    $('.probation_month').hide();
                } else if (employee_type == 'Trainee') {
                    $('.train_month').show().html(
                        '<label for="website">Expiry Month Date <span class="text-danger">*</span></label><div class="input-group"><div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-calendar"></i></span></div><input type="date" name="in_trine_month" class="form-control"></div>'
                    );
                    $('.expiry_date').hide();
                    $('.probation_month').hide();
                } else if (employee_type == 'Probation') {
                    $('.probation_month').show().html(
                        '<label for="website">Probation Month <span class="text-danger">*</span></label><div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-calendar"></i></span><select name="in_probation_month" id="" class="form-control" required><option value="">Select Month</option><option value="3">Three Month</option><option value="6">Six Month</option></select></div>'
                    );
                    $('.expiry_date').hide();
                    $('.train_month').hide();
                } else if (employee_type == 'Intern') {
                    $('.train_month').show().html(
                        '<label for="website">Expiry Month Date <span class="text-danger">*</span></label><div class="input-group"><div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-calendar"></i></span></div><input type="date" name="in_trine_month" class="form-control"></div>'
                    );
                    $('.expiry_date').hide();
                    $('.probation_month').hide();
                } else if (employee_type == 'Permanent') {
                    $('.train_month').hide();
                    $('.expiry_date').hide();
                    $('.probation_month').hide();
                } else if (employee_type == 'Project Based') {
                    $('.train_month').hide();
                    $('.expiry_date').hide();
                    $('.probation_month').hide();
                } else if (employee_type == 'Part Time') {
                    $('.train_month').hide();
                    $('.expiry_date').hide();
                    $('.probation_month').hide();
                }
            });

            $(document).ready(function() {
                function populateDeviceAreas(data) {
                    $('#device_area').empty().append('<option hidden value="">Choose Device Area</option>');
                    $.each(data, function(key, deviceAreas) {
                        $('#device_area').append('<option value="' + deviceAreas.id + '">' +
                            deviceAreas.area_name + '</option>');
                    });

                    // Show the #device_area dropdown
                    $('#device_area').show();
                    $('#device_area_label').show();
                    $('#device_area_div').show();
                }

                function hideDeviceArea() {
                    $('#device_area').empty().hide();
                    $('#device_area_label').hide();
                    $('#device_area_div').hide();
                }

                // Change event handler for #attendance_type
                $("#attendance_type").change(function() {
                    var selectedValue = $(this).val();

                    if (selectedValue == "finger_print") {
                        // alert("Please make sure that fingerprint device is configured properly");
                        $.ajax({
                            url: '/get-device-area/',
                            type: "GET",
                            data: {
                                "_token": "{{ csrf_token() }}"
                            },
                            dataType: "json",
                            success: function(data) {
                                if (data) {
                                    populateDeviceAreas(data);
                                } else {
                                    hideDeviceArea();
                                }
                            }
                        });
                    } else if (selectedValue == "general" || selectedValue == "ip_based") {
                        hideDeviceArea();
                    }
                });

                // Trigger the change event on page load to check the initial value
                $("#attendance_type").trigger("change");
            });




            $('#company_id').on('change', function() {
                var companyID = $(this).val();
                console.log(companyID);
                if (companyID) {
                    $.ajax({
                        url: '/get-department/' + companyID,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#department_id').empty();
                                $('#department_id').append(
                                    '<option hidden value="">Choose Department</option>');
                                $.each(data, function(key, departments) {
                                    $('select[name="department_id"]').append(
                                        '<option value="' + departments.id + '">' +
                                        departments.department_name + '</option>');
                                });
                            } else {
                                $('#departments').empty();
                            }
                        }
                    });
                } else {
                    $('#departments').empty();
                }
            });
            $('#department_id').on('change', function() {
                var departmentID = $(this).val();
                if (departmentID) {
                    $.ajax({
                        url: '/get-designation-with-vacancy/' + departmentID,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(responseData) {
                            if (responseData) {
                                $('#designation_id').empty();
                                $('#designation_id').show();
                                $('#parent-container').hide();
                                $('#error-message').hide();
                                $('#designation_id').append(
                                    '<option hidden value="">Choose Designation</option>');
                                $.each(responseData, function(key, designation) {
                                    if (designation && designation.designation) {
                                        const vacancy = designation ? designation
                                            .vacancy : '';
                                        const designationName = designation.designation
                                            .designation_name || '';
                                        const optionValue =
                                            `${designationName ? designationName : 'No vacancy'} (${vacancy ? vacancy : 'No vacancy'})`;
                                        $('select[name="designation_id"]').append(
                                            '<option value="' + designation
                                            .designation.id + '">' +
                                            optionValue + '</option>');

                                    } else {
                                        const noVacancyInput = $('<input>', {
                                            type: 'text',
                                            readonly: true,
                                            value: 'No vacancy',
                                            class: 'form-control no-vacancy',
                                        });

                                        $('#designation_id').hide();
                                        $('#parent-container').html(noVacancyInput);
                                        $('#parent-container').show();
                                    }
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
            $('#sample_form').submit(function(event) {
                var departmentID = $('#designation_id').val();
                if (departmentID == '') {
                    event.preventDefault(); // Prevent the form from submitting
                    $('#error-message').text('Please set vacancy for Designation.').show();

                } else {
                    $('#error-message').hide();
                }
            });
            // $('#designation_id').on('change', function() {
            //     var designationID = $(this).val();
            //     // alert(designationID);
            //     if (designationID) {
            //         $.ajax({
            //             url: '/get-grade-for-employee-insert/' + designationID,
            //             type: "GET",
            //             data: {
            //                 "_token": "{{ csrf_token() }}"
            //             },
            //             dataType: "json",
            //             success: function(responseData) {
            //                 if (responseData.grade) {
            //                     $('#gradesetup_id').empty();
            //                     $('#gradesetup_id').append(
            //                         '<option hidden value="">Choose Designation</option>');
            //                     // $.each(responseData.grade, function(key, grades) {
            //                     // console.log(grades);
            //                     $('select[name="gradesetup_id"]').append(
            //                         '<option value="' + responseData.grade.garde_setaup_garde.id + '">' +
            //                         responseData.grade.garde_setaup_garde.grade_name +
            //                         ' (' + responseData.vacancy + ')' +
            //                         '</option>');
            //                     // });
            //                 } else {
            //                     $('#gradesetup_id').empty();
            //                     $('select[name="gradesetup_id"]').append(
            //                         '<option value="">'+'No grade found for the given ID'+'</option>');
            //                 }
            //             }
            //         });
            //     } else {
            //         $('#grades').empty();
            //     }
            // });
            $('#company_id').on('change', function() {

                var companyID = $(this).val();
                if (companyID) {
                    $.ajax({
                        url: '/get-office-shift/' + companyID,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#office_shift_id').empty();
                                $('#office_shift_id').append(
                                    '<option hidden value="" >Choose Office Shift</option>');
                                $.each(data, function(key, office_shifts) {
                                    $('select[name="office_shift_id"]').append(
                                        '<option value="' + office_shifts.id +
                                        '">' + office_shifts.shift_name +
                                        '</option>');
                                });
                            } else {
                                $('#office_shifts').empty();
                            }
                        }
                    });
                } else {
                    $('#office_shifts').empty();
                }
            });
            $('#region_id').on('change', function() {
                var regionID = $(this).val();
                if (regionID) {
                    $.ajax({
                        url: '/get-area/' + regionID,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#area_id').empty();
                                $('#area_id').append(
                                    '<option hidden value="" >Choose Area</option>');
                                $.each(data, function(key, areas) {
                                    $('select[name="area_id"]').append(
                                        '<option value="' + areas.id + '">' + areas
                                        .area_name + '</option>');
                                });
                            } else {
                                $('#areas').empty();
                            }
                        }
                    });
                } else {
                    $('#areas').empty();
                }
            });
            $('#area_id').on('change', function() {
                var areaID = $(this).val();
                if (areaID) {
                    $.ajax({
                        url: '/get-territory/' + areaID,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#territory_id').empty();
                                $('#territory_id').append(
                                    '<option hidden value="" >Choose Territory</option>');
                                $.each(data, function(key, territories) {
                                    $('select[name="territory_id"]').append(
                                        '<option value="' + territories.id + '">' +
                                        territories.territory_name + '</option>');
                                });
                            } else {
                                $('#territories').empty();
                            }
                        }
                    });
                } else {
                    $('#territories').empty();
                }
            });
            $('#territory_id').on('change', function() {
                var territoryID = $(this).val();
                if (territoryID) {
                    $.ajax({
                        url: '/get-town/' + territoryID,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#town_id').empty();
                                $('#town_id').append(
                                    '<option hidden value="" >Choose Town</option>');
                                $.each(data, function(key, towns) {
                                    $('select[name="town_id"]').append(
                                        '<option value="' + towns.id + '">' + towns
                                        .town_name + '</option>');
                                });
                            } else {
                                $('#towns').empty();
                            }
                        }
                    });
                } else {
                    $('#towns').empty();
                }
            });
            $('#town_id').on('change', function() {
                var townID = $(this).val();
                if (townID) {
                    $.ajax({
                        url: '/get-db-house/' + townID,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#db_house_id').empty();
                                $('#db_house_id').append(
                                    '<option hidden value="" >Choose Town</option>');
                                $.each(data, function(key, db_houses) {
                                    $('select[name="db_house_id"]').append(
                                        '<option value="' + db_houses.id + '">' +
                                        db_houses.db_house_name + '</option>');
                                });
                            } else {
                                $('#db_houses').empty();
                            }
                        }
                    });
                } else {
                    $('#db_houses').empty();
                }
            });
            $('#db_house_id').on('change', function() {
                var dbhouseID = $(this).val();
                if (dbhouseID) {
                    $.ajax({
                        url: '/get-location-six/' + dbhouseID,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#location_six_id').empty();
                                $('#location_six_id').append(
                                    '<option hidden value="" >Choose Town</option>');
                                $.each(data, function(key, locationsixes) {
                                    $('select[name="location_six_id"]').append(
                                        '<option value="' + locationsixes.id +
                                        '">' + locationsixes
                                        .location_six_location_six_name +
                                        '</option>');
                                });
                            } else {
                                $('#locationsixes').empty();
                            }
                        }
                    });
                } else {
                    $('#locationsixes').empty();
                }
            });
            $('#location_six_id').on('change', function() {
                var locationsixID = $(this).val();
                if (locationsixID) {
                    $.ajax({
                        url: '/get-location-seven/' + locationsixID,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#location_seven_id').empty();
                                $('#location_seven_id').append(
                                    '<option hidden value="" >Choose Town</option>');
                                $.each(data, function(key, locationsevens) {
                                    $('select[name="location_seven_id"]').append(
                                        '<option value="' + locationsevens.id +
                                        '">' + locationsevens.location_seven_name +
                                        '</option>');
                                });
                            } else {
                                $('#locationsevens').empty();
                            }
                        }
                    });
                } else {
                    $('#locationsevens').empty();
                }
            });
            $('#location_seven_id').on('change', function() {
                var locationsevenID = $(this).val();
                if (locationsevenID) {
                    $.ajax({
                        url: '/get-location-eight/' + locationsevenID,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#location_eight_id').empty();
                                $('#location_eight_id').append(
                                    '<option hidden value="" >Choose Town</option>');
                                $.each(data, function(key, locationeights) {
                                    $('select[name="location_eight_id"]').append(
                                        '<option value="' + locationeights.id +
                                        '">' + locationeights.location_eights_name +
                                        '</option>');
                                });
                            } else {
                                $('#locationeights').empty();
                            }
                        }
                    });
                } else {
                    $('#locationeights').empty();
                }
            });
            $('#location_eight_id').on('change', function() {
                var locationeightID = $(this).val();
                if (locationeightID) {
                    $.ajax({
                        url: '/get-location-nine/' + locationeightID,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#location_nine_id').empty();
                                $('#location_nine_id').append(
                                    '<option hidden value="">Choose Location</option>');
                                $.each(data, function(key, locationnines) {
                                    $('select[name="location_nine_id"]').append(
                                        '<option value="' + locationnines.id +
                                        '">' + locationnines.location_nine_name +
                                        '</option>');
                                });
                            } else {
                                $('#locationnines').empty();
                            }
                        }
                    });
                } else {
                    $('#locationnines').empty();
                }
            });
            $('#location_nine_id').on('change', function() {
                var locationtenID = $(this).val();
                if (locationtenID) {
                    $.ajax({
                        url: '/get-location-ten/' + locationtenID,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#location_ten_id').empty();
                                $('#location_ten_id').append(
                                    '<option hidden value="">Choose Location</option>');
                                $.each(data, function(key, locationtens) {
                                    $('select[name="location_ten_id"]').append(
                                        '<option value="' + locationtens.id + '">' +
                                        locationtens.location_ten_name + '</option>'
                                    );
                                });
                            } else {
                                $('#locationtens').empty();
                            }
                        }
                    });
                } else {
                    $('#locationtens').empty();
                }
            });
            $('#location_ten_id').on('change', function() {
                var locationelevenID = $(this).val();
                if (locationelevenID) {
                    $.ajax({
                        url: '/get-location-eleven/' + locationelevenID,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#location_eleven_id').empty();
                                $('#location_eleven_id').append(
                                    '<option hidden value="">Choose Location</option>');
                                $.each(data, function(key, locationelevens) {
                                    $('select[name="location_eleven_id"]').append(
                                        '<option value="' + locationelevens.id +
                                        '">' + locationelevens
                                        .location_eleven_name + '</option>');
                                });
                            } else {
                                $('#locationelevens').empty();
                            }
                        }
                    });
                } else {
                    $('#locationelevens').empty();
                }
            });
            $('#admin_company_id').on('change', function() {
                var companyID = $(this).val();
                if (companyID) {
                    $.ajax({
                        url: '/get-department/' + companyID,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#admin_department_id').empty();
                                $('#admin_department_id').append(
                                    '<option hidden value="" >Choose Department</option>');
                                $.each(data, function(key, departments) {
                                    $('select[name="department_id"]').append(
                                        '<option value="' + departments.id + '">' +
                                        departments.department_name + '</option>');
                                });
                            } else {
                                $('#departments').empty();
                            }
                        }
                    });
                } else {
                    $('#departments').empty();
                }
            });
            $('#admin_department_id').on('change', function() {
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
                                $('#admin_designation_id').empty();
                                $('#admin_designation_id').append(
                                    '<option hidden value="" >Choose Designation</option>');
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

        });
    </script>


    <script>
        $(document).ready(function() {
            $("#email").keyup(function() {
                var email = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "{{ route('check.data') }}",
                    data: {
                        table_name: 'users',
                        colum_name: 'email',
                        colum_value: email
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    success: function(res) {
                        // console.log(res);
                        if (res == 0) {
                            // $("#email").val(email);
                            $("#email_error").html(' ');
                        } else {

                            $("#email_error").html('<b style="color:red;">' + email +
                                '  has already been used<b/>');
                            $("#email").val('');

                        }

                    }
                });


            });
            $("#phone").keyup(function() {
                var phone = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "{{ route('check.data') }}",
                    data: {
                        table_name: 'users',
                        colum_name: 'phone',
                        colum_value: phone
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    success: function(res) {
                        // console.log(res);
                        if (res == 0) {
                            // $("#email").val(email);
                            $("#phone_error").html(' ');
                        } else {

                            $("#phone_error").html('<b style="color:red;">' + phone +
                                '  has already been used<b/>');
                            $("#phone").val('');

                        }

                    }
                });

            });
            // $('#phone').on('blur', function() {
            //     var phoneNumber = $(this).val();
            //     var phoneRegex = /^\d{11,13}$/;
            //     if (phoneRegex.test(phoneNumber)) {
            //         $("#phone_input_error").html(' ');
            //     } else {
            //         $("#phone_input_error").html('<i style="color:red;"> Phone Number Must Be 11 to 13 digits!<i/>');
            //     }
            // });
        });

        profile_photo.onchange = evt => {
            const [file] = profile_photo.files
            if (file) {
                blah.src = URL.createObjectURL(file)
            }
        }

        $(document).ready(function() {
            $("#last_name").on("blur", function() {
                updateUsername();
            });
        });

        var uniqueId = 0;

        function updateUsername() {
            var firstName = $("#first_name").val().trim();
            var lastName = $("#last_name").val().trim();
            var username = $("#username");

            var fullName = (firstName + "-" + lastName).replace(/\s+/g, "-").toLowerCase();

            $.ajax({
                url: "{{ route('check-username') }}",
                method: "POST",
                data: {
                    firstName: firstName,
                    lastName: lastName,
                },
                success: function(response) {
                    if (response && response.length > 0) {
                        response.forEach(function(res) {
                            console.log(res);
                            if (res.username) {
                                uniqueId++;

                                var modifiedUsername = fullName + "-" + uniqueId;

                                username.val(modifiedUsername);
                            }
                        });

                    } else {
                        username.val(fullName);
                    }

                },
                error: function() {
                    console.log("Error occurred while checking username uniqueness.");
                }
            });
        }
    </script>
@endsection
