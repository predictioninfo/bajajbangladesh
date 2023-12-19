<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        html,
        body,
        div {
            font-family: nikosh;
        }

        .appointment-letter {
            padding-left: 30px;
            padding-right: 30px;
            font-size: 18px;
            text-align: justify;
        }

        ol {
            list-style-type: bengali;
        }
    </style>
</head>

<body>

    <?php

use App\Models\EmployeeDetail;
use App\Models\AllowanceHeadAmount;
//echo "ok"; exit;
?>
    <?php
function Bengali_DTN($NRS){
$englDTN = array
('1','2','3','4','5','6','7','8','9','0',
'Saturday','Sunday','Monday','Tuesday','Wednesday','Thursday','Friday',
'Sat','Sun','Mon','Tue','Wed','Thu','Fri',
'am','pm','at','st','nd','rd','th',
'January','February','March','April','May','June','July','August','September','October','November','December',
'Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
$bangDTN = array
('১','২','৩','৪','৫','৬','৭','৮','৯','০',
'শনিবার','রবিবার','সোমবার','মঙ্গলবার','বুধবার','বৃহস্পতিবার','শুক্রবার',
'শনি','রবি','সোম','মঙ্গল','বুধ','বৃহঃ','শুক্র',
'পূর্বাহ্ণ','অপরাহ্ণ','','','','','',
'জানুয়ারি','ফেব্রুয়ারি','মার্চ','এপ্রিল','মে','জুন','জুলাই','আগস্ট','সেপ্টেম্বর','অক্টোবর','নভেম্বর','ডিসেম্বর',
'জানু','ফেব্রু','মার্চ','এপ্রি','মে','জুন','জুলা','আগ','সেপ্টে','অক্টো','নভে','ডিসে');
$converted = str_replace($englDTN, $bangDTN, $NRS);
return $converted;
}

?>
    @foreach ($employee_details_value as $employee_value)

    <?php

//  $employee_details = EmployeeDetail::where('empdetails_employee_id',$employee_value->id)->get();
  $employee_allowances = AllowanceHeadAmount::where('allowance_head_allocation_emp_id',$employee_value->id)->get();

?>
    {{-- @foreach ($employee_details as $employee_details_extra_details) --}}
    <?php

  $day = date('j',strtotime($employee_value->joining_date));
$month = date('F',strtotime($employee_value->joining_date));
$year = date('Y',strtotime($employee_value->joining_date));
    // echo Bengali_DTN("March");
    //$today = date("d.m.Y");
    $mydate=getdate(date("U"));
    $date = Bengali_DTN("$mydate[mday]");
    $datmy = Bengali_DTN(" $mydate[month]  $mydate[year]");
   // $date = Bengali_DTN("$today");
    $phonenumber = $employee_value->phone ;
    $phone = Bengali_DTN("$phonenumber");

   $nid = $employee_value->emoloyeedetail->identification_number ?? null;
   $identification_number = Bengali_DTN("$nid");

   $gross_salary =  $employee_value->gross_salary ?? null;
   $gross = Bengali_DTN("$gross_salary");

   $mobile= $employee_value->mobile_bill ?? null;
   $mobile_bill= Bengali_DTN("$mobile");
   $total_bill = $gross_salary + $mobile;
   $total= Bengali_DTN("$total_bill ");
   $variable_pay= Bengali_DTN("8500.00");
   $ta_da= Bengali_DTN("120");
   $joinig=$employee_value->joining_date;
   $joinig_date= Bengali_DTN("$joinig");

   $joinig_day= Bengali_DTN("$day");
   $joinig_month= Bengali_DTN("$month");
   $joinig_year= Bengali_DTN("$year");

   $transport_allowance =  $employee_value->transport_allowance ?? null;
   $transport = Bengali_DTN("$transport_allowance ");
   $basic_salay = ($gross_salary*$employee_value->salaryconfig->salary_config_basic_salary  )/100;
   $house_rent = ($gross_salary*$employee_value->salaryconfig->salary_config_house_rent_allowance)/100;
   $medical_allowence = ($gross_salary*$employee_value->salaryconfig->salary_config_medical_allowance)/100;

   $basic_salay_bn = Bengali_DTN("$basic_salay");
   $house_rent_bn = Bengali_DTN("$house_rent");
   $medical_allowence_bn = Bengali_DTN("$medical_allowence");

   $total_salary = $basic_salay+$house_rent+$medical_allowence+$mobile+$transport_allowance;

   $total_salary_bn = Bengali_DTN("$total_salary");
   $lunch = 0;
   $lunch_bangla = Bengali_DTN("$lunch ");

    $special= 0;
    $special_bangla = Bengali_DTN("$special");

     $basic_salary_float_round = number_format((float)$basic_salay , 0, '.', '');
     $house_float_round = number_format((float)$house_rent , 0, '.', '');
     $medical_float_round = number_format((float)$medical_allowence , 0, '.', '');
     $basic_salary_float_round_bangla = Bengali_DTN("$basic_salary_float_round ");
     $house_salary_float_round_bangla = Bengali_DTN("$house_float_round ");
     $medical_salary_float_round_bangla = Bengali_DTN("$medical_float_round ");




//     $appointment_day = date('j',strtotime($employee_value->emoloyeedetail->appointment_date));
// $appointment_month = date('F',strtotime($employee_value->emoloyeedetail->appointment_date));
// $appointment_year = date('Y',strtotime($employee_value->emoloyeedetail->appointment_date));
//     // echo Bengali_DTN("March");
//     //$today = date("d.m.Y");
//     $mydate_app=getdate(date("U"));
//     $date_app = Bengali_DTN("$mydate_app[appointment_day]");
//     $datmy_app = Bengali_DTN(" $mydate_app[appointment_month]  $mydate_app[appointment_year]");

//   $appointment_date = $employee_value->emoloyeedetail->appointment_date ;
//     $app_day= Bengali_DTN("$day");
//     $app_month= Bengali_DTN("$month");
//     $app_year= Bengali_DTN("$year");



  ?>

    @if($employee_value->appointment_letter == "filed_force")

    <div> <img style="width:170px;padding-left:30px;" src="{{asset('uploads/logos/logo.png')}}">
        <br>
        <p style="margin-left:77%;font-size:15px;">
            <br>

            @if($employee_value->joining_date <= '2022-03-28' ) {{ __('তারিখঃ ১লা এপ্রিল ২০২২ ইং')}} @else <?php
                echo 'তারিখঃ ' ; if($joinig_day=='১' ){echo $joinig_day.'লা '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ২'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ৩'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ৪'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ৫'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ৬'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ৭'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ৮'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ৯'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ১০'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ১১'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ১২'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ১৩'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ১৪'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ১৫'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ১৬'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ১৭'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ১৮'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ১৯'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ২০'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ২১'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ২২'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ২৩'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ২৪'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ২৫'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ২৬'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ২৭'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ২৮'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ২৯'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ৩০'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ৩১'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}


 ?>

    @endif


  </p>
</div>
<div class="appointment-letter" style="font-size:15px;">

  {{ $employee_value->emoloyeedetail->bangla_name ?? null}}<br>
{{ $employee_value->emoloyeedetail->permenet_address_bangla ?? null}}
 <br>
   <span style="font-weight:bold;"> বিষয়ঃ অস্থায়ী ভিত্তিতে চাকুরির নিয়োগ পত্র । </span>
  </p>

  <p> জনাব {{ $employee_value->emoloyeedetail->bangla_name ?? null}}, <br>অত্যন্ত আনন্দের সাথে জানানো যাচ্ছে যে, আপনার আবেদনের প্রেক্ষিতে এবং পরবর্তীতে প্রদত্ত সাক্ষাৎকারের ভিত্তিতে আপনাকে আমাদের প্রতিষ্ঠানের <span style="font-weight:bold;"> “সেলস সার্ভিস প্রসেস</span> (“সেলস সার্ভিস প্রসেস বলতে, গ্রাহক অথবা গ্রাহক কোম্পানির সহিত অত্র প্রতিষ্ঠানের সম্পাদিত চুক্তি মোতাবেক সেলস সার্ভিস, যাহাতে অত্র প্রতিষ্ঠানে বিক্রয় প্রতিনিধি সরবরাহ করবে) এর আওতাধীন <span style="font-weight:bold;">  “বিক্রয় প্রতিনিধি” </span> হিসেবে নিম্ন উল্লিখিত শর্ত স্বাপেক্ষে সম্পূর্ন
  অস্থায়ী শ্রমিক হিসেবে নিয়োগের সিদ্ধান্ত গৃহীত হয়েছে । এ
  নিয়োগ আগামী



    @if($employee_value->joining_date <= ' 2022-03-28') <!--{{ __('তারিখঃ ১লা এপ্রিল ২০২২ ইং')}}-->
                {{ __(' ১লা এপ্রিল ২০২২ ইং')}}

                @else
                <?php

if($joinig_day == '১'){echo $joinig_day.'লা '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == '২'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == '৩'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == '৪'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == '৫'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == '৬'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == '৭'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == '৮'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == '৯'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == '১০'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == '১১'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == '১২'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == '১৩'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == '১৪'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == '১৫'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == '১৬'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == '১৭'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == '১৮'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == '১৯'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == '২০'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == '২১'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == '২২'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == '২৩'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == '২৪'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == '২৫'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == '২৬'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == '২৭'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == '২৮'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == '২৯'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == '৩০'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == '৩১'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}


 ?>

                @endif




                তারিখ থেকে কার্যকর করা হবে এবং প্রজেক্ট এর চুক্তির মেয়াদ ৩১ শে মার্চ ২০২৩ ইং পর্যন্ত বলবৎ থাকবে, যা
                চুক্তি নবায়ন স্বাপেক্ষে আপনার নিয়োগ বর্ধিত করা যেতে পারে।
                <ol style="padding-left:15px">
                    <li><span style="font-weight:bold;"> কর্মস্থলঃ প্রেডিকশন লার্নিং এসোসিয়েটস লিঃ (পি.এল.এ.)</span> এর
                        নিয়োগপ্রাপ্ত অস্থায়ী শ্রমিক হিসেবে আপনি প্রতিষ্ঠানের সম্মানিত গ্রাহক অথবা গ্রাহক কোম্পানির
                        নির্ধারিত এলাকায় উক্ত কোম্পানির পণ্য বিক্রয় কার্যক্রমের জন্য দ্বায়িত্ব প্রাপ্ত হবেন । আপনার
                        কর্মস্থল বাংলাদেশের যে কোন অঞ্চলে হতে পারে । </li>
                    <li><span style="font-weight:bold;"> পারিশ্রমিক ও সুবিধাদিঃ </span><br> <span
                            style="margin-left: 3%; margin-right:50%">
                            ক) <span style="font-weight:bold;font-size: 16px;"> স্থায়ী বেতনঃ </span> <br>
                            <div style="padding-left: 12%">
                                <p>১। মাসিক স্থায়ী বেতন &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <span style="margin-left:20%;"> {{$gross ?? 0}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; টাকা
                                    </span> <br>
                                    ২। মোবাইল ভাতা
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    &nbsp; : <span style="padding-left:40px;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{
                                        $mobile_bill ?? 0}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; টাকা </span><br>
                                    <span
                                        style="background-color:white;color:black;font-weight:bold;">____________________________________________________________</span><br>
                                    <span style="font-weight:bold;">
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; সর্বমোট
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{ $total }}
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;টাকা </span>

                                </p>

                            </div>

                            <span style="margin-left: 3%;"><span style="font-size: 16px;font-weight:bold;">খ)
                                    পরিবর্তনশীল বেতনঃ </span> {{$variable_pay}}&nbsp; টাকা
                                আপনার পরিবর্তনশীল বেতনের অংশ হিসেবে উপরে উল্লেখিত টাকা (সীমিত নয়) মাসিক অর্জন করতে
                                পারবেন যা শুধুমাত্র প্রতিষ্ঠান কতৃক প্রদত্ত লক্ষ্যমাত্রা অর্জনের ভিত্তিতে প্রদান করা
                                হবে। <br>
                            </span>

                            <span style="margin-left: 3%;"><span style="font-size: 16px;font-weight:bold;">গ) যোগাযোগ
                                    ভাতা <span style="font-size: 14px;"> (টি এ/ডি এ)</span>: </span>
                                আপনার যাতায়াত ও দৈনিক খরচ বাবদ {{ $transport ?? $ta_da }} টাকা করে দেওয়া হবে যা
                                শুধুমাত্র আপনার কর্মদিনের উপস্থিতির উপর সম্পুর্ণ নির্ভর করে প্রদান করা হবে। কোনদিন
                                অনুপস্থিত থাকলে বা ছুটিতে থাকলে উক্ত দিনের কোন ভাতা দেওয়া হবে না।
                                <br>
                    </li>


                    <span style="margin-left: 3%;"><span style="font-size: 16px; font-weight:bold;">ঘ) উৎসব ভাতাঃ</span>
                        আপনি, বছরে একটি মূল বেতনের (বেসিক স্যালারী) সমান উৎসব ভাতা প্রাপ্ত হবেন। যার অর্ধেক পরিমান টাকা
                        ইদ-উল-ফিতরের আগে এবং বাকি অর্ধেক ইদ-উল-আযহার আগে প্রদান করা হবে ।
                    </span>
                    <br>
                    <li><span style="font-size: 15px; font-weight:bold;"> চাকুরির অবসানঃ</span> অত্র প্রতিষ্ঠান আপনাকে
                        ৩০ (ত্রিশ) দিনের লিখিত পূর্ব নোটিশ প্রদান করত: বা তাৎক্ষনিক ভাবে উক্ত নোটিশ কালীন সময়ের যাবতীয়
                        পাওনা পরিশোধ স্বাপেক্ষে আপনার চাকুরির অবসান ঘটাতে পারে । আপনিও চাইলে ৩০ (ত্রিশ) দিনের পূর্ব
                        নোটিশ প্রদান স্বাপেক্ষে বা উক্ত নোটিশ কালীন সময়ের যাবতীয় পাওনা পরিশোধ স্বাপেক্ষে চাকুরি থেকে
                        অব্যাহতি নিতে পারেন । </li>
                    <li><span style="font-size: 15px; font-weight:bold;">চাকুরি হতে ডিসচার্জঃ </span> কোন রেজিষ্টার্ড
                        চিকিৎসক কর্তৃক প্রত্যয়িত আপনার শারীরিক বা মানসিক অক্ষমতা বা অব্যাহত ভগ্ন স্বাস্থ্যের কারণে যে
                        কোন সময়ে আপনাকে চাকুরি হতে ডিসচার্জ করা যেতে পারে ।</li>
                    <li> <span style="font-size: 15px; font-weight:bold;">চাকুরি হতে বরখাস্তঃ </span><br>
                        <span style="margin-left: 3%;">
                            ক) আপনি, যদি কোন প্রকার অসদাচরণের অপরাধে দোষী সাব্যস্ত হন অথবা আপনি যদি কোন ফৌজদারী অপরাধের
                            জন্য দণ্ডপ্রাপ্ত হন সেক্ষেত্রে আপনাকে বিনা নোটিশে বা নোটিশের পরিবর্তে বিনা বেতনে চাকুরি হতে
                            বরখাস্ত করা যেতে পারে ।
                        </span><br>
                        <span style="margin-left: 3%;">
                            খ) আপনি, যদি রাষ্ট্রদ্রোহী অথবা জঙ্গিবাদ সংশ্লিষ্ট কাজে লিপ্ত থাকেন অথবা থাকার প্রমাণ পাওয়া
                            যায়, সেক্ষেত্রে আপনাকে বিনা নোটিশে চাকুরি হতে বরখাস্ত করা যেতে পারে ।
                        </span><br><br><br><br>
                        <p style="font-size: 10px;text-align:center;">1 | Page | Prediction Learning Associates Ltd.,
                            365/9, Lane 06, Baridhara DOHS, Dhaka -1206, Bangladesh;<br>
                            Tel: +88028413439; +8801713 -334 874; www.predictionla.com, email: info@predictionla.com</p>
                        <br><br><br>
                        <img style="width:170px;" src="{{asset('idcard/pla_logo.png')}}"> <br>
                        <span style="margin-left: 3%;">
                            গ) এছাড়াও আপনার পক্ষ থেকে কোনরূপ ব্যর্থতা এবং সময়মত দায়িত্ব ও কর্তব্য পালন না করলে আপনাকে
                            চাকুরি হতে বরখাস্ত সহ আইনানুগ ব্যবস্থা গ্রহণ করত: বরখাস্ত করতে পারবে ।
                        </span>
                    </li>
                    <li><span><span style="font-size: 15px;font-weight:bold;">ছুটিঃ </span>
                            বাৎসরিক ছুটি বাংলাদেশ শ্রম আইন অনুযায়ী প্রযোজ্য হবে ।
                        </span></li>
                    <li><span>
                            আপনার চাকরি বাংলাদেশের যে কোন অঞ্চলে বদলিযোগ্য ।
                        </span></li>
                    <li><span>
                            চাকুরিরত থাকা অবস্থায় আপনি অন্য কোন ব্যবসা বা পেশার মধ্যে প্রত্যক্ষ বা পরোক্ষ ভাবে জড়িত হতে
                            পারবেন না ।
                        </span></li>
                    <li><span>
                            আপনার অত্র নিয়োগ পত্রটি চুক্তি ভিত্তিক হিসাবে পরিগনিত হবে এবং আপনি প্রতিষ্ঠানের বা এর গ্রাহক
                            অথবা গ্রাহক কোম্পানির ব্যবসা সংক্রান্ত যে কোন গোপনীয়তা কঠোর ভাবে বজায় রাখবেন ।
                        </span></li>
                    <li><span>আপনার সাথে নিয়োগ থাকাকালীন অবস্থায় এমনকি চাকুরি পরিসমাপ্তির পরেও নিম্নের বিষয়গুলো আপনাকে
                            মেনে চলতে হবে ।
                            <p style="margin-left: 3%;">
                                ক) আমাদের গ্রাহক কোম্পানির ব্যবসায়ীক নীতিমালা ও আচরণ বিধি সমুহ মেনে চলবেন।
                            </p>
                            <p style="margin-left: 3%;">
                                খ) ব্যক্তিগত ও ব্যবসায়ীক গোপনীয়তা সংরক্ষণ করবেন ।
                            </p>
                    </li>
                    <li><span>
                            সকল বিধি ও বিধিমালা, নীতিমালা, পদ্ধতি যা আপনার নিয়োগ পত্রে উল্লেখিত তা বর্তমানে কার্যকর বলে
                            গণ্য হবে এবং সেগুলো প্রতিষ্ঠানের বিবেচনায় যে কোন সময় পরিবর্তিত হতে পারে । তবে এই রকম
                            পরিবর্তন হলে আপনাকে পূর্বে অবহিত করা হবে ।
                        </span></li>
                    <li><span>
                            অত্র প্রতিষ্ঠান বা গ্রাহক কোম্পানির যে সকল সম্পদ ও পরিসম্পদ সমূহ যেগুলো কর্মরত অবস্থায় আপনার
                            অধীনে থাকবেন যেমন- ব্যাগ, মোবাইল সেট, মোবাইল সিম, ক্যাটালগ, ইত্যাদি অথবা অন্য কোন দলিল ও
                            তথ্যাদি, অত্র নিয়োগের পরিসমাপ্তি হলে সেগুলো আপনি কর্তৃপক্ষকে ফেরত দিতে বাধ্য থাকবেন ।
                        </span></li>
                    <li><span>
                            এ নিয়োগের অন্যান্য শর্তাদি অত্র প্রতিষ্ঠানের বিধি ও প্রবিধান এবং শ্রম আইন অনুযায়ী পরিচালিত
                            হবে।
                        </span></li>
                </ol>
                <p>আপনি যদি উপরিউক্ত শর্তাবলী, প্রতিষ্ঠানের নিয়মনীতি এবং গ্রাহক কোম্পানির নিয়মনীতি মেনে চলতে আগ্রহী হন
                    এবং অঙ্গীকারবদ্ধ হন তাহলে নিম্নে নির্ধারিত স্থানে আপনার সম্মতি সূচক স্বাক্ষর প্রদান করত: অত্র নিয়োগ
                    পত্রের প্রতিলিপি প্রতিষ্ঠানে ফেরত প্রদান করুন ।</p><br>
                <p>আমরা আপনাকে প্রেডিকশন লার্নিং এসোসিয়েটস লিঃ (পি.এল.এ.) পরিবারে স্বাগত জানাই এবং আপনার সার্বিক সাফল্য
                    ও মঙ্গল কামনা করছি । আমরা বিশ্বাস করি যে, আমাদের পি.এল.এ পরিবারের সঙ্গে আপনার মিলিত হওয়া একটি সুখী ও
                    পারস্পরিক সৌহার্দ্যের পরিচায়ক হবে ।</p>
                <div style="width:1200px;">
                    <div style="float:left;width:40%;">
                        <p>ধন্যবাদান্তে,<br /><br>
                            <span><img style="height:30px;width:70px;" src="{{asset('idcard/signature.png')}}"></span>
                        </p>
                        <p style="padding-top:-35px;">__________________ </P>
                        <span style="font-size: 16px;">
                            মোঃ আরিফুল ইসলাম
                            <br>
                            ব্যবস্থাপনা পরিচালক
                            <br>
                            প্রেডিকশন লার্নিং এসোসিয়েটস লিঃ (পি.এল.এ.)<br>
                        </span>
                    </div>
                    <div style="float:right;width:35%;">
                        <p style="padding-bottom:20px;"> স্বীকৃতি স্বাক্ষর<br /><br>
                            _____________________ <br />
                            {{$employee_value->emoloyeedetail->bangla_name ?? null}} <br /> <br>
                            {{ __(' জাতীয় পরিচয়/জন্ম সনদ পত্র নং :') }} <br>{{$identification_number ?? null}}
                            <br>
                            {{ __('মোবাইল নং :') }} {{$phone}}

                        </p>
                    </div>
                </div>

                <br><br><br>
                <p style="font-size: 10px;text-align:center;">2 | Page | Prediction Learning Associates Ltd., 365/9,
                    Lane 06, Baridhara DOHS, Dhaka -1206, Bangladesh;<br>
                    Tel: +88028413439; +8801713 -334 874; www.predictionla.com, email: info@predictionla.com</p><br>


    </div>
    @endif

    @if($employee_value->appointment_letter == "management")
    <div> <img style="width:170px;padding-left:30px;" src="{{asset('uploads/logos/logo.png')}}">
        <br>
        <p style="padding-left:30px;font-size:13px;padding-bottom:-18px;">
            <br>

            @if($employee_value->joining_date <= '2022-03-28' ) {{ __(' Date: 1st April 2022 ')}}

    @else
     {{ __(' Date: ')}}

        <?php
