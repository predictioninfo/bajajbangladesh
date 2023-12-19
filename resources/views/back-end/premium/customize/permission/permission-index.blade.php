@extends('back-end.premium.layout.premium-main')
@section('content')

<?php

use App\Models\Package;
use App\Models\Permission;
use App\Models\Locatoincustomize;
$locations = Locatoincustomize::where('location_com_id', '=', Auth::user()->com_id)->get();

    foreach ($locations as $location){
    $location1 = $location->location1 ?? "Location1";
    $location2 = $location->location2 ?? "Location2";
    $location3 = $location->location3 ?? "Location3";
    $location4 = $location->location4 ?? "Location4";
    $location5 = $location->location5 ?? "Location5";
    $location6 = $location->location6 ?? "Location6";
    $location7 = $location->location7 ?? "Location7";
    $location8 = $location->location8 ?? "Location8";
    $location9 = $location->location9 ?? "Location9";
    $location10 = $location->location10 ?? "Location10";
    $location11 = $location->location11 ?? "Location11";
    }


$dashboard_module = "0";
$user_settings_panel = "15";


$user_module = "1";
$user_sub_module_one = "1.1";
$user_sub_module_two = "1.2";
$user_sub_module_three = "1.3";

$employee_module = "2";
$employee_sub_module_one = "2.1";
$employee_sub_module_two = "2.2";



$customize_module ="3";
$customize_sub_module_one = "3.1";
$customize_sub_module_two = "3.2";
$customize_sub_module_three = "3.3";
$customize_sub_module_four = "3.4";
$customize_sub_module_five = "3.5";
$customize_sub_module_six = "3.6";
$customize_sub_module_eight = "3.8";
$customize_sub_module_nine = "3.9";
$customize_sub_module_ten = "3.10";
$customize_sub_module_eleven = "3.11";

$customize_sub_module_twelve = '3.12';
$customize_sub_module_thirteen = '3.13';

$customize_sub_module_fourteen = '3.14';
$customize_sub_module_fifteen = '3.15';
$customize_sub_module_sixteen = '3.16';
$customize_sub_module_seventeen = '3.17';


$core_hr_module =  "4";
$core_hr_sub_module_one = "4.1";
$core_hr_sub_module_two = "4.2";
$core_hr_sub_module_three = "4.3";
$core_hr_sub_module_four = "4.4";
$core_hr_sub_module_five = "4.5";
$core_hr_sub_module_six = "4.6";
$core_hr_sub_module_seven = "4.7";
$core_hr_sub_module_eight = "4.8";
$core_hr_sub_module_nine = "4.9";
$core_hr_sub_module_ten = "4.10";
$core_hr_sub_module_eleven = "4.11";
$core_hr_sub_module_twelve = "4.12";

$organization_module = "5";
$organization_sub_module_one = "5.1";
$organization_sub_module_two = "5.2";
$organization_sub_module_three = "5.3";
$organization_sub_module_four = "5.4";
$organization_sub_module_five = "5.5";
$organization_sub_module_six = "5.6";
$organization_sub_module_seven = "5.7";
$organization_sub_module_eight = "5.8";
$organization_sub_module_nine = "5.9";
$organization_sub_module_ten = "5.10";
$organization_sub_module_eleven = "5.11";

$organization_sub_module_twelve = "5.12";
$organization_sub_module_thirteen = "5.13";
$organization_sub_module_fourteen = "5.14";
$organization_sub_module_fifteen = "5.15";
$organization_sub_module_sixteen = "5.16";
$organization_sub_module_seventeen = "5.17";
$organization_sub_module_eighteen = "5.18";
$organization_sub_module_nineteen = "5.19";
$organization_sub_module_twenty = "5.20";
$organization_sub_module_twentyone = "5.21";

$organization_sub_module_twentytwo = "5.22";
$organization_sub_module_twentytwo_add = "5.22.1";
$organization_sub_module_twentytwo_edit= "5.22.2";
$organization_sub_module_twentytwo_delet = "5.22.3";

$organization_sub_module_twentythree = "5.23";
$organization_sub_module_twentythree_add = "5.23.1";
$organization_sub_module_twentythree_edit= "5.23.2";
$organization_sub_module_twentythree_delet = "5.23.3";

$organization_sub_module_twentyfour = "5.24";
$organization_sub_module_twentyfour_add = "5.24.1";
$organization_sub_module_twentyfour_edit= "5.24.2";
$organization_sub_module_twentyfour_delete = "5.24.3";

$time_sheet_module = "6";
$time_sheet_sub_module_one = "6.1";
$time_sheet_sub_module_two = "6.2";
$time_sheet_sub_module_three = "6.3";
$time_sheet_sub_module_four = "6.4";
$time_sheet_sub_module_five = "6.5";
$time_sheet_sub_module_six = "6.6";
$time_sheet_sub_module_seven = "6.7";
$time_sheet_sub_module_eight = "6.8";
$time_sheet_sub_module_nine = "6.9";
$time_sheet_sub_module_ten = "6.10";
$time_sheet_sub_module_eleven = "6.11";

$payroll_module = "7";
$payroll_sub_module_one = "7.1";
$payroll_sub_module_two = "7.2";
$payroll_sub_module_three = "7.3";
$payroll_sub_module_four = "7.4";
$payroll_sub_module_five = "7.5";

$hr_calander_module =  "8";

$hr_report_module = "9";
$hr_report_sub_module_one = "9.1";
$hr_report_sub_module_two = "9.2";
$hr_report_sub_module_three = "9.3";
$hr_report_sub_module_four = "9.4";
$hr_report_sub_module_five = "9.5";
$hr_report_sub_module_six = "9.6";
$hr_report_sub_module_seven = "9.7";
$hr_report_sub_module_eight = "9.8";
$hr_report_sub_module_nine = "9.9";
$hr_report_sub_module_ten = "9.10";

$hr_report_sub_module_eleven ="9.11";
$hr_report_sub_module_twelve ="9.12";
$hr_report_sub_module_thirteen ="9.13";
$hr_report_sub_module_fourteen ="9.14";
$hr_report_sub_module_fifteen ="9.15";
$hr_report_sub_module_sixteen ="9.16";
$hr_report_sub_module_seventeen ="9.17";

$event_and_meeting_module = "10";
$event_and_meeting_sub_module_one = "10.1";
$event_and_meeting_sub_module_two = "10.2";

$project_management_module = "11";
$project_management_sub_module_one = "11.1";
$project_management_sub_module_two = "11.2";

$support_ticket_module = "12";

$assets_module = "13";
$assets_sub_module_one = "13.1";
$assets_sub_module_two = "13.2";

$file_manager_module = "14";
$file_manager_sub_module_one = "14.1";
$file_manager_sub_module_two = "14.2";
$file_manager_sub_module_three = "14.3";

$user_sub_module_one_add = "1.1.1";
$user_sub_module_one_edit = "1.1.2";
$user_sub_module_one_delete = "1.1.3";

$employee_sub_module_one_add = "2.1.1";
$employee_sub_module_one_edit = "2.1.2";
$employee_sub_module_one_delete = "2.1.3";

$customize_sub_module_one_add = "3.1.1";
$customize_sub_module_one_edit = "3.1.2";
$customize_sub_module_one_delete = "3.1.3";
$customize_sub_module_one_permission = "3.1.4";
$customize_sub_module_one_permission_giving = "3.1.5";

$customize_sub_module_three_add = "3.3.1";
$customize_sub_module_three_edit = "3.3.2";
$customize_sub_module_three_delete = "3.3.3";

$customize_sub_module_four_add = "3.4.1";
$customize_sub_module_four_edit = "3.4.2";
$customize_sub_module_four_delete = "3.4.3";

$customize_sub_module_fourteen_add = "3.14.1";
$customize_sub_module_fourteen_edit = "3.14.2";
$customize_sub_module_fourteen_delete = "3.14.3";

$customize_sub_module_fifteen_add = "3.15.1";
$customize_sub_module_fifteen_edit = "3.15.2";
$customize_sub_module_fifteen_delete = "3.15.3";

$customize_sub_module_five_add = "3.5.1";
$customize_sub_module_five_edit = "3.5.2";
$customize_sub_module_five_delete = "3.5.3";

$customize_sub_module_six_add = "3.6.1";
$customize_sub_module_six_edit = "3.6.2";
$customize_sub_module_six_delete = "3.6.3";

$customize_sub_module_eight_add = "3.8.1";
$customize_sub_module_eight_edit = "3.8.2";
$customize_sub_module_eight_delete = "3.8.3";

$customize_sub_module_nine_add = "3.9.1";
$customize_sub_module_nine_edit = "3.9.2";
$customize_sub_module_nine_delete = "3.9.3";

$customize_sub_module_ten_add = "3.10.1";
$customize_sub_module_ten_edit = "3.10.2";
$customize_sub_module_ten_delete = "3.10.3";

$customize_sub_module_eleven_add = "3.11.1";
$customize_sub_module_eleven_edit = "3.11.2";
$customize_sub_module_eleven_delete = "3.11.3";

$customize_sub_module_twelve_add = '3.12.1';
$customize_sub_module_twelve_edit = '3.12.2';
$customize_sub_module_twelve_delete = '3.12.3';

$customize_sub_module_thirteen_add = '3.13.1';
$customize_sub_module_thirteen_edit = '3.13.2';
$customize_sub_module_thirteen_delete = '3.13.3';

$customize_sub_module_sixteen_add = '3.16.1';
$customize_sub_module_sixteen_edit = '3.16.2';
$customize_sub_module_sixteen_delete = '3.16.3';

$customize_sub_module_seventeen_add = '3.17.1';
$customize_sub_module_seventeen_edit = '3.17.2';
$customize_sub_module_seventeen_delete = '3.17.3';

$customize_sub_module_eighteen = '3.18';
$customize_sub_module_eighteen_add = '3.18.1';
$customize_sub_module_eighteen_edit = '3.18.2';
$customize_sub_module_eighteen_delete = '3.18.3';

$customize_sub_module_nineteen = '3.19';
$customize_sub_module_nineteen_add = '3.19.1';
$customize_sub_module_nineteen_edit = '3.19.2';
$customize_sub_module_nineteen_delete = '3.19.3';

$customize_sub_module_tweenty = '3.20';
$customize_sub_module_tweenty_add = '3.20.1';
$customize_sub_module_tweenty_edit = '3.20.2';
$customize_sub_module_tweenty_delete = '3.20.3';

$customize_sub_module_tweenty_one = '3.21';
$customize_sub_module_tweenty_one_add = '3.21.1';
$customize_sub_module_tweenty_one_edit = '3.21.2';
$customize_sub_module_tweenty_one_delete = '3.21.3';


$customize_sub_module_tweenty_two = "3.22";
$customize_sub_module_tweenty_two_add = "3.22.1";
$customize_sub_module_tweenty_two_edit = "3.22.2";
$customize_sub_module_tweenty_two_delete = "3.22.3";

$customize_sub_module_tweenty_three = "3.23";
$customize_sub_module_tweenty_three_add = "3.23.1";

$customize_sub_module_tweenty_four = '3.24';
$customize_sub_module_tweenty_four_add = '3.24.1';
$customize_sub_module_tweenty_four_edit = '3.24.2';
$customize_sub_module_tweenty_four_delete = '3.24.3';

$customize_sub_module_tweenty_five = '3.25';
$customize_sub_module_tweenty_five_add = '3.25.1';
$customize_sub_module_tweenty_six = '3.26';
$customize_sub_module_tweenty_six_add = '3.26.1';
$customize_sub_module_tweenty_seven = '3.27';
$customize_sub_module_tweenty_seven_add = '3.27.1';


$core_hr_sub_module_one_add = "4.1.1";
$core_hr_sub_module_one_edit = "4.1.2";
$core_hr_sub_module_one_delete = "4.1.3";

$core_hr_sub_module_two_add = "4.2.1";
$core_hr_sub_module_two_edit = "4.2.2";
$core_hr_sub_module_two_delete = "4.2.3";

$core_hr_sub_module_three_add = "4.3.1";
$core_hr_sub_module_three_edit = "4.3.2";
$core_hr_sub_module_three_delete = "4.3.3";

$core_hr_sub_module_four_add = "4.4.1";
$core_hr_sub_module_four_edit = "4.4.2";
$core_hr_sub_module_four_delete = "4.4.3";

$core_hr_sub_module_five_add = "4.5.1";
$core_hr_sub_module_five_edit = "4.5.2";
$core_hr_sub_module_five_delete = "4.5.3";

$core_hr_sub_module_six_add = "4.6.1";
$core_hr_sub_module_six_edit = "4.6.2";
$core_hr_sub_module_six_delete = "4.6.3";

$core_hr_sub_module_seven_add = "4.7.1";
$core_hr_sub_module_seven_edit = "4.7.2";
$core_hr_sub_module_seven_delete = "4.7.3";

$core_hr_sub_module_eight_add = "4.8.1";
$core_hr_sub_module_eight_edit = "4.8.2";
$core_hr_sub_module_eight_delete = "4.8.3";

$core_hr_sub_module_twelve_add = "4.12.1";
$core_hr_sub_module_twelve_edit = "4.12.2";
$core_hr_sub_module_twelve_delete = "4.12.3";

$core_hr_sub_module_thirteen = "4.13";
$core_hr_sub_module_thirteen_add = "4.13.1";
$core_hr_sub_module_thirteen_edit = "4.13.2";
$core_hr_sub_module_thirteen_delete = "4.13.3";

$core_hr_sub_module_fourteen = "4.14";
$core_hr_sub_module_fourteen_add = "4.14.1";
$core_hr_sub_module_fourteen_edit = "4.14.2";
$core_hr_sub_module_fourteen_delete = "4.14.3";

$core_hr_sub_module_fifteen = "4.15";
$core_hr_sub_module_fifteen_add = "4.15.1";
$core_hr_sub_module_fifteen_edit = "4.15.2";
$core_hr_sub_module_fifteen_delete = "4.15.3";


$organization_sub_module_two_add = "5.2.1";
$organization_sub_module_two_edit = "5.2.2";
$organization_sub_module_two_delete = "5.2.3";

$organization_sub_module_three_add = "5.3.1";
$organization_sub_module_three_edit = "5.3.2";
$organization_sub_module_three_delete = "5.3.3";

$organization_sub_module_four_add = "5.4.1";
$organization_sub_module_four_edit = "5.4.2";
$organization_sub_module_four_delete = "5.4.3";

$organization_sub_module_five_add = "5.5.1";
$organization_sub_module_five_edit = "5.5.2";
$organization_sub_module_five_delete = "5.5.3";

$organization_sub_module_six_add = "5.6.1";
$organization_sub_module_six_edit = "5.6.2";
$organization_sub_module_six_delete = "5.6.3";

$organization_sub_module_seven_add = "5.7.1";
$organization_sub_module_seven_edit = "5.7.2";
$organization_sub_module_seven_delete = "5.7.3";

$organization_sub_module_eight_add = "5.8.1";
$organization_sub_module_eight_edit = "5.8.2";
$organization_sub_module_eight_delete = "5.8.3";

$organization_sub_module_nine_add = "5.9.1";
$organization_sub_module_nine_edit = "5.9.2";
$organization_sub_module_nine_delete = "5.9.3";

$organization_sub_module_ten_add = "5.10.1";
$organization_sub_module_ten_edit = "5.10.2";
$organization_sub_module_ten_delete = "5.10.3";

$organization_sub_module_eleven_add = "5.11.1";
$organization_sub_module_eleven_edit = "5.11.2";
$organization_sub_module_eleven_delete = "5.11.3";


$organization_sub_module_twelve_add = "5.12.1";
$organization_sub_module_twelve_update = "5.12.2";
$organization_sub_module_twelve_delete = "5.12.3";
$organization_sub_module_thirteen_add = "5.13.1";
$organization_sub_module_thirteen_update = "5.13.2";
$organization_sub_module_thirteen_delete= "5.13.3";
$organization_sub_module_fourteen_add = "5.14.1";
$organization_sub_module_fourteen_update = "5.14.2";
$organization_sub_module_fourteen_delete = "5.14.3";
$organization_sub_module_fifteen = "5.15";
$organization_sub_module_fifteen_add = "5.15.1";
$organization_sub_module_fifteen_update = "5.15.2";
$organization_sub_module_fifteen_delete = "5.15.3";
$organization_sub_module_sixteen = "5.16";
$organization_sub_module_sixteen_add = "5.16.1";
$organization_sub_module_sixteen_update = "5.16.2";
$organization_sub_module_sixteen_delete = "5.16.3";
$organization_sub_module_seventeen = "5.17";
$organization_sub_module_seventeen_add = "5.17.1";
$organization_sub_module_seventeen_update = "5.17.2";
$organization_sub_module_seventeen_delete = "5.17.3";



$time_sheet_sub_module_six_add = "6.6.1";
$time_sheet_sub_module_six_edit = "6.6.2";
$time_sheet_sub_module_six_delete = "6.6.3";

$time_sheet_sub_module_seven_add = "6.7.1";
$time_sheet_sub_module_seven_edit = "6.7.2";
$time_sheet_sub_module_seven_delete = "6.7.3";

$time_sheet_sub_module_eight_add = "6.8.1";
$time_sheet_sub_module_eight_edit = "6.8.2";
$time_sheet_sub_module_eight_delete = "6.8.3";

$time_sheet_sub_module_nine_add = "6.9.1";
$time_sheet_sub_module_nine_edit = "6.9.2";
$time_sheet_sub_module_nine_delete = "6.9.3";

$time_sheet_sub_module_ten_add = "6.10.1";
$time_sheet_sub_module_ten_edit = "6.10.2";
$time_sheet_sub_module_ten_delete = "6.10.3";




$event_and_meeting_sub_module_one_add = "10.1.1";
$event_and_meeting_sub_module_one_edit = "10.1.2";
$event_and_meeting_sub_module_one_delete = "10.1.3";

$event_and_meeting_sub_module_two_add = "10.2.1";
$event_and_meeting_sub_module_two_edit = "10.2.2";
$event_and_meeting_sub_module_two_delete = "10.2.3";


$project_management_sub_module_one_add = "11.1.1";
$project_management_sub_module_one_edit = "11.1.2";
$project_management_sub_module_one_delete = "11.1.3";

$project_management_sub_module_two_add = "11.2.1";
$project_management_sub_module_two_edit = "11.2.2";
$project_management_sub_module_two_delete = "11.2.3";

$support_ticket_module_add = "12.0.1";
$support_ticket_module_edit = "12.0.2";
$support_ticket_module_delete = "12.0.3";


$assets_sub_module_one_add = "13.1.1";
$assets_sub_module_one_edit = "13.1.2";
$assets_sub_module_one_delete = "13.1.3";

$assets_sub_module_two_add = "13.2.1";
$assets_sub_module_two_edit = "13.2.2";
$assets_sub_module_two_delete = "13.2.3";


$file_manager_sub_module_one_add = "14.1.1";
$file_manager_sub_module_one_edit = "14.1.2";
$file_manager_sub_module_one_delete = "14.1.3";

$file_manager_sub_module_two_add = "14.2.1";
$file_manager_sub_module_two_edit = "14.2.2";
$file_manager_sub_module_two_delete = "14.2.3";

$performance_module = "15";

$performance_sub_module_one = "15.1";
$performance_sub_module_one_add = "15.1.1";
$performance_sub_module_one_edit = "15.1.2";
$performance_sub_module_one_delete = "15.1.3";

$performance_sub_module_two = "15.2";
$performance_sub_module_two_add = "15.2.1";
$performance_sub_module_two_edit = "15.2.2";
$performance_sub_module_two_delete = "15.2.3";

$performance_sub_module_three = "15.3";
$performance_sub_module_three_add = "15.3.1";
$performance_sub_module_three_edit = "15.3.2";
$performance_sub_module_three_delete = "15.3.3";

$performance_sub_module_four = "15.4";

$performance_sub_module_five = "15.5";

$performance_sub_module_six = "15.6";

$performance_sub_module_seven = "15.7";

$performance_sub_module_eight = "15.8";

$performance_sub_module_nine = "15.9";
$performance_sub_module_ten = "15.10";

$performance_sub_module_eleven = "15.11";
$performance_sub_module_eleven_add = "15.11.1";
$performance_sub_module_eleven_edit = "15.11.2";
$performance_sub_module_eleven_delete = "15.11.3";

