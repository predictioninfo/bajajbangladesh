{{--
<div class="increment-letter" style="font-size:15px;">
    <p style="font-size:15px;">
        {{ __(' Date: ')}}
        <?php
if($day == '1'){echo $day.'st '.$month." ".$year."";}
if($day == '2'){echo $day.'nd '.$month." ".$year." ";}
if($day == '3'){echo $day.'rd '.$month." ".$year." ";}
if($day == '4'){echo $day.'th '.$month." ".$year." ";}
if($day == '5'){echo $day.'th '.$month." ".$year." ";}
if($day == '6'){echo $day.'th '.$month." ".$year." ";}
if($day == '7'){echo $day.'th '.$month." ".$year." ";}
if($day == '8'){echo $day.'th '.$month." ".$year." ";}
if($day == '9'){echo $day.'th '.$month." ".$year." ";}
if($day == '10'){echo $day.'th '.$month." ".$year." ";}
if($day == '11'){echo $day.'th '.$month." ".$year." ";}
if($day == '12'){echo $day.'th '.$month." ".$year." ";}
if($day == '13'){echo $day.'th '.$month." ".$year." ";}
if($day == '14'){echo $day.'th '.$month." ".$year." ";}
if($day == '15'){echo $day.'th '.$month." ".$year." ";}
if($day == '16'){echo $day.'th '.$month." ".$year." ";}
if($day == '17'){echo $day.'th '.$month." ".$year." ";}
if($day == '18'){echo $day.'th '.$month." ".$year." ";}
if($day == '19'){echo $day.'th '.$month." ".$year." ";}
if($day == '20'){echo $day.'th'.$month." ".$year." ";}
if($day == '21'){echo $day.'th '.$month." ".$year." ";}
if($day == '22'){echo $day.'th '.$month." ".$year." ";}
if($day == '23'){echo $day.'th '.$month." ".$year." ";}
if($day == '24'){echo $day.'th '.$month." ".$year." ";}
if($day == '25'){echo $day.'th '.$month." ".$year." ";}
if($day == '26'){echo $day.'th '.$month." ".$year." ";}
if($day == '27'){echo $day.'th '.$month." ".$year." ";}
if($day == '28'){echo $day.'th '.$month." ".$year." ";}
if($day == '29'){echo $day.'th '.$month." ".$year." ";}
if($day == '30'){echo $day.'th '.$month." ".$year." ";}
if($day == '31'){echo $day.'th '.$month." ".$year." ";}


 ?>
    </P>
    <p style="font-size:15px;">
        {{$employee->transferuser->first_name ?? null}} {{$employee->transferuser->last_name ?? null}}
    </P>
    <p style="font-size:15px;">
        ID NO:{{$employee->transferuser->company_assigned_id ?? null}}
    </P>
    <br>
    <span style="font-size:15px;"> Subject: Transfer order letter. </span>
    </p>

    <p style="font-size:15px;"> {{$employee->transferuser->first_name ?? null}} {{$employee->transferuser->last_name ??
        null}},<br>
        {{-- {{$employee->fromtransfertown->bangla_town_name ?? $employee->fromtransfertown->town_name}}
        {{$employee->transferterritory->bangla_territory_name ?? $employee->transferterritory->territory_name}}
        {{$employee->fromtransferterritory->bangla_territory_name ?? $employee->fromtransferterritory->territory_name}}
        , {{$employee->transferterritory->bangla_territory_name ?? $employee->transferterritory->territory_name}
        --}}

        Thank you for your continued support in business development of our customer company in
        {{$employee->fromtransfertown->town_name ?? null}} region.

    </p>
    You will be glad to know that we have decided to transfer you from {{$employee->fromtransferdbhouse->db_house_name
    ?? null}}, {{$employee->fromtransferterritory->territory_name ?? null}},{{$employee->fromtransfertown->town_name ??
    null}} to {{$employee->transferdbhouse->db_house_name ?? null}}, {{$employee->transfertown->town_name ?? null}} with
    effect from

    <?php

if($transfer_day == '1'){echo $transfer_day .'st '.$transfer_month ." ".$transfer_year ."";}
if($transfer_day == '2'){echo $transfer_day .'nd '.$transfer_month ." ".$transfer_year ." ";}
if($transfer_day == '3'){echo $transfer_day .'rd '.$transfer_month ." ".$transfer_year ." ";}
if($transfer_day == '4'){echo $transfer_day .'th '.$transfer_month ." ".$transfer_year ." ";}
if($transfer_day == '5'){echo $transfer_day .'th '.$transfer_month ." ".$transfer_year ." ";}
if($transfer_day == '6'){echo $transfer_day .'th '.$transfer_month ." ".$transfer_year ." ";}
if($transfer_day == '7'){echo $transfer_day .'th '.$transfer_month ." ".$transfer_year ." ";}
if($transfer_day == '8'){echo $transfer_day .'th '.$transfer_month ." ".$transfer_year ." ";}
if($transfer_day == '9'){echo $transfer_day .'th '.$transfer_month ." ".$transfer_year ." ";}
if($transfer_day == '10'){echo $transfer_day .'th '.$transfer_month ." ".$transfer_year ." ";}
if($transfer_day == '11'){echo $transfer_day .'th '.$transfer_month ." ".$transfer_year ." ";}
if($transfer_day == '12'){echo $transfer_day .'th '.$transfer_month ." ".$transfer_year ." ";}
if($transfer_day == '13'){echo $transfer_day .'th '.$transfer_month ." ".$transfer_year ." ";}
if($transfer_day == '14'){echo $transfer_day .'th '.$transfer_month ." ".$transfer_year ." ";}
if($transfer_day == '15'){echo $transfer_day .'th '.$transfer_month ." ".$transfer_year ." ";}
if($transfer_day == '16'){echo $transfer_day .'th '.$transfer_month ." ".$transfer_year ." ";}
if($transfer_day == '17'){echo $transfer_day .'th '.$transfer_month ." ".$transfer_year ." ";}
if($transfer_day == '18'){echo $transfer_day .'th '.$transfer_month ." ".$transfer_year ." ";}
if($transfer_day == '19'){echo $transfer_day .'th '.$transfer_month ." ".$transfer_year ." ";}
if($transfer_day == '20'){echo $transfer_day .'th'.$transfer_month ." ".$transfer_year ." ";}
if($transfer_day == '21'){echo $transfer_day .'th '.$transfer_month ." ".$transfer_year ." ";}
if($transfer_day == '22'){echo $transfer_day .'th '.$transfer_month ." ".$transfer_year ." ";}
if($transfer_day == '23'){echo $transfer_day .'th '.$transfer_month ." ".$transfer_year ." ";}
if($transfer_day == '24'){echo $transfer_day .'th '.$transfer_month ." ".$transfer_year ." ";}
if($transfer_day == '25'){echo $transfer_day .'th '.$transfer_month ." ".$transfer_year ." ";}
if($transfer_day == '26'){echo $transfer_day .'th '.$transfer_month ." ".$transfer_year ." ";}
if($transfer_day == '27'){echo $transfer_day .'th '.$transfer_month ." ".$transfer_year ." ";}
if($transfer_day == '28'){echo $transfer_day .'th '.$transfer_month ." ".$transfer_year ." ";}
if($transfer_day == '29'){echo $transfer_day .'th '.$transfer_month ." ".$transfer_year ." ";}
if($transfer_day == '30'){echo $transfer_day .'th '.$transfer_month ." ".$transfer_year ." ";}
if($transfer_day == '31'){echo $transfer_day .'th '.$transfer_month ." ".$transfer_year ." ";}
 ?>

    . In your new assigned area, you will report to our Customer Company Officer. Note that your current salary and
    other benefits will remain unchanged.

    </p>
    <p>Best wishes for your new responsibilities.</p>
    <br>
    <div style="width:1200px;">
        <div style="float:left;width:50%;">
            <p style="font-size: 15px;">Thanks,<br>
                <span><img style="height:30px;width:70px;" src="{{asset('idcard/signature.png')}}"></span>
            </p>
            <p style="padding-top:-35px;">__________________ </P>
            <span style="font-size: 15px;">
                Md. Ariful Islam
                <br>
                Managing Director
                <br>
                Prediction Learning Associates Ltd.(PLA)<br>
            </span>
        </div>
    </div>
    --}}
