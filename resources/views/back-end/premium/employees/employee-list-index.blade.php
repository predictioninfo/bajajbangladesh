@extends('back-end.premium.layout.premium-main')
@section('content')

<?php
    use App\Models\Permission;
    use App\Models\Attendance;
    use App\Models\Package;
    $employee_sub_module_one_add = '2.1.1';
    $employee_sub_module_one_edit = '2.1.2';
    $employee_sub_module_one_delete = '2.1.3';
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
<section class="main-contant-section">

    <div class=""><span id="general_result"></span></div>


    <div class=" mb-2">


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

        <div class="card mb-3">
            <div class="card-header with-border">
                    <h1 class="card-title"> {{__('Employee List')}} </h1>
                    <nav aria-label="breadcrumb">

                        <ol id="breadcrumb1">
                            <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                            @if($add_permission == 'Yes')
                            <li><a href="{{ route('employee-add') }}" ><span class="icon icon-plus"> </span>Add</a></li>
                            @endif
                            <li><a href="#">List - Employee</a></li>
                        </ol>
                    </nav>
            </div>
        </div>

        <div class="d-flex flex-row">

            @if ($delete_permission == 'Yes')
            <div class="p-1">
                <form method="post" action="{{ route('bulk-delete-employees') }}" id="sample_form"
                    class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="bulk_delete_com_id" value="{{ Auth::user()->com_id }}"
                        class="form-check-input">
                    <input type="submit" class="btn btn-danger w-100" value="{{ __('Bulk Delete') }}" />
                </form>
            </div>
            <div class="p-1">
                <form method="post" action="{{ route('bulk-restore-employees') }}" id="sample_form"
                    class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="bulk_delete_com_id" value="{{ Auth::user()->com_id }}"
                        class="form-check-input">

                    <input type="submit" class="btn btn-warning w-100" value="{{ __('Bulk Restore') }}" />

                </form>
            </div>
            @endif
            @if ($add_permission == 'Yes')
            <div class="p-1">
                <a href="{{ route('inactive-user-lists') }}"> <button class="btn btn-grad " type="button">
                        {{ __('Inactive
                        Employee') }} </button></a>
            </div>
            @endif
        </div>

    </div>

    <div class="content-box">

        <div class="table-responsive">
            <table id="user-table" class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>{{ __('SL') }}</th>
                        <th>{{ __('Employee ID') }}</th>
                        <th>{{ __('Profile Photo') }}</th>
                        <th>{{ __('User') }}</th>
                        <th>{{ __('Depertment') }}</th>
                        <th>{{ __('Designation') }}</th>
                        <th>{{ __('Email') }}</th>
                        <th>{{ __('Phone') }}</th>
                        <th>{{ __('Address') }}</th>
                        <th>{{ __('Salary Type') }}</th>
                        <th>{{ __('Employment Type') }}</th>
                        <th>{{ __('Employee Setting') }}</th>
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
                        <td><a href="{{ route('employee-details', ['id' => $usersData->id]) }}"><img class="rounded"
                                    width="60" src="{{ asset($usersData->profile_photo) }}"></a></td>
                        <td><a href="{{ route('employee-details', ['id' => $usersData->id]) }}">{{
                                $usersData->first_name .
                                '
                                ' .
                                $usersData->last_name }}</a>
                        </td>

                        <td>{{ $usersData->userdepartment->department_name ?? ''}}</td>
                        <td>{{ $usersData->userdesignation->designation_name  ?? ''}}</td>
                        <td>{{ $usersData->email }}</td>
                        <td>{{ $usersData->phone }}</td>

                        <td>
                            @if($usersData->emoloyeedetail)
                            @if($usersData->emoloyeedetail->present_village)
                            {{ $usersData->emoloyeedetail->present_village}},
                            @endif
                            @endif

                            @if ($usersData->emoloyeedetail)
                            @if ($usersData->emoloyeedetail->present_postal_area)
                            {{ $usersData->emoloyeedetail->present_postal_area }}-
                            @endif
                            @endif

                            @if($usersData->emoloyeedetail)
                            @if($usersData->emoloyeedetail->present_postal_code)
                            {{ $usersData->emoloyeedetail->present_postal_code }},
                            @endif
                            @endif

                            @if($usersData->emoloyeedetail)
                            @if($usersData->emoloyeedetail->presentEmploeeUnion)
                            {{ $usersData->emoloyeedetail->presentEmploeeUnion->un_name }},
                            @endif
                            @endif

                            @if($usersData->emoloyeedetail)
                            @if($usersData->emoloyeedetail->presentEmploeeUpazila)
                            {{ $usersData->emoloyeedetail->presentEmploeeUpazila->up_name }},
                            @endif
                            @endif

                            @if($usersData->emoloyeedetail)
                            @if($usersData->emoloyeedetail->presentEmploeeDistrict)
                            {{ $usersData->emoloyeedetail->presentEmploeeDistrict->dist_name }},
                            @endif
                            @endif

                            @if($usersData->emoloyeedetail)
                            @if($usersData->emoloyeedetail->presentEmploeeDistrict)
                            {{ $usersData->emoloyeedetail->presentEmploeeDivision->dv_name }}
                            @endif
                            @endif
                        </td>

                        <td>{{ $usersData->salary_type ?? '' }}</td>
                        <td>{{ $usersData->employment_type ?? '' }}</td>
                        <td> <a href="{{ route('employee-details', ['id' => $usersData->id]) }}"
                            class="btn btn-info">Add More</a> </td>


                        @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                        <td>
                            @if ($edit_permission == 'Yes')
                            <a href="{{ route('employee-details',['id' => $usersData->id]) }}" class="btn edit" data-id="" data-toggle="tooltip" title="Edit"
                                data-original-title="Edit" > <i class="fa fa-pencil-square-o" aria-hidden="true"></i> </a>
                            @endif

                            @if ($delete_permission == 'Yes')
                            <a href="{{route('delete-user',['id'=>$usersData->id])}}" data-id="{{ $usersData->id }}" class="btn btn-danger delete-post" data-toggle="tooltip" title="Delete" onclick="return confirm('Are you sure you want to delete this item?');"
                                data-original-title="Delete"> <i class="fa fa-trash-o" aria-hidden="true"></i> </a>
                            @endif

                            @if ($usersData->is_active == 1)
                            <a href="#" id="edit-post" data-target="#inactiveEditModal{{ $usersData->id }}" class="btn btn-danger delete-post"  data-toggle="modal" title="Inactive" 
                                data-original-title="Delete"><i class="fa fa-times" aria-hidden="true"></i> </a>
                            @else
                                <a href="{{ route('active-users', ['id' => $usersData->id]) }}" data-id="{{ $usersData->id }}" data-toggle="tooltip" title="Active"><i class="fa fa-check" aria-hidden="true"></i></a>
                            @endif

                            @if ($edit_permission == 'Yes')
                            <a href="{{ route('employee-attendance-forms', ['id' => $usersData->id]) }}" class="btn attandance" data-id="" data-toggle="tooltip" title="Attandance"
                                data-original-title="Attandance" target="_blank"><i class="fa fa-clock-o" aria-hidden="true"></i></a>
                            @endif

                        </td>
                        @endif
                    </tr>


                    <!-- inactive Modal starts from here -->
                    <div id="inactiveEditModal{{$usersData->id}}" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 id="exampleModalLabel" class="modal-title">{{_('Inactive Date')}}</h5>
                                    <button type="button" data-dismiss="modal" id="close" aria-label="Close"
                                        class="close"><i class="dripicons-cross"></i></button>
                                </div>

                                <div class="modal-body">
                                    <form method="post" action="{{ route('inactive-users', ['id' => $usersData->id]) }}"
                                        class="form-horizontal" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            {{-- <input type="hidden" name="id" value="{{$areasValue->id}}"> --}}
                                            <div class="col-md-12 form-group">
                                                <label>Inactive Date <span class="text-danger">*</span></label>
                                                <input type="date" name="inactive_date" value="" required
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>Description </label>
                                                <textarea class="form-control" name="inactive_description"></textarea>
                                            </div>
                                            <div class="col-sm-12 mt-4">
                                                <input type="submit" name="action_button" class="btn btn-grad"
                                                    value="{{__('Inactive')}}" />
                                            </div>
                                        </div>

                                    </form>
                                </div>

                            </div>

                        </div>
                    </div>

                    <!-- edit Modal ends from here -->
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <!-- add modal code starts from here -->

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
                    <form method="post" action="{{ route('employees-store') }}" id="sample_form" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="section-title">
                                    <h2>Basic Info</h2>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <label class="col-sm-12 col-form-label">{{ __('ID') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-id-badge"
                                                aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="text" name="company_assigned_id"
                                        placeholder="{{ __('122-151-14213-34') }}" required class="form-control">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <label class="col-sm-12 col-form-label">{{ __('First Name') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-user" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="first_name" placeholder="{{ __('First Name') }}" required
                                        class="form-control">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <label class="col-sm-12 col-form-label">{{ __('Last Name') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-user" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="last_name" placeholder="{{ __('Last Name') }}" required
                                        class="form-control">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <label class="col-sm-12 col-form-label">{{ __('Email') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-envelope-o"
                                                aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="email" name="email" placeholder="example@example.com" required
                                        class="form-control">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <label class="col-sm-12 col-form-label">{{ __('Phone') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-phone" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="phone" placeholder="{{ __('Phone') }}" required
                                        class="form-control" value="{{ old('contact_no') }}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <label class="col-sm-12 col-form-label"> {{ __(' Present Address') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-location-arrow"
                                                aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="text" name="address" required class="form-control" value="">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <label class="col-sm-12 col-form-label">{{ __('Date Of Birth') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-birthday-cake"
                                                aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="date" name="date_of_birth" required autocomplete="off"
                                        class="form-control date" value="">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-sm-12 col-form-label"> {{ __('Blood Group') }} * </label>
                                    <div class="input-group col-md-12">
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
                            </div>

                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-sm-12 col-form-label">{{ __('Gender') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group col-md-12">
                                        <select name="gender" id="gender" required class="selectpicker form-control"
                                            data-live-search="true" data-live-search-style="begins"
                                            title="{{ __('Selecting', ['key' => trans('file.Gender')]) }}...">
                                            <option value="Male">{{ __('Male') }}</option>
                                            <option value="Female">{{ __('Female') }}</option>
                                            <option value="Other">{{ __('Other') }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <label for="profile_photo" class="col-sm-12 col-form-label"> {{ __('Image') }}
                                    </label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-picture-o"
                                                aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="file" id="profile_photo"
                                        class="form-control @error('photo') is-invalid @enderror" name="profile_photo"
                                        placeholder="{{ __('Upload', ['key' => trans('file.Photo')]) }}">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="section-title">
                                    <h2>Company Info</h2>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-sm-12 col-form-label">{{ __('Company') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group col-md-12">
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
                            </div>

                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-sm-12 col-form-label">{{ __('Department') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group col-md-12">
                                        <select class="form-control" name="department_id" id="department_id"></select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-sm-12 col-form-label">{{ __('Designation') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group col-md-12">
                                        <select class="form-control" name="designation_id" id="designation_id"></select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-sm-12 col-form-label">{{ __('Office_Shift') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group col-md-12">
                                        <select class="form-control" name="office_shift_id"
                                            id="office_shift_id"></select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-sm-12 col-form-label"> {{ __('Job Nature') }} * </label>
                                    <div class="input-group col-md-12">
                                        <select name="job_nature" class="form-control">
                                            <option value="">Choose a Nature</option>
                                            <option value="Permanent">{{ __('Permanent') }}</option>
                                            <option value="Part Time">{{ __('Part Time') }}</option>
                                            <option value="Trainee">{{ __('Trainee') }}</option>
                                            <option value="Contactual">{{ __('Contactual') }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-sm-12 col-form-label">{{ __('Role') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group col-md-12">
                                        <select name="role_users_id" id="role_users_id" required
                                            class="selectpicker form-control" data-live-search="true"
                                            data-live-search-style="begins"
                                            title="{{ __('Selecting', ['key' => trans('file.Role')]) }}...">
                                            @foreach ($roles as $item)
                                            <option value="{{ $item->id }}">{{ $item->roles_name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-sm-12 col-form-label">{{ __('Employment Type') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group col-md-12">
                                        <select name="employment_type" id="employment_type" required
                                            class="selectpicker form-control" data-live-search="true"
                                            data-live-search-style="begins"
                                            title="{{ __('Select An Employment Type...') }}" required>
                                            <option value="Permanent">{{ __('Permanent') }}</option>
                                            <option value="Contactual">{{ __('Contactual') }}</option>
                                            <option value="Project-Based">{{ __('Project Based') }}</option>
                                            <option value="Temporary">{{ __('Temporary') }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <label class="col-sm-12 col-form-label">{{ __('Expiry Date(if the employee is not
                                        permanent)') }}
                                        <span class="text-danger">*</span></label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-calendar"
                                                aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="date" name="expiry_date" id="expiry_date" class="form-control date">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-sm-12 col-form-label">{{ __('Attendance Type') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group col-md-12">
                                        <select name="attendance_type" id="attendance_type" required
                                            class="selectpicker form-control" data-live-search="true"
                                            data-live-search-style="begins"
                                            title="{{ __('Select An Attendance Type...') }}">
                                            <option value="general">{{ __('General') }}</option>
                                            <option value="ip_based">{{ __('IP Based') }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-sm-12 col-form-label">{{ __('Staff Type') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group col-md-12">
                                        <select name="appointment_letter" class="form-control" required>
                                            <option value="">Select Staff Type</option>
                                            <option value="management">Management</option>
                                            <option value="nonmanagement">Non Management</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-sm-12 col-form-label">{{ __('Salary Type') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group col-md-12">
                                        <select name="salary_type" class="form-control" required>
                                            <option value="">Select Salary Type</option>
                                            <option value="Monthly">Monthly</option>
                                            <option value="Hourly">Hourly</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <label class="col-sm-12 col-form-label">{{ __('Date Of Joining') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-calendar"
                                                aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="date" name="joining_date" id="joining_date" class="form-control date">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-sm-12 col-form-label">{{ __('Over Time Type') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group col-md-12">
                                        <select name="user_over_time_type" class="form-control">
                                            <option value="">Select-A-Overtime-Type</option>
                                            <option value="Manual">Manual</option>
                                            <option value="Automatic">Automatic</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <label class="col-sm-12 col-form-label">{{ __('Username') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-user" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="username" id="username"
                                        placeholder="{{ __('Unique Value', ['key' => trans('file.Username')]) }}"
                                        required class="form-control">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <label class="col-sm-12 col-form-label">{{ __('Password') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-key" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="password" name="password" id="password"
                                        placeholder="{{ __('Password') }}" required class="form-control">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <label class="col-sm-12 col-form-label">{{ __('Confirm Password') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-key" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input id="confirm_pass" type="password" class="form-control "
                                        name="confirm_password" placeholder="{{ __('Re-type Password') }}" required
                                        autocomplete="new-password">
                                    <div class="registrationFormAlert" id="divCheckPasswordMatch"> </div>
                                </div>
                            </div>

                            <div class="col-md-4 form-group check-box">
                                <input type="checkbox" name="over_time_payable" value="Yes" class="form-check-input">
                                <label class="col-sm-12 col-form-label" for="exampleCheck1">Overtime Payable</label>
                            </div>

                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <label class="col-sm-12 col-form-label" for="exampleCheck1">Overtime Rate(Times of
                                        Basic)</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-money" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="user_over_time_rate" value=""
                                        class="form-check-input">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="section-title">
                                    <h2>Job Location</h2>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label for="" class="col-sm-12 col-form-label">Region Name:</label>
                                    <div class="input-group col-md-12">
                                        <select name="region_id" id="region_id" class="form-control selectpicker region"
                                            data-live-search="true" data-live-search-style="begins"
                                            data-dependent="area_name" title="{{ __('Selecting Region name') }}...">
                                            @foreach ($regions as $region)
                                            <option value="{{ $region->id }}">{{ $region->region_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="row form-group">
                                    <label for="" class="col-sm-12 col-form-label">Area name:</label>
                                    <div class="input-group col-md-12">
                                        <select class="form-control" name="area_id" id="area_id"></select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label for="" class="col-sm-12 col-form-label">Territory Name:</label>
                                    <div class="input-group col-md-12">
                                        <select class="form-control" name="territory_id" id="territory_id"></select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label for="" class="col-sm-12 col-form-label">Town Name:</label>
                                    <div class="input-group col-md-12">
                                        <select class="form-control" name="town_id" id="town_id"></select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label for="" class="col-sm-12 col-form-label">DB House Name:</label>
                                    <div class="input-group col-md-12">
                                        <select class="form-control" name="db_house_id" id="db_house_id"></select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 form-group check-box">
                                <input type="checkbox" name="is_active" value="1" class="form-check-input" checked>
                                <label class=" col-form-label" for="exampleCheck1">Is Active</label>
                            </div>

                            <div class="col-md-12 mt-4">
                                <div class="form-group bold">
                                    <button class="btn btn-grad"> <i class="fa fa-plus" aria-hidden="true"></i> Add
                                    </button>

                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- add modal code ends here -->

<!-- edit boostrap model -->
<div class="modal fade" id="edit-modal" aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="ajaxModelTitle"></h4>
            </div>
            <div class="modal-body">

                <form method="post" action="{{ route('employees-updates') }}" class="form-horizontal"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="row">

                        <div class="col-md-6 form-group">
                            <label class="text-bold">{{ __('ID') }} <span class="text-danger">*</span></label>
                            <input type="text" name="company_assigned_id" id="edit_company_assigned_id" readonly
                                class="form-control">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>{{ __('First Name') }} <span class="text-danger">*</span></label>
                            <input type="text" name="first_name" id="edit_first_name" required class="form-control">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>{{ __('Last Name') }} <span class="text-danger">*</span></label>
                            <input type="text" name="last_name" id="edit_last_name" required class="form-control">
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
                            <input type="text" name="contact_no" id="edit_contact_no" required class="form-control">
                        </div>

                        <div class="col-md-6 form-group">
                            <label><strong>{{ __('Address') }}</strong><span class="text-danger">*</span></label>
                            <input type="text" name="address" id="edit_address" required class="form-control">
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="text-bold">{{ __('Staff Type') }} <span class="text-danger">*</span></label>
                            <select name="appointment_letter" id="edit_appointment_letter" class="form-control"
                                required>
                                <option value="">Select Staff Type</option>
                                <option value="management">Management</option>
                                <option value="nonmanagement">Non Management</option>
                            </select>
                        </div>

                        <div class="col-md-6 form-group">
                            <label class="text-bold">{{ __('Salary Type') }} <span class="text-danger">*</span></label>
                            <select name="salary_type" id="edit_salary_type" class="form-control" required>
                                <option value="">Select Salary Type</option>
                                <option value="Monthly">Monthly</option>
                                <option value="Hourly">Hourly</option>
                            </select>
                        </div>

                        <div class="col-md-6 form-group ">
                            <label for="profile_photo_edit" class=""><strong>{{ __('Image') }}</strong></label>
                            <img src="">
                            <input type="file" class="form-control @error('photo') is-invalid @enderror"
                                name="profile_photo">
                            <span></span>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>{{ __('Date of Joinning') }} *</strong></label>
                                <input type="date" name="joining_date" class="form-control" id="edit_joining_date"
                                    value="" required />
                            </div>
                        </div>
                        <div class="col-md-6 form-group mt-4 ml-5">
                            <input type="checkbox" name="multi_attendance" value="1" class="form-check-input"
                                id="multi_attendance">
                            <label class="text-bold not-selectable" for="multi_attendance"
                                style="margin-top:10px;">Multiple Attendance</label>
                        </div>

                        <div class="col-sm-offset-2 col-sm-10 mt-4">
                            <button type="submit" class="btn btn-grad">Save changes</button>
                        </div><br>
                        <div class="col-sm-offset-2 col-sm-10">
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
            //value retriving and opening the edit modal starts
            $('.edit1').on('click', function() {
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
@endsection