$performance_sub_module_twelve = "15.12";

$recruitment_module = "16";

$recruitment_sub_module_one = "16.1";
$recruitment_sub_module_one_add = "16.1.1";
$recruitment_sub_module_one_edit = "16.1.2";
$recruitment_sub_module_one_delete = "16.1.3";

$recruitment_sub_module_two = "16.2";
$recruitment_sub_module_two_action = "16.2.1";

$recruitment_sub_module_three = "16.3";

$training_module = "17";

$training_sub_module_one = "17.1";
$training_sub_module_one_add = "16.1.1";
$training_sub_module_one_edit = "16.1.2";
$training_sub_module_one_delete = "16.1.3";

$training_sub_module_two = "17.2";
$training_sub_module_two_add = "16.1.1";
$training_sub_module_two_edit = "16.1.2";
$training_sub_module_two_delete = "16.1.3";


$template_module = '18';
    $template_sub_module_one = '18.1';
    $template_sub_module_two = '18.2';
    $template_sub_module_three = '18.3';
    $template_sub_module_four = '18.4';
    $template_sub_module_five = '18.5';
    $template_sub_module_six = '18.6';
    $template_sub_module_seven = '18.7';
    $template_sub_module_eight = '18.8';
    $template_sub_module_nine = '18.9';
    $template_sub_module_ten = '18.10';
    $template_sub_module_eleven = '18.11';

$training_sub_module_three = "17.3";
$training_sub_module_three_add = "16.1.1";
$training_sub_module_three_edit = "16.1.2";
$training_sub_module_three_delete = "16.1.3";

$probation_module = "19";
$probation_sub_module_one = "19.1";
$probation_sub_module_two = "19.2";

$finger_print_module = "20";
$finger_print_sub_module_one = "20.1";
$finger_print_sub_module_one_add = "20.1.1";
$finger_print_sub_module_one_edit = "20.1.2";
$finger_print_sub_module_one_delete = "20.1.3";

$finger_print_sub_module_two = "20.2";
$finger_print_sub_module_device_list = "20.2.1";
$finger_print_sub_module_re_boot = "20.2.2";


$finger_print_sub_module_three = "20.3";
$employee_without_finger_print_sub_module = "20.3.1";

$finger_print_sub_module_four = "20.4";
$employee_with_finger_print_sub_module = "20.4.1";

$finger_print_sub_module_five = "20.5";
$finger_print_sub_module_five_add = "20.5.1";
$finger_print_sub_module_five_edit = "20.5.2";
$finger_print_sub_module_five_delete = "20.5.3";

$finger_print_sub_module_six = "20.6";
$finger_print_sub_module_six_add = "20.6.1";
$finger_print_sub_module_six_edit = "20.6.2";

?>
<section class="main-contant-section">

    <div class="container-fluid mb-3">

        @if(Session::get('message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{Session::get('message')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

    </div>




    <div class="container">
        <div class="card mb-4">
            <div class="card-header with-border">
                <h1 class="text-center mt-2">{{ucfirst($roles_name)}}</h1>
            </div>
        </div>

        <p>You can assign permission for this role</p>

        <form id="permission-dashboard" method="post" action="{{route('permission-givings')}}" class="form-horizontal"
            enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="permission_role_id" value="{{$role_id}}">

            <div class="row">

                @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module, \'["' .
                $dashboard_module . '"]\')')->exists())
                <div class="col-md-12 form-group check-box">
                    <div class="permission-title">
                        <span class="select-user-module dropdown-toggle"></span>
                        <h2 style="margin-left:33px;margin-top:-20px;"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $dashboard_module . '"]\')')->exists()){echo 'checked';} ?> class="form-check-input
                            user-check" type="checkbox" name="dashboard_module" value="0">Dashboard</h2>
                    </div>
                </div>
                @endif

                {{-- <div class="col-md-12 form-group check-box">
                    <div class="permission-title">
                        <span class="select-user-module dropdown-toggle"></span>
                        <h2 style="margin-left:33px;margin-top:-20px;"><input <?php
                            //     if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            // \'["' . $user_settings_panel . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            user-check" type="checkbox" name="user_settings_panel" value="15">User Settings Panel</h2>
                    </div>
                </div> --}}


