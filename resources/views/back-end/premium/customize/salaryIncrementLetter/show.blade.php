<style>
    th,
    td {
        padding: 5px;
    }

    th {
        text-align: left;
    }
</style>


<div>

<?php
$date = date('j F, Y');

?>

    Date: {{ $date }} <br><br>
    Name: {{ "MR.XYZ" }} <br>
    Designation: {{ "Designation" }} <br>
    Department: {{ "Designation" }} <br><br>
    <span style="font-weight:bold;"> Subject: <b>{{  $incremenrt_letters->subject }}</b></span><br><br>

    Dear {{ "MR:XYZ" }} ,<br><br>

    <p>    {!! strip_tags($incremenrt_letters->body) ?? null !!} </p>
    <p> The amount of your salary increased is BDT. -TK  </p>


    <br>

     
        <div style="padding-left:120px">
            <table class="table" style="width:10%">
                <tbody>
                   
                    <tr>
                        <td style="border: 1px solid black;font-size: 12px;" colspan="2">Basic Salary</td>
                        <td style="border: 1px solid black;text-align:right;font-size: 12px; " colspan="2"> -TK </td>
                    </tr>
                  
                    <tr>
                        <td style="border: 1px solid black;font-size: 12px;" colspan="2">Medical allowance</td>
                        <td style="border: 1px solid black;text-align:right;font-size: 12px; " colspan="2"> -TK</td>
                    </tr>
                
                    <tr>
                        <td style="border: 1px solid black;font-size: 12px;" colspan="2">House Rent</td>
                        <td style="border: 1px solid black;text-align:right;font-size: 12px; " colspan="2"> -TK</td>
                    </tr>
                  
                    <tr>
                        <td style="border: 1px solid black;font-size: 12px;" colspan="2">Convence Allowance</td>
                        <td style="border: 1px solid black;text-align:right;font-size: 12px; " colspan="2"> -TK</td>
                    </tr>
              
                    <tr>
                        <td style="border: 1px solid black;font-size: 12px;" colspan="2">Total</td>
                        <td style="border: 1px solid black;text-align:right;font-size: 12px; " colspan="2"> -TK</td>
                    </tr>
    
                </tbody>
            </table>
        </div>

           

    </div>
    <br><br>

    <span > These changes will come into effect  from  .</span> <span><br><br>

    <span>{!! strip_tags($incremenrt_letters->extra_feture) ?? null !!}</span> <br><br>


    <div style="width:1200px;">
        <div style="float:left;width:50%;">
            <p>Yours Sincerely,<br>
                <span><img style="height:30px;width:70px;" src="{{asset($incremenrt_letters->signature)}}"></span>
            </p>
            <p style="padding-top:-35px;">__________________ </P>
            <span >
                Md. Ariful Islam
                <br>
                Managing Director
                <br>
                Prediction Learning Associates Ltd.(PLA)<br>
            </span>
        </div>
    </div>


</div>