if($day == ' 1'){echo $day.'st '.$month." ".$year."";}
if($day == ' 2'){echo $day.'nd '.$month." ".$year." ";}
if($day == ' 3'){echo $day.'rd '.$month." ".$year." ";}
if($day == ' 4'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 5'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 6'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 7'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 8'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 9'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 10'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 11'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 12'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 13'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 14'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 15'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 16'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 17'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 18'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 19'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 20'){echo $day.'th'.$month." ".$year." ";}
if($day == '21'){echo $day.'th '.$month." ".$year." ";}
if($day == '22'){echo $day.'th '.$month." ".$year." ";}
if($day == '23'){echo $day.'th '.$month." ".$year." ";}
if($day == '24'){echo $day.'th '.$month." ".$year." ";}
if($day == '25'){echo $day.'th '.$month." ".$year." ";}
if($day == '26'){echo $day.'th '.$month." ".$year." ";}
if($day == '27'){echo $day.'th '.$month." ".$year." ";}
if($day == '28'){echo $day.'th '.$month." ".$year." ";}
if($day == '29'){echo $day.'th '.$month." ".$year." ";}
if($day == '30'){echo $day.'th '.$month." ".$year." ";}
if($day == '31'){echo $day.'th '.$month." ".$year." ";}

 ?>



   @endif
  </p>
