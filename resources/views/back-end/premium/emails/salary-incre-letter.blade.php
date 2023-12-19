<style>
    th,
    td {
        padding: 5px;
    }

    th {
        text-align: left;
    }
</style>


<div>

<?php
$date = date('j F, Y');

?>

    Date: {{ $date }} <br><br>
    Name:   <?php foreach($employee_name as $employee_name_value){ echo $employee_name_value;} ?><br>
    Designation:  <?php foreach($incre_desi_id as $incre_desi_value){ echo $incre_desi_value;} ?> <br>
    Department:  <?php foreach($incre_dep_id as $incre_dep_value){ echo $incre_dep_value;} ?> <br><br>
    <span style="font-weight:bold;"> Subject: <b>Yearly Salary Increment</b></span><br><br>

    Dear   <?php foreach($employee_name as $employee_name_value){ echo $employee_name_value;} ?>,<br><br>

    <p>We would like to congratulate you on completion of the year of 2022 with us. We are pleased to inform you that your salary has been increased by management.
         The amount of your salary increased is BDT. <?php foreach($incre_incre_salary as $incre_incre_salary_value){ echo $incre_incre_salary_value;} ?>.
          Now your monthly gross  salary with the following particulars:</p>

    <span > These changes will come into effect  from <?php foreach($incre_incre_date as $incre_incre_date_value){ echo $incre_incre_date_value;} ?>
         .</span> <span><br><br>

    <span>All terms mentioned in appointment letter will remain unchanged, continue to be applicable to your permanent status.</span> <br><br>
    <span>We wish you a successful career in our organization.</span> <br><br>


    <div style="width:1200px;">
        <div style="float:left;width:50%;">
            <p>Yours Sincerely,<br>
                <span><img style="height:30px;width:70px;" src="{{asset('uploads/signature/signature.png')}}"></span>
            </p>
            <p style="padding-top:-35px;">__________________ </P>
            <span >
                Md. Ariful Islam
                <br>
                Managing Director
                <br>
                Prediction Learning Associates Ltd.(PLA)<br>
            </span>
        </div>
    </div>


</div>
