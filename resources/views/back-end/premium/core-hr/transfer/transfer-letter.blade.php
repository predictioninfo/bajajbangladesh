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

        $transfer_day_bn = Bengali_DTN("$transfer_day ");
        $transfer_month_bn = Bengali_DTN("$transfer_month ");
        $transfer_year_bn= Bengali_DTN("$transfer_year ");
        $emp_id = $employee->company_assigned_id;
        $employee_id_bn = Bengali_DTN("$emp_id");
    ?>
    <div class="increment-letter" style="font-size:20px;">
        <p style="font-size:20px;">
            {{$employee->first_name ?? null}} {{$employee->last_name ?? null}}
        </P>
        <p style="font-size:20px;">
            ID NO: {{ $employee->userTransfer->company_assigned_id }}
        </P>
        <br>
        <span style="font-size:20px;"> Subject:Letter of Transfer.</span>
        </p>

        <p style="font-size:20px;"> Dear {{$employee->first_name ?? null}} {{$employee->last_name ?? null}},<br>
            Thanks for your continued support to increase our client companies’ business.
        </p>

        <p>You will be glad to know that we have decided to transfer you from the {{
            $employee->fromDepartmetUser->department_name }} to
            {{ $employee->toDepartmetUser->department_name }} as “{{ $employee->toUserDesignation->designation_name}}”,
            which is effective from
            <?php

            if($transfer_day == '1'){echo $transfer_day.'st '.$transfer_month." ".$transfer_year."";}
                if($transfer_day == '2'){echo $transfer_day.'nd '.$transfer_month." ".$transfer_year." ";}
                if($transfer_day == '3'){echo $transfer_day.'rd '.$transfer_month." ".$transfer_year." ";}
                if($transfer_day == '4'){echo $transfer_day.'th '.$transfer_month." ".$transfer_year." ";}
                if($transfer_day == '5'){echo $transfer_day.'th '.$transfer_month." ".$transfer_year." ";}
                if($transfer_day == '6'){echo $transfer_day.'th '.$transfer_month." ".$transfer_year." ";}
                if($transfer_day == '7'){echo $transfer_day.'th '.$transfer_month." ".$transfer_year." ";}
                if($transfer_day == '8'){echo $transfer_day.'th '.$transfer_month." ".$transfer_year." ";}
                if($transfer_day == '9'){echo $transfer_day.'th '.$transfer_month." ".$transfer_year." ";}
                if($transfer_day == '10'){echo $transfer_day.'th '.$transfer_month." ".$transfer_year." ";}
                if($transfer_day == '11'){echo $transfer_day.'th '.$transfer_month." ".$transfer_year." ";}
                if($transfer_day == '12'){echo $transfer_day.'th '.$transfer_month." ".$transfer_year." ";}
                if($transfer_day == '13'){echo $transfer_day.'th '.$transfer_month." ".$transfer_year." ";}
                if($transfer_day == '14'){echo $transfer_day.'th '.$transfer_month." ".$transfer_year." ";}
                if($transfer_day == '15'){echo $transfer_day.'th '.$transfer_month." ".$transfer_year." ";}
                if($transfer_day == '16'){echo $transfer_day.'th '.$transfer_month." ".$transfer_year." ";}
                if($transfer_day == '17'){echo $transfer_day.'th '.$transfer_month." ".$transfer_year." ";}
                if($transfer_day == '18'){echo $transfer_day.'th '.$transfer_month." ".$transfer_year." ";}
                if($transfer_day == '19'){echo $transfer_day.'th '.$transfer_month." ".$transfer_year." ";}
                if($transfer_day == '20'){echo $transfer_day.'th'.$transfer_month." ".$transfer_year." ";}
                if($transfer_day == '21'){echo $transfer_day.'th '.$transfer_month." ".$transfer_year." ";}
                if($transfer_day == '22'){echo $transfer_day.'th '.$transfer_month." ".$transfer_year." ";}
                if($transfer_day == '23'){echo $transfer_day.'th '.$transfer_month." ".$transfer_year." ";}
                if($transfer_day == '24'){echo $transfer_day.'th '.$transfer_month." ".$transfer_year." ";}
                if($transfer_day == '25'){echo $transfer_day.'th '.$transfer_month." ".$transfer_year." ";}
                if($transfer_day == '26'){echo $transfer_day.'th '.$transfer_month." ".$transfer_year." ";}
                if($transfer_day == '27'){echo $transfer_day.'th '.$transfer_month." ".$transfer_year." ";}
                if($transfer_day == '28'){echo $transfer_day.'th '.$transfer_month." ".$transfer_year." ";}
                if($transfer_day == '29'){echo $transfer_day.'th '.$transfer_month." ".$transfer_year." ";}
                if($transfer_day == '30'){echo $transfer_day.'th '.$transfer_month." ".$transfer_year." ";}
                if($transfer_day == '31'){echo $transfer_day.'th '.$transfer_month." ".$transfer_year." ";}
           ?>.
        </p><br>
        <p>Note: Your salary and other benefits will remain the same.</p>
        <p>Wish you luck for your new responsibilities.</p>
        <br><br>
        <div style="width:1200px;">
            <div style="float:left;width:50%;">
                <p>Thanks,<br>
                    <span><img style="height:30px;width:70px;" src="{{asset('idcard/signature.png')}}"></span>
                </p>
                <p style="padding-top:-35px;">__________________ </P>
                <span style="font-size: 20px;">
                    Md. Ariful Islam
                    <br>
                    Managing Director
                    <br>
                    Prediction Learning Associates Ltd.(PLA)<br>
                </span>
            </div>
        </div>
        @endforeach
        <br>


</body>

</html>