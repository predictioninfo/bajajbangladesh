
@extends('layouts.app')

@section('content')

<?php 
use App\Models\Permission;

$employee_sub_module_one_add = "2.1.1";
$employee_sub_module_one_edit = "2.1.2";
$employee_sub_module_one_delete = "2.1.3";
?>

<head>
	<title>Login 10</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!--<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">-->

	<!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico" />
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/fonts/iconic/css/material-design-iconic-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/animsition/css/animsition.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="css/login_util.css">
	<link rel="stylesheet" type="text/css" href="css/login_main.css">

</head>
	
	<div class="limiter" >
		<div class="container-login100">
			<div class="wrap-login100" style="padding-top:-20%;">
				<form class="login100-form validate-form">
					<span class="login100-form-title p-b-26">
						Welcome
					</span>
					<span class="login100-form-title p-b-48">
						<i class="zmdi zmdi-font"></i>
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">
						<input class="input100" type="text" name="email">
						<span class="focus-input100" data-placeholder="Email"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="pass">
						<span class="focus-input100" data-placeholder="Password"></span>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">
								Login
							</button>
						</div>
					</div>

					<div class="text-center p-t-115">
						<span class="txt1">
							Don’t have an account?
						</span>

						<a class="txt2" href="#">
							Sign Up
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="login/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="login/vendor/bootstrap/js/popper.js"></script>
	<script src="login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="login/vendor/daterangepicker/moment.min.js"></script>
	<script src="login/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="login/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/login_main.js"></script>