</div>
<div class=" appointment-letter">
                <p style="padding-bottom:-10px;font-size:15px;"> <u>LETTER OF APPOINTMENT</u></p>
                <span style="font-size:12px;"> {{ $employee_value->first_name ?? null}} {{$employee_value->last_name ??
                    null}}</span><br>
                <span style="font-size:12px;"> {{ $employee_value->emoloyeedetail->permenet_address_english ??
                    null}}</span>
                <br>
        </p>

        <p> <span style="font-size:12px;font-weight:bold;">Dear {{ $employee_value->first_name ?? null}}
                {{$employee_value->last_name ?? null}},</span> <br>
            <span style="font-size:12px;">This is with reference to your application subsequent interview with us, we
                are pleased to appoint you under Prediction Learning Associates Ltd. with effect from
                <span style="font-weight:bold;">
                    @if($employee_value->joining_date <= '2022-03-28' ) {{ __(' 1st April 2022 ')}}

    @else
        <?php
if($day == ' 1'){echo $day.'st '.$month." ".$year."";}
if($day == ' 2'){echo $day.'nd '.$month." ".$year." ";}
if($day == ' 3'){echo $day.'rd '.$month." ".$year." ";}
if($day == ' 4'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 5'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 6'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 7'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 8'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 9'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 10'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 11'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 12'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 13'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 14'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 15'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 16'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 17'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 18'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 19'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 20'){echo $day.'th'.$month." ".$year." ";}
if($day == '21'){echo $day.'th '.$month." ".$year." ";}
if($day == '22'){echo $day.'th '.$month." ".$year." ";}
if($day == '23'){echo $day.'th '.$month." ".$year." ";}
if($day == '24'){echo $day.'th '.$month." ".$year." ";}
if($day == '25'){echo $day.'th '.$month." ".$year." ";}
if($day == '26'){echo $day.'th '.$month." ".$year." ";}
if($day == '27'){echo $day.'th '.$month." ".$year." ";}
if($day == '28'){echo $day.'th '.$month." ".$year." ";}
if($day == '29'){echo $day.'th '.$month." ".$year." ";}
if($day == '30'){echo $day.'th '.$month." ".$year." ";}
if($day == '31'){echo $day.'th '.$month." ".$year." ";}

 ?>

   @endif </span> under the following terms and conditions:
    </span>
    <div style=" display:none;">
                        {{$basic =
                        ($employee_value->gross_salary*$employee_value->salaryconfig->salary_config_basic_salary)/100}}
                        {{$house =
                        ($employee_value->gross_salary*$employee_value->salaryconfig->salary_config_house_rent_allowance)/100}}
                        {{$medical =
                        ($employee_value->gross_salary*$employee_value->salaryconfig->salary_config_medical_allowance)/100}}

                        <?php
       $medical_tot = 0;
       $house_tot = 0;
       $basic_tot = 0;
       $transport = 0;
       $mobile =0;
       $lunch =0;
       $special = 0;
       $Internet = 0;
       ?>


    </div>

    <!--আগামী -->

    <div>
        <p style="font-size:14px;font-weight:bold;padding-top:-10px;">TERMS AND CONDITIONS:</p>
    </div>

    <ol style="padding-left:15px; list-style-type: english;padding-top:-10px; font-size:13px;">
        <li><span>You will be assigned for our client and you may be transferred to any of our clients anywhere in
                Bangladesh. </li><br>
        <li>You will be designated as <span style="font-weight:bold;font-size:12px;">
                “{{$employee_value->userdesignation->designation_name}}”</span> and you will be posted to Dhaka and
            depending on business needs, you may be transferred to anywhere in Bangladesh.</li><br>
        <li><span style="font-weight:bold;"> Remuneration and benefits: <br></span><br> <span
                style="margin-left: 3%; margin-right:50%">
                <span style="font-size: 13px;"> Your monthly salary and other benefits are given below: </span> <br>
                <div style="padding-left: 5%">
                    <p>
                        @if($basic) {{__('Basic salary ')}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        BDT &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="margin-left:20%;"> {{$basic_tot=
                            number_format((float)$basic , 0, '.', '')}}{{__('.00')}}&nbsp; </span> <br>@endif
                        @if($house) House rent
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        BDT <span style="padding-left:20%;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{
                            $house_tot = number_format((float)$house , 0, '.', '')}}{{__('.00')}} &nbsp;
                        </span><br>@endif
                        @if($medical) Medical allowance
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BDT
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="margin-left:20%;">{{$medical_tot=
                            number_format((float)$medical , 0, '.', '')}}{{__('.00')}} &nbsp; </span> <br> @endif
                        @foreach($employee_allowances as $emp)@if($emp->allowance_head_id == 16) Lunch
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BDT
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="margin-left:20%;"> {{$lunch =
                            $emp->allowance_head_ammount ?? '1000'}}{{__('.00')}} &nbsp; </span> <br>@endif @endforeach
                        @if($employee_value->transport_allowance) Transport Allowance
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        BDT &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="margin-left:20%;">
                            {{$transport = $employee_value->transport_allowance ?? 0}}{{__('.00')}}&nbsp; </span>
                        <br>@endif
                        @if($employee_value->mobile_bill) Mobile allowance
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        BDT &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="margin-left:20%;"> {{$mobile =
                            $employee_value->mobile_bill ?? 0}} {{__('.00')}}&nbsp; </span> <br> @endif
                        @foreach($employee_allowances as $emp)@if($emp->allowance_head_id == 12) Special allowance
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BDT
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="margin-left:20%;"> {{ $special =
                            $emp->allowance_head_ammount ?? 0}}{{__('.00')}} &nbsp; </span> <br>@endif @endforeach
                        @foreach($employee_allowances as $emp)@if($emp->allowance_head_id == 19) Internet Bill
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp; &nbsp; &nbsp;BDT &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span
                            style="margin-left:20%;"> {{ $Internet = $emp->allowance_head_ammount ?? 0}}{{__('.00')}}
                            &nbsp; </span> <br>@endif @endforeach
                        <span
                            style="background-color:white;color:black;font-weight:bold;">______________________________________________________________________________________________________________</span><br>

                        <span style="font-weight:bold;"> Total &nbsp; salary
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BDT
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{$medical_tot+$house_tot +$basic_tot
                            +$transport+$mobile+$lunch+$special+$Internet }}{{__('.00')}} &nbsp;</span>

                    </p>
                </div>
        </li>

        <br>
        <li> You will be entitled to 2 (two) annual festival bonuses, each equivalent to 1 Basic salary. </li><br>
        <li> You will be entitled to 14 days’ Annual leave with pay and 14 days Sick leave with pay.</li><br>
        <li> Your work week duty hours shall be notified by the client company. Duty hours shall be notified by the
            company from time to time. </li> <br>
        <li> You shall conform to all Rules and Regulations in force from time to time and shall carry out all other
            lawful orders/instructions/directions of your Superiors as are given to you in connection with day-to-day
            discharge of your duties while in the Employment of our client.</li><br>
        <li> Your contract of service shall be subject to termination with one-month notice from either side or monetary
            value. </li><br>
        </span><br><br><br><br>
        <p style="font-size: 10px;text-align:center;">1 | Page | Prediction Learning Associates Ltd., 365/9, Lane 06,
            Baridhara DOHS, Dhaka -1206, Bangladesh;<br>
            Tel: +88028413439; +8801713 -334 874; www.predictionla.com, email: info@predictionla.com</p><br><br><br>
        <img style="width:170px;" src="{{asset('idcard/pla_logo.png')}}"> <br>
        <span style="margin-left: 3%;">
        </span>
        </li><br>
        <li>Upon termination of your employment, you will return to the Company all papers and documents or other
            property which may at that time be in your possession, relating to the business or affairs of the Company or
            any of the associates or branches and you will not retain any copy or extracts thereof. </li><br>
        <li>You will also abide by our client’s Code of Conducts and policies and must conduct yourself in such a manner
            which is not prejudicial to interest of our client Non-compliance may result disciplinary action including
            dismissal.</li><br>
        <li><span>
                During this employment and thereafter, you will keep strictly secrecy regarding the business of the
                company and its client. You will not divulge to any person, firm or company, whomsoever other than to
                the Directors of the Company or their clients or their authorized representatives any information
                regarding your salary, increments and emoluments or any confidential information of any description
                concerning the business or the affairs or any of its associates or branches, their customers and
                suppliers, acquired by you while in your service.
            </span></li><br>
        <li>During your employment, you will place your full capabilities at the service of the projects that you are
            assigned to and you will carry out all the duties willingly and obediently as per the directives issued to
            you from time to time by the Management or your superior. You will be sincere, conscientious, and careful in
            carrying out your duties. You will be display good conduct and behavior inside of the Company, with all
            colleagues, customers and the public in general to place the image of the Company in high esteem.
        </li><br>
        <li><span>
                You are not allowed to perform or act below things during your employment with us:
                <div style="padding-left: 12%">
                    <p>a. To engage or accepts any other business / employment, either paid or unpaid. <br><br>
                        b. To engage in any civic, political activates or private business without the written approval
                        of the Management.<br><br>
                        c. To use property or premises of the company for other than company purposes without prior
                        consent of the management.<br><br>
            </span><br>
            </p>

            </div>
            </span></li><br>
        <li>You will keep the company informed time to time if there is any change in status of any information you have
            provided in the application.</li><br>
        <li>If it is found at any time any of the information is false or that any vital information was not disclosed,
            Prediction Learning Associates Ltd. reserves the right to terminate your employment without any notice or
            salary in lieu thereof. </li><br>
        <br><br><br>
        <p style="font-size: 10px;text-align:center;">2 | Page | Prediction Learning Associates Ltd., 365/9, Lane 06,
            Baridhara DOHS, Dhaka -1206, Bangladesh;<br>
            Tel: +88028413439; +8801713 -334 874; www.predictionla.com, email: info@predictionla.com</p><br>
        <img style="width:170px;" src="{{asset('idcard/pla_logo.png')}}"> <br>

        <li>This contract will be valid till 31st March, 2023; based on availability of the position, your contract will
            be renewed. </li>
    </ol>
    <p style="font-size:14px;">ADMINISTRATIVE REQUREMENTS</p>
    <ol style="list-style-type: english;font-size:13px;">
        <li>Please report to our client at your place of posting and submit your joining letter on or before
            @if($employee_value->joining_date <= '2022-03-28' ) {{ __(' 1st April 2022 ')}}

    @else


        <?php
