@extends('back-end.premium.layout.premium-main')

@section('content')

    <?php
    use App\Models\Permission;
    use App\Models\Attendance;

    $date = new DateTime('now', new \DateTimeZone('Asia/Kolkata'));
    $current_date = $date->format('Y-m-d');

    $user_sub_module_one_add = '1.1.1';
    $user_sub_module_one_edit = '1.1.2';
    $user_sub_module_one_delete = '1.1.3';

    ?>

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

            <div class="card mb-4">
                <div class="card-header with-border">
                    <h1 class="card-title text-center"> {{ __('Inactive Employee List') }} </h1>
                </div>
            </div>
            <div class="d-flex flex-row" style="padding-top:1px; margin-top:-15px;">
                <div class="ml-2">
                        <a href="{{ route('employee-lists') }}"> <button class="btn btn-grad " type="button">
                                {{ __('Active Employee') }} </button></a>
                    </div>

            </div>
        </div>

        <!-- add modal for admin code starts from here -->


        <div id="adminFormModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 id="exampleModalLabel" class="modal-title">{{ __('Add Admin') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <span id="form_result"></span>
                        <form method="post" action="{{ route('admin-store') }}" id="sample_form" class="form-horizontal"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="text-bold">{{ __('ID') }} <span class="text-danger">*</span></label>
                                    <input type="text" name="company_assigned_id"
                                        placeholder="{{ __('122-151-14213-34') }}" required class="form-control">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="text-bold">{{ __('First Name') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="first_name" placeholder="{{ __('First Name') }}" required
                                        class="form-control">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="text-bold">{{ __('Last Name') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="last_name" placeholder="{{ __('Last Name') }}" required
                                        class="form-control">
                                </div>

                                <div class="col-md-6 form-group">
                                    <label class="text-bold">{{ __('Email') }} <span class="text-danger">*</span></label>
                                    <input type="email" name="email" placeholder="example@example.com" required
                                        class="form-control">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="text-bold">{{ __('Phone') }} <span class="text-danger">*</span></label>
                                    <input type="text" name="phone" placeholder="{{ __('Phone') }}" required
                                        class="form-control" value="{{ old('contact_no') }}">
                                </div>

                                <div class="col-md-6 form-group">
                                    <label><strong>{{ __('Address') }}</strong><span class="text-danger">*</span></label>
                                    <input type="text" name="address" required class="form-control" value="">
                                </div>

                                <div class="col-md-6 form-group">
                                    <label class="text-bold">{{ __('Date Of Birth') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="date" name="date_of_birth" required autocomplete="off"
                                        class="form-control date" value="">
                                </div>

                                <div class="col-md-6 form-group">
                                    <label class="text-bold">{{ __('Gender') }} <span
                                            class="text-danger">*</span></label>
                                    <select name="gender" id="gender" required class="selectpicker form-control"
                                        data-live-search="true" data-live-search-style="begins"
                                        title="{{ __('Selecting', ['key' => trans('file.Gender')]) }}...">
                                        <option value="Male">{{ __('Male') }}</option>
                                        <option value="Female">{{ __('Female') }}</option>
                                        <option value="Other">{{ __('Other') }}</option>
                                    </select>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="text-bold">{{ __('Company') }} <span
                                                class="text-danger">*</span></label>
                                        <select name="company_id" id="admin_company_id" required
                                            class="form-control selectpicker dynamic" data-live-search="true"
                                            data-live-search-style="begins" data-shift_name="shift_name"
                                            data-dependent="department_name"
                                            title="{{ __('Selecting', ['key' => trans('file.Company')]) }}...">
                                            @foreach ($companies as $company)
                                                <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="text-bold">{{ __('Department') }} <span
                                                class="text-danger">*</span></label>

                                        <select class="form-control" name="department_id"
                                            id="admin_department_id"></select>
                                    </div>
                                </div>


                                <div class="col-md-6 form-group">
                                    <label class="text-bold">{{ __('Designation') }} <span
                                            class="text-danger">*</span></label>

                                    <select class="form-control" name="designation_id"
                                        id="admin_designation_id"></select>

                                </div>

                                <div class="col-md-6 form-group">
                                    <label class="text-bold">{{ __('Username') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="username" id="username"
                                        placeholder="{{ __('Unique Value', ['key' => trans('file.Username')]) }}" required
                                        class="form-control">
                                </div>

                                <div class="col-md-6 form-group">
                                    <label class="text-bold">{{ __('Password') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="password" name="password" id="password"
                                            placeholder="{{ __('Password') }}" required class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label class="text-bold">{{ __('Confirm Password') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input id="confirm_pass" type="password" class="form-control "
                                            name="confirm_password" placeholder="{{ __('Re-type Password') }}" required
                                            autocomplete="new-password">
                                    </div>
                                    <div class="form-group">
                                        <div class="registrationFormAlert" id="divCheckPasswordMatch">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="profile_photo"
                                        class=""><strong>{{ __('Image') }}</strong></label>
                                    <input type="file" id="profile_photo"
                                        class="form-control @error('photo') is-invalid @enderror" name="profile_photo"
                                        placeholder="{{ __('Upload', ['key' => trans('file.Photo')]) }}">
                                </div>

                                <div class="container">
                                    <div class="form-group bold">
                                        <input type="hidden" name="action" id="action" />
                                        <input type="hidden" name="hidden_id" id="hidden_id" />
                                        <input type="submit" name="action_button" id="action_button"
                                            class="btn btn-grad w-50" value="{{ __('Add') }}" />
                                    </div>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>

        <!-- add modal for admin code ends here -->





        <!-- add modal for employee code starts from here -->


        <div id="employeeFormModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 id="exampleModalLabel" class="modal-title">{{ __('Add Employee') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <span id="form_result"></span>
                        <form method="post" action="{{ route('employees-store') }}" id="sample_form"
                            class="form-horizontal" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="text-bold">{{ __('ID') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="company_assigned_id"
                                        placeholder="{{ __('122-151-14213-34') }}" required class="form-control">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="text-bold">{{ __('First Name') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="first_name" placeholder="{{ __('First Name') }}"
                                        required class="form-control">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="text-bold">{{ __('Last Name') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="last_name" placeholder="{{ __('Last Name') }}" required
                                        class="form-control">
                                </div>

                                <div class="col-md-6 form-group">
                                    <label class="text-bold">{{ __('Email') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="email" name="email" placeholder="example@example.com" required
                                        class="form-control">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="text-bold">{{ __('Phone') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="phone" placeholder="{{ __('Phone') }}" required
                                        class="form-control" value="{{ old('contact_no') }}">
                                </div>

                                <div class="col-md-6 form-group">
                                    <label><strong>{{ __('Address') }}</strong><span class="text-danger">*</span></label>
                                    <input type="text" name="address" required class="form-control" value="">
                                </div>

                                <div class="col-md-6 form-group">
                                    <label class="text-bold">{{ __('Date Of Birth') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="date" name="date_of_birth" required autocomplete="off"
                                        class="form-control date" value="">
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong>{{ __('Job Nature') }} <span class="text-danger">*</span>
                                                << /strong></label>
                                        <select name="job_nature" class="form-control">
                                            <option value="">Choose a Nature</option>
                                            <option value="Permanent">{{ __('Permanent') }}</option>
                                            <option value="Part Time">{{ __('Part Time') }}</option>
                                            <option value="Trainee">{{ __('Trainee') }}</option>
                                            <option value="Contactual">{{ __('Contactual') }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong>{{ __('Blood Group') }} <span class="text-danger">*</span>
                                                << /strong></label>
                                        <select name="blood_group" required class="form-control">
                                            <option value="">Choose a Blood Group</option>
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
                                <div class="col-md-6 form-group">
                                    <label class="text-bold">{{ __('Gender') }} <span
                                            class="text-danger">*</span></label>
                                    <select name="gender" id="gender" required class="selectpicker form-control"
                                        data-live-search="true" data-live-search-style="begins"
                                        title="{{ __('Selecting', ['key' => trans('file.Gender')]) }}...">
                                        <option value="Male">{{ __('Male') }}</option>
                                        <option value="Female">{{ __('Female') }}</option>
                                        <option value="Other">{{ __('Other') }}</option>
                                    </select>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="text-bold">{{ __('Company') }} <span
                                                class="text-danger">*</span></label>
                                        <select name="company_id" id="company_id" required
                                            class="form-control selectpicker dynamic" data-live-search="true"
                                            data-live-search-style="begins" data-shift_name="shift_name"
                                            data-dependent="department_name"
                                            title="{{ __('Selecting', ['key' => trans('file.Company')]) }}...">
                                            @foreach ($companies as $company)
                                                <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="text-bold">{{ __('Department') }} <span
                                                class="text-danger">*</span></label>

                                        <select class="form-control" name="department_id" id="department_id"></select>
                                    </div>
                                </div>


                                <div class="col-md-6 form-group">
                                    <label class="text-bold">{{ __('Designation') }} <span
                                            class="text-danger">*</span></label>

                                    <select class="form-control" name="designation_id" id="designation_id"></select>

                                </div>

                                <div class="col-md-6 form-group">
                                    <label class="text-bold">{{ __('Office_Shift') }} <span
                                            class="text-danger">*</span></label>

                                    <select class="form-control" name="office_shift_id" id="office_shift_id"></select>

                                </div>

                                <div class="col-md-6 form-group">
                                    <label class="text-bold">{{ __('Username') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="username" id="username"
                                        placeholder="{{ __('Unique Value', ['key' => trans('file.Username')]) }}" required
                                        class="form-control">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="" class="text-bold">Region Name:</label>
                                    <select name="region_id" id="region_id" class="form-control selectpicker region"
                                        data-live-search="true" data-live-search-style="begins"
                                        data-dependent="area_name" title="{{ __('Selecting Region name') }}...">
                                        @foreach ($regions as $region)
                                            <option value="{{ $region->id }}">{{ $region->region_name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="" class="text-bold">Area name:</label>

                                    <select class="form-control" name="area_id" id="area_id"></select>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="" class="text-bold">Territory Name:</label>

                                    <select class="form-control" name="territory_id" id="territory_id"></select>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="" class="text-bold">Town Name:</label>

                                    <select class="form-control" name="town_id" id="town_id"></select>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="" class="text-bold">DB House Name:</label>

                                    <select class="form-control" name="db_house_id" id="db_house_id"></select>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label class="text-bold">{{ __('Role') }} <span
                                            class="text-danger">*</span></label>
                                    <select name="role_users_id" id="role_users_id" required
                                        class="selectpicker form-control" data-live-search="true"
                                        data-live-search-style="begins"
                                        title="{{ __('Selecting', ['key' => trans('file.Role')]) }}...">
                                        @foreach ($roles as $item)
                                            <option value="{{ $item->id }}">{{ $item->roles_name }}</option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label class="text-bold">{{ __('Password') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="password" name="password" id="password"
                                            placeholder="{{ __('Password') }}" required class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label class="text-bold">{{ __('Confirm Password') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input id="confirm_pass" type="password" class="form-control "
                                            name="confirm_password" placeholder="{{ __('Re-type Password') }}" required
                                            autocomplete="new-password">
                                    </div>
                                    <div class="form-group">
                                        <div class="registrationFormAlert" id="divCheckPasswordMatch">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label class="text-bold">{{ __('Attendance Type') }} <span
                                            class="text-danger">*</span></label>
                                    <select name="attendance_type" id="attendance_type" required
                                        class="selectpicker form-control" data-live-search="true"
                                        data-live-search-style="begins" title="{{ __('Select Attendance Type...') }}">
                                        <option value="general">{{ __('General') }}</option>
                                        <option value="ip_based">{{ __('IP Based') }}</option>
                                    </select>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label class="text-bold">{{ __('Date Of Joining') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="date" name="joining_date" id="joining_date"
                                        class="form-control date">
                                </div>


                                <div class="col-md-6 form-group">
                                    <label for="profile_photo"
                                        class=""><strong>{{ __('Image') }}</strong></label>
                                    <input type="file" id="profile_photo"
                                        class="form-control @error('photo') is-invalid @enderror" name="profile_photo"
                                        placeholder="{{ __('Upload', ['key' => trans('file.Photo')]) }}">
                                </div>

                                <div class="col-md-6 form-group">
                                    <label class="text-bold">{{ __('Staff Type') }} <span
                                            class="text-danger">*</span></label>
                                    <select name="appointment_letter" class="form-control" required>
                                        <option value="">Select Staff Type</option>
                                        <option value="management">Management</option>
                                        <option value="nonmanagement">Non Management</option>
                                    </select>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="text-bold">{{ __('Over Time Type') }} <span
                                            class="text-danger">*</span></label>
                                    <select name="user_over_time_type" class="form-control">
                                        <option value="">Select-A-Overtime-Type</option>
                                        <option value="Manual">Manual</option>
                                        <option value="Automatic">Automatic</option>
                                    </select>

                                </div>

                                <div class="col-md-4 form-group mt-4 ml-5">
                                    <input type="checkbox" name="over_time_payable" value="Yes"
                                        class="form-check-input">
                                    <label class="text-bold" for="exampleCheck1">Overtime Payable</label>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label class="text-bold" for="exampleCheck1">Overtime Rate(Times of Basic)</label>
                                    <input type="text" class="form-control" name="user_over_time_rate" value=""
                                        class="form-check-input">
                                </div>
                                <div class="col-md-6 form-group mt-4 ml-5">
                                    <input type="checkbox" name="is_active" value="1" class="form-check-input">
                                    <label class="text-bold" for="exampleCheck1">Is Active</label>
                                </div>

                                <div class="container">
                                    <div class="form-group bold">
                                        <input type="hidden" name="action" id="action" />
                                        <input type="hidden" name="hidden_id" id="hidden_id" />
                                        <input type="submit" name="action_button" id="action_button"
                                            class="btn btn-grad w-50" value="{{ __('Add') }}" />
                                    </div>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>

        <!-- add modal for employee code ends here -->
        <div class="content-box">

            <div class="table-responsive">
                <table id="user-table" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>{{ __('SL') }}</th>
                            <th>{{ __('Employee ID') }}</th>
                            <th>{{ __('Profile Photo') }}</th>
                            <th>{{ __('User') }}</th>
                            <th>{{ __('Email') }}</th>
                            <th>{{ __('Phone') }}</th>
                            <th>{{ __('Inactive Date') }}</th>
                            <th>{{ __('Inactive Reason') }}</th>
                            <th>{{ __('Address') }}</th>
                            @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                                <th>{{ __('Action') }}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @php($i = 1)
                        @foreach ($users as $usersData)
                            <tr>

                                <td>{{ $i++ }}</td>
                                <td>{{ $usersData->company_assigned_id }}</td>
                                <td><img class="rounded" width="60" src="{{ asset($usersData->profile_photo) }}">
                                </td>
                                <td>{{ $usersData->first_name . ' ' . $usersData->last_name }}</td>
                                <td>{{ $usersData->email ?? $usersData->inactive_email }}</td>
                                <td>{{ $usersData->phone ?? $usersData->inactive_phone }}</td>
                                <td>{{ $usersData->inactive_date ?? $usersData->expiry_date ??  $usersData->in_trine_month ?? ''}}</td>
                                <td>{{ $usersData->inactive_description ?? '' }}</td>
                                <td>{{ $usersData->address ?? '' }}</td>
                                @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                                    <td>

                                        <a href="{{ route('employee-details',['id' => $usersData->id]) }}" class="btn edit" data-id="" data-toggle="tooltip" title=" Details "
                                            data-original-title="Edit" > <i class="fa fa-pencil-square-o" aria-hidden="true"></i> </a>

                                        @if ($delete_permission == 'Yes')
                                        <a href="{{route('delete-user',['id'=>$usersData->id])}}" data-id="{{ $usersData->id }}" class="btn btn-danger delete-post" data-toggle="tooltip" title=" Delete "
                                            data-original-title="Delete"> <i class="fa fa-trash-o" aria-hidden="true"></i> </a>
                                        @endif

                                        @if ($usersData->is_active == 1)
                                        <a href="{{ route('inactive-users', ['id' => $usersData->id]) }}" data-id="{{ $usersData->id }}" class="btn active"  data-toggle="tooltip" title=" Active "
                                            data-original-title="Active"><i class="fa fa-check" aria-hidden="true"></i> </a>
                                        @else
                                            <a href="{{ route('active-users', ['id' => $usersData->id]) }}" data-id="{{ $usersData->id }}" data-toggle="tooltip" class="btn active" title=" Active "><i class="fa fa-check" aria-hidden="true"></i></a>
                                        @endif


                                    </td>
                                @endif
                            </tr>
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
                    <form method="post" action="{{ route('employees-updates') }}" id="edit_form"
                        class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="row">

                            <div class="col-md-6 form-group">
                                <label class="text-bold">{{ __('ID') }} <span class="text-danger">*</span></label>
                                <input type="text" name="company_assigned_id" id="edit_company_assigned_id" required
                                    class="form-control">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>{{ __('First Name') }} *</label>
                                <input type="text" name="first_name" id="edit_first_name" required
                                    class="form-control">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>{{ __('Last Name') }} *</label>
                                <input type="text" name="last_name" id="edit_last_name" required
                                    class="form-control">
                            </div>

                            <div class="col-md-6 form-group">
                                <label>{{ __('Username') }} <span class="text-danger">*</span></label>
                                <input type="text" name="username" id="edit_username" required class="form-control">
                            </div>



                            <div class="col-md-6 form-group">
                                <label>{{ __('Email') }} <span class="text-danger">*</span></label>
                                <input type="email" name="email" id="edit_email" required class="form-control">
                            </div>


                            <div class="col-md-6 form-group">
                                <label>{{ __('Phone') }} <span class="text-danger">*</span></label>
                                <input type="text" name="contact_no" id="edit_contact_no" required
                                    class="form-control">
                            </div>


                            <div class="col-md-6 form-group">
                                <label><strong>{{ __('Address') }}</strong><span class="text-danger">*</span></label>
                                <input type="text" name="address" id="edit_address" required class="form-control">
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="text-bold">{{ __('Staff Type') }} <span
                                        class="text-danger">*</span></label>
                                <select name="appointment_letter" id="edit_appointment_letter" class="form-control"
                                    required>
                                    <option value="">Select Staff Type</option>
                                    <option value="management">Management</option>
                                    <option value="nonmanagement">Non Management</option>
                                </select>
                            </div>

                            <div class="col-md-6 form-group ">
                                <label for="profile_photo_edit"
                                    class=""><strong>{{ __('Image') }}</strong></label>
                                <img src="">
                                <input type="file" class="form-control @error('photo') is-invalid @enderror"
                                    name="profile_photo">
                                <span></span>
                            </div>

                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-grad ">Save changes</button>
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



            $('#company_id').on('change', function() {
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
@endsection
