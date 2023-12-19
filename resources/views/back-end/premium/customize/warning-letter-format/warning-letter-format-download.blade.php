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


    @if($warning ->warning_letter_format_id)
    {{-- <div class="header-logo">
        <div>
            <img style="max-height: 40px;" src="{{ asset($warning->company->company_logo ?? null) }}" />
        </div>
    </div> --}}
    <br>
    <div>

        Date: {{ $warning->joining_date ?? null}} <br><br>
        Name: {{ $warning->first_name.' '.$warning->last_name}} <br>
        Depertment: {{ $empId->departmentdetails->department_name ?? ''}} <br><br>
        ID: {{ $warning->company_assigned_id ?? null}} <br><br>
        Address: {{ $warning->address ?? null}} <br><br>
        Subject: {{ $warning->warningLetter->warning_letter_format_subject ?? null}}<br><br>


        <div>{!! $warning->warningLetter->warning_letter_format_body ?? null !!}</div> <br><br>
        Thanks,<br><br>
        <div class="col-md-12" id="draggable13">
            <img src="{{asset($warning->warningLetter->warning_letter_format_signature ?? null)}}" alt="Signature"
                style="width:50px;height:40px; padding-left:30px;"><br>
            <span style="background-color:white;color:black;font-weight:bold;">__________________________</span><br>
        </div>
        <div>
            {{ $warning->warningLetter->WarningSignatory->first_name ?? null }}
            {{ $warning->warningLetter->WarningSignatory->last_name ?? null }}
            <br><br>
            {{ $warning->company->company_name ?? null }}<br>
        </div>

        <br>

        <div>{!! $warning->warning_letter_format_extra_feature ?? null !!}</div>
    </div>

    @else
    {{'PLZ GIVE DEMO '}}
    @endif
</body>

</html>