if($day == ' 1'){echo $day.'st '.$month." ".$year."";}
if($day == ' 2'){echo $day.'nd '.$month." ".$year." ";}
if($day == ' 3'){echo $day.'rd '.$month." ".$year." ";}
if($day == ' 4'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 5'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 6'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 7'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 8'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 9'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 10'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 11'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 12'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 13'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 14'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 15'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 16'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 17'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 18'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 19'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 20'){echo $day.'th'.$month." ".$year." ";}
if($day == '21'){echo $day.'th '.$month." ".$year." ";}
if($day == '22'){echo $day.'th '.$month." ".$year." ";}
if($day == '23'){echo $day.'th '.$month." ".$year." ";}
if($day == '24'){echo $day.'th '.$month." ".$year." ";}
if($day == '25'){echo $day.'th '.$month." ".$year." ";}
if($day == '26'){echo $day.'th '.$month." ".$year." ";}
if($day == '27'){echo $day.'th '.$month." ".$year." ";}
if($day == '28'){echo $day.'th '.$month." ".$year." ";}
if($day == '29'){echo $day.'th '.$month." ".$year." ";}
if($day == '30'){echo $day.'th '.$month." ".$year." ";}
if($day == '31'){echo $day.'th '.$month." ".$year." ";}

 ?>



   @endif
    </li><br>
          <li>You must produce release certificate or acceptance of resignation from last employer and undertaking stating no dues pending from the previous employer, if any.</li><br>
          <li>You must present your original educational certificate and experience certificates. At the time of joining copies of the same will be retained by the Prediction Learning Associates Ltd.</li><br>
      </ol>
  <p style=" font-size: 13px;">If you agree with above terms and conditions, please confirm your acceptance of this
                appointments letter by signing and returning to us the duplicate copy. Please submit your joining
                letter.<br><br>
                We have the pleasure in welcoming you in our company and sincerely hope that our close collaboration
                will be a mutually satisfactory one.
                </p>
                <div>
                    <div style="float:left;width:60%;">
                        <p style="font-size: 13px;">Yours faithfully,<br /><br>
                            <span><img style="height:30px;width:70px;" src="{{asset('idcard/signature.png')}}"></span>
                        </p>
                        <p style="padding-top:-35px;">__________________ </P>
                        <span style="font-size: 14px;">
                            <span style="font-weight:bold;">Md. Ariful Islam </span>
                            <br>
                            Managing Director
                            <br>
                            <span style="font-weight:bold;"> Prediction Learning Associates Ltd.</span><br>
                        </span>
                    </div>
                </div>
                <div>
                    <br>
                    <p style="font-size:16px;">AGREEMENT: </p>
                    <div style="padding-left:15px;font-size: 13px;">
                        <p>I have carefully read the above letter and the terms and conditions set out therein, which I
                            have fully understood, and I hereby accept the same.</p>
                        <p>Signature……………………</p>
                        <p>Date……………………………</p>
                    </div>
                </div>

                <br>
                <p style="font-size: 10px;text-align:center;">3 | Page | Prediction Learning Associates Ltd., 365/9,
                    Lane 06, Baridhara DOHS, Dhaka -1206, Bangladesh;<br>
                    Tel: +88028413439; +8801713 -334 874; www.predictionla.com, email: info@predictionla.com</p><br><br>


                </div>

                @endif

                @if($employee_value->appointment_letter == "nonmanagement")

                <div> <img style="width:170px;padding-left:30px;" src="{{asset('uploads/logos/logo.png')}}">
                    <br>


                    <p style="margin-left:77%;font-size:15px;">
                        <br>
                        @if($employee_value->joining_date <= '2022-03-28' ) {{ __('তারিখঃ ১লা এপ্রিল ২০২২ ইং')}} @else
                            <?php echo 'তারিখঃ ' ; if($joinig_day=='১' ){echo $joinig_day.'লা '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ২'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ৩'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ৪'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ৫'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ৬'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ৭'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ৮'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ৯'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ১০'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ১১'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ১২'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ১৩'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ১৪'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ১৫'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ১৬'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ১৭'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ১৮'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ১৯'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ২০'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ২১'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ২২'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ২৩'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ২৪'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ২৫'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ২৬'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ২৭'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ২৮'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ২৯'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ৩০'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ৩১'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}


 ?>

    @endif




  </p>
</div>
<div class="appointment-letter" style="font-size:15px;">

  {{ $employee_value->emoloyeedetail->bangla_name ?? null}}<br>
{{ $employee_value->emoloyeedetail->permenet_address_bangla ?? null}}
 <br>
   <span style="font-weight:bold;"> বিষয়ঃ অস্থায়ী ভিত্তিতে চাকুরির নিয়োগ পত্র । </span>
  </p>

  <p> জনাব {{ $employee_value->emoloyeedetail->bangla_name ?? null}}, <br>
  অত্যন্ত আনন্দের সহিত জানানো যাচ্ছে যে, আপনার আবেদনের প্রেক্ষিতে এবং পরবর্তীতে প্রদত্ত সাক্ষাৎকারের ভিত্তিতে আপনাকে আমাদের প্রতিষ্ঠানের সহিত গ্রাহক কোম্পানির সম্পাদিত চুক্তি মোতাবেক <span style="font-weight:bold;"> “{{$employee_value->userdesignation->designation_bangla_name}}”</span> হিসেবে নিম্ন উল্লিখিত শর্ত স্বাপেক্ষে সম্পূর্ন অস্থায়ী শ্রমিক হিসাবে নিয়োগের সিদ্ধান্ত গৃহীত হয়েছে। এ নিয়োগ

    @if($employee_value->joining_date <= ' 2022-03-28') {{ __(' ১লা এপ্রিল ২০২২ ইং')}} @else <?php if($joinig_day=='১'
                            ){echo $joinig_day.'লা '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ২'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ৩'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ৪'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ৫'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ৬'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ৭'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ৮'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ৯'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ১০'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ১১'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ১২'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ১৩'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ১৪'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ১৫'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ১৬'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ১৭'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ১৮'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ১৯'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ২০'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ২১'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ২২'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ২৩'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ২৪'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ২৫'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ২৬'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ২৭'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ২৮'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ২৯'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ৩০'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ৩১'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}





 ?>

    @endif

<?php


  $lunch_allowance_amount_bn = 0;
  $lunch_allowance_amount = Bengali_DTN($lunch_allowance_amount_bn );
  $lunch_allowance = 0;

$internet_allowance_amount_bn =0;
$internet_allowance_amount= Bengali_DTN($internet_allowance_amount_bn );
$internet_allowance = 0;

$special_allowance_amount_bn =0;
$special_allowance_amount= Bengali_DTN($special_allowance_amount_bn );
$special_allowance = 0;

