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
     <div class="header-logo">
        <div>
            <img style="max-height: 70px;" src="{{  <?php foreach($company_logo as $company_logo_value){ asset( $company_logo_value);} ?>  }}" />
        </div>
    </div>
<br>
<?php
$date = date('j F, Y');

?>

    Date: {{ $date }} <br><br>
    Name:   <?php foreach($employee_name as $employee_name_value){ echo $employee_name_value;} ?><br>
    Designation:  <?php foreach($pro_desi_id as $pro_desi_value){ echo $pro_desi_value;} ?> <br>
    Department:  <?php foreach($pro_dep_id as $pro_dep_value){ echo $pro_dep_value;} ?> <br><br>
    <span style="font-weight:bold;"> Subject: <?php foreach($pro_subject as $pro_subject_value){ echo $pro_subject_value ?? null;} ?></span><br><br>

    Dear   <?php foreach($employee_name as $employee_name_value){ echo $employee_name_value;} ?>,<br><br>

     <div><?php foreach($pro_body as $pro_body_value){ echo $pro_body_value ?? null;} ?></div>

    <span> Amount of salary increased is BDT. <?php foreach($pro_incre_salary as $pro_incre_salary_value){ echo $pro_incre_salary_value ?? null;} ?> /- </span><span>

    <br>

    <span > These changes will come into effect  from <?php foreach($pro_approve_date as $pro_approve_date_value){ echo $pro_approve_date_value ?? null;} ?>
        .</span> <span><br><br>

    <div> <?php foreach($pro_extra_feature as $pro_extra_feature_value){ echo $pro_extra_feature_value ?? null;} ?> </div> <br><br>

    Yours sincerely,<br><br>

    <div class="col-md-12" id="draggable13">
            <img src="<?php foreach($pro_extra_signature as $pro_extra_signature_value){ echo (asset($pro_extra_signature_value ?? null));} ?>" alt="Signature"
                style="width:50px;height:20px; padding-left:30px;"><br>
            <span style="background-color:white;color:black;font-weight:bold;">__________________________</span><br>
        </div>
    <div>
       <?php foreach($pro_signature_first as $pro_signature_first_value){ echo $pro_signature_first_value ?? null;} ?>
       <?php foreach($pro_signature_last as $pro_signature_last_value){ echo $pro_signature_last_value ?? null;} ?>
        <br><br>
        <?php foreach($company_name as $company_name_value){ echo $company_name_value ?? null;} ?> <br>
    </div>


</div>
