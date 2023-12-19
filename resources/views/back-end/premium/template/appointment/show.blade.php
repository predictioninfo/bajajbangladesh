<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
</head>

<body id="example">
    <div>
        @foreach($appointments as $appointment)
        Date: <br><br>
        Name: <br><br>
        ID: <br><br>
        Address: <br><br>
        Subject: {{ $appointment->appointment_template_subject }}<br><br>
        <div>{!! $appointment->appointment_template_general_terms ?? null !!}</div> <br><br>
        <span style="font-weight:bold;"> Remuneration and benefits: <br></span><br> <span
            style="margin-left: 3%; margin-right:50%">

            <span style="font-size: 13px;"> Your monthly salary and other benefits are given below: </span> <br> <br>
            <div>
                <table style="width:70%">
                    <tbody>

                        <tr>
                            <th width="60px; float:right;text-align: left;">Basic Salary</th>
                            <th width="5px">:</th>
                            <th width="60px; text-align: right;"> BDT</th>
                        </tr>

                        <tr>
                            <th width="60px;float:right;text-align: left;">Medical allowance</th>
                            <th width="5px">:</th>
                            <th width="60px;text-align: right;"> BDT
                            </th>
                        </tr>

                        <tr>
                            <th width="60px;text-align: left;">House Rent</th>
                            <th width="5px">:</th>
                            <th width="60px;text-align: right;"> BDT
                            </th>
                        </tr>

                        <tr>
                            <th width="60px;text-align: left;">Mobile Allowance</th>
                            <th width="5px">:</th>
                            <th width="100px;text-align: right;">
                                BDT</th>
                        </tr>

                        <tr>
                            <th width="60px;text-align: left;">Convence Allowance</th>
                            <th width="5px">:</th>
                            <th width="60px;text-align: right;"> BDT
                            </th>
                        </tr>

                        <tr>
                            <th width="60px;text-align: left;">Festival Bounus</th>
                            <th width="5px">:</th>
                            <th width="60px;text-align: right;">
                                BDT
                            </th>
                        </tr>

                    </tbody>
                </table>
                <span
                    style="background-color:white;color:black;font-weight:bold;padding-left:5%;">______________________________________________________________________________</span><br>
                <span style="margin-left: 3%; margin-right:50%">
                    <table style="width:70%">
                        <tbody>
                            <tr>
                                <th width="43%;text-align: left;">Total</th>
                                <th width="5px">:</th>
                                <th width="60px;text-align: right;"> BDT
                                </th>
                            </tr>
                        </tbody>
                    </table>
            </div>
            <br><br>
            <div>{!! $appointment->appointment_template_description !!}</div> <br><br>
            Thanks,<br><br>
            <div class="col-md-12" id="draggable13">
                <img src="{{asset($appointment->appointment_template_signature ?? null)}}" alt="Signature"
                    style="width:50px;height:20px; padding-left:30px;"><br>
                <span style="background-color:white;color:black;font-weight:bold;">_________________</span><br>
            </div>
            <div>
                {{ $appointment->AppointmentSignatory->first_name ?? null}}
                {{ $appointment->AppointmentSignatory->last_name ?? null}}
                <br><br>
                Prediction Learning Associates Ltd.(PLA)<br>
            </div>

            <br>
            <p style="font-size:16px;">AGREEMENT: </p>
            <div style="padding-left:15px;font-size: 13px;">
                <p>I have carefully read the above letter and the terms and conditions set out therein, which I have
                    fully
                    understood, and I hereby accept the same.</p>
                <p>Signature……………………</p>
                <p>Date……………………………</p>
            </div>
            @endforeach
    </div>
</body>

</html>