foreach($employee_allowances as $emp){

if($emp->allowance_head_id == 16){
$lunch_allowance_amount = Bengali_DTN($emp->allowance_head_ammount);
$lunch_allowance = $emp->allowance_head_ammount ?? 0;
}
if($emp->allowance_head_id == 12){
$special_allowance_amount =Bengali_DTN($emp->allowance_head_ammount);
$special_allowance = $emp->allowance_head_ammount ?? 0;
}

if($emp->allowance_head_id == 19){
$internet_allowance_amount =Bengali_DTN($emp->allowance_head_ammount);
$internet_allowance = $emp->allowance_head_ammount ?? 0;
}
     }




    $tot_ban = $basic_salay+$house_rent+$medical_allowence +$transport_allowance +$mobile+$lunch_allowance+$special_allowance+$internet_allowance ;
    $tot_ban_float_round = number_format((float)$tot_ban, 0, ' .', '' );
                            $total_bangla=Bengali_DTN("$tot_ban_float_round"); ?>

                            তারিখ থেকে কার্যকর করা হবে এবং প্রজেক্ট এর চুক্তির মেয়াদ ৩১ শে মার্চ ২০২৩ ইং পর্যন্ত বলবৎ
                            থাকবে, যা চুক্তি নবায়ন স্বাপেক্ষে আপনার নিয়োগ বর্ধিত করা যেতে পারে।
                            <ol style="padding-left:15px">
                                <li><span style="font-weight:bold;"> কর্মস্থলঃ প্রেডিকশন লার্নিং এসোসিয়েটস লিঃ
                                        (পি.এল.এ.)</span> এর নিয়োগপ্রাপ্ত অস্থায়ী শ্রমিক হিসাবে আপনি প্রতিষ্ঠানের
                                    সম্মানিত গ্রাহক কোম্পানির কর্পোরেট অফিসে দ্বায়িত্ব প্রাপ্ত হবেন । </li>
                                <li><span style="font-weight:bold;"> পারিশ্রমিক ও সুবিধাদিঃ </span><br> <span
                                        style="margin-left: 3%; margin-right:50%">
                                        ক) <span style="font-weight:bold;font-size: 15px;"> মাসিক মোট বেতনঃ </span><br>
                                        <p style="padding-left:10%;">
                                            @if($basic_salay) মূল বেতন &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp; :
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span
                                                style="margin-left:20%;"> {{$basic_salary_float_round_bangla
                                                }}{{__('.০০')}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; টাকা </span> <br> @endif
                                            @if($house_rent) বাড়ি ভাড়া &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; :
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span
                                                style="margin-left:20%;">
                                                {{$house_salary_float_round_bangla}}{{__('.০০')}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                টাকা </span> <br> @endif
                                            @if($medical_allowence) চিকিৎসা ভাতা &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp; :
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span
                                                style="margin-left:20%;"> {{$medical_salary_float_round_bangla ??
                                                null}}{{__('.০০')}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; টাকা </span>
                                            <br>@endif
                                            @foreach($employee_allowances as $emp) @if($emp->allowance_head_id == 16)
                                            দৈনিক ভাতা&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; :
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span
                                                style="margin-left:20%;"> {{$lunch_allowance_amount ??
                                                $lunch}}{{__('.০০')}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; টাকা
                                            </span> <br> @endif @endforeach
                                            @if($transport_allowance) যাতায়াত ভাতা&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span
                                                style="margin-left:20%;"> {{ $transport ?? null}}{{__('.০০')}}
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; টাকা </span> <br> @endif
                                            @if($mobile) মোবাইল ভাতা &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp; :
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span
                                                style="margin-left:20%;"> {{$mobile_bill ?? null }}{{__('.০০')}}
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; টাকা </span> <br>
                                            @endif

                                            @foreach($employee_allowances as $emp) @if($emp->allowance_head_id == 12)
                                            বিশেষ ভাতা
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            : <span style="padding-left:40px;">
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{
                                                $special_allowance_amount?? $special}}{{__('.০০')}}
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; টাকা </span><br> @endif @endforeach
                                            @foreach($employee_allowances as $emp) @if($emp->allowance_head_id == 19)
                                            ইন্টারনেট বিল
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            : <span style="padding-left:40px;">
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{
                                                $internet_allowance_amount?? 0}}{{__('.০০')}}
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; টাকা </span><br> @endif
                                            @endforeach

                                            <span
                                                style="background-color:white;color:black;font-weight:bold;">____________________________________________________________</span><br>
                                            <span style="font-weight:bold;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                সর্বমোট
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$total_bangla.'.০০' }}
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; টাকা </span>

                                        </p>

                                        <div style="padding-left: 12%">


                                        </div>

                </div>
                <span style="margin-left: 3%;"><span style="font-size: 16px; font-weight:bold;">খ) উৎসব ভাতাঃ</span>
                    আপনি, বছরে দুটি উৎসব ভাতা প্রাপ্ত হবেন, যাহার প্রতিটি আপনার একটি মূল বেতনের সমপরিমান হবে ।
                </span>
                <br>
        </li><br>
        <li><span style="font-size: 15px; font-weight:bold;"> চাকুরির অবসানঃ</span> অত্র প্রতিষ্ঠান আপনাকে ৩০ (ত্রিশ)
            দিনের লিখিত পূ্র্ব নোটিশ প্রদান করত: বা তাৎক্ষনিক ভাবে উক্ত নোটিশ কালীন সময়ের যাবতীয় পাওনা পরিশোধ স্বাপেক্ষে
            আপনার চাকুরির অবসান ঘটাতে পারে । আপনিও চাইলে ৩০ (ত্রিশ) দিনের পূ্র্ব নোটিশ প্রদান স্বাপেক্ষে বা উক্ত নোটিশ
            কালীন সময়ের যাবতীয় পাওনা পরিশোধ স্বাপেক্ষে চাকুরি থেকে অব্যাহতি নিতে পারেন । </li><br>
        <li><span style="font-size: 15px; font-weight:bold;">চাকুরির হতে ডিসচার্জঃ </span> কোন রেজিষ্টার্ড চিকিৎসক
            কর্তৃক প্রত্যয়িত আপনার শারিরিক বা মানসিক অক্ষমতা বা অব্যাহত ভগ্ন স্বাস্থ্যের কারণে যে কোন সময়ে আপনাকে চাকুরি
            হতে ডিসচার্জ করা যেতে পারে ।</li>
        <li> <span style="font-size: 15px; font-weight:bold;">চাকুরির হতে বরখাস্তঃ </span><br>
            <span style="margin-left: 3%;">
                ক) আপনি, যদি কোন প্রকার অসদাচরণের অপরাধে দোষী সাব্যস্ত হন অথবা আপনি যদি কোন ফৌজদারী অপরাধের জন্য
                দন্ডপ্রাপ্ত হন সেক্ষেত্রে আপনাকে বিনা নোটিশে বা নোটিশের পরিবর্তে বিনা বেতনে চাকুরি হতে বরখাস্ত করা যেতে
                পারে ।
            </span><br>
            <span style="margin-left: 3%;">
                খ)আপনি, যদি রাষ্ট্রদ্রোহী অথবা জঙ্গিবাদ সংশ্লিষ্ট কাজে লিপ্ত থাকেন অথবা থাকার প্রমাণ পাওয়া যায়,
                সেক্ষেত্রে আপনাকে বিনা নোটিশে চাকুরি হতে বরখাস্ত করা যেতে পারে ।
            </span><br>
            <span style="margin-left: 3%;">
                গ) এছাড়াও আপনার পক্ষ থেকে কোনরূপ ব্যর্থতা এবং সময়মত দায়িত্ব ও কর্তব্য পালন না করলে আপনাকে চাকুরি হতে
                বরখাস্ত সহ আইনানুগ ব্যবস্থা গ্রহণ করত: বরখাস্ত করতে পারবে ।
            </span>
            <br><br><br><br>
            <p style="font-size: 10px;text-align:center;">1 | Page | Prediction Learning Associates Ltd., 365/9, Lane
                06, Baridhara DOHS, Dhaka -1206, Bangladesh;<br>
                Tel: +88028413439; +8801713 -334 874; www.predictionla.com, email: info@predictionla.com</p><br><br><br>
            <img style="width:170px;" src="{{asset('idcard/pla_logo.png')}}"> <br>

        </li>
        <li><span><span style="font-size: 15px;font-weight:bold;">ছুটিঃ </span>
                বাৎসরিক ছুটি বাংলাদেশ শ্রম আইন অনুযায়ী প্রযোজ্য হইবে ।
            </span></li>
        <li><span>
                আপনার চাকুরি বাংলাদেশের যে কোন অঞ্চলে বদলিযোগ্য ।
            </span></li>
        <li><span>
                চাকরিরত থাকা অবস্থায় আপনি অন্য কোন ব্যবসা বা পেশার মধ্যে প্রত্যক্ষ বা পরোক্ষ ভাবে জড়িত হতে পারবেন না ।
            </span></li>
        <li><span>
                আপনার অত্র নিয়োগ পত্রটি চুক্তি ভিত্তিক হিসাবে পরিগনিত হবে এবং আপনি প্রতিষ্ঠানের বা এর গ্রাহক কোম্পানির
                ব্যবসা সংক্রান্ত যে কোন গোপনীয়তা কঠোর ভাবে বজায় রাখবেন ।
            </span></li>
        <li><span>আপনার সাথে নিয়োগ থাকাকালিন অবস্থায় এমনকি চাকুরি পরিসমাপ্তির পরেও নিম্নের বিষয়গুলো আপনাকে মেনে চলতে হবে
                ।
                <p style="margin-left: 3%;">
                    ক) আমাদের গ্রাহক কোম্পানির ব্যবসায়ীক নীতিমালা ও আচরন বিধি সমুহ মেনে চলবেন ।
                </p>
                <p style="margin-left: 3%;">
                    খ) ব্যাক্তিগত ও ব্যবসায়ীক গোপনীয়তা সংরক্ষন করবেন ।
                </p>
        </li><br>
        <li><span>
                সকল বিধি ও বিধিমালা, নীতিমালা, পদ্ধতি যা আপনার নিয়োগ পত্রে উল্লেখ তা বর্তমানে কার্যকর বলে গণ্য হবে এবং
                সেগুলো প্রতিষ্ঠানের বিবেচনায় যে কোন সময় পরিবর্তিত হতে পারে । তবে এই রকম পরিবর্তন হলে আপনাকে পূর্বে অবহিত
                করা হবে ।
            </span></li>
        <li><span>
                অত্র প্রতিষ্ঠান বা গ্রাহক কেম্পানীর যে সকল সম্পদ ও পরিসম্পদ সমূহ যেগুলো কর্মরত অবস্থায় আপনার অধীনে থাকবে
                যেমন, ব্যাগ, মোবাইল সেট, মোবাইল সিম, ক্যাটালগ, ইত্যাদি অথবা অন্য কোন দলিল ও তথ্যাদি, অত্র নিয়োগের
                পরিসমাপ্তি হলে সেগুলো আপনি কর্তৃপক্ষকে ফেরত দিতে বাধ্য
                থাকিবেন ।
            </span></li>
        <li><span>
                এ নিয়োগের অন্যান্য শর্তাদি অত্র প্রতিষ্ঠানের বিধি ও প্রবিধান এবং শ্রম আইন অনুযায়ী পরিচালিত হবে ।
            </span></li>
    </ol>
    <p>আপনি যদি উপরোক্ত শর্তাবলী, প্রতিষ্ঠানের নিয়মনীতি এবং গ্রাহক কোম্পানির নিয়মনীতি মেনে চলতে আগ্রহী হন এবং
        অঙ্গীকারাবদ্ধ হন তাহলে নিম্নে নির্ধারিত স্থানে আপনার সম্মতি সূচক স্বাক্ষর প্রদান করত: অত্র নিয়োগ পত্রের
        প্রতিলিপি প্রতিষ্ঠানে ফেরত প্রদান করুন ।</p><br>
    <p>আমরা আপনাকে প্রেডিকশন লার্নিং এসোসিয়েটস লিঃ (পি.এল.এ.) পরিবারে স্বাগত জানাই এবং আপনার সার্বিক সাফল্য ও মঙ্গল
        কামনা করছি । আমরা বিশ্বাস করি যে, আমাদের পি.এল.এ পরিবারের সঙ্গে আপনার মিলিত হওয়া একটি সুখী ও পারস্পরিক
        সৌহার্দ্যের পরিচায়ক হবে ।</p>
    <div style="width:1200px;">
        <div style="float:left;width:40%;">
            <p>ধন্যবাদান্তে,<br /><br>
                <span><img style="height:30px;width:70px;" src="{{asset('idcard/signature.png')}}"></span>
            </p>
            <p style="padding-top:-35px;">__________________ </P>
            <span style="font-size: 16px;">
                মোঃ আরিফুল ইসলাম
                <br>
                ব্যবস্থাপনা পরিচালক
                <br>
                প্রেডিকশন লার্নিং এসোসিয়েটস লিঃ (পি.এল.এ.)<br>
            </span>
        </div>
        <div style="float:right;width:35%;">
            <p style="padding-bottom:20px;"> স্বীকৃতি স্বাক্ষর<br /><br>
                _____________________ <br />
                {{$employee_value->emoloyeedetail->bangla_name ?? null}} <br /> <br>
                {{ __(' জাতীয় পরিচয়/জন্ম সনদ পত্র নং :') }} <br>{{$identification_number ?? null}}
                <br>
                {{ __('মোবাইল নং :') }} {{$phone}}

            </p>
        </div>
    </div>




    <br><br><br>
    <p style="font-size: 10px;text-align:center;">2 | Page | Prediction Learning Associates Ltd., 365/9, Lane 06,
        Baridhara DOHS, Dhaka -1206, Bangladesh;<br>
        Tel: +88028413439; +8801713 -334 874; www.predictionla.com, email: info@predictionla.com</p><br><br>


    </div>
    @endif
    @if($employee_value->appointment_letter == "management-factory")
    <div> <img style="width:170px;padding-left:30px;" src="{{asset('uploads/logos/logo.png')}}">
        <br>
        <p style="padding-left:30px;font-size:13px;padding-bottom:-18px;">
            <br>

            @if($employee_value->joining_date <= '2022-03-28' ) {{ __(' Date: 1st April 2022 ')}}

    @else
     {{ __(' Date: ')}}

        <?php