{{--
                @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module, \'["' .
                $user_module . '"]\')')->exists())
                <div class="col-md-12 form-group check-box">
                    <div class="permission-title">
                        <span class="select-user-module dropdown-toggle"></span>
                        <h2 style="margin-left:33px;margin-top:-20px;"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $user_module . '"]\')')->exists()){echo 'checked';} ?> class="form-check-input
                            user-check"
                            type="checkbox" name="user_module" value="1" id="usersAll">Users</h2>
                    </div>
                    <div class="permission-container">
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $user_sub_module_one . '"]\')')->exists())
                        <div style="margin-left:70px;" class="user-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $user_sub_module_one . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            user-module-check" type="checkbox" name="user_sub_module_one" value="1.1"
                            id="userlistAll"><span
                                class="select-user-list-sub-module dropdown-toggle btn btn-success">User List</span>
                        </div>
                        <div style="margin-left:80px;" class="user-list-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $user_sub_module_one_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            user-list-sub-module-check" type="checkbox" name="user_sub_module_one_add" value="1.1.1">Add
                            User
                        </div>
                        <div style="margin-left:80px;" class="user-list-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $user_sub_module_one_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            user-list-sub-module-check" type="checkbox" name="user_sub_module_one_edit"
                            value="1.1.2">Update
                            User</div>
                        <div style="margin-left:80px;" class="user-list-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $user_sub_module_one_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input user-list-sub-module-check" type="checkbox"
                            name="user_sub_module_one_delete" value="1.1.3">Delete User</div>
                        @endif
                    </div>
                </div>
                @endif --}}


                {{-- @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module, \'["' .
                $employee_module . '"]\')')->exists())
                <div class="col-md-12 form-group check-box">
                    <div class="permission-title">
                        <span class="select-employee-module dropdown-toggle"></span>
                        <h2 style="margin-left:33px;margin-top:-20px;"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $employee_module . '"]\')')->exists()){echo 'checked';} ?> class="form-check-input
                            user-check" type="checkbox" name="employee_module" value="2" id="employeeAll">Employees</h2>
                    </div>
                    <div class="permission-container">

                    </div>
                </div>
                @endif --}}

                @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module, \'["' .
                $customize_module . '"]\')')->exists())
                <div class="col-md-12 form-group check-box">
                    <div class="permission-title">
                        <span class="select-customize-module dropdown-toggle"></span>
                        <h2 style="margin-left:33px;margin-top:-20px;"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_module . '"]\')')->exists()){echo 'checked';} ?> class="form-check-input
                            user-check" type="checkbox" name="customize_module" value="3" id="customizeAll">Common
                            Settings
                        </h2>
                    </div>
                    <div class="permission-container">

                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $customize_sub_module_one . '"]\')')->exists())
                        <div style="margin-left:70px;" class="customize-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_one . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            customize-module-check" type="checkbox" name="customize_sub_module_one" value="3.1"
                            id="rulesAll"><span
                                class="select-roles-sub-module dropdown-toggle btn btn-success">Roles</span>
                        </div>
                        <div style="margin-left:80px;" class="roles-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_one_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input roles-sub-module-check" type="checkbox"
                            name="customize_sub_module_one_add"
                            value="3.1.1">Add Rules</div>
                        <div style="margin-left:80px;" class="roles-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_one_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input roles-sub-module-check" type="checkbox"
                            name="customize_sub_module_one_edit"
                            value="3.1.2">Update Rules</div>
                        <div style="margin-left:80px;" class="roles-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_one_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input roles-sub-module-check" type="checkbox"
                            name="customize_sub_module_one_delete" value="3.1.3">Delete Rules</div>
                        <div style="margin-left:80px;" class="roles-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_one_permission . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input roles-sub-module-check" type="checkbox"
                            name="customize_sub_module_one_permission" value="3.1.4">Permission</div>
                        <div style="margin-left:80px;" class="roles-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_one_permission_giving . '"]\')')->exists()){echo 'checked';}
                            ?>
                            class="form-check-input roles-sub-module-check" type="checkbox"
                            name="customize_sub_module_one_permission_giving" value="3.1.5">Permission Giving Action
                        </div>
                        @endif
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $customize_sub_module_two . '"]\')')->exists())
                        <div style="margin-left:70px;" class="customize-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_two . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            customize-module-check" type="checkbox" name="customize_sub_module_two" value="3.2">Access
                            Permission</div>
                        @endif


                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $customize_sub_module_three . '"]\')')->exists())
                        <div style="margin-left:70px;" class="customize-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_three . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input customize-module-check" type="checkbox"
                            name="customize_sub_module_three"
                            value="3.3" id="variabletypeAll"><span
                                class="select-variable-type-sub-module dropdown-toggle btn btn-success">Variable
                                Type</span>
                        </div>
                        <div style="margin-left:80px;" class="variable-type-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_three_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input variable-type-sub-module-check" type="checkbox"
                            name="customize_sub_module_three_add" value="3.3.1">Add Variable Type</div>
                        <div style="margin-left:80px;" class="variable-type-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_three_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input variable-type-sub-module-check" type="checkbox"
                            name="customize_sub_module_three_edit" value="3.3.2">Update Variable Type</div>
                        <div style="margin-left:80px;" class="variable-type-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_three_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input variable-type-sub-module-check" type="checkbox"
                            name="customize_sub_module_three_delete" value="3.3.3">Delete Variable Type</div>
                        @endif



                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $customize_sub_module_four . '"]\')')->exists())
                        <div style="margin-left:70px;" class="customize-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_four . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            customize-module-check" type="checkbox" name="customize_sub_module_four" value="3.4"
                            id="variablemethodAll"><span
                                class="select-variable-method-sub-module dropdown-toggle btn btn-success">Variable
                                Method</span>
                        </div>
                        <div style="margin-left:80px;" class="variable-method-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_four_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input variable-method-sub-module-check" type="checkbox"
                            name="customize_sub_module_four_add" value="3.4.1">Add Variable Method</div>
                        <div style="margin-left:80px;" class="variable-method-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_four_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input variable-method-sub-module-check" type="checkbox"
                            name="customize_sub_module_four_edit" value="3.4.2">Update Variable Method</div>
                        <div style="margin-left:80px;" class="variable-method-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_four_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input variable-method-sub-module-check" type="checkbox"
                            name="customize_sub_module_four_delete" value="3.4.3">Delete Variable Method</div>
                        @endif

                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $customize_sub_module_fourteen . '"]\')')->exists())
                        <div style="margin-left:70px;" class="customize-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_fourteen . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            customize-module-check" type="checkbox" name="customize_sub_module_fourteen" value="3.14"
                            id="variablemethodAll"><span
                                class="select-variable-method-sub-module dropdown-toggle btn btn-success">Upazila</span>
                        </div>

                        <div style="margin-left:80px;" class="variable-method-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_fourteen_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input variable-method-sub-module-check" type="checkbox"
                            name="customize_sub_module_fourteen_add" value="3.14.1">Add Upazila</div>
                        <div style="margin-left:80px;" class="variable-method-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_fourteen_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input variable-method-sub-module-check" type="checkbox"
                            name="customize_sub_module_fourteen_edit" value="3.14.2">Update Upazila</div>
                        <div style="margin-left:80px;" class="variable-method-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_fourteen_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input variable-method-sub-module-check" type="checkbox"
                            name="customize_sub_module_fourteen_delete" value="3.14.3">Delete Upazila</div>
                        @endif

                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $customize_sub_module_fifteen . '"]\')')->exists())
                        <div style="margin-left:70px;" class="customize-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_fifteen . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            customize-module-check" type="checkbox" name="customize_sub_module_fifteen" value="3.15"
                            id="variablemethodAll"><span
                                class="select-variable-method-sub-module dropdown-toggle btn btn-success">Union</span>
                        </div>
                        <div style="margin-left:80px;" class="variable-method-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_fifteen_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input variable-method-sub-module-check" type="checkbox"
                            name="customize_sub_module_fifteen_add" value="3.15.1">Add Union</div>
                        <div style="margin-left:80px;" class="variable-method-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_fifteen_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input variable-method-sub-module-check" type="checkbox"
                            name="customize_sub_module_fifteen_edit" value="3.15.2">Update Union</div>
                        <div style="margin-left:80px;" class="variable-method-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_fifteen_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input variable-method-sub-module-check" type="checkbox"
                            name="customize_sub_module_fifteen_delete" value="3.15.3">Delete Union</div>
                        @endif


                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $customize_sub_module_tweenty_three . '"]\')')->exists())
                        <div style="margin-left:70px;" class="customize-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_tweenty_three . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            customize-module-check" type="checkbox" name="customize_sub_module_tweenty_three"
                            value="3.23"
                            id="taxconfigAll"><span
                                class="select-tax-config-sub-module dropdown-toggle btn btn-success">Minimum Tax
                                Configure</span></div>
                        <div style="margin-left:80px;" class="tax-config-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_tweenty_three_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input tax-config-sub-module-check" type="checkbox"
                            name="customize_sub_module_tweenty_three_add" value="3.23.1">Add Minimum Tax Configure</div>

                        @endif

                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $customize_sub_module_five . '"]\')')->exists())
                        <div style="margin-left:70px;" class="customize-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_five . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            customize-module-check" type="checkbox" name="customize_sub_module_five" value="3.5"
                            id="taxconfigAll"><span
                                class="select-tax-config-sub-module dropdown-toggle btn btn-success">Tax
                                Configure</span></div>
                        <div style="margin-left:80px;" class="tax-config-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_five_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input tax-config-sub-module-check" type="checkbox"
                            name="customize_sub_module_five_add" value="3.5.1">Add Tax Configure</div>
                        <div style="margin-left:80px;" class="tax-config-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_five_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input tax-config-sub-module-check" type="checkbox"
                            name="customize_sub_module_five_edit" value="3.5.2">Update Tax Configure</div>
                        <div style="margin-left:80px;" class="tax-config-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_five_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input tax-config-sub-module-check" type="checkbox"
                            name="customize_sub_module_five_delete" value="3.5.3">Delete Tax Configure</div>
                        @endif

                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $customize_sub_module_tweenty_five . '"]\')')->exists())
                        <div style="margin-left:70px;" class="customize-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_tweenty_five . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            customize-module-check" type="checkbox" name="customize_sub_module_tweenty_five"
                            value="3.25"
                            id="taxconfigAll"><span
                                class="select-tax-config-sub-module dropdown-toggle btn btn-success">Minimum House Rent
                                Non Taxable
                                Configure</span></div>

                        <div style="margin-left:80px;" class="tax-config-sub-module">
                            <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_tweenty_five_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input tax-config-sub-module-check" type="checkbox"
                            name="customize_sub_module_tweenty_five_add" value="3.25.1">Add Minimum House Rent Non
                            Taxable
                            Configure
                        </div>

                        @endif

                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $customize_sub_module_tweenty_six . '"]\')')->exists())
                        <div style="margin-left:70px;" class="customize-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_tweenty_six . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            customize-module-check" type="checkbox" name="customize_sub_module_tweenty_six"
                            value="3.26"
                            id="taxconfigAll"><span
                                class="select-tax-config-sub-module dropdown-toggle btn btn-success">Minimum Medical
                                Allowance Non Taxable
                                Configure</span></div>

                        <div style="margin-left:80px;" class="tax-config-sub-module">
                            <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_tweenty_six_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input tax-config-sub-module-check" type="checkbox"
                            name="customize_sub_module_tweenty_six_add" value="3.26.1">Add Minimum Medical Allowance Non
                            Taxable
                            Configure
                        </div>

                        @endif

                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $customize_sub_module_tweenty_seven . '"]\')')->exists())
                        <div style="margin-left:70px;" class="customize-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_tweenty_seven . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            customize-module-check" type="checkbox" name="customize_sub_module_tweenty_seven"
                            value="3.27"
                            id="taxconfigAll"><span
                                class="select-tax-config-sub-module dropdown-toggle btn btn-success">Minimum Conveyance
                                Allowance Non
                                Taxable Configure</span></div>

                        <div style="margin-left:80px;" class="tax-config-sub-module">
                            <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_tweenty_seven_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input tax-config-sub-module-check" type="checkbox"
                            name="customize_sub_module_tweenty_seven_add" value="3.27.1">Add Minimum Conveyance
                            Allowance Non
                            Taxable Configure
                        </div>

                        @endif



                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $customize_sub_module_six . '"]\')')->exists())
                        <div style="margin-left:70px;" class="customize-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_six . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            customize-module-check" type="checkbox" name="customize_sub_module_six" value="3.6"
                            id="salaryconfigAll"><span
                                class="select-salary-config-sub-module dropdown-toggle btn btn-success">Salary
                                Configure</span>
                        </div>
                        <div style="margin-left:80px;" class="salary-config-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_six_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input salary-config-sub-module-check" type="checkbox"
                            name="customize_sub_module_six_add" value="3.6.1">Add Salary Configure</div>
                        <div style="margin-left:80px;" class="salary-config-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_six_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input salary-config-sub-module-check" type="checkbox"
                            name="customize_sub_module_six_edit" value="3.6.2">Update Salary Configure</div>
                        <div style="margin-left:80px;" class="salary-config-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_six_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input salary-config-sub-module-check" type="checkbox"
                            name="customize_sub_module_six_delete" value="3.6.3">Delete Salary Configure</div>
                        @endif
                        {{-- <div style="margin-left:70px;" class="customize-module"> <input
                                class="form-check-input customize-module-check" type="checkbox" value="3.7">Salary
                            Component
                        </div> --}}
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $customize_sub_module_tweenty_two . '"]\')')->exists())
                        <div style="margin-left:70px;" class="customize-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_tweenty_two . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input customize-module-check" type="checkbox"
                            name="customize_sub_module_tweenty_two"
                            value="3.22" id="festivalAll"><span
                                class="select-festival-sub-module dropdown-toggle btn btn-success">Festival
                                Config </span>
                        </div>
                        <div style="margin-left:80px;" class="festival-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_tweenty_two_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input festival-sub-module-check" type="checkbox"
                            name="customize_sub_module_tweenty_two_add" value="3.22.1">Add Festival
                            Config</div>
                        <div style="margin-left:80px;" class="festival-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_tweenty_two_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input festival-sub-module-check" type="checkbox"
                            name="customize_sub_module_tweenty_two_edit" value="3.22.2">Update Festival
                            Config</div>
                        <div style="margin-left:80px;" class="festival-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_tweenty_two_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input festival-sub-module-check" type="checkbox"
                            name="customize_sub_module_tweenty_two_delete" value="3.22.3">Delete Festival
                            Config</div>
                        @endif




                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $customize_sub_module_eight . '"]\')')->exists())
                        <div style="margin-left:70px;" class="customize-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_eight . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input customize-module-check" type="checkbox"
                            name="customize_sub_module_eight"
                            value="3.8" id="festivalAll"><span
                                class="select-festival-sub-module dropdown-toggle btn btn-success">Festival Month
                                Config</span>
                        </div>
                        <div style="margin-left:80px;" class="festival-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_eight_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input festival-sub-module-check" type="checkbox"
                            name="customize_sub_module_eight_add" value="3.8.1">Add Festival Month
                            Config</div>
                        <div style="margin-left:80px;" class="festival-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_eight_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input festival-sub-module-check" type="checkbox"
                            name="customize_sub_module_eight_edit" value="3.8.2">Update Festival Month
                            Config</div>
                        <div style="margin-left:80px;" class="festival-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_eight_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input festival-sub-module-check" type="checkbox"
                            name="customize_sub_module_eight_delete" value="3.8.3">Delete Festival Month
                            Config</div>
                        @endif


                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $customize_sub_module_tweenty_four . '"]\')')->exists())
                        <div style="margin-left:70px;" class="customize-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_tweenty_four . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            customize-module-check" type="checkbox" name="customize_sub_module_tweenty_four"
                            value="3.24"
                            id="latetimeconfigAll"><span
                                class="select-latetime-config-sub-module dropdown-toggle btn btn-success">Late Time
                                Salary Config</span></div>
                        <div style="margin-left:80px;" class="latetime-config-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_tweenty_four_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input latetime-config-sub-module-check" type="checkbox"
                            name="customize_sub_module_tweenty_four_add" value="3.24.1">Add Late Time Salary Config
                        </div>
                        <div style="margin-left:80px;" class="latetime-config-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_tweenty_four_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input latetime-config-sub-module-check" type="checkbox"
                            name="customize_sub_module_tweenty_four_edit" value="3.24.2">Update Late Time Salary Config
                        </div>
                        <div style="margin-left:80px;" class="latetime-config-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_tweenty_four_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input latetime-config-sub-module-check" type="checkbox"
                            name="customize_sub_module_tweenty_four_delete" value="3.24.3">Delete Late Time Salary
                            Config</div>
                        @endif

                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $customize_sub_module_eleven . '"]\')')->exists())
                        <div style="margin-left:70px;" class="customize-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_eleven . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input customize-module-check" type="checkbox"
                            name="customize_sub_module_eleven"
                            value="3.11" id="companypfconfigAll"><span
                                class="select-company-pf-config-sub-module dropdown-toggle btn btn-success">Company PF
                                Config</span></div>
                        <div style="margin-left:80px;" class="company-pf-config-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_eleven_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input company-pf-config-sub-module-check" type="checkbox"
                            name="customize_sub_module_eleven_add" value="3.11.1">Add Company PF Config</div>
                        <div style="margin-left:80px;" class="company-pf-config-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_eleven_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input company-pf-config-sub-module-check" type="checkbox"
                            name="customize_sub_module_eleven_edit" value="3.11.2">Update Company PF Config</div>
                        <div style="margin-left:80px;" class="company-pf-config-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_eleven_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input company-pf-config-sub-module-check" type="checkbox"
                            name="customize_sub_module_eleven_delete" value="3.11.3">Delete Company PF Config</div>
                        @endif


                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $customize_sub_module_twelve . '"]\')')->exists())
                        <div style="margin-left:70px;" class="customize-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_twelve . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input customize-module-check" type="checkbox"
                            name="customize_sub_module_twelve"
                            value="3.12" id="companypfconfigAll"><span
                                class="select-company-pf-config-sub-module dropdown-toggle btn btn-success">Appointment
                                Footer Config
                            </span></div>
                        <div style="margin-left:80px;" class="company-pf-config-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_twelve_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input company-pf-config-sub-module-check" type="checkbox"
                            name="customize_sub_module_twelve_add" value="3.12.1">Add Appointment
                            Footer Config</div>
                        <div style="margin-left:80px;" class="company-pf-config-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_twelve_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input company-pf-config-sub-module-check" type="checkbox"
                            name="customize_sub_module_twelve_edit" value="3.12.2">Update Appointment
                            Footer Config</div>
                        <div style="margin-left:80px;" class="company-pf-config-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_twelve_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input company-pf-config-sub-module-check" type="checkbox"
                            name="customize_sub_module_twelve_delete" value="3.12.3">Delete Appointment
                            Footer Config</div>
                        @endif

                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $customize_sub_module_thirteen . '"]\')')->exists())
                        <div style="margin-left:70px;" class="customize-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_thirteen . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input customize-module-check" type="checkbox"
                            name="customize_sub_module_thirteen"
                            value="3.13" id="companypfconfigAll"><span
                                class="select-company-pf-config-sub-module dropdown-toggle btn btn-success">Appointment
                                Letter Template
                            </span></div>
                        <div style="margin-left:80px;" class="company-pf-config-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_thirteen_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input company-pf-config-sub-module-check" type="checkbox"
                            name="customize_sub_module_thirteen_add" value="3.13.1">Add Appointment Letter Template
                        </div>
                        <div style="margin-left:80px;" class="company-pf-config-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_thirteen_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input company-pf-config-sub-module-check" type="checkbox"
                            name="customize_sub_module_thirteen_edit" value="3.13.2">Update Appointment Letter Template
                        </div>

                        <div style="margin-left:80px;" class="company-pf-config-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_thirteen_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input company-pf-config-sub-module-check" type="checkbox"
                            name="customize_sub_module_thirteen_delete" value="3.13.3">Delete Appointment Letter
                            Template
                        </div>
                        @endif
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $customize_sub_module_tweenty . '"]\')')->exists())
                        <div style="margin-left:70px;" class="customize-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_tweenty . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input customize-module-check" type="checkbox"
                            name="customize_sub_module_tweenty"
                            value="3.20" id="companypfconfigAll"><span
                                class="select-company-pf-config-sub-module dropdown-toggle btn btn-success">Non
                                Objection Certificate
                            </span></div>
                        <div style="margin-left:80px;" class="company-pf-config-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_tweenty_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input company-pf-config-sub-module-check" type="checkbox"
                            name="customize_sub_module_tweenty_add" value="3.20.1">Add Non Objection Certificate
                        </div>
                        <div style="margin-left:80px;" class="company-pf-config-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_tweenty_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input company-pf-config-sub-module-check" type="checkbox"
                            name="customize_sub_module_tweenty_edit" value="3.20.2">Update Non Objection Certificate
                        </div>

                        <div style="margin-left:80px;" class="company-pf-config-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_tweenty_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input company-pf-config-sub-module-check" type="checkbox"
                            name="customize_sub_module_tweenty_delete" value="3.20.3">Delete Non Objection Certificate
                            Template
                        </div>
                        @endif

                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $customize_sub_module_sixteen . '"]\')')->exists())
                        <div style="margin-left:70px;" class="customize-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_sixteen . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input customize-module-check" type="checkbox"
                            name="customize_sub_module_sixteen"
                            value="3.16" id="companypfconfigAll"><span
                                class="select-company-pf-config-sub-module dropdown-toggle btn btn-success">Company Bank
                                Account
                            </span></div>
                        <div style="margin-left:80px;" class="company-pf-config-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_sixteen_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input company-pf-config-sub-module-check" type="checkbox"
                            name="customize_sub_module_sixteen_add" value="3.16.1">Add Company Bank Account
                        </div>
                        <div style="margin-left:80px;" class="company-pf-config-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_sixteen_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input company-pf-config-sub-module-check" type="checkbox"
                            name="customize_sub_module_sixteen_edit" value="3.16.2">Update Company Bank Account
                        </div>
                        <div style="margin-left:80px;" class="company-pf-config-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_sixteen_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input company-pf-config-sub-module-check" type="checkbox"
                            name="customize_sub_module_sixteen_delete" value="3.16.3">Delete Company Bank Account
                        </div>
                        @endif

                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $customize_sub_module_seventeen . '"]\')')->exists())
                        <div style="margin-left:70px;" class="customize-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_seventeen . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input customize-module-check" type="checkbox"
                            name="customize_sub_module_seventeen"
                            value="3.17" id="companypfconfigAll"><span
                                class="select-company-pf-config-sub-module dropdown-toggle btn btn-success">Company Bank
                                Account Communication
                            </span></div>
                        <div style="margin-left:80px;" class="company-pf-config-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_seventeen_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input company-pf-config-sub-module-check" type="checkbox"
                            name="customize_sub_module_seventeen_add" value="3.17.1">Add Company Bank Account
                            Communication
                        </div>
                        <div style="margin-left:80px;" class="company-pf-config-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_seventeen_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input company-pf-config-sub-module-check" type="checkbox"
                            name="customize_sub_module_seventeen_edit" value="3.17.2">Update Company Bank Account
                            Communication
                        </div>
                        <div style="margin-left:80px;" class="company-pf-config-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_seventeen_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input company-pf-config-sub-module-check" type="checkbox"
                            name="customize_sub_module_seventeen_delete" value="3.17.3">Delete Company Bank Account
                            Communication
                        </div>
                        @endif

                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $customize_sub_module_eighteen . '"]\')')->exists())
                        <div style="margin-left:70px;" class="customize-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_eighteen . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input customize-module-check" type="checkbox"
                            name="customize_sub_module_eighteen"
                            value="3.18" id="companypfconfigAll"><span
                                class="select-company-pf-config-sub-module dropdown-toggle btn btn-success">
                                Warning Letter Format
                            </span></div>
                        <div style="margin-left:80px;" class="company-pf-config-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_eighteen_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input company-pf-config-sub-module-check" type="checkbox"
                            name="customize_sub_module_eighteen_add" value="3.18.1">Add Warning Letter Format
                        </div>
                        <div style="margin-left:80px;" class="company-pf-config-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_eighteen_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input company-pf-config-sub-module-check" type="checkbox"
                            name="customize_sub_module_eighteen_edit" value="3.18.2">Update Warning Letter Format
                        </div>
                        <div style="margin-left:80px;" class="company-pf-config-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_eighteen_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input company-pf-config-sub-module-check" type="checkbox"
                            name="customize_sub_module_eighteen_delete" value="3.18.3">Delete Warning Letter Format
                        </div>
                        @endif


                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $customize_sub_module_nineteen . '"]\')')->exists())
                        <div style="margin-left:70px;" class="customize-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_nineteen . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input customize-module-check" type="checkbox"
                            name="customize_sub_module_nineteen"
                            value="3.19" id="companypfconfigAll"><span
                                class="select-company-pf-config-sub-module dropdown-toggle btn btn-success">
                                Probation Letter Format
                            </span></div>
                        <div style="margin-left:80px;" class="company-pf-config-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_nineteen_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input company-pf-config-sub-module-check" type="checkbox"
                            name="customize_sub_module_nineteen_add" value="3.19.1">Add Probation Letter Format
                        </div>
                        <div style="margin-left:80px;" class="company-pf-config-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_nineteen_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input company-pf-config-sub-module-check" type="checkbox"
                            name="customize_sub_module_nineteen_edit" value="3.19.2">Update Probation Letter Format
                        </div>
                        <div style="margin-left:80px;" class="company-pf-config-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_nineteen_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input company-pf-config-sub-module-check" type="checkbox"
                            name="customize_sub_module_nineteen_delete" value="3.19.3">Delete Probation Letter Format
                        </div>
                        @endif


                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $customize_sub_module_tweenty_one . '"]\')')->exists())
                        <div style="margin-left:70px;" class="customize-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_tweenty_one . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input customize-module-check" type="checkbox"
                            name="customize_sub_module_tweenty_one"
                            value="3.21" id="companypfconfigAll"><span
                                class="select-company-pf-config-sub-module dropdown-toggle btn btn-success">
                                Resignation Letter Template
                            </span></div>
                        <div style="margin-left:80px;" class="company-pf-config-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_tweenty_one_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input company-pf-config-sub-module-check" type="checkbox"
                            name="customize_sub_module_tweenty_one_add" value="3.21.1">Add Resignation Letter Template
                        </div>
                        <div style="margin-left:80px;" class="company-pf-config-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_tweenty_one_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input company-pf-config-sub-module-check" type="checkbox"
                            name="customize_sub_module_tweenty_one_edit" value="3.21.2">Update Resignation Letter
                            Template
                        </div>
                        <div style="margin-left:80px;" class="company-pf-config-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_tweenty_one_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input company-pf-config-sub-module-check" type="checkbox"
                            name="customize_sub_module_tweenty_one_delete" value="3.21.3">Delete Resignation Letter
                            Template
                        </div>
                        @endif

                    </div>
                </div>
                @endif



                @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module, \'["' .
                $template_module . '"]\')')->exists())
                <div class="col-md-12 form-group check-box">
                    <div class="permission-title">
                        <span class="select-core-hr-module dropdown-toggle"></span>
                        <h2 style="margin-left:33px;margin-top:-20px;"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $template_module . '"]\')')->exists()){echo 'checked';} ?> class="form-check-input
                            user-check" type="checkbox" name="template_module" value="18" id="coreHrAll">Template Settings</h2>
                    </div>
                    <div class="permission-container">

                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $template_sub_module_ten . '"]\')')->exists())
                        <div style="margin-left:70px;" class="core-hr-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $template_sub_module_ten . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            core-hr-module-check" type="checkbox" name="template_sub_module_ten" value="18.10">Header Config
                        </div>
                        @endif

                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $template_sub_module_one . '"]\')')->exists())
                        <div style="margin-left:70px;" class="core-hr-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $template_sub_module_one . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            core-hr-module-check" type="checkbox" name="template_sub_module_one" value="18.1">Footer Config
                        </div>
                        @endif

                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $template_sub_module_two . '"]\')')->exists())
                        <div style="margin-left:70px;" class="core-hr-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $template_sub_module_two . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            core-hr-module-check" type="checkbox" name="template_sub_module_two" value="18.2">Appointment Letter Template
                        </div>
                        @endif

                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $template_sub_module_three . '"]\')')->exists())
                        <div style="margin-left:70px;" class="core-hr-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $template_sub_module_three . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            core-hr-module-check" type="checkbox" name="template_sub_module_three" value="18.3">Warning Letter Format
                        </div>
                        @endif

                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $template_sub_module_four . '"]\')')->exists())
                        <div style="margin-left:70px;" class="core-hr-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $template_sub_module_four . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            core-hr-module-check" type="checkbox" name="template_sub_module_four" value="18.4"> Probation Letter Format
                        </div>
                        @endif

                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $template_sub_module_five . '"]\')')->exists())
                        <div style="margin-left:70px;" class="core-hr-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $template_sub_module_five . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            core-hr-module-check" type="checkbox" name="template_sub_module_five" value="18.5"> NOC (Non Objection Certificate) Template
                        </div>
                        @endif

                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $template_sub_module_six . '"]\')')->exists())
                        <div style="margin-left:70px;" class="core-hr-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $template_sub_module_six . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            core-hr-module-check" type="checkbox" name="template_sub_module_six" value="18.6">Resign Acceptance Letter Template
                        </div>
                        @endif

                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $template_sub_module_seven . '"]\')')->exists())
                        <div style="margin-left:70px;" class="core-hr-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $template_sub_module_seven . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            core-hr-module-check" type="checkbox" name="template_sub_module_seven" value="18.7">Salary Certificate
                        </div>
                        @endif

                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $template_sub_module_eight . '"]\')')->exists())
                        <div style="margin-left:70px;" class="core-hr-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $template_sub_module_eight . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            core-hr-module-check" type="checkbox" name="template_sub_module_eight" value="18.8">Contact Renewal
                        </div>
                        @endif

                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $template_sub_module_nine . '"]\')')->exists())
                        <div style="margin-left:70px;" class="core-hr-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $template_sub_module_nine . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            core-hr-module-check" type="checkbox" name="template_sub_module_nine" value="18.9">Expericene Letter Template
                        </div>
                        @endif

                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $template_sub_module_eleven . '"]\')')->exists())
                        <div style="margin-left:70px;" class="core-hr-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $template_sub_module_eleven . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            core-hr-module-check" type="checkbox" name="template_sub_module_eleven" value="18.11">Salary Increment Letter Template
                        </div>
                        @endif

                    </div>
                </div>
                @endif




                @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module, \'["' .
                $core_hr_module . '"]\')')->exists())
                <div class="col-md-12 form-group check-box">
                    <div class="permission-title">
                        <span class="select-core-hr-module dropdown-toggle"></span>
                        <h2 style="margin-left:33px;margin-top:-20px;"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $core_hr_module . '"]\')')->exists()){echo 'checked';} ?> class="form-check-input
                            user-check" type="checkbox" name="core_hr_module" value="4" id="coreHrAll">Core HR</h2>
                    </div>
                    <div class="permission-container">

                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $employee_sub_module_one . '"]\')')->exists())
                        <div style="margin-left:70px;" class="employee-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $employee_sub_module_one . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            employee-module-check" type="checkbox" name="employee_sub_module_one" value="2.1"
                            id="employeelistAll"><span
                                class="select-employee-list-sub-module dropdown-toggle btn btn-success">Employee
                                List</span>
                        </div>
                        <div style="margin-left:80px;" class="employee-list-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $employee_sub_module_one_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input employee-list-sub-module-check" type="checkbox"
                            name="employee_sub_module_one_add" value="2.1.1">Add Employee</div>
                        <div style="margin-left:80px;" class="employee-list-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $employee_sub_module_one_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input employee-list-sub-module-check" type="checkbox"
                            name="employee_sub_module_one_edit" value="2.1.2">Update Employee</div>
                        <div style="margin-left:80px;" class="employee-list-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $employee_sub_module_one_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input employee-list-sub-module-check" type="checkbox"
                            name="employee_sub_module_one_delete" value="2.1.3">Delete Employee</div>
                        @endif
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $employee_sub_module_two . '"]\')')->exists())
                        <div style="margin-left:70px;" class="employee-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $employee_sub_module_two . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            employee-module-check" type="checkbox" name="employee_sub_module_two" value="2.2">Import
                            Employees
                        </div>
                        @endif

                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $user_sub_module_two . '"]\')')->exists())
                        <div style="margin-left:70px;" class="user-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $user_sub_module_two . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            user-module-check" type="checkbox" name="user_sub_module_two" value="1.2">Assigning Rules
                        </div>
                        @endif

                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $user_sub_module_three . '"]\')')->exists())
                        <div style="margin-left:70px;" class="user-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $user_sub_module_three . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            user-module-check" type="checkbox" name="user_sub_module_three" value="1.3">Users Last Login
                        </div>
                        @endif


                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $core_hr_sub_module_thirteen . '"]\')')->exists())
                        <div style="margin-left:70px;" class="core-hr-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $core_hr_sub_module_thirteen . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            core-hr-module-check" type="checkbox" name="core_hr_sub_module_thirteen" value="4.13"
                            id="promotionAll"><span
                                class="select-promotion-sub-module dropdown-toggle btn btn-success">Bulk Renew
                            </span>
                        </div>
                        <div style="margin-left:80px;" class="promotion-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $core_hr_sub_module_thirteen_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input promotion-sub-module-check" type="checkbox"
                            name="core_hr_sub_module_thirteen_add" value="4.13.1">Add Bulk Renew</div>
                        <div style="margin-left:80px;" class="promotion-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $core_hr_sub_module_thirteen_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input promotion-sub-module-check" type="checkbox"
                            name="core_hr_sub_module_thirteen_edit" value="4.13.2">Update Bulk Renew</div>
                        <div style="margin-left:80px;" class="promotion-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $core_hr_sub_module_thirteen_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input promotion-sub-module-check" type="checkbox"
                            name="core_hr_sub_module_thirteen_delete" value="4.13.3">Delete Bulk Renew</div>
                        @endif

                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $core_hr_sub_module_fifteen . '"]\')')->exists())
                        <div style="margin-left:70px;" class="core-hr-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $core_hr_sub_module_fifteen . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            core-hr-module-check" type="checkbox" name="core_hr_sub_module_fifteen" value="4.15"
                            id="promotionAll"><span
                                class="select-promotion-sub-module dropdown-toggle btn btn-success">Employee Salary Increment</span>
                        </div>
                        <div style="margin-left:80px;" class="promotion-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $core_hr_sub_module_fifteen_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input promotion-sub-module-check" type="checkbox"
                            name="core_hr_sub_module_fifteen_add" value="4.15.1">Add Salary Increment</div>
                        <div style="margin-left:80px;" class="promotion-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $core_hr_sub_module_fifteen_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input promotion-sub-module-check" type="checkbox"
                            name="core_hr_sub_module_fifteen_edit" value="4.15.2">Update Salary Increment</div>
                        <div style="margin-left:80px;" class="promotion-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $core_hr_sub_module_fifteen_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input promotion-sub-module-check" type="checkbox"
                            name="core_hr_sub_module_fifteen_delete" value="4.15.3">Delete Salary Increment</div>
                        @endif


                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $core_hr_sub_module_one . '"]\')')->exists())
                        <div style="margin-left:70px;" class="core-hr-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $core_hr_sub_module_one . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            core-hr-module-check" type="checkbox" name="core_hr_sub_module_one" value="4.1"
                            id="promotionAll"><span
                                class="select-promotion-sub-module dropdown-toggle btn btn-success">Promotion/Demotion</span>
                        </div>
                        <div style="margin-left:80px;" class="promotion-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $core_hr_sub_module_one_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input promotion-sub-module-check" type="checkbox"
                            name="core_hr_sub_module_one_add" value="4.1.1">Add Promotion</div>
                        <div style="margin-left:80px;" class="promotion-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $core_hr_sub_module_one_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input promotion-sub-module-check" type="checkbox"
                            name="core_hr_sub_module_one_edit" value="4.1.2">Update Promotion</div>
                        <div style="margin-left:80px;" class="promotion-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $core_hr_sub_module_one_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input promotion-sub-module-check" type="checkbox"
                            name="core_hr_sub_module_one_delete" value="4.1.3">Delete Promotion</div>
                        @endif


                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $core_hr_sub_module_twelve . '"]\')')->exists())
                        <div style="margin-left:70px;" class="core-hr-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $core_hr_sub_module_twelve . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            core-hr-module-check" type="checkbox" name="core_hr_sub_module_twelve" value="4.12"
                            id="promotionAll"><span
                                class="select-promotion-sub-module dropdown-toggle btn btn-success">Employee Increment</span>
                        </div>
                        <div style="margin-left:80px;" class="promotion-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $core_hr_sub_module_twelve_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input promotion-sub-module-check" type="checkbox"
                            name="core_hr_sub_module_twelve_add" value="4.12.1">Add Increment</div>
                        <div style="margin-left:80px;" class="promotion-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $core_hr_sub_module_twelve_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input promotion-sub-module-check" type="checkbox"
                            name="core_hr_sub_module_twelve_edit" value="4.12.2">Update Increment</div>
                        <div style="margin-left:80px;" class="promotion-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $core_hr_sub_module_twelve_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input promotion-sub-module-check" type="checkbox"
                            name="core_hr_sub_module_twelve_delete" value="4.12.3">Delete Increment</div>
                        @endif

                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $core_hr_sub_module_two . '"]\')')->exists())
                        <div style="margin-left:70px;" class="core-hr-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $core_hr_sub_module_two . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            core-hr-module-check" type="checkbox" name="core_hr_sub_module_two" value="4.2"
                            id="awardAll"><span
                                class="select-award-sub-module dropdown-toggle btn btn-success">Award</span></div>
                        <div style="margin-left:80px;" class="award-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $core_hr_sub_module_two_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input award-sub-module-check" type="checkbox"
                            name="core_hr_sub_module_two_add"
                            value="4.2.1">Add Award</div>
                        <div style="margin-left:80px;" class="award-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $core_hr_sub_module_two_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input award-sub-module-check" type="checkbox"
                            name="core_hr_sub_module_two_edit"
                            value="4.2.2">Update Award</div>
                        <div style="margin-left:80px;" class="award-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $core_hr_sub_module_two_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input award-sub-module-check" type="checkbox"
                            name="core_hr_sub_module_two_delete"
                            value="4.2.3">Delete Award</div>
                        @endif
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $core_hr_sub_module_three . '"]\')')->exists())
                        <div style="margin-left:70px;" class="core-hr-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $core_hr_sub_module_three . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            core-hr-module-check" type="checkbox" name="core_hr_sub_module_three" value="4.3"
                            id="travelAll"><span
                                class="select-travel-sub-module dropdown-toggle btn btn-success">Travel</span>
                        </div>
                        <div style="margin-left:80px;" class="travel-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $core_hr_sub_module_three_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input travel-sub-module-check" type="checkbox"
                            name="core_hr_sub_module_three_add"
                            value="4.3.1">Add Travel</div>
                        <div style="margin-left:80px;" class="travel-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $core_hr_sub_module_three_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input travel-sub-module-check" type="checkbox"
                            name="core_hr_sub_module_three_edit" value="4.3.2">Update Travel</div>
                        <div style="margin-left:80px;" class="travel-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $core_hr_sub_module_three_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input travel-sub-module-check" type="checkbox"
                            name="core_hr_sub_module_three_delete" value="4.3.3">Delete Travel</div>
                        @endif
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $core_hr_sub_module_four . '"]\')')->exists())
                        <div style="margin-left:70px;" class="core-hr-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $core_hr_sub_module_four . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            core-hr-module-check" type="checkbox" name="core_hr_sub_module_four" value="4.4"
                            id="transferAll"><span
                                class="select-transfer-sub-module dropdown-toggle btn btn-success">Transfer</span></div>
                        <div style="margin-left:80px;" class="transfer-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $core_hr_sub_module_four_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input transfer-sub-module-check" type="checkbox"
                            name="core_hr_sub_module_four_add" value="4.4.1">Add Transfer</div>
                        <div style="margin-left:80px;" class="transfer-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $core_hr_sub_module_four_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input transfer-sub-module-check" type="checkbox"
                            name="core_hr_sub_module_four_edit" value="4.4.2">Update Transfer</div>
                        <div style="margin-left:80px;" class="transfer-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $core_hr_sub_module_four_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input transfer-sub-module-check" type="checkbox"
                            name="core_hr_sub_module_four_delete" value="4.4.3">Delete Transfer</div>
                        @endif
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $core_hr_sub_module_five . '"]\')')->exists())
                        <div style="margin-left:70px;" class="core-hr-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $core_hr_sub_module_five . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            core-hr-module-check" type="checkbox" name="core_hr_sub_module_five" value="4.5"
                            id="resignationAll"><span
                                class="select-resignation-sub-module dropdown-toggle btn btn-success">Resignations</span>
                        </div>
                        <div style="margin-left:80px;" class="resignation-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $core_hr_sub_module_five_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input resignation-sub-module-check" type="checkbox"
                            name="core_hr_sub_module_five_add" value="4.5.1">Add Resignation</div>
                        <div style="margin-left:80px;" class="resignation-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $core_hr_sub_module_five_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input resignation-sub-module-check" type="checkbox"
                            name="core_hr_sub_module_five_edit" value="4.5.2">Update Resignation</div>
                        <div style="margin-left:80px;" class="resignation-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $core_hr_sub_module_five_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input resignation-sub-module-check" type="checkbox"
                            name="core_hr_sub_module_five_delete" value="4.5.3">Delete Resignation</div>
                        @endif
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $core_hr_sub_module_six . '"]\')')->exists())
                        <div style="margin-left:70px;" class="core-hr-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $core_hr_sub_module_six . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            core-hr-module-check" type="checkbox" name="core_hr_sub_module_six" value="4.6"
                            id="complaintAll"><span
                                class="select-complaint-sub-module dropdown-toggle btn btn-success">Complaints</span>
                        </div>
                        <div style="margin-left:80px;" class="complaint-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $core_hr_sub_module_six_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input complaint-sub-module-check" type="checkbox"
                            name="core_hr_sub_module_six_add" value="4.6.1">Add Complaint</div>
                        <div style="margin-left:80px;" class="complaint-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $core_hr_sub_module_six_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input complaint-sub-module-check" type="checkbox"
                            name="core_hr_sub_module_six_edit" value="4.6.2">Update Complaint</div>
                        <div style="margin-left:80px;" class="complaint-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $core_hr_sub_module_six_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input complaint-sub-module-check" type="checkbox"
                            name="core_hr_sub_module_six_delete" value="4.6.3">Delete Complaint</div>
                        @endif
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $core_hr_sub_module_seven . '"]\')')->exists())
                        <div style="margin-left:70px;" class="core-hr-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $core_hr_sub_module_seven . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            core-hr-module-check" type="checkbox" name="core_hr_sub_module_seven" value="4.7"
                            id="warningAll"><span
                                class="select-warning-sub-module dropdown-toggle btn btn-success">Warnings</span></div>
                        <div style="margin-left:80px;" class="warning-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $core_hr_sub_module_seven_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input warning-sub-module-check" type="checkbox"
                            name="core_hr_sub_module_seven_add" value="4.7.1">Add Warning</div>
                        <div style="margin-left:80px;" class="warning-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $core_hr_sub_module_seven_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input warning-sub-module-check" type="checkbox"
                            name="core_hr_sub_module_seven_edit" value="4.7.2">Update Warning</div>
                        <div style="margin-left:80px;" class="warning-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $core_hr_sub_module_seven_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input warning-sub-module-check" type="checkbox"
                            name="core_hr_sub_module_seven_delete" value="4.7.3">Delete Warning</div>
                        @endif
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $core_hr_sub_module_eight . '"]\')')->exists())
                        <div style="margin-left:70px;" class="core-hr-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $core_hr_sub_module_eight . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            core-hr-module-check" type="checkbox" name="core_hr_sub_module_eight" value="4.8"
                            id="terminationAll"><span
                                class="select-termination-sub-module dropdown-toggle btn btn-success">Termination</span>
                        </div>
                        <div style="margin-left:80px;" class="termination-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $core_hr_sub_module_eight_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input termination-sub-module-check" type="checkbox"
                            name="core_hr_sub_module_eight_add" value="4.8.1">Add Termination</div>
                        <div style="margin-left:80px;" class="termination-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $core_hr_sub_module_eight_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input termination-sub-module-check" type="checkbox"
                            name="core_hr_sub_module_eight_edit" value="4.8.2">Update Termination</div>
                        <div style="margin-left:80px;" class="termination-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $core_hr_sub_module_eight_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input termination-sub-module-check" type="checkbox"
                            name="core_hr_sub_module_eight_delete" value="4.8.3">Delete Termination</div>
                        @endif
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $core_hr_sub_module_fourteen . '"]\')')->exists())
                        <div style="margin-left:70px;" class="core-hr-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $core_hr_sub_module_fourteen . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            core-hr-module-check" type="checkbox" name="core_hr_sub_module_fourteen" value="4.14"
                            id="nocAll"><span class="select-noc-sub-module dropdown-toggle btn btn-success">NOC</span>
                        </div>
                        <div style="margin-left:80px;" class="noc-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $core_hr_sub_module_fourteen_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input noc-sub-module-check" type="checkbox"
                            name="core_hr_sub_module_fourteen_add" value="4.14.1">Add NOC</div>
                        <div style="margin-left:80px;" class="noc-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $core_hr_sub_module_fourteen_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input noc-sub-module-check" type="checkbox"
                            name="core_hr_sub_module_fourteen_edit" value="4.14.2">Update NOC</div>
                        <div style="margin-left:80px;" class="noc-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $core_hr_sub_module_fourteen_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input noc-sub-module-check" type="checkbox"
                            name="core_hr_sub_module_fourteen_delete" value="4.14.3">Delete NOC</div>
                        @endif
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $core_hr_sub_module_nine . '"]\')')->exists())
                        <div style="margin-left:70px;" class="core-hr-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $core_hr_sub_module_nine . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            core-hr-module-check" type="checkbox" name="core_hr_sub_module_nine" value="4.9">Eligible PF
                            Members
                        </div>
                        @endif
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $core_hr_sub_module_ten . '"]\')')->exists())
                        <div style="margin-left:70px;" class="core-hr-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $core_hr_sub_module_ten . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            core-hr-module-check" type="checkbox" name="core_hr_sub_module_ten" value="4.10">PF
                            Membership
                            Taking</div>
                        @endif
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $core_hr_sub_module_eleven . '"]\')')->exists())
                        <div style="margin-left:70px;" class="core-hr-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $core_hr_sub_module_eleven . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            core-hr-module-check" type="checkbox" name="core_hr_sub_module_eleven" value="4.11">PF Bank
                            Account
                        </div>
                        @endif
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $probation_sub_module_one . '"]\')')->exists())
                        <div style="margin-left:70px;" class="probations-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $probation_sub_module_one . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            probation-module-check" type="checkbox" name="probation_sub_module_one"
                            value="19.1">Probation Review List
                        </div>
                        @endif
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $probation_sub_module_two . '"]\')')->exists())
                        <div style="margin-left:70px;" class="probations-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $probation_sub_module_two . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            probation-module-check" type="checkbox" name="probation_sub_module_two"
                            value="19.2">Recommendation</div>
                        @endif

                    </div>
                </div>
                @endif

                @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module, \'["' .
                $organization_module . '"]\')')->exists())
                <div class="col-md-12 form-group check-box">
                    <div class="permission-title">
                        <span class="select-organization-module dropdown-toggle"></span>
                        <h2 style="margin-left:33px;margin-top:-20px;"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_module . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            user-check" type="checkbox" value="5" name="organization_module" id="organizationAll"
                            >Organization
                        </h2>
                    </div>
                    <div class="permission-container">
                        {{-- <div style="margin-left:70px;" class="organization-module"> <input
                                class="form-check-input organization-module-check" type="checkbox" value="">Company
                            Organogram
                        </div> --}}

                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $organization_sub_module_one . '"]\')')->exists())
                        <div style="margin-left:70px;" class="organization-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_one . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input organization-module-check" type="checkbox"
                            name="organization_sub_module_one" value="5.1">Company</div>
                        @endif

                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $organization_sub_module_twentytwo . '"]\')')->exists())
                        <div style="margin-left:70px;" class="organization-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_twentytwo . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input organization-module-check" type="checkbox"
                            name="organization_sub_module_twentytwo" value="5.22" id="departmentAll"><span
                                class="select-department-sub-module dropdown-toggle btn btn-success">Organization
                                Configarations</span></div>
                        <div style="margin-left:80px;" class="department-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_twentytwo_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input department-sub-module-check" type="checkbox"
                            name="organization_sub_module_twentytwo_add" value="5.22.1">Add Configarations</div>
                        <div style="margin-left:80px;" class="department-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_twentytwo_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input department-sub-module-check" type="checkbox"
                            name="organization_sub_module_twentytwo_edit" value="5.22.2">Update Configarations</div>
                        <div style="margin-left:80px;" class="department-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_twentytwo_delet . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input department-sub-module-check" type="checkbox"
                            name="organization_sub_module_twentytwo_delet" value="5.22.3">Delete Configarations</div>
                        @endif

                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $organization_sub_module_twentythree . '"]\')')->exists())
                        <div style="margin-left:70px;" class="organization-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_twentythree . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input organization-module-check" type="checkbox"
                            name="organization_sub_module_twentythree" value="5.23" id="departmentAll"><span
                                class="select-department-sub-module dropdown-toggle btn btn-success">Man Power</span>
                        </div>
                        <div style="margin-left:80px;" class="department-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_twentythree_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input department-sub-module-check" type="checkbox"
                            name="organization_sub_module_twentythree_add" value="5.23.1">Add Man Power</div>
                        <div style="margin-left:80px;" class="department-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_twentythree_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input department-sub-module-check" type="checkbox"
                            name="organization_sub_module_twentythree_edit" value="5.23.2">Update Man Power</div>
                        <div style="margin-left:80px;" class="department-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_twentythree_delet . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input department-sub-module-check" type="checkbox"
                            name="organization_sub_module_twentythree_delet" value="5.23.3">Delete Man Power</div>
                        @endif

                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $organization_sub_module_two . '"]\')')->exists())
                        <div style="margin-left:70px;" class="organization-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_two . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input organization-module-check" type="checkbox"
                            name="organization_sub_module_two" value="5.2" id="departmentAll"><span
                                class="select-department-sub-module dropdown-toggle btn btn-success">Department</span>
                        </div>
                        <div style="margin-left:80px;" class="department-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_two_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input department-sub-module-check" type="checkbox"
                            name="organization_sub_module_two_add" value="5.2.1">Add Department</div>
                        <div style="margin-left:80px;" class="department-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_two_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input department-sub-module-check" type="checkbox"
                            name="organization_sub_module_two_edit" value="5.2.2">Update Department</div>
                        <div style="margin-left:80px;" class="department-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_two_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input department-sub-module-check" type="checkbox"
                            name="organization_sub_module_two_delete" value="5.2.3">Delete Department</div>
                        @endif




                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $organization_sub_module_three . '"]\')')->exists())
                        <div style="margin-left:70px;" class="organization-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_three . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input organization-module-check" type="checkbox"
                            name="organization_sub_module_three" value="5.3" id="allowanceheadAll"><span
                                class="select-allowance-head-sub-module dropdown-toggle btn btn-success">Allowance
                                Head</span>
                        </div>
                        <div style="margin-left:80px;" class="allowance-head-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_three_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input allowance-head-sub-module-check" type="checkbox"
                            name="organization_sub_module_three_add" value="5.3.1">Add Allowance Head</div>
                        <div style="margin-left:80px;" class="allowance-head-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_three_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input allowance-head-sub-module-check" type="checkbox"
                            name="organization_sub_module_three_edit" value="5.3.2">Update Allowance Head</div>
                        <div style="margin-left:80px;" class="allowance-head-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_three_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input allowance-head-sub-module-check" type="checkbox"
                            name="organization_sub_module_three_delete" value="5.3.3">Delete Allowance Head</div>
                        @endif

                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $organization_sub_module_twentyfour . '"]\')')->exists())
                        <div style="margin-left:70px;" class="organization-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_twentyfour . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input organization-module-check" type="checkbox"
                            name="organization_sub_module_twentyfour" value="5.24" id="allowanceheadAll"><span
                                class="select-allowance-head-sub-module dropdown-toggle btn btn-success">Lunch
                                Allowance</span>
                        </div>
                        <div style="margin-left:80px;" class="allowance-head-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_twentyfour_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input allowance-head-sub-module-check" type="checkbox"
                            name="organization_sub_module_twentyfour_add" value="5.24.1">Add Lunch
                            Allowance</div>
                        <div style="margin-left:80px;" class="allowance-head-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_twentyfour_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input allowance-head-sub-module-check" type="checkbox"
                            name="organization_sub_module_twentyfour_edit" value="5.24.2">Update Lunch
                            Allowance</div>
                        <div style="margin-left:80px;" class="allowance-head-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_twentyfour_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input allowance-head-sub-module-check" type="checkbox"
                            name="organization_sub_module_twentyfour_delete" value="5.24.3">Delete Lunch
                            Allowance </div>
                        @endif



                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $organization_sub_module_four . '"]\')')->exists())
                        <div style="margin-left:70px;" class="organization-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_four . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input organization-module-check" type="checkbox"
                            name="organization_sub_module_four" value="5.4" id="regionAll"><span
                                class="select-region-sub-module dropdown-toggle btn btn-success">{{ $location1 ??
                                "location1" }}</span></div>
                        <div style="margin-left:80px;" class="region-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_four_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input region-sub-module-check" type="checkbox"
                            name="organization_sub_module_four_add" value="5.4.1">Add {{ $location1 ??
                            "location1" }}</div>
                        <div style="margin-left:80px;" class="region-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_four_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input region-sub-module-check" type="checkbox"
                            name="organization_sub_module_four_edit" value="5.4.2">Update {{ $location1 ??
                            "location1" }}</div>
                        <div style="margin-left:80px;" class="region-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_four_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input region-sub-module-check" type="checkbox"
                            name="organization_sub_module_four_delete" value="5.4.3">Delete {{ $location1 ??
                            "location1" }}</div>
                        @endif
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $organization_sub_module_five . '"]\')')->exists())
                        <div style="margin-left:70px;" class="organization-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_five . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input organization-module-check" type="checkbox"
                            name="organization_sub_module_five" value="5.5" id="areaAll"><span
                                class="select-area-sub-module dropdown-toggle btn btn-success">{{ $location2 ??
                                "location2" }}</span></div>
                        <div style="margin-left:80px;" class="area-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_five_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input area-sub-module-check" type="checkbox"
                            name="organization_sub_module_five_add" value="5.5.1">Add {{ $location2 ??
                            "location2" }}</div>
                        <div style="margin-left:80px;" class="area-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_five_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input area-sub-module-check" type="checkbox"
                            name="organization_sub_module_five_edit" value="5.5.2">Update {{ $location2 ??
                            "location2" }}</div>
                        <div style="margin-left:80px;" class="area-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_five_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input area-sub-module-check" type="checkbox"
                            name="organization_sub_module_five_delete" value="5.5.3">Delete {{ $location2 ??
                            "location2" }}</div>
                        @endif
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $organization_sub_module_six . '"]\')')->exists())
                        <div style="margin-left:70px;" class="organization-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_six . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input organization-module-check" type="checkbox"
                            name="organization_sub_module_six" value="5.6" id="territoryAll"><span
                                class="select-territory-sub-module dropdown-toggle btn btn-success">{{ $location3 ??
                                "location3" }}</span></div>
                        <div style="margin-left:80px;" class="territory-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_six_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input territory-sub-module-check" type="checkbox"
                            name="organization_sub_module_six_add" value="5.6.1">Add {{ $location3 ??
                            "location3" }}</div>
                        <div style="margin-left:80px;" class="territory-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_six_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input territory-sub-module-check" type="checkbox"
                            name="organization_sub_module_six_edit" value="5.6.2">Update {{ $location3 ??
                            "location3" }}</div>
                        <div style="margin-left:80px;" class="territory-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_six_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input territory-sub-module-check" type="checkbox"
                            name="organization_sub_module_six_delete" value="5.6.3">Delete {{ $location3 ??
                            "location3" }}</div>
                        @endif
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $organization_sub_module_seven . '"]\')')->exists())
                        <div style="margin-left:70px;" class="organization-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_seven . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input organization-module-check" type="checkbox"
                            name="organization_sub_module_seven" value="5.7" id="townAll"><span
                                class="select-town-sub-module dropdown-toggle btn btn-success">{{ $location4 ??
                                "location4" }}</span></div>
                        <div style="margin-left:80px;" class="town-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_seven_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input town-sub-module-check" type="checkbox"
                            name="organization_sub_module_seven_add" value="5.7.1">Add {{ $location4 ??
                            "location4" }}</div>
                        <div style="margin-left:80px;" class="town-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_seven_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input town-sub-module-check" type="checkbox"
                            name="organization_sub_module_seven_edit" value="5.7.2">Update {{ $location4 ??
                            "location4" }}</div>
                        <div style="margin-left:80px;" class="town-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_seven_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input town-sub-module-check" type="checkbox"
                            name="organization_sub_module_seven_delete" value="5.7.3">Delete {{ $location4 ??
                            "location4" }}</div>
                        @endif
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $organization_sub_module_eight . '"]\')')->exists())
                        <div style="margin-left:70px;" class="organization-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_eight . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input organization-module-check" type="checkbox"
                            name="organization_sub_module_eight" value="5.8" id="dbhouseAll"><span
                                class="select-db-house-sub-module dropdown-toggle btn btn-success">{{ $location5 ??
                                "location5" }}</span></div>
                        <div style="margin-left:80px;" class="db-house-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_eight_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input db-house-sub-module-check" type="checkbox"
                            name="organization_sub_module_eight_add" value="5.8.1">Add {{ $location5 ??
                            "location5" }}</div>
                        <div style="margin-left:80px;" class="db-house-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_eight_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input db-house-sub-module-check" type="checkbox"
                            name="organization_sub_module_eight_edit" value="5.8.2">Update {{ $location5 ??
                            "location5" }}</div>
                        <div style="margin-left:80px;" class="db-house-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_eight_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input db-house-sub-module-check" type="checkbox"
                            name="organization_sub_module_eight_delete" value="5.8.3">Delete {{ $location5 ??
                            "location5" }}</div>
                        @endif


                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["'
                        .
                        $organization_sub_module_twelve . '"]\')')->exists())
                        <div style="margin-left:70px;" class="organization-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_twelve . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input organization-module-check" type="checkbox"
                            name="organization_sub_module_twelve" value="5.12" id="locationsixall"><span
                                class="select-location-six-sub-module dropdown-toggle btn btn-success">{{ $location6 ??
                                "location6" }}</span>
                        </div>
                        <div style="margin-left:80px;" class="location-six-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_twelve_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input location-six-sub-module-check" type="checkbox"
                            name="organization_sub_module_twelve_add" value="5.12.1">Add {{ $location6 ??
                            "location6" }}</div>
                        <div style="margin-left:80px;" class="location-six-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_twelve_update . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input location-six-sub-module-check" type="checkbox"
                            name="organization_sub_module_twelve_update" value="5.12.2">Update {{ $location6 ??
                            "location6" }}</div>
                        <div style="margin-left:80px;" class="location-six-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_twelve_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input location-six-sub-module-check" type="checkbox"
                            name="organization_sub_module_twelve_delete" value="5.12.3">Delete {{ $location6 ??
                            "location6" }}</div>
                        @endif

                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["'
                        .
                        $organization_sub_module_thirteen . '"]\')')->exists())
                        <div style="margin-left:70px;" class="organization-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_thirteen . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input organization-module-check" type="checkbox"
                            name="organization_sub_module_thirteen" value="5.13" id="locationsevenall"><span
                                class="select-location-seven-sub-module dropdown-toggle btn btn-success">{{ $location7
                                ??
                                "location7" }}</span>
                        </div>
                        <div style="margin-left:80px;" class="location-seven-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_thirteen_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input location-seven-sub-module-check" type="checkbox"
                            name="organization_sub_module_thirteen_add" value="5.13.1">Add {{ $location7 ??
                            "location7" }}</div>
                        <div style="margin-left:80px;" class="location-seven-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_thirteen_update . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input location-seven-sub-module-check" type="checkbox"
                            name="organization_sub_module_thirteen_update" value="5.13.2">Update {{ $location7 ??
                            "location7" }}</div>
                        <div style="margin-left:80px;" class="location-seven--sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_thirteen_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input location-seven-sub-module-check" type="checkbox"
                            name="organization_sub_module_thirteen_delete" value="5.13.3">Delete {{ $location7 ??
                            "location7" }}</div>
                        @endif
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["'
                        .
                        $organization_sub_module_fourteen . '"]\')')->exists())
                        <div style="margin-left:70px;" class="organization-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_fourteen . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input organization-module-check" type="checkbox"
                            name="organization_sub_module_fourteen" value="5.14" id="locationeightall"><span
                                class="select-location-eight-sub-module dropdown-toggle btn btn-success">{{ $location8
                                ??
                                "location8" }}</span>
                        </div>
                        <div style="margin-left:80px;" class="loation-eight-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_fourteen_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input loation-eight-sub-module-check" type="checkbox"
                            name="organization_sub_module_fourteen_add" value="5.14.1">Add {{ $location8 ??
                            "location8" }}</div>
                        <div style="margin-left:80px;" class="loation-eight-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_fourteen_update . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input loation-eight-sub-module-check" type="checkbox"
                            name="organization_sub_module_fourteen_update" value="5.14.2">Update {{ $location8 ??
                            "location8" }}</div>
                        <div style="margin-left:80px;" class="loation-eight-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_fourteen_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input loation-eight-sub-module-check" type="checkbox"
                            name="organization_sub_module_fourteen_delete" value="5.14.3">Delete {{ $location8 ??
                            "location8" }}</div>
                        @endif
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["'
                        .
                        $organization_sub_module_fifteen . '"]\')')->exists())
                        <div style="margin-left:70px;" class="organization-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_fifteen . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input organization-module-check" type="checkbox"
                            name="organization_sub_module_fifteen" value="5.15" id="locationnineall"><span
                                class="select-location-nine-sub-module dropdown-toggle btn btn-success">{{ $location9 ??
                                "location9" }}</span>
                        </div>
                        <div style="margin-left:80px;" class="location-nine-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_fifteen_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input location-nine-sub-module-check" type="checkbox"
                            name="organization_sub_module_fifteen_add" value="5.15.1">Add {{ $location9 ??
                            "location9" }}</div>
                        <div style="margin-left:80px;" class="location-nine-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_fifteen_update . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input location-nine-sub-module-check" type="checkbox"
                            name="organization_sub_module_fifteen_update" value="5.15.2">Update {{ $location9 ??
                            "location9" }}</div>
                        <div style="margin-left:80px;" class="location-nine-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_fifteen_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input location-nine-sub-module-check" type="checkbox"
                            name="organization_sub_module_fifteen_delete" value="5.15.3">Delete {{ $location9 ??
                            "location9" }}</div>
                        @endif
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["'
                        .
                        $organization_sub_module_sixteen . '"]\')')->exists())
                        <div style="margin-left:70px;" class="organization-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_sixteen . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input organization-module-check" type="checkbox"
                            name="organization_sub_module_sixteen" value="5.16" id="locationnineall"><span
                                class="select-location-ten-sub-module dropdown-toggle btn btn-success">{{ $location10 ??
                                "location10" }}</span>
                        </div>
                        <div style="margin-left:80px;" class="locationten-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_sixteen_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input locationten-sub-module-check" type="checkbox"
                            name="organization_sub_module_sixteen_add" value="5.16.1">Add {{ $location10 ??
                            "location10" }}</div>
                        <div style="margin-left:80px;" class="locationten-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_sixteen_update . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input locationten-sub-module-check" type="checkbox"
                            name="organization_sub_module_sixteen_update" value="5.16.2">Update {{ $location10 ??
                            "location10" }}</div>
                        <div style="margin-left:80px;" class="locationten-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_sixteen_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input locationten-sub-module-check" type="checkbox"
                            name="organization_sub_module_sixteen_delete" value="5.16.3">Delete {{ $location10 ??
                            "location10" }}</div>
                        @endif
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["'
                        .
                        $organization_sub_module_seventeen . '"]\')')->exists())
                        <div style="margin-left:70px;" class="organization-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_seventeen . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input organization-module-check" type="checkbox"
                            name="organization_sub_module_seventeen" value="5.17" id="locationnineall"><span
                                class="select-location-eleven-sub-module dropdown-toggle btn btn-success">{{ $location11
                                ??
                                "location11" }}</span>
                        </div>
                        <div style="margin-left:80px;" class="location-eleven-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_seventeen_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input location-eleven-sub-module-check" type="checkbox"
                            name="organization_sub_module_seventeen_add" value="5.17.1">Add {{ $location11 ??
                            "location11" }}</div>
                        <div style="margin-left:80px;" class="location-eleven-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_seventeen_update . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input location-eleven-sub-module-check" type="checkbox"
                            name="organization_sub_module_seventeen_update" value="5.17.2">Update {{ $location11 ??
                            "location11" }}</div>
                        <div style="margin-left:80px;" class="location-eleven-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_seventeen_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input location-eleven-sub-module-check" type="checkbox"
                            name="organization_sub_module_seventeen_delete" value="5.17.3">Delete {{ $location11 ??
                            "location11" }}</div>
                        @endif

                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $organization_sub_module_nine . '"]\')')->exists())
                        <div style="margin-left:70px;" class="organization-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_nine . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input organization-module-check" type="checkbox"
                            name="organization_sub_module_nine" value="5.9" id="designationAll"><span
                                class="select-designation-sub-module dropdown-toggle btn btn-success">Designation</span>
                        </div>
                        <div style="margin-left:80px;" class="designation-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_nine_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input designation-sub-module-check" type="checkbox"
                            name="organization_sub_module_nine_add" value="5.9.1">Add Designation</div>
                        <div style="margin-left:80px;" class="designation-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_nine_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input designation-sub-module-check" type="checkbox"
                            name="organization_sub_module_nine_edit" value="5.9.2">Update Designation</div>
                        <div style="margin-left:80px;" class="designation-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_nine_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input designation-sub-module-check" type="checkbox"
                            name="organization_sub_module_nine_delete" value="5.9.3">Delete Designation</div>
                        @endif
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $organization_sub_module_ten . '"]\')')->exists())
                        <div style="margin-left:70px;" class="organization-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_ten . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input organization-module-check" type="checkbox"
                            name="organization_sub_module_ten" value="5.10" id="announcementAll"><span
                                class="select-announcement-sub-module dropdown-toggle btn btn-success">Announcements</span>
                        </div>
                        <div style="margin-left:80px;" class="announcement-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_ten_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input announcement-sub-module-check" type="checkbox"
                            name="organization_sub_module_ten_add" value="5.10.1">Add Announcements</div>
                        <div style="margin-left:80px;" class="announcement-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_ten_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input announcement-sub-module-check" type="checkbox"
                            name="organization_sub_module_ten_edit" value="5.10.2">Update Announcements</div>
                        <div style="margin-left:80px;" class="announcement-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_ten_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input announcement-sub-module-check" type="checkbox"
                            name="organization_sub_module_ten_delete" value="5.10.3">Delete Announcements</div>
                        @endif
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $organization_sub_module_eleven . '"]\')')->exists())
                        <div style="margin-left:70px;" class="organization-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_eleven . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input organization-module-check" type="checkbox"
                            name="organization_sub_module_eleven" value="5.11" id="companypolicyAll"><span
                                class="select-company-policy-sub-module dropdown-toggle btn btn-success">Company
                                Policy</span>
                        </div>
                        <div style="margin-left:80px;" class="company-policy-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_eleven_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input company-policy-sub-module-check" type="checkbox"
                            name="organization_sub_module_eleven_add" value="5.11.1">Add Company Policy</div>
                        <div style="margin-left:80px;" class="company-policy-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_eleven_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input company-policy-sub-module-check" type="checkbox"
                            name="organization_sub_module_eleven_edit" value="5.11.2">Update Company Policy</div>
                        <div style="margin-left:80px;" class="company-policy-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $organization_sub_module_eleven_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input company-policy-sub-module-check" type="checkbox"
                            name="organization_sub_module_eleven_delete" value="5.11.3">Delete Company Policy</div>
                        @endif
                    </div>
                </div>
                @endif


                @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module, \'["' .
                $time_sheet_module . '"]\')')->exists())
                <div class="col-md-12 form-group check-box">
                    <div class="permission-title">
                        <span class="select-time-sheet-module dropdown-toggle"></span>
                        <h2 style="margin-left:33px;margin-top:-20px;"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $time_sheet_module . '"]\')')->exists()){echo 'checked';} ?> class="form-check-input
                            user-check" type="checkbox" name="time_sheet_module" value="6" id="timeSheetAll">Time Sheets
                        </h2>
                    </div>
                    <div class="permission-container">
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $time_sheet_sub_module_one . '"]\')')->exists())
                        <div style="margin-left:70px;" class="time-sheet-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $time_sheet_sub_module_one . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            time-sheet-module-check" type="checkbox" name="time_sheet_sub_module_one"
                            value="6.1">Attendances
                        </div>
                        @endif
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $time_sheet_sub_module_two . '"]\')')->exists())
                        <div style="margin-left:70px;" class="time-sheet-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $time_sheet_sub_module_two . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            time-sheet-module-check" type="checkbox" name="time_sheet_sub_module_two" value="6.2">Date
                            Wise
                            Attendances</div>
                        @endif
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $time_sheet_sub_module_three . '"]\')')->exists())
                        <div style="margin-left:70px;" class="time-sheet-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $time_sheet_sub_module_three . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input time-sheet-module-check" type="checkbox"
                            name="time_sheet_sub_module_three"
                            value="6.3">Monthly Attendances</div>
                        @endif
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $time_sheet_sub_module_four . '"]\')')->exists())
                        <div style="margin-left:70px;" class="time-sheet-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $time_sheet_sub_module_four . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input time-sheet-module-check" type="checkbox"
                            name="time_sheet_sub_module_four"
                            value="6.4">Update Attendances</div>
                        @endif
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $time_sheet_sub_module_five . '"]\')')->exists())
                        <div style="margin-left:70px;" class="time-sheet-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $time_sheet_sub_module_five . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input time-sheet-module-check" type="checkbox"
                            name="time_sheet_sub_module_five"
                            value="6.5">Import Attendances</div>
                        @endif


                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $time_sheet_sub_module_six . '"]\')')->exists())
                        <div style="margin-left:70px;" class="time-sheet-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $time_sheet_sub_module_six . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            time-sheet-module-check" type="checkbox" name="time_sheet_sub_module_six" value="6.6"
                            id="officeshiftAll"><span
                                class="select-office-shift-sub-module dropdown-toggle btn btn-success">Office
                                Shift</span></div>
                        <div style="margin-left:80px;" class="office-shift-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $time_sheet_sub_module_six_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input office-shift-sub-module-check" type="checkbox"
                            name="time_sheet_sub_module_six_add" value="6.6.1">Add Office Shift</div>
                        <div style="margin-left:80px;" class="office-shift-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $time_sheet_sub_module_six_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input office-shift-sub-module-check" type="checkbox"
                            name="time_sheet_sub_module_six_edit" value="6.6.2">Update Office Shift</div>
                        <div style="margin-left:80px;" class="office-shift-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $time_sheet_sub_module_six_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input office-shift-sub-module-check" type="checkbox"
                            name="time_sheet_sub_module_six_delete" value="6.6.3">Delete Office Shift</div>
                        @endif

                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $customize_sub_module_nine . '"]\')')->exists())
                        <div style="margin-left:70px;" class="customize-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_nine . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            customize-module-check" type="checkbox" name="customize_sub_module_nine" value="3.9"
                            id="overtimeconfigAll"><span
                                class="select-overtime-config-sub-module dropdown-toggle btn btn-success">Over Time
                                Config</span></div>
                        <div style="margin-left:80px;" class="overtime-config-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_nine_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input overtime-config-sub-module-check" type="checkbox"
                            name="customize_sub_module_nine_add" value="3.9.1">Add Over Time Config</div>
                        <div style="margin-left:80px;" class="overtime-config-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_nine_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input overtime-config-sub-module-check" type="checkbox"
                            name="customize_sub_module_nine_edit"value="3.9.2">Update Over Time Config</div>
                        <div style="margin-left:80px;" class="overtime-config-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_nine_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input overtime-config-sub-module-check" type="checkbox"
                            name="customize_sub_module_nine_delete" value="3.9.3">Delete Over Time Config</div>
                        @endif


                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $customize_sub_module_ten . '"]\')')->exists())
                        <div style="margin-left:70px;" class="customize-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_ten . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            customize-module-check" type="checkbox" name="customize_sub_module_ten" value="3.10"
                            id="latetimeconfigAll"><span
                                class="select-latetime-config-sub-module dropdown-toggle btn btn-success">Late Time
                                Config</span></div>
                        <div style="margin-left:80px;" class="latetime-config-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_ten_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input latetime-config-sub-module-check" type="checkbox"
                            name="customize_sub_module_ten_add" value="3.10.1">Add Late Time Config</div>
                        <div style="margin-left:80px;" class="latetime-config-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_ten_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input latetime-config-sub-module-check" type="checkbox"
                            name="customize_sub_module_ten_edit" value="3.10.2">Update Late Time Config</div>
                        <div style="margin-left:80px;" class="latetime-config-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $customize_sub_module_ten_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input latetime-config-sub-module-check" type="checkbox"
                            name="customize_sub_module_ten_delete" value="3.10.3">Delete Late Time Config</div>
                        @endif

                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $time_sheet_sub_module_seven . '"]\')')->exists())
                        <div style="margin-left:70px;" class="time-sheet-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $time_sheet_sub_module_seven . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input time-sheet-module-check" type="checkbox"
                            name="time_sheet_sub_module_seven"
                            value="6.7" id="weeklyholidayAll"><span
                                class="select-weekly-holiday-sub-module dropdown-toggle btn btn-success">Manage Weekly
                                Holiday</span></div>
                        <div style="margin-left:80px;" class="weekly-holiday-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $time_sheet_sub_module_seven_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input weekly-holiday-sub-module-check" type="checkbox"
                            name="time_sheet_sub_module_seven_add" value="6.7.1">Add Weekly Holiday</div>
                        <div style="margin-left:80px;" class="weekly-holiday-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $time_sheet_sub_module_seven_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input weekly-holiday-sub-module-check" type="checkbox"
                            name="time_sheet_sub_module_seven_edit" value="6.7.2">Update Weekly Holiday</div>
                        <div style="margin-left:80px;" class="weekly-holiday-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $time_sheet_sub_module_seven_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input weekly-holiday-sub-module-check" type="checkbox"
                            name="time_sheet_sub_module_seven_delete" value="6.7.3">Delete Weekly Holiday</div>
                        @endif
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $time_sheet_sub_module_eight . '"]\')')->exists())
                        <div style="margin-left:70px;" class="time-sheet-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $time_sheet_sub_module_eight . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input time-sheet-module-check" type="checkbox"
                            name="time_sheet_sub_module_eight"
                            value="6.8" id="otherholidayAll"><span
                                class="select-other-holiday-sub-module dropdown-toggle btn btn-success">Manage Other
                                Holiday</span></div>
                        <div style="margin-left:80px;" class="other-holiday-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $time_sheet_sub_module_eight_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input other-holiday-sub-module-check" type="checkbox"
                            name="time_sheet_sub_module_eight_add" value="6.8.1">Add Other Holiday</div>
                        <div style="margin-left:80px;" class="other-holiday-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $time_sheet_sub_module_eight_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input other-holiday-sub-module-check" type="checkbox"
                            name="time_sheet_sub_module_eight_edit" value="6.8.2">Update Other Holiday</div>
                        <div style="margin-left:80px;" class="other-holiday-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $time_sheet_sub_module_eight_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input other-holiday-sub-module-check" type="checkbox"
                            name="time_sheet_sub_module_eight_delete" value="6.8.3">Delete Other Holiday</div>
                        @endif
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $time_sheet_sub_module_nine . '"]\')')->exists())
                        <div style="margin-left:70px;" class="time-sheet-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $time_sheet_sub_module_nine . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input time-sheet-module-check" type="checkbox"
                            name="time_sheet_sub_module_nine"
                            value="6.9" id="leavetypeAll"><span
                                class="select-leave-type-sub-module dropdown-toggle btn btn-success">Manage Leave
                                Type</span>
                        </div>
                        <div style="margin-left:80px;" class="leave-type-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $time_sheet_sub_module_nine_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input leave-type-sub-module-check" type="checkbox"
                            name="time_sheet_sub_module_nine_add" value="6.9.1">Add Leave Type</div>
                        <div style="margin-left:80px;" class="leave-type-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $time_sheet_sub_module_nine_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input leave-type-sub-module-check" type="checkbox"
                            name="time_sheet_sub_module_nine_edit" value="6.9.2">Update Leave Type</div>
                        <div style="margin-left:80px;" class="leave-type-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $time_sheet_sub_module_nine_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input leave-type-sub-module-check" type="checkbox"
                            name="time_sheet_sub_module_nine_delete" value="6.9.3">Delete Leave Type</div>
                        @endif
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $time_sheet_sub_module_ten . '"]\')')->exists())
                        <div style="margin-left:70px;" class="time-sheet-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $time_sheet_sub_module_ten . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            time-sheet-module-check" type="checkbox" name="time_sheet_sub_module_ten" value="6.10"
                            id="leaveAll"><span class="select-leave-sub-module dropdown-toggle btn btn-success">Manage
                                All
                                Leaves</span></div>
                        <div style="margin-left:80px;" class="leave-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $time_sheet_sub_module_ten_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input leave-sub-module-check" type="checkbox"
                            name="time_sheet_sub_module_ten_add"
                            value="6.10.1">Add Leave</div>
                        <div style="margin-left:80px;" class="leave-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $time_sheet_sub_module_ten_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input leave-sub-module-check" type="checkbox"
                            name="time_sheet_sub_module_ten_edit" value="6.10.2">Update Leave</div>
                        <div style="margin-left:80px;" class="leave-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $time_sheet_sub_module_ten_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input leave-sub-module-check" type="checkbox"
                            name="time_sheet_sub_module_ten_delete" value="6.10.3">Delete Leave</div>
                        @endif
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $time_sheet_sub_module_eleven . '"]\')')->exists())
                        <div style="margin-left:70px;" class="time-sheet-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $time_sheet_sub_module_eleven . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input time-sheet-module-check" type="checkbox"
                            name="time_sheet_sub_module_eleven"
                            value="6.11">Approve Employee Leaves</div>
                        @endif
                    </div>
                </div>
                @endif

                @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module, \'["' .
                $finger_print_module . '"]\')')->exists())
                <div class="col-md-12 form-group check-box">
                    <div class="permission-title">
                        <span class="select-finger-print-module dropdown-toggle"></span>
                        <h2 style="margin-left:33px;margin-top:-20px;"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $finger_print_module . '"]\')')->exists()){echo 'checked';} ?> class="form-check-input
                            user-check" type="checkbox" name="finger_print_module" value="20" id="fingerPrintAll">Finger Print Device Configuration
                        </h2>
                    </div>
                          <div class="permission-container">
                        
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $finger_print_sub_module_five . '"]\')')->exists())
                        <div style="margin-left:70px;" class="finger-print-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $finger_print_sub_module_five . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            finger-print-module-check-ip" type="checkbox" name="finger_print_sub_module_five" value="20.5"
                            id="allIp"><span
                                class="select-finger-print-sub-module-ip dropdown-toggle btn btn-success">IP Set</span></div>
                        <div style="margin-left:80px;" class="finger-print-sub-module-ip"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $finger_print_sub_module_five_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input finger-print-sub-module-check-ip" type="checkbox"
                            name="finger_print_sub_module_five_add" value="20.5.1">Add IP</div>
                        <div style="margin-left:80px;" class="finger-print-sub-module-ip"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $finger_print_sub_module_five_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input finger-print-sub-module-check-ip" type="checkbox"
                            name="finger_print_sub_module_five_edit" value="20.5.2">Update IP</div>
                        <div style="margin-left:80px;" class="finger-print-sub-module-ip"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $finger_print_sub_module_five_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input finger-print-sub-module-check-ip" type="checkbox"
                            name="finger_print_sub_module_five_delete" value="20.5.3">Delete IP</div>
                        @endif
                </div>
                <div class="permission-container">
                        
                    @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                    \'["' .
                    $finger_print_sub_module_six . '"]\')')->exists())
                    <div style="margin-left:70px;" class="finger-print-module"><input <?php
                            if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                        \'["' . $finger_print_sub_module_six . '"]\')')->exists()){echo 'checked';} ?>
                        class="form-check-input
                        finger-print-module-check-token" type="checkbox" name="finger_print_sub_module_six" value="20.6"
                        id="allToken"><span
                            class="select-finger-print-sub-module-token dropdown-toggle btn btn-success">Token Generate</span></div>
                    <div style="margin-left:80px;" class="finger-print-sub-module-token"> <input <?php
                            if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                        \'["' . $finger_print_sub_module_six_add . '"]\')')->exists()){echo 'checked';} ?>
                        class="form-check-input finger-print-sub-module-check-token" type="checkbox"
                        name="finger_print_sub_module_six_add" value="20.6.1">Add Token</div>
                    <div style="margin-left:80px;" class="finger-print-sub-module-token"> <input <?php
                            if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                        \'["' . $finger_print_sub_module_six_edit . '"]\')')->exists()){echo 'checked';} ?>
                        class="form-check-input finger-print-sub-module-check-token" type="checkbox"
                        name="finger_print_sub_module_six_edit" value="20.6.2">Re-fresh Token</div>
                    @endif
            </div>
                    <div class="permission-container">
                        
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $finger_print_sub_module_one . '"]\')')->exists())
                        <div style="margin-left:70px;" class="finger-print-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $finger_print_sub_module_one . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            finger-print-module-check" type="checkbox" name="finger_print_sub_module_one" value="20.1"
                            id="deviceAreaAll"><span
                                class="select-finger-print-sub-module dropdown-toggle btn btn-success">Device Area</span></div>
                        <div style="margin-left:80px;" class="finger-print-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $finger_print_sub_module_one_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input finger-print-sub-module-check" type="checkbox"
                            name="finger_print_sub_module_one_add" value="20.1.1">Add Device Area</div>
                        <div style="margin-left:80px;" class="finger-print-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $finger_print_sub_module_one_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input finger-print-sub-module-check" type="checkbox"
                            name="finger_print_sub_module_one_edit" value="20.1.2">Update Device Area</div>
                        <div style="margin-left:80px;" class="finger-print-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $finger_print_sub_module_one_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input finger-print-sub-module-check" type="checkbox"
                            name="finger_print_sub_module_one_delete" value="20.1.3">Delete Device Area</div>
                        @endif
                </div>
                    <div class="permission-container">
                        
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $finger_print_sub_module_two . '"]\')')->exists())
                        <div style="margin-left:70px;" class="finger-print-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $finger_print_sub_module_two . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            finger-print-device-module-check" type="checkbox" name="finger_print_sub_module_two" value="20.2"
                            id="deviceAll"><span
                                class="select-finger-print-list-module dropdown-toggle btn btn-success">Device</span></div>
                        <div style="margin-left:80px;" class="finger-print-device-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $finger_print_sub_module_device_list . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input finger-print-list-module-check" type="checkbox"
                            name="finger_print_sub_module_device_list" value="20.2.1"> Device List</div>
                        <div style="margin-left:80px;" class="finger-print-device-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $finger_print_sub_module_re_boot . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input finger-print-re-boot-module-check" type="checkbox"
                            name="finger_print_sub_module_re_boot" value="20.2.2"> Device Re-boot</div>
                        @endif
                </div>
                    <div class="permission-container">
                        
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $finger_print_sub_module_three . '"]\')')->exists())
                        <div style="margin-left:70px;" class="finger-print-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $finger_print_sub_module_three . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            employee_without_finger-print-device-module-check" type="checkbox" name="finger_print_sub_module_three" value="20.3"
                            id="employeeWithoutFingerPrint"><span
                                class="select-employee-without-finger-print-list-module dropdown-toggle btn btn-success">Employee Without Finger Print</span></div>
                        <div style="margin-left:80px;" class="employee-without-finger-print-device-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $employee_without_finger_print_sub_module . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input employee-without-finger-print-list-module-check" type="checkbox"
                            name="employee_without_finger_print_sub_module" value="20.3.1"> Add Finger Print</div>
                        @endif
                </div>
                    <div class="permission-container">
                        
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $finger_print_sub_module_four . '"]\')')->exists())
                        <div style="margin-left:70px;" class="finger-print-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $finger_print_sub_module_four . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            employee_with_finger-print-device-module-check" type="checkbox" name="finger_print_sub_module_four" value="20.4"
                            id="employeeWithFingerPrint"><span
                                class="select-employee-with-finger-print-list-module dropdown-toggle btn btn-success">Employee With Finger Print</span></div>
                        <div style="margin-left:80px;" class="employee-with-finger-print-device-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $employee_with_finger_print_sub_module . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input employee-with-finger-print-list-module-check" type="checkbox"
                            name="employee_with_finger_print_sub_module" value="20.4.1"> Delete Finger Print</div>
                        @endif
                </div>
                @endif


                @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module, \'["' .
                $payroll_module . '"]\')')->exists())
                <div class="col-md-12 form-group check-box">
                    <div class="permission-title">
                        <span class="select-pay-roll-module dropdown-toggle"></span>
                        <h2 style="margin-left:33px;margin-top:-20px;"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $payroll_module . '"]\')')->exists()){echo 'checked';} ?> class="form-check-input
                            user-check" type="checkbox" name="payroll_module" value="7" id="payRollAll" >Payroll & Benefits</h2>
                    </div>
                    <div class="permission-container">
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $payroll_sub_module_one . '"]\')')->exists())
                        <div style="margin-left:70px;" class="pay-roll-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $payroll_sub_module_one . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            pay-roll-module-check" type="checkbox" name="payroll_sub_module_one" value="7.1">New Payment
                        </div>
                        @endif
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $payroll_sub_module_two . '"]\')')->exists())
                        <div style="margin-left:70px;" class="pay-roll-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $payroll_sub_module_two . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            pay-roll-module-check" type="checkbox" name="payroll_sub_module_two" value="7.2">Payment
                            History
                        </div>
                        @endif
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $payroll_sub_module_three . '"]\')')->exists())
                        <div style="margin-left:70px;" class="pay-roll-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $payroll_sub_module_three . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            pay-roll-module-check" type="checkbox" name="payroll_sub_module_three" value="7.3">Provident
                            Fund
                            History</div>
                        @endif

                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $payroll_sub_module_four . '"]\')')->exists())
                        <div style="margin-left:70px;" class="pay-roll-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $payroll_sub_module_four . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            pay-roll-module-check" type="checkbox" name="payroll_sub_module_four" value="7.4">Festival
                            Bounus
                            Payment</div>
                        @endif
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $payroll_sub_module_five . '"]\')')->exists())
                        <div style="margin-left:70px;" class="pay-roll-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $payroll_sub_module_five . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            pay-roll-module-check" type="checkbox" name="payroll_sub_module_five" value="7.5">Festival
                            Bounus
                            Payment
                            History</div>
                        @endif
                    </div>
                </div>
                @endif

                {{-- @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module, \'["' .
                $probation_module . '"]\')')->exists())
                <div class="col-md-12 form-group check-box">
                    <div class="permission-title">
                        <span class="select-probation-module dropdown-toggle"></span>
                        <h2 style="margin-left:33px;margin-top:-20px;"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $probation_module . '"]\')')->exists()){echo 'checked';} ?> class="form-check-input
                            user-check" type="checkbox" name="probation_module" value="19" id="probationAll" >Probation
                        </h2>
                    </div>
                    <div class="permission-container">




                    </div>
                </div>
                @endif --}}


                @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module, \'["' .
                $performance_module . '"]\')')->exists())
                <div class="col-md-12 form-group check-box">
                    <div class="permission-title">
                        <span class="select-performance-module dropdown-toggle"></span>
                        <h2 style="margin-left:33px;margin-top:-20px;"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $performance_module . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            user-check" type="checkbox" name="performance_module" value="15"
                            id="performanceAll">Performance
                        </h2>
                    </div>
                    <div class="permission-container">
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $performance_sub_module_one . '"]\')')->exists())
                        <div style="margin-left:70px;" class="performance-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $performance_sub_module_one . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input performance-module-check" type="checkbox"
                            name="performance_sub_module_one"
                            value="15.1" id="goalTypeAll"><span
                                class="select-goal-type-sub-module dropdown-toggle btn btn-success">Configarations</span>
                        </div>
                        <div style="margin-left:80px;" class="goal-type-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $performance_sub_module_one_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input goal-type-sub-module-check" type="checkbox"
                            name="performance_sub_module_one_add" value="15.1.1">Add Configarations</div>
                        <div style="margin-left:80px;" class="goal-type-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $performance_sub_module_one_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input goal-type-sub-module-check" type="checkbox"
                            name="performance_sub_module_one_edit" value="15.1.2">Update Configarations</div>
                        <div style="margin-left:80px;" class="goal-type-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $performance_sub_module_one_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input goal-type-sub-module-check" type="checkbox"
                            name="performance_sub_module_one_delete" value="15.1.3">Delete Configarations</div>

                        @endif
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $performance_sub_module_two . '"]\')')->exists())
                        <div style="margin-left:70px;" class="performance-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $performance_sub_module_two . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input performance-module-check" type="checkbox"
                            name="performance_sub_module_two"
                            value="15.2" id="goalTrackingAll"><span
                                class="select-goal-tracking-sub-module dropdown-toggle btn btn-success">KPI/Objective
                                Set</span>
                        </div>
                        <div style="margin-left:80px;" class="goal-tracking-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $performance_sub_module_two_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input goal-tracking-sub-module-check" type="checkbox"
                            name="performance_sub_module_two_add" value="15.2.1">Add KPI/Objective Set</div>
                        <div style="margin-left:80px;" class="goal-tracking-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $performance_sub_module_two_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input goal-tracking-sub-module-check" type="checkbox"
                            name="performance_sub_module_two_edit" value="15.2.2">Update KPI/Objective Set</div>
                        <div style="margin-left:80px;" class="goal-tracking-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $performance_sub_module_two_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input goal-tracking-sub-module-check" type="checkbox"
                            name="performance_sub_module_two_delete" value="15.2.3">Delete KPI/Objective Set</div>
                        @endif

                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $performance_sub_module_three . '"]\')')->exists())
                        <div style="margin-left:70px;" class="performance-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $performance_sub_module_three . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input performance-module-check" type="checkbox"
                            name="performance_sub_module_three" value="15.3" id="objectiveTypeAll"><span
                                class="select-objective-type-sub-module dropdown-toggle btn btn-success">Employees
                                Objectives
                            </span></div>
                        <div style="margin-left:80px;" class="objective-type-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $performance_sub_module_three_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input objective-type-sub-module-check" type="checkbox"
                            name="performance_sub_module_three_add" value="15.3.1">Add Employees Objectives</div>
                        <div style="margin-left:80px;" class="objective-type-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $performance_sub_module_three_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input objective-type-sub-module-check" type="checkbox"
                            name="performance_sub_module_three_edit" value="15.3.2">Update Employees Objectives</div>
                        <div style="margin-left:80px;" class="objective-type-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $performance_sub_module_three_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input objective-type-sub-module-check" type="checkbox"
                            name="performance_sub_module_three_delete" value="15.3.3">Delete Employees Objectives</div>
                        @endif


                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $performance_sub_module_eleven . '"]\')')->exists())
                        <div style="margin-left:70px;" class="performance-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $performance_sub_module_eleven . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input super-recom-sub-module-check" type="checkbox"
                            name="performance_sub_module_eleven" value="15.11" id="superrecomAll"><span
                                class="select-objective-type-sub-module dropdown-toggle btn btn-success">Supervisor
                                Recommendation
                            </span></div>
                        <div style="margin-left:80px;" class="objective-type-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $performance_sub_module_eleven_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input super-recom-sub-module-check" type="checkbox"
                            name="performance_sub_module_eleven_add" value="15.11.1">Add Supervisor Recommendation</div>
                        <div style="margin-left:80px;" class="objective-type-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $performance_sub_module_eleven_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input super-recom-sub-module-check" type="checkbox"
                            name="performance_sub_module_eleven_edit" value="15.11.2">Update Supervisor Recommendation
                        </div>
                        <div style="margin-left:80px;" class="objective-type-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $performance_sub_module_eleven_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input super-recom-sub-module-check" type="checkbox"
                            name="performance_sub_module_eleven_delete" value="15.11.3">Delete Supervisor Recommendation
                        </div>
                        @endif

                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $performance_sub_module_four . '"]\')')->exists())
                        <div style="margin-left:70px;" class="performance-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $performance_sub_module_four . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input performance-module-check" type="checkbox"
                            name="performance_sub_module_four"
                            value="15.4" id="objectiveTypeConfigAll"><span>Yearly Performance Review Form</span></div>
                        @endif

                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $performance_sub_module_five . '"]\')')->exists())
                        <div style="margin-left:70px;" class="performance-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $performance_sub_module_five . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input performance-module-check" type="checkbox"
                            name="performance_sub_module_five"
                            value="15.5" id="objectiveAll"><span>Yearly Performance Value Form</span></div>
                        @endif

                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $performance_sub_module_six . '"]\')')->exists())
                        <div style="margin-left:70px;" class="performance-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $performance_sub_module_six . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input performance-module-check" type="checkbox"
                            name="performance_sub_module_six"
                            value="15.6" id="yearlyReviewConfigAll"><span>Eligible P/D Employee List</span></div>
                        @endif


                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $performance_sub_module_seven . '"]\')')->exists())
                        <div style="margin-left:70px;" class="performance-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $performance_sub_module_seven . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input performance-module-check" type="checkbox"
                            name="performance_sub_module_seven" value="15.7" id="pdPointConfigAll"><span>Eligible Annual
                                Increment List</span></div>
                        @endif


                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $performance_sub_module_eight . '"]\')')->exists())
                        <div style="margin-left:70px;" class="performance-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $performance_sub_module_eight . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input performance-module-check" type="checkbox"
                            name="performance_sub_module_eight" value="15.8" id="seatAllocationAll"><span>Increment
                                Approval</span></div>

                        @endif
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $performance_sub_module_nine . '"]\')')->exists())
                        <div style="margin-left:70px;" class="performance-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $performance_sub_module_nine . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input performance-module-check" type="checkbox"
                            name="performance_sub_module_nine"
                            value="15.9">Performance Report</div>
                        @endif

                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $performance_sub_module_ten . '"]\')')->exists())
                        <div style="margin-left:70px;" class="performance-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $performance_sub_module_ten . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input performance-module-check" type="checkbox"
                            name="performance_sub_module_ten"
                            value="15.10">Annual Increment Salary History</div>
                        @endif


                    </div>
                </div>
                @endif


                @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module, \'["' .
                $recruitment_module . '"]\')')->exists())
                <div class="col-md-12 form-group check-box">
                    <div class="permission-title">
                        <span class="select-recruitment-module dropdown-toggle"></span>
                        <h2 style="margin-left:33px;margin-top:-20px;"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $recruitment_module . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            user-check" type="checkbox" name="recruitment_module" value="16"
                            id="recruitmentAll">Recruitment
                        </h2>
                    </div>
                    <div class="permission-container">
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $recruitment_sub_module_one . '"]\')')->exists())
                        <div style="margin-left:70px;" class="recruitment-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $recruitment_sub_module_one . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input recruitment-module-check" type="checkbox"
                            name="recruitment_sub_module_one"
                            value="16.1" id="jobPostAll"><span
                                class="select-job-post-sub-module dropdown-toggle btn btn-success">Job Post</span></div>
                        <div style="margin-left:80px;" class="job-post-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $recruitment_sub_module_one_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input job-post-sub-module-check" type="checkbox"
                            name="recruitment_sub_module_one_add" value="16.1.1">Add Job Post</div>
                        <div style="margin-left:80px;" class="job-post-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $recruitment_sub_module_one_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input job-post-sub-module-check" type="checkbox"
                            name="recruitment_sub_module_one_edit" value="16.1.2">Update Job Post</div>
                        <div style="margin-left:80px;" class="job-post-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $recruitment_sub_module_one_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input job-post-sub-module-check" type="checkbox"
                            name="recruitment_sub_module_one_delete" value="16.1.3">Delete Job Post</div>
                        @endif
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $recruitment_sub_module_two . '"]\')')->exists())
                        <div style="margin-left:70px;" class="recruitment-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $recruitment_sub_module_two . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input recruitment-module-check" type="checkbox"
                            name="recruitment_sub_module_two"
                            value="16.2" id="jobCandidateAll"><span
                                class="select-job-candidate-sub-module dropdown-toggle btn btn-success">Job
                                Candidates</span>
                        </div>
                        <div style="margin-left:80px;" class="job-candidate-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $recruitment_sub_module_two_action . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input job-candidate-sub-module-check" type="checkbox"
                            name="recruitment_sub_module_two_action" value="16.2.1">Action</div>
                        @endif
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $recruitment_sub_module_three . '"]\')')->exists())
                        <div style="margin-left:70px;" class="recruitment-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $recruitment_sub_module_three . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input recruitment-module-check" type="checkbox"
                            name="recruitment_sub_module_three" value="16.3">Job Interview</div>
                        @endif
                    </div>
                </div>
                @endif

                @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module, \'["' .
                $training_module . '"]\')')->exists())
                <div class="col-md-12 form-group check-box">
                    <div class="permission-title">
                        <span class="select-training-module dropdown-toggle"></span>
                        <h2 style="margin-left:33px;margin-top:-20px;"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $training_module . '"]\')')->exists()){echo 'checked';} ?> class="form-check-input
                            user-check" type="checkbox" name="training_module" value="17" id="trainingAll" >Training
                        </h2>
                    </div>
                    <div class="permission-container">
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $recruitment_sub_module_one . '"]\')')->exists())
                        <div style="margin-left:70px;" class="training-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $training_sub_module_one . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            training-module-check" type="checkbox" name="training_sub_module_one" value="17.1"
                            id="trainingTypeAll"><span
                                class="select-training-type-sub-module dropdown-toggle btn btn-success">Training
                                Type</span>
                        </div>
                        <div style="margin-left:80px;" class="training-type-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $training_sub_module_one_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input training-type-sub-module-check" type="checkbox"
                            name="training_sub_module_one_add" value="17.1.1">Add Training Type</div>
                        <div style="margin-left:80px;" class="training-type-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $training_sub_module_one_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input training-type-sub-module-check" type="checkbox"
                            name="training_sub_module_one_edit" value="17.1.2">Update Training Type</div>
                        <div style="margin-left:80px;" class="training-type-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $training_sub_module_one_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input training-type-sub-module-check" type="checkbox"
                            name="training_sub_module_one_delete" value="17.1.3">Delete Training Type</div>
                        @endif
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $recruitment_sub_module_one . '"]\')')->exists())
                        <div style="margin-left:70px;" class="training-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $training_sub_module_two . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            training-module-check" type="checkbox" name="training_sub_module_two" value="17.2"
                            id="trainerAll"><span
                                class="select-trainer-sub-module dropdown-toggle btn btn-success">Trainers</span></div>
                        <div style="margin-left:80px;" class="trainer-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $training_sub_module_two_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input trainer-sub-module-check" type="checkbox"
                            name="training_sub_module_two_add"
                            value="17.2.1">Add Trainer</div>
                        <div style="margin-left:80px;" class="trainer-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $training_sub_module_two_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input trainer-sub-module-check" type="checkbox"
                            name="training_sub_module_two_edit" value="17.2.2">Update Trainer</div>
                        <div style="margin-left:80px;" class="trainer-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $training_sub_module_two_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input trainer-sub-module-check" type="checkbox"
                            name="training_sub_module_two_delete" value="17.2.3">Delete Trainer</div>
                        @endif
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $recruitment_sub_module_one . '"]\')')->exists())
                        <div style="margin-left:70px;" class="training-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $training_sub_module_three . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            training-module-check" type="checkbox" name="training_sub_module_three" value="17.3"
                            id="trainingListAll"><span
                                class="select-training-list-sub-module dropdown-toggle btn btn-success">Training
                                List</span>
                        </div>
                        <div style="margin-left:80px;" class="training-list-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $training_sub_module_three_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input training-list-sub-module-check" type="checkbox"
                            name="training_sub_module_three_add" value="17.3.1">Add Training</div>
                        <div style="margin-left:80px;" class="training-list-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $training_sub_module_three_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input training-list-sub-module-check" type="checkbox"
                            name="training_sub_module_three_edit" value="17.3.2">Update Training</div>
                        <div style="margin-left:80px;" class="training-list-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $training_sub_module_three_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input training-list-sub-module-check" type="checkbox"
                            name="training_sub_module_three_delete" value="17.3.3">Delete Training</div>
                        @endif
                    </div>
                </div>
                @endif


                @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module, \'["' .
                $hr_calander_module . '"]\')')->exists())
                <div class="col-md-12 form-group check-box">
                    <div class="permission-title">
                        <span class="select-hr-calander-module dropdown-toggle"></span>
                        <h2 style="margin-left:33px;margin-top:-20px;"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $hr_calander_module . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            user-check" type="checkbox" name="hr_calander_module" value="8" id="hrCalanderAll" >HR
                            Calander</h2>
                    </div>
                </div>
                @endif


                @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module, \'["' .
                $hr_report_module . '"]\')')->exists())
                <div class="col-md-12 form-group check-box">
                    <div class="permission-title">
                        <span class="select-hr-report-module dropdown-toggle"></span>
                        <h2 style="margin-left:33px;margin-top:-20px;"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $hr_report_module . '"]\')')->exists()){echo 'checked';} ?> class="form-check-input
                            user-check" type="checkbox" name="hr_report_module" value="9" id="hrReportAll" >HR Reports
                        </h2>
                    </div>
                    <div class="permission-container">
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $hr_report_sub_module_one . '"]\')')->exists())
                        <div style="margin-left:70px;" class="hr-report-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $hr_report_sub_module_one . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            hr-report-module-check" type="checkbox" name="hr_report_sub_module_one"
                            value="9.1">Attendance
                            Report</div>
                        @endif
                        {{--
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $hr_report_sub_module_two . '"]\')')->exists())
                        <div style="margin-left:70px;" class="hr-report-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $hr_report_sub_module_two . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            hr-report-module-check" type="checkbox" name="hr_report_sub_module_two" value="9.2">Training
                            Report
                        </div>
                        @endif
                        --}}
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $hr_report_sub_module_three . '"]\')')->exists())
                        <div style="margin-left:70px;" class="hr-report-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $hr_report_sub_module_three . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input hr-report-module-check" type="checkbox"
                            name="hr_report_sub_module_three"
                            value="9.3">Project Report</div>
                        @endif
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $hr_report_sub_module_four . '"]\')')->exists())
                        <div style="margin-left:70px;" class="hr-report-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $hr_report_sub_module_four . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            hr-report-module-check" type="checkbox" name="hr_report_sub_module_four" value="9.4">Task
                            Report
                        </div>
                        @endif
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $hr_report_sub_module_five . '"]\')')->exists())
                        <div style="margin-left:70px;" class="hr-report-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $hr_report_sub_module_five . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            hr-report-module-check" type="checkbox" name="hr_report_sub_module_five"
                            value="9.5">Employees
                            Report</div>
                        @endif

                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $hr_report_sub_module_eleven . '"]\')')->exists())
                        <div style="margin-left:70px;" class="hr-report-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $hr_report_sub_module_eleven . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            hr-report-module-check" type="checkbox" name="hr_report_sub_module_eleven" value="9.11"> Employees
                            Master Report</div>
                        @endif

                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $hr_report_sub_module_twelve . '"]\')')->exists())
                        <div style="margin-left:70px;" class="hr-report-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $hr_report_sub_module_twelve . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            hr-report-module-check" type="checkbox" name="hr_report_sub_module_twelve"
                            value="9.12">Active Employees
                            Report</div>
                        @endif

                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $hr_report_sub_module_thirteen . '"]\')')->exists())
                        <div style="margin-left:70px;" class="hr-report-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $hr_report_sub_module_thirteen . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            hr-report-module-check" type="checkbox" name="hr_report_sub_module_thirteen"
                            value="9.13">Employees
                            Recruitment Summary</div>
                        @endif
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $hr_report_sub_module_thirteen . '"]\')')->exists())
                        <div style="margin-left:70px;" class="hr-report-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $hr_report_sub_module_fourteen . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            hr-report-module-check" type="checkbox" name="hr_report_sub_module_fourteen" value="9.14">
                            Orientation & Selected Report
                        </div>
                        @endif
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $hr_report_sub_module_thirteen . '"]\')')->exists())
                        <div style="margin-left:70px;" class="hr-report-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $hr_report_sub_module_fifteen . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            hr-report-module-check" type="checkbox" name="hr_report_sub_module_fifteen" value="9.15">
                            Separation Report
                        </div>
                        @endif
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $hr_report_sub_module_five . '"]\')')->exists())
                        <div style="margin-left:70px;" class="hr-report-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $hr_report_sub_module_five . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            hr-report-module-check" type="checkbox" name="hr_report_sub_module_five"
                            value="9.5">Employees
                            Report</div>
                        @endif


                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $hr_report_sub_module_sixteen . '"]\')')->exists())
                        <div style="margin-left:70px;" class="hr-report-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $hr_report_sub_module_sixteen . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            hr-report-module-check" type="checkbox" name="hr_report_sub_module_sixteen"
                            value="9.16">Salary Disburse Report
                        </div>
                        @endif


                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $hr_report_sub_module_seventeen . '"]\')')->exists())
                        <div style="margin-left:70px;" class="hr-report-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $hr_report_sub_module_seventeen . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            hr-report-module-check" type="checkbox" name="hr_report_sub_module_seventeen"
                            value="9.17">Festival Bounus Salary Disburse Report
                        </div>
                        @endif

                        {{--
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $hr_report_sub_module_six . '"]\')')->exists())
                        <div style="margin-left:70px;" class="hr-report-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $hr_report_sub_module_six . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            hr-report-module-check" type="checkbox" name="hr_report_sub_module_six" value="9.6">Account
                            Report
                        </div>
                        @endif
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $hr_report_sub_module_seven . '"]\')')->exists())
                        <div style="margin-left:70px;" class="hr-report-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $hr_report_sub_module_seven . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input hr-report-module-check" type="checkbox"
                            name="hr_report_sub_module_seven"
                            value="9.7">Expense Report</div>
                        @endif
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $hr_report_sub_module_eight . '"]\')')->exists())
                        <div style="margin-left:70px;" class="hr-report-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $hr_report_sub_module_eight . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input hr-report-module-check" type="checkbox"
                            name="hr_report_sub_module_eight"
                            value="9.8">Deposit Report</div>
                        @endif
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $hr_report_sub_module_nine . '"]\')')->exists())
                        <div style="margin-left:70px;" class="hr-report-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $hr_report_sub_module_nine . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            hr-report-module-check" type="checkbox" name="hr_report_sub_module_nine"
                            value="9.9">Transaction
                            Report</div>
                        @endif
                        --}}
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $hr_report_sub_module_ten . '"]\')')->exists())
                        <div style="margin-left:70px;" class="hr-report-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $hr_report_sub_module_ten . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            hr-report-module-check" type="checkbox" name="hr_report_sub_module_ten"
                            value="9.10">Provident Fund
                            Report</div>
                        @endif
                    </div>
                </div>
                @endif


                @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module, \'["' .
                $event_and_meeting_module . '"]\')')->exists())
                <div class="col-md-12 form-group check-box">
                    <div class="permission-title">
                        <span class="select-event-and-meeting-module dropdown-toggle"></span>
                        <h2 style="margin-left:33px;margin-top:-20px;"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $event_and_meeting_module . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            user-check" type="checkbox" name="event_and_meeting_module" value="10"
                            id="eventAndMeetingAll"
                            >Event & Meetings</h2>
                    </div>
                    <div class="permission-container">
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $event_and_meeting_sub_module_one . '"]\')')->exists())
                        <div style="margin-left:70px;" class="event-and-meeting-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $event_and_meeting_sub_module_one . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input event-and-meeting-module-check" type="checkbox"
                            name="event_and_meeting_sub_module_one" value="10.1" id="eventAll"><span
                                class="select-event-sub-module dropdown-toggle btn btn-success">Events</span></div>
                        <div style="margin-left:80px;" class="event-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $event_and_meeting_sub_module_one_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input event-sub-module-check" type="checkbox"
                            name="event_and_meeting_sub_module_one_add" value="10.1.1">Add Event</div>
                        <div style="margin-left:80px;" class="event-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $event_and_meeting_sub_module_one_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input event-sub-module-check" type="checkbox"
                            name="event_and_meeting_sub_module_one_edit" value="10.1.2">Update Event</div>
                        <div style="margin-left:80px;" class="event-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $event_and_meeting_sub_module_one_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input event-sub-module-check" type="checkbox"
                            name="event_and_meeting_sub_module_one_delete" value="10.1.3">Delete Event</div>
                        @endif
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $event_and_meeting_sub_module_two . '"]\')')->exists())
                        <div style="margin-left:70px;" class="event-and-meeting-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $event_and_meeting_sub_module_two . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input event-and-meeting-module-check" type="checkbox"
                            name="event_and_meeting_sub_module_two" value="10.2" id="meetingAll"><span
                                class="select-meeting-sub-module dropdown-toggle btn btn-success">Meetings</span></div>
                        <div style="margin-left:80px;" class="meeting-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $event_and_meeting_sub_module_two_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input meeting-sub-module-check" type="checkbox"
                            name="event_and_meeting_sub_module_two_add" value="10.2.1">Add Meeting</div>
                        <div style="margin-left:80px;" class="meeting-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $event_and_meeting_sub_module_two_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input meeting-sub-module-check" type="checkbox"
                            name="event_and_meeting_sub_module_two_edit" value="10.2.2">Update Meeting</div>
                        <div style="margin-left:80px;" class="meeting-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $event_and_meeting_sub_module_two_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input meeting-sub-module-check" type="checkbox"
                            name="event_and_meeting_sub_module_two_delete" value="10.2.3">Delete Meeting</div>
                        @endif
                    </div>
                </div>
                @endif


                <div class="col-md-12 form-group check-box">
                    <div class="permission-title">
                        <span class="select-project-management-module dropdown-toggle"></span>
                        <h2 style="margin-left:33px;margin-top:-20px;"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $project_management_module . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            user-check" type="checkbox" name="project_management_module" value="11"
                            id="projectManagemnetAll">Project Management</h2>
                    </div>

                    <div class="permission-container">
                        <div style="margin-left:70px;" class="project-management-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $project_management_sub_module_one . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input project-management-sub-module-check" type="checkbox"
                            name="project_management_sub_module_one" value="11.1" id="projectAll"><span
                                class="select-project-sub-module dropdown-toggle btn btn-success">Projects</span></div>
                        <div style="margin-left:80px;" class="project-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $project_management_sub_module_one_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input project-sub-module-check" type="checkbox"
                            name="project_management_sub_module_one_add" value="11.1.1">Add Project</div>
                        <div style="margin-left:80px;" class="project-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $project_management_sub_module_one_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input project-sub-module-check" type="checkbox"
                            name="project_management_sub_module_one_edit" value="11.1.2">Update Project</div>
                        <div style="margin-left:80px;" class="project-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $project_management_sub_module_one_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input project-sub-module-check" type="checkbox"
                            name="project_management_sub_module_one_delete" value="11.1.3">Delete Project</div>

                        <div style="margin-left:70px;" class="project-management-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $project_management_sub_module_two . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input project-management-sub-module-check" type="checkbox"
                            name="project_management_sub_module_two" value="11.2" id="taskAll"><span
                                class="select-task-sub-module dropdown-toggle btn btn-success">Tasks</span></div>
                        <div style="margin-left:80px;" class="task-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $project_management_sub_module_two_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input task-sub-module-check" type="checkbox"
                            name="project_management_sub_module_two_add" value="11.2.1">Add Tasks</div>
                        <div style="margin-left:80px;" class="task-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $project_management_sub_module_two_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input task-sub-module-check" type="checkbox"
                            name="project_management_sub_module_two_edit" value="11.2.2">Update Tasks</div>
                        <div style="margin-left:80px;" class="task-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $project_management_sub_module_two_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input task-sub-module-check" type="checkbox"
                            name="project_management_sub_module_two_delete" value="11.2.3">Delete Tasks</div>
                        {{--
                        <div style="margin-left:70px;" class="project-management-module"> <input
                                class="form-check-input project-management-module-check" type="checkbox"
                                value="">Clients</div>
                        <div style="margin-left:70px;" class="project-management-module"> <input
                                class="form-check-input project-management-module-check" type="checkbox"
                                value="">Invoice</div>
                        <div style="margin-left:70px;" class="project-management-module"> <input
                                class="form-check-input project-management-module-check" type="checkbox" value="">Tax
                            Type</div>
                        --}}
                    </div>
                </div>



                @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module, \'["' .
                $support_ticket_module . '"]\')')->exists())
                <div class="col-md-12 form-group check-box">
                    <div class="permission-title">
                        <span class="select-support-ticket-module dropdown-toggle"></span>
                        <h2 style="margin-left:33px;margin-top:-20px;"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $support_ticket_module . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            user-check" type="checkbox" name="support_ticket_module" value="12"
                            id="supportTicketAll">Support
                            Tickets</h2>
                    </div>
                    <div class="permission-container">
                        <div style="margin-left:70px;" class="support-ticket-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $support_ticket_module_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            support-ticket-module-check" type="checkbox" name="support_ticket_module_add"
                            value="12.0.1">Add
                            Support Ticket</div>
                        <div style="margin-left:70px;" class="support-ticket-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $support_ticket_module_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input support-ticket-module-check" type="checkbox"
                            name="support_ticket_module_edit" value="12.0.2">Update Support Ticket</div>
                        <div style="margin-left:70px;" class="support-ticket-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $support_ticket_module_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input support-ticket-module-check" type="checkbox"
                            name="support_ticket_module_delete" value="12.0.3">Delete Support Ticket</div>
                    </div>
                </div>
                @endif


                @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module, \'["' .
                $assets_module . '"]\')')->exists())
                <div class="col-md-12 form-group check-box">
                    <div class="permission-title">
                        <span class="select-asset-module dropdown-toggle"></span>
                        <h2 style="margin-left:33px;margin-top:-20px;"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $assets_module . '"]\')')->exists()){echo 'checked';} ?> class="form-check-input
                            user-check"
                            type="checkbox" name="assets_module" value="13" id="assetAll" >Assets</h2>
                    </div>
                    <div class="permission-container">
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $assets_sub_module_one . '"]\')')->exists())
                        <div style="margin-left:70px;" class="asset-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $assets_sub_module_one . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            asset-module-check" type="checkbox" name="assets_sub_module_one" value="13.1"
                            id="assetcategoryAll"><span
                                class="select-asset-category-sub-module dropdown-toggle btn btn-success">Asset
                                Category</span>
                        </div>
                        <div style="margin-left:80px;" class="asset-category-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $assets_sub_module_one_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            asset-category-sub-module-check" type="checkbox" name="assets_sub_module_one_add"
                            value="13.1.1">Add
                            Asset Category</div>
                        <div style="margin-left:80px;" class="asset-category-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $assets_sub_module_one_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input asset-category-sub-module-check" type="checkbox"
                            name="assets_sub_module_one_edit" value="13.1.2">Update Asset Category</div>
                        <div style="margin-left:80px;" class="asset-category-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $assets_sub_module_one_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input asset-category-sub-module-check" type="checkbox"
                            name="assets_sub_module_one_delete" value="13.1.3">Delete Asset Category</div>
                        @endif
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $assets_sub_module_two . '"]\')')->exists())
                        <div style="margin-left:70px;" class="asset-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $assets_sub_module_two . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            asset-module-check" type="checkbox" name="assets_sub_module_two" value="13.2"
                            id="assetsAll"><span
                                class="select-assets-sub-module dropdown-toggle btn btn-success">Assets</span></div>
                        <div style="margin-left:80px;" class="assets-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $assets_sub_module_two_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            assets-sub-module-check" type="checkbox" name="assets_sub_module_two_add" value="13.2.1">Add
                            Asset
                        </div>
                        <div style="margin-left:80px;" class="assets-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $assets_sub_module_two_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input assets-sub-module-check" type="checkbox"
                            name="assets_sub_module_two_edit"
                            value="13.2.2">Update Asset</div>
                        <div style="margin-left:80px;" class="assets-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $assets_sub_module_two_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input assets-sub-module-check" type="checkbox"
                            name="assets_sub_module_two_delete"
                            value="13.2.3">Delete Asset</div>
                        @endif
                    </div>
                </div>
                @endif


                @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module, \'["' .
                $file_manager_module . '"]\')')->exists())
                <div class="col-md-12 form-group check-box">
                    <div class="permission-title">
                        <span class="select-file-manager-module dropdown-toggle"></span>
                        <h2 style="margin-left:33px;margin-top:-20px;"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $file_manager_module . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input
                            user-check" type="checkbox" name="file_manager_module" value="14" id="fileManagerAll">File
                            Manager
                        </h2>
                    </div>
                    <div class="permission-container">
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $file_manager_sub_module_one . '"]\')')->exists())
                        <div style="margin-left:70px;" class="file-manager-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $file_manager_sub_module_one . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input file-manager-module-check" type="checkbox"
                            name="file_manager_sub_module_one" value="14.1" id="fileManagerSubModuleAll"><span
                                class="select-file-manager-sub-module dropdown-toggle btn btn-success">File
                                Manager</span></div>
                        <div style="margin-left:80px;" class="file-manager-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $file_manager_sub_module_one_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input file-manager-sub-module-check" type="checkbox"
                            name="file_manager_sub_module_one_add" value="14.1.1">Add File</div>
                        <div style="margin-left:80px;" class="file-manager-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $file_manager_sub_module_one_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input file-manager-sub-module-check" type="checkbox"
                            name="file_manager_sub_module_one_edit" value="14.1.2">Update File</div>
                        <div style="margin-left:80px;" class="file-manager-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $file_manager_sub_module_one_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input file-manager-sub-module-check" type="checkbox"
                            name="file_manager_sub_module_one_delete" value="14.1.3">Delete File</div>
                        @endif
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $file_manager_sub_module_two . '"]\')')->exists())
                        <div style="margin-left:70px;" class="file-manager-module"><input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $file_manager_sub_module_two . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input file-manager-module-check" type="checkbox"
                            name="file_manager_sub_module_two" value="14.2" id="officialdocumentAll"><span
                                class="select-official-document-sub-module dropdown-toggle btn btn-success">Official
                                Documents</span></div>
                        <div style="margin-left:80px;" class="official-document-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $file_manager_sub_module_two_add . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input official-document-sub-module-check" type="checkbox"
                            name="file_manager_sub_module_two_add" value="14.2.1">Add Document</div>
                        <div style="margin-left:80px;" class="official-document-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $file_manager_sub_module_two_edit . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input official-document-sub-module-check" type="checkbox"
                            name="file_manager_sub_module_two_edit" value="14.2.2">Update Document</div>
                        <div style="margin-left:80px;" class="official-document-sub-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $file_manager_sub_module_two_delete . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input official-document-sub-module-check" type="checkbox"
                            name="file_manager_sub_module_two_delete" value="14.2.3">Delete Document</div>
                        @endif
                        @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                        \'["' .
                        $file_manager_sub_module_three . '"]\')')->exists())
                        <div style="margin-left:70px;" class="file-manager-module"> <input <?php
                                if(Permission::where('permission_com_id',Auth::user()->com_id)->where('permission_role_id',$role_id)->whereRaw('json_contains(permission_content,
                            \'["' . $file_manager_sub_module_three . '"]\')')->exists()){echo 'checked';} ?>
                            class="form-check-input file-manager-module-check" type="checkbox"
                            name="file_manager_sub_module_three" value="14.3">File Configuration</div>
                        @endif
                    </div>
                </div>
                @endif
                <div class="col-sm-12 mt-4">
                    <input type="submit" name="action_button" class="btn btn-grad" value="{{__('Update')}}" />
                </div>
            </div>
        </form>
    </div>
