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

        Date: <br><br>
        Name: <br><br>
        ID: <br><br>
        Address: <br><br>
        Subject: {{ $resignation->resignation_letter_subject ?? null}}<br><br>


        <div>{!! $resignation->resignation_letter_description ?? null !!}</div> <br><br>
        Thanks,<br><br>
        <div class="col-md-12" id="draggable13">
            <img src="{{asset($resignation->resignation_letter_signature)}}" alt="Signature"
                style="width:50px;height:20px; padding-left:30px;"><br>
            <span style="background-color:white;color:black;font-weight:bold;">__________________________</span><br>
        </div>
        <div>
            {{ $resignation->ResignationSignatory->first_name ?? null }}
            {{ $resignation->ResignationSignatory->last_name ?? null }}
            <br><br>
            {{ $resignation->ResignationSignatory->company->company_name ?? null }}<br>
        </div>

        <br>

    </div>
</body>

</html>