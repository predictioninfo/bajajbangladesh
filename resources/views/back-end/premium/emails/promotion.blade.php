<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
    html, body, div {
      font-family: nikosh;
    }
.increment-letter{
   padding-left:30px;
   padding-right:30px;
   font-size:18px;
   text-align:justify;
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

<div class="increment-letter" style="font-size:15px;">
<p style="font-size:16px;">
   Date: <?php foreach($promotion_date as $date_value){ echo $date_value;} ?>

<br>
<span style="font-size:16px;"><?php foreach($employee_name as $employee_name_value){ echo $employee_name_value;} ?></span><br>
<span style="font-size:16px;"> <?php foreach($promotion_old_designation as $old_designation_value){ echo $old_designation_value;} ?></span><br>
<span style="font-size:16px;"> <b>Subject: Job Promotion Letter</b>  </span>

  <p style="font-size:16px;"> Dear <?php foreach($employee_name as $employee_name_value){ echo $employee_name_value;} ?>,</p>
<p>Congratulations! Due to your continued efforts and recent successes, effective <?php foreach($promotion_date as $date_value){ echo $date_value;} ?>, you have been promoted to <?php foreach($promotion_new_designation as $designation_value){ echo $designation_value;} ?> in <?php foreach($promotion_new_department as $promotion_value){ echo $promotion_value;} ?> Department.</p>

  <p> The annual salary for the <?php foreach($promotion_new_designation as $designation_value){ echo $designation_value;} ?>  will be <?php foreach($promotion_new_gross_salary as $salary_value){ echo $salary_value;} ?>, which will be paid out on a Monthly basis.</p>
  <p>As you settle into your new role as <?php foreach($promotion_new_designation as $designation_value){ echo $designation_value;} ?> within the <?php foreach($promotion_new_department as $promotion_value){ echo $promotion_value;} ?> Department please refer any questions to your new supervisor. He/She can be reached via email  or by phone .</p>

  <p>Enjoy this time of transition, and once again, congratulations on your new role here at <?php foreach($company_name as $company_name_value){ echo $company_name_value;} ?>.</p>
  <br>
<div style="width:1200px;">
  <div style="float:left;width:60%;">
  <p>Sincerely,<br/><br>
  <span><img style="height:30px;width:70px;" src="{{asset('idcard/signature.png')}}"></span>
</p>
<p style="padding-top:-35px;">__________________ </P>
<span style="font-size: 16px;">
Md. Ariful Islam
<br>
Chief Advisor
<br>
<?php foreach($company_name as $company_name_value){ echo $company_name_value;} ?>
</span>
</div>

</div>
<br><br><br>


</body>
</html>
