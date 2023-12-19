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
            font-size: 20px;
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
use App\Models\SalaryIncrement;
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

    $employee_details = EmployeeDetail::where('empdetails_employee_id',$employee_value->id)->get();
    $employee_allowances = AllowanceHeadAmount::where('allowance_head_allocation_emp_id',$employee_value->id)->get();
    $employee_salary_increment= SalaryIncrement::where('salary_incre_emp_id',$employee_value->id)->get();

    ?>
    @foreach ($employee_salary_increment as $employee_details_extra_details)

    <?php

    $day = date('j',strtotime(date("m.d.y")));
    $month = date('F',strtotime(date("m.d.y")));
    $year = date('Y',strtotime(date("m.d.y")));
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
   $total= Bengali_DTN("$total_bill");
   $variable_pay= Bengali_DTN("8500.00");
   $ta_da= Bengali_DTN("120");
   $joinig=$employee_value->joining_date;
   $joinig_date= Bengali_DTN("$joinig");

    $joinig_day= Bengali_DTN("$day");
    $joinig_month= Bengali_DTN("$month");
    $joinig_year= Bengali_DTN("$year");

   $transport_allowance =  $employee_value->transport_allowance ?? null;
   $transport = Bengali_DTN("$transport_allowance");
   $basic_salay = ($gross_salary*$employee_value->salaryconfig->salary_config_basic_salary  )/100;
   $house_rent = ($gross_salary*$employee_value->salaryconfig->salary_config_house_rent_allowance)/100;
   $medical_allowence = ($gross_salary*$employee_value->salaryconfig->salary_config_medical_allowance)/100;

   $basic_salay_bn = Bengali_DTN("$basic_salay");
   $house_rent_bn = Bengali_DTN("$house_rent");
   $medical_allowence_bn = Bengali_DTN("$medical_allowence");

   $total_salary = $basic_salay+$house_rent+$medical_allowence+$mobile+$transport_allowance;

   $total_salary_bn = Bengali_DTN("$total_salary");
   $lunch = 0;
   $lunch_bangla = Bengali_DTN("$lunch");

    $special= 0;
    $special_bangla = Bengali_DTN("$special");

     $basic_salary_float_round = number_format((float)$basic_salay , 0, '.', '');
     $house_float_round = number_format((float)$house_rent , 0, '.', '');
     $medical_float_round = number_format((float)$medical_allowence , 0, '.', '');
     $basic_salary_float_round_bangla = Bengali_DTN("$basic_salary_float_round");
     $house_salary_float_round_bangla = Bengali_DTN("$house_float_round");
     $medical_salary_float_round_bangla = Bengali_DTN("$medical_float_round");


// $appointment_day = date('j',strtotime($employee_value->emoloyeedetail->appointment_date));
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


// echo $employee_value->id;
// exit;

    $emp_id = $employee_value->company_assigned_id;
    $employee_id_bn= Bengali_DTN("$emp_id");

    foreach($salary_increments as $salary_increments_value){

            if($employee_value->id == $salary_increments_value->salary_incre_emp_id){

                $increment_new_salary =$salary_increments_value->salary_incre_new_salary ?? null ;
                $increment_old_salary =$salary_increments_value->salary_incre_old_salary ?? null;

            }
            // else{
            //     $increment_new_salary =0;
            //     $increment_old_salary =0;
            // }
    }

    $increment_new_mobile =$employee_value->mobile_bill ?? null ;
    $increment_old_mobile =$employee_value->mobile_bill ?? null;

    $increment_new_salary_bn = Bengali_DTN("$increment_new_salary");
    $increment_old_salary_bn = Bengali_DTN("$increment_old_salary");

    $total_new_salary = $increment_new_salary+$increment_old_mobile;
    $total_old_salary = $increment_old_salary+$increment_old_mobile;
    $increment_new_mobile_bn = Bengali_DTN("$increment_new_mobile");
    $increment_old_mobile_bn = Bengali_DTN("$increment_old_mobile");

    $total_increment_new_salary_bn = Bengali_DTN("$total_new_salary");
    $total_old_salary_bn = Bengali_DTN("$total_old_salary");

  ?>

    <div> <img style="width:170px;padding-left:30px;" src="{{asset('uploads/logos/logo.png')}}">
        <br>
    </div>
    <div class="appointment-letter" style="font-size:20px;">
        <p style="font-size:20px;">
            <br>

            <?php
