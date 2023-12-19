@extends('back-end.premium.layout.premium-main')

@section('content')
    <section class="main-contant-section">

        <div class=""><span id="general_result"></span></div>

        <?php
        use App\Models\WorkExperience;
        use App\Models\Qualification;
        use App\Models\User;
        ?>

        <div class="">
            <div class="card mb-0">
                <div class="card mb-0">
                    <div class="card-header with-border">
                        <h1 class="card-title text-center"> {{ __('PSR Master  Report') }} </h1>
                        <ol id="breadcrumb1">
                            <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                            <li> <a href="{{ route('psr-master-report-downloads') }}"><span class="fa fa-arrow-down"> Excel
                                        Download</span></a></li>
                            <li><a href="#">{{ 'PSR Master Report' }} </a></li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="content-box">
                <div class="table-responsive">
                    <table id="user-table" class="table table-bordered table-hover table-striped">
                        <thead style="background-color:#20898f; color:white;">

                            <tr>
                                <td colspan="11"></td>
                                <td colspan="9">Salary, benefits details</td>
                                <td colspan="6">Educational Qualification</td>
                                <td colspan="2">Total Year of Experience</td>
                                <td colspan="9">Personal Details</td>
                                <td colspan="4">References</td>
                            </tr>
                            <tr>
                                <td>Sl #</td>
                                <td>Territory</td>
                                <td>SE-Area</td>
                                <td>ID No</td>
                                <td>PSR name</td>
                                <td>Joining Date.</td>
                                <td>Service Length</td>
                                <td>Name of Distributors</td>
                                <td>Location</td>
                                <td>Office Number</td>
                                <td>Mobile No. of PSR</td>
                                <td>Basic</td>
                                <td>House Rent</td>
                                <td>Med.</td>
                                <td>Conv.</td>
                                <td>Otder Allow.</td>
                                <td>Total</td>
                                <td>Ta/DA</td>
                                <td>Grand Total</td>
                                <td>DBBL Account</td>
                                <td>SSC</td>
                                <td>HSC</td>
                                <td>Master/Hon's/Pass</td>
                                <td>Institution</td>
                                <td>Passing year</td>
                                <td>Highest Edu.</td>
                                <td>Total Year of Experience Year </td>
                                <td>Current/Last Company</td>
                                <td>National ID No.</td>
                                <td>DOB</td>
                                <td>Age</td>
                                <td>Religion</td>
                                <td>Blood Group</td>
                                <td>Maritial Status</td>
                                <td>Father's Name</td>
                                <td>Present Address (Details)</td>
                                <td>Permanent Address (Details)</td>
                                <td>One Reference Name (Relative/ otders)</td>
                                <td>Mobile no.</td>
                                <td>Reference's Address</td>
                                <td>Vendors With name</td>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i = 1)
                            @foreach ($employees as $employee)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $employee->userregion->region_name ?? null }}</td>
                                    <td>{{ $employee->userarea->area_name ?? null }}</td>
                                    <td>{{ $employee->company_assigned_id ?? '' }}</td>
                                    <td>{{ $employee->first_name . ' ' . $employee->last_name ?? '' }}</td>
                                    <td>{{ $employee->joining_date ?? '' }}</td>
                                    <td>
                                        <?php

                                        $date2 = today();
                                        $date1 = new DateTime($employee->joining_date);
                                        $difference = $date2->diff($date1);
                                        $days = $difference->d;
                                        $months = $difference->m;
                                        $years = $difference->y;
                                        echo "$years y- $months m- $days d ";
                                        ?>

                                    </td>

                                    <td>{{ $employee->userterritory->territory_name ?? null }}</td>
                                    <td>{{ $employee->usertown->town_name ?? null }}</td>
                                    <td>{{ $employee->b_phone ?? null }}</td>
                                    <td>{{ $employee->phone ?? null }}</td>

                                    <td>{{ ($employee->gross_salary * $employee->salaryconfig->salary_config_basic_salary) / 100 }}
                                    </td>
                                    <td>{{ ($employee->gross_salary * $employee->salaryconfig->salary_config_house_rent_allowance ?? '') / 100 }}
                                    </td>
                                    <td>{{ ($employee->gross_salary * $employee->salaryconfig->salary_config_medical_allowance ?? '') / 100 }}
                                    </td>
                                    <td>{{ ($employee->gross_salary * $employee->salaryconfig->salary_config_other_allowance ?? '') / 100 }}
                                    </td>
                                    <td>{{ ($employee->gross_salary * $employee->salaryconfig->salary_config_conveyance_allowance ?? '') / 100 }}
                                    </td>
                                    <td>

                                        {{ $employee->gross_salary }}
                                    </td>

                                    <td>{{ $employee->transport_allowance ?? '' }}</td>
                                    <td>
                                        <?php

                                        $gross = $employee->gross_salary ;
                                        $ta_td = $employee->transport_allowance;
                                        ?>
                                        {{ $gross + $ta_td }}
                                    </td>
                                    <td>{{ $employee->bankaccount->bank_account_number ?? '' }}</td>
                                    <td>
                                        <?php
                                        $qualification = Qualification::where('qualification_employee_id', $employee->id)->get();
                                        foreach ($qualification as $item) {
                                            if ($item->qualification_education_level == 'SSC') {
                                                echo $item->qualification_education_level;
                                            }
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $qualification = Qualification::where('qualification_employee_id', $employee->id)->get();
                                        foreach ($qualification as $item) {
                                            if ($item->qualification_education_level == 'HSC') {
                                                echo $item->qualification_education_level;
                                            }
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $qualification = Qualification::where('qualification_employee_id', $employee->id)->get();
                                        foreach ($qualification as $item) {
                                            if ($item->qualification_education_level == 'BA' || $item->qualification_education_level == 'Dakhil' || $item->qualification_education_level == 'BBS' || $item->qualification_education_level == 'BBA' || $item->qualification_education_level == 'MBA') {
                                                echo $item->qualification_education_level;
                                            }
                                        }
                                        ?>
                                    </td>
                                    <td>{{ $employee->educationdetail->qualification_institute_name ?? '' }}</td>
                                    <td>{{ $employee->educationdetail->qualification_passing_year ?? '' }}</td>
                                    <td>{{ $employee->educationdetail->qualification_education_level ?? '' }}</td>

                                    <td>
                                        <?php
                                        $work_expriences = WorkExperience::where('work_experience_employee_id',
                                        $employee->id)->sum('total_year_of_experience');
                                        echo $work_expriences;
                                        ?>
                                    </td>
                                    <td>{{ $employee->emoloyeedetail->previous_organization ?? '' }}</td>
                                    <td>{{ $employee->emoloyeedetail->identification_number ?? '' }}</td>
                                    <td>{{ $employee->date_of_birth ?? '' }}</td>
                                    <td>
                                        <?php

                                        $date2 = today();
                                        $date1 = new DateTime($employee->date_of_birth);
                                        $difference = $date2->diff($date1);
                                        $days = $difference->d;
                                        $months = $difference->m;
                                        $years = $difference->y;
                                        echo "$years y- $months m- $days d ";
                                        ?>

                                    </td>
                                    <td>{{ $employee->emoloyeedetail->religion ?? '' }}</td>
                                    <td>{{ $employee->blood_group ?? '' }}</td>
                                    <td>{{ $employee->emoloyeedetail->marital_status ?? '' }}</td>
                                    <td>{{ $employee->emoloyeedetail->father_name_en ?? '' }}</td>
                                    <td>
                                        @if ($employee->emoloyeedetail)
                                            @if ($employee->emoloyeedetail->present_pourosova)
                                                {{ $employee->emoloyeedetail->present_pourosova ?? '' }},
                                            @endif
                                        @endif

                                        @if ($employee->emoloyeedetail)
                                            @if ($employee->emoloyeedetail->present_sadar)
                                                {{ $employee->emoloyeedetail->present_sadar ?? '' }},
                                            @endif
                                        @endif

                                        @if ($employee->emoloyeedetail)
                                            @if ($employee->emoloyeedetail->present_city_corporation)
                                                {{ $employee->emoloyeedetail->present_city_corporation ?? '' }},
                                            @endif
                                        @endif

                                        @if ($employee->emoloyeedetail)
                                            @if ($employee->emoloyeedetail->pre_postal_area_en)
                                                {{ $employee->emoloyeedetail->pre_postal_area_en ?? '' }},
                                            @endif
                                        @endif

                                        @if ($employee->emoloyeedetail)
                                            @if ($employee->emoloyeedetail->userPresentUpazila->up_name ?? '')
                                                {{ $employee->emoloyeedetail->userPresentUpazila->up_name ?? '' }},
                                            @endif
                                        @endif

                                        @if ($employee->emoloyeedetail)
                                            @if ($employee->emoloyeedetail->userPresentDistrict->dist_name ?? '')
                                                {{ $employee->emoloyeedetail->userPresentDistrict->dist_name ?? '' }},
                                            @endif
                                        @endif

                                        @if ($employee->emoloyeedetail)
                                            @if ($employee->emoloyeedetail->userPresentDivision->dv_name ?? '')
                                                {{ $employee->emoloyeedetail->userPresentDivision->dv_name ?? '' }},
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        @if ($employee->emoloyeedetail)
                                            @if ($employee->emoloyeedetail->village_en)
                                                {{ $employee->emoloyeedetail->village_en }},
                                            @endif
                                        @endif

                                        @if ($employee->userUnion)
                                            @if ($employee->userUnion->un_name)
                                                {{ $employee->userUnion->un_name }},
                                            @endif
                                        @endif

                                        @if ($employee->emoloyeedetail)
                                            @if ($employee->emoloyeedetail->postal_area_en)
                                                {{ $employee->emoloyeedetail->postal_area_en }},
                                            @endif
                                        @endif

                                        @if ($employee->userUpazila)
                                            @if ($employee->userUpazila->up_name)
                                                {{ $employee->userUpazila->up_name }},
                                            @endif
                                        @endif

                                        @if ($employee->userDistrict)
                                            @if ($employee->userDistrict->dist_name)
                                                {{ $employee->userDistrict->dist_name }},
                                            @endif
                                        @endif

                                        {{ $employee->userDivision->dv_name ?? null }}

                                    </td>

                                    <td>{{ $employee->emergencyContact->emergency_contact_name ?? '' }}</td>
                                    <td>{{ $employee->emergencyContact->emergency_contact_phone ?? '' }}</td>
                                    <td>{{ $employee->emergencyContact->emergency_contact_address ?? '' }}</td>
                                    <td>PLA</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
</div>

    </section>

    <script type="text/javascript">
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#user-table').DataTable({

                "aLengthMenu": [
                    [25, 50, 100, -1],
                    [25, 50, 100, "All"]
                ],
                "iDisplayLength": 25,

                dom: '<"row"lfB>rtip',

                buttons: [{
                        extend: 'pdf',
                        text: '<i title="export to pdf" class="fa fa-file-pdf-o"></i>',
                        exportOptions: {
                            columns: ':visible:Not(.not-exported)',
                            rows: ':visible'
                        },
                    },
                    {
                        extend: 'csv',
                        text: '<i title="export to csv" class="fa fa-file-text-o"></i>',
                        exportOptions: {
                            columns: ':visible:Not(.not-exported)',
                            rows: ':visible'
                        },
                    },
                    {
                        extend: 'print',
                        text: '<i title="print" class="fa fa-print"></i>',
                        exportOptions: {
                            columns: ':visible:Not(.not-exported)',
                            rows: ':visible'
                        },
                    },
                    {
                        extend: 'colvis',
                        text: '<i title="column visibility" class="fa fa-eye"></i>',
                        columns: ':gt(0)'
                    },
                ],
            });

        });
    </script>
@endsection
