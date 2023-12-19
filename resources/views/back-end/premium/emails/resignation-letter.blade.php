<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Letter</title>
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
            Date:
            @foreach($resignation_date as $resignation_date)
            {{ $resignation_date }}
            @endforeach
        </P>
        <p style="font-size:20px;">
            ID NO: @foreach($employee_id as $employee_id)
            {{ $employee_id }}
            @endforeach
        </P>
        <br>
        <span style="font-size:20px;"> Subject: Letter of resignation. </span> <br> <br> <br>
        <p>

            @foreach($resignation_desc as $resignation_desc)
            {{strip_tags( $resignation_desc) }}
            @endforeach

        </p><br>
        <br><br>
        <div style="width:1200px;">
            <div style="float:left;width:50%;">
                <p>Sincerely,<br></p>
                <span style="font-size: 20px;">
                    @foreach($sender_name as $sender_name)
                    {{ $sender_name }}
                    @endforeach
                    <br>
                </span>
            </div>
        </div>

        <br>
</body>

</html>