echo 'তারিখঃ ';
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

        </p>

        {{ $employee_value->emoloyeedetail->bangla_name ?? null}}<br>
        {{'আইডি নং : '. $employee_id_bn}}
        <br>
        <span style="font-weight:bold;">বিষয়ঃ বাৎসরিক বেতন বৃদ্ধি প্রসঙ্গে। </span>
        </p>

        <p> জনাব {{ $employee_value->emoloyeedetail->bangla_name ?? null}}, <br> আমাদের গ্রাহক কোম্পানির ব্যবসার বিকাশে
            আপনার ক্রমাগত সহায়তার জন্য আপনাকে ধন্যবাদ। <br>
            আমরা আনন্দের সাথে জানাচ্ছি যে, আপনার কাজের সার্বিক দিক বিবেচনা করে আপনার বর্তমান মাসিক বেতন বৃদ্ধি করার
            সিদ্ধান্ত নেয়া হয়েছে যা ১লা জুলাই ২০২২ হতে কার্যকর হবে।
        </p>

        <table class="table" style="padding-left:12%; width:90%;">
            <thead>
                <tr style="border: 1px solid black; ">
                    <th style="border: 1px solid black;font-size: 20px;" colspan="4"></th>
                    <th style="border: 1px solid black;font-size: 20px;" colspan="4"> বর্তমান বেতন </th>
                    <th style="border: 1px solid black;font-size: 20px;" colspan="4">বর্ধিত বেতন
                        (জুলাই ২০২২ থেকে কার্যকর)
                    </th>
                </tr>
            </thead>
            <tbody>

                <tr style="border: 1px solid black; border-collapse: collapse;">
                    <td style="border: 1px solid black;font-size: 20px; " colspan="4">মাসিক স্থায়ী বেতন</td>
                    <td style="border: 1px solid black; text-align:right; font-size: 20px;" colspan="4">{{
                        $increment_old_salary_bn}}.০০</td>
                    <td style="border: 1px solid black; text-align:center;font-size: 20px;" colspan="4">{{
                        $increment_new_salary_bn}}.০০</td>

                </tr>
                <tr style="border: 1px solid black; border-collapse: collapse;">
                    <td style="border: 1px solid black;font-size: 20px;" colspan="4">মোবাইল ভাতা</td>
                    <td style="border: 1px solid black;text-align:right;font-size: 20px; " colspan="4">
                        {{$increment_old_mobile_bn}}.০০</td>
                    <td style="border: 1px solid black; text-align:center;font-size: 20px;" colspan="4">{{
                        $increment_old_mobile_bn}}.০০</td>

                </tr>

                <tr style="border: 1px solid black; border-collapse: collapse;">
                    <td style="border: 1px solid black; font-size: 20px;" colspan="4">মাসিক বেতন</td>
                    <td style="border: 1px solid black; text-align:right;font-size: 20px;" colspan="4">
                        {{$total_old_salary_bn}}.০০</td>
                    <td style="border: 1px solid black; text-align:center;font-size: 20px;" colspan="4">{{
                        $total_increment_new_salary_bn}}.০০</td>
                </tr>

            </tbody>
        </table>


        <p>উল্লেখ্য যে আপনার বর্তমান পরিবর্তনশীল বেতন এবং অন্যান্য সুবিধাদি চুক্তিপত্র অনুযায়ী অপরিবর্তিত থাকবে। </p>
        <p>আমরা আশা করছি যে আপনি সততা, আন্তরিকতা এবং নিষ্ঠার সাথে আপনার দায়িত্ব পালন অব্যাহত রাখবেন।</p>

        <div style="width:1200px;">
            <div style="float:left;width:40%;">
                <p>ধন্যবাদান্তে,<br /><br>
                    <span><img style="height:30px;width:70px;" src="{{asset('idcard/signature.png')}}"></span>
                </p>
                <p style="padding-top:-35px;">__________________ </P>
                <span style="font-size: 20px;">
                    মোঃ আরিফুল ইসলাম
                    <br>
                    ব্যবস্থাপনা পরিচালক
                    <br>
                    <span style="font-size: 15px;">
                        প্রেডিকশন লার্নিং এসোসিয়েটস লিঃ(পি.এল.এ.)<br>
                    </span>
                </span>
            </div>
            <div style="float:right;width:35%;">
                <p style="padding-bottom:20px;"> স্বীকৃতি স্বাক্ষর<br /><br>
                    _____________________ <br />
                    {{ $employee_value->emoloyeedetail->bangla_name ?? null}}<br>
                    <br>
                    {{ __('তারিখঃ ') }}

                </p>
            </div>
        </div>

        <br><br>
        <p style="font-size: 10px;text-align:center;"> Prediction Learning Associates Ltd., 365/9, Lane 06, Baridhara
            DOHS, Dhaka -1206, Bangladesh;<br>
            Tel: +88028413439; +8801713 -334 874; www.predictionla.com, email: info@predictionla.com</p><br>


    </div>
    <br>
    @endforeach
    @endforeach
</body>

</html>
