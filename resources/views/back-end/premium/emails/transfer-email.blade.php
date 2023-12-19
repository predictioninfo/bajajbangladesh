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

        $day = date('j',strtotime(date("m.d.y")));
        $month = date('F',strtotime(date("m.d.y")));
        $year = date('Y',strtotime(date("m.d.y")));
        foreach($transfer_date as $date){
        $transfer_day = date('j',strtotime(date($date)));
        $transfer_month = date('F',strtotime(date($date)));
        $transfer_year = date('Y',strtotime(date($date)));
        }

    ?>
    <div class="increment-letter" style="font-size:20px;">
        <p style="font-size:20px;">
            @foreach($receiver_name as $receiver_name_value)
            {{$receiver_name_value}}
            @endforeach
        </P>
        <p style="font-size:20px;">
            ID NO: @foreach($employee_id as $employee_id)
            {{ $employee_id}}
            @endforeach
        </P>
        <br>
        <span style="font-size:20px;"> Subject:Letter of Transfer.</span>
        </p>

        <p style="font-size:20px;"> Dear @foreach($receiver_name as $receiver_name_value) {{$receiver_name_value}}
            @endforeach,<br>
            Thanks for your continued support to increase our client companies’ business.
        </p>

        <p>You will be glad to know that we have decided to transfer you from the @foreach($from_department_name as
            $from_department_name_value) {{$from_department_name_value}} @endforeach to @foreach($to_department_name as
            $to_department_name) {{$to_department_name}} @endforeach
            as “@foreach($to_designation_name as $to_designation_name) {{$to_designation_name}} @endforeach”, which is
            effective from
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
        <br>
</body>

</html>