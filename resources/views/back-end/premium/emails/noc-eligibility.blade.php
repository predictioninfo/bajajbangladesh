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


    <div class="increment-letter" style="font-size:20px;">
        <p style="font-size:20px;">
        </P>
        <p style="font-size:20px;">
            {{$user->first_name ?? null}} {{$user->last_name ?? null}}
        </P>
        <p style="font-size:20px;">
            ID NO: @foreach ($employee_id as $employee_id) {{$employee_id}} @endforeach
        </P>
        <br>
        <span style="font-size:20px;"> Subject: Letter of Non Objection Certificate Request Eligibility. </span> <br> <br> <br>
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
