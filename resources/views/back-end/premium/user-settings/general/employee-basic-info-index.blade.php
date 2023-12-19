@extends('back-end.premium.layout.employee-setting-main')

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
    <style>
        .no-vacancy {
            color: red;
        }
    </style>
    <section class="main-contant-section">

        <div class="mb-3">

            @if (Session::get('message'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{!! Session::get('message') !!}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

        </div>

        <div class="mb-3">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>


        <span id="form_result"></span>
        @if (Auth::user()->company_profile == 'Yes' || Auth::user()->userrole->roles_admin_status == 'Yes')

            <section class="forms content-box">
                <div class="employee-basic-information">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card h-100">
                                <div class="content-box">
                                    <div class="profile-information">
                                        <div class="profile-img">
                                            <img src=" {{ asset($employee_profile->profile_photo ?? '') }}"
                                                alt=" https://app.hrsale.com/public/uploads/users/6-small.png">
                                        </div>
                                        <div class="user-info">
                                            <h4> {{ $employee_profile->first_name }} {{ $employee_profile->last_name }}</h4>
                                            <p> {{ $employee_profile->userdesignation->designation_name }} </p>
                                        </div>
                                    </div>
                                    <div class="profile-content">
                                        @if ($add == 1)
                                            <ul>
                                                <li> <a href="{{ route('employee-basic-infos') }}"> <span> Employee
                                                            Information </span> </a> </li>
                                                <li> <a href="#pre_address" data-tab="pre_address" active> Present Address
                                                    </a> </li>
                                                <li> <a href="#par_address" data-tab="par_address"> Parmanent Address </a>
                                                </li>
                                                <li> <a href="#job_location" data-tab="job_location"> <span> Job Location
                                                        </span> </a> </li>
                                                <li> <a href="#company_information" data-tab="company_information"> <span>
                                                            Company Information </span> </a> </li>
                                                <li> <a href="#previous_company_information"
                                                        data-tab="previous_company_information"> <span>
                                                            Previous Company Information </span> </a> </li>
                                                <li> <a href="#parental_information" data-tab="parental_information"> <span>
                                                            Parental Information(English) </span> </a> </li>
                                                <li> <a href="#basic_information_bangla"
                                                        data-tab="basic_information_bangla">
                                                        <span> Employee Basic Information(Bangla) </span> </a> </li>
                                                <li> <a href="#certificate_letter" data-tab="certificate_letter">
                                                        <span> Certificate/ Letter </span> </a>
                                                </li>
                                            </ul>
                                        @else
                                            <ul>
                                                <li> <a href="{{ route('employee-basic-infos') }}"> <span> Employee
                                                            Information </span> </a> </li>
                                                <li> <a href="#pre_address_1" data-tab="pre_address_1" active> Present
                                                        Address </a>
                                                </li>
                                                <li> <a href="#par_address_1" data-tab="par_address_1"> Parmanent Address
                                                    </a>
                                                </li>
                                                <li> <a href="#job_location_1" data-tab="job_location_1"> <span> Job
                                                            Location
                                                        </span> </a> </li>
                                                <li> <a href="#company_information_1" data-tab="company_information_1">
                                                        <span>
                                                            Company Information </span> </a> </li>
                                                <li> <a href="#previous_company_information_1"
                                                        data-tab="previous_company_information_1"> <span>
                                                            Previous Company Information </span> </a> </li>
                                                <li> <a href="#parental_information_1" data-tab="parental_information_1">
                                                        <span>
                                                            Parental Information(English) </span> </a> </li>
                                                <li> <a href="#basic_information_bangla_1"
                                                        data-tab="basic_information_bangla_1">
                                                        <span> Employee Basic
                                                            Information(Bangla) </span> </a> </li>
                                                <li> <a href="#certificate_letter_1" data-tab="certificate_letter_1">
                                                        <span> Certificate/ Letter </span> </a>
                                                </li>
                                            </ul>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="card h-100">
                                <div class="content-box">
                                    <div class="tabList">
                                        <a href="#orange" data-tab="orange" class="">
                                        </a>
                                    </div>
                                    <div class="tab-content">

                                        <div id="orange" class="b-tab active">
                                            <div class="">
                                                @if ($add == 1)
                                                    @foreach ($employee_basic_infos as $employee_basic_infos_value)
                                                        <form method="POST"
                                                            action="{{ route('update-employee-basic-infos') }}"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-md-12 form-group">
                                                                    <div class="card mb-4">
                                                                        <div class="card-header with-border">
                                                                            <h1 class="card-title text-center">
                                                                                {{ __('Employee Basic Information') }} </h1>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">

                                                                        <div class="col-md-4">
                                                                            <input type="hidden" name="id"
                                                                                class="form-control"
                                                                                value="{{ Session::get('employee_setup_id') }}"
                                                                                required />
                                                                            <div class="input-group mb-3">
                                                                                <label><strong>{{ __('ID') }}<span
                                                                                            class="text-danger">*</span></strong></label>
                                                                                <div class="input-group-prepend">
                                                                                    <span class="input-group-text"
                                                                                        id="id"><i
                                                                                            class="fa fa-id-badge"
                                                                                            aria-hidden="true"></i></span>
                                                                                </div>
                                                                                <input type="text"
                                                                                    name="company_assigned_id"
                                                                                    class="form-control"
                                                                                    value="{{ $employee_basic_infos_value->company_assigned_id }}"
                                                                                    readonly />
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-4">
                                                                            <div class="input-group mb-3">
                                                                                <label><strong>{{ __('First Name') }} <span
                                                                                            class="text-danger">*</span></strong></label>
                                                                                <div class="input-group-prepend">
                                                                                    <span class="input-group-text"
                                                                                        id="basic-addon1"> <i
                                                                                            class="fa fa-user"
                                                                                            aria-hidden="true"></i>
                                                                                    </span>
                                                                                </div>
                                                                                <input type="text" name="first_name"
                                                                                    class="form-control"
                                                                                    value="{{ $employee_basic_infos_value->first_name }}"
                                                                                    required />
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-4">
                                                                            <div class="input-group mb-3">
                                                                                <label>
                                                                                    <strong>{{ __('Last Name') }} <span
                                                                                            class="text-danger">*</span></strong>
                                                                                </label>
                                                                                <div class="input-group-prepend">
                                                                                    <span class="input-group-text"
                                                                                        id="basic-addon1"> <i
                                                                                            class="fa fa-user"
                                                                                            aria-hidden="true"></i>
                                                                                    </span>
                                                                                </div>
                                                                                <input type="text" name="last_name"
                                                                                    class="form-control"
                                                                                    value="{{ $employee_basic_infos_value->last_name }}"
                                                                                    required />
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <div class="input-group mb-3">
                                                                                <label><strong>{{ __('Email') }}<span
                                                                                            class="text-danger">*</span></strong></label>
                                                                                <div class="input-group-prepend">
                                                                                    <span class="input-group-text"
                                                                                        id="basic-addon1"> <i
                                                                                            class="fa fa-envelope-o"
                                                                                            aria-hidden="true"></i> </span>
                                                                                </div>
                                                                                <input type="email" name="email"
                                                                                    class="form-control"
                                                                                    value="{{ $employee_basic_infos_value->email }}"
                                                                                    required />
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <div class="input-group mb-3">
                                                                                <label>
                                                                                    <strong>
                                                                                        {{ __('Personal Phone') }} <span
                                                                                            class="text-danger">*</span>
                                                                                    </strong>
                                                                                </label>
                                                                                <div class="input-group-prepend">
                                                                                    <span class="input-group-text"
                                                                                        id="basic-addon1"><i
                                                                                            class="fa fa-volume-control-phone"
                                                                                            aria-hidden="true"></i></span>
                                                                                </div>
                                                                                <input type="text" name="phone"
                                                                                    class="form-control"
                                                                                    value="{{ $employee_basic_infos_value->phone }}"
                                                                                    required />
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <div class="input-group mb-3">
                                                                                <label><strong>{{ __('Business Phone') }}
                                                                                        <span
                                                                                            class="text-danger">*</span></strong></label>
                                                                                <div class="input-group-prepend">
                                                                                    <span class="input-group-text"
                                                                                        id="basic-addon1"> <i
                                                                                            class="fa fa-phone"
                                                                                            aria-hidden="true"></i>
                                                                                    </span>
                                                                                </div>
                                                                                <input type="text" name="b_phone"
                                                                                    class="form-control"
                                                                                    value="{{ $employee_basic_infos_value->b_phone }}" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <div class="input-group mb-3">
                                                                                <label><strong>{{ __('User Name') }} <span
                                                                                            class="text-danger">*</span></strong></label>
                                                                                <div class="input-group-prepend">
                                                                                    <span class="input-group-text"
                                                                                        id="basic-addon1"> <i
                                                                                            class="fa fa-phone"
                                                                                            aria-hidden="true"></i>
                                                                                    </span>
                                                                                </div>
                                                                                <input type="text" name="username"
                                                                                    class="form-control"
                                                                                    value="{{ $employee_basic_infos_value->username }}" />
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-6">
                                                                            <div class="input-group mb-3">
                                                                                <label><strong>{{ __('Birth Place') }}
                                                                                        <span
                                                                                            class="text-danger">*</span></strong></label>
                                                                                <div class="input-group-prepend">
                                                                                    <span class="input-group-text"
                                                                                        id="basic-addon1"> <i
                                                                                            class="fa fa-map-marker"
                                                                                            aria-hidden="true"></i> </span>
                                                                                </div>
                                                                                <input name="birth_place"
                                                                                    class="form-control"
                                                                                    value="{{ $employee_basic_infos_value->emoloyeedetail->birth_place ?? '' }}"
                                                                                    placeholder="Enter Birth Place" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="input-group mb-3">
                                                                                <label><strong>{{ __('Date of birth') }}<span
                                                                                            class="text-danger">*</span></strong></label>
                                                                                <div class="input-group-prepend">
                                                                                    <span class="input-group-text"
                                                                                        id="basic-addon1"> <i
                                                                                            class="fa fa-calendar"
                                                                                            aria-hidden="true"></i> </span>
                                                                                </div>
                                                                                <input type="date" name="date_of_birth"
                                                                                    class="form-control"
                                                                                    value="{{ $employee_basic_infos_value->date_of_birth }}"
                                                                                    required />
                                                                            </div>
                                                                        </div>


                                                                        <div class="col-md-4">
                                                                            <div class="input-group mb-3">
                                                                                <label><strong>{{ __('Gender') }}<span
                                                                                            class="text-danger">*</span></strong></label>
                                                                                <select name="gender" required
                                                                                    class="form-control">
                                                                                    <option value="">Choose a Gender
                                                                                    </option>
                                                                                    <option value="Male"
                                                                                        <?php if ($employee_basic_infos_value->gender == 'Male') {
                                                                                            echo 'selected="selected"';
                                                                                        } ?>>
                                                                                        {{ __('Male') }}
                                                                                    </option>
                                                                                    <option value="Female"
                                                                                        <?php if ($employee_basic_infos_value->gender == 'Female') {
                                                                                            echo 'selected="selected"';
                                                                                        } ?>>
                                                                                        {{ __('Female') }}
                                                                                    </option>
                                                                                    <option value="Other"
                                                                                        <?php if ($employee_basic_infos_value->gender == 'Other') {
                                                                                            echo 'selected="selected"';
                                                                                        } ?>>
                                                                                        {{ __('Other') }}
                                                                                    </option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label><strong>{{ __('Blood Group') }}
                                                                                        <span
                                                                                            class="text-danger">*</span></strong></label>
                                                                                <select name="blood_group" required
                                                                                    class="form-control">
                                                                                    <option value="">Choose a Blood
                                                                                        Group
                                                                                    </option>
                                                                                    <option value="A+"
                                                                                        <?php if ($employee_basic_infos_value->blood_group == 'A+') {
                                                                                            echo 'selected="selected"';
                                                                                        } ?>>
                                                                                        {{ __('A Positive') }}
                                                                                    </option>
                                                                                    <option value="A-"
                                                                                        <?php if ($employee_basic_infos_value->blood_group == 'A-') {
                                                                                            echo 'selected="selected"';
                                                                                        } ?>>
                                                                                        {{ __('A Negative') }}
                                                                                    </option>
                                                                                    <option value="B+"
                                                                                        <?php if ($employee_basic_infos_value->blood_group == 'B+') {
                                                                                            echo 'selected="selected"';
                                                                                        } ?>>
                                                                                        {{ __('B Positive') }}
                                                                                    </option>
                                                                                    <option value="B-"
                                                                                        <?php if ($employee_basic_infos_value->blood_group == 'B-') {
                                                                                            echo 'selected="selected"';
                                                                                        } ?>>
                                                                                        {{ __('B Negative') }}
                                                                                    </option>
                                                                                    <option value="AB+"
                                                                                        <?php if ($employee_basic_infos_value->blood_group == 'AB+') {
                                                                                            echo 'selected="selected"';
                                                                                        } ?>>
                                                                                        {{ __('AB Positive') }}</option>
                                                                                    <option value="AB-"
                                                                                        <?php if ($employee_basic_infos_value->blood_group == 'AB-') {
                                                                                            echo 'selected="selected"';
                                                                                        } ?>>
                                                                                        {{ __('AB Negative') }}</option>
                                                                                    <option value="O+"
                                                                                        <?php if ($employee_basic_infos_value->blood_group == 'O+') {
                                                                                            echo 'selected="selected"';
                                                                                        } ?>>
                                                                                        {{ __('O Positive') }}
                                                                                    </option>
                                                                                    <option value="O-"
                                                                                        <?php if ($employee_basic_infos_value->blood_group == 'O-') {
                                                                                            echo 'selected="selected"';
                                                                                        } ?>>
                                                                                        {{ __('O Negative') }}
                                                                                    </option>
                                                                                    <option value="unkown"
                                                                                        <?php if ($employee_basic_infos_value->blood_group == 'unkown') {
                                                                                            echo 'selected="selected"';
                                                                                        } ?>>
                                                                                        {{ __('Unknown') }}
                                                                                    </option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label
                                                                                    class="text-bold">{{ __('Religion') }}
                                                                                    <span
                                                                                        class="text-danger">*</span></label>
                                                                                <select class="form-control"
                                                                                    name="religion" required>
                                                                                    <option value=""
                                                                                        selected="selected"
                                                                                        disabled="disabled">--
                                                                                        select one --
                                                                                    </option>
                                                                                    <option value="Islam">
                                                                                        Islam</option>
                                                                                    <option value="Hinduism">
                                                                                        Hinduism</option>
                                                                                    <option value="Buddhism">
                                                                                        Buddhism</option>
                                                                                    <option value="Christianity">
                                                                                        Christianity
                                                                                    </option>
                                                                                    <option value="Other">Other</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label
                                                                                    class="text-bold">{{ __('Identification Type') }}
                                                                                    <span
                                                                                        class="text-danger">*</span></label>

                                                                                <select class="form-control"
                                                                                    name="identification_type">
                                                                                    <option value="">--
                                                                                        select one --
                                                                                    </option>
                                                                                    <option value="nid">NID
                                                                                        Number</option>
                                                                                    <option value="birthcertificate">Birth
                                                                                        Certificate Number</option>
                                                                                    <option value="passport-number">
                                                                                        Passport
                                                                                        Number
                                                                                    </option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="input-group mb-3">
                                                                                <label for=""
                                                                                    class="text-bold">Identification
                                                                                    Number</label>
                                                                                <div class="input-group-prepend">
                                                                                    <span class="input-group-text"
                                                                                        id="basic-addon1"> <i
                                                                                            class="fa fa-id-card-o"
                                                                                            aria-hidden="true"></i> </span>
                                                                                </div>
                                                                                <input type="text"
                                                                                    name="identification_number"
                                                                                    id="identification_number"
                                                                                    value="" class="form-control" />
                                                                            </div>
                                                                            <span id="identification_number_error"></span>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label class="text-bold">Marital Status
                                                                                    <span
                                                                                        class="text-danger">*</span></label>
                                                                                <select class="form-control"
                                                                                    name="marital_status" required>
                                                                                    <option value="">--
                                                                                        select one --
                                                                                    </option>
                                                                                    <option value="Unmarried">
                                                                                        Unmarried</option>
                                                                                    <option value="Married">
                                                                                        Married</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label><strong>{{ __('Nationality') }}<span
                                                                                            class="text-danger">*</span></strong></label>
                                                                                <select name="nationality_id"
                                                                                    class="form-control" required>
                                                                                    <option value=""> Select
                                                                                        Nationality
                                                                                    </option>
                                                                                    @foreach ($nationalities as $nationality)
                                                                                        <option
                                                                                            value="{{ $nationality->id }}">
                                                                                            {{ $nationality->name }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>


                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label><strong>{{ __('Replacement Employee Name') }}<span
                                                                                            class="text-danger">*</span></strong></label>
                                                                                <select name="replace_employee_id"
                                                                                    class="form-control">
                                                                                    <option value=""> Select Employee
                                                                                    </option>
                                                                                    @foreach ($inactive_users as $inactive_user)
                                                                                        <option
                                                                                            value="{{ $inactive_user->id }}"
                                                                                            {{ $inactive_user->id == $employee_basic_infos_value->replace_employee_id ? 'selected' : '' }}>
                                                                                            {{ $inactive_user->first_name }}{{ $inactive_user->last_name }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for="website">
                                                                                    Appointment Letter Format<span
                                                                                        class="text-danger">*</span></label>
                                                                                <div class="input-group">
                                                                                    <div class="input-group-prepend"></div>
                                                                                    <select
                                                                                        name="appointment_letter_format_id"
                                                                                        class="form-control">
                                                                                        <option value="">
                                                                                            {{ __('Select Appointment
                                                                                                                                                                        Letter Format...') }}
                                                                                        </option>

                                                                                        @foreach ($appointment_letter_formats as $appointment_letter_format)
                                                                                            <option
                                                                                                value="{{ $appointment_letter_format->id }}"
                                                                                                {{ $appointment_letter_format->id == $employee_basic_infos_value->appointment_letter_format_id
                                                                                                    ? 'selected'
                                                                                                    : '' }}>
                                                                                                {{ $appointment_letter_format->appointment_template_subject }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for="website"> Image</label>
                                                                                <div class="input-group">
                                                                                    <div class="input-group-prepend"></div>
                                                                                    <input type="file"
                                                                                        class="form-control @error('photo') is-invalid @enderror"
                                                                                        name="profile_photo">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-12 mt-4">
                                                                    <div class="form-group">
                                                                        <input type="submit" id="submit"
                                                                            value="{{ __('Submit') }}"
                                                                            class="btn btn-grad">
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </form>
                                                    @endforeach
                                                @else
                                                    @foreach ($employee_basic_infos as $employee_basic_infos_value)
                                                        <form method="POST"
                                                            action="{{ route('update-employee-basic-infos') }}"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-md-12 form-group">
                                                                    <div class="card mb-4">
                                                                        <div class="card-header with-border">
                                                                            <h1 class="card-title text-center">
                                                                                {{ __('Employee Basic Information') }}
                                                                            </h1>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">

                                                                        <div class="col-md-4">
                                                                            <input type="hidden" name="id"
                                                                                class="form-control"
                                                                                value="{{ Session::get('employee_setup_id') }}"
                                                                                required />
                                                                            <div class="input-group mb-3">
                                                                                <label><strong>{{ __('ID') }}<span
                                                                                            class="text-danger">*</span></strong></label>
                                                                                <div class="input-group-prepend">
                                                                                    <span class="input-group-text"
                                                                                        id="id"><i
                                                                                            class="fa fa-id-badge"
                                                                                            aria-hidden="true"></i></span>
                                                                                </div>
                                                                                <input type="text"
                                                                                    name="company_assigned_id"
                                                                                    class="form-control"
                                                                                    value="{{ $employee_basic_infos_value->company_assigned_id }}"
                                                                                    readonly />
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-4">
                                                                            <div class="input-group mb-3">
                                                                                <label><strong>{{ __('First Name') }} <span
                                                                                            class="text-danger">*</span></strong></label>
                                                                                <div class="input-group-prepend">
                                                                                    <span class="input-group-text"
                                                                                        id="basic-addon1"> <i
                                                                                            class="fa fa-user"
                                                                                            aria-hidden="true"></i>
                                                                                    </span>
                                                                                </div>
                                                                                <input type="text" name="first_name"
                                                                                    class="form-control"
                                                                                    value="{{ $employee_basic_infos_value->first_name }}"
                                                                                    required />
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-4">
                                                                            <div class="input-group mb-3">
                                                                                <label>
                                                                                    <strong>{{ __('Last Name') }} <span
                                                                                            class="text-danger">*</span></strong>
                                                                                </label>
                                                                                <div class="input-group-prepend">
                                                                                    <span class="input-group-text"
                                                                                        id="basic-addon1"> <i
                                                                                            class="fa fa-user"
                                                                                            aria-hidden="true"></i>
                                                                                    </span>
                                                                                </div>
                                                                                <input type="text" name="last_name"
                                                                                    class="form-control"
                                                                                    value="{{ $employee_basic_infos_value->last_name }}"
                                                                                    required />
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <div class="input-group mb-3">
                                                                                <label><strong>{{ __('Email') }}<span
                                                                                            class="text-danger">*</span></strong></label>
                                                                                <div class="input-group-prepend">
                                                                                    <span class="input-group-text"
                                                                                        id="basic-addon1"> <i
                                                                                            class="fa fa-envelope-o"
                                                                                            aria-hidden="true"></i> </span>
                                                                                </div>
                                                                                <input type="email" name="email"
                                                                                    class="form-control"
                                                                                    value="{{ $employee_basic_infos_value->email }}"
                                                                                    required />
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <div class="input-group mb-3">
                                                                                <label>
                                                                                    <strong>
                                                                                        {{ __('Personal Phone') }} <span
                                                                                            class="text-danger">*</span>
                                                                                    </strong>
                                                                                </label>
                                                                                <div class="input-group-prepend">
                                                                                    <span class="input-group-text"
                                                                                        id="basic-addon1"><i
                                                                                            class="fa fa-volume-control-phone"
                                                                                            aria-hidden="true"></i></span>
                                                                                </div>
                                                                                <input type="text" name="phone"
                                                                                    class="form-control"
                                                                                    value="{{ $employee_basic_infos_value->phone }}"
                                                                                    required />
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <div class="input-group mb-3">
                                                                                <label><strong>{{ __('Business Phone') }}
                                                                                        <span
                                                                                            class="text-danger">*</span></strong></label>
                                                                                <div class="input-group-prepend">
                                                                                    <span class="input-group-text"
                                                                                        id="basic-addon1"> <i
                                                                                            class="fa fa-phone"
                                                                                            aria-hidden="true"></i>
                                                                                    </span>
                                                                                </div>
                                                                                <input type="text" name="b_phone"
                                                                                    class="form-control"
                                                                                    value="{{ $employee_basic_infos_value->b_phone }}" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <div class="input-group mb-3">
                                                                                <label><strong>{{ __('User Name') }} <span
                                                                                            class="text-danger">*</span></strong></label>
                                                                                <div class="input-group-prepend">
                                                                                    <span class="input-group-text"
                                                                                        id="basic-addon1"> <i
                                                                                            class="fa fa-user"
                                                                                            aria-hidden="true"></i>
                                                                                    </span>
                                                                                </div>
                                                                                <input type="text" name="username"
                                                                                    class="form-control"
                                                                                    value="{{ $employee_basic_infos_value->username }}" />
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-6">
                                                                            <div class="input-group mb-3">
                                                                                <label><strong>{{ __('Birth Place') }}
                                                                                        <span
                                                                                            class="text-danger">*</span></strong></label>
                                                                                <div class="input-group-prepend">
                                                                                    <span class="input-group-text"
                                                                                        id="basic-addon1"> <i
                                                                                            class="fa fa-map-marker"
                                                                                            aria-hidden="true"></i> </span>
                                                                                </div>
                                                                                <input name="birth_place"
                                                                                    class="form-control"
                                                                                    value="{{ $employee_basic_infos_value->emoloyeedetail->birth_place ?? '' }}"
                                                                                    placeholder="Enter Birth Place" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="input-group mb-3">
                                                                                <label><strong>{{ __('Date of birth') }}<span
                                                                                            class="text-danger">*</span></strong></label>
                                                                                <div class="input-group-prepend">
                                                                                    <span class="input-group-text"
                                                                                        id="basic-addon1"> <i
                                                                                            class="fa fa-calendar"
                                                                                            aria-hidden="true"></i> </span>
                                                                                </div>
                                                                                <input type="date" name="date_of_birth"
                                                                                    class="form-control"
                                                                                    value="{{ $employee_basic_infos_value->date_of_birth }}"
                                                                                    required />
                                                                            </div>
                                                                        </div>


                                                                        <div class="col-md-4">
                                                                            <div class="input-group mb-3">
                                                                                <label><strong>{{ __('Gender') }}<span
                                                                                            class="text-danger">*</span></strong></label>
                                                                                <select name="gender" required
                                                                                    class="form-control">
                                                                                    <option value="">Choose a Gender
                                                                                    </option>
                                                                                    <option value="Male"
                                                                                        <?php if ($employee_basic_infos_value->gender == 'Male') {
                                                                                            echo 'selected="selected"';
                                                                                        } ?>>
                                                                                        {{ __('Male') }}
                                                                                    </option>
                                                                                    <option value="Female"
                                                                                        <?php if ($employee_basic_infos_value->gender == 'Female') {
                                                                                            echo 'selected="selected"';
                                                                                        } ?>>
                                                                                        {{ __('Female') }}
                                                                                    </option>
                                                                                    <option value="Other"
                                                                                        <?php if ($employee_basic_infos_value->gender == 'Other') {
                                                                                            echo 'selected="selected"';
                                                                                        } ?>>
                                                                                        {{ __('Other') }}
                                                                                    </option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label><strong>{{ __('Blood Group') }}
                                                                                        <span
                                                                                            class="text-danger">*</span></strong></label>
                                                                                <select name="blood_group" required
                                                                                    class="form-control">
                                                                                    <option value="">Choose a Blood
                                                                                        Group
                                                                                    </option>
                                                                                    <option value="A+"
                                                                                        <?php if ($employee_basic_infos_value->blood_group == 'A+') {
                                                                                            echo 'selected="selected"';
                                                                                        } ?>>
                                                                                        {{ __('A Positive') }}
                                                                                    </option>
                                                                                    <option value="A-"
                                                                                        <?php if ($employee_basic_infos_value->blood_group == 'A-') {
                                                                                            echo 'selected="selected"';
                                                                                        } ?>>
                                                                                        {{ __('A Negative') }}
                                                                                    </option>
                                                                                    <option value="B+"
                                                                                        <?php if ($employee_basic_infos_value->blood_group == 'B+') {
                                                                                            echo 'selected="selected"';
                                                                                        } ?>>
                                                                                        {{ __('B Positive') }}
                                                                                    </option>
                                                                                    <option value="B-"
                                                                                        <?php if ($employee_basic_infos_value->blood_group == 'B-') {
                                                                                            echo 'selected="selected"';
                                                                                        } ?>>
                                                                                        {{ __('B Negative') }}
                                                                                    </option>
                                                                                    <option value="AB+"
                                                                                        <?php if ($employee_basic_infos_value->blood_group == 'AB+') {
                                                                                            echo 'selected="selected"';
                                                                                        } ?>>
                                                                                        {{ __('AB Positive') }}</option>
                                                                                    <option value="AB-"
                                                                                        <?php if ($employee_basic_infos_value->blood_group == 'AB-') {
                                                                                            echo 'selected="selected"';
                                                                                        } ?>>
                                                                                        {{ __('AB Negative') }}</option>
                                                                                    <option value="O+"
                                                                                        <?php if ($employee_basic_infos_value->blood_group == 'O+') {
                                                                                            echo 'selected="selected"';
                                                                                        } ?>>
                                                                                        {{ __('O Positive') }}
                                                                                    </option>
                                                                                    <option value="O-"
                                                                                        <?php if ($employee_basic_infos_value->blood_group == 'O-') {
                                                                                            echo 'selected="selected"';
                                                                                        } ?>>
                                                                                        {{ __('O Negative') }}
                                                                                    </option>
                                                                                    <option value="unkown"
                                                                                        <?php if ($employee_basic_infos_value->blood_group == 'unkown') {
                                                                                            echo 'selected="selected"';
                                                                                        } ?>>
                                                                                        {{ __('Unknown') }}
                                                                                    </option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label
                                                                                    class="text-bold">{{ __('Religion') }}
                                                                                    <span
                                                                                        class="text-danger">*</span></label>
                                                                                <select class="form-control"
                                                                                    name="religion" required>
                                                                                    <option value=""
                                                                                        selected="selected"
                                                                                        disabled="disabled">--
                                                                                        select one --
                                                                                    </option>
                                                                                    <option value="Islam"
                                                                                        <?php if ($employee_basic_infos_value->emoloyeedetail->religion == 'Islam') {
                                                                                            echo 'selected="selected"';
                                                                                        } ?>>
                                                                                        Islam</option>
                                                                                    <option value="Hinduism"
                                                                                        <?php if ($employee_basic_infos_value->emoloyeedetail->religion == 'Hinduism') {
                                                                                            echo 'selected="selected"';
                                                                                        } ?>>
                                                                                        Hinduism</option>
                                                                                    <option value="Buddhism"
                                                                                        <?php if ($employee_basic_infos_value->emoloyeedetail->religion == 'Buddhism') {
                                                                                            echo 'selected="selected"';
                                                                                        } ?>>
                                                                                        Buddhism</option>
                                                                                    <option value="Christianity"
                                                                                        <?php if ($employee_basic_infos_value->emoloyeedetail->religion == 'Christianity') {
                                                                                            echo 'selected="selected"';
                                                                                        } ?>>Christianity
                                                                                    </option>
                                                                                    <option value="Other"
                                                                                        <?php if ($employee_basic_infos_value->emoloyeedetail->religion == 'Other') {
                                                                                            echo 'selected="selected"';
                                                                                        } ?>>Other</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label
                                                                                    class="text-bold">{{ __('Identification Type') }}
                                                                                    <span
                                                                                        class="text-danger">*</span></label>

                                                                                <select class="form-control"
                                                                                    name="identification_type">
                                                                                    <option value="">--
                                                                                        select one --
                                                                                    </option>
                                                                                    <option value="nid"
                                                                                        <?php if ($employee_basic_infos_value->emoloyeedetail->identification_type == 'nid') {
                                                                                            echo 'selected="selected"';
                                                                                        } ?>>NID
                                                                                        Number</option>
                                                                                    <option value="birthcertificate"
                                                                                        <?php if ($employee_basic_infos_value->emoloyeedetail->identification_type == 'birthcertificate') {
                                                                                            echo 'selected="selected"';
                                                                                        } ?>>Birth
                                                                                        Certificate Number</option>
                                                                                    <option value="passport-number"
                                                                                        <?php if ($employee_basic_infos_value->emoloyeedetail->identification_type == 'passport-number') {
                                                                                            echo 'selected="selected"';
                                                                                        } ?>>Passport
                                                                                        Number
                                                                                    </option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="input-group mb-3">
                                                                                <label for=""
                                                                                    class="text-bold">Identification
                                                                                    Number</label>
                                                                                <div class="input-group-prepend">
                                                                                    <span class="input-group-text"
                                                                                        id="basic-addon1"> <i
                                                                                            class="fa fa-id-card-o"
                                                                                            aria-hidden="true"></i> </span>
                                                                                </div>
                                                                                <input type="text"
                                                                                    name="identification_number"
                                                                                    id="identification_number"
                                                                                    value="{{ $employee_basic_infos_value->emoloyeedetail->identification_number }}"
                                                                                    class="form-control" />
                                                                            </div>
                                                                            <span id="identification_number_error"></span>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label class="text-bold">Marital Status
                                                                                    <span
                                                                                        class="text-danger">*</span></label>
                                                                                <select class="form-control"
                                                                                    name="marital_status" required>
                                                                                    <option value="">--
                                                                                        select one --
                                                                                    </option>
                                                                                    <option value="Unmarried"
                                                                                        <?php if ($employee_basic_infos_value->emoloyeedetail->marital_status == 'Unmarried') {
                                                                                            echo 'selected="selected"';
                                                                                        } ?>>
                                                                                        Unmarried</option>
                                                                                    <option value="Married"
                                                                                        <?php if ($employee_basic_infos_value->emoloyeedetail->marital_status == 'Married') {
                                                                                            echo 'selected="selected"';
                                                                                        } ?>>
                                                                                        Married</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label><strong>{{ __('Nationality') }}<span
                                                                                            class="text-danger">*</span></strong></label>
                                                                                <select name="nationality_id"
                                                                                    class="form-control" required>
                                                                                    <option value=""> Select
                                                                                        Nationality
                                                                                    </option>
                                                                                    @foreach ($nationalities as $nationality)
                                                                                        <option
                                                                                            value="{{ $nationality->id }}"
                                                                                            {{ $nationality->id == $employee_basic_infos_value->emoloyeedetail->nationality_id ? 'selected' : '' }}>
                                                                                            {{ $nationality->name }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label><strong>{{ __('Replacement Employee Name') }}<span
                                                                                            class="text-danger">*</span></strong></label>
                                                                                <select name="replace_employee_id"
                                                                                    class="form-control">
                                                                                    <option value=""> Select Employee
                                                                                    </option>
                                                                                    @foreach ($inactive_users as $inactive_user)
                                                                                        <option
                                                                                            value="{{ $inactive_user->id }}"
                                                                                            {{ $inactive_user->id == $employee_basic_infos_value->replace_employee_id ? 'selected' : '' }}>
                                                                                            {{ $inactive_user->first_name }}{{ $inactive_user->last_name }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for="website">
                                                                                    Appointment Letter Format<span
                                                                                        class="text-danger">*</span></label>
                                                                                <div class="input-group">
                                                                                    <div class="input-group-prepend"></div>
                                                                                    <select
                                                                                        name="appointment_letter_format_id"
                                                                                        class="form-control">
                                                                                        <option value="">
                                                                                            {{ __('Select Appointment
                                                                                                                                                                        Letter Format...') }}
                                                                                        </option>
                                                                                        @foreach ($appointment_letter_formats as $appointment_letter_format)
                                                                                            <option
                                                                                                value="{{ $appointment_letter_format->id }}"
                                                                                                {{ $appointment_letter_format->id == $employee_basic_infos_value->appointment_letter_format_id
                                                                                                    ? 'selected'
                                                                                                    : '' }}>
                                                                                                {{ $appointment_letter_format->appointment_template_subject }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>



                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for="website">Image</label>
                                                                                <div class="input-group">
                                                                                    <div class="input-group-prepend"></div>
                                                                                    <input type="file"
                                                                                        class="form-control @error('photo') is-invalid @enderror"
                                                                                        name="profile_photo">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12 mt-4">
                                                                    <div class="form-group">
                                                                        <input type="submit" id="submit"
                                                                            value="{{ __('Submit') }}"
                                                                            class="btn btn-grad">
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </form>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        @if ($add == 1)
                                            <div id="pre_address" class="b-tab">
                                                <div class="content-box">
                                                    @foreach ($employee_basic_infos as $employee_basic_infos_value)
                                                        <form method="POST"
                                                            action="{{ route('update-employee-present-address') }}"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="id" class="form-control"
                                                                value="{{ Session::get('employee_setup_id') }}"
                                                                required />

                                                            <div class="row">
                                                                <div class="col-md-12 form-group">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="card mb-4">
                                                                                <div class="card-header with-border">
                                                                                    <h1 class="card-title text-center">
                                                                                        {{ __('Present Address(English)') }}
                                                                                    </h1>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for=""
                                                                                    class="text-bold">Division
                                                                                    Name:<span
                                                                                        class="text-danger">*</span></label>
                                                                                <select name="present_division_id"
                                                                                    id="present_division_id"
                                                                                    class="form-control selectpicker region"
                                                                                    data-live-search="true"
                                                                                    data-live-search-style="begins"
                                                                                    data-dependent="area_name"
                                                                                    title="{{ __('Selecting Division name') }}..."
                                                                                    required>
                                                                                    @foreach ($divisions as $division)
                                                                                        <option
                                                                                            value="{{ $division->id }}">
                                                                                            {{ $division->dv_name }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for=""
                                                                                    class="text-bold">District
                                                                                    Name:<span
                                                                                        class="text-danger">*</span></label>
                                                                                <select class="form-control"
                                                                                    name="present_district_id"
                                                                                    id="present_district_id" required>
                                                                                    <option value="">Select District
                                                                                    </option>
                                                                                    @foreach ($districts as $district)
                                                                                        <option
                                                                                            value="{{ $district->id }}">
                                                                                            {{ $district->dist_name }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="input-group mb-3">
                                                                                <label for=""
                                                                                    class="text-bold">City
                                                                                    Corporation Name:</label>
                                                                                <div class="input-group-prepend">
                                                                                    <span class="input-group-text"
                                                                                        id="basic-addon1"> <i
                                                                                            class="fa fa-linode"
                                                                                            aria-hidden="true"></i>
                                                                                    </span>
                                                                                </div>
                                                                                <input type="text"
                                                                                    name="present_city_corporation"
                                                                                    class="form-control" value="">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class=" form-group">
                                                                                <label for=""
                                                                                    class="text-bold">Upazila
                                                                                    Name:</label>

                                                                                <select class="form-control"
                                                                                    name="present_upazila_id"
                                                                                    id="present_upazila_id">
                                                                                    <option value="">Select Upzila
                                                                                    </option>
                                                                                    @foreach ($upzillas as $upzilla)
                                                                                        <option
                                                                                            value="{{ $upzilla->id }}">
                                                                                            {{ $upzilla->up_name }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for=""
                                                                                    class="text-bold">Union
                                                                                    Name:</label>
                                                                                <select class="form-control"
                                                                                    name="present_union_id"
                                                                                    id="present_union_id">
                                                                                    <option value="">Select Union
                                                                                    </option>
                                                                                    @foreach ($unions as $union)
                                                                                        <option
                                                                                            value="{{ $union->id }}">
                                                                                            {{ $union->un_name }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for=""
                                                                                    class="text-bold">Ward
                                                                                    No:</label>
                                                                                <input type="text"
                                                                                    name="present_ward_no"
                                                                                    class="form-control" value="">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for=""
                                                                                    class="text-bold">Sadar:</label>
                                                                                <input type="text" name="present_sadar"
                                                                                    class="form-control" value="">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for=""
                                                                                    class="text-bold">Pourosova:</label>
                                                                                <input type="text"
                                                                                    name="present_pourosova"
                                                                                    class="form-control" value="">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label><strong>{{ __('Village Name/House No,Block No,
                                                                                                                                                        Road No') }}
                                                                                    </strong></label>
                                                                                <input type="text"
                                                                                    name="present_village"
                                                                                    class="form-control" value=""
                                                                                    placeholder="Village Name"
                                                                                    value="" required />
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label><strong>{{ __('Postal Area') }}
                                                                                    </strong><span
                                                                                        class="text-danger">*</span></label>
                                                                                <input type="text"
                                                                                    name="present_postal_area"
                                                                                    class="form-control" value=""
                                                                                    placeholder="Postal Area"
                                                                                    value="" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label><strong>{{ __('Postal Code') }}
                                                                                    </strong></label>
                                                                                <input type="number"
                                                                                    name="present_postal_code"
                                                                                    class="form-control" value=""
                                                                                    placeholder="Postal Area"
                                                                                    value="" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12 mt-4">
                                                                    <div class="form-group ">
                                                                        <input type="submit" id="submit"
                                                                            value="{{ __('Submit') }}"
                                                                            class="btn btn-grad">
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </form>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div id="par_address" class="b-tab">
                                                <div class="content-box">
                                                    @foreach ($employee_basic_infos as $employee_basic_infos_value)
                                                        <form method="POST"
                                                            action="{{ route('update-employee-permanent-address') }}"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="id" class="form-control"
                                                                value="{{ Session::get('employee_setup_id') }}"
                                                                required />
                                                            <div class="row">
                                                                <div class="col-md-12 form-group">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="card mb-4">
                                                                                <div class="card-header with-border">
                                                                                    <h1 class="card-title text-center">
                                                                                        {{ __('Parmanent Address(English)') }}
                                                                                    </h1>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for=""
                                                                                    class="text-bold">Division
                                                                                    Name:<span
                                                                                        class="text-danger">*</span></label>
                                                                                <select name="division_id"
                                                                                    id="division_id"
                                                                                    class="form-control selectpicker region"
                                                                                    data-live-search="true"
                                                                                    data-live-search-style="begins"
                                                                                    data-dependent="area_name"
                                                                                    title="{{ __('Selecting Division name') }}..."
                                                                                    required>
                                                                                    @foreach ($divisions as $division)
                                                                                        <option
                                                                                            value="{{ $division->id }}">
                                                                                            {{ $division->dv_name }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for=""
                                                                                    class="text-bold">District
                                                                                    Name:<span
                                                                                        class="text-danger">*</span></label>
                                                                                <select class="form-control"
                                                                                    name="district_id" id="district_id"
                                                                                    required>
                                                                                    <option value="">Select District
                                                                                    </option>
                                                                                    @foreach ($districts as $district)
                                                                                        <option
                                                                                            value="{{ $district->id }}">
                                                                                            {{ $district->dist_name }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="input-group mb-3">
                                                                                <label for=""
                                                                                    class="text-bold">City
                                                                                    Corporation Name:</label>
                                                                                <div class="input-group-prepend">
                                                                                    <span class="input-group-text"
                                                                                        id="basic-addon1"> <i
                                                                                            class="fa fa-linode"
                                                                                            aria-hidden="true"></i>
                                                                                    </span>
                                                                                </div>
                                                                                <input type="text"
                                                                                    name="city_corporation"
                                                                                    class="form-control" value="">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for=""
                                                                                    class="text-bold">Upazila
                                                                                    Name:</label>

                                                                                <select class="form-control"
                                                                                    name="upazila_id" id="upazila_id">
                                                                                    <option value="">Select Upzila
                                                                                    </option>
                                                                                    @foreach ($upzillas as $upzilla)
                                                                                        <option
                                                                                            value="{{ $upzilla->id }}">
                                                                                            {{ $upzilla->up_name }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>



                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for=""
                                                                                    class="text-bold">Union
                                                                                    Name:</label>

                                                                                <select class="form-control"
                                                                                    name="union_id" id="union_id">
                                                                                    <option value="">Select Union
                                                                                    </option>
                                                                                    @foreach ($unions as $union)
                                                                                        <option
                                                                                            value="{{ $union->id }}">
                                                                                            {{ $union->un_name }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for=""
                                                                                    class="text-bold">Ward
                                                                                    No:</label>
                                                                                <input type="text" name="ward_no"
                                                                                    class="form-control" value="">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for=""
                                                                                    class="text-bold">Sadar:</label>
                                                                                <input type="text" name="sadar"
                                                                                    class="form-control" value="">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for=""
                                                                                    class="text-bold">Pourosova
                                                                                    :</label>
                                                                                <input type="text" name="poursova"
                                                                                    class="form-control" value="">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label><strong>{{ __('Postal Area') }}
                                                                                    </strong></label>
                                                                                <input type="text" name="postal_area"
                                                                                    class="form-control"
                                                                                    placeholder="Postal Area"
                                                                                    value="" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label><strong>{{ __('Postal Code') }}
                                                                                    </strong></label>
                                                                                <input type="number" name="postal_code"
                                                                                    class="form-control"
                                                                                    placeholder="Postal Area"
                                                                                    value="" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label><strong>{{ __('Village Name/House No, Block No,
                                                                                                                                                        Road No') }}
                                                                                    </strong><span
                                                                                        class="text-danger">*</span></label>
                                                                                <input type="text" name="village"
                                                                                    class="form-control"
                                                                                    placeholder="Village Name"
                                                                                    value="" required />
                                                                            </div>
                                                                        </div>



                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12 mt-4">
                                                                    <div class="form-group ">
                                                                        <input type="submit" id="submit"
                                                                            value="{{ __('Submit') }}"
                                                                            class="btn btn-grad">
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </form>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div id="job_location" class="b-tab">
                                                <div class="content-box">
                                                    @foreach ($employee_basic_infos as $employee_basic_infos_value)
                                                        <form method="POST"
                                                            action="{{ route('update-employee-job-location') }}"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="id" class="form-control"
                                                                value="{{ Session::get('employee_setup_id') }}"
                                                                required />
                                                            <div class="row">

                                                                <div class="col-md-12">
                                                                    <div class="card mb-4">
                                                                        <div class="card-header with-border">
                                                                            <h1 class="card-title text-center">
                                                                                {{ __('Job Location') }} </h1>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                                                                                'json_contains(package_module,
                                                                                                                        \'["' .
                                                                                    $organization_sub_module_four .
                                                                                    '"]\')')->exists())
                                                                        @if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                                                                                    'json_contains(permission_content,
                                                                                                                            \'["' .
                                                                                        $organization_sub_module_four .
                                                                                        '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                                                                            <div class="form-group">
                                                                                <label for=""
                                                                                    class="text-bold">{{ $location1 ?? 'location1' }}
                                                                                    Name:</label>
                                                                                <select name="region_id"
                                                                                    id="edit_region_id"
                                                                                    class="form-control region_id">
                                                                                    <option value="">Select
                                                                                        {{ $location1 ?? 'location1' }}</option>
                                                                                    @foreach ($regions as $region)
                                                                                        <option
                                                                                            value="{{ $region->id }}"
                                                                                            {{ $employee_basic_infos_value->region_id == $region->id ? 'selected' : '' }}>
                                                                                            {{ $region->region_name }}
                                                                                        </option>
                                                                                    @endforeach

                                                                                </select>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                </div>
                                                                <div class="col-md-4">
                                                                    @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                                                                                'json_contains(package_module,
                                                                                                                        \'["' .
                                                                                    $organization_sub_module_five .
                                                                                    '"]\')')->exists())
                                                                        @if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                                                                                    'json_contains(permission_content,
                                                                                                                            \'["' .
                                                                                        $organization_sub_module_five .
                                                                                        '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                                                                            <div class=" form-group">
                                                                                <label for=""
                                                                                    class="text-bold">{{ $location2 ?? 'location2' }}
                                                                                    name:</label>

                                                                                <select class="form-control area_id"
                                                                                    name="area_id" id="edit_area_id">

                                                                                    @foreach ($areas as $area)
                                                                                        <option
                                                                                            value="{{ $area->id }}"
                                                                                            {{ $employee_basic_infos_value->area_id == $area->id ? 'selected' : '' }}>
                                                                                            {{ $area->area_name }}
                                                                                        </option>
                                                                                    @endforeach

                                                                                </select>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                </div>
                                                                <div class="col-md-4">
                                                                    @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                                                                                'json_contains(package_module,
                                                                                                                        \'["' .
                                                                                    $organization_sub_module_six .
                                                                                    '"]\')')->exists())
                                                                        @if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                                                                                    'json_contains(permission_content,
                                                                                                                            \'["' .
                                                                                        $organization_sub_module_six .
                                                                                        '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                                                                            <div class="form-group">
                                                                                <label for=""
                                                                                    class="text-bold">{{ $location3 ?? 'location3' }}
                                                                                    Name:</label>

                                                                                <select class="form-control territory_id"
                                                                                    name="territory_id"
                                                                                    id="edit_territory_id">

                                                                                    @foreach ($territores as $territory)
                                                                                        <option
                                                                                            value="{{ $territory->id }}"
                                                                                            {{ $employee_basic_infos_value->territory_id == $territory->id ? 'selected' : '' }}>
                                                                                            {{ $territory->territory_name }}
                                                                                        </option>
                                                                                    @endforeach

                                                                                </select>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                </div>
                                                                <div class="col-md-4">
                                                                    @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                                                                                'json_contains(package_module,
                                                                                                                        \'["' .
                                                                                    $organization_sub_module_seven .
                                                                                    '"]\')')->exists())
                                                                        @if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                                                                                    'json_contains(permission_content,
                                                                                                                            \'["' .
                                                                                        $organization_sub_module_seven .
                                                                                        '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                                                                            <div class="form-group">
                                                                                <label for=""
                                                                                    class="text-bold">{{ $location4 ?? 'location4' }}
                                                                                    Name:</label>

                                                                                <select class="form-control town_id"
                                                                                    name="town_id" id="edit_town_id">

                                                                                    @foreach ($towns as $town)
                                                                                        <option
                                                                                            value="{{ $town->id }}"
                                                                                            {{ $employee_basic_infos_value->town_id == $town->id ? 'selected' : '' }}>
                                                                                            {{ $town->town_name }}
                                                                                        </option>
                                                                                    @endforeach

                                                                                </select>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                </div>
                                                                <div class="col-md-4">
                                                                    @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                                                                                'json_contains(package_module,
                                                                                                                        \'["' .
                                                                                    $organization_sub_module_eight .
                                                                                    '"]\')')->exists())
                                                                        @if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                                                                                    'json_contains(permission_content,
                                                                                                                            \'["' .
                                                                                        $organization_sub_module_eight .
                                                                                        '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                                                                            <div class="form-group">
                                                                                <label for=""
                                                                                    class="text-bold ">{{ $location5 ?? 'location5' }}
                                                                                    Name:</label>

                                                                                <select class="form-control db_house_id"
                                                                                    name="db_house_id"
                                                                                    id="edit_db_house_id">

                                                                                    @foreach ($dbs as $db)
                                                                                        <option
                                                                                            value="{{ $db->id }}"
                                                                                            {{ $employee_basic_infos_value->db_house_id == $db->id ? 'selected' : '' }}>
                                                                                            {{ $db->db_house_name }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                </div>
                                                                <div class="col-md-4">
                                                                    @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                                                                                'json_contains(package_module,
                                                                                                                        \'["' .
                                                                                    $organization_sub_module_twelve .
                                                                                    '"]\')')->exists())
                                                                        @if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                                                                                    'json_contains(permission_content,
                                                                                                                            \'["' .
                                                                                        $organization_sub_module_twelve .
                                                                                        '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                                                                            <div class="form-group">
                                                                                <label for=""
                                                                                    class="text-bold">{{ $location6 ?? 'location6' }}
                                                                                    Name:</label>

                                                                                <select
                                                                                    class="form-control location_six_id"
                                                                                    name="location_six_id"
                                                                                    id="location_six_id">

                                                                                    @foreach ($location_six as $value)
                                                                                        <option
                                                                                            value="{{ $value->id }}"
                                                                                            {{ $employee_basic_infos_value->location_six_id == $value->id ? 'selected' : '' }}>
                                                                                            {{ $value->location_six_location_six_name }}
                                                                                        </option>
                                                                                    @endforeach

                                                                                </select>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                </div>
                                                                <div class="col-md-4">
                                                                    @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                                                                                'json_contains(package_module,
                                                                                                                        \'["' .
                                                                                    $organization_sub_module_thirteen .
                                                                                    '"]\')')->exists())
                                                                        @if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                                                                                    'json_contains(permission_content,
                                                                                                                            \'["' .
                                                                                        $organization_sub_module_thirteen .
                                                                                        '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                                                                            <div class="form-group">
                                                                                <label for=""
                                                                                    class="text-bold">{{ $location7 ?? 'location7' }}
                                                                                    Name:</label>

                                                                                <select
                                                                                    class="form-control location_seven_id"
                                                                                    name="location_seven_id"
                                                                                    id="location_seven_id">
                                                                                    @foreach ($location_seven as $value)
                                                                                        <option
                                                                                            value="{{ $value->id }}"
                                                                                            {{ $employee_basic_infos_value->location_seven_id == $value->id ? 'selected' : '' }}>
                                                                                            {{ $value->location_seven_name }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                </div>

                                                                <div class="col-md-4">
                                                                    @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                                                                                'json_contains(package_module,
                                                                                                                        \'["' .
                                                                                    $organization_sub_module_fourteen .
                                                                                    '"]\')')->exists())
                                                                        @if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                                                                                    'json_contains(permission_content,
                                                                                                                            \'["' .
                                                                                        $organization_sub_module_fourteen .
                                                                                        '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                                                                            <div class="form-group">
                                                                                <label for=""
                                                                                    class="text-bold">{{ $location8 ?? 'location8' }}
                                                                                    Name:</label>

                                                                                <select
                                                                                    class="form-control location_eight_id"
                                                                                    name="location_eight_id"
                                                                                    id="location_eight_id">
                                                                                    @foreach ($location_eight as $value)
                                                                                        <option
                                                                                            value="{{ $value->id }}"
                                                                                            {{ $employee_basic_infos_value->location_eight_id == $value->id ? 'selected' : '' }}>
                                                                                            {{ $value->location_eights_name }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                </div>
                                                                <div class="col-md-4">
                                                                    @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                                                                                'json_contains(package_module,
                                                                                                                        \'["' .
                                                                                    $organization_sub_module_fifteen .
                                                                                    '"]\')')->exists())
                                                                        @if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                                                                                    'json_contains(permission_content,
                                                                                                                            \'["' .
                                                                                        $organization_sub_module_fifteen .
                                                                                        '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                                                                            <div class="form-group">
                                                                                <label for=""
                                                                                    class="text-bold">{{ $location9 ?? 'location9' }}
                                                                                    Name:</label>

                                                                                <select
                                                                                    class="form-control location_nine_id"
                                                                                    name="location_nine_id"
                                                                                    id="location_nine_id">
                                                                                    @foreach ($location_nine as $value)
                                                                                        <option
                                                                                            value="{{ $value->id }}"
                                                                                            {{ $employee_basic_infos_value->location_nine_id == $value->id ? 'selected' : '' }}>
                                                                                            {{ $value->location_nine_name }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                </div>
                                                                <div class="col-md-4">
                                                                    @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                                                                                'json_contains(package_module,
                                                                                                                        \'["' .
                                                                                    $organization_sub_module_sixteen .
                                                                                    '"]\')')->exists())
                                                                        @if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                                                                                    'json_contains(permission_content,
                                                                                                                            \'["' .
                                                                                        $organization_sub_module_sixteen .
                                                                                        '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                                                                            <div class="form-group">
                                                                                <label for=""
                                                                                    class="text-bold">{{ $location10 ?? 'location10' }}
                                                                                    Name:</label>

                                                                                <select
                                                                                    class="form-control location_ten_id"
                                                                                    name="location_ten_id"
                                                                                    id="location_ten_id">
                                                                                    @foreach ($location_ten as $value)
                                                                                        <option
                                                                                            value="{{ $value->id }}"
                                                                                            {{ $employee_basic_infos_value->location_ten_id == $value->id ? 'selected' : '' }}>
                                                                                            {{ $value->location_ten_name }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                </div>
                                                                <div class="col-md-4">
                                                                    @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                                                                                'json_contains(package_module,
                                                                                                                        \'["' .
                                                                                    $organization_sub_module_seventeen .
                                                                                    '"]\')')->exists())
                                                                        @if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                                                                                    'json_contains(permission_content,
                                                                                                                            \'["' .
                                                                                        $organization_sub_module_seventeen .
                                                                                        '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                                                                            <div class="form-group">
                                                                                <label for=""
                                                                                    class="text-bold">{{ $location11 ?? 'location11' }}
                                                                                    Name:</label>

                                                                                <select
                                                                                    class="form-control location_eleven_id"
                                                                                    name="location_eleven_id"
                                                                                    id="location_eleven_id">
                                                                                    @foreach ($location_eleven as $value)
                                                                                        <option
                                                                                            value="{{ $value->id }}"
                                                                                            {{ $employee_basic_infos_value->location_eleven_id == $value->id ? 'selected' : '' }}>
                                                                                            {{ $value->location_eleven_name }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12 mt-4">
                                                                    <div class="form-group ">
                                                                        <input type="submit" id="submit"
                                                                            value="{{ __('Submit') }}"
                                                                            class="btn btn-grad">
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </form>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div id="company_information" class="b-tab">
                                                <div class="content-box">
                                                    @foreach ($employee_basic_infos as $employee_basic_infos_value)
                                                        <form method="POST"
                                                            action="{{ route('update-employee-company-infos') }}"
                                                            enctype="multipart/form-data" id="sample_form"
                                                            id="sample_form">
                                                            @csrf
                                                            <input type="hidden" name="id" class="form-control"
                                                                value="{{ Session::get('employee_setup_id') }}"
                                                                required />
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="card mb-4">
                                                                        <div class="card-header with-border">
                                                                            <h1 class="card-title text-center">
                                                                                {{ __('Company Information') }} </h1>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="input-group mb-3">
                                                                        <label><strong>{{ __('Username') }}<span
                                                                                    class="text-danger">*</span></strong></label>
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text"
                                                                                id="basic-addon1">
                                                                                <i class="fa fa-user"
                                                                                    aria-hidden="true"></i>
                                                                            </span>
                                                                        </div>
                                                                        <input type="text" name="username"
                                                                            class="form-control"
                                                                            value="{{ $employee_basic_infos_value->username }}"
                                                                            required />
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="text-bold">{{ __('Company') }}
                                                                            <span class="text-danger">*</span></label>
                                                                        <select name="company_id" id="edit_company_id"
                                                                            required class="form-control company_id">
                                                                            @foreach ($companies as $company)
                                                                                <option value="{{ $company->id }}"
                                                                                    {{ old('company_name') == $company->id ? 'selected' : '' }}>
                                                                                    {{ $company->company_name }}
                                                                                </option>

                                                                                {{-- <option value="{{$company->id}}">
                                                                {{$company->company_name}}</option> --}}
                                                                            @endforeach

                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label class="text-bold">{{ __('Department') }}
                                                                            <span class="text-danger">*</span></label>
                                                                        <select class="form-control department_id"
                                                                            name="department_id" id="edit_department_id"
                                                                            required>
                                                                            @foreach ($departments as $department)
                                                                                <option value="{{ $department->id }}"
                                                                                    {{ $employee_basic_infos_value->department_id == $department->id ? 'selected' : '' }}>
                                                                                    {{ $department->department_name }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label class="text-bold">{{ __('Designation') }}
                                                                            <span class="text-danger">*</span></label>
                                                                        <select class="form-control designation_id"
                                                                            name="designation_id"
                                                                            id="edit_designation_id">
                                                                            @foreach ($designations as $designation)
                                                                                <option value="{{ $designation->id }}"
                                                                                    {{ $employee_basic_infos_value->designation_id == $designation->id ? 'selected' : '' }}>
                                                                                    {{ $designation->designation_name }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                        <span id="parent-container"></span>
                                                                        <span id="error-message" style="color:red"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label class="text-bold">{{ __('Office_Shift') }}
                                                                            <span class="text-danger">*</span></label>
                                                                        <select class="form-control office_shift_id"
                                                                            name="office_shift_id"
                                                                            id="edit_office_shift_id" required>
                                                                            @foreach ($officeShifts as $officeShift)
                                                                                <option value="{{ $officeShift->id }}"
                                                                                    {{ $employee_basic_infos_value->office_shift_id == $officeShift->id ? 'selected' : '' }}>
                                                                                    {{ $officeShift->shift_name }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label><strong>{{ __('Grade') }}<span
                                                                                    class="text-danger">*</span></strong></label>
                                                                        <select name="grade" id="grade"
                                                                            class="form-control">
                                                                            <option value="">Select Grade</option>
                                                                            @foreach ($grades as $item)
                                                                                <option value="{{ $item->id }}"
                                                                                    {{ $item->id == $employee_basic_infos_value->grade_id ? 'selected' : '' }}>
                                                                                    {{ $item->grade_name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label class="text-bold">{{ __('Role') }}
                                                                            <span class="text-danger">*</span></label>
                                                                        <select name="role_users_id" id="role_users_id"
                                                                            required class="form-control" required>

                                                                            @foreach ($roles as $item)
                                                                                <option value="{{ $item->id }}"
                                                                                    {{ $employee_basic_infos_value->role_id == $item->id ? 'selected' : '' }}>
                                                                                    {{ ucfirst($item->roles_name) }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label
                                                                            class="text-bold">{{ __('Employment Type') }}
                                                                            <span class="text-danger">*</span></label>
                                                                        <select name="employment_type"
                                                                            id="employment_type" required
                                                                            class="form-control employee_type"
                                                                            data-live-search="true"
                                                                            data-live-search-style="begins"
                                                                            title="{{ __('Select An Employment Type...') }}"
                                                                            required>
                                                                            <option value="Permanent" <?php if ($employee_basic_infos_value->employment_type == 'Permanent') {
                                                                                echo 'selected="selected"';
                                                                            } ?>>
                                                                                {{ __('Permanent') }}</option>
                                                                            <option value="Contactual"
                                                                                <?php if ($employee_basic_infos_value->employment_type == 'Contactual') {
                                                                                    echo 'selected="selected"';
                                                                                } ?>>
                                                                                {{ __('Contactual') }}</option>
                                                                            <option value="Project Based"
                                                                                <?php if ($employee_basic_infos_value->employment_type == 'Project Based') {
                                                                                    echo 'selected="selected"';
                                                                                } ?>>
                                                                                {{ __('Project Based') }}</option>
                                                                            <option value="Part Time" <?php if ($employee_basic_infos_value->employment_type == 'Part Time') {
                                                                                echo 'selected="selected"';
                                                                            } ?>>
                                                                                {{ __('Part Time') }}</option>
                                                                            <option value="Trainee" <?php if ($employee_basic_infos_value->employment_type == 'Trainee') {
                                                                                echo 'selected="selected"';
                                                                            } ?>>
                                                                                {{ __('Trainee') }}</option>
                                                                            <option value="Intern" <?php if ($employee_basic_infos_value->employment_type == 'Intern') {
                                                                                echo 'selected="selected"';
                                                                            } ?>>
                                                                                {{ __('Intern') }}</option>
                                                                            <option value="Probation" <?php if ($employee_basic_infos_value->employment_type == 'Probation') {
                                                                                echo 'selected="selected"';
                                                                            } ?>>
                                                                                {{ __('Probation') }}</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                @if ($employee_basic_infos_value->employment_type == 'Contactual')
                                                                    <div class="col-md-4 expiry_date">
                                                                        <div class="form-group">
                                                                            <label for="website">
                                                                                Expiry Date(if the employee is not
                                                                                permanent) <span
                                                                                    class="text-danger">*</span></label>
                                                                            <div class="input-group">
                                                                                <div class="input-group-prepend"><span
                                                                                        class="input-group-text"><i
                                                                                            class="fa fa-calendar"></i></span>
                                                                                </div>
                                                                                <input type="date"
                                                                                    name="in_trine_month_contractual"
                                                                                    class="form-control"
                                                                                    value="{{ $employee_basic_infos_value->in_trine_month }}">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif

                                                                @if ($employee_basic_infos_value->employment_type == 'Trainee')
                                                                    <div class="col-md-4 expiry_date_hide">
                                                                        <div class="input-group mb-3">
                                                                            <label
                                                                                class="text-bold">{{ __('Expiry Date') }}
                                                                            </label>
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text"
                                                                                    id="basic-addon1"><i
                                                                                        class="fa fa-credit-card-alt"
                                                                                        aria-hidden="true"></i></span>
                                                                            </div>
                                                                            <input type="date"
                                                                                name="in_trine_month_trainee"
                                                                                id="expiry_date"
                                                                                class="form-control date"
                                                                                value="{{ $employee_basic_infos_value->in_trine_month }}">
                                                                        </div>
                                                                    </div>
                                                                @endif

                                                                @if ($employee_basic_infos_value->employment_type == 'Intern')
                                                                    <div class="col-md-4 intern_hide">
                                                                        <div class="input-group mb-3">
                                                                            <label
                                                                                class="text-bold">{{ __('Expiry Date') }}
                                                                            </label>
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text"
                                                                                    id="basic-addon1"><i
                                                                                        class="fa fa-credit-card-alt"
                                                                                        aria-hidden="true"></i></span>
                                                                            </div>
                                                                            <input type="date"
                                                                                name="in_trine_month_intern"
                                                                                id="expiry_date"
                                                                                class="form-control date"
                                                                                value="{{ $employee_basic_infos_value->in_trine_month }}">
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                                @if ($employee_basic_infos_value->employment_type == 'Probation')
                                                                    <div class="col-md-4 probation_hide">
                                                                        <div class="input-group mb-3">
                                                                            <label
                                                                                class="text-bold">{{ __('Probation Month') }}
                                                                            </label>
                                                                            <select name="in_probation_month"
                                                                                id="" class="form-control"
                                                                                required>
                                                                                <option value="">Select Month
                                                                                </option>
                                                                                <option
                                                                                    {{ $employee_basic_infos_value->in_probation_month == 3 ? 'selected' : '' }}
                                                                                    value="3">Three Month</option>
                                                                                <option
                                                                                    {{ $employee_basic_infos_value->in_probation_month == 6 ? 'selected' : '' }}
                                                                                    value="6">Six Month</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                                <div class="col-md-4 expiry_date"
                                                                    style="display: none;">
                                                                    <div class="form-group">
                                                                        <label for="website">
                                                                            Expiry Date(if the employee is not permanent)
                                                                            <span class="text-danger">*</span></label>
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend"><span
                                                                                    class="input-group-text"><i
                                                                                        class="fa fa-calendar"></i></span>
                                                                            </div>
                                                                            <input type="date"
                                                                                name="in_trine_month_change_1"
                                                                                class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4 train_month"
                                                                    style="display: none;">
                                                                    <div class="form-group">
                                                                        <label for="website">
                                                                            Expiry Date <span
                                                                                class="text-danger">*</span></label>
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend"><span
                                                                                    class="input-group-text"><i
                                                                                        class="fa fa-calendar"></i></span>
                                                                            </div>
                                                                            <input type="date"
                                                                                name="in_trine_month_change_2"
                                                                                class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4 probation" style="display: none;">
                                                                </div>
                                                                @if ($employee_basic_infos_value->attendance_type == 'finger_print')
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label><strong>{{ __('Attendance Type') }}
                                                                                <span
                                                                                    class="text-danger">*</span></strong></label>
                                                                        <select name="attendance_type"
                                                                            id="attendance_type" 
                                                                            class="form-control" required>
                                                                            <option value="">Choose an
                                                                                Attendance
                                                                                Type
                                                                            </option>
                                                                            <option value="general" <?php if ($employee_basic_infos_value->attendance_type == 'general') {
                                                                                echo 'selected="selected"';
                                                                            } ?>>
                                                                                {{ __('General') }}
                                                                            </option>
                                                                            <option value="ip_based" <?php if ($employee_basic_infos_value->attendance_type == 'ip_based') {
                                                                                echo 'selected="selected"';
                                                                            } ?>>
                                                                                {{ __('IP Based') }}
                                                                            </option>
                                                                            <option value="finger_print"
                                                                                <?php if ($employee_basic_infos_value->attendance_type == 'finger_print') {
                                                                                    echo 'selected="selected"';
                                                                                } ?>>
                                                                                {{ __('Finger Print') }}
                                                                            </option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                @else
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label><strong>{{ __('Attendance Type') }}
                                                                                <span
                                                                                    class="text-danger">*</span></strong></label>
                                                                        <select name="attendance_type"
                                                                            id="attendance_type" 
                                                                            class="form-control" required>
                                                                            <option value="">Choose an
                                                                                Attendance
                                                                                Type
                                                                            </option>
                                                                            <option value="general" <?php if ($employee_basic_infos_value->attendance_type == 'general') {
                                                                                echo 'selected="selected"';
                                                                            } ?>>
                                                                                {{ __('General') }}
                                                                            </option>
                                                                            <option value="ip_based" <?php if ($employee_basic_infos_value->attendance_type == 'ip_based') {
                                                                                echo 'selected="selected"';
                                                                            } ?>>
                                                                                {{ __('IP Based') }}
                                                                            </option>
                                                                            {{-- <option value="finger_print"
                                                                                <?php if ($employee_basic_infos_value->attendance_type == 'finger_print') {
                                                                                    echo 'selected="selected"';
                                                                                } ?>>
                                                                                {{ __('Finger Print') }}
                                                                            </option> --}}
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                              
                                                                @if ($employee_basic_infos_value->attendance_type == 'finger_print')
                                                                    <div class="col-md-4 device_area">
                                                                        <div class="form-group">
                                                                            <label for="">Device Area</label>
                                                                            <select name="device_area[]" id="" disabled="true"
                                                                                class="form-control">
                                                                                @foreach ($device_area as $item)
                                                                                    <option
                                                                                        {{ $employee_basic_infos_value->device_area == $item->id ? 'selected' : '' }}
                                                                                        value="{{ $item->id }}">
                                                                                        {{ $item->area_name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                @endif

                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label class="text-bold">{{ __('Staff Type') }}
                                                                            <span class="text-danger">*</span></label>
                                                                        <select name="appointment_letter"
                                                                            class="form-control" required>
                                                                            <option value="">Select Staff Type
                                                                            </option>
                                                                            <option value="management"
                                                                                <?php if ($employee_basic_infos_value->appointment_letter == 'management') {
                                                                                    echo 'selected="selected"';
                                                                                } ?>>
                                                                                Management</option>
                                                                            <option value="nonmanagement"
                                                                                <?php if ($employee_basic_infos_value->appointment_letter == 'nonmanagement') {
                                                                                    echo 'selected="selected"';
                                                                                } ?>>
                                                                                Non Management
                                                                            </option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label class="text-bold">{{ __('Salary Type') }}
                                                                            <span class="text-danger">*</span></label>
                                                                        <select name="salary_type" class="form-control"
                                                                            required>
                                                                            <option value="">Select Salary Type
                                                                            </option>
                                                                            <option value="Monthly" <?php if ($employee_basic_infos_value->salary_type == 'Monthly') {
                                                                                echo 'selected="selected"';
                                                                            } ?>>
                                                                                Monthly</option>
                                                                            <option value="Hourly" <?php if ($employee_basic_infos_value->salary_type == 'Hourly') {
                                                                                echo 'selected="selected"';
                                                                            } ?>>
                                                                                Hourly</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <div class="input-group mb-3">
                                                                        <label><strong>{{ __('Joinning Date') }} <span
                                                                                    class="text-danger">*</span></strong></label>
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text"
                                                                                id="basic-addon1">
                                                                                <i class="fa fa-calendar"
                                                                                    aria-hidden="true"></i>
                                                                            </span>
                                                                        </div>
                                                                        <input type="date" name="joining_date"
                                                                            class="form-control"
                                                                            value="{{ $employee_basic_infos_value->joining_date }}"
                                                                            required />
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="input-group mb-3">
                                                                        <label><strong>{{ __('Overtime Rate') }}<span
                                                                                    class="text-danger">*</span></strong></label>
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text"
                                                                                id="basic-addon1">
                                                                                <i class="fa fa-credit-card-alt"
                                                                                    aria-hidden="true"></i>
                                                                            </span>
                                                                        </div>
                                                                        <input type="number" class="form-control"
                                                                            name="user_over_time_rate"
                                                                            value="{{ $employee_basic_infos_value->user_over_time_rate }}"
                                                                            class="form-check-input">
                                                                    </div>
                                                                </div>





                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label><strong>{{ __('Overtime Type') }}
                                                                                <span
                                                                                    class="text-danger">*</span></strong></label>
                                                                        <select name="user_over_time_type"
                                                                            class="form-control" required>
                                                                            <option value="Manual" <?php if ($employee_basic_infos_value->user_over_time_type == 'Manual') {
                                                                                echo 'selected="selected"';
                                                                            } ?>>
                                                                                Manual
                                                                            </option>
                                                                            <option value="Automatic"
                                                                                <?php if ($employee_basic_infos_value->user_over_time_type == 'Automatic') {
                                                                                    echo 'selected="selected"';
                                                                                } ?>>
                                                                                Automatic</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-group check-box">
                                                                        <input type="checkbox" name="over_time_payable"
                                                                            value="Yes" <?php if ($employee_basic_infos_value->over_time_payable == 'Yes') {
                                                                                echo 'checked="checked"';
                                                                            } ?>
                                                                            class="form-check-input">
                                                                        <label><strong>{{ __('Overtime Payable') }}<span
                                                                                    class="text-danger">*</span></strong></label>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-group check-box">
                                                                        <input type="checkbox" name="is_active"
                                                                            value="1" <?php if ($employee_basic_infos_value->is_active == '1') {
                                                                                echo 'checked="checked"';
                                                                            } ?>
                                                                            class="form-check-input" id="active">
                                                                        <label class="text-bold not-selectable"
                                                                            for="active"><strong>{{ __('Active') }}
                                                                                <span
                                                                                    class="text-danger">*</span></strong></label>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class=" form-group check-box">
                                                                        <input type="checkbox" name="multi_attendance"
                                                                            value="1" <?php
                                                                            if ($employee_basic_infos_value->multi_attendance == '1') {
                                                                                echo 'checked="checked"';
                                                                            } ?>
                                                                            class="form-check-input" id="attendance">
                                                                        <label class="text-bold not-selectable"
                                                                            for="attendance">Multiple
                                                                            Attendance</label>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-group check-box">
                                                                        <input type="checkbox" name="admin_status"
                                                                            value="Yes" <?php if ($employee_basic_infos_value->user_admin_status == 'Yes') {
                                                                                echo 'checked="checked"';
                                                                            } ?>
                                                                            class="form-check-input" id="admin">
                                                                        <label class="text-bold not-selectable"
                                                                            for="admin">Admin
                                                                            Status</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12 mt-4">
                                                                    <div class="form-group ">
                                                                        <input type="submit" id="submit"
                                                                            value="{{ __('Submit') }}"
                                                                            class="btn btn-grad">
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </form>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div id="previous_company_information" class="b-tab">
                                                <div class="content-box">
                                                    @foreach ($employee_basic_infos as $employee_basic_infos_value)
                                                        <form method="POST"
                                                            action="{{ route('update-employee-previous-company-infos') }}"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="id" class="form-control"
                                                                value="{{ Session::get('employee_setup_id') }}"
                                                                required />
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="card mb-4">
                                                                        <div class="card-header with-border">
                                                                            <h1 class="card-title text-center">
                                                                                {{ __('Previous Company Information') }}
                                                                            </h1>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <div class="input-group mb-3">
                                                                        <label><strong>{{ __('Previous Organization Name') }}<span
                                                                                    class="text-danger">*</span></strong></label>
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text"
                                                                                id="basic-addon1">
                                                                                <i class="fa fa-building-o"
                                                                                    aria-hidden="true"></i>
                                                                            </span>
                                                                        </div>
                                                                        <input type="text"
                                                                            name="previous_organization_name"
                                                                            class="form-control"
                                                                            value="{{ $employee_basic_infos_value->emoloyeedetail->previous_organization ?? '' }}"
                                                                            required />
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="input-group mb-3">
                                                                        <label><strong>{{ __('Last salary') }}<span
                                                                                    class="text-danger">*</span></strong></label>
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text"
                                                                                id="basic-addon1">
                                                                                <i class="fa fa-usd"
                                                                                    aria-hidden="true"></i>
                                                                            </span>
                                                                        </div>
                                                                        <input type="text" name="last_salary"
                                                                            class="form-control"
                                                                            value="{{ $employee_basic_infos_value->emoloyeedetail->last_salary ?? '' }}"
                                                                            required />
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="input-group mb-3">
                                                                        <label><strong>{{ __('Experience Month') }}<span
                                                                                    class="text-danger">*</span></strong></label>
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text"
                                                                                id="basic-addon1">
                                                                                <i class="fa fa-sort-numeric-desc"
                                                                                    aria-hidden="true"></i>
                                                                            </span>
                                                                        </div>
                                                                        <input type="text" name="experience_month"
                                                                            class="form-control"
                                                                            value="{{ $employee_basic_infos_value->emoloyeedetail->experience_month ?? '' }}"
                                                                            required />
                                                                    </div>
                                                                </div>
                                                            </div>


                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 mt-4">
                                                        <div class="form-group ">
                                                            <input type="submit" id="submit"
                                                                value="{{ __('Submit') }}" class="btn btn-grad">
                                                        </div>
                                                    </div>

                                                </div>
                                                </form>
                                        @endforeach
                                    </div>
                                </div>
                                <div id="parental_information" class="b-tab">
                                    <div class="content-box">
                                        @foreach ($employee_basic_infos as $employee_basic_infos_value)
                                            <form method="POST"
                                                action="{{ route('update-employee-parental-infos') }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="id" class="form-control"
                                                    value="{{ Session::get('employee_setup_id') }}" required />
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="card mb-4">
                                                            <div class="card-header with-border">
                                                                <h1 class="card-title text-center">
                                                                    {{ __('Parental Information(English)') }}
                                                                </h1>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="input-group mb-3">
                                                            <label for=""
                                                                class="text-bold">{{ __("Father's Name") }}</label><span
                                                                class="text-danger">*</span>
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">
                                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                                </span>
                                                            </div>
                                                            <input type="text" class="form-control"
                                                                name="father_name" value="" class="form-control"
                                                                required>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="input-group mb-3">
                                                            <label for=""
                                                                class="text-bold">{{ __("Father's Phone Number") }}<span
                                                                    class="text-danger">*</span></label>
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">
                                                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                                                </span>
                                                            </div>
                                                            <input type="text" class="form-control"
                                                                name="father_phone" value=""
                                                                class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="input-group mb-3">
                                                            <label for=""
                                                                class="text-bold">{{ __("Mother's Name") }}<span
                                                                    class="text-danger">*</span></label>
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">
                                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                                </span>
                                                            </div>
                                                            <input type="text" class="form-control"
                                                                name="mother_name" value="" class="form-control"
                                                                required>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="input-group mb-3">
                                                            <label for=""
                                                                class="text-bold">{{ __("Mother's Phone Number") }}<span
                                                                    class="text-danger">*</span></label>
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">
                                                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                                                </span>
                                                            </div>
                                                            <input type="text" class="form-control"
                                                                name="mother_phone" value=""
                                                                class="form-control">
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 mt-4">
                                                        <div class="form-group ">
                                                            <input type="submit" id="submit"
                                                                value="{{ __('Submit') }}" class="btn btn-grad">
                                                        </div>
                                                    </div>

                                                </div>
                                            </form>
                                        @endforeach
                                    </div>
                                </div>
                                <div id="basic_information_bangla" class="b-tab">
                                    <div class="content-box">
                                        @foreach ($employee_basic_infos as $employee_basic_infos_value)
                                            <form method="POST"
                                                action="{{ route('update-employee-basic-info-bangla') }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="id" class="form-control"
                                                    value="{{ Session::get('employee_setup_id') }}" required />
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="card mb-4">
                                                            <div class="card-header with-border">
                                                                <h1 class="card-title text-center">
                                                                    {{ __('Employee Basic Information(Bangla)') }}
                                                                </h1>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="input-group mb-3">
                                                            <label><strong>{{ __('Employee Name') }} <span
                                                                        class="text-danger">*</span></strong></label>
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1"> <i
                                                                        class="fa fa-user" aria-hidden="true"></i>
                                                                </span>
                                                            </div>
                                                            <input type="text" name="bangla_name"
                                                                class="form-control" value=""
                                                                placeholder="Enter first Name" required />
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="input-group mb-3">
                                                            <label><strong>{{ __("Father's Name") }} <span
                                                                        class="text-danger">*</span></strong></label>
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1"> <i
                                                                        class="fa fa-user" aria-hidden="true"></i>
                                                                </span>
                                                            </div>
                                                            <input type="text" name="father_name_bn"
                                                                class="form-control" value=""
                                                                placeholder="Enter Father's Name" required />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="input-group mb-3">
                                                            <label><strong>{{ __("Mother's Name") }}<span
                                                                        class="text-danger">*</span></strong></label>
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1"> <i
                                                                        class="fa fa-user" aria-hidden="true"></i>
                                                                </span>
                                                            </div>
                                                            <input type="text" name="mother_name_bn"
                                                                class="form-control" value=""
                                                                placeholder="Enter Mother's Name" required />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="content-box">
                                                            <div class="card-header with-border">
                                                                <h1 class="card-title text-center">
                                                                    {{ __('Present Address') }}
                                                                </h1>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label><strong>{{ __('City Corporation') }}
                                                                            </strong></label>
                                                                        <input type="text" class="form-control"
                                                                            name="present_city_corporation_bn"
                                                                            value=""
                                                                            placeholder="City Corporation">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label><strong>{{ __('Sadar') }}
                                                                            </strong></label>
                                                                        <input type="text" class="form-control"
                                                                            name="present_sadar_bn" value=""
                                                                            placeholder="Enter Sadar Name">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label><strong>{{ __('Poursova') }}
                                                                            </strong></label>
                                                                        <input type="text" class="form-control"
                                                                            name="present_poursova_bn" value=""
                                                                            placeholder="Enter Poursova Name">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label><strong>{{ __('Postal Area') }}
                                                                            </strong></label>
                                                                        <input type="text" class="form-control"
                                                                            name="present_postal_area_bn" value=""
                                                                            placeholder="Enter Postal Area Name">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label><strong>{{ __('Postal Code') }}
                                                                            </strong></label>
                                                                        <input type="text" class="form-control"
                                                                            name="present_postal_code_bn" value=""
                                                                            placeholder="Enter Postal Code">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label><strong>{{ __('Ward No') }}
                                                                            </strong></label>
                                                                        <input type="text" class="form-control"
                                                                            name="present_ward_no_bn" value=""
                                                                            placeholder="Enter Ward No">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label><strong>{{ __('Village Name/House No, Block No,
                                                                                                                                                Road No') }}
                                                                            </strong></label>
                                                                        <input type="text" class="form-control"
                                                                            name="present_village_bn" value=""
                                                                            placeholder="Enter Village Name">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="content-box">
                                                            <div class="card-header with-border">
                                                                <h1 class="card-title text-center">
                                                                    {{ __('Permanent Address') }}
                                                                </h1>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label><strong>{{ __('City Corporation') }}
                                                                            </strong></label>
                                                                        <input type="text" class="form-control"
                                                                            name="permanent_city_corporation_bn"
                                                                            value=""
                                                                            placeholder="City Corporation">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label><strong>{{ __('Sadar') }}
                                                                            </strong></label>
                                                                        <input type="text" class="form-control"
                                                                            name="permanent_sadar_bn" value=""
                                                                            placeholder="Enter Sadar Name">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label><strong>{{ __('Poursova') }}
                                                                            </strong></label>
                                                                        <input type="text" class="form-control"
                                                                            name="permanent_poursova_bn" value=""
                                                                            placeholder="Enter Poursova Name">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label><strong>{{ __('Postal Area') }}
                                                                                <span
                                                                                    class="text-danger">*</span></strong></label>
                                                                        <input type="text" class="form-control"
                                                                            name="permanent_postal_area_bn"
                                                                            value=""
                                                                            placeholder="Enter Postal Area Name">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label><strong>{{ __('Postal Code') }}
                                                                                <span
                                                                                    class="text-danger">*</span></strong></label>
                                                                        <input type="text" class="form-control"
                                                                            name="permanent_postal_code_bn"
                                                                            value=""
                                                                            placeholder="Enter Postal Code">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label><strong>{{ __('Ward No') }}
                                                                            </strong></label>
                                                                        <input type="text" class="form-control"
                                                                            name="permanent_ward_no_bn" value=""
                                                                            placeholder="Enter Ward No">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label><strong>{{ __('Village Name/House No, Block No,
                                                                                                                                                Road No') }}
                                                                            </strong></label>
                                                                        <input type="text" class="form-control"
                                                                            name="permanent_village_bn" value=""
                                                                            placeholder="Enter Village Name">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 mt-4">
                                            <div class="form-group ">
                                                <input type="submit" id="submit" value="{{ __('Submit') }}"
                                                    class="btn btn-grad">
                                            </div>
                                        </div>

                                    </div>
                                    </form>
        @endforeach
        </div>
        <div id="certificate_letter" class="b-tab">
            <div class="content-box">
                @foreach ($employee_basic_infos as $employee_basic_infos_value)
                    <form method="POST" action="{{ route('update-certificate-letter') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" class="form-control"
                            value="{{ Session::get('employee_setup_id') }}" required />
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card mb-4">
                                    <div class="card-header with-border">
                                        <h1 class="card-title text-center">
                                            {{ __('Certificate/ Letters') }}
                                        </h1>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="website">
                                        Appointment Letter Format<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"></div>
                                        <select name="appointment_letter_format_id" class="form-control">
                                            <option value="">
                                                {{ __('Select Appointment Letter Format...') }}
                                            </option>

                                            @foreach ($appointment_letter_formats as $appointment_letter_format)
                                                <option value="{{ $appointment_letter_format->id }}"
                                                    {{ $appointment_letter_format->id == $employee_basic_infos_value->appointment_letter_format_id
                                                        ? 'selected'
                                                        : '' }}>
                                                    {{ $appointment_letter_format->appointment_template_subject }}
                                                </option>
                                            @endforeach


                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="website">
                                        Warning Letter Format<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"></div>
                                        <select name="warning_letter_format_id" class="form-control">
                                            <option value="">
                                                {{ __('Select Warning Letter Format...') }}
                                            </option>
                                            @foreach ($warning_letter_formats as $warning_letter_format)
                                                <option value="{{ $warning_letter_format->id }}"
                                                    {{ $warning_letter_format->id == $employee_basic_infos_value->warning_letter_format_id ? 'selected' : '' }}>
                                                    {{ $warning_letter_format->warning_letter_format_subject }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="website">
                                        Probation Letter Format<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"></div>
                                        <select name="probation_letter_format_id" class="form-control">
                                            <option value="">
                                                {{ __('Select Probation Letter Format...') }}
                                            </option>


                                            @foreach ($probition_letter_formats as $probition_letter_format)
                                                <option value="{{ $probition_letter_format->id }}"
                                                    {{ $probition_letter_format->id == $employee_basic_infos_value->probation_letter_format_id ? 'selected' : '' }}>
                                                    {{ $probition_letter_format->probation_letter_format_subject }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="website">
                                        Non Objection Certificate<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"></div>
                                        <select name="noc_template_id" class="form-control">
                                            <option value="">
                                                {{ __('Select NOC Letter Format...') }}
                                            </option>
                                            @foreach ($noc_templates as $noc_template)
                                                <option value="{{ $noc_template->id }}"
                                                    {{ $noc_template->id == $employee_basic_infos_value->noc_id ? 'selected' : '' }}>
                                                    {{ $noc_template->non_objection_certificate_subject }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="website">
                                        Experience Letter<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"></div>
                                        <select name="experience_letter_id" class="form-control">
                                            <option value="">
                                                {{ __('Select Experience Letter Format...') }}
                                            </option>
                                            @foreach ($experience_letters as $experience_letter)
                                                <option value="{{ $experience_letter->id }}"
                                                    {{ $experience_letter->id == $employee_basic_infos_value->experience_letter_id ? 'selected' : '' }}>
                                                    {!! $experience_letter->subject !!}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="website">
                                        Salary Certificate<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"></div>
                                        <select name="salary_certificate_id" class="form-control">
                                            <option value="">
                                                {{ __('Select Salary Certificate Format...') }}
                                            </option>
                                            @foreach ($salary_certificates as $salary_certificate)
                                                <option value="{{ $salary_certificate->id }}"
                                                    {{ $salary_certificate->id == $employee_basic_infos_value->salary_certificate_format_id ? 'selected' : '' }}>
                                                    {!! $salary_certificate->salary_cirti_sub !!}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="website">
                                        Salary Increment Letter<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"></div>
                                        <select name="salary_increment_letter_id" class="form-control">
                                            <option value="">
                                                {{ __('Select Salary Increment Format...') }}
                                            </option>
                                            @foreach ($salaryIncrements as $salaryIncrement)
                                                <option value="{{ $salaryIncrement->id }}"
                                                    {{ $salaryIncrement->id == $employee_basic_infos_value->salary_increment_letter_id ? 'selected' : '' }}>
                                                    {!! $salaryIncrement->subject !!}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-4">
                    <div class="form-group ">
                        <input type="submit" id="submit" value="{{ __('Submit') }}" class="btn btn-grad">
                    </div>
                </div>

            </div>
            </form>
            @endforeach
        </div>
        </div>
    @else
        <div id="pre_address_1" class="b-tab">

            @foreach ($employee_basic_infos as $employee_basic_infos_value)
                <form method="POST" action="{{ route('update-employee-present-address') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" class="form-control"
                        value="{{ Session::get('employee_setup_id') }}" required />
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card mb-4">
                                        <div class="card-header with-border">
                                            <h1 class="card-title text-center">
                                                {{ __('Present Address(English)') }}
                                            </h1>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="" class="text-bold">Division
                                            Name: <span class="text-danger">*</span></label>
                                        <select name="present_division_id" id="present_division_id"
                                            class="form-control selectpicker region" data-live-search="true"
                                            data-live-search-style="begins" data-dependent="area_name"
                                            title="{{ __('Selecting Division name') }}..." required>
                                            @foreach ($divisions as $division)
                                                <option value="{{ $division->id }}" <?php if ($division->id == $employee_basic_infos_value->emoloyeedetail->present_division_id) {
                                                    echo 'selected="selected"';
                                                } ?>>
                                                    {{ $division->dv_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="" class="text-bold">District
                                            Name:<span class="text-danger">*</span></label>
                                        <select class="form-control" name="present_district_id"
                                            id="present_district_id" required>
                                            <option value="">Select District
                                            </option>
                                            @foreach ($districts as $district)
                                                <option value="{{ $district->id }}" <?php if ($district->id == $employee_basic_infos_value->emoloyeedetail->present_district_id) {
                                                    echo 'selected="selected"';
                                                } ?>>
                                                    {{ $district->dist_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <label for="" class="text-bold">City
                                            Corporation Name:</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"> <i class="fa fa-linode"
                                                    aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="text" name="present_city_corporation" class="form-control"
                                            value="{{ $employee_basic_infos_value->emoloyeedetail->present_city_corporation }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class=" form-group">
                                        <label for="" class="text-bold">Upazila
                                            Name:</label>

                                        <select class="form-control" name="present_upazila_id"
                                            id="present_upazila_id">
                                            <option value="">Select Upzila
                                            </option>
                                            @foreach ($upzillas as $upzilla)
                                                <option value="{{ $upzilla->id }}" <?php if ($upzilla->id == $employee_basic_infos_value->emoloyeedetail->present_upazila_id) {
                                                    echo 'selected="selected"';
                                                } ?>>
                                                    {{ $upzilla->up_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>



                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="text-bold">Union Name:</label>
                                        <select class="form-control" name="present_union_id" id="present_union_id">
                                            <option value="">Select Union
                                            </option>
                                            @foreach ($unions as $union)
                                                <option value="{{ $union->id }}" <?php if ($union->id == $employee_basic_infos_value->emoloyeedetail->present_union_id) {
                                                    echo 'selected="selected"';
                                                } ?>>
                                                    {{ $union->un_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="" class="text-bold">Ward
                                            No:</label>
                                        <input type="text" name="present_ward_no" class="form-control"
                                            value="{{ $employee_basic_infos_value->emoloyeedetail->present_ward_no }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="" class="text-bold">Sadar:</label>
                                        <input type="text" name="present_sadar" class="form-control"
                                            value="{{ $employee_basic_infos_value->emoloyeedetail->present_sadar }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="" class="text-bold">Pourosova:</label>
                                        <input type="text" name="present_pourosova" class="form-control"
                                            value="{{ $employee_basic_infos_value->emoloyeedetail->present_pourosova }}">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><strong>{{ __('Postal Area') }}
                                            </strong></label>
                                        <input type="text" name="present_postal_area" class="form-control"
                                            placeholder="Postal Area"
                                            value="{{ $employee_basic_infos_value->emoloyeedetail->present_postal_area }}" />
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><strong>{{ __('Postal Code') }}
                                            </strong></label>
                                        <input type="number" name="present_postal_code" class="form-control"
                                            placeholder="Postal Area"
                                            value="{{ $employee_basic_infos_value->emoloyeedetail->present_postal_code }}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><strong>{{ __('Village Name/House No,Block No, Road No') }}
                                            </strong><span class="text-danger">*</span></label>
                                        <input type="text" name="present_village" class="form-control"
                                            placeholder="Village Name/House No,Block No, Road No"
                                            value="{{ $employee_basic_infos_value->emoloyeedetail->present_village }}"
                                            required />
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-4">
                            <div class="form-group ">
                                <input type="submit" id="submit" value="{{ __('Submit') }}"
                                    class="btn btn-grad">
                            </div>
                        </div>

                    </div>
                </form>
            @endforeach

        </div>

        <div id="par_address_1" class="b-tab">

            @foreach ($employee_basic_infos as $employee_basic_infos_value)
                <form method="POST" action="{{ route('update-employee-permanent-address') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" class="form-control"
                        value="{{ Session::get('employee_setup_id') }}" required />
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card mb-4">
                                        <div class="card-header with-border">
                                            <h1 class="card-title text-center">
                                                {{ __('Parmanent Address(English)') }}
                                            </h1>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="" class="text-bold">Division
                                            Name:<span class="text-danger">*</span></label>
                                        <select name="division_id" id="division_id"
                                            class="form-control selectpicker region" data-live-search="true"
                                            data-live-search-style="begins" data-dependent="area_name"
                                            title="{{ __('Selecting Division name') }}..." required>
                                            @foreach ($divisions as $division)
                                                <option value="{{ $division->id }}" <?php if ($division->id == $employee_basic_infos_value->emoloyeedetail->division_id) {
                                                    echo 'selected="selected"';
                                                } ?>>
                                                    {{ $division->dv_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="" class="text-bold">District
                                            Name:<span class="text-danger">*</span></label>
                                        <select class="form-control" name="district_id" id="district_id" required>
                                            <option value="">Select District
                                            </option>
                                            @foreach ($districts as $district)
                                                <option value="{{ $district->id }}" <?php if ($district->id == $employee_basic_infos_value->emoloyeedetail->district_id) {
                                                    echo 'selected="selected"';
                                                } ?>>
                                                    {{ $district->dist_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <label for="" class="text-bold">City
                                            Corporation Name:</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"> <i class="fa fa-linode"
                                                    aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="text" name="city_corporation" class="form-control"
                                            value="{{ $employee_basic_infos_value->emoloyeedetail->city_corporation }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class=" form-group">
                                        <label for="" class="text-bold">Upazila
                                            Name:<span class="text-danger">*</span></label>

                                        <select class="form-control" name="upazila_id" id="upazila_id" required>
                                            <option value="">Select Upzila
                                            </option>
                                            @foreach ($upzillas as $upzilla)
                                                <option value="{{ $upzilla->id }}" <?php if ($upzilla->id == $employee_basic_infos_value->emoloyeedetail->upazila_id) {
                                                    echo 'selected="selected"';
                                                } ?>>
                                                    {{ $upzilla->up_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>



                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="text-bold">Union Name:<span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" name="union_id" id="union_id" required>
                                            <option value="">Select Union
                                            </option>
                                            @foreach ($unions as $union)
                                                <option value="{{ $union->id }}" <?php if ($union->id == $employee_basic_infos_value->emoloyeedetail->union_id) {
                                                    echo 'selected="selected"';
                                                } ?>>
                                                    {{ $union->un_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="" class="text-bold">Ward
                                            No:<span class="text-danger">*</span></label>
                                        <input type="text" name="ward_no" class="form-control"
                                            value="{{ $employee_basic_infos_value->emoloyeedetail->ward_number }}"
                                            required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="" class="text-bold">Sadar:</label>
                                        <input type="text" name="sadar" class="form-control"
                                            value="{{ $employee_basic_infos_value->emoloyeedetail->sadar }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="" class="text-bold">Pourosova :</label>
                                        <input type="text" name="poursova" class="form-control"
                                            value="{{ $employee_basic_infos_value->emoloyeedetail->poursova }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><strong>{{ __('Postal Area') }}
                                            </strong><span class="text-danger">*</span></label>
                                        <input type="text" name="postal_area" class="form-control"
                                            placeholder="Postal Area"
                                            value="{{ $employee_basic_infos_value->emoloyeedetail->postal_area_en }}"
                                            required />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><strong>{{ __('Postal Code') }}
                                            </strong><span class="text-danger">*</span></label>
                                        <input type="number" name="postal_code" class="form-control"
                                            placeholder="Postal Area"
                                            value="{{ $employee_basic_infos_value->emoloyeedetail->postal_code }}"
                                            required />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><strong>{{ __('Village Name/House No, Block No, Road No') }}
                                            </strong><span class="text-danger">*</span></label>
                                        <input type="text" name="village" class="form-control"
                                            placeholder="Village Name"
                                            value="{{ $employee_basic_infos_value->emoloyeedetail->village_en }}"
                                            required />
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-4">
                            <div class="form-group ">
                                <input type="submit" id="submit" value="{{ __('Submit') }}"
                                    class="btn btn-grad">
                            </div>
                        </div>

                    </div>
                </form>
            @endforeach

        </div>
        <div id="job_location_1" class="b-tab">

            @foreach ($employee_basic_infos as $employee_basic_infos_value)
                <form method="POST" action="{{ route('update-employee-job-location') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" class="form-control"
                        value="{{ Session::get('employee_setup_id') }}" required />
                    <div class="row">

                        <div class="col-md-12">
                            <div class="card mb-4">
                                <div class="card-header with-border">
                                    <h1 class="card-title text-center">
                                        {{ __('Job Location') }} </h1>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                                        'json_contains(package_module,
                                                                    \'["' .
                                            $organization_sub_module_four .
                                            '"]\')')->exists())
                                @if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                                            'json_contains(permission_content,
                                                                        \'["' .
                                                $organization_sub_module_four .
                                                '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                                    <div class="form-group">
                                        <label for="" class="text-bold">{{ $location1 ?? 'location1' }}
                                            Name:</label>
                                        <select name="region_id" id="edit_region_id" class="form-control region_id">
                                            <option value="">Select Location</option>
                                            @foreach ($regions as $region)
                                                <option value="{{ $region->id }}"
                                                    {{ $employee_basic_infos_value->region_id == $region->id ? 'selected' : '' }}>
                                                    {{ $region->region_name }}
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>
                                @endif
                            @endif
                        </div>
                        <div class="col-md-4">
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                                        'json_contains(package_module,
                                                                    \'["' .
                                            $organization_sub_module_five .
                                            '"]\')')->exists())
                                @if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                                            'json_contains(permission_content,
                                                                        \'["' .
                                                $organization_sub_module_five .
                                                '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                                    <div class=" form-group">
                                        <label for="" class="text-bold">{{ $location2 ?? 'location2' }}
                                            name:</label>

                                        <select class="form-control area_id" name="area_id" id="edit_area_id">

                                            @foreach ($areas as $area)
                                                <option value="{{ $area->id }}"
                                                    {{ $employee_basic_infos_value->area_id == $area->id ? 'selected' : '' }}>
                                                    {{ $area->area_name }}
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>
                                @endif
                            @endif
                        </div>
                        <div class="col-md-4">
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                                        'json_contains(package_module,
                                                                    \'["' .
                                            $organization_sub_module_six .
                                            '"]\')')->exists())
                                @if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                                            'json_contains(permission_content,
                                                                        \'["' .
                                                $organization_sub_module_six .
                                                '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                                    <div class="form-group">
                                        <label for="" class="text-bold">{{ $location3 ?? 'location3' }}
                                            Name:</label>

                                        <select class="form-control territory_id" name="territory_id"
                                            id="edit_territory_id">

                                            @foreach ($territores as $territory)
                                                <option value="{{ $territory->id }}"
                                                    {{ $employee_basic_infos_value->territory_id == $territory->id ? 'selected' : '' }}>
                                                    {{ $territory->territory_name }}
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>
                                @endif
                            @endif
                        </div>


                        <div class="col-md-4">
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                                        'json_contains(package_module,
                                                                    \'["' .
                                            $organization_sub_module_seven .
                                            '"]\')')->exists())
                                @if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                                            'json_contains(permission_content,
                                                                        \'["' .
                                                $organization_sub_module_seven .
                                                '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                                    <div class="form-group">
                                        <label for="" class="text-bold">{{ $location4 ?? 'location4' }}
                                            Name:</label>

                                        <select class="form-control town_id" name="town_id" id="edit_town_id">

                                            @foreach ($towns as $town)
                                                <option value="{{ $town->id }}"
                                                    {{ $employee_basic_infos_value->town_id == $town->id ? 'selected' : '' }}>
                                                    {{ $town->town_name }}
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>
                                @endif
                            @endif
                        </div>
                        <div class="col-md-4">
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                                        'json_contains(package_module,
                                                                    \'["' .
                                            $organization_sub_module_eight .
                                            '"]\')')->exists())
                                @if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                                            'json_contains(permission_content,
                                                                        \'["' .
                                                $organization_sub_module_eight .
                                                '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                                    <div class="form-group">
                                        <label for="" class="text-bold ">{{ $location5 ?? 'location5' }}
                                            Name:</label>

                                        <select class="form-control db_house_id" name="db_house_id"
                                            id="edit_db_house_id">

                                            @foreach ($dbs as $db)
                                                <option value="{{ $db->id }}"
                                                    {{ $employee_basic_infos_value->db_house_id == $db->id ? 'selected' : '' }}>
                                                    {{ $db->db_house_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                            @endif
                        </div>
                        <div class="col-md-4">
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                                        'json_contains(package_module,
                                                                    \'["' .
                                            $organization_sub_module_twelve .
                                            '"]\')')->exists())
                                @if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                                            'json_contains(permission_content,
                                                                        \'["' .
                                                $organization_sub_module_twelve .
                                                '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                                    <div class="form-group">
                                        <label for="" class="text-bold">{{ $location6 ?? 'location6' }}
                                            Name:</label>

                                        <select class="form-control location_six_id" name="location_six_id"
                                            id="location_six_id">

                                            @foreach ($location_six as $value)
                                                <option value="{{ $value->id }}"
                                                    {{ $employee_basic_infos_value->location_six_id == $value->id ? 'selected' : '' }}>
                                                    {{ $value->location_six_location_six_name }}
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>
                                @endif
                            @endif
                        </div>
                        <div class="col-md-4">
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                                        'json_contains(package_module,
                                                                    \'["' .
                                            $organization_sub_module_thirteen .
                                            '"]\')')->exists())
                                @if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                                            'json_contains(permission_content,
                                                                        \'["' .
                                                $organization_sub_module_thirteen .
                                                '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                                    <div class="form-group">
                                        <label for="" class="text-bold">{{ $location7 ?? 'location7' }}
                                            Name:</label>

                                        <select class="form-control location_seven_id" name="location_seven_id"
                                            id="location_seven_id">
                                            @foreach ($location_seven as $value)
                                                <option value="{{ $value->id }}"
                                                    {{ $employee_basic_infos_value->location_seven_id == $value->id ? 'selected' : '' }}>
                                                    {{ $value->location_seven_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                            @endif
                        </div>
                        <div class="col-md-4">
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                                        'json_contains(package_module,
                                                                    \'["' .
                                            $organization_sub_module_fourteen .
                                            '"]\')')->exists())
                                @if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                                            'json_contains(permission_content,
                                                                        \'["' .
                                                $organization_sub_module_fourteen .
                                                '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                                    <div class="form-group">
                                        <label for="" class="text-bold">{{ $location8 ?? 'location8' }}
                                            Name:</label>

                                        <select class="form-control location_eight_id" name="location_eight_id"
                                            id="location_eight_id">
                                            @foreach ($location_eight as $value)
                                                <option value="{{ $value->id }}"
                                                    {{ $employee_basic_infos_value->location_eight_id == $value->id ? 'selected' : '' }}>
                                                    {{ $value->location_eights_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                            @endif
                        </div>
                        <div class="col-md-4">
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                                        'json_contains(package_module,
                                                                    \'["' .
                                            $organization_sub_module_fifteen .
                                            '"]\')')->exists())
                                @if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                                            'json_contains(permission_content,
                                                                        \'["' .
                                                $organization_sub_module_fifteen .
                                                '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                                    <div class="form-group">
                                        <label for="" class="text-bold">{{ $location9 ?? 'location9' }}
                                            Name:</label>

                                        <select class="form-control location_nine_id" name="location_nine_id"
                                            id="location_nine_id">
                                            @foreach ($location_nine as $value)
                                                <option value="{{ $value->id }}"
                                                    {{ $employee_basic_infos_value->location_nine_id == $value->id ? 'selected' : '' }}>
                                                    {{ $value->location_nine_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                            @endif
                        </div>
                        <div class="col-md-4">
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                                        'json_contains(package_module,
                                                                    \'["' .
                                            $organization_sub_module_sixteen .
                                            '"]\')')->exists())
                                @if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                                            'json_contains(permission_content,
                                                                        \'["' .
                                                $organization_sub_module_sixteen .
                                                '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                                    <div class="form-group">
                                        <label for="" class="text-bold">{{ $location10 ?? 'location10' }}
                                            Name:</label>

                                        <select class="form-control location_ten_id" name="location_ten_id"
                                            id="location_ten_id">
                                            @foreach ($location_ten as $value)
                                                <option value="{{ $value->id }}"
                                                    {{ $employee_basic_infos_value->location_ten_id == $value->id ? 'selected' : '' }}>
                                                    {{ $value->location_ten_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                            @endif
                        </div>
                        <div class="col-md-4">
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                                        'json_contains(package_module,
                                                                    \'["' .
                                            $organization_sub_module_seventeen .
                                            '"]\')')->exists())
                                @if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                                            'json_contains(permission_content,
                                                                        \'["' .
                                                $organization_sub_module_seventeen .
                                                '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                                    <div class="form-group">
                                        <label for="" class="text-bold">{{ $location11 ?? 'location11' }}
                                            Name:</label>

                                        <select class="form-control location_eleven_id" name="location_eleven_id"
                                            id="location_eleven_id">
                                            @foreach ($location_eleven as $value)
                                                <option value="{{ $value->id }}"
                                                    {{ $employee_basic_infos_value->location_eleven_id == $value->id ? 'selected' : '' }}>
                                                    {{ $value->location_eleven_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                            @endif
                        </div>








                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-4">
                            <div class="form-group ">
                                <input type="submit" id="submit" value="{{ __('Submit') }}"
                                    class="btn btn-grad">
                            </div>
                        </div>

                    </div>
                </form>
            @endforeach

        </div>
        <div id="company_information_1" class="b-tab">

            @foreach ($employee_basic_infos as $employee_basic_infos_value)
                <form method="POST" action="{{ route('update-employee-company-infos') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" class="form-control"
                        value="{{ Session::get('employee_setup_id') }}" required />
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-4">
                                <div class="card-header with-border">
                                    <h1 class="card-title text-center">
                                        {{ __('Company Information') }} </h1>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <label><strong>{{ __('Username') }}<span class="text-danger">*</span></strong></label>
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="text" name="username" class="form-control"
                                    value="{{ $employee_basic_infos_value->username }}" required />
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-bold">{{ __('Company') }}
                                    <span class="text-danger">*</span></label>
                                <select name="company_id" id="edit_company_id" required
                                    class="form-control company_id">
                                    @foreach ($companies as $company)
                                        <option value="{{ $company->id }}"
                                            {{ old('company_name') == $company->id ? 'selected' : '' }}>
                                            {{ $company->company_name }}
                                        </option>

                                        {{-- <option value="{{$company->id}}">{{$company->company_name}}
                                                </option> --}}
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-bold">{{ __('Department') }}
                                    <span class="text-danger">*</span></label>
                                <select class="form-control department_id" name="department_id"
                                    id="edit_department_id" required>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}"
                                            {{ $employee_basic_infos_value->department_id == $department->id ? 'selected' : '' }}>
                                            {{ $department->department_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-bold">{{ __('Designation') }}
                                    <span class="text-danger">*</span></label>
                                <select class="form-control designation_id" name="designation_id"
                                    id="edit_designation_id">
                                    @foreach ($designations as $designation)
                                        <option value="{{ $designation->id }}"
                                            {{ $employee_basic_infos_value->designation_id == $designation->id ? 'selected' : '' }}>
                                            {{ $designation->designation_name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span id="parent-container"></span>
                                <span id="error-message" style="color:red"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-bold">{{ __('Office_Shift') }}
                                    <span class="text-danger">*</span></label>
                                <select class="form-control office_shift_id" name="office_shift_id"
                                    id="edit_office_shift_id" required>
                                    @foreach ($officeShifts as $officeShift)
                                        <option value="{{ $officeShift->id }}"
                                            {{ $employee_basic_infos_value->office_shift_id == $officeShift->id ? 'selected' : '' }}>
                                            {{ $officeShift->shift_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><strong>{{ __('Grade') }}<span class="text-danger">*</span></strong></label>
                                <select name="grade" id="grade" class="form-control">
                                    <option value="">Select Grade</option>
                                    @foreach ($grades as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $item->id == $employee_basic_infos_value->grade_id ? 'selected' : '' }}>
                                            {{ $item->grade_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-bold">{{ __('Role') }}
                                    <span class="text-danger">*</span></label>
                                <select name="role_users_id" id="role_users_id" required class="form-control"
                                    required>

                                    @foreach ($roles as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $employee_basic_infos_value->role_id == $item->id ? 'selected' : '' }}>
                                            {{ ucfirst($item->roles_name) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-bold">{{ __('Employment Type') }}
                                    <span class="text-danger">*</span></label>
                                <select name="employment_type" id="employment_type" required
                                    class="form-control employee_type" data-live-search="true"
                                    data-live-search-style="begins" title="{{ __('Select An Employment Type...') }}"
                                    required>
                                    <option value="Permanent" <?php if ($employee_basic_infos_value->employment_type == 'Permanent') {
                                        echo 'selected="selected"';
                                    } ?>>
                                        {{ __('Permanent') }}</option>
                                    <option value="Contactual" <?php if ($employee_basic_infos_value->employment_type == 'Contactual') {
                                        echo 'selected="selected"';
                                    } ?>>
                                        {{ __('Contactual') }}</option>
                                    <option value="Project-Based" <?php if ($employee_basic_infos_value->employment_type == 'Project Based') {
                                        echo 'selected="selected"';
                                    } ?>>
                                        {{ __('Project Based') }}</option>
                                    <option value="Part Time" <?php if ($employee_basic_infos_value->employment_type == 'Part Time') {
                                        echo 'selected="selected"';
                                    } ?>>
                                        {{ __('Part Time') }}</option>
                                    <option value="Trainee" <?php if ($employee_basic_infos_value->employment_type == 'Trainee') {
                                        echo 'selected="selected"';
                                    } ?>>
                                        {{ __('Trainee') }}</option>
                                    <option value="Intern" <?php if ($employee_basic_infos_value->employment_type == 'Intern') {
                                        echo 'selected="selected"';
                                    } ?>>
                                        {{ __('Intern') }}</option>
                                    <option value="Probation" <?php if ($employee_basic_infos_value->employment_type == 'Probation') {
                                        echo 'selected="selected"';
                                    } ?>>
                                        {{ __('Probation') }}</option>
                                </select>
                            </div>
                        </div>
                        @if ($employee_basic_infos_value->employment_type == 'Contactual')
                            <div class="col-md-4 expiry_date">
                                <div class="form-group">
                                    <label for="website">
                                        Expiry Date(if the employee is not
                                        permanent) <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i
                                                    class="fa fa-calendar"></i></span>
                                        </div>
                                        <input type="date" name="in_trine_month_contractual" class="form-control"
                                            value="{{ $employee_basic_infos_value->in_trine_month }}">
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($employee_basic_infos_value->employment_type == 'Trainee')
                            <div class="col-md-4 expiry_date_hide">
                                <div class="input-group mb-3">
                                    <label class="text-bold">{{ __('Expiry Date') }}
                                    </label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i
                                                class="fa fa-credit-card-alt" aria-hidden="true"></i></span>
                                    </div>
                                    <input type="date" name="in_trine_month_trainee" id="expiry_date"
                                        class="form-control date"
                                        value="{{ $employee_basic_infos_value->in_trine_month }}">
                                </div>
                            </div>
                        @endif

                        @if ($employee_basic_infos_value->employment_type == 'Intern')
                            <div class="col-md-4 intern_hide">
                                <div class="input-group mb-3">
                                    <label class="text-bold">{{ __('Expiry Date') }}
                                    </label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i
                                                class="fa fa-credit-card-alt" aria-hidden="true"></i></span>
                                    </div>
                                    <input type="date" name="in_trine_month_intern" id="expiry_date"
                                        class="form-control date"
                                        value="{{ $employee_basic_infos_value->in_trine_month }}">
                                </div>
                            </div>
                        @endif
                        @if ($employee_basic_infos_value->employment_type == 'Probation')
                            <div class="col-md-4 probation_hide">
                                <div class="input-group mb-3">
                                    <label class="text-bold">{{ __('Probation Month') }}
                                    </label>
                                    <select name="in_probation_month" id="" class="form-control" required>
                                        <option value="">Select Month</option>
                                        <option
                                            {{ $employee_basic_infos_value->in_probation_month == 3 ? 'selected' : '' }}
                                            value="3">Three Month</option>
                                        <option
                                            {{ $employee_basic_infos_value->in_probation_month == 6 ? 'selected' : '' }}
                                            value="6">Six Month</option>
                                    </select>
                                </div>
                            </div>
                        @endif
                        <div class="col-md-4 expiry_date" style="display: none;">
                            <div class="form-group">
                                <label for="website">
                                    Expiry Date(if the employee is not permanent)
                                    <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text"><i
                                                class="fa fa-calendar"></i></span>
                                    </div>
                                    <input type="date" name="in_trine_month_change_1" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 train_month" style="display: none;">
                            <div class="form-group">
                                <label for="website">
                                    Expiry Date <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text"><i
                                                class="fa fa-calendar"></i></span>
                                    </div>
                                    <input type="date" name="in_trine_month_change_2" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 probation" style="display: none;"></div>
                        @if ($employee_basic_infos_value->attendance_type == 'finger_print')
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><strong>{{ __('Attendance Type') }}
                                        <span
                                            class="text-danger">*</span></strong></label>
                                <select name="attendance_type"
                                    id="attendance_type" 
                                    class="form-control" required>
                                    <option value="">Choose an
                                        Attendance
                                        Type
                                    </option>
                                    <option value="general" <?php if ($employee_basic_infos_value->attendance_type == 'general') {
                                        echo 'selected="selected"';
                                    } ?>>
                                        {{ __('General') }}
                                    </option>
                                    <option value="ip_based" <?php if ($employee_basic_infos_value->attendance_type == 'ip_based') {
                                        echo 'selected="selected"';
                                    } ?>>
                                        {{ __('IP Based') }}
                                    </option>
                                    {{-- <option value="finger_print"
                                        <?php if ($employee_basic_infos_value->attendance_type == 'finger_print') {
                                            echo 'selected="selected"';
                                        } ?>>
                                        {{ __('Finger Print') }}
                                    </option> --}}
                                </select>
                            </div>
                        </div>
                        @else
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><strong>{{ __('Attendance Type') }}
                                        <span
                                            class="text-danger">*</span></strong></label>
                                <select name="attendance_type"
                                    id="attendance_type" 
                                    class="form-control" required>
                                    <option value="">Choose an
                                        Attendance
                                        Type
                                    </option>
                                    <option value="general" <?php if ($employee_basic_infos_value->attendance_type == 'general') {
                                        echo 'selected="selected"';
                                    } ?>>
                                        {{ __('General') }}
                                    </option>
                                    <option value="ip_based" <?php if ($employee_basic_infos_value->attendance_type == 'ip_based') {
                                        echo 'selected="selected"';
                                    } ?>>
                                        {{ __('IP Based') }}
                                    </option>
                                    {{-- <option value="finger_print"
                                        <?php if ($employee_basic_infos_value->attendance_type == 'finger_print') {
                                            echo 'selected="selected"';
                                        } ?>>
                                        {{ __('Finger Print') }}
                                    </option> --}}
                                </select>
                            </div>
                        </div>
                        @endif
                        @if ($employee_basic_infos_value->attendance_type == 'finger_print')
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Device Area</label>
                                    <select name="device_area[]" id="device_area" class="form-control" disabled="true">
                                        @foreach ($device_area as $item)
                                            <option
                                                {{ $employee_basic_infos_value->device_area == $item->id ? 'selected' : '' }}
                                                value="{{ $item->id }}">{{ $item->area_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-bold">{{ __('Staff Type') }}
                                    <span class="text-danger">*</span></label>
                                <select name="appointment_letter" class="form-control" required>
                                    <option value="">Select Staff Type
                                    </option>
                                    <option value="management" <?php if ($employee_basic_infos_value->appointment_letter == 'management') {
                                        echo 'selected="selected"';
                                    } ?>>
                                        Management</option>
                                    <option value="nonmanagement" <?php if ($employee_basic_infos_value->appointment_letter == 'nonmanagement') {
                                        echo 'selected="selected"';
                                    } ?>>
                                        Non Management
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-bold">{{ __('Salary Type') }}
                                    <span class="text-danger">*</span></label>
                                <select name="salary_type" class="form-control" required>
                                    <option value="">Select Salary Type
                                    </option>
                                    <option value="Monthly" <?php if ($employee_basic_infos_value->salary_type == 'Monthly') {
                                        echo 'selected="selected"';
                                    } ?>>
                                        Monthly</option>
                                    <option value="Hourly" <?php if ($employee_basic_infos_value->salary_type == 'Hourly') {
                                        echo 'selected="selected"';
                                    } ?>>
                                        Hourly</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                <label><strong>{{ __('Joinning Date') }} <span
                                            class="text-danger">*</span></strong></label>
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fa fa-calendar" aria-hidden="true"></i> </span>
                                </div>
                                <input type="date" name="joining_date" class="form-control"
                                    value="{{ $employee_basic_infos_value->joining_date }}" required />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                <label><strong>{{ __('Overtime Rate') }}<span
                                            class="text-danger">*</span></strong></label>
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fa fa-credit-card-alt" aria-hidden="true"></i> </span>
                                </div>
                                <input type="number" class="form-control" name="user_over_time_rate"
                                    value="{{ $employee_basic_infos_value->user_over_time_rate }}"
                                    class="form-check-input">
                            </div>
                        </div>





                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>{{ __('Overtime Type') }}
                                        <span class="text-danger">*</span></strong></label>
                                <select name="user_over_time_type" class="form-control" required>
                                    <option value="Manual" <?php if ($employee_basic_infos_value->user_over_time_type == 'Manual') {
                                        echo 'selected="selected"';
                                    } ?>>Manual
                                    </option>
                                    <option value="Automatic" <?php if ($employee_basic_infos_value->user_over_time_type == 'Automatic') {
                                        echo 'selected="selected"';
                                    } ?>>
                                        Automatic</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group check-box">
                                <input type="checkbox" name="over_time_payable" value="Yes" <?php if ($employee_basic_infos_value->over_time_payable == 'Yes') {
                                    echo 'checked="checked"';
                                } ?>
                                    class="form-check-input" id="overtime_payable">
                                <label class="text-bold not-selectable"
                                    for="overtime_payable"><strong>{{ __('Overtime Payable') }}<span
                                            class="text-danger">*</span></strong></label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group check-box">
                                <input type="checkbox" class="form-check-input" name="is_active" value="1"
                                    <?php if ($employee_basic_infos_value->is_active == '1') {
                                        echo 'checked="checked"';
                                    } ?> id="active">
                                <label class="text-bold not-selectable" for="active"><strong>{{ __('Active') }}
                                        <span class="text-danger">*</span></strong></label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class=" form-group check-box">
                                <input type="checkbox" name="multi_attendance" value="1" <?php if ($employee_basic_infos_value->multi_attendance == '1') {
                                    echo 'checked="checked"';
                                } ?>
                                    class="form-check-input" id="attendance">
                                <label class="text-bold not-selectable" for="attendance">Multiple
                                    Attendance</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group check-box">
                                <input type="checkbox" name="admin_status" value="Yes" <?php if ($employee_basic_infos_value->user_admin_status == 'Yes') {
                                    echo 'checked="checked"';
                                } ?>
                                    class="form-check-input" id="admin">
                                <label class="text-bold not-selectable" for="admin">Admin Status</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-4">
                            <div class="form-group ">
                                <input type="submit" id="submit" value="{{ __('Submit') }}"
                                    class="btn btn-grad">
                            </div>
                        </div>

                    </div>
                </form>
            @endforeach

        </div>
        <div id="previous_company_information_1" class="b-tab">

            @foreach ($employee_basic_infos as $employee_basic_infos_value)
                <form method="POST" action="{{ route('update-employee-previous-company-infos') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" class="form-control"
                        value="{{ Session::get('employee_setup_id') }}" required />
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-4">
                                <div class="card-header with-border">
                                    <h1 class="card-title text-center">
                                        {{ __('Previous Company Information') }} </h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                <label><strong>{{ __('Previous Organization Name') }}<span
                                            class="text-danger">*</span></strong></label>
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fa fa-building-o" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="text" name="previous_organization_name" class="form-control"
                                    value="{{ $employee_basic_infos_value->emoloyeedetail->previous_organization ?? '' }}"
                                    required />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                <label><strong>{{ __('Last salary') }}<span
                                            class="text-danger">*</span></strong></label>
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fa fa-usd" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="text" name="last_salary" class="form-control"
                                    value="{{ $employee_basic_infos_value->emoloyeedetail->last_salary ?? '' }}"
                                    required />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                <label><strong>{{ __('Experience Month') }}<span
                                            class="text-danger">*</span></strong></label>
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fa fa-sort-numeric-desc" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="text" name="experience_month" class="form-control"
                                    value="{{ $employee_basic_infos_value->emoloyeedetail->experience_month ?? '' }}"
                                    required />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-4">
                            <div class="form-group ">
                                <input type="submit" id="submit" value="{{ __('Submit') }}"
                                    class="btn btn-grad">
                            </div>
                        </div>

                    </div>
                </form>
            @endforeach

        </div>
        <div id="parental_information_1" class="b-tab">

            @foreach ($employee_basic_infos as $employee_basic_infos_value)
                <form method="POST" action="{{ route('update-employee-parental-infos') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" class="form-control"
                        value="{{ Session::get('employee_setup_id') }}" required />
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-4">
                                <div class="card-header with-border">
                                    <h1 class="card-title text-center">
                                        {{ __('Parental Information(English)') }}
                                    </h1>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <label for="" class="text-bold">{{ __("Father's Name") }}<span
                                        class="text-danger">*</span></label>
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"> <i class="fa fa-user"
                                            aria-hidden="true"></i> </span>
                                </div>
                                <input type="text" class="form-control" name="father_name"
                                    value="{{ $employee_basic_infos_value->emoloyeedetail->father_name }}"
                                    class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <label for="" class="text-bold">{{ __("Father's Phone Number") }}<span
                                        class="text-danger">*</span></label>
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"> <i class="fa fa-phone"
                                            aria-hidden="true"></i> </span>
                                </div>
                                <input type="text" class="form-control" name="father_phone"
                                    value="{{ $employee_basic_infos_value->emoloyeedetail->father_phone }}"
                                    class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <label for="" class="text-bold">{{ __("Mother's Name") }}<span
                                        class="text-danger">*</span></label>
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"> <i class="fa fa-user"
                                            aria-hidden="true"></i> </span>
                                </div>
                                <input type="text" class="form-control" name="mother_name"
                                    value="{{ $employee_basic_infos_value->emoloyeedetail->mother_name }}"
                                    class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <label for="" class="text-bold">{{ __("Mother's Phone Number") }}<span
                                        class="text-danger">*</span></label>
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"> <i class="fa fa-phone"
                                            aria-hidden="true"></i> </span>
                                </div>
                                <input type="text" class="form-control" name="mother_phone"
                                    value="{{ $employee_basic_infos_value->emoloyeedetail->mother_phone }}"
                                    class="form-control">
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-4">
                            <div class="form-group ">
                                <input type="submit" id="submit" value="{{ __('Submit') }}"
                                    class="btn btn-grad">
                            </div>
                        </div>

                    </div>
                </form>
            @endforeach

        </div>
        <div id="basic_information_bangla_1" class="b-tab">

            @foreach ($employee_basic_infos as $employee_basic_infos_value)
                <form method="POST" action="{{ route('update-employee-basic-info-bangla') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" class="form-control"
                        value="{{ Session::get('employee_setup_id') }}" required />
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-4">
                                <div class="card-header with-border">
                                    <h1 class="card-title text-center">
                                        {{ __('Employee Basic Information (Bangla)') }}
                                    </h1>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                <label><strong>{{ __('Employee Name') }} <span
                                            class="text-danger">*</span></strong></label>
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"> <i class="fa fa-user"
                                            aria-hidden="true"></i> </span>
                                </div>
                                <input type="text" name="bangla_name" class="form-control"
                                    value="{{ $employee_basic_infos_value->emoloyeedetail->bangla_name }}"
                                    placeholder="Enter first Name" required />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                <label><strong>{{ __("Father's Name") }} <span
                                            class="text-danger">*</span></strong></label>
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"> <i class="fa fa-user"
                                            aria-hidden="true"></i> </span>
                                </div>
                                <input type="text" name="father_name_bn" class="form-control"
                                    value="{{ $employee_basic_infos_value->emoloyeedetail->father_name_bn }}"
                                    placeholder="Enter Father's Name" required />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                <label><strong>{{ __("Mother's Name") }}<span
                                            class="text-danger">*</span></strong></label>
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"> <i class="fa fa-user"
                                            aria-hidden="true"></i> </span>
                                </div>
                                <input type="text" name="mother_name_bn" class="form-control"
                                    value="{{ $employee_basic_infos_value->emoloyeedetail->mother_name_bn }}"
                                    placeholder="Enter Mother's Name" required />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="content-box">
                                <div class="card-header with-border">
                                    <h1 class="card-title text-center">
                                        {{ __('Present Address') }}
                                    </h1>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><strong>{{ __('City Corporation') }}
                                                </strong></label>
                                            <input type="text" class="form-control"
                                                name="present_city_corporation_bn"
                                                value="{{ $employee_basic_infos_value->emoloyeedetail->present_city_corporation_bn }}"
                                                placeholder="City Corporation">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><strong>{{ __('Sadar') }}
                                                </strong></label>
                                            <input type="text" class="form-control" name="present_sadar_bn"
                                                value="{{ $employee_basic_infos_value->emoloyeedetail->present_sadar_bn }}"
                                                placeholder="Enter Sadar Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><strong>{{ __('Poursova') }}
                                                </strong></label>
                                            <input type="text" class="form-control" name="present_poursova_bn"
                                                value="{{ $employee_basic_infos_value->emoloyeedetail->present_poursova_bn }}"
                                                placeholder="Enter Poursova Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><strong>{{ __('Postal Area') }}
                                                </strong></label>
                                            <input type="text" class="form-control" name="present_postal_area_bn"
                                                value="{{ $employee_basic_infos_value->emoloyeedetail->present_postal_area_bn }}"
                                                placeholder="Enter Postal Area Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><strong>{{ __('Postal Code') }}
                                                </strong></label>
                                            <input type="text" class="form-control" name="present_postal_code_bn"
                                                value="{{ $employee_basic_infos_value->emoloyeedetail->present_postal_code_bn }}"
                                                placeholder="Enter Postal Code">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><strong>{{ __('Ward No') }}
                                                </strong></label>
                                            <input type="text" class="form-control" name="present_ward_no_bn"
                                                value="{{ $employee_basic_infos_value->emoloyeedetail->present_ward_no_bn }}"
                                                placeholder="Enter Ward No">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label><strong>{{ __('Village Name/House No, Block No, Road
                                                                                                            No') }}
                                                </strong></label>
                                            <input type="text" class="form-control" name="present_village_bn"
                                                value="{{ $employee_basic_infos_value->emoloyeedetail->present_village_bn }}"
                                                placeholder="Enter Village Name">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="content-box">
                                <div class="card-header with-border">
                                    <h1 class="card-title text-center">
                                        {{ __('Permanent Address') }}
                                    </h1>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><strong>{{ __('City Corporation') }}
                                                </strong></label>
                                            <input type="text" class="form-control"
                                                name="permanent_city_corporation_bn"
                                                value="{{ $employee_basic_infos_value->emoloyeedetail->permanent_city_corporation_bn }}"
                                                placeholder="City Corporation">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><strong>{{ __('Sadar') }}
                                                </strong></label>
                                            <input type="text" class="form-control" name="permanent_sadar_bn"
                                                value="{{ $employee_basic_infos_value->emoloyeedetail->permanent_sadar_bn }}"
                                                placeholder="Enter Sadar Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><strong>{{ __('Poursova') }}
                                                </strong></label>
                                            <input type="text" class="form-control" name="permanent_poursova_bn"
                                                value="{{ $employee_basic_infos_value->emoloyeedetail->permanent_poursova_bn }}"
                                                placeholder="Enter Poursova Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><strong>{{ __('Postal Area') }}
                                                    <span class="text-danger">*</span></strong></label>
                                            <input type="text" class="form-control" name="permanent_postal_area_bn"
                                                value="{{ $employee_basic_infos_value->emoloyeedetail->permanent_postal_area_bn }}"
                                                placeholder="Enter Postal Area Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><strong>{{ __('Postal Code') }}
                                                </strong></label>
                                            <input type="text" class="form-control" name="permanent_postal_code_bn"
                                                value="{{ $employee_basic_infos_value->emoloyeedetail->permanent_postal_code_bn }}"
                                                placeholder="Enter Postal Code">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><strong>{{ __('Ward No') }}
                                                </strong></label>
                                            <input type="text" class="form-control" name="permanent_ward_no_bn"
                                                value="{{ $employee_basic_infos_value->emoloyeedetail->permanent_ward_no_bn }}"
                                                placeholder="Enter Ward No">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label><strong>{{ __('Village Name/House No, Block No, Road
                                                                                                            No') }}
                                                </strong></label>
                                            <input type="text" class="form-control" name="permanent_village_bn"
                                                value="{{ $employee_basic_infos_value->emoloyeedetail->permanent_village_bn }}"
                                                placeholder="Enter Village Name">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-4">
                            <div class="form-group ">
                                <input type="submit" id="submit" value="{{ __('Submit') }}"
                                    class="btn btn-grad">
                            </div>
                        </div>

                    </div>
                </form>
            @endforeach

        </div>
        <div id="certificate_letter_1" class="b-tab">
            <div class="content-box">
                @foreach ($employee_basic_infos as $employee_basic_infos_value)
                    <form method="POST" action="{{ route('update-certificate-letter') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" class="form-control"
                            value="{{ Session::get('employee_setup_id') }}" required />
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card mb-4">
                                    <div class="card-header with-border">
                                        <h1 class="card-title text-center">
                                            {{ __('Certificate/ Letters') }}
                                        </h1>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="website">
                                        Appointment Letter Format<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"></div>
                                        <select name="appointment_letter_format_id" class="form-control">
                                            <option value="">
                                                {{ __('Select Appointment Letter Format...') }}
                                            </option>

                                            @foreach ($appointment_letter_formats as $appointment_letter_format)
                                                <option value="{{ $appointment_letter_format->id }}"
                                                    {{ $appointment_letter_format->id == $employee_basic_infos_value->appointment_letter_format_id
                                                        ? 'selected'
                                                        : '' }}>
                                                    {{ $appointment_letter_format->appointment_template_subject }}
                                                </option>
                                            @endforeach


                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="website">
                                        Warning Letter Format<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"></div>
                                        <select name="warning_letter_format_id" class="form-control">
                                            <option value="">
                                                {{ __('Select Warning Letter Format...') }}
                                            </option>
                                            @foreach ($warning_letter_formats as $warning_letter_format)
                                                <option value="{{ $warning_letter_format->id }}"
                                                    {{ $warning_letter_format->id == $employee_basic_infos_value->warning_letter_format_id ? 'selected' : '' }}>
                                                    {{ $warning_letter_format->warning_letter_format_subject }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="website">
                                        Probation Letter Format<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"></div>
                                        <select name="probation_letter_format_id" class="form-control">
                                            <option value="">
                                                {{ __('Select Probation Letter Format...') }}
                                            </option>


                                            @foreach ($probition_letter_formats as $probition_letter_format)
                                                <option value="{{ $probition_letter_format->id }}"
                                                    {{ $probition_letter_format->id == $employee_basic_infos_value->probation_letter_format_id ? 'selected' : '' }}>
                                                    {!! $probition_letter_format->probation_letter_format_subject !!}
                                                </option>
                                            @endforeach


                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="website">
                                        Non Objection Certificate<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"></div>
                                        <select name="noc_template_id" class="form-control">
                                            <option value="">
                                                {{ __('Select NOC Letter Format...') }}
                                            </option>
                                            @foreach ($noc_templates as $noc_template)
                                                <option value="{{ $noc_template->id }}"
                                                    {{ $noc_template->id == $employee_basic_infos_value->noc_id ? 'selected' : '' }}>
                                                    {{ $noc_template->non_objection_certificate_subject }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="website">
                                        Experience Letter<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"></div>
                                        <select name="experience_letter_id" class="form-control">
                                            <option value="">
                                                {{ __('Select Experience Letter Format...') }}
                                            </option>
                                            @foreach ($experience_letters as $experience_letter)
                                                <option value="{{ $experience_letter->id }}"
                                                    {{ $experience_letter->id == $employee_basic_infos_value->experience_letter_id ? 'selected' : '' }}>
                                                    {{ $experience_letter->subject }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>


                        </div>

            </div>
            <div class="row">
                <div class="col-md-12 mt-4">
                    <div class="form-group ">
                        <input type="submit" id="submit" value="{{ __('Submit') }}" class="btn btn-grad">
                    </div>
                </div>

            </div>
            </form>
            @endforeach
        </div>
        @endif
        </div>
        </div>
        </div>
    </section>
@else
    <section class="forms">
        <div class="content-box">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-0">
                        <div class="card-header d-flex align-items-center">
                            <h4>{{ __('Basic Information') }}</h4>
                        </div>
                        <div class="">
                            <p class="italic">
                                <small>{{ __('The field labels marked with * are required input fields') }}.</small>
                            </p>
                            @foreach ($employee_basic_infos as $employee_basic_infos_value)
                                <form method="POST" action="{{ route('update-employee-basic-infos') }}"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <input type="hidden" name="id" class="form-control"
                                        value="{{ Session::get('employee_setup_id') }}" required />
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <div class="card mb-4">
                                                <div class="card-header with-border">
                                                    <h1 class="card-title text-center">
                                                        {{ $employee_basic_infos_value->first_name }}
                                                        {{ $employee_basic_infos_value->last_name }} -
                                                        ({{ $employee_basic_infos_value->company_assigned_id }})
                                                    </h1>
                                                </div>
                                            </div>
                                            <div class="row">

                                                {{-- <div class="col-md-4"> --}}
                                                <input type="hidden" name="id" class="form-control"
                                                    value="{{ Session::get('employee_setup_id') }}" required />
                                                {{-- <div class="input-group mb-3">
                                                    <label><strong>{{ __('ID') }}<span
                                                                class="text-danger">*</span></strong></label>
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="id"><i class="fa fa-id-badge"
                                                                aria-hidden="true"></i></span>
                                                    </div> --}}
                                                <input type="hidden" name="company_assigned_id" class="form-control"
                                                    value="{{ $employee_basic_infos_value->company_assigned_id }}"
                                                    readonly />
                                                {{--
                                                </div>
                                            </div> --}}

                                                <div class="col-md-4">
                                                    <div class="input-group mb-3">
                                                        <label><strong>{{ __('First Name') }} <span
                                                                    class="text-danger">*</span></strong></label>
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1"> <i
                                                                    class="fa fa-user" aria-hidden="true"></i> </span>
                                                        </div>
                                                        <input type="text" name="first_name" class="form-control"
                                                            value="{{ $employee_basic_infos_value->first_name }}"
                                                            required />
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="input-group mb-3">
                                                        <label>
                                                            <strong>{{ __('Last Name') }} <span
                                                                    class="text-danger">*</span></strong>
                                                        </label>
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1"> <i
                                                                    class="fa fa-user" aria-hidden="true"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" name="last_name" class="form-control"
                                                            value="{{ $employee_basic_infos_value->last_name }}"
                                                            required />
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="input-group mb-3">
                                                        <label><strong>{{ __('User Name') }} <span
                                                                    class="text-danger">*</span></strong></label>
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1"> <i
                                                                    class="fa fa-phone" aria-hidden="true"></i> </span>
                                                        </div>
                                                        <input type="text" name="username" class="form-control"
                                                            value="{{ $employee_basic_infos_value->username }}" />
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="input-group mb-3">
                                                        <label><strong>{{ __('Email') }}<span
                                                                    class="text-danger">*</span></strong></label>
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1"> <i
                                                                    class="fa fa-envelope-o" aria-hidden="true"></i>
                                                            </span>
                                                        </div>
                                                        <input type="email" name="email" class="form-control"
                                                            value="{{ $employee_basic_infos_value->email }}" required />
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="input-group mb-3">
                                                        <label>
                                                            <strong>
                                                                {{ __('Personal Phone') }} <span
                                                                    class="text-danger">*</span>
                                                            </strong>
                                                        </label>
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1"><i
                                                                    class="fa fa-volume-control-phone"
                                                                    aria-hidden="true"></i></span>
                                                        </div>
                                                        <input type="text" name="phone" class="form-control"
                                                            value="{{ $employee_basic_infos_value->phone }}" required />
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="input-group mb-3">
                                                        <label><strong>{{ __('Business Phone') }} <span
                                                                    class="text-danger">*</span></strong></label>
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1"> <i
                                                                    class="fa fa-phone" aria-hidden="true"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" name="b_phone" class="form-control"
                                                            value="{{ $employee_basic_infos_value->b_phone }}" />
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="input-group mb-3">
                                                        <label><strong>{{ __('Birth Place') }} <span
                                                                    class="text-danger">*</span></strong></label>
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1"> <i
                                                                    class="fa fa-map-marker" aria-hidden="true"></i>
                                                            </span>
                                                        </div>
                                                        <input name="birth_place" class="form-control"
                                                            value="{{ $employee_basic_infos_value->emoloyeedetail->birth_place ?? '' }}"
                                                            placeholder="Enter Birth Place" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="input-group mb-3">
                                                        <label><strong>{{ __('Date of birth') }}<span
                                                                    class="text-danger">*</span></strong></label>
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1"> <i
                                                                    class="fa fa-calendar" aria-hidden="true"></i>
                                                            </span>
                                                        </div>
                                                        <input type="date" name="date_of_birth"
                                                            class="form-control"
                                                            value="{{ $employee_basic_infos_value->date_of_birth }}"
                                                            required />
                                                    </div>
                                                </div>


                                                <div class="col-md-4">
                                                    <div class="input-group mb-3">
                                                        <label><strong>{{ __('Gender') }}<span
                                                                    class="text-danger">*</span></strong></label>
                                                        <select name="gender" required class="form-control">
                                                            <option value="">Choose a Gender
                                                            </option>
                                                            <option value="Male" <?php if ($employee_basic_infos_value->gender == 'Male') {
                                                                echo 'selected="selected"';
                                                            } ?>>
                                                                {{ __('Male') }}
                                                            </option>
                                                            <option value="Female" <?php if ($employee_basic_infos_value->gender == 'Female') {
                                                                echo 'selected="selected"';
                                                            } ?>>
                                                                {{ __('Female') }}
                                                            </option>
                                                            <option value="Other" <?php if ($employee_basic_infos_value->gender == 'Other') {
                                                                echo 'selected="selected"';
                                                            } ?>>
                                                                {{ __('Other') }}
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label><strong>{{ __('Blood Group') }}
                                                                <span class="text-danger">*</span></strong></label>
                                                        <select name="blood_group" required class="form-control">
                                                            <option value="">Choose a Blood
                                                                Group
                                                            </option>
                                                            <option value="A+" <?php if ($employee_basic_infos_value->blood_group == 'A+') {
                                                                echo 'selected="selected"';
                                                            } ?>>
                                                                {{ __('A Positive') }}
                                                            </option>
                                                            <option value="A-" <?php if ($employee_basic_infos_value->blood_group == 'A-') {
                                                                echo 'selected="selected"';
                                                            } ?>>
                                                                {{ __('A Negative') }}
                                                            </option>
                                                            <option value="B+" <?php if ($employee_basic_infos_value->blood_group == 'B+') {
                                                                echo 'selected="selected"';
                                                            } ?>>
                                                                {{ __('B Positive') }}
                                                            </option>
                                                            <option value="B-" <?php if ($employee_basic_infos_value->blood_group == 'B-') {
                                                                echo 'selected="selected"';
                                                            } ?>>
                                                                {{ __('B Negative') }}
                                                            </option>
                                                            <option value="AB+" <?php if ($employee_basic_infos_value->blood_group == 'AB+') {
                                                                echo 'selected="selected"';
                                                            } ?>>
                                                                {{ __('AB Positive') }}</option>
                                                            <option value="AB-" <?php if ($employee_basic_infos_value->blood_group == 'AB-') {
                                                                echo 'selected="selected"';
                                                            } ?>>
                                                                {{ __('AB Negative') }}</option>
                                                            <option value="O+" <?php if ($employee_basic_infos_value->blood_group == 'O+') {
                                                                echo 'selected="selected"';
                                                            } ?>>
                                                                {{ __('O Positive') }}
                                                            </option>
                                                            <option value="O-" <?php if ($employee_basic_infos_value->blood_group == 'O-') {
                                                                echo 'selected="selected"';
                                                            } ?>>
                                                                {{ __('O Negative') }}
                                                            </option>
                                                            <option value="unkown" <?php if ($employee_basic_infos_value->blood_group == 'unkown') {
                                                                echo 'selected="selected"';
                                                            } ?>>
                                                                {{ __('Unknown') }}
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    @if ($employee_basic_infos_value->emoloyeedetail)
                                                        <div class="form-group">
                                                            <label class="text-bold">{{ __('Religion') }}
                                                                <span class="text-danger">*</span></label>
                                                            <select class="form-control" name="religion" required>
                                                                <option value="" selected="selected"
                                                                    disabled="disabled">--
                                                                    select one --
                                                                </option>
                                                                <option value="Islam" <?php if ($employee_basic_infos_value->emoloyeedetail->religion == 'Islam') {
                                                                    echo 'selected="selected"';
                                                                } ?>>
                                                                    Islam</option>
                                                                <option value="Hinduism" <?php if ($employee_basic_infos_value->emoloyeedetail->religion == 'Hinduism') {
                                                                    echo 'selected="selected"';
                                                                } ?>>
                                                                    Hinduism</option>
                                                                <option value="Buddhism" <?php if ($employee_basic_infos_value->emoloyeedetail->religion == 'Buddhism') {
                                                                    echo 'selected="selected"';
                                                                } ?>>
                                                                    Buddhism</option>
                                                                <option value="Christianity" <?php if ($employee_basic_infos_value->emoloyeedetail->religion == 'Christianity') {
                                                                    echo 'selected="selected"';
                                                                } ?>>
                                                                    Christianity
                                                                </option>
                                                                <option value="Other" <?php if ($employee_basic_infos_value->emoloyeedetail->religion == 'Other') {
                                                                    echo 'selected="selected"';
                                                                } ?>>Other
                                                                </option>
                                                            </select>
                                                        </div>
                                                    @else
                                                        <div class="form-group">
                                                            <label class="text-bold">{{ __('Religion') }}
                                                                <span class="text-danger">*</span></label>
                                                            <select class="form-control" name="religion" required>
                                                                <option value="" selected="selected"
                                                                    disabled="disabled">--
                                                                    select one --
                                                                </option>
                                                                <option value="Islam">
                                                                    Islam</option>
                                                                <option value="Hinduism">
                                                                    Hinduism</option>
                                                                <option value="Buddhism">
                                                                    Buddhism</option>
                                                                <option value="Christianity">Christianity
                                                                </option>
                                                                <option value="Other">Other</option>
                                                            </select>
                                                        </div>
                                                    @endif

                                                </div>
                                                <div class="col-md-6">
                                                    @if ($employee_basic_infos_value->emoloyeedetail)
                                                        <div class="form-group">
                                                            <label class="text-bold">{{ __('Identification Type') }}
                                                                <span class="text-danger">*</span></label>

                                                            <select class="form-control" name="identification_type">
                                                                <option value="">--
                                                                    select one --
                                                                </option>
                                                                <option value="nid" <?php if ($employee_basic_infos_value->emoloyeedetail->identification_type == 'nid') {
                                                                    echo 'selected="selected"';
                                                                } ?>>NID
                                                                    Number</option>
                                                                <option value="birthcertificate" <?php if ($employee_basic_infos_value->emoloyeedetail->identification_type == 'birthcertificate') {
                                                                    echo 'selected="selected"';
                                                                } ?>>
                                                                    Birth
                                                                    Certificate Number</option>
                                                                <option value="passport-number" <?php if ($employee_basic_infos_value->emoloyeedetail->identification_type == 'passport-number') {
                                                                    echo 'selected="selected"';
                                                                } ?>>
                                                                    Passport
                                                                    Number
                                                                </option>
                                                            </select>
                                                        </div>
                                                    @else
                                                        <div class="form-group">
                                                            <label class="text-bold">{{ __('Identification Type') }}
                                                                <span class="text-danger">*</span></label>

                                                            <select class="form-control" name="identification_type">
                                                                <option value="">--
                                                                    select one --
                                                                </option>
                                                                <option value="nid">NID
                                                                    Number</option>
                                                                <option value="birthcertificate">Birth
                                                                    Certificate Number</option>
                                                                <option value="passport-number">Passport
                                                                    Number
                                                                </option>
                                                            </select>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="input-group mb-3">
                                                        <label for="" class="text-bold">Identification
                                                            Number</label>
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1"> <i
                                                                    class="fa fa-id-card-o" aria-hidden="true"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" name="identification_number"
                                                            value="{{ $employee_basic_infos_value->emoloyeedetail->identification_number ?? '' }}"
                                                            class="form-control" />
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    @if ($employee_basic_infos_value->emoloyeedetail)
                                                        <div class="form-group">
                                                            <label class="text-bold">Marital Status
                                                                <span class="text-danger">*</span></label>
                                                            <select class="form-control" name="marital_status" required>
                                                                <option value="">--
                                                                    select one --
                                                                </option>
                                                                <option value="Unmarried" <?php if ($employee_basic_infos_value->emoloyeedetail->marital_status == 'Unmarried') {
                                                                    echo 'selected="selected"';
                                                                } ?>>
                                                                    Unmarried</option>
                                                                <option value="Married" <?php if ($employee_basic_infos_value->emoloyeedetail->marital_status == 'Married') {
                                                                    echo 'selected="selected"';
                                                                } ?>>
                                                                    Married</option>
                                                            </select>
                                                        </div>
                                                    @else
                                                        <div class="form-group">
                                                            <label class="text-bold">Marital Status
                                                                <span class="text-danger">*</span></label>
                                                            <select class="form-control" name="marital_status" required>
                                                                <option value="">--
                                                                    select one --
                                                                </option>
                                                                <option value="Unmarried">
                                                                    Unmarried</option>
                                                                <option value="Married">
                                                                    Married</option>
                                                            </select>
                                                        </div>
                                                    @endif
                                                </div>





                                                <div class="col-md-4">
                                                    @if ($employee_basic_infos_value->emoloyeedetail)
                                                        <div class="form-group">
                                                            <label><strong>{{ __('Nationality') }}<span
                                                                        class="text-danger">*</span></strong></label>
                                                            <select name="nationality_id" class="form-control" required>
                                                                <option value=""> Select
                                                                    Nationality
                                                                </option>
                                                                @foreach ($nationalities as $nationality)
                                                                    <option value="{{ $nationality->id }}"
                                                                        {{ $nationality->id == $employee_basic_infos_value->emoloyeedetail->nationality_id ? 'selected' : '' }}>
                                                                        {{ $nationality->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    @else
                                                        <div class="form-group">
                                                            <label><strong>{{ __('Nationality') }}<span
                                                                        class="text-danger">*</span></strong></label>
                                                            <select name="nationality_id" class="form-control" required>
                                                                <option value=""> Select
                                                                    Nationality
                                                                </option>
                                                                @foreach ($nationalities as $nationality)
                                                                    <option value="{{ $nationality->id }}">
                                                                        {{ $nationality->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    @endif
                                                </div>




                                            </div>
                                        </div>


                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 mt-4">
                                            <div class="form-group ">
                                                <input type="submit" id="submit" value="{{ __('Submit') }}"
                                                    class="btn btn-grad">
                                            </div>
                                        </div>

                                    </div>
                                </form>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </section>

    @endif


    <script type="text/javascript">
        function Tabs() {
            var bindAll = function() {
                var menuElements = document.querySelectorAll('[data-tab]');
                for (var i = 0; i < menuElements.length; i++) {
                    menuElements[i].addEventListener('click', change, false);
                }
            }

            var clear = function() {
                var menuElements = document.querySelectorAll('[data-tab]');
                for (var i = 0; i < menuElements.length; i++) {
                    menuElements[i].classList.remove('active');
                    var id = menuElements[i].getAttribute('data-tab');
                    document.getElementById(id).classList.remove('active');
                }
            }

            var change = function(e) {
                clear();
                e.target.classList.add('active');
                var id = e.currentTarget.getAttribute('data-tab');
                document.getElementById(id).classList.add('active');
            }

            bindAll();
        }

        var connectTabs = new Tabs();



        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $('.edit').on('click', function() {
                var id = $(this).data('id');

                $.ajax({
                    // serverSide: true,
                    type: "POST",
                    url: 'user-by-id',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(res) {


                        $('#id').val(res.id);
                        $('#edit_company_assigned_id').val(res.company_assigned_id);
                        $('#edit_first_name').val(res.first_name);
                        $('#edit_region_id').val(res.region_id);
                        $('#edit_company_id').val(res.company_id);
                        $('#edit_department_id').val(res.department_id);
                        $('#edit_designation_id').val(res.designation_id);
                        $('#edit_town_id').val(res.town_id);
                        $('#edit_db_house_id').val(res.db_house_id);
                        $('#edit_office_shift_id').val(res.office_shift_id);
                        $('#edit_last_name').val(res.last_name);
                        $('#edit_username').val(res.username);
                        $('#edit_territory_id').val(res.territory_id);
                        $('#edit_email').val(res.email);
                        $('#edit_contact_no').val(res.phone);
                        $('#edit_address').val(res.address);
                        $('#ajaxModelTitle').html("data");
                        $('#edit-modal').modal('show');

                    }
                });
            });


            var i = 1;


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

            $(document).on('change', '.employee_type', function() {
                let employee_type = $(this).val();
                if (employee_type == 'Contactual') {
                    $('.expiry_date').show();
                    $('.train_month').hide();
                    $('.probation_hide').hide();
                    $('.probation').hide();
                } else if (employee_type == 'Trainee') {
                    $('.train_month').show();
                    $('.expiry_date').hide();
                    $('.intern_hide').hide();
                    $('.probation_hide').hide();
                    $('.probation').hide();
                } else if (employee_type == 'Probation') {
                    $('.train_month').hide();
                    $('.expiry_date').hide();
                    $('.expiry_date').hide();
                    $('.expiry_date_hide').hide();


                    $('.probation').show().html(
                        '<div class="input-group mb-3"><label class="text-bold">{{ __('Probation Month') }}</label><select name="in_probation_month_1" id="" class="form-control" required><option value="">Select Month</option><option value="3">Three Month</option><option value="6">Six Month</option></select></div>'
                        );
                } else if (employee_type == 'Intern') {
                    $('.train_month').show();
                    $('.expiry_date').hide();
                    $('.expiry_date_hide').hide();
                    $('.probation_hide').hide();
                    $('.probation').hide();
                } else if (employee_type == 'Permanent') {
                    $('.train_month').hide();
                    $('.expiry_date').hide();
                    $('.expiry_date_hide').hide();
                    $('.probation_hide').hide()

                    $('.probation').hide();
                } else if (employee_type == 'Project-Based') {
                    $('.train_month').hide();
                    $('.expiry_date').hide();
                    $('.expiry_date_hide').hide();
                    $('.probation_hide').hide();
                    $('.probation').hide();
                } else if (employee_type == 'Part Time') {
                    $('.train_month').hide();
                    $('.expiry_date').hide();
                    $('.probation_hide').hide();
                    $('.probation').hide();

                }
            });

      $('#attendance_type').on('change', function() {
                var attendance_type = $(this).val();
                // alert(attendance_type);
                if (attendance_type == 'general') {
                    $('.device_area').hide();
                } else if (attendance_type == 'ip_based') {
                    $('.device_area').hide();
                } else {
                    $('.device_area').show();
                }
            })

            $('.company_id').on('change', function() {
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
                                $('.department_id').empty();
                                $('.department_id').append(
                                    '<option hidden>Choose Department</option>');
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

            $('.department_id').on('change', function() {
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
                                $('#edit_designation_id').empty();
                                $('#edit_designation_id').show();
                                $('#parent-container').hide();
                                $('#error-message').hide();
                                $('#edit_designation_id').append(
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

                                        $('#edit_designation_id').hide();
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
                var departmentID = $('#edit_designation_id').val();
                if (departmentID == '') {
                    event.preventDefault(); // Prevent the form from submitting
                    $('#error-message').text('Please set vacancy for Designation.').show();

                } else {
                    $('#error-message').hide();
                }
            });
            $('.company_id').on('change', function() {
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
                                $('.office_shift_id').empty();
                                $('.office_shift_id').append(
                                    '<option hidden>Choose Office Shift</option>');
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



            $('.region_id').on('change', function() {
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
                                $('.area_id').empty();
                                $('.area_id').append('<option hidden>Choose Area</option>');
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


            $('.area_id').on('change', function() {
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
                                $('.territory_id').empty();
                                $('.territory_id').append(
                                    '<option hidden>Choose Territory</option>');
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

            $('.territory_id').on('change', function() {
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
                                $('.town_id').empty();
                                $('.town_id').append('<option hidden>Choose Town</option>');
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

            $('.town_id').on('change', function() {
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
                                $('.db_house_id').empty();
                                $('.db_house_id').append('<option hidden>Choose Town</option>');
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

            $('.db_house_id').on('change', function() {
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
                                $('.location_six_id').empty();
                                $('.location_six_id').append(
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
            $('.location_six_id').on('change', function() {
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
                                $('.location_seven_id').empty();
                                $('.location_seven_id').append(
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
            $('.location_seven_id').on('change', function() {
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
                                $('.location_eight_id').empty();
                                $('.location_eight_id').append(
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
            $('.location_eight_id').on('change', function() {
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
                                $('.location_nine_id').empty();
                                $('.location_nine_id').append(
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

            $('.location_nine_id').on('change', function() {
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
                                $('.location_ten_id').empty();
                                $('.location_ten_id').append(
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
            $('.location_ten_id').on('change', function() {
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
                                $('.location_eleven_id').empty();
                                $('.location_eleven_id').append(
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

            $('#division_id').on('change', function() {
                var regionID = $(this).val();
                if (regionID) {
                    $.ajax({
                        url: '/get-district/' + regionID,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#district_id').empty();
                                $('#district_id').append(
                                    '<option hidden value="" >Choose Division</option>');
                                $.each(data, function(key, districts) {
                                    $('select[name="district_id"]').append(
                                        '<option value="' + districts.id + '">' +
                                        districts.dist_name + '</option>');
                                });
                            } else {
                                $('#districts').empty();
                            }
                        }
                    });
                } else {
                    $('#districts').empty();
                }
            });


            $('#district_id').on('change', function() {
                var areaID = $(this).val();
                if (areaID) {
                    $.ajax({
                        url: '/get-upazila/' + areaID,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#upazila_id').empty();
                                $('#upazila_id').append(
                                    '<option hidden value="" >Choose Upazila</option>');
                                $.each(data, function(key, upazilas) {
                                    $('select[name="upazila_id"]').append(
                                        '<option value="' + upazilas.id + '">' +
                                        upazilas.up_name + '</option>');
                                });
                            } else {
                                $('#upazilas').empty();
                            }
                        }
                    });
                } else {
                    $('#upazilas').empty();
                }
            });

            $('#upazila_id').on('change', function() {
                var areaID = $(this).val();
                if (areaID) {
                    $.ajax({
                        url: '/get-union/' + areaID,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#union_id').empty();
                                $('#union_id').append(
                                    '<option hidden value="">Choose Union</option>');
                                $.each(data, function(key, unions) {
                                    $('select[name="union_id"]').append(
                                        '<option value="' + unions.id + '">' +
                                        unions.un_name + '</option>');
                                });
                            } else {
                                $('#unions').empty();
                            }
                        }
                    });
                } else {
                    $('#unions').empty();
                }
            });



            $('#present_division_id').on('change', function() {
                var regionID = $(this).val();
                if (regionID) {
                    $.ajax({
                        url: '/get-district/' + regionID,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#present_district_id').empty();
                                $('#present_district_id').append(
                                    '<option hidden value="" >Choose Division</option>');
                                $.each(data, function(key, p_districts) {
                                    $('select[name="present_district_id"]').append(
                                        '<option value="' + p_districts.id + '">' +
                                        p_districts.dist_name + '</option>');
                                });
                            } else {
                                $('#p_districts').empty();
                            }
                        }
                    });
                } else {
                    $('#p_districts').empty();
                }
            });


            $('#present_district_id').on('change', function() {
                var areaID = $(this).val();
                if (areaID) {
                    $.ajax({
                        url: '/get-upazila/' + areaID,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#present_upazila_id').empty();
                                $('#present_upazila_id').append(
                                    '<option hidden value="" >Choose Upazila</option>');
                                $.each(data, function(key, p_upazilas) {
                                    $('select[name="present_upazila_id"]').append(
                                        '<option value="' + p_upazilas.id + '">' +
                                        p_upazilas.up_name + '</option>');
                                });
                            } else {
                                $('#upazilas').empty();
                            }
                        }
                    });
                } else {
                    $('#p_upazilas').empty();
                }
            });

            $('#present_upazila_id').on('change', function() {
                var areaID = $(this).val();
                if (areaID) {
                    $.ajax({
                        url: '/get-union/' + areaID,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#present_union_id').empty();
                                $('#present_union_id').append(
                                    '<option hidden value="">Choose Union</option>');
                                $.each(data, function(key, p_unions) {
                                    $('select[name="present_union_id"]').append(
                                        '<option value="' + p_unions.id + '">' +
                                        p_unions.un_name + '</option>');
                                });
                            } else {
                                $('#p_unions').empty();
                            }
                        }
                    });
                } else {
                    $('#p_unions').empty();
                }
            });

            $("#identification_number").keyup(function() {
                var identification_number = $(this).val();
                // console.log(identification_number);
                $.ajax({
                    type: "POST",
                    url: "{{ route('check.id') }}",
                    data: {
                        table_name: 'employee_details',
                        colum_name: 'identification_number',
                        colum_value: identification_number
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    success: function(res) {
                        // console.log(res);
                        if (res == 0) {
                            // $("#email").val(email);
                            $("#identification_number_error").html(' ');
                        } else {

                            $("#identification_number_error").html('<b style="color:red;">' +
                                identification_number + ' has already been used<b/>');
                            $("#identification_number").val('');

                        }

                    }
                });


            });

        });
    </script>

@endsection
