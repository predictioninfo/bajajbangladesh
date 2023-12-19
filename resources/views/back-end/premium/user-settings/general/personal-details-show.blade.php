@extends('back-end.premium.layout.employee-setting-main')
@section('content')

<section class="main-contant-section">

    <div class="card mb-0">
        <div class="card-header with-border">
            <h1 class="card-title text-center"> {{__('Employee Personal Details')}} </h1>
            <ol id="breadcrumb1">
                <a href="{{route('employee-details-download')}}"  class="btn btn-grad">
                Download PDF
                </a>
            </ol>
        </div>
    </div>
    <div class="content-box">

    <div class="container">
        <div class="row d-flex">
            <div class="col-md-4 col-sm-12">
                <div class="cover_area">
                    <div class="bg-secondary w-100 h-100"></div>
                    <div class="profile_image">
                        <img src="{{asset($employee_value->profile_photo)}}"alt="">
                    </div>
                </div>
                
                <div class="persone_name">
                    <h3> {{ $employee_value->first_name }} {{ $employee_value->last_name }}</h3>
                    <p><i class="fa-solid fa-envelope pr-2"></i> {{ $employee_value->email }}</p>
                    <p><i class="fa-solid fa-phone pr-2"></i> {{ $employee_value->phone }}</p>
                </div>

            </div>
            <div class="col-md-8 col-sm-12">
                <div class="profile_info">
                    <div>

                        <section class="tabs-content">
                            <div id="tab1" class="tab1 tab">

                                <div class="work_information">
                                    <h5>Employee Details <i class="fa-solid fa-lock-open"></i></h5>
                                    <div class="row border-bottom">
                                        <div class="col-6">
                                            <div class="employe_id mb-3">
                                                <p>Department</p>
                                                <h6>{{ $user->userdepartment->department_name }}</h6>
                                            </div>
                                            <div class="employe_id mb-3">
                                                <p>Date Of Joining</p>
                                                <h6>{{ $employee_value->joining_date }}</h6>
                                            </div>

                                            <div class="employe_id mb-3">
                                                <p>Marital Status</p>
                                                <h6>{{ $user->emoloyeedetail->marital_status }}</h6>
                                            </div>
                                            <div class="employe_id mb-3">
                                                <p>Job Experience </p>
                                                <h6>{{ $user->emoloyeedetail->experience_month ?? ''}}</h6>
                                            </div>
                                            <div class="employe_id mb-3">
                                                <p>Blood Group </p>
                                                <h6>{{ $employee_value->blood_group ?? ''}}</h6>
                                            </div>

                                        </div>
                                        <div class="col-6">
                                            <div class="employe_id mb-3">
                                                <p>Designation</p>
                                                <h6>{{ $user->userdesignation->designation_name }}</h6>
                                            </div>
                                            <div class="employe_id mb-3">
                                                <p>Date Of Birth</p>
                                                <h6>{{ $employee_value->date_of_birth }}</h6>
                                            </div>
                                            <div class="employe_id mb-3">
                                                <p>Gender</p>
                                                <h6>{{ $employee_value->gender }}</h6>
                                            </div>
                                            <div class="employe_id mb-3">
                                                <p>Education</p>
                                                <h6>{{$user->educationdetail->qualification_education_level ?? ''}}</h6>
                                            </div>
                                            <div class="employe_id mb-3">
                                                <p>Employment Type </p>
                                                <h6>{{ $employee_value->employment_type ?? ''}}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="work_information">
                                    <h5>Additional Work Information <i class="fa-solid fa-lock-open"></i></h5>
                                    <div class="row border-bottom">
                                        <div class="col-6">
                                            <div class="employe_id mb-3">
                                                <p>Nationality</p>
                                                <h6>{{ $user->emoloyeedetail->userNationality->name ?? ''}}</h6>
                                            </div>

                                        </div>
                                        <div class="col-6">
                                            <div class="employe_id mb-3">
                                                <p>ID Card Number</p>
                                                <h6>--</h6>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>

                        </section>
                    </div>
                </div>

            </div>
        </div>

    </div>
    </div>
</section>

@endsection
