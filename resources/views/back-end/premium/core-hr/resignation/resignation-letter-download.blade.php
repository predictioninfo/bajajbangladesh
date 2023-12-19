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

        <p style="font-size:15px;">
            Date:

            {{$employee->resignation_date ?? null}}

        </P>

        <p style="font-size:20px;padding-left:30%;"> TO WHOM IT MAY CONCERN <br><span
                style="background-color:white;color:black;font-weight:bold;padding-top:-5%;">___________________________________________</span>
        </p> <br>

        <p>
            Dear {{ $employee->userInforamtion->first_name.' '.$employee->userInforamtion->last_name}},<br><br> I
            formally acknowledge receipt of your resignation
            letter on {{ $employee->resignation_notice_date}}. Your resignation from the
            position of {{ $employee->userInforamtion->userdesignation->designation_name}} has been accepted and will be
            effective {{
            $employee->resignation_date}}. <br>
            {!! $employee->resignation_desc ?? null !!}
        </p><br>

        <div style="width:1200px;">
            <div style="float:left;width:50%;">
                <p>With Regards,<br></p>
                <div class="col-md-12" id="draggable13">
                    <img src="{{asset($employee->resignationAcceptance->resignation_letter_signature ?? null)}}"
                        alt="Signature" style="width:50px;height:20px; padding-left:30px;"><br>
                    <span
                        style="background-color:white;color:black;font-weight:bold;">__________________________</span><br>
                </div>
                <span style="font-size: 20px;">
                    {{ $employee->resignationAcceptance->ResignationSignatory->first_name ?? null}} {{
                    $employee->resignationAcceptance->ResignationSignatory->last_name ?? null}}
                    <br>
                </span>
                <span>{{ $employee->resignationAcceptance->ResignationSignatory->userdesignation->designation_name ??
                    null}}</span><br>

                <span>{{ $employee->resignationAcceptance->ResignationSignatory->company->company_name ?? null}}</span>

            </div>
        </div>

        <br>
</body>

</html>