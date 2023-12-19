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
        Date :{{ $contact_renewal->contact_renewal_letter_renewal_date ??
        null}} <br><br>
        Name :{{ $contact_renewal->employeeContactRenewal->first_name ?? null}} {{
        $contact_renewal->employeeContactRenewal->last_name ?? null}}<br><br>
        ID :{{ $contact_renewal->employeeContactRenewal->company_assigned_id ?? null}}<br><br>
        @if($contact_renewal->employeeContactRenewal->address)
        Address :{{ $contact_renewal->employeeContactRenewal->address ?? null}} <br><br>
        @endif
        Subject : {{ $contact_renewal->employeeContactRenewalLetter->contact_renewal_letter_template_subject ??
        null}}<br><br>

        <div>{!! $contact_renewal->employeeContactRenewalLetter->contact_renewal_letter_template_description ?? null !!}
        </div> <br><br>
        Thanks,<br><br>
        <div class="col-md-12">
            <img src="{{asset($contact_renewal->employeeContactRenewalLetter->contact_renewal_letter_template_signature ?? null)}}"
                alt="Signature" style="width:50px;height:20px; padding-left:30px;"><br>
            <span style="background-color:white;color:black;font-weight:bold;">__________________________</span><br>
        </div>
        <div>
            {{ $contact_renewal->employeeContactRenewalLetter->ContactRenewalLetter->first_name ?? null }}
            {{ $contact_renewal->employeeContactRenewalLetter->ContactRenewalLetter->last_name ?? null }}
            <br><br>
            {{ $contact_renewal->employeeContactRenewalLetter->ContactRenewalLetter->company->company_name ?? null
            }}<br>
        </div>

        <br>

    </div>
</body>

</html>