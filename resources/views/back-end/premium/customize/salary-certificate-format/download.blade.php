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
        <p style="padding-left: 30%;font-weight:bold;font-size:20px;">Salary Certificate</p>
        Date: <br><br>
        <div class="col-md-12">
            <div class="form-group">
                <p>This is to certify that mr. /miss/mrs {{ $SalaryCertificate->first_name ?? null}} {{
                    $SalaryCertificate->first_name ?? "................"}}.employee Id {{
                    $SalaryCertificate->company_assigned_id ??
                    "................"}}
                    is working with our company
                    under the title of .............. since {{ $SalaryCertificate->joining_date ??
                    "................"}}.we found this gentleman
                    fully committed to his/her job and
                    totally sincere
                    toward this organization company.</p>
            </div>
        </div>


        <div>{!! $SalaryCertificate->salary_cirti_body ?? null !!}</div> <br><br>
        Thanks,<br><br>
        <div class="col-md-12" id="draggable13">
            <img src="{{asset($SalaryCertificate->salary_cirti_signature)}}" alt="Signature"
                style="width:50px;height:20px; padding-left:30px;"><br>
            <span style="background-color:white;color:black;font-weight:bold;">__________________________</span><br>
        </div>
        <div>
            {{ $SalaryCertificate->salaryCertificateSignatory->first_name ?? null }}
            {{ $SalaryCertificate->salaryCertificateSignatory->last_name ?? null }}
            <br><br>
            {{ $SalaryCertificate->salaryCertificateCompany->company_name ?? null }}<br>
        </div>

        <br>

    </div>
</body>

</html>