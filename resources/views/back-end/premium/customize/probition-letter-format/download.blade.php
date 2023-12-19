<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <style>
        th,
        td {
            padding: 5px;
        }

        th {
            text-align: left;
        }
    </style>


</head>

<body id="example">
    <div>

        Date: {{ $probitions->joining_date ?? null}} <br><br>
        Name: {{ $probitions->first_name.' '.$probitions->last_name}} <br><br>
        ID: {{ $probitions->company_assigned_id ?? null}} <br><br>
        Subject: {{ $probitions->probation_letter_format_subject ?? null}}<br><br>


        <div>{!! $probitions->probation_letter_format_body ?? null !!}</div> <br><br>
        Thanks,<br><br>
        <div class="col-md-12" id="draggable13">
            <img src="{{asset($probitions->probation_letter_format_signature)}}" alt="Signature"
                style="width:50px;height:20px; padding-left:30px;"><br>
            <span style="background-color:white;color:black;font-weight:bold;">__________________________</span><br>
        </div>
        <div>
            {{ $probitions->warningLetter->WarningSignatory->first_name ?? null }}
            {{ $probitions->warningLetter->WarningSignatory->last_name ?? null }}
            <br><br>
            {{ $probitions->WarningSignatory->company->company_name ?? null }}<br>
        </div>

        <br>

        <div>{!! $probitions->probation_letter_format_extra_feature ?? null !!}</div>
    </div>
</body>

</html>
