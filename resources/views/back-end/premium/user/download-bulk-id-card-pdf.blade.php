<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <style>
        .id-card-holder {
            width: 192px;
            height: 288px;
            padding: 4px;
            margin: 0 auto;
            background-color: #1f1f1f;
            border-radius: 5px;
            position: relative;
        }

        /* .id-card-holder:after {
   content: '';
   width: 7px;
   display: block;
   background-color: #0a0a0a;
   height: 100px;
   position: absolute;
   top: 105px;
   border-radius: 0 5px 5px 0;
}
.id-card-holder:before {
   content: '';
   width: 7px;
   display: block;
   background-color: #0a0a0a;
   height: 100px;
   position: absolute;
   top: 105px;
   left: 222px;
   border-radius: 5px 0 0 5px;
} */
        .id-card {

            background-color: #fff;
            padding: 10px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 0 1.5px 0px #b9b9b9;
        }

        .id-card img {
            margin: 0 auto;
        }

        .header img {
            width: 100px;
            margin-top: 15px;
        }

        .photo img {
            width: 80px;
            margin-top: 15px;
        }

        h2 {
            font-size: 15px;
            margin: 5px 0;
        }

        h3 {
            font-size: 12px;
            margin: 2.5px 0;
            font-weight: 300;
        }

        .qr-code img {
            width: 50px;
        }

        p {
            font-size: 5px;
            margin: 2px;
        }

        /* .id-card-hook {
background-color: #000;
   width: 70px;
   margin: 0 auto;
   height: 15px;
   border-radius: 5px 5px 0 0;
} */
        .id-card-hook:after {
            content: '';
            background-color: #d7d6d3;
            width: 47px;
            height: 6px;
            display: block;
            margin: 0px auto;
            position: relative;
            top: 6px;
            border-radius: 4px;
        }

        .id-card-tag-strip {
            width: 45px;
            height: 40px;
            background-color: #0950ef;
            margin: 0 auto;
            border-radius: 5px;
            position: relative;
            top: 9px;
            z-index: 1;
            border: 1px solid #0041ad;
        }

        .id-card-tag-strip:after {
            content: '';
            display: block;
            width: 100%;
            height: 1px;
            background-color: #c1c1c1;
            position: relative;
            top: 10px;
        }

        .id-card-tag {
            width: 0;
            height: 0;
            border-left: 100px solid transparent;
            border-right: 100px solid transparent;
            border-top: 100px solid #0958db;
            margin: -10px auto -30px auto;
        }

        .id-card-tag:after {
            content: '';
            display: block;
            width: 0;
            height: 0;
            border-left: 50px solid transparent;
            border-right: 50px solid transparent;
            border-top: 100px solid #d7d6d3;
            margin: -10px auto -30px auto;
            position: relative;
            top: -130px;
            left: -50px;
        }
    </style>
    </style>

</head>
<!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">-->
<?php
use App\Models\EmployeeDetail;

?>


<div class="container">
    @foreach ($employee_details_value as $employee_value)


    <?php

$employee_details = EmployeeDetail::where('empdetails_employee_id',$employee_value->id)->get('blood_group');

?>
    {{-- @foreach ($employee_details as $employee_details_extra_details) --}}
    <div class="row" style="height:250px;">
        <div class="col" style="padding-left:200px;">
            <div class="card"
                style="width: 192px; height: 288px; border-radius: 0px; border: 3px solid #430fc5; margin-left:60px;">
                <img style="height:100px;width:200px;margin-left:15px; margin-right:15px; margin-top:7px;"
                    src="{{asset('idcard/pla_logo.png')}}">
                <div class="card-body" style="padding-top:-15px;">
                    <img style="height:100px;width:100px;margin-left:33px;text-align: center;padding-left:13px;"
                        src="{{asset($employee_value->profile_photo)}}">
                    <p style="font-size:14px; margin-top:15px; margin-left:5px; text-align: center;font-weight:  bold;">
                        {{$employee_value->first_name.' '.$employee_value->last_name}}</p>
                    <p class="card-text" style=" font-size:10px;text-align: center;">
                        <span
                            style="font-weight: bold; font-size:9px;">{{$employee_value->userdesignation->designation_name}}</span>
                        <br>
                        <span style="font-weight: bold; font-size:9px;">Employee
                            ID:{{$employee_value->company_assigned_id}}</span><br>
                        <span style="font-weight: bold; font-size:8px;">Job Nature:
                            {{$employee_value->employment_type}}</span><br>
                        <span style="font-weight: bold; font-size:9px;">Blood
                            {{-- Group:{{$employee_details_extra_details->blood_group}}</span><br> --}}
                        @if($employee_value->joining_date <= '2022-04-01' ) <span style="font-size:8px;">Joining Date:{{
                            __('2022-04-01')}}</span>
                            @else
                            <span style="font-size:8px;">Joining Date:{{$employee_value->joining_date}}</span>
                            @endif

                    </p>
                </div>
            </div>
        </div>

    </div>
    <br>
    <br>

    {{-- @endforeach --}}
    @endforeach
</div>
</body>

</html>
