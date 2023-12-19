<style>
    html,
    body,
    div {
        font-family: nikosh;
        font-size: 16px;
        line-height: 200%;
    }
</style>
@if ($user->experience_letter_id)

<div>
    <div class="header-logo">
        <div>
            <img style="max-height: 50px;"  src="{{asset('uploads/logos/predictionit.png')}}" />
        </div>
    </div> <br>
    <?php
$date = date('j F, Y');

?>

    Date: {{ $date }} <br><br>
    Name: {{ $user->first_name . ' ' . $user->last_name }} <br>
    Designation: {{ $user->userdesignation->designation_name ?? null }} <br>
    Department: {{ $user->userdepartment->department_name ?? null }} <br><br>
    <span style="font-weight:bold;"> Subject: {{$user->experienceLetter->subject ?? '' }}</span><br><br>

    Dear {{ $user->first_name . ' ' . $user->last_name }} ,<br><br>


    <!-- this can be removed -->
    This is to state that <b>{{ $user->first_name }} {{ $user->last_name }}</b> has been employed at
    {{ "Prediction Learning Associates Ltd." }}
    from <b>{{ $user->joining_date }}</b> to <b>{{ now()->format('d -m-y') }}</b> as a
    <b>{{ $user->userdesignation->designation_name }}</b> with development as his area of expertise.<br />

    <br /> {!! $user->experienceLetter->description !!}<br />

    <div align="left">
        <!-- this can be changed to "left" if preferred-->
        Best Regards <br />
        <img src="{{ asset($user->experienceLetter->signature ?? '') }}" alt="" height="20px" width="" 150px>
        <br /> {{ $user->experienceLetter->experienceSignatory->first_name }}
        {{ $user->experienceLetter->experienceSignatory->last_name }}
        <br />
        {{ "Prediction Learning Associates Ltd." }}<br />


    </div>

</div>
@else


<div style="">

    <style>
        html,
        body,
        div {
            font-family: nikosh;
            font-size: 16px;
            line-height: 200%;
        }
    </style>

    <br>
    <p>
        <?php
    $date_day=date('d');
    $date_month=date('F');
    $date_year=date('Y');
    $joinig_day = date('d',strtotime($user->joining_date));
    $joinig_month = date('F',strtotime($user->joining_date));
    $joinig_year = date('Y',strtotime($user->joining_date));
    $inactive_day = date('d',strtotime($user->inactive_date));
    $inactive_month = date('F',strtotime($user->inactive_date));
    $inactive_year = date('Y',strtotime($user->inactive_date));


    if($date_day == ' 1'){echo $date_day.'st '.$date_month ." ".$date_year."";}
    if($date_day == ' 2'){echo $date_day.'nd '.$date_month ." ".$date_year." ";}
    if($date_day == ' 3'){echo $date_day.'rd '.$date_month ." ".$date_year." ";}
    if($date_day == ' 4'){echo $date_day.'th '.$date_month ." ".$date_year." ";}
    if($date_day == ' 5'){echo $date_day.'th '.$date_month ." ".$date_year." ";}
    if($date_day == ' 6'){echo $date_day.'th '.$date_month ." ".$date_year." ";}
    if($date_day == ' 7'){echo $date_day.'th '.$date_month ." ".$date_year." ";}
    if($date_day == ' 8'){echo $date_day.'th '.$date_month ." ".$date_year." ";}
    if($date_day == ' 9'){echo $date_day.'th '.$date_month ." ".$date_year." ";}
    if($date_day == ' 10'){echo $date_day.'th '.$date_month ." ".$date_year." ";}
    if($date_day == ' 11'){echo $date_day.'th '.$date_month ." ".$date_year." ";}
    if($date_day == ' 12'){echo $date_day.'th '.$date_month ." ".$date_year." ";}
    if($date_day == ' 13'){echo $date_day.'th '.$date_month ." ".$date_year." ";}
    if($date_day == ' 14'){echo $date_day.'th '.$date_month ." ".$date_year." ";}
    if($date_day == ' 15'){echo $date_day.'th '.$date_month ." ".$date_year." ";}
    if($date_day == ' 16'){echo $date_day.'th '.$date_month ." ".$date_year." ";}
    if($date_day == ' 17'){echo $date_day.'th '.$date_month ." ".$date_year." ";}
    if($date_day == ' 18'){echo $date_day.'th '.$date_month ." ".$date_year." ";}
    if($date_day == ' 19'){echo $date_day.'th '.$date_month ." ".$date_year." ";}
    if($date_day == ' 20'){echo $date_day.'th'.$date_month ." ".$date_year." ";}
    if($date_day == '21'){echo $date_day.'th '.$date_month ." ".$date_year." ";}
    if($date_day == '22'){echo $date_day.'th '.$date_month ." ".$date_year." ";}
    if($date_day == '23'){echo $date_day.'th '.$date_month ." ".$date_year." ";}
    if($date_day == '24'){echo $date_day.'th '.$date_month ." ".$date_year." ";}
    if($date_day == '25'){echo $date_day.'th '.$date_month ." ".$date_year." ";}
    if($date_day == '26'){echo $date_day.'th '.$date_month ." ".$date_year." ";}
    if($date_day == '27'){echo $date_day.'th '.$date_month ." ".$date_year." ";}
    if($date_day == '28'){echo $date_day.'th '.$date_month ." ".$date_year." ";}
    if($date_day == '29'){echo $date_day.'th '.$date_month ." ".$date_year." ";}
    if($date_day == '30'){echo $date_day.'th '.$date_month ." ".$date_year." ";}
    if($date_day == '31'){echo $date_day.'th '.$date_month ." ".$date_year." ";}

    ?>
    </p>

    <div style="font-size:22px; padding-left:200px;">TO WHOM IT MAY CONCERN <br>
    <div style="padding-top:-25px;"> ________________________________________________________</div>

    </div>

    <br>
    This is to certify that <b> {{ $user->first_name.' '.$user->last_name.' '.'(Emp. ID-
        '.$user->company_assigned_id.')' }}, </b>

    worked as
   <b>"{{ $user->userdesignation->designation_name ?? null }}"</b>
    . He served the organization
    from
    <b>{{ $user->joining_date }}</b> to <b>{{ now()->format('d -m-y') }}</b>
    under <b>“Prediction Learning Associates Ltd”</b>.
    <br> <br>
    During this period of his work, we found that he is very punctual, honest and sincere, also
    @if($user->gender == "Male") He @else
    she @endif
    did not take part with any activities against the violation of Code of Conduct in this company. @if($user->gender == "Male") He @else
    she @endif has no liabilities with this company.

    We wish @if($user->gender == "Male") him @else her @endif a prosperous and successful career.
    <br><br><br>

    With Regards,
    <br>
    <p style="padding-left:15px;">
    <img style="height:30px;width:90px;" src="{{asset('idcard/signature.png')}}">
    </p>
   <div style="font-weight:bold;">
    Md. Ariful Islam
    <div>
    <div style="font-size:15px;">
        Managing Director,
    <br>
    Prediction Learning Associates Ltd.
    </div>
    <br>
</div>
@endif