if($day == ' 1'){echo $day.'st '.$month." ".$year."";}
if($day == ' 2'){echo $day.'nd '.$month." ".$year." ";}
if($day == ' 3'){echo $day.'rd '.$month." ".$year." ";}
if($day == ' 4'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 5'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 6'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 7'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 8'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 9'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 10'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 11'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 12'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 13'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 14'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 15'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 16'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 17'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 18'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 19'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 20'){echo $day.'th'.$month." ".$year." ";}
if($day == '21'){echo $day.'th '.$month." ".$year." ";}
if($day == '22'){echo $day.'th '.$month." ".$year." ";}
if($day == '23'){echo $day.'th '.$month." ".$year." ";}
if($day == '24'){echo $day.'th '.$month." ".$year." ";}
if($day == '25'){echo $day.'th '.$month." ".$year." ";}
if($day == '26'){echo $day.'th '.$month." ".$year." ";}
if($day == '27'){echo $day.'th '.$month." ".$year." ";}
if($day == '28'){echo $day.'th '.$month." ".$year." ";}
if($day == '29'){echo $day.'th '.$month." ".$year." ";}
if($day == '30'){echo $day.'th '.$month." ".$year." ";}
if($day == '31'){echo $day.'th '.$month." ".$year." ";}

 ?>



   @endif
  </p>
</div>
<div class=" appointment-letter">
                <p style="padding-bottom:-10px;font-size:15px;"> <u>LETTER OF APPOINTMENT</u></p>
                <span style="font-size:12px;"> {{ $employee_value->first_name ?? null}} {{$employee_value->last_name ??
                    null}}</span><br>
                <span style="font-size:12px;"> {{ $employee_value->emoloyeedetail->permenet_address_english ??
                    null}}</span>
                <br>
        </p>

        <p> <span style="font-size:12px;font-weight:bold;">Dear {{ $employee_value->first_name ?? null}}
                {{$employee_value->last_name ?? null}},</span> <br>
            <span style="font-size:12px;">This is with reference to your application subsequent interview with us, we
                are pleased to appoint you under Prediction Learning Associates Ltd. with effect from
                <span style="font-weight:bold;">
                    @if($employee_value->joining_date <= '2022-03-28' ) {{ __(' 1st April 2022 ')}}

    @else
        <?php
if($day == ' 1'){echo $day.'st '.$month." ".$year."";}
if($day == ' 2'){echo $day.'nd '.$month." ".$year." ";}
if($day == ' 3'){echo $day.'rd '.$month." ".$year." ";}
if($day == ' 4'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 5'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 6'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 7'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 8'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 9'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 10'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 11'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 12'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 13'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 14'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 15'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 16'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 17'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 18'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 19'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 20'){echo $day.'th'.$month." ".$year." ";}
if($day == '21'){echo $day.'th '.$month." ".$year." ";}
if($day == '22'){echo $day.'th '.$month." ".$year." ";}
if($day == '23'){echo $day.'th '.$month." ".$year." ";}
if($day == '24'){echo $day.'th '.$month." ".$year." ";}
if($day == '25'){echo $day.'th '.$month." ".$year." ";}
if($day == '26'){echo $day.'th '.$month." ".$year." ";}
if($day == '27'){echo $day.'th '.$month." ".$year." ";}
if($day == '28'){echo $day.'th '.$month." ".$year." ";}
if($day == '29'){echo $day.'th '.$month." ".$year." ";}
if($day == '30'){echo $day.'th '.$month." ".$year." ";}
if($day == '31'){echo $day.'th '.$month." ".$year." ";}

 ?>

   @endif </span> under the following terms and conditions:
    </span>
    <div style=" display:none;">
                        {{$basic =
                        ($employee_value->gross_salary*$employee_value->salaryconfig->salary_config_basic_salary)/100}}
                        {{$house =
                        ($employee_value->gross_salary*$employee_value->salaryconfig->salary_config_house_rent_allowance)/100}}
                        {{$medical =
                        ($employee_value->gross_salary*$employee_value->salaryconfig->salary_config_medical_allowance)/100}}

                        <?php
   $medical_tot = 0;
   $house_tot = 0;
   $basic_tot = 0;
   $transport = 0;
   $mobile =0;
   $lunch =0;
   $special = 0;
   $Internet = 0;
   ?>

    </div>

    <!--আগামী -->


    <div>
        <p style="font-size:14px;font-weight:bold;padding-top:-10px;">TERMS AND CONDITIONS:</p>
    </div>

    <ol style="padding-left:15px; list-style-type: english;padding-top:-10px; font-size:13px;">
        <li><span>You will be assigned for our client and you may be transferred to any of our clients anywhere in
                Bangladesh. </li><br>
        <li>You will be designated as <span style="font-weight:bold;font-size:12px;">
                “{{$employee_value->userdesignation->designation_name}}”</span> and you will be posted to Gazipur and
            depending on business needs, you may be transferred to anywhere in Bangladesh.</li><br>
        <li><span style="font-weight:bold;"> Remuneration and benefits: <br></span><br> <span
                style="margin-left: 3%; margin-right:50%">
                <span style="font-size: 13px;"> Your monthly salary and other benefits are given below: </span> <br>
                <div style="padding-left: 5%">
                    <p>
                        @if($basic) {{__('Basic salary ')}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        BDT &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="margin-left:20%;"> {{$basic_tot=
                            number_format((float)$basic , 0, '.', '')}}{{__('.00')}}&nbsp; </span> <br>@endif

                        @if($house) House rent
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        BDT <span style="padding-left:20%;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{
                            $house_tot = number_format((float)$house , 0, '.', '')}}{{__('.00')}} &nbsp;
                        </span><br>@endif

                        @if($medical) Medical allowance
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BDT
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="margin-left:20%;">{{$medical_tot=
                            number_format((float)$medical , 0, '.', '')}}{{__('.00')}} &nbsp; </span> <br> @endif

                        @foreach($employee_allowances as $emp)@if($emp->allowance_head_id == 16) Lunch
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BDT
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="margin-left:20%;"> {{$lunch =
                            $emp->allowance_head_ammount ?? '1000'}}{{__('.00')}} &nbsp; </span> <br>@endif @endforeach

                        @if($employee_value->transport_allowance) Transport Allowance
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        BDT &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="margin-left:20%;">
                            {{$transport = $employee_value->transport_allowance ?? 0}}{{__('.00')}}&nbsp; </span> <br>
                        @endif

                        @if($employee_value->mobile_bill) Mobile allowance
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        BDT &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="margin-left:20%;"> {{$mobile =
                            $employee_value->mobile_bill ?? 0}} {{__('.00')}}&nbsp; </span> <br> @endif

                        @foreach($employee_allowances as $emp)@if($emp->allowance_head_id == 12) Special allowance
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BDT
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="margin-left:20%;">{{ $special =
                            $emp->allowance_head_ammount ?? 0}}{{__('.00')}} &nbsp; </span> <br> @endif @endforeach
                        @foreach($employee_allowances as $emp)@if($emp->allowance_head_id == 19) Internet Bill
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp; &nbsp; &nbsp;BDT &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span
                            style="margin-left:20%;"> {{ $Internet = $emp->allowance_head_ammount ?? 0}}{{__('.00')}}
                            &nbsp; </span> <br>@endif @endforeach

                        <span
                            style="background-color:white;color:black;font-weight:bold;">______________________________________________________________________________________________________________</span><br>

                        <span style="font-weight:bold;"> Total &nbsp; salary
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BDT
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{$medical_tot+$house_tot +$basic_tot
                            +$transport+$mobile+$lunch+$special+$Internet }}{{__('.00')}} &nbsp;</span>

                    </p>

                </div>
        </li>

        <br>
        <li> You will be entitled to 2 (two) annual festival bonuses, each equivalent to 1 Basic salary. </li><br>
        <li> You will be entitled to 21 days Annual leave with pay and 14 days Sick leave with pay.</li><br>
        <li> Your work week duty hours shall be notified by the client company. Duty hours shall be notified by the
            company from time to time. </li> <br>
        <li> You shall conform to all Rules and Regulations in force from time to time and shall carry out all other
            lawful orders/instructions/directions of your Superiors as are given to you in connection with day-to-day
            discharge of your duties while in the Employment of our client.</li><br>
        <li> Your contract of service shall be subject to termination with one-month notice from either side or monetary
            value. </li><br>
        </span><br><br><br><br>
        <p style="font-size: 10px;text-align:center;">1 | Page | Prediction Learning Associates Ltd., 365/9, Lane 06,
            Baridhara DOHS, Dhaka -1206, Bangladesh;<br>
            Tel: +88028413439; +8801713 -334 874; www.predictionla.com, email: info@predictionla.com</p><br><br><br>
        <img style="width:170px;" src="{{asset('idcard/pla_logo.png')}}"> <br>
        <span style="margin-left: 3%;">
        </span>
        </li><br>
        <li>Upon termination of your employment, you will return to the Company all papers and documents or other
            property which may at that time be in your possession, relating to the business or affairs of the Company or
            any of the associates or branches and you will not retain any copy or extracts thereof. </li><br>
        <li>You will also abide by our client’s Code of Conducts and policies and must conduct yourself in such a manner
            which is not prejudicial to interest of our client Non-compliance may result disciplinary action including
            dismissal.</li><br>
        <li><span>
                During this employment and thereafter, you will keep strictly secrecy regarding the business of the
                company and its client. You will not divulge to any person, firm or company, whomsoever other than to
                the Directors of the Company or their clients or their authorized representatives any information
                regarding your salary, increments and emoluments or any confidential information of any description
                concerning the business or the affairs or any of its associates or branches, their customers and
                suppliers, acquired by you while in your service.
            </span></li><br>
        <li>During your employment, you will place your full capabilities at the service of the projects that you are
            assigned to and you will carry out all the duties willingly and obediently as per the directives issued to
            you from time to time by the Management or your superior. You will be sincere, conscientious, and careful in
            carrying out your duties. You will be display good conduct and behavior inside of the Company, with all
            colleagues, customers and the public in general to place the image of the Company in high esteem.
        </li><br>
        <li><span>
                You are not allowed to perform or act below things during your employment with us:
                <div style="padding-left: 12%">
                    <p>a. To engage or accepts any other business / employment, either paid or unpaid. <br><br>
                        b. To engage in any civic, political activates or private business without the written approval
                        of the Management.<br><br>
                        c. To use property or premises of the company for other than company purposes without prior
                        consent of the management.<br><br>
            </span><br>
            </p>

            </div>
            </span></li><br>
        <li>You will keep the company informed time to time if there is any change in status of any information you have
            provided in the application.</li><br>
        <li>If it is found at any time any of the information is false or that any vital information was not disclosed,
            Prediction Learning Associates Ltd. reserves the right to terminate your employment without any notice or
            salary in lieu thereof. </li><br>
        <br><br><br>
        <p style="font-size: 10px;text-align:center;">2 | Page | Prediction Learning Associates Ltd., 365/9, Lane 06,
            Baridhara DOHS, Dhaka -1206, Bangladesh;<br>
            Tel: +88028413439; +8801713 -334 874; www.predictionla.com, email: info@predictionla.com</p><br>
        <img style="width:170px;" src="{{asset('idcard/pla_logo.png')}}"> <br>

        <li>This contract will be valid till 31st March, 2023; based on availability of the position, your contract will
            be renewed. </li>
    </ol>
    <p style="font-size:14px;">ADMINISTRATIVE REQUREMENTS</p>
    <ol style="list-style-type: english;font-size:13px;">
        <li>Please report to our client at your place of posting and submit your joining letter on or before
            @if($employee_value->joining_date <= '2022-03-28' ) {{ __(' 1st April 2022 ')}}

    @else


        <?php
