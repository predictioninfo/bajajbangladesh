<?php
use App\Models\Company;
$company_names = Company::where('id', Auth::user()->com_id)->first(['company_name']);
use App\Models\User;
use App\Models\EmployeeDetail;
?>

<table>

    <thead>
        <tr>
            <th>{{ __('AUDTDATE') }}</th>
            <th> {{ __('fullName') }}</th>
            <th>{{ __('Employee ID') }}</th>
            <th>{{ __('birthDate') }}</th>
            <th>{{ __('Birth Place') }}</th>
            <th style="background-color: #90EE90">{{ __('Birth Certificate') }}</th>
            <th style="background-color: #90EE90">{{ __('NID') }}</th>
            <th>{{ __('gender') }}</th>
            <th style="background-color: #90EE90">
                {{ __('bloodGroup') }}</th>
            <th>
                {{ __('religion') }}</th>
            <th style="background-color: #90EE90; color: #FF0000">
                {{ __('mStatus') }}</th>
            <th>
                {{ __('nationality') }}</th>
            <th>
                {{ __('Joning Date') }}</th>
            <th>
                {{ __('Designation') }}</th>
            <th>
                {{ __('grade') }}</th>
            <th>
                {{ __(' category') }}</th>
            <th>
                {{ __('workStation') }}</th>
            <th>
                {{ __('residentialStatus') }}</th>
            <th>
                {{ __('Replacement Employee Name') }}</th>
            <th style="background-color: #90EE90">
                {{ __('permanentAddress') }}</th>
            <th style="background-color: #90EE90">
                {{ __('permanentThana') }}</th>
            <th style="background-color: #90EE90">
                {{ __('permanentDistrict') }}</th>
            <th style="background-color: #90EE90">
                {{ __('permanentPostCode') }}</th>
            <th style="background-color: #90EE90">
                {{ __('presentAddress') }}</th>
            <th style="background-color: #90EE90">
                {{ __('presentThana') }}</th>
            <th style="background-color: #90EE90">
                {{ __('presentDistrict') }}</th>
            <th style="background-color: #90EE90">
                {{ __('PresentPostCode') }}</th>
            <th style="background-color: #90EE90">
                {{ __('personalMobile1') }}</th>
            <th style="background-color: #90EE90">
                {{ __('personalMobile2') }}</th>
            <th style="background-color: #90EE90">
                {{ __('emergencyConPerson') }}</th>
            <th style="background-color: #90EE90">
                {{ __('emergencyAddress') }}</th>
            <th style="background-color: #90EE90">
                {{ __('emergencyRelation') }}</th>
            <th style="background-color: #90EE90">
                {{ __('emergenceMobile1') }}</th>
            <th style="background-color: #90EE90">
                {{ __('educationType') }}</th>
            <th style="background-color: #90EE90">
                {{ __('institute') }}</th>
            <th style="background-color: #90EE90">
                {{ __('passingYear') }}</th>
            <th style="background-color: #90EE90">
                {{ __('discipline') }}</th>
            <th style="background-color: #90EE90">
                {{ __('result') }}</th>
            <th style="background-color: #90EE90">
                {{ __('companyName') }}</th>
            <th>
                {{ __('fathersName') }}</th>
            <th style="background-color: #90EE90">
                {{ __('mothersName') }}</th>
            <th>
                {{ __('nomName') }}</th>
        </tr>

    </thead>
    <tbody>
        @php($i = 1)

        @foreach ($data['users'] as $usersData)
        <?php $employee = EmployeeDetail::where('empdetails_employee_id', $usersData->id)->first(); ?>
        <tr>

            <td>{{ $i++ }}</td>
            <td>{{ $usersData->first_name . ' ' . $usersData->last_name }}</td>
            <td>{{ $usersData->company_assigned_id  }}</td>
            <td>{{ $usersData->date_of_birth ?? null }}</td>
            <td>{{ $usersData->emoloyeedetail->birth_place ?? null }}</td>
            <td>
                @if ($usersData->emoloyeedetail)
                @if ($usersData->emoloyeedetail->identification_type == 'birthcertificate')
                {{ $usersData->emoloyeedetail->identification_number ?? null }}
                @endif
                @endif
            </td>

            <td>
                @if ($usersData->emoloyeedetail)
                @if ($usersData->emoloyeedetail->identification_type == 'nid')
                {{ $usersData->emoloyeedetail->identification_number ?? null }}
                @endif
                @endif
            </td>
            <td>{{ $usersData->gender }}</td>
            <td>{{ $usersData->blood_group ?? null }}</td>
            <td>{{ $usersData->emoloyeedetail->religion ?? null }}</td>
            <td>{{ $usersData->emoloyeedetail->marital_status ?? null }}</td>
            <td>{{ $employee->emoloyeeNationlaity->name ?? null }}</td>
            <td>{{ $usersData->joining_date }}</td>
            <td>{{ $usersData->userdesignation->designation_name ?? null }}</td>
            <td>{{ $usersData->userdesignation->designation_name ?? null }}</td>
            <td>{{ $usersData->job_nature ?? null }}</td>
            <td>{{ $usersData->userterritory->territory_name ?? null }}</td>
            <td>{{ 'Bangladesh' }}</td>
            <td>{{ $usersData->replace_employee }}</td>
            <td>
                @if ($usersData->emoloyeedetail)
                @if ($usersData->emoloyeedetail->village_en)
                {{ $usersData->emoloyeedetail->village_en }},
                @endif
                @endif

                @if ($usersData->userUnion)
                @if ($usersData->userUnion->un_name)
                {{ $usersData->userUnion->un_name }},
                @endif
                @endif

                @if ($usersData->emoloyeedetail)
                @if ($usersData->emoloyeedetail->postal_area_en)
                {{ $usersData->emoloyeedetail->postal_area_en }},
                @endif
                @endif

                @if ($usersData->userUpazila)
                @if ($usersData->userUpazila->up_name)
                {{ $usersData->userUpazila->up_name }},
                @endif
                @endif

                @if ($usersData->userDistrict)
                @if ($usersData->userDistrict->dist_name)
                {{ $usersData->userDistrict->dist_name }},
                @endif
                @endif

                {{ $usersData->userDivision->dv_name ?? null }}
            </td>
            <td> {{ $usersData->userUpazila->up_name ?? null }}</td>
            <td>{{ $usersData->userDistrict->dist_name ?? null }}</td>
            <td>{{ $usersData->emoloyeedetail->postal_code_en ?? null }}</td>

            <td>
                @if ($employee)
                @if ($employee->userPresentUnion)
                {{ $employee->userPresentUnion->un_name ?? '' }},
                @endif
                @endif
                @if ($employee)
                @if ($employee->emoloyeedetail)
                {{ $employee->emoloyeedetail->postal_area_en ?? '' }},
                @endif
                @endif

                @if ($employee)
                @if ($employee->userPresentUpazila)
                {{ $employee->userPresentUpazila->up_name ?? '' }},
                @endif
                @endif

                @if ($employee)
                @if ($employee->userPresentDistrict)
                {{ $employee->userPresentDistrict->dist_name ?? '' }},
                @endif
                @endif
                {{ $employee->userPresentDivision->dv_name ?? null }}
            </td>
            <td>{{ $employee->userPresentUpazila->up_name ?? null }}</td>
            <td>{{ $employee->userPresentDistrict->dist_name ?? null }}</td>
            <td>{{ $usersData->emoloyeedetail->pre_postal_code_en ?? null }}</td>
            <td>{{ $usersData->phone ?? $usersData->inactive_phone }}</td>
            <td>{{ $usersData->b_phone ?? '' }}</td>
            <td>{{ $usersData->emergencyContact->emergency_contact_name ?? null }}</td>
            <td>{{ $usersData->emergencyContact->emergency_contact_address ?? null }}</td>
            <td>{{ $usersData->emergencyContact->emergency_contact_relation ?? null }}</td>
            <td>{{ $usersData->emergencyContact->emergency_contact_phone ?? null }}</td>
            <td>{{ $usersData->qualification->qualification_education_level ?? null }}</td>
            <td>{{ $usersData->qualification->qualification_institute_name ?? null }}</td>
            <td>{{ $usersData->qualification->qualification_passing_year ?? null }}</td>
            <td>{{ $usersData->qualification->qualification_disipline ?? null }}</td>
            <td>{{ $usersData->qualification->qualification_result ?? null }}</td>
            <td>{{ $usersData->emoloyeedetail->previous_organization ?? null }}</td>
            <td>{{ $usersData->emoloyeedetail->father_name_en ?? null }}</td>
            <td>{{ $usersData->emoloyeedetail->mother_name_en ?? null }}</td>
            <td></td>
        </tr>
        @endforeach
    </tbody>

</table>
