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

            {{$employees->resignation_date ?? null}}

        </P>
        <p style="font-size:20px;">
            ID NO: {{ $employees->userInforamtion->company_assigned_id ?? null}}

        </P>
        <br>
        <span style="font-size:20px;"> Subject: Letter of resignation. </span> <br> <br> <br>
        <p>
            {!! $employees->resignation_desc ?? null !!}
        </p><br>
        <br><br>
        <div style="width:1200px;">
            <div style="float:left;width:50%;">
                <p>Sincerely,<br></p>
                <span style="font-size: 20px;">
                    {{ $employees->userInforamtion->first_name ?? null}} {{ $employees->userInforamtion->last_name ??
                    null}}
                    <br>
                </span>
            </div>
        </div>

        <br>
</body>

</html>