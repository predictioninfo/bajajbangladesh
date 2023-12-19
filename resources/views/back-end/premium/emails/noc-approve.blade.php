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

    {{-- <?php
    
    $day = date('j', strtotime(date('m.d.y')));
    $month = date('F', strtotime(date('m.d.y')));
    $year = date('Y', strtotime(date('m.d.y')));
    foreach ($termination_date as $termination_date) {
        $termination_day = date('j', strtotime(date($termination_date)));
        $termination_month = date('F', strtotime(date($termination_date)));
        $termination_year = date('Y', strtotime(date($termination_date)));
    }
    
    ?> --}}
    <div class="increment-letter" style="font-size:20px;">
        <p style="font-size:20px;">
            {{-- <?php
            if ($termination_day == '1') {
                echo $termination_day . 'st ' . $termination_month . ' ' . $termination_year . '';
            }
            if ($termination_day == '2') {
                echo $termination_day . 'nd ' . $termination_month . ' ' . $termination_year . ' ';
            }
            if ($termination_day == '3') {
                echo $termination_day . 'rd ' . $termination_month . ' ' . $termination_year . ' ';
            }
            if ($termination_day == '4') {
                echo $termination_day . 'th ' . $termination_month . ' ' . $termination_year . ' ';
            }
            if ($termination_day == '5') {
                echo $termination_day . 'th ' . $termination_month . ' ' . $termination_year . ' ';
            }
            if ($termination_day == '6') {
                echo $termination_day . 'th ' . $termination_month . ' ' . $termination_year . ' ';
            }
            if ($termination_day == '7') {
                echo $termination_day . 'th ' . $termination_month . ' ' . $termination_year . ' ';
            }
            if ($termination_day == '8') {
                echo $termination_day . 'th ' . $termination_month . ' ' . $termination_year . ' ';
            }
            if ($termination_day == '9') {
                echo $termination_day . 'th ' . $termination_month . ' ' . $termination_year . ' ';
            }
            if ($termination_day == '10') {
                echo $termination_day . 'th ' . $termination_month . ' ' . $termination_year . ' ';
            }
            if ($termination_day == '11') {
                echo $termination_day . 'th ' . $termination_month . ' ' . $termination_year . ' ';
            }
            if ($termination_day == '12') {
                echo $termination_day . 'th ' . $termination_month . ' ' . $termination_year . ' ';
            }
            if ($termination_day == '13') {
                echo $termination_day . 'th ' . $termination_month . ' ' . $termination_year . ' ';
            }
            if ($termination_day == '14') {
                echo $termination_day . 'th ' . $termination_month . ' ' . $termination_year . ' ';
            }
            if ($termination_day == '15') {
                echo $termination_day . 'th ' . $termination_month . ' ' . $termination_year . ' ';
            }
            if ($termination_day == '16') {
                echo $termination_day . 'th ' . $termination_month . ' ' . $termination_year . ' ';
            }
            if ($termination_day == '17') {
                echo $termination_day . 'th ' . $termination_month . ' ' . $termination_year . ' ';
            }
            if ($termination_day == '18') {
                echo $termination_day . 'th ' . $termination_month . ' ' . $termination_year . ' ';
            }
            if ($termination_day == '19') {
                echo $termination_day . 'th ' . $termination_month . ' ' . $termination_year . ' ';
            }
            if ($termination_day == '20') {
                echo $termination_day . 'th' . $termination_month . ' ' . $termination_year . ' ';
            }
            if ($termination_day == '21') {
                echo $termination_day . 'th ' . $termination_month . ' ' . $termination_year . ' ';
            }
            if ($termination_day == '22') {
                echo $termination_day . 'th ' . $termination_month . ' ' . $termination_year . ' ';
            }
            if ($termination_day == '23') {
                echo $termination_day . 'th ' . $termination_month . ' ' . $termination_year . ' ';
            }
            if ($termination_day == '24') {
                echo $termination_day . 'th ' . $termination_month . ' ' . $termination_year . ' ';
            }
            if ($termination_day == '25') {
                echo $termination_day . 'th ' . $termination_month . ' ' . $termination_year . ' ';
            }
            if ($termination_day == '26') {
                echo $termination_day . 'th ' . $termination_month . ' ' . $termination_year . ' ';
            }
            if ($termination_day == '27') {
                echo $termination_day . 'th ' . $termination_month . ' ' . $termination_year . ' ';
            }
            if ($termination_day == '28') {
                echo $termination_day . 'th ' . $termination_month . ' ' . $termination_year . ' ';
            }
            if ($termination_day == '29') {
                echo $termination_day . 'th ' . $termination_month . ' ' . $termination_year . ' ';
            }
            if ($termination_day == '30') {
                echo $termination_day . 'th ' . $termination_month . ' ' . $termination_year . ' ';
            }
            if ($termination_day == '31') {
                echo $termination_day . 'th ' . $termination_month . ' ' . $termination_year . ' ';
            }
            
            ?> --}}
        </P>
        <p style="font-size:20px;">
            {{$user->first_name ?? null}} {{$user->last_name ?? null}}
        </P>
        <p style="font-size:20px;">
            ID NO: @foreach ($employee_id as $employee_id) {{$employee_id}} @endforeach
        </P>
        <br>
        <span style="font-size:20px;"> Subject: Letter of Non Objection Certificate Approve. </span> <br> <br> <br>
        </p>
        <?php
        
        ?>
        This letter confirms our discussion today informing you that your employment with [{{
        Auth::user()->company->company_name ?? null }}] is terminated effective immediately due to
        You can contact administrator regarding your retirement plan distribution options. <br>
        [{{ Auth::user()->company->company_name ?? null }}] property must be returned to human resources
        immediately: [Type of property (cellphone, laptop, keys, etc.)]
        </p><br>
        <p>Should you have further questions, please contact your supervisors.</p>
        <br><br>
        <div style="width:1200px;">
            <div style="float:left;width:50%;">
                <p>Sincerely,,<br>
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
