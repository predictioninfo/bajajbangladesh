<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .cover_area {
        height: 130px;
        position: relative;
    }

    .persone_name {
        box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;
        border-radius: 5px;
        padding: 5rem 0 25px 25px;
        margin-bottom: 2rem;
    }

    .profile_image img {
        position: absolute;
        width: 150px;
        height: 150px;
        border-radius: 50%;
        border: 9px solid white;
        bottom: -42%;
        left: 15%;
    }

    /* .persone_name:last-child {
    padding: 25px;
} */

    .profile_info {
        box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;
    }

    .tabs-nav ul {
        margin: 0;
        padding: 0;
        display: flex;
    }

    .tabs-nav li {
        list-style: none;
    }

    .tabs-nav a {
        display: block;
        padding: 10px 15px;
        font-weight: bold;
        color: black;
    }

    /* Active tab */

    .tabs-nav li.active {
        background: #FFF;
        color: #000;
        border-bottom: 4px solid #971C70;
    }

    .tabs-nav li.active a {
        color: black;
    }

    /* Tab content */

    .tabs-content {
        padding: 10px;
        background: #FFF;
        margin-top: -1px;
        overflow: hidden;
    }

    .tabs-content IMG {
        margin-right: 10px;
    }

    /* Hide all but first content div */

    .tabs-content .tab:not(:first-child) {
        display: none;
    }

    .tab1 {
        padding: 25px;
    }

    p {
        margin: 0;
    }

    .work_information {
        margin-top: 20px;
    }

    #tab2 {
        padding: 25px;
    }
</style>
<script src="https://kit.fontawesome.com/80a1447cb8.js" crossorigin="anonymous"></script>

    <!-- jQuery Cdn link -->

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>

    <!-- Bootstrap cdn link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">



<div class="content-box">

    <div class="container">
        <div class="row d-flex">
            <div class="col-md-4 col-sm-12">
                <div class="cover_area">
                    <div class="bg-secondary w-100 h-100"></div>
                    <div class="profile_image">
                        <img src="{{asset($employee_value->profile_photo)}}" alt="">
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


<script>
$(function() {
    $('.tabs-nav a').click(function() {

      // Check for active
      $('.tabs-nav li').removeClass('active');
      $(this).parent().addClass('active');

      // Display active tab
      let currentTab = $(this).attr('href');
      $('.tabs-content .tab').hide();
      $(currentTab).show();

      return false;
    });
  });



</script>