@endsection


        <!--<div id="" class="" role="dialog">-->
        <!--        <div class="modal-dialog">-->
        <!--            <div class="modal-content">-->


        <!--                <div class="modal-body">-->
        <!--                    <span id="form_result"></span>-->
        <!--                    <form method="post" action="{{route('employees-store')}}" id="sample_form" class="form-horizontal" enctype="multipart/form-data"> -->

        <!--                        @csrf-->
                                
        <!--                        <div class="row">-->

        <!--                            <div class="col-md-6 form-group">-->
        <!--                                <label class="text-bold">{{__('First Name')}} <span class="text-danger">*</span></label>-->
        <!--                                <input type="text" name="first_name" placeholder="{{__('First Name')}}"-->
        <!--                                    required class="form-control">-->
        <!--                            </div>-->
        <!--                            <div class="col-md-6 form-group">-->
        <!--                                <label class="text-bold">{{__('Last Name')}} <span class="text-danger">*</span></label>-->
        <!--                                <input type="text" name="last_name" placeholder="{{__('Last Name')}}"-->
        <!--                                    required class="form-control">-->
        <!--                            </div>-->

        <!--                            <div class="col-md-6 form-group">-->
        <!--                                <label class="text-bold">{{__('Email')}} <span class="text-danger">*</span></label>-->
        <!--                                <input type="email" name="email" placeholder="example@example.com" required-->
        <!--                                    class="form-control">-->
        <!--                            </div>-->
        <!--                            <div class="col-md-6 form-group">-->
        <!--                                <label class="text-bold">{{__('Phone')}} <span class="text-danger">*</span></label>-->
        <!--                                <input type="text" name="phone" placeholder="{{__('Phone')}}" required-->
        <!--                                    class="form-control" value="{{ old('contact_no') }}">-->
        <!--                            </div>-->

        <!--                            <div class="col-md-6 form-group">-->
        <!--                                    <label><strong>{{__('Address')}}</strong><span class="text-danger">*</span></label>-->
        <!--                                    <input type="text" name="address" required-->
        <!--                                        class="form-control" value="">-->
        <!--                            </div>-->

        <!--                            <div class="col-md-6 form-group">-->
        <!--                                <label for="" class="text-bold">Area name:</label>-->
                                
        <!--                                <select class="form-control" name="area_id" id="area_id"></select>-->
        <!--                            </div>-->
        <!--                            <div class="col-md-6 form-group">-->
        <!--                                <label for="" class="text-bold">Territory Name:</label>-->
                                
        <!--                                <select class="form-control" name="territory_id" id="territory_id"></select>-->
        <!--                            </div>-->
        <!--                            <div class="col-md-6 form-group">-->
        <!--                                <label for="" class="text-bold">Town  Name:</label>-->
                                
        <!--                                <select class="form-control" name="town_id" id="town_id"></select>-->
        <!--                            </div>-->
        <!--                            <div class="col-md-6 form-group">-->
        <!--                                <label for="" class="text-bold">DB House Name:</label>-->
                            
        <!--                                <select class="form-control" name="db_house_id" id="db_house_id"></select>-->
        <!--                            </div>-->

        <!--                            {{--<div class="col-md-6 form-group">-->
        <!--                                <label for="" class="text-bold">Report To:</label>-->
                            
        <!--                                <select class="form-control" name="report_to_parent_id" id="report_to_parent_id"></select>-->
        <!--                            </div>-->
        <!--                            --}}-->


        <!--                            <div class="col-md-6 form-group">-->
        <!--                                <label class="text-bold">{{__('Password')}} <span class="text-danger">*</span></label>-->
        <!--                                <div class="input-group">-->
        <!--                                    <input type="password" name="password" id="password"-->
        <!--                                        placeholder="{{__('Password')}}"-->
        <!--                                        required class="form-control">-->
        <!--                                </div>-->
        <!--                            </div>-->

        <!--                            <div class="col-md-6 form-group">-->
        <!--                                <label class="text-bold">{{__('Confirm Password')}} <span class="text-danger">*</span></label>-->
        <!--                                <div class="input-group">-->
        <!--                                    <input id="confirm_pass" type="password"-->
        <!--                                        class="form-control "-->
        <!--                                        name="confirm_password" placeholder="{{__('Re-type Password')}}"-->
        <!--                                        required autocomplete="new-password">-->
        <!--                                </div>-->
        <!--                                <div class="form-group">-->
        <!--                                    <div class="registrationFormAlert" id="divCheckPasswordMatch">-->
        <!--                                    </div>-->
        <!--                                </div>-->
        <!--                            </div>-->

        <!--                            <div class="col-md-6 form-group">-->
        <!--                                <label class="text-bold">{{__('Attendance Type')}} <span class="text-danger">*</span></label>-->
        <!--                                <select name="attendance_type" id="attendance_type" required class="selectpicker form-control"-->
        <!--                                        data-live-search="true" data-live-search-style="begins" title="{{__('Select An Attendance Type...')}}">-->
        <!--                                    <option value="general">{{__('General')}}</option>-->
        <!--                                    <option value="ip_based">{{__('IP Based')}}</option>-->
        <!--                                </select>-->
        <!--                            </div>-->

        <!--                            <div class="col-md-6 form-group">-->
        <!--                                <label class="text-bold">{{__('Employment Type')}} <span class="text-danger">*</span></label>-->
        <!--                                <select name="employment_type" id="employment_type" required class="selectpicker form-control"-->
        <!--                                        data-live-search="true" data-live-search-style="begins" title="{{__('Select An Employment Type...')}}" required>-->
        <!--                                    <option value="Permanent">{{__('Permanent')}}</option>-->
        <!--                                    <option value="Contactual">{{__('Contactual')}}</option>-->
        <!--                                    <option value="Project-Based">{{__('Project Based')}}</option>-->
        <!--                                    <option value="Temporary">{{__('Temporary')}}</option>-->
        <!--                                </select>-->
        <!--                            </div>-->

        <!--                            <div class="col-md-6 form-group">-->
        <!--                                <label class="text-bold">{{__('Date Of Joining')}} <span class="text-danger">*</span></label>-->
        <!--                                <input type="date" name="joining_date" id="joining_date" class="form-control date">-->
        <!--                            </div>-->

        <!--                            <div class="col-md-6 form-group">-->
        <!--                                <label class="text-bold">{{__('Expiry Date(if the employee is not permanent)')}} <span class="text-danger">*</span></label>-->
        <!--                                <input type="date" name="expiry_date" id="expiry_date" class="form-control date">-->
        <!--                            </div>-->

                                
        <!--                            <div class="col-md-6 form-group">-->
        <!--                                <label for="profile_photo" class=""><strong>{{ __('Image') }}</strong></label>-->
        <!--                                <input type="file" id="profile_photo"-->
        <!--                                    class="form-control @error('photo') is-invalid @enderror"-->
        <!--                                    name="profile_photo" placeholder="{{__('Upload',['key'=>trans('file.Photo')])}}">-->
        <!--                            </div>-->
                                

        <!--                                <div class="col-md-6 form-group">-->
        <!--                                    <label class="text-bold">{{__('Over Time Type')}} <span class="text-danger">*</span></label>-->
        <!--                                    <select name="user_over_time_type" class="form-control">-->
        <!--                                            <option value="" >Select-A-Overtime-Type</option>-->
        <!--                                            <option value="Manual">Manual</option>-->
        <!--                                            <option value="Automatic">Automatic</option>-->
        <!--                                    </select>-->

        <!--                                </div>-->
                                        
        <!--                                <div class="col-md-4 form-group mt-4 ml-5">-->
        <!--                                    <input type="checkbox" name="over_time_payable" value="Yes" class="form-check-input">-->
        <!--                                    <label class="text-bold" for="exampleCheck1">Overtime Payable</label>-->
        <!--                                </div>-->
                                        
        <!--                                <div class="col-md-6 form-group">-->
        <!--                                <label class="text-bold" for="exampleCheck1">Overtime Rate(Times of Basic)</label>-->
        <!--                                    <input type="text" class="form-control" name="user_over_time_rate" value="" class="form-check-input">-->
        <!--                                </div>-->
        <!--                                <div class="col-md-6 form-group mt-4 ml-5">-->
        <!--                                    <input type="checkbox" name="is_active" value="1" class="form-check-input">-->
        <!--                                    <label class="text-bold" for="exampleCheck1">Is Active</label>-->
        <!--                                </div>-->
                                    
        <!--                            <div class="container">-->
        <!--                                <div class="form-group bold">-->
        <!--                                    <input type="hidden" name="action" id="action"/>-->
        <!--                                    <input type="hidden" name="hidden_id" id="hidden_id"/>-->
        <!--                                    <input type="submit" name="action_button" id="action_button" class="btn btn-warning w-100" value="{{__('Add')}}" />-->
        <!--                                </div>-->
        <!--                            </div>-->
        <!--                        </div>-->

        <!--                    </form>-->

        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--    </div>-->
