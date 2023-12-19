
<?php



    if($sub_total_working_days > $total_number_of_days_of_the_month){
        $total_working_days = $total_number_of_days_of_the_month;
    }elseif ($sub_total_working_days < 1) {
        $total_working_days = 0;
    }else{
        $total_working_days = $sub_total_working_days;
    }