if($day == ' 1'){echo $day.'st '.$month." ".$year."";}
if($day == ' 2'){echo $day.'nd '.$month." ".$year." ";}
if($day == ' 3'){echo $day.'rd '.$month." ".$year." ";}
if($day == ' 4'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 5'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 6'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 7'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 8'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 9'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 10'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 11'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 12'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 13'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 14'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 15'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 16'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 17'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 18'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 19'){echo $day.'th '.$month." ".$year." ";}
if($day == ' 20'){echo $day.'th'.$month." ".$year." ";}
if($day == '21'){echo $day.'th '.$month." ".$year." ";}
if($day == '22'){echo $day.'th '.$month." ".$year." ";}
if($day == '23'){echo $day.'th '.$month." ".$year." ";}
if($day == '24'){echo $day.'th '.$month." ".$year." ";}
if($day == '25'){echo $day.'th '.$month." ".$year." ";}
if($day == '26'){echo $day.'th '.$month." ".$year." ";}
if($day == '27'){echo $day.'th '.$month." ".$year." ";}
if($day == '28'){echo $day.'th '.$month." ".$year." ";}
if($day == '29'){echo $day.'th '.$month." ".$year." ";}
if($day == '30'){echo $day.'th '.$month." ".$year." ";}
if($day == '31'){echo $day.'th '.$month." ".$year." ";}

 ?>



   @endif
    </li><br>
          <li>You must produce release certificate or acceptance of resignation from last employer and undertaking stating no dues pending from the previous employer, if any.</li><br>
          <li>You must present your original educational certificate and experience certificates. At the time of joining copies of the same will be retained by the Prediction Learning Associates Ltd.</li><br>
      </ol>
  <p style=" font-size: 13px;">If you agree with above terms and conditions, please confirm your acceptance of this
                appointments letter by signing and returning to us the duplicate copy. Please submit your joining
                letter.<br><br>
                We have the pleasure in welcoming you in our company and sincerely hope that our close collaboration
                will be a mutually satisfactory one.
                </p>
                <div>
                    <div style="float:left;width:60%;">
                        <p style="font-size: 13px;">Yours faithfully,<br /><br>
                            <span><img style="height:30px;width:70px;" src="{{asset('idcard/signature.png')}}"></span>
                        </p>
                        <p style="padding-top:-35px;">__________________ </P>
                        <span style="font-size: 14px;">
                            <span style="font-weight:bold;">Md. Ariful Islam </span>
                            <br>
                            Managing Director
                            <br>
                            <span style="font-weight:bold;"> Prediction Learning Associates Ltd.</span><br>
                        </span>
                    </div>
                </div>
                <div>
                    <br>
                    <p style="font-size:16px;">AGREEMENT: </p>
                    <div style="padding-left:15px;font-size: 13px;">
                        <p>I have carefully read the above letter and the terms and conditions set out therein, which I
                            have fully understood, and I hereby accept the same.</p>
                        <p>Signature……………………</p>
                        <p>Date……………………………</p>
                    </div>
                </div>

                <br>
                <p style="font-size: 10px;text-align:center;">3 | Page | Prediction Learning Associates Ltd., 365/9,
                    Lane 06, Baridhara DOHS, Dhaka -1206, Bangladesh;<br>
                    Tel: +88028413439; +8801713 -334 874; www.predictionla.com, email: info@predictionla.com</p><br><br>


                </div>

                @endif


                @if($employee_value->appointment_letter == "nonmanagement-factory")

                <div> <img style="width:170px;padding-left:30px;" src="{{asset('uploads/logos/logo.png')}}">
                    <br>


                    <p style="margin-left:77%;font-size:15px;">
                        <br>
                        @if($employee_value->joining_date <= '2022-03-28' ) {{ __('তারিখঃ ১লা এপ্রিল ২০২২ ইং')}} @else
                            <?php echo 'তারিখঃ ' ; if($joinig_day=='১' ){echo $joinig_day.'লা '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ২'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ৩'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ৪'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ৫'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ৬'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ৭'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ৮'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ৯'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ১০'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ১১'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ১২'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ১৩'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ১৪'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ১৫'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ১৬'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ১৭'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ১৮'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ১৯'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ২০'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ২১'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ২২'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ২৩'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ২৪'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ২৫'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ২৬'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ২৭'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ২৮'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ২৯'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ৩০'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ৩১'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}


 ?>

    @endif




  </p>
</div>
<div class="appointment-letter" style="font-size:15px;">

  {{ $employee_value->emoloyeedetail->bangla_name ?? null}}<br>
{{ $employee_value->emoloyeedetail->permenet_address_bangla ?? null}}
 <br>
   <span style="font-weight:bold;"> বিষয়ঃ অস্থায়ী ভিত্তিতে চাকুরির নিয়োগ পত্র । </span>
  </p>

  <p> জনাব {{ $employee_value->emoloyeedetail->bangla_name ?? null}}, <br>
  অত্যন্ত আনন্দের সহিত জানানো যাচ্ছে যে, আপনার আবেদনের প্রেক্ষিতে এবং পরবর্তীতে প্রদত্ত সাক্ষাৎকারের ভিত্তিতে আপনাকে আমাদের প্রতিষ্ঠানের সহিত গ্রাহক কোম্পানির সম্পাদিত চুক্তি মোতাবেক <span style="font-weight:bold;"> “{{$employee_value->userdesignation->designation_bangla_name}}”</span> হিসেবে নিম্ন উল্লিখিত শর্ত স্বাপেক্ষে সম্পূর্ন অস্থায়ী শ্রমিক হিসাবে নিয়োগের সিদ্ধান্ত গৃহীত হয়েছে। এ নিয়োগ

    @if($employee_value->joining_date <= ' 2022-03-28') {{ __(' ১লা এপ্রিল ২০২২ ইং')}} @else <?php if($joinig_day=='১'
                            ){echo $joinig_day.'লা '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ২'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ৩'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ৪'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ৫'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ৬'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ৭'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ৮'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ৯'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ১০'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ১১'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ১২'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ১৩'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ১৪'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ১৫'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ১৬'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ১৭'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ১৮'){echo $joinig_day.'ই '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ১৯'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ২০'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ২১'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ২২'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ২৩'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ২৪'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ২৫'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ২৬'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ২৭'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ২৮'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ২৯'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ৩০'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}
if($joinig_day == ' ৩১'){echo $joinig_day.'শে '.$joinig_month." ".$joinig_year." ইং";}





 ?>

    @endif

<?php


  $lunch_allowance_amount_bn = 0;
  $lunch_allowance_amount = Bengali_DTN($lunch_allowance_amount_bn );
  $lunch_allowance = 0;

$internet_allowance_amount_bn =0;
$internet_allowance_amount= Bengali_DTN($internet_allowance_amount_bn );
$internet_allowance = 0;

$special_allowance_amount_bn =0;
$special_allowance_amount= Bengali_DTN($special_allowance_amount_bn );
$special_allowance = 0;

foreach($employee_allowances as $emp){

if($emp->allowance_head_id == 16){
$lunch_allowance_amount = Bengali_DTN($emp->allowance_head_ammount);
$lunch_allowance = $emp->allowance_head_ammount ?? 0;
}
if($emp->allowance_head_id == 12){
$special_allowance_amount =Bengali_DTN($emp->allowance_head_ammount);
$special_allowance = $emp->allowance_head_ammount ?? 0;
}

if($emp->allowance_head_id == 19){
$internet_allowance_amount =Bengali_DTN($emp->allowance_head_ammount);
$internet_allowance = $emp->allowance_head_ammount ?? 0;
}
     }




    $tot_ban = $basic_salay+$house_rent+$medical_allowence +$transport_allowance +$mobile+$lunch_allowance+$special_allowance+$internet_allowance ;
    $tot_ban_float_round = number_format((float)$tot_ban, 0, ' .', '' );
                            $total_bangla=Bengali_DTN("$tot_ban_float_round"); ?>


                            তারিখ থেকে কার্যকর করা হবে এবং প্রজেক্ট এর চুক্তির মেয়াদ ৩১ শে মার্চ ২০২৩ ইং পর্যন্ত বলবৎ
                            থাকবে, যা চুক্তি নবায়ন স্বাপেক্ষে আপনার নিয়োগ বর্ধিত করা যেতে পারে।
                            <ol style="padding-left:15px">
                                <li><span style="font-weight:bold;"> কর্মস্থলঃ প্রেডিকশন লার্নিং এসোসিয়েটস লিঃ
                                        (পি.এল.এ.)</span> এর নিয়োগপ্রাপ্ত অস্থায়ী শ্রমিক হিসাবে আপনি প্রতিষ্ঠানের
                                    সম্মানিত গ্রাহক কোম্পানির ফ্যাক্টরি অফিসে দ্বায়িত্ব প্রাপ্ত হবেন । </li>
                                <li><span style="font-weight:bold;"> পারিশ্রমিক ও সুবিধাদিঃ </span><br> <span
                                        style="margin-left: 3%; margin-right:50%">
                                        ক) <span style="font-weight:bold;font-size: 15px;"> মাসিক মোট বেতনঃ </span><br>
                                        <p style="padding-left:10%;">
                                            @if($basic_salay) মূল বেতন &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp; :
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span
                                                style="margin-left:20%;"> {{$basic_salary_float_round_bangla
                                                }}{{__('.০০')}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; টাকা </span> <br> @endif
                                            @if($house_rent) বাড়ি ভাড়া &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; :
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span
                                                style="margin-left:20%;">
                                                {{$house_salary_float_round_bangla}}{{__('.০০')}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                টাকা </span> <br> @endif
                                            @if($medical_allowence) চিকিৎসা ভাতা &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp; :
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span
                                                style="margin-left:20%;"> {{$medical_salary_float_round_bangla ??
                                                null}}{{__('.০০')}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; টাকা </span>
                                            <br>@endif
                                            @foreach($employee_allowances as $emp) @if($emp->allowance_head_id == 16)
                                            দৈনিক ভাতা&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; :
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span
                                                style="margin-left:20%;"> {{$lunch_allowance_amount ??
                                                $lunch}}{{__('.০০')}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; টাকা
                                            </span> <br> @endif @endforeach
                                            @if($transport_allowance) যাতায়াত ভাতা&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span
                                                style="margin-left:20%;"> {{ $transport ?? null}}{{__('.০০')}}
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; টাকা </span> <br> @endif
                                            @if($mobile) মোবাইল ভাতা &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp; :
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span
                                                style="margin-left:20%;"> {{$mobile_bill ?? null }}{{__('.০০')}}
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; টাকা </span> <br>
                                            @endif

                                            @foreach($employee_allowances as $emp) @if($emp->allowance_head_id == 12)
                                            বিশেষ ভাতা
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            : <span style="padding-left:40px;">
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{
                                                $special_allowance_amount?? $special}}{{__('.০০')}}
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; টাকা </span><br> @endif @endforeach
                                            @foreach($employee_allowances as $emp) @if($emp->allowance_head_id == 19)
                                            ইন্টারনেট বিল
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            : <span style="padding-left:40px;">
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{
                                                $internet_allowance_amount?? 0}}{{__('.০০')}}
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; টাকা </span><br> @endif
                                            @endforeach

                                            <span
                                                style="background-color:white;color:black;font-weight:bold;">____________________________________________________________</span><br>
                                            <span style="font-weight:bold;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                সর্বমোট
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$total_bangla.'.০০' }}
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; টাকা </span>

                                        </p>
                                        <div style="padding-left: 12%">


                                        </div>

                </div>
                <span style="margin-left: 3%;"><span style="font-size: 16px; font-weight:bold;">খ) উৎসব ভাতাঃ</span>
                    আপনি, বছরে দুটি উৎসব ভাতা প্রাপ্ত হবেন, যাহার প্রতিটি আপনার একটি মূল বেতনের সমপরিমান হবে ।
                </span>
                <br>
        </li><br>
        <li><span style="font-size: 15px; font-weight:bold;"> চাকুরির অবসানঃ</span> অত্র প্রতিষ্ঠান আপনাকে ৩০ (ত্রিশ)
            দিনের লিখিত পূ্র্ব নোটিশ প্রদান করত: বা তাৎক্ষনিক ভাবে উক্ত নোটিশ কালীন সময়ের যাবতীয় পাওনা পরিশোধ স্বাপেক্ষে
            আপনার চাকুরির অবসান ঘটাতে পারে । আপনিও চাইলে ৩০ (ত্রিশ) দিনের পূ্র্ব নোটিশ প্রদান স্বাপেক্ষে বা উক্ত নোটিশ
            কালীন সময়ের যাবতীয় পাওনা পরিশোধ স্বাপেক্ষে চাকুরি থেকে অব্যাহতি নিতে পারেন । </li><br>
        <li><span style="font-size: 15px; font-weight:bold;">চাকুরির হতে ডিসচার্জঃ </span> কোন রেজিষ্টার্ড চিকিৎসক
            কর্তৃক প্রত্যয়িত আপনার শারিরিক বা মানসিক অক্ষমতা বা অব্যাহত ভগ্ন স্বাস্থ্যের কারণে যে কোন সময়ে আপনাকে চাকুরি
            হতে ডিসচার্জ করা যেতে পারে ।</li>
        <li> <span style="font-size: 15px; font-weight:bold;">চাকুরির হতে বরখাস্তঃ </span><br>
            <span style="margin-left: 3%;">
                ক) আপনি, যদি কোন প্রকার অসদাচরণের অপরাধে দোষী সাব্যস্ত হন অথবা আপনি যদি কোন ফৌজদারী অপরাধের জন্য
                দন্ডপ্রাপ্ত হন সেক্ষেত্রে আপনাকে বিনা নোটিশে বা নোটিশের পরিবর্তে বিনা বেতনে চাকুরি হতে বরখাস্ত করা যেতে
                পারে ।
            </span><br>
            <span style="margin-left: 3%;">
                খ)আপনি, যদি রাষ্ট্রদ্রোহী অথবা জঙ্গিবাদ সংশ্লিষ্ট কাজে লিপ্ত থাকেন অথবা থাকার প্রমাণ পাওয়া যায়,
                সেক্ষেত্রে আপনাকে বিনা নোটিশে চাকুরি হতে বরখাস্ত করা যেতে পারে ।
            </span><br>
            <span style="margin-left: 3%;">
                গ) এছাড়াও আপনার পক্ষ থেকে কোনরূপ ব্যর্থতা এবং সময়মত দায়িত্ব ও কর্তব্য পালন না করলে আপনাকে চাকুরি হতে
                বরখাস্ত সহ আইনানুগ ব্যবস্থা গ্রহণ করত: বরখাস্ত করতে পারবে ।
            </span>
            <br><br><br><br>
            <p style="font-size: 10px;text-align:center;">1 | Page | Prediction Learning Associates Ltd., 365/9, Lane
                06, Baridhara DOHS, Dhaka -1206, Bangladesh;<br>
                Tel: +88028413439; +8801713 -334 874; www.predictionla.com, email: info@predictionla.com</p><br><br><br>
            <img style="width:170px;" src="{{asset('idcard/pla_logo.png')}}"> <br>

        </li>
        <li><span><span style="font-size: 15px;font-weight:bold;">ছুটিঃ </span>
                আপনার ছুটি বাংলাদেশ শ্রম আইন অনুযায়ী প্রযোজ্য হইবে ।
            </span></li>
        <li><span>
                আপনার চাকুরি বাংলাদেশের যে কোন অঞ্চলে বদলিযোগ্য ।
            </span></li>
        <li><span>
                চাকরিরত থাকা অবস্থায় আপনি অন্য কোন ব্যবসা বা পেশার মধ্যে প্রত্যক্ষ বা পরোক্ষ ভাবে জড়িত হতে পারবেন না ।
            </span></li>
        <li><span>
                আপনার অত্র নিয়োগ পত্রটি চুক্তি ভিত্তিক হিসাবে পরিগনিত হবে এবং আপনি প্রতিষ্ঠানের বা এর গ্রাহক কোম্পানির
                ব্যবসা সংক্রান্ত যে কোন গোপনীয়তা কঠোর ভাবে বজায় রাখবেন ।
            </span></li>
        <li><span>আপনার সাথে নিয়োগ থাকাকালিন অবস্থায় এমনকি চাকুরি পরিসমাপ্তির পরেও নিম্নের বিষয়গুলো আপনাকে মেনে চলতে হবে
                ।
                <p style="margin-left: 3%;">
                    ক) আমাদের গ্রাহক কোম্পানির ব্যবসায়ীক নীতিমালা ও আচরন বিধি সমুহ মেনে চলবেন ।
                </p>
                <p style="margin-left: 3%;">
                    খ) ব্যাক্তিগত ও ব্যবসায়ীক গোপনীয়তা সংরক্ষন করবেন ।
                </p>
        </li><br>
        <li><span>
                সকল বিধি ও বিধিমালা, নীতিমালা, পদ্ধতি যা আপনার নিয়োগ পত্রে উল্লেখ তা বর্তমানে কার্যকর বলে গণ্য হবে এবং
                সেগুলো প্রতিষ্ঠানের বিবেচনায় যে কোন সময় পরিবর্তিত হতে পারে । তবে এই রকম পরিবর্তন হলে আপনাকে পূর্বে অবহিত
                করা হবে ।
            </span></li>
        <li><span>
                অত্র প্রতিষ্ঠান বা গ্রাহক কেম্পানীর যে সকল সম্পদ ও পরিসম্পদ সমূহ যেগুলো কর্মরত অবস্থায় আপনার অধীনে থাকবে
                যেমন, ব্যাগ, মোবাইল সেট, মোবাইল সিম, ক্যাটালগ, ইত্যাদি অথবা অন্য কোন দলিল ও তথ্যাদি, অত্র নিয়োগের
                পরিসমাপ্তি হলে সেগুলো আপনি কর্তৃপক্ষকে ফেরত দিতে বাধ্য
                থাকিবেন ।
            </span></li>
        <li><span>
                এ নিয়োগের অন্যান্য শর্তাদি অত্র প্রতিষ্ঠানের বিধি ও প্রবিধান এবং শ্রম আইন অনুযায়ী পরিচালিত হবে ।
            </span></li>
    </ol>
    <p>আপনি যদি উপরোক্ত শর্তাবলী, প্রতিষ্ঠানের নিয়মনীতি এবং গ্রাহক কোম্পানির নিয়মনীতি মেনে চলতে আগ্রহী হন এবং
        অঙ্গীকারাবদ্ধ হন তাহলে নিম্নে নির্ধারিত স্থানে আপনার সম্মতি সূচক স্বাক্ষর প্রদান করত: অত্র নিয়োগ পত্রের
        প্রতিলিপি প্রতিষ্ঠানে ফেরত প্রদান করুন ।</p><br>
    <p>আমরা আপনাকে প্রেডিকশন লার্নিং এসোসিয়েটস লিঃ (পি.এল.এ.) পরিবারে স্বাগত জানাই এবং আপনার সার্বিক সাফল্য ও মঙ্গল
        কামনা করছি । আমরা বিশ্বাস করি যে, আমাদের পি.এল.এ পরিবারের সঙ্গে আপনার মিলিত হওয়া একটি সুখী ও পারস্পরিক
        সৌহার্দ্যের পরিচায়ক হবে ।</p>
    <div style="width:1200px;">
        <div style="float:left;width:40%;">
            <p>ধন্যবাদান্তে,<br /><br>
                <span><img style="height:30px;width:70px;" src="{{asset('idcard/signature.png')}}"></span>
            </p>
            <p style="padding-top:-35px;">__________________ </P>
            <span style="font-size: 16px;">
                মোঃ আরিফুল ইসলাম
                <br>
                ব্যবস্থাপনা পরিচালক
                <br>
                প্রেডিকশন লার্নিং এসোসিয়েটস লিঃ (পি.এল.এ.)<br>
            </span>
        </div>
        <div style="float:right;width:35%;">
            <p style="padding-bottom:20px;"> স্বীকৃতি স্বাক্ষর<br /><br>
                _____________________ <br />
                {{$employee_value->emoloyeedetail->bangla_name ?? null}} <br /> <br>
                {{ __(' জাতীয় পরিচয়/জন্ম সনদ পত্র নং :') }} <br>{{$identification_number ?? null}}
                <br>
                {{ __('মোবাইল নং :') }} {{$phone}}

            </p>
        </div>
    </div>




    <br><br><br>
    <p style="font-size: 10px;text-align:center;">2 | Page | Prediction Learning Associates Ltd., 365/9, Lane 06,
        Baridhara DOHS, Dhaka -1206, Bangladesh;<br>
        Tel: +88028413439; +8801713 -334 874; www.predictionla.com, email: info@predictionla.com</p><br><br>


    </div>
    @endif

    {{-- @endforeach --}}
    @endforeach
</body>

</html>
