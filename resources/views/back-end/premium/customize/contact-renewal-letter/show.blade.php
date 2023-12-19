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
        Subject: {{ $contact_renewal->contact_renewal_letter_template_subject ?? null}}<br><br>


        <div>{!! $contact_renewal->contact_renewal_letter_template_description ?? null !!}</div> <br><br>
        Thanks,<br><br>
        <div class="col-md-12" id="draggable13">
            <img src="{{asset($contact_renewal->contact_renewal_letter_template_signature)}}" alt="Signature"
                style="width:50px;height:20px; padding-left:30px;"><br>
            <span style="background-color:white;color:black;font-weight:bold;">__________________________</span><br>
        </div>
        <div>
            {{ $contact_renewal->ContactRenewalLetter->first_name ?? null }}
            {{ $contact_renewal->ContactRenewalLetter->last_name ?? null }}
            <br><br>
            {{ $contact_renewal->ContactRenewalLetter->company->company_name ?? null }}<br>
        </div>

        <br>

    </div>
</body>

</html>