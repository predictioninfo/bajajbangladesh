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

        .word-wrap {
            text-align: justify;
            text-justify: inter-word;

        }
    </style>


</head>
<?php //dd($employees);
?>

<body id="example">
    <div>
        @foreach ($employees as $appointment)
            <br> <br>

            Date: {{ date('F j, Y') }} <br> <br>
            Name: {{ $appointment->first_name . ' ' . $appointment->last_name }} <br> <br>
            Email: {{ $appointment->email ?? null }} <br> <br>
            @if ($appointment->gender == 'Male')
                {{ 'Son of:' }}
            @else
                {{ 'Daughter of:' }}
            @endif{{ $appointment->emoloyeedetail->father_name ?? null }} &
            {{ $appointment->emoloyeedetail->mother_name }}<br> <br>
            NID: {{ $appointment->emoloyeedetail->identification_number ?? null }} <br> <br>
            Current Address: Vill: {{ $appointment->emoloyeedetail->present_village ?? null }}, PO:
            {{ $appointment->emoloyeedetail->present_postal_area ?? null }} -
            {{ $appointment->emoloyeedetail->present_postal_code ?? null }}, PS:
            {{ $appointment->emoloyeedetail->presentEmploeeUpazila->up_name ?? null }}, Dist:
            {{ $appointment->emoloyeedetail->presentEmploeeDistrict->dist_name ?? null }} <br> <br>
            Permanent Address: Vill: {{ $appointment->emoloyeedetail->village_en ?? null }}, PO:
            {{ $appointment->emoloyeedetail->postal_area_en ?? null }} -
            {{ $appointment->emoloyeedetail->postal_code ?? null }}, PS:
            {{ $appointment->emoloyeedetail->emploeeUpazila->up_name ?? null }}, Dist:
            {{ $appointment->emoloyeedetail->emploeeDistrict->dist_name ?? null }} <br> <br>
            Subject: {{ $appointment->appointmentLetter->appointment_template_subject ?? null }}<br> <br>
            Dear @if ($appointment->gender == 'Male')
                {{ 'Mr.' }}
            @else
                {{ 'Ms.' }}
            @endif {{ $appointment->first_name . ' ' . $appointment->last_name ?? null }} <br>
            <br>
            {{-- I am pleased to offer you the following position with our organization. <br> --}}
            Depertment: “{{ $appointment->userdepartment->department_name ?? null }}” <br> <br>
            Job Title: “{{ $appointment->userdesignation->designation_name ?? null }}” <br> <br>
            Job Location: {{ $appointment->userarea->area_name ?? null }} <br> <br>
            Date of Commencement: {{ $appointment->joining_date ?? null }} <br> <br>
            <div class="word-wrap">{!! $appointment->appointmentLetter->appointment_template_general_terms ?? null !!}</div> <br> <br>
            <span style="font-weight:bold;"> Remuneration and benefits: <br></span><br> <span
                style="margin-left: 3%; margin-right:50%">
                <span style="font-size: 13px;"> Your monthly salary and other benefits are given below: </span> <br>
                <div>
                    @if ($appointment->salaryconfig->salary_config_basic_salary > 0)
                        <table style="width:70%">
                            <tbody>
                                <?php
                                if ($appointment->gross_salary) {
                                    $gross_salary = $appointment->gross_salary ?? null;
                                } else {
                                    $gross_salary = 0;
                                }
                                
                                $basic_salay = 0;
                                $medical_allowence = 0;
                                $house_rent = 0;
                                $mobile_bill = 0;
                                $convence_allowance = 0;
                                $festival_bonus = 0;
                                ?>
                                @if ($appointment->salaryconfig->salary_config_basic_salary > 0)
                                    <tr>
                                        <th width="60px; float:right;text-align: left;">Basic Salary</th>
                                        <th width="5px">:</th>
                                        <th width="60px; text-align: right;">
                                            {{ $basic_salay = ($gross_salary * $appointment->salaryconfig->salary_config_basic_salary) / 100 }}
                                            BDT</th>
                                    </tr>
                                @endif
                                @if ($appointment->salaryconfig->salary_config_medical_allowance > 0)
                                    <tr>
                                        <th width="60px;float:right;text-align: left;">Medical allowance</th>
                                        <th width="5px">:</th>
                                        <th width="60px;text-align: right;">
                                            {{ $medical_allowence = ($gross_salary * $appointment->salaryconfig->salary_config_medical_allowance) / 100 }}
                                            BDT
                                        </th>
                                    </tr>
                                @endif
                                @if ($appointment->salaryconfig->salary_config_house_rent_allowance > 0)
                                    <tr>
                                        <th width="60px;text-align: left;">House Rent</th>
                                        <th width="5px">:</th>
                                        <th width="60px;text-align: right;">
                                            {{ $house_rent = ($gross_salary * $appointment->salaryconfig->salary_config_house_rent_allowance) / 100 }}
                                            BDT
                                        </th>
                                    </tr>
                                @endif
                                @if ($appointment->mobile_bill > 0)
                                    <tr>
                                        <th width="60px;text-align: left;">Mobile Allowance</th>
                                        <th width="5px">:</th>
                                        <th width="100px;text-align: right;">
                                            {{ $mobile_bill = $appointment->mobile_bill ?? null }}
                                            BDT</th>
                                    </tr>
                                @endif
                                @if ($appointment->salaryconfig->salary_config_conveyance_allowance > 0)
                                    <tr>
                                        <th width="60px;text-align: left;">Convence Allowance</th>
                                        <th width="5px">:</th>
                                        <th width="60px;text-align: right;">
                                            {{ $convence_allowance = ($gross_salary * $appointment->salaryconfig->salary_config_conveyance_allowance) / 100 }}
                                            BDT
                                        </th>
                                    </tr>
                                @endif
                                @if ($appointment->salaryconfig->salary_config_festival_bonus > 0)
                                    <tr>
                                        <th width="60px;text-align: left;">Festival Bounus</th>
                                        <th width="5px">:</th>
                                        <th width="60px;text-align: right;">
                                            {{ $festival_bonus = ($gross_salary * $appointment->salaryconfig->salary_config_festival_bonus) / 100 }}
                                            BDT
                                        </th>
                                    </tr>
                                @endif
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
                                        <th width="60px;text-align: right;">
                                            {{ $basic_salay + $medical_allowence + $house_rent + $mobile_bill + $convence_allowance + $festival_bonus }}
                                            BDT
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                        @else
                            <table style="width:100%">
                                <tbody>
                                    <tr>
                                        <th width="40%;text-align: left;">Gross</th>
                                        <th width="5px">:</th>
                                        <th width="60px;text-align: right;">{{ $appointment->gross_salary ?? null }}
                                            BDT
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                    @endif
                </div>
                <br>
                <div class="word-wrap">{!! $appointment->appointmentLetter->appointment_template_description ?? null !!}</div>
                {{-- Thanks,<br><br>
                <div class="col-md-12" id="draggable13">
                    <img src="{{ asset($appointment->appointmentLetter->appointment_template_signature ?? null) }}"
                        alt="Signature" style="width:50px;height:20px; padding-left:30px;"><br>
                    <span
                        style="background-color:white;color:black;font-weight:bold;">__________________________</span><br>
                </div>
                <div>
                    {{ $appointment->appointmentLetter->AppointmentSignatory->first_name ?? null }}
                    {{ $appointment->appointmentLetter->AppointmentSignatory->last_name ?? null }}
                    <br><br>
                    {{ $appointment->AppointmentSignatory->company->company_name ?? null }}<br>
                </div> --}}


                <p style="font-size:16px;">AGREEMENT: </p>
                <div style="padding-left:15px;font-size: 13px;">
                    <p>I have carefully read the above letter and the terms and conditions set out therein, which I have
                        fully understood, and I hereby accept the same.</p>
                    <p>Signature……………………</p>
                    <p>Date……………………………</p>
                </div>
        @endforeach
    </div>
</body>

</html>
