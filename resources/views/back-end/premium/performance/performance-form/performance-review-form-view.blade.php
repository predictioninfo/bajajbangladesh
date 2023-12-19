@extends('back-end.premium.layout.premium-main')
@section('content')
<section class="main-contant-section">
   <div class="">
      <style>
         .performance-report-pdf .header-logo {
         display: flex;
         flex-direction: row;
         justify-content: space-between;
         align-items: center;
         }
         .performance-report-pdf .check-box {
         display: flex;
         flex-direction: row;
         justify-content: space-between;
         align-items: center;
         }
         .performance-report-pdf .date-info {
         display: flex;
         flex-direction: row;
         justify-content: space-between;
         align-items: center;
         }
         table tr td {
         border: 1px solid #333;
         padding: 3px 5px;
         }
         table tr th {
         border: 1px solid #333;
         padding: 3px 5px;
         }
         .singnature {
         display: flex;
         flex-direction: row;
         justify-content: space-between;
         align-items: end;
         width: 100%;
         gap: 20px;
         text-align: center;
         }
         .singnature p {
         border-top: 1px solid #000;
         width: 100%;
         margin-bottom: 0;
         }
         .flex-content {
         display: flex;
         flex-direction: row;
         justify-content: space-between;
         align-items: end;
         width: 100%;
         gap: 20px;
         text-align: left;
         }
         .flex-content p {
         width: 100%;
         margin-bottom: 0;
         }
         table tr td h4 {
    margin: 0;
    font-size: 16px;
    font-weight: 700;
    text-align: center;
    padding: 5px;
    text-transform: lowercase;
}
         .performance-report-pdf .section-title {
         text-align: center;
         }
      </style>

