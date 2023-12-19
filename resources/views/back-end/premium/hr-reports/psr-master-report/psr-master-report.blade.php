@php
use App\Models\WorkExperience;
use App\Models\Qualification;
@endphp
<table>
    <thead style="background-color:#20898f;">
       
        <tr>
            <td colspan="11"></td>
            <td colspan="9"
                style="vertical-align: middle; background-color:#8e8bbb; text-align: center; border: 1px solid black">
                Salary, benefits details</td>
            <td colspan="6"
                style="vertical-align: middle; background-color:#599959; text-align: center; border: 1px solid black">
                Educational Qualification</td>
            
            
            <td colspan="9"
                style="vertical-align: middle; background-color:#8e8bbb; text-align: center; border: 1px solid black">
                Personal Details</td>
            <td colspan="4"
                style="vertical-align: middle; background-color:#8e8bbb; text-align: center; border: 1px solid black">
                References</td>
        </tr>
        <tr>
            <td style="vertical-align: middle; background-color:#37a137; text-align: center; border: 1px solid black">Sl
                #</td>
            <td style="vertical-align: middle; background-color:#37a137; text-align: center; border: 1px solid black">
                Territory</td>
            <td style="vertical-align: middle; background-color:#37a137; text-align: center; border: 1px solid black">
                SE-Area</td>
            <td style="vertical-align: middle; background-color:#37a137; text-align: center; border: 1px solid black">ID
                No</td>
            <td style="vertical-align: middle; background-color:#37a137; text-align: center; border: 1px solid black">
                PSR name</td>
            <td style="vertical-align: middle; background-color:#37a137; text-align: center; border: 1px solid black">
                Joining Date.</td>
            <td style="vertical-align: middle; background-color:#37a137; text-align: center; border: 1px solid black">
                Service Length</td>
           
            <td style="vertical-align: middle; background-color:#599959; text-align: center; border: 1px solid black">
                Name of Distributors</td>
            <td style="vertical-align: middle; background-color:#599959; text-align: center; border: 1px solid black">
                Location</td>
            <td style="vertical-align: middle; background-color:#599959; text-align: center; border: 1px solid black">
                Office Number</td>
            <td style="vertical-align: middle; background-color:#599959; text-align: center; border: 1px solid black">
                Mobile No. of PSR</td>
           
            <td style="vertical-align: middle; background-color:#14d414; text-align: center; border: 1px solid black">
                Basic</td>
            <td style="vertical-align: middle; background-color:#14d414; text-align: center; border: 1px solid black">
                House Rent</td>
            <td style="vertical-align: middle; background-color:#14d414; text-align: center; border: 1px solid black">
                Med.</td>
            <td style="vertical-align: middle; background-color:#14d414; text-align: center; border: 1px solid black">
                Conv.</td>
            <td style="vertical-align: middle; background-color:#14d414; text-align: center; border: 1px solid black">
                Otder Allow.</td>
            <td style="vertical-align: middle; background-color:#14d414; text-align: center; border: 1px solid black">
                Total</td>
            <td style="vertical-align: middle; background-color:#14d414; text-align: center; border: 1px solid black">
                LPSC/SR</td>
            <td style="vertical-align: middle; background-color:#14d414; text-align: center; border: 1px solid black">
                Ta/DA</td>
            <td style="vertical-align: middle; background-color:#14d414; text-align: center; border: 1px solid black">
                Grand Total</td>
            <td style="vertical-align: middle; background-color:#599959; text-align: center; border: 1px solid black">
                DBBL Account</td>
            <td style="vertical-align: middle; background-color:#599959; text-align: center; border: 1px solid black">
                SSC</td>
            <td style="vertical-align: middle; background-color:#599959; text-align: center; border: 1px solid black">
                HSC</td>
            <td style="vertical-align: middle; background-color:#599959; text-align: center; border: 1px solid black">
                Master/Hon's/Pass</td>
            <td style="vertical-align: middle; background-color:#599959; text-align: center; border: 1px solid black">
                Institution</td>
            <td style="vertical-align: middle; background-color:#599959; text-align: center; border: 1px solid black">
                Passing year</td>
            <td style="vertical-align: middle; text-align: center; border: 1px solid black">Highest Edu.</td>
            <td style="vertical-align: middle; text-align: center; border: 1px solid black">Total Year of Experience Year</td>
            <td style="vertical-align: middle; text-align: center; border: 1px solid black">Current/Last Company</td>
        

            <td style="vertical-align: middle; background-color:#8e8bbb; text-align: center; border: 1px solid black">
                National ID No.</td>
            <td style="vertical-align: middle; background-color:#8e8bbb; text-align: center; border: 1px solid black">
                DOB</td>
            <td style="vertical-align: middle; background-color:#8e8bbb; text-align: center; border: 1px solid black">
                Age</td>
            <td style="vertical-align: middle; background-color:#8e8bbb; text-align: center; border: 1px solid black">
                Religion</td>
            <td style="vertical-align: middle; background-color:#8e8bbb; text-align: center; border: 1px solid black">
                Blood Group</td>
            <td style="vertical-align: middle; background-color:#8e8bbb; text-align: center; border: 1px solid black">
                Maritial Status</td>
            <td style="vertical-align: middle; background-color:#8e8bbb; text-align: center; border: 1px solid black">
                Father's Name</td>
            <td style="vertical-align: middle; background-color:#c9dd15; text-align: center; border: 1px solid black">
                Present Address (Details)</td>
            <td style="vertical-align: middle; background-color:#c9dd15; text-align: center; border: 1px solid black">
                Permanent Address (Details)</td>
            <td style="vertical-align: middle; background-color:#8e8bbb; text-align: center; border: 1px solid black">
                One Reference Name (Relative/ otders)</td>
            <td style="vertical-align: middle; background-color:#8e8bbb; text-align: center; border: 1px solid black">
                Mobile no.</td>
            <td style="vertical-align: middle; background-color:#8e8bbb; text-align: center; border: 1px solid black">
                Reference's Address</td>
      
            <td style="vertical-align: middle; background-color:#c9dd15; text-align: center; border: 1px solid black">
                Vendors With name</td>
        </tr>
    </thead>
    <tbody>
        @php($i=1)
        @foreach($activeData as $employee)
        <tr>
            <td style=" border: 1px solid black">{{$i++}}</td>
            <td style=" border: 1px solid black">{{$employee->userregion->region_name ?? null}}</td>
            <td style=" border: 1px solid black">{{$employee->userarea->area_name ?? null}}</td>
            <td style=" border: 1px solid black">{{$employee->company_assigned_id ?? ''}}</td>
            <td style=" border: 1px solid black">{{$employee->first_name.' '.$employee->last_name ?? ''}}</td>
            <td style=" border: 1px solid black">{{$employee->joining_date ?? ''}}</td>
            <td style=" border: 1px solid black">

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
            <td style=" border: 1px solid black">{{$employee->userterritory->territory_name ?? null}}</td>
            <td style=" border: 1px solid black">{{$employee->usertown->town_name ?? null}}</td>
            <td style=" border: 1px solid black">{{$employee->b_phone ?? null}}</td>
            <td style=" border: 1px solid black">{{$employee->phone ?? null}}</td>
          
            <td style=" border: 1px solid black">{{( $employee->gross_salary *
                $employee->salaryconfig->salary_config_basic_salary)/100}}</td>
            <td style=" border: 1px solid black">{{ ($employee->gross_salary *
                $employee->salaryconfig->salary_config_house_rent_allowance ?? '')/100}}</td>
            <td style=" border: 1px solid black">{{( $employee->gross_salary *
                $employee->salaryconfig->salary_config_medical_allowance ?? '')/100}}</td>
            <td style=" border: 1px solid black">{{( $employee->gross_salary *
                $employee->salaryconfig->salary_config_other_allowance ??
                '')/100}}</td>
            <td style=" border: 1px solid black">{{ ($employee->gross_salary *
                $employee->salaryconfig->salary_config_conveyance_allowance ?? '')/100}}</td>
            <td style=" border: 1px solid black">
                <?php
                    $data =  ($employee->gross_salary * $employee->salaryconfig->salary_config_conveyance_allowance ?? '')/100;
                ?>
                {{($employee->gross_salary + $data)}}
            </td>
            <td style=" border: 1px solid black"></td>
            <td style=" border: 1px solid black">{{ $employee->transport_allowance ?? ''}}</td>
            <td style=" border: 1px solid black">
                <?php
                    $gross =  $employee->gross_salary + $data;
                    $ta_td = $employee->transport_allowance ;
                ?>
                {{ $gross + $ta_td}}
            </td>
            <td style=" border: 1px solid black">{{ $employee->bankaccount->bank_account_number ?? '' }}</td>
            <td style=" border: 1px solid black">
                <?php
                $qualification = Qualification::where('qualification_employee_id', $employee->id)->get();
                foreach ($qualification as $item) {
                    if ($item->qualification_education_level == 'SSC') {
                        echo $item->qualification_education_level;
                    }
                }
              ?>
            </td>
            <td style=" border: 1px solid black">
                <?php
                        $qualification = Qualification::where('qualification_employee_id', $employee->id)->get();
                        foreach ($qualification as $item) {
                            if ($item->qualification_education_level == 'HSC') {
                                echo $item->qualification_education_level;
                            }
                        }
                   ?>
            </td>
            <td style=" border: 1px solid black">
                <?php
                        $qualification = Qualification::where('qualification_employee_id', $employee->id)->get();
                        foreach ($qualification as $item) {
                            if ($item->qualification_education_level == 'BA' || $item->qualification_education_level == 'Dakhil' || $item->qualification_education_level == 'BBS' || $item->qualification_education_level == 'BBA' || $item->qualification_education_level == 'MBA') {
                                echo $item->qualification_education_level;
                            }
                        }
                    ?>
            </td>



            <td style=" border: 1px solid black">{!!
                htmlentities($employee->educationdetail->qualification_institute_name ?? '', ENT_QUOTES) !!}</td>
            <td style=" border: 1px solid black">{{ $employee->educationdetail->qualification_passing_year ?? '' }}</td>
            <td style=" border: 1px solid black">{{ $employee->educationdetail->qualification_education_level ?? ''}}
            </td>
            <td  style=" border: 1px solid black">
                <?php
                $work_expriences = WorkExperience::where('work_experience_employee_id',
                $employee->id)->sum('total_year_of_experience');
                echo $work_expriences;
                ?>
            </td>
         
           
            <td style=" border: 1px solid black">{!! htmlentities($employee->emoloyeedetail->previous_organization ?? ''
                ,ENT_QUOTES) !!}</td>
           
            <td style=" border: 1px solid black">{{ $employee->emoloyeedetail->identification_number ?? '' }}</td>
            <td style=" border: 1px solid black">{{ $employee->date_of_birth ?? ''}}</td>
            <td style=" border: 1px solid black">
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
            <td style=" border: 1px solid black">{{ $employee->emoloyeedetail->religion ?? ''}}</td>
            <td style=" border: 1px solid black">{{ $employee->blood_group ?? ''}}</td>
            <td style=" border: 1px solid black">{{ $employee->emoloyeedetail->marital_status ?? '' }}</td>
            <td style=" border: 1px solid black">{{ $employee->emoloyeedetail->father_name_en ?? ''}}</td>
            <td style=" border: 1px solid black">
                @if ($employee->emoloyeedetail)
                @if ($employee->emoloyeedetail->present_pourosova)
                {{ $employee->emoloyeedetail->present_pourosova ?? '' }},
                @endif
                @endif

                @if ($employee->emoloyeedetail)
                @if ($employee->emoloyeedetail->present_sadar)
                {{ $employee->emoloyeedetail->present_sadar ?? ''}},
                @endif
                @endif

                @if ($employee->emoloyeedetail)
                @if ($employee->emoloyeedetail->present_city_corporation)
                {{ $employee->emoloyeedetail->present_city_corporation ?? ''}},
                @endif
                @endif

                @if ($employee->emoloyeedetail)
                @if ($employee->emoloyeedetail->pre_postal_area_en)
                {{ $employee->emoloyeedetail->pre_postal_area_en ?? ''}},
                @endif
                @endif

                @if ($employee->emoloyeedetail)
                @if ($employee->emoloyeedetail->userPresentUpazila->up_name ?? '')
                {{ $employee->emoloyeedetail->userPresentUpazila->up_name ?? ''}},
                @endif
                @endif

                @if ($employee->emoloyeedetail)
                @if ($employee->emoloyeedetail->userPresentDistrict->dist_name ?? '')
                {{ $employee->emoloyeedetail->userPresentDistrict->dist_name ?? ''}},
                @endif
                @endif

                @if ($employee->emoloyeedetail)
                @if ($employee->emoloyeedetail->userPresentDivision->dv_name ?? '')
                {{ $employee->emoloyeedetail->userPresentDivision->dv_name ?? '' }},
                @endif
                @endif
            </td>
            <td style=" border: 1px solid black">
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

            <td style=" border: 1px solid black">{{ $employee->emergencyContact->emergency_contact_name ?? '' }}</td>
            <td style=" border: 1px solid black">{{ $employee->emergencyContact->emergency_contact_phone ?? '' }}</td>
            <td style=" border: 1px solid black">{{ $employee->emergencyContact->emergency_contact_address ?? '' }}</td>
            <td style=" border: 1px solid black">PLA</td>
        </tr>
        @endforeach
    </tbody>
</table>