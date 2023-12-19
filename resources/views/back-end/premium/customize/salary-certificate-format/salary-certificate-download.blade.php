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
        Date: {{ date("Y-m-d") }}<br><br>
        <div class="col-md-12">
            <div class="form-group">
                <p>This is to certify that @if($employee->gender == "Male") Mr. @else Miss/Mrs @endif {{
                    $employee->first_name ?? null}} {{
                    $employee->last_name ?? "................"}}.Employee Id {{
                    $employee->company_assigned_id ??
                    "................"}}
                    is working with our company
                    under the title of {{ $employee->userdesignation->designation_name ??
                    "................"}} since {{ $employee->joining_date ??
                    "................"}}.we found this gentleman
                    fully committed to @if($employee->gender == "Male") his @else her @endif job and
                    totally sincere
                    toward this organization company.</p>
            </div>
        </div>


        <div>{!! $employee->salaryCertificate->salary_cirti_body ?? null !!}</div> <br><br>
        Regards,<br><br>
        <div class="col-md-12" id="draggable13">
            <img src="{{asset($employee->salaryCertificate->salary_cirti_signature)}}" alt="Signature"
                style="width:50px;height:20px; padding-left:30px;"><br>
            <span style="background-color:white;color:black;font-weight:bold;">__________________________</span><br>
        </div>
        <div>
            {{ $employee->salaryCertificate->salaryCertificateSignatory->first_name ?? null }}
            {{ $employee->salaryCertificate->salaryCertificateSignatory->last_name ?? null }}
            <br><br>
            {{ $employee->Company->company_name ?? null }}<br>
        </div>

        <br>

    </div>
</body>

</html>