<?php
use App\Models\User;
use App\Models\ObjectiveTypeConfig;
use App\Models\Objective;
use App\Models\ObjectiveDetails;
?>
      <div class="performance-report-pdf">
         <div class="header-info">
            <div class="section-title">


               <div class="card mb-0">
                <div class="card-header with-border">
                    <h1 class="card-title text-center"> Employee Yearly Objective Review Form </h1>
                    <ol id="breadcrumb1">
                        <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                        <li><a href="{{ route('performance-forms') }}"><span class="icon icon-list"> </span> List</a></li>
                        <li><a href="#">List - {{ 'Yearly Reviews' }} </a></li>
                    </ol>
                </div>
            </div>

            </div>
         </div>
         <div class="content-box">
            <div class="table-responsive">
            <table>
            <tbody>
                <tr>
                    <td colspan="6">
                        <h4>Staff Infomation</h4>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">Name Of The Staff:</td>
                    <td colspan="2">{{ ucfirst($employee_info->objectiveReport->userfromobjective->first_name) }}
                        {{ ucfirst($employee_info->objectiveReport->userfromobjective->last_name) }}</td>
                    <td>PIN:</td>
                    <td >{{ $employee_info->objectiveReport->userfromobjective->company_assigned_id }}
                    </td>
                </tr>
                <tr>
                    <td colspan="3">Designation in use (including function):</td>
                    <td colspan="3">{{ $employee_info->objectiveReport->userdesignationfromobjective->designation_name }}</td>

                </tr>

                <tr>
                    <td colspan="2">Date of joining :</td>
                    <td colspan="2">{{ $employee_info->objectiveReport->userfromobjective->joining_date }}</td>
                    <td>Country:</td>
                    <td >
                        {{ $employee_info->objectiveReport->userfromobjective->emoloyeedetail->userNationality->name ?? '' }}
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        Educational Qualification: Graduate/Post Graduate/Professional/Others:
                    </td>
                    <td colspan="2">{{ $employee_info->objectiveReport->userfromobjective->qualification->qualification_education_level ?? 'Not Selected' }}
                    </td>
                    <td >Contract/Regular:</td>
                    <td>{{ $employee_info->objectiveReport->userfromobjective->job_nature ?? '' }}</td>
                </tr>
                <tr>

                    <td colspan="3">Contract End Date:</td>
                    <td colspan="3">
                        @if ($employee_info->objectiveReport->userfromobjective->employment_type == 'Contactual')
                    <td colspan="3" scope="col">
                        {{ $employee_info->objectiveReport->userfromobjective->expiry_date }}</td>
                @else
                    {{ 'Not Applicable' }}
                    @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="2">Supervisor Name:</td>
                    <td colspan="2"> {{ $supervisor->first_name ?? 'Not Selected' }}
                        {{ $supervisor->last_name ?? 'Not Selected' }}</td>
                    <td >Last Contract Renewal Date:</td>
                    <td colspan="2">
                        @if ($employee_info->objectiveReport->userfromobjective->employment_type == 'Contactual')
                    <td scope="col">
                        {{ $employee_info->objectiveReport->userfromobjective->expiry_date }}</td>
                @else
                    {{ 'Not Applicable' }}
                    @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="2">Supervisor Designation:</td>
                    <td colspan="2"> {{ $supervisor->userdesignation->designation_name ?? 'Not Selected' }}</td>
                    <td >Supervisor PIN:</td>
                    <td>{{ ucfirst($supervisor->company_assigned_id ?? 'Not Selected') }}</td>
                </tr>

                <tr>
                    <td colspan="6">
                       <h4>OBJECTIVE RATING SCALE:</h4>
                    </td>
                 </tr>

                <tr colspan="3">
                   <th>SL</th>
                   <th colspan="3">Objective Rating</th>
                   <th colspan="2"> Rating Defination</th>
                </tr>


                @foreach ($ratingDefination as $key => $value)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td colspan="3">{{ $value->point }}</td>
                    <td colspan="2">{{ $value->defination }}</td>
                </tr>
                @endforeach


                @php
                $getPoint = 0;
                $totalPoint = 0;

                @endphp

               <tr>
                  <td colspan="6">
                     <h4>4.YEARLY REVIEW</h4>
                  </td>
               </tr>
               <tr>
                  <td colspan="">
                     Individual Objectives with Timeline (Copy your set objectives here)
                  </td>
                  <td>Measures of Success (Copy your measures here)</td>
                  <td colspan="">
                     Actions Taken by Employee(Please fill this out. Specify your actual
                     achievements against set objectives)
                  </td>
                  <td>Supervisor Comments</td>
                  <td>Rating</td>
                  <td>Target Point</td>

               </tr>
               <tr>

                @foreach ($objectivesMarking->unique(fn($p) => $p->objectiveTypes->objective_type_name) as $objective)
                <?php
                $Objdetails = ObjectiveDetails::where('objective_obj_type_id', $objective->objective_obj_type_id)
                    ->where('objective_id', $objective->objective_id)
                    ->where('obj_detail_com_id', Auth::user()->com_id)
                    ->get();

                ?>


                  <th colspan="6" style="background-color: #04AA6D; color:#fff; text-align: center; font-size: 14px;">
                    <b>

                        {{ $objective->objectiveTypes->objective_type_name ?? '' }} -
                        {{ $objective->objectiveTypeConfig->obj_config_percent ?? '' }} %</b>
                  </th>
               </tr>
               @foreach ($Objdetails as $value)
               <?php
               $getPoint += $value->rating;
               $totalPoint += $value->objectiveTypeConfig->obj_config_target_point;

               ?>
               <tr style="">
                  <td style="text-align: center; border: 1px solid;">{{ $value->objective_name ?? '' }}</td>
                  <td style="text-align: center; border: 1px solid;"> {{ $value->objective_success ?? '' }}</td>
                  <td style="text-align: center; border: 1px solid;">{{ $value->action_taken ?? '' }}</td>
                  <td style="text-align: center; border: 1px solid;"> {{ $value->super_comments ?? '' }}</td>

                  <td style="text-align: center; border: 1px solid;"> {{ $value->rating ?? '' }}</td>
                  <td style="text-align: center; border: 1px solid;">
                    {{ $value->objectiveTypeConfig->obj_config_target_point ?? '' }}
                  </td>
               </tr>
               @endforeach
               @endforeach

               <tr>
                  <td style="background-color: #04AA6D; color:#fff; text-align: center; font-size: 14px;" colspan="4">Average Point:</td>
                  <td style="background-color: #04AA6D; color:#fff; text-align: center; font-size: 14px;">{{ number_format((float) $marking_rating, 1, '.', '') }}</td>
                  <td style="background-color: #04AA6D; color:#fff; text-align: center; font-size: 14px;">{{ number_format((float) $total_rating, 1, '.', '') }}</td>
               </tr>

               </tr>
            </tbody>
         </table>
            </div>
         </div>
      </div>
   </div>
</section>
@endsection
