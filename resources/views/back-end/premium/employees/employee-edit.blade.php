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
                    <h1 class="card-title text-center"> {{ __('Employee List') }} </h1>
                </div>
            </div>

            <div class="d-flex flex-row">
            </div>

        </div>

        <div class="content-box">
            <form method="post" action="{{ route('employees-store') }}" id="sample_form" class="form-horizontal"
                enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-12 form-group">
                        <div class="section-title text-center">
                            <h2>Basic Info (English)</h2>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <label class="text-bold">{{ __('First Name') }} <span class="text-danger">*</span></label>
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-user" aria-hidden="true"></i> </span>
                            </div>
                            <input type="text" name="first_name" placeholder="{{ __('First Name') }}" required
                            class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <label class="text-bold">{{ __('Last Name') }} <span class="text-danger">*</span></label>
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-user" aria-hidden="true"></i> </span>
                            </div>
                            <input type="text" name="last_name" placeholder="{{ __('Last Name') }}" required
                            class="form-control">
                        </div>
                    </div>

                    <div class="col-md-4 ">
                        <div class="input-group mb-3">
                            <label class="text-bold">{{ __('Email') }} <span class="text-danger">*</span></label>
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-envelope-o" aria-hidden="true"></i> </span>
                            </div>
                            <input type="email" name="email" placeholder="example@example.com" required
                            class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <label class="text-bold">{{ __('Personal Phone') }} <span class="text-danger">*</span></label>
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-phone" aria-hidden="true"></i> </span>
                            </div>
                            <input type="text" name="phone" placeholder="{{ __('Phone') }}" required
                            class="form-control" value="{{ old('contact_no') }}">
                        </div>
                    </div>
                    <div class="col-md-4 ">
                        <div class="input-group mb-3">
                            <label class="text-bold">{{ __('Business Phone') }} <span class="text-danger">*</span></label>
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-phone" aria-hidden="true"></i> </span>
                            </div>
                            <input type="text" name="phone" placeholder="{{ __('Phone') }}" required
                            class="form-control" value="{{ old('contact_no') }}">
                        </div>
                    </div>

                    <div class="col-md-4 ">
                        <div class="input-group mb-3">
                            <label><strong>{{ __(' Present Address') }}</strong><span class="text-danger">*</span></label>
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-location-arrow" aria-hidden="true"></i> </span>
                            </div>
                            <input type="text" name="address" required class="form-control" value="">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <label class="text-bold">{{ __('Date Of Birth') }} <span class="text-danger">*</span></label>
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-birthday-cake" aria-hidden="true"></i> </span>
                            </div>
                            <input type="date" name="date_of_birth" required autocomplete="off" class="form-control date"
                            value="">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label><strong>{{ __('Blood Group') }} *</strong></label>
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
                    <div class="col-md-4 form-group">
                        <label class="text-bold">{{ __('Gender') }} <span class="text-danger">*</span></label>
                        <select name="gender" id="gender" required class="selectpicker form-control"
                            data-live-search="true" data-live-search-style="begins"
                            title="{{ __('Selecting', ['key' => trans('file.Gender')]) }}...">
                            <option value="Male">{{ __('Male') }}</option>
                            <option value="Female">{{ __('Female') }}</option>
                            <option value="Other">{{ __('Other') }}</option>
                        </select>
                    </div>
                    <div class="col-md-4 ">
                        <div class="input-group mb-3">
                            <label for="profile_photo" class=""><strong>{{ __('Image') }}</strong></label>
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-picture-o" aria-hidden="true"></i> </span>
                            </div>
                            <input type="file" id="profile_photo"
                            class="form-control @error('photo') is-invalid @enderror" name="profile_photo"
                            placeholder="{{ __('Upload', ['key' => trans('file.Photo')]) }}">
                        </div>
                    </div>
                    <div class="col-md-4 form-group">
                        <label class="text-bold">{{ __('Identification Type') }} <span
                                class="text-danger">*</span></label>

                        <select class="form-control" name="identification_type">
                            <option value="" selected="selected" disabled="disabled">--
                                select one --
                            </option>
                            <option value="nid">NID Number</option>
                            <option value="birthcertificate">Birth Certificate Number</option>
                            <option value="passport-number">Passport Number</option>
                        </select>
                    </div>
                    <div class="col-md-4 ">
                        <div class="input-group mb-3">
                            <label for="" class="text-bold">Identification Number</label>
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i> </span>
                            </div>
                            <input type="text" name="identification_number" value="" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-4 form-group">
                        <label class="text-bold">{{ __('Religion') }} <span class="text-danger">*</span></label>
                        <select class="form-control" name="religion" required>
                            <option value="" selected="selected" disabled="disabled">--
                                select one --
                            </option>
                            <option value="Islam">Islam</option>
                            <option value="Hinduism">Hinduism</option>
                            <option value="Buddhism">Buddhism</option>
                            <option value="Christianity">Christianity</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>


                    <div class="col-md-4 form-group">
                        <label class="text-bold">{{ __('Marital Status') }} <span class="text-danger">*</span></label>
                        <select class="form-control" name="marital_status" required>
                            <option value="" selected="selected" disabled="disabled">--
                                select one --
                            </option>
                            <option value="Unmarried">Unmarried</option>
                            <option value="Married">Married</option>
                        </select>
                    </div>
                    <div class="col-md-4 form-group">
                        <label class="text-bold">{{ __('Nationaltity') }} <span class="text-danger">*</span></label>
                        <select name="nationality" class=" selectpicker form-control" data-live-search="true"
                            data-live-search-style="begins">
                            <option value="">-- select one --</option>
                            @foreach ($nationalities as $item)
                                <option value="{{ $item->id }}">
                                    {{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <label class="text-bold">{{ __('Birth Place') }} <span class="text-danger">*</span></label>
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-birthday-cake" aria-hidden="true"></i> </span>
                            </div>
                            <input type="text" name="birth_place" class="form-control"
                            placeholder="Enter your birth place">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <label><strong>{{ __('Father Name') }} </strong></label>
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-user" aria-hidden="true"></i> </span>
                            </div>
                            <input type="text" name="father_name" class="form-control" value="" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <label><strong>{{ __('Mother Name') }} </strong></label>
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-user" aria-hidden="true"></i> </span>
                            </div>
                            <input type="text" name="mother_name" class="form-control" value="" />
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <div class="section-title">
                            <p class="italic" style="color: red"> <small> Permanent Address </small></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="" class="text-bold">Division Name:</label>
                        <select name="division_id" id="division_id" class="form-control selectpicker region"
                            data-live-search="true" data-live-search-style="begins" data-dependent="area_name"
                            title="{{ __('Selecting Division name') }}...">
                            @foreach ($divisions as $division)
                                <option value="{{ $division->id }}">{{ $division->dv_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4 form-group">
                        <label for="" class="text-bold">District Name:</label>
                        <select class="form-control" name="district_id" id="district_id"></select>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <label for="" class="text-bold">City Corporation Name:</label>
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-location-arrow" aria-hidden="true"></i> </span>
                            </div>
                            <input type="text" name="city_corporation" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="" class="text-bold">Upazila Name:</label>
                        <select class="form-control" name="upazila_id" id="upazila_id"></select>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="" class="text-bold">Union Name:</label>
                        <select class="form-control" name="union_id" id="union_id"></select>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <label for="" class="text-bold">Ward No:</label>
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-location-arrow" aria-hidden="true"></i> </span>
                            </div>
                            <input type="text" name="ward_no" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <label><strong>{{ __('Village Name') }} </strong></label>
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-building" aria-hidden="true"></i> </span>
                            </div>
                            <input type="text" name="village_bn" class="form-control" value=""
                                placeholder="Village Name in  English" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <label><strong>{{ __('Postal Area') }} </strong></label>
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-location-arrow" aria-hidden="true"></i> </span>
                            </div>
                            <input type="text" name="postal_area_bn" class="form-control" value=""
                                placeholder="Postal Area In " />
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <div class="section-title text-center">
                            <h2>Basic Info (Mother Language)</h2>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group mb-3">
                        <label class="text-bold">{{ __('First Name') }} <span class="text-danger">*</span></label>
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-user" aria-hidden="true"></i> </span>
                            </div>
                            <input type="text" name="first_name" placeholder="{{ __('First Name') }}" required
                            class="form-control">
                        </div>


                    </div>
                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <label class="text-bold">{{ __('Last Name') }} <span class="text-danger">*</span></label>
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-user" aria-hidden="true"></i> </span>
                            </div>
                            <input type="text" name="last_name" placeholder="{{ __('Last Name') }}" required
                            class="form-control">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <label><strong>{{ __(' Present Address') }}</strong><span class="text-danger">*</span></label>
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-location-arrow" aria-hidden="true"></i> </span>
                            </div>
                            <input type="text" name="address" required class="form-control" value="">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <label><strong>{{ __('Father Name') }} </strong></label>
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-user" aria-hidden="true"></i> </span>
                            </div>
                            <input type="text" name="father_name" class="form-control" value="" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <label><strong>{{ __('Mother Name') }} </strong></label>
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-user" aria-hidden="true"></i> </span>
                            </div>
                            <input type="text" name="mother_name" class="form-control" value="" />
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <div class="section-title">
                            <p class="italic" style="color: red"> <small> Permanent Address </small></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <label><strong>{{ __('Village Name') }} </strong></label>
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-area-chart" aria-hidden="true"></i> </span>
                            </div>
                            <input type="text" name="village_bn" class="form-control" value=""
                            placeholder="Village Name " />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <label><strong>{{ __('Postal Area') }} </strong></label>
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-area-chart" aria-hidden="true"></i> </span>
                            </div>
                            <input type="text" name="postal_area_bn" class="form-control" value=""
                            placeholder="Postal Area" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="section-title text-center">
                            <h2>Previous Job Info</h2>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <label class="text-bold">{{ __('Previous Organization') }} <span
                                class="text-danger"></span></label>
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-building" aria-hidden="true"></i> </span>
                            </div>
                            <input type="text" name="previous_organization" class="form-control" value="" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <label><strong>{{ __('Total Experience') }} </strong></label>
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-money" aria-hidden="true"></i> </span>
                            </div>
                            <input type="text" name="experience_month" class="form-control" value="" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="section-title text-center">
                            <h2>Company Info</h2>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="text-bold">{{ __('Company') }} <span class="text-danger">*</span></label>
                            <select name="company_id" id="company_id" required class="form-control selectpicker dynamic"
                                data-live-search="true" data-live-search-style="begins" data-shift_name="shift_name"
                                data-dependent="department_name"
                                title="{{ __('Selecting', ['key' => trans('file.Company')]) }}...">
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="text-bold">{{ __('Department') }} <span class="text-danger">*</span></label>
                            <select class="form-control" name="department_id" id="department_id"></select>
                        </div>
                    </div>


                    <div class="col-md-4 form-group">
                        <label class="text-bold">{{ __('Designation') }} <span class="text-danger">*</span></label>
                        <select class="form-control" name="designation_id" id="designation_id"></select>
                    </div>

                    <div class="col-md-4 form-group ">
                        <label class="text-bold">{{ __('Office_Shift') }} <span class="text-danger">*</span></label>
                        <select class="form-control" name="office_shift_id" id="office_shift_id"></select>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><strong>{{ __('Job Nature') }} *</strong></label>
                            <select name="job_nature" class="form-control">
                                <option value="">Choose a Nature</option>
                                <option value="Permanent">{{ __('Permanent') }}</option>
                                <option value="Part Time">{{ __('Part Time') }}</option>
                                <option value="Trainee">{{ __('Trainee') }}</option>
                                <option value="Contactual">{{ __('Contactual') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 form-group">
                        <label class="text-bold">{{ __('Role') }} <span class="text-danger">*</span></label>
                        <select name="role_users_id" id="role_users_id" required class="selectpicker form-control"
                            data-live-search="true" data-live-search-style="begins"
                            title="{{ __('Selecting', ['key' => trans('file.Role')]) }}...">
                            @foreach ($roles as $item)
                                <option value="{{ $item->id }}">{{ $item->roles_name }}</option>
                            @endforeach
                            {{-- <option value="1">Admin</option>
                                            <option value="2">Employee</option> --}}
                        </select>
                    </div>

                    <div class="col-md-4 form-group">
                        <label class="text-bold">{{ __('Employment Type') }} <span class="text-danger">*</span></label>
                        <select name="employment_type" id="employment_type" required class="selectpicker form-control"
                            data-live-search="true" data-live-search-style="begins"
                            title="{{ __('Select An Employment Type...') }}" required>
                            <option value="Permanent">{{ __('Permanent') }}</option>
                            <option value="Contactual">{{ __('Contactual') }}</option>
                            <option value="Project-Based">{{ __('Project Based') }}</option>
                            <option value="Temporary">{{ __('Temporary') }}</option>
                        </select>
                    </div>
                    <div class="col-md-4 ">
                        <div class="input-group mb-3">
                            <label class="text-bold">{{ __('Expiry Date(if the employee is not permanent)') }} <span
                            class="text-danger">*</span></label>
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-money" aria-hidden="true"></i> </span>
                            </div>
                            <input type="date" name="expiry_date" id="expiry_date" class="form-control date">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="text-bold">{{ __('Attendance Type') }} <span class="text-danger">*</span></label>
                        <select name="attendance_type" id="attendance_type" required class="selectpicker form-control"
                            data-live-search="true" data-live-search-style="begins"
                            title="{{ __('Select An Attendance Type...') }}">
                            <option value="general">{{ __('General') }}</option>
                            <option value="ip_based">{{ __('IP Based') }}</option>
                        </select>
                    </div>
                    <div class="col-md-4 form-group">
                        <label class="text-bold">{{ __('Staff Type') }} <span class="text-danger">*</span></label>
                        <select name="appointment_letter" class="form-control" required>
                            <option value="">Select Staff Type</option>
                            <option value="management">Management</option>
                            <option value="nonmanagement">Non Management</option>
                        </select>
                    </div>
                    <div class="col-md-4 form-group">
                        <label class="text-bold">{{ __('Salary Type') }} <span class="text-danger">*</span></label>
                        <select name="salary_type" class="form-control" required>
                            <option value="">Select Salary Type</option>
                            <option value="Monthly">Monthly</option>
                            <option value="Hourly">Hourly</option>
                        </select>
                    </div>
                    <div class="col-md-4 ">
                        <div class="input-group mb-3">
                            <label class="text-bold">{{ __('Date Of Joining') }} <span class="text-danger">*</span></label>
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-calendar" aria-hidden="true"></i> </span>
                            </div>
                            <input type="date" name="joining_date" id="joining_date" class="form-control date">
                        </div>
                    </div>

                    <div class="col-md-4 form-group">
                        <label class="text-bold">{{ __('Over Time Type') }} <span class="text-danger">*</span></label>
                        <select name="user_over_time_type" class="form-control">
                            <option value="">Select-A-Overtime-Type</option>
                            <option value="Manual">Manual</option>
                            <option value="Automatic">Automatic</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <label class="text-bold">{{ __('Username') }} <span class="text-danger">*</span></label>
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-user" aria-hidden="true"></i> </span>
                            </div>
                            <input type="text" name="username" id="username"
                            placeholder="{{ __('Unique Value', ['key' => trans('file.Username')]) }}" required
                            class="form-control">
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <label class="text-bold">{{ __('Password') }} <span class="text-danger">*</span></label>
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-key" aria-hidden="true"></i> </span>
                            </div>
                            <input type="password" name="password" id="password" placeholder="{{ __('Password') }}"
                                required class="form-control">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <label class="text-bold">{{ __('Confirm Password') }} <span class="text-danger">*</span></label>
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-key" aria-hidden="true"></i> </span>
                            </div>
                            <input id="confirm_pass" type="password" class="form-control " name="confirm_password"
                                    placeholder="{{ __('Re-type Password') }}" required autocomplete="new-password">
                                    <div class="registrationFormAlert" id="divCheckPasswordMatch">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <label class="text-bold" for="exampleCheck1">Overtime Rate(Times of Basic)</label>
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-money" aria-hidden="true"></i> </span>
                            </div>
                            <input type="text" class="form-control" name="user_over_time_rate" value=""
                            class="form-check-input">
                        </div>
                    </div>
                    <div class="col-md-4 form-group  check-box">
                        <input type="checkbox" name="over_time_payable" value="Yes" class="form-check-input">
                        <label class="text-bold" for="exampleCheck1">Overtime Payable</label>
                    </div>
                    <div class="col-md-4 form-group check-box">
                        <input type="checkbox" name="multi_attendance" value="1" class="form-check-input"
                            id="attendance">
                        <label class="text-bold not-selectable" for="attendance">Multiple Attendance</label>
                    </div>
                    <div class="col-md-4 form-group check-box">
                        <input type="checkbox" name="admin_status" value="Yes" class="form-check-input"
                            id="admin">
                        <label class="text-bold not-selectable" for="admin">Admin Status</label>
                    </div>

                    <div class="col-md-4 form-group check-box">
                        <input type="checkbox" name="is_active" value="1" class="form-check-input" checked>
                        <label class="text-bold" for="exampleCheck1">Is Active</label>
                    </div>

                    <div class="col-md-12">
                        <div class="section-title text-center">
                            <h2>Job Location</h2>
                        </div>
                    </div>

                    <div class="col-md-4 form-group">
                        <label for="" class="text-bold">Region Name:</label>
                        <select name="region_id" id="region_id" class="form-control selectpicker region"
                            data-live-search="true" data-live-search-style="begins" data-dependent="area_name"
                            title="{{ __('Selecting Region name') }}...">
                            @foreach ($regions as $region)
                                <option value="{{ $region->id }}">{{ $region->region_name }}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="" class="text-bold">Area name:</label>

                        <select class="form-control" name="area_id" id="area_id"></select>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="" class="text-bold">Territory Name:</label>

                        <select class="form-control" name="territory_id" id="territory_id"></select>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="" class="text-bold">Town Name:</label>

                        <select class="form-control" name="town_id" id="town_id"></select>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="" class="text-bold">DB House Name:</label>

                        <select class="form-control" name="db_house_id" id="db_house_id"></select>
                    </div>
                    <div class="form-group mt-4 col-md-12">
                        <!-- <input type="submit" name="action_button" id="action_button" class="btn btn-grad w-50"
                            value="{{ __('Update') }}" /> -->

                        <button type="submit" class="btn btn-grad"> <i class="fa fa-plus" aria-hidden="true"></i> Add </button>

                    </div>
                </div>

            </form>
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