</section>

<script type="text/javascript">
    $(document).ready( function () {

  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });


      $("#usersAll").click(function () {
        $(".user-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-user-module").click(function(){
        $(".user-module").toggle();
      });


      $("#userlistAll").click(function () {
        $(".user-list-sub-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-user-list-sub-module").click(function(){
        $(".user-list-sub-module").toggle();
      });


      $("#employeeAll").click(function () {
        $(".employee-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-employee-module").click(function(){
        $(".employee-module").toggle();
      });


      $("#employeelistAll").click(function () {
        $(".employee-list-sub-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-employee-list-sub-module").click(function(){
        $(".employee-list-sub-module").toggle();
      });


      $("#customizeAll").click(function () {
        $(".customize-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-customize-module").click(function(){
        $(".customize-module").toggle();
      });


      $("#variabletypeAll").click(function () {
        $(".variable-type-sub-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-variable-type-sub-module").click(function(){
        $(".variable-type-sub-module").toggle();
      });


      $("#variablemethodAll").click(function () {
        $(".variable-method-sub-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-variable-method-sub-module").click(function(){
        $(".variable-method-sub-module").toggle();
      });

      $("#taxconfigAll").click(function () {
        $(".tax-config-sub-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-tax-config-sub-module").click(function(){
        $(".tax-config-sub-module").toggle();
      });


      $("#salaryconfigAll").click(function () {
        $(".salary-config-sub-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-salary-config-sub-module").click(function(){
        $(".salary-config-sub-module").toggle();
      });

      $("#festivalAll").click(function () {
        $(".festival-sub-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-festival-sub-module").click(function(){
        $(".festival-sub-module").toggle();
      });


      $("#overtimeconfigAll").click(function () {
        $(".overtime-config-sub-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-overtime-config-sub-module").click(function(){
        $(".overtime-config-sub-module").toggle();
      });

      $("#latetimeconfigAll").click(function () {
        $(".latetime-config-sub-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-latetime-config-sub-module").click(function(){
        $(".latetime-config-sub-module").toggle();
      });

      $("#companypfconfigAll").click(function () {
        $(".company-pf-config-sub-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-company-pf-config-sub-module").click(function(){
        $(".company-pf-config-sub-module").toggle();
      });


      $("#rulesAll").click(function () {
        $(".roles-sub-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-roles-sub-module").click(function(){
        $(".roles-sub-module").toggle();
      });


      $("#coreHrAll").click(function () {
        $(".core-hr-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-core-hr-module").click(function(){
        $(".core-hr-module").toggle();
      });


      $("#promotionAll").click(function () {
        $(".promotion-sub-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-promotion-sub-module").click(function(){
        $(".promotion-sub-module").toggle();
      });


      $("#awardAll").click(function () {
        $(".award-sub-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-award-sub-module").click(function(){
        $(".award-sub-module").toggle();
      });


      $("#travelAll").click(function () {
        $(".travel-sub-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-travel-sub-module").click(function(){
        $(".travel-sub-module").toggle();
      });


      $("#transferAll").click(function () {
        $(".transfer-sub-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-transfer-sub-module").click(function(){
        $(".transfer-sub-module").toggle();
      });

      $("#resignationAll").click(function () {
        $(".resignation-sub-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-resignation-sub-module").click(function(){
        $(".resignation-sub-module").toggle();
      });


      $("#complaintAll").click(function () {
        $(".complaint-sub-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-complaint-sub-module").click(function(){
        $(".complaint-sub-module").toggle();
      });


      $("#warningAll").click(function () {
        $(".warning-sub-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-warning-sub-module").click(function(){
        $(".warning-sub-module").toggle();
      });


      $("#terminationAll").click(function () {
        $(".termination-sub-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-termination-sub-module").click(function(){
        $(".termination-sub-module").toggle();
      });


      $("#organizationAll").click(function () {
        $(".organization-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-organization-module").click(function(){
        $(".organization-module").toggle();
      });

      $("#allowanceheadAll").click(function () {
        $(".allowance-head-sub-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-allowance-head-sub-module").click(function(){
        $(".allowance-head-sub-module").toggle();
      });

      $("#departmentAll").click(function () {
        $(".department-sub-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-department-sub-module").click(function(){
        $(".department-sub-module").toggle();
      });

      $("#regionAll").click(function () {
        $(".region-sub-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-region-sub-module").click(function(){
        $(".region-sub-module").toggle();
      });


      $("#areaAll").click(function () {
        $(".area-sub-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-area-sub-module").click(function(){
        $(".area-sub-module").toggle();
      });



      $("#territoryAll").click(function () {
        $(".territory-sub-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-territory-sub-module").click(function(){
        $(".territory-sub-module").toggle();
      });


      $("#townAll").click(function () {
        $(".town-sub-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-town-sub-module").click(function(){
        $(".town-sub-module").toggle();
      });



      $("#dbhouseAll").click(function () {
        $(".db-house-sub-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-db-house-sub-module").click(function(){
        $(".db-house-sub-module").toggle();
      });




      $("#designationAll").click(function () {
        $(".designation-sub-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-designation-sub-module").click(function(){
        $(".designation-sub-module").toggle();
      });



      $("#announcementAll").click(function () {
        $(".announcement-sub-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-announcement-sub-module").click(function(){
        $(".announcement-sub-module").toggle();
      });

      $("#companypolicyAll").click(function () {
        $(".company-policy-sub-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-company-policy-sub-module").click(function(){
        $(".company-policy-sub-module").toggle();
      });


      $("#timeSheetAll").click(function () {
        $(".time-sheet-module-check,").prop('checked', $(this).prop('checked'));
      });
      $(".select-time-sheet-module").click(function(){
        $(".time-sheet-module").toggle();
      });

      $("#fingerPrintAll").click(function () {
        $(".finger-print-module-check-ip,.finger-print-sub-module-check-ip,.finger-print-module-check-token,.finger-print-sub-module-check-token,.finger-print-module-check,.finger-print-sub-module-check,.finger-print-device-module-check,.finger-print-list-module-check,.finger-print-re-boot-module-check,.employee-without-finger-print-list-module-check,.employee_without_finger-print-device-module-check,.employee-with-finger-print-list-module-check,.employee_with_finger-print-device-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-finger-print-module").click(function(){
        $(".finger-print-sub-module-ip,.finger-print-sub-module-token,.finger-print-module,.finger-print-sub-module,.finger-print-device-module,.employee-without-finger-print-device-module,.employee-with-finger-print-device-module").toggle();
      });


      $("#deviceAreaAll").click(function () {
        $(".finger-print-sub-module-check").prop('checked', $(this).prop('checked'));
      });
      $("#deviceAll").click(function () {
        $(".finger-print-list-module-check,.finger-print-re-boot-module-check").prop('checked', $(this).prop('checked'));
      });

      $("#allIp").click(function () {
        $(".finger-print-sub-module-check-ip").prop('checked', $(this).prop('checked'));
      });
      $("#allIp").click(function () {
        $(".finger-print-sub-module-check-ip").prop('checked', $(this).prop('checked'));
      });
      $(".select-finger-print-sub-module-ip").click(function(){
        $(".finger-print-sub-module-ip").toggle();
      });

      $("#allToken").click(function () {
        $(".finger-print-sub-module-check-token").prop('checked', $(this).prop('checked'));
      });
      $("#allToken").click(function () {
        $(".finger-print-sub-module-check-token").prop('checked', $(this).prop('checked'));
      });
      $(".select-finger-print-sub-module-token").click(function(){
        $(".finger-print-sub-module-token").toggle();
      });

      $(".select-finger-print-sub-module").click(function(){
        $(".finger-print-sub-module").toggle();
      });
    //   $(".select-finger-print-sub-module").click(function(){
    //     $(".finger-print-list-module-check,.finger-print-re-boot-module-check").toggle();
    //   });

      $(".select-finger-print-list-module").click(function(){
        $(".finger-print-device-module").toggle();
      });
      $(".select-finger-print-list-module").click(function(){
        $(".finger-print-list-module-check,.finger-print-re-boot-module-check").toggle();
      });


      $(".select-employee-without-finger-print-list-module").click(function(){
        $(".employee-without-finger-print-device-module").toggle();
      });
      $(".select-employee-without-finger-print-list-module").click(function(){
        $(".employee-without-finger-print-list-module-check").toggle();
      });
      $("#employeeWithoutFingerPrint").click(function () {
        $(".employee-without-finger-print-list-module-check").prop('checked', $(this).prop('checked'));
      });

      $(".select-employee-with-finger-print-list-module").click(function(){
        $(".employee-with-finger-print-device-module").toggle();
      });
      $(".select-employee-with-finger-print-list-module").click(function(){
        $(".employee-with-finger-print-list-module-check").toggle();
      });
      $("#employeeWithFingerPrint").click(function () {
        $(".employee-with-finger-print-list-module-check").prop('checked', $(this).prop('checked'));
      });

      $("#officeshiftAll").click(function () {
        $(".office-shift-sub-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-office-shift-sub-module").click(function(){
        $(".office-shift-sub-module").toggle();
      });

      $("#weeklyholidayAll").click(function () {
        $(".weekly-holiday-sub-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-weekly-holiday-sub-module").click(function(){
        $(".weekly-holiday-sub-module").toggle();
      });

      $("#otherholidayAll").click(function () {
        $(".other-holiday-sub-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-other-holiday-sub-module").click(function(){
        $(".other-holiday-sub-module").toggle();
      });




      $("#goalTypeAll").click(function () {
        $(".goal-type-sub-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-goal-type-sub-module").click(function(){
        $(".goal-type-sub-module").toggle();
      });

      $("#goalTrackingAll").click(function () {
        $(".goal-tracking-sub-module-check").prop('checked', $(this).prop('checked'));
      });

      $("#superrecomAll").click(function () {
        $(".super-recom-sub-module-check").prop('checked', $(this).prop('checked'));
      });

      $(".select-goal-tracking-sub-module").click(function(){
        $(".goal-tracking-sub-module").toggle();
      });

      $("#objectiveTypeAll").click(function () {
        $(".objective-type-sub-module-check").prop('checked', $(this).prop('checked'));
      });

      $(".select-objective-type-sub-module").click(function(){
        $(".objective-type-sub-module").toggle();
      });

      $("#objectiveTypeConfigAll").click(function () {
        $(".objective-type-config-sub-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-objective-type-config-sub-module").click(function(){
        $(".objective-type-config-sub-module").toggle();
      });

      $("#objectiveAll").click(function () {
        $(".objective-sub-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-objective-sub-module").click(function(){
        $(".objective-sub-module").toggle();
      });

      $("#yearlyReviewConfigAll").click(function () {
        $(".yearly-review-config-sub-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-yearly-review-config-sub-module").click(function(){
        $(".yearly-review-config-sub-module").toggle();
      });

      $("#pdPointConfigAll").click(function () {
        $(".pd-point-config-sub-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-pd-point-config-sub-module").click(function(){
        $(".pd-point-config-sub-module").toggle();
      });

      $("#seatAllocationAll").click(function () {
        $(".seat-allocation-sub-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-seat-allocation-sub-module").click(function(){
        $(".seat-allocation-sub-module").toggle();
      });

      $("#jobPostAll").click(function () {
        $(".job-post-sub-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-job-post-sub-module").click(function(){
        $(".job-post-sub-module").toggle();
      });

      $("#jobCandidateAll").click(function () {
        $(".job-candidate-sub-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-job-candidate-sub-module").click(function(){
        $(".job-candidate-sub-module").toggle();
      });

      $("#trainingTypeAll").click(function () {
        $(".training-type-sub-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-training-type-sub-module").click(function(){
        $(".training-type-sub-module").toggle();
      });

      $("#trainerAll").click(function () {
        $(".trainer-sub-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-trainer-sub-module").click(function(){
        $(".trainer-sub-module").toggle();
      });

      $("#trainingListAll").click(function () {
        $(".training-list-sub-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-training-list-sub-module").click(function(){
        $(".training-list-sub-module").toggle();
      });


      $("#leavetypeAll").click(function () {
        $(".leave-type-sub-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-leave-type-sub-module").click(function(){
        $(".leave-type-sub-module").toggle();
      });



      $("#leaveAll").click(function () {
        $(".leave-sub-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-leave-sub-module").click(function(){
        $(".leave-sub-module").toggle();
      });


      $("#payRollAll").click(function () {
        $(".pay-roll-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-pay-roll-module").click(function(){
        $(".pay-roll-module").toggle();
      });



      $("#probationAll").click(function () {
        $(".probation-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-probation-module").click(function(){
        $(".probations-module").toggle();
      });



      $("#performanceAll").click(function () {
        $(".performance-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-performance-module").click(function(){
        $(".performance-module").toggle();
      });

      $("#recruitmentAll").click(function () {
        $(".recruitment-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-recruitment-module").click(function(){
        $(".recruitment-module").toggle();
      });

      $("#trainingAll").click(function () {
        $(".training-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-training-module").click(function(){
        $(".training-module").toggle();
      });

      // $("#hrCalanderAll").click(function () {
      //   $(".hr-calander-module-check").prop('checked', $(this).prop('checked'));
      // });
      // $(".select-hr-calander-module").click(function(){
      //   $(".hr-calander-module").toggle();
      // });



      $("#hrReportAll").click(function () {
        $(".hr-report-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-hr-report-module").click(function(){
        $(".hr-report-module").toggle();
      });

      $("#eventAndMeetingAll").click(function () {
        $(".event-and-meeting-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-event-and-meeting-module").click(function(){
        $(".event-and-meeting-module").toggle();
      });

      $("#eventAll").click(function () {
        $(".event-sub-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-event-sub-module").click(function(){
        $(".event-sub-module").toggle();
      });

      $("#meetingAll").click(function () {
        $(".meeting-sub-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-meeting-sub-module").click(function(){
        $(".meeting-sub-module").toggle();
      });


      $("#projectManagemnetAll").click(function () {
        $(".project-management-sub-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-project-management-module").click(function(){
        $(".project-management-sub-module").toggle();
      });

      $("#projectAll").click(function () {
        $(".project-sub-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-project-sub-module").click(function(){
        $(".project-sub-module").toggle();
      });

      $("#taskAll").click(function () {
        $(".task-sub-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-task-sub-module").click(function(){
        $(".task-sub-module").toggle();
      });



      $("#supportTicketAll").click(function () {
        $(".support-ticket-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-support-ticket-module").click(function(){
        $(".support-ticket-module").toggle();
      });


      $("#assetAll").click(function () {
        $(".asset-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-asset-module").click(function(){
        $(".asset-module").toggle();
      });

      $("#assetcategoryAll").click(function () {
        $(".asset-category-sub-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-asset-category-sub-module").click(function(){
        $(".asset-category-sub-module").toggle();
      });

      $("#assetsAll").click(function () {
        $(".assets-sub-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-assets-sub-module").click(function(){
        $(".assets-sub-module").toggle();
      });


      $("#fileManagerAll").click(function () {
        $(".file-manager-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-file-manager-module").click(function(){
        $(".file-manager-module").toggle();
      });

      $("#fileManagerSubModuleAll").click(function () {
        $(".file-manager-sub-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-file-manager-sub-module").click(function(){
        $(".file-manager-sub-module").toggle();
      });

      $("#officialdocumentAll").click(function () {
        $(".official-document-sub-module-check").prop('checked', $(this).prop('checked'));
      });
      $(".select-official-document-sub-module").click(function(){
        $(".official-document-sub-module").toggle();
      });








          // edit form submission starts

          // $('#permission_form').submit(function(e) {
          //       e.preventDefault();
          //       let formData = new FormData(this);
          //       console.log(formData);
          //       $('#error-message').text('');

          //       $.ajax({
          //           type:'POST',
          //           url: `/permission-giving`,
          //           data: formData,
          //           contentType: false,
          //           processData: false,
          //           success: (response) => {
          //               window.location.reload();
          //               if (response) {
          //               this.reset();
          //               alert('Data has been updated successfully');
          //               }
          //           },
          //           error: function(response){
          //               console.log(response);
          //                   $('#error-message').text(response.responseJSON.errors.file);
          //           }
          //       });
          //   });

            // edit form submission ends



  } );


</script>


@endsection
