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

        .increment-letter {
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
    @foreach($employees as $employee)

    <?php

    $day = date('j',strtotime(date("m.d.y")));
    $month = date('F',strtotime(date("m.d.y")));
    $year = date('Y',strtotime(date("m.d.y")));

    $transfer_day = date('j',strtotime(date($employee->transfer_date)));
    $transfer_month = date('F',strtotime(date($employee->transfer_date)));
    $transfer_year = date('Y',strtotime(date($employee->transfer_date)));

    $joinig_day= Bengali_DTN("$day");
    $joinig_month= Bengali_DTN("$month");
    $joinig_year= Bengali_DTN("$year");


    $transfer_day_bn = Bengali_DTN("$transfer_day");
    $transfer_month_bn = Bengali_DTN("$transfer_month");
    $transfer_year_bn= Bengali_DTN("$transfer_year");


    $emp_id = $employee->transferuser->company_assigned_id;
    $employee_id_bn = Bengali_DTN("$emp_id");


  ?>

    @if($employee->transferuser->appointment_letter == "filed_force" || $employee->transferuser->appointment_letter ==
    "nonmanagement" || $employee->transferuser->appointment_letter == "nonmanagement-factory"
    ||$employee->transferuser->employment_type== "Temporary" )
    <div class="increment-letter" style="font-size:20px;">
        <p style="font-size:20px;">

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
        </P>
        <p style="font-size:20px;">
            {{$employee->transferuserdetails->bangla_name ?? null}}
        </P>
        <p style="font-size:20px;">
            আইডি নং {{$employee_id_bn }}
        </P>
        <br>
        <span style="font-size:20px;"> বিষয়ঃ বদলী আদেশ পত্র । </span>
        </p>

        <p style="font-size:20px;"> জনাব {{$employee->transferuserdetails->bangla_name ?? null}},<br>
            {{-- {{$employee->fromtransfertown->bangla_town_name ?? $employee->fromtransfertown->town_name}}
            {{$employee->transferterritory->bangla_territory_name ?? $employee->transferterritory->territory_name}}
            {{$employee->fromtransferterritory->bangla_territory_name ??
            $employee->fromtransferterritory->territory_name}}
            , {{$employee->transferterritory->bangla_territory_name ?? $employee->transferterritory->territory_name}
            --}}
            {{$employee->fromtransfertown->bangla_town_name ?? $employee->transfertown->town_name}}

            অঞ্চলে আমাদের গ্রাহক কোম্পানির ব্যবসার বিকাশে আপনার ক্রমাগত সহায়তার জন্য আপনাকে ধন্যবাদ।



        </p>

        <p>আপনি জেনে আনন্দিত হবেন যে, আমরা আপনাকে {{$employee->fromtransferdbhouse->bangla_db_house_name ??
            $employee->fromtransferdbhouse->db_house_name}}, {{$employee->fromtransferterritory->bangla_territory_name
            ?? $employee->fromtransferterritory->territory_name}} থেকে
            {{$employee->transferdbhouse->bangla_db_house_name ?? $employee->transferdbhouse->db_house_name}},
            {{$employee->transfertown->bangla_town_name ?? $employee->transfertown->town_name}}-তে স্থানান্তর করার
            সিদ্ধান্ত নিয়েছি, যাহা আগামী
            <?php
		if($transfer_day == '1'){echo $transfer_day_bn .'লা '.$transfer_month_bn ." ".$transfer_year_bn." তারিখ";}
		if($transfer_day == '2'){echo $transfer_day_bn .'ই '.$transfer_month_bn ." ".$transfer_year_bn." তারিখ";}
		if($transfer_day == '3'){echo $transfer_day_bn .'ই '.$transfer_month_bn ." ".$transfer_year_bn." তারিখ";}
		if($transfer_day == '4'){echo $transfer_day_bn .'ই '.$transfer_month_bn ." ".$transfer_year_bn." তারিখ";}
		if($transfer_day == '5'){echo $transfer_day_bn .'ই '.$transfer_month_bn ." ".$transfer_year_bn." তারিখ";}
		if($transfer_day == '6'){echo $transfer_day_bn .'ই '.$transfer_month_bn ." ".$transfer_year_bn." তারিখ";}
		if($transfer_day == '7'){echo $transfer_day_bn .'ই '.$transfer_month_bn ." ".$transfer_year_bn." তারিখ";}
		if($transfer_day == '8'){echo $transfer_day_bn .'ই '.$transfer_month_bn ." ".$transfer_year_bn." তারিখ";}
		if($transfer_day == '9'){echo $transfer_day_bn .'ই '.$transfer_month_bn ." ".$transfer_year_bn." তারিখ";}
		if($transfer_day == '10'){echo $transfer_day_bn .'ই '.$transfer_month_bn ." ".$transfer_year_bn." তারিখ";}
		if($transfer_day == '11'){echo $transfer_day_bn .'ই '.$transfer_month_bn ." ".$transfer_year_bn." তারিখ";}
		if($transfer_day == '12'){echo $transfer_day_bn .'ই '.$transfer_month_bn ." ".$transfer_year_bn." তারিখ";}
		if($transfer_day == '13'){echo $transfer_day_bn .'ই '.$transfer_month_bn ." ".$transfer_year_bn." তারিখ";}
		if($transfer_day == '14'){echo $transfer_day_bn .'ই '.$transfer_month_bn ." ".$transfer_year_bn." তারিখ";}
		if($transfer_day == '15'){echo $transfer_day_bn .'ই '.$transfer_month_bn ." ".$transfer_year_bn." তারিখ";}
		if($transfer_day == '16'){echo $transfer_day_bn .'ই '.$transfer_month_bn ." ".$transfer_year_bn." তারিখ";}
		if($transfer_day == '17'){echo $transfer_day_bn .'ই '.$transfer_month_bn ." ".$transfer_year_bn." তারিখ";}
		if($transfer_day == '18'){echo $transfer_day_bn .'ই '.$transfer_month_bn ." ".$transfer_year_bn." তারিখ";}
		if($transfer_day == '19'){echo $transfer_day_bn .'শে '.$transfer_month_bn ." ".$transfer_year_bn." তারিখ";}
		if($transfer_day == '20'){echo $transfer_day_bn .'শে '.$transfer_month_bn ." ".$transfer_year_bn." তারিখ";}
		if($transfer_day == '21'){echo $transfer_day_bn .'শে '.$transfer_month_bn ." ".$transfer_year_bn." তারিখ";}
		if($transfer_day == '22'){echo $transfer_day_bn .'শে '.$transfer_month_bn ." ".$transfer_year_bn." তারিখ";}
		if($transfer_day == '23'){echo $transfer_day_bn .'শে '.$transfer_month_bn ." ".$transfer_year_bn." তারিখ";}
		if($transfer_day == '24'){echo $transfer_day_bn .'শে '.$transfer_month_bn ." ".$transfer_year_bn." তারিখ";}
		if($transfer_day == '25'){echo $transfer_day_bn .'শে '.$transfer_month_bn ." ".$transfer_year_bn." তারিখ";}
		if($transfer_day == '26'){echo $transfer_day_bn .'শে '.$transfer_month_bn ." ".$transfer_year_bn." তারিখ";}
		if($transfer_day == '27'){echo $transfer_day_bn .'শে '.$transfer_month_bn ." ".$transfer_year_bn." তারিখ";}
		if($transfer_day == '28'){echo $transfer_day_bn .'শে '.$transfer_month_bn ." ".$transfer_year_bn." তারিখ";}
		if($transfer_day == '29'){echo $transfer_day_bn .'শে '.$transfer_month_bn ." ".$transfer_year_bn." তারিখ";}
		if($transfer_day == '30'){echo $transfer_day_bn .'শে '.$transfer_month_bn ." ".$transfer_year_bn." তারিখ";}
		if($transfer_day == '31'){echo $transfer_day_bn .'শে '.$transfer_month_bn ." ".$transfer_year_bn." তারিখ";}


           ?>


            হতে কার্যকর হবে। আপনার নতুন নির্ধারিত অঞ্চলে, আপনি আমাদের গ্রাহক কোম্পানির কর্মকর্তার কাছে রিপোর্ট করবেন।
            উল্লেখ্য যে আপনার বর্তমান বেতন এবং অন্যান্য সুবিধাদি অপরিবর্তিত থাকবে।
        </p>
        <p>নতুন দায়িত্ব পালনে আপনার জন্য শুভকামনা।</p>
        <br>
        <div style="width:1200px;">
            <div style="float:left;width:50%;">
                <p>ধন্যবাদান্তে,<br>
                    <span><img style="height:30px;width:70px;" src="{{asset('idcard/signature.png')}}"></span>
                </p>
                <p style="padding-top:-35px;">__________________ </P>
                <span style="font-size: 20px;">
                    মোঃ আরিফুল ইসলাম
                    <br>
                    ব্যবস্থাপনা পরিচালক
                    <br>
                    প্রেডিকশন লার্নিং এসোসিয়েটস লিঃ (পি.এল.এ.)<br>
                </span>
            </div>
        </div>
        @else



        <div class="increment-letter" style="font-size:15px;">
            <p style="font-size:15px;">
                {{ __(' Date: ')}}
                <?php
if($day == '1'){echo $day.'st '.$month." ".$year."";}
if($day == '2'){echo $day.'nd '.$month." ".$year." ";}
if($day == '3'){echo $day.'rd '.$month." ".$year." ";}
if($day == '4'){echo $day.'th '.$month." ".$year." ";}
if($day == '5'){echo $day.'th '.$month." ".$year." ";}
if($day == '6'){echo $day.'th '.$month." ".$year." ";}
if($day == '7'){echo $day.'th '.$month." ".$year." ";}
if($day == '8'){echo $day.'th '.$month." ".$year." ";}
if($day == '9'){echo $day.'th '.$month." ".$year." ";}
if($day == '10'){echo $day.'th '.$month." ".$year." ";}
if($day == '11'){echo $day.'th '.$month." ".$year." ";}
if($day == '12'){echo $day.'th '.$month." ".$year." ";}
if($day == '13'){echo $day.'th '.$month." ".$year." ";}
if($day == '14'){echo $day.'th '.$month." ".$year." ";}
if($day == '15'){echo $day.'th '.$month." ".$year." ";}
if($day == '16'){echo $day.'th '.$month." ".$year." ";}
if($day == '17'){echo $day.'th '.$month." ".$year." ";}
if($day == '18'){echo $day.'th '.$month." ".$year." ";}
if($day == '19'){echo $day.'th '.$month." ".$year." ";}
if($day == '20'){echo $day.'th'.$month." ".$year." ";}
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
            </P>
            {{--
            <p style="font-size:15px;">
                {{$employee->transferuser->first_name ?? null}} {{$employee->transferuser->last_name ?? null}}
            </P>
            <p style="font-size:15px;">
                ID NO:{{$employee->transferuser->company_assigned_id ?? null}}
            </P>
            <br>
            --}}
            <span style="font-size:15px;"> Subject: Letter of Transfer </span>
            </p>

            <p style="font-size:15px;">Dear {{$employee->transferuser->first_name ?? null}}
                {{$employee->transferuser->last_name ?? null}},<br>
                {{-- {{$employee->fromtransfertown->bangla_town_name ?? $employee->fromtransfertown->town_name}}
                {{$employee->transferterritory->bangla_territory_name ?? $employee->transferterritory->territory_name}}
                {{$employee->fromtransferterritory->bangla_territory_name ??
                $employee->fromtransferterritory->territory_name}}
                , {{$employee->transferterritory->bangla_territory_name ?? $employee->transferterritory->territory_name}
                --}}

                Thanks for your continued support to increase our client companies’ business.
                {{-- Thank you for your continued support in business development of our customer company in
                {{$employee->fromtransfertown->town_name ?? null}} region. --}}
            </p>

            You will be glad to know that we have decided to transfer you from the
            {{$employee->transferfromdepartment->department_name ?? null }} to
            {{$employee->transferdepartment->department_name ?? null }} as
            “{{$employee->transferdesignation->designation_name ?? null }}”, which is effective from
            <?php

if($transfer_day == '1'){echo $transfer_day .'st '.$transfer_month ." ".$transfer_year ."";}
if($transfer_day == '2'){echo $transfer_day .'nd '.$transfer_month ." ".$transfer_year ." ";}
if($transfer_day == '3'){echo $transfer_day .'rd '.$transfer_month ." ".$transfer_year ." ";}
if($transfer_day == '4'){echo $transfer_day .'th '.$transfer_month ." ".$transfer_year ." ";}
if($transfer_day == '5'){echo $transfer_day .'th '.$transfer_month ." ".$transfer_year ." ";}
if($transfer_day == '6'){echo $transfer_day .'th '.$transfer_month ." ".$transfer_year ." ";}
if($transfer_day == '7'){echo $transfer_day .'th '.$transfer_month ." ".$transfer_year ." ";}
if($transfer_day == '8'){echo $transfer_day .'th '.$transfer_month ." ".$transfer_year ." ";}
if($transfer_day == '9'){echo $transfer_day .'th '.$transfer_month ." ".$transfer_year ." ";}
if($transfer_day == '10'){echo $transfer_day .'th '.$transfer_month ." ".$transfer_year ." ";}
if($transfer_day == '11'){echo $transfer_day .'th '.$transfer_month ." ".$transfer_year ." ";}
if($transfer_day == '12'){echo $transfer_day .'th '.$transfer_month ." ".$transfer_year ." ";}
if($transfer_day == '13'){echo $transfer_day .'th '.$transfer_month ." ".$transfer_year ." ";}
if($transfer_day == '14'){echo $transfer_day .'th '.$transfer_month ." ".$transfer_year ." ";}
if($transfer_day == '15'){echo $transfer_day .'th '.$transfer_month ." ".$transfer_year ." ";}
if($transfer_day == '16'){echo $transfer_day .'th '.$transfer_month ." ".$transfer_year ." ";}
if($transfer_day == '17'){echo $transfer_day .'th '.$transfer_month ." ".$transfer_year ." ";}
if($transfer_day == '18'){echo $transfer_day .'th '.$transfer_month ." ".$transfer_year ." ";}
if($transfer_day == '19'){echo $transfer_day .'th '.$transfer_month ." ".$transfer_year ." ";}
if($transfer_day == '20'){echo $transfer_day .'th'.$transfer_month ." ".$transfer_year ." ";}
if($transfer_day == '21'){echo $transfer_day .'th '.$transfer_month ." ".$transfer_year ." ";}
if($transfer_day == '22'){echo $transfer_day .'th '.$transfer_month ." ".$transfer_year ." ";}
if($transfer_day == '23'){echo $transfer_day .'th '.$transfer_month ." ".$transfer_year ." ";}
if($transfer_day == '24'){echo $transfer_day .'th '.$transfer_month ." ".$transfer_year ." ";}
if($transfer_day == '25'){echo $transfer_day .'th '.$transfer_month ." ".$transfer_year ." ";}
if($transfer_day == '26'){echo $transfer_day .'th '.$transfer_month ." ".$transfer_year ." ";}
if($transfer_day == '27'){echo $transfer_day .'th '.$transfer_month ." ".$transfer_year ." ";}
if($transfer_day == '28'){echo $transfer_day .'th '.$transfer_month ." ".$transfer_year ." ";}
if($transfer_day == '29'){echo $transfer_day .'th '.$transfer_month ." ".$transfer_year ." ";}
if($transfer_day == '30'){echo $transfer_day .'th '.$transfer_month ." ".$transfer_year ." ";}
if($transfer_day == '31'){echo $transfer_day .'th '.$transfer_month ." ".$transfer_year ." ";}
 ?>

            . <br><br>

            Note: Your salary and other benefits will remain the same.

            </p>
            <p>Wish you luck for your new responsibilities.</p>
            <br>
            <div style="width:1200px;">
                <div style="float:left;width:50%;">
                    <p style="font-size: 15px;">Thanks,<br>
                        <span><img style="height:30px;width:70px;" src="{{asset('idcard/signature.png')}}"></span>
                    </p>
                    <p style="padding-top:-35px;">__________________ </P>
                    <span style="font-size: 15px;">
                        Md. Ariful Islam
                        <br>
                        Managing Director
                        <br>
                        Prediction Learning Associates Ltd.(PLA)<br>
                    </span>
                </div>
            </div>

            @endif

            @endforeach
            <br>


</body>

</html>
