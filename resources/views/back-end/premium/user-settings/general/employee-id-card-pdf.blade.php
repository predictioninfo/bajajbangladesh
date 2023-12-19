
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

<style>
html, body, div {
      font-family: nikosh;
    }
.id-card-holder {
width: 192px;
height: 288px;
   padding: 4px;
   margin: 0 auto;
   background-color: #1f1f1f;
   border-radius: 5px;
   position: relative;
}
/* .id-card-holder:after {
   content: '';
   width: 7px;
   display: block;
   background-color: #0a0a0a;
   height: 100px;
   position: absolute;
   top: 105px;
   border-radius: 0 5px 5px 0;
}
.id-card-holder:before {
   content: '';
   width: 7px;
   display: block;
   background-color: #0a0a0a;
   height: 100px;
   position: absolute;
   top: 105px;
   left: 222px;
   border-radius: 5px 0 0 5px;
} */
.id-card {

background-color: #fff;
padding: 10px;
border-radius: 10px;
text-align: center;
box-shadow: 0 0 1.5px 0px #b9b9b9;
}
.id-card img {
margin: 0 auto;
}
.header img {
width: 100px;
    margin-top: 15px;
}
.photo img {
width: 80px;
    margin-top: 15px;
}
h2 {
font-size: 15px;
margin: 5px 0;
}
h3 {
font-size: 12px;
margin: 2.5px 0;
font-weight: 300;
}
.qr-code img {
width: 50px;
}
p {
font-size: 5px;
margin: 2px;
}
/* .id-card-hook {
background-color: #000;
   width: 70px;
   margin: 0 auto;
   height: 15px;
   border-radius: 5px 5px 0 0;
} */
.id-card-hook:after {
content: '';
   background-color: #d7d6d3;
   width: 47px;
   height: 6px;
   display: block;
   margin: 0px auto;
   position: relative;
   top: 6px;
   border-radius: 4px;
}
.id-card-tag-strip {
width: 45px;
   height: 40px;
   background-color: #0950ef;
   margin: 0 auto;
   border-radius: 5px;
   position: relative;
   top: 9px;
   z-index: 1;
   border: 1px solid #0041ad;
}
.id-card-tag-strip:after {
content: '';
   display: block;
   width: 100%;
   height: 1px;
   background-color: #c1c1c1;
   position: relative;
   top: 10px;
}
.id-card-tag {
width: 0;
height: 0;
border-left: 100px solid transparent;
border-right: 100px solid transparent;
border-top: 100px solid #0958db;
margin: -10px auto -30px auto;
}
.id-card-tag:after {
content: '';
   display: block;
   width: 0;
   height: 0;
   border-left: 50px solid transparent;
   border-right: 50px solid transparent;
   border-top: 100px solid #d7d6d3;
   margin: -10px auto -30px auto;
   position: relative;
   top: -130px;
   left: -50px;
}
</style>


</head>

<body>
<?php
function Bengali_DTN($NRS){
$englDTN = array
('1','2','3','4','5','6','7','8','9','0',
'Saturday','Sunday','Monday','Tuesday','Wednesday','Thursday','Friday',
'Sat','Sun','Mon','Tue','Wed','Thu','Fri',
'am','pm','at','st','nd','rd','th',
'January','February','March','April','May','June','July','August','September','October','November','December',
'Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec','','Permanent','Contactual','Temporary','Project based');
$bangDTN = array
('১','২','৩','৪','৫','৬','৭','৮','৯','০',
'শনিবার','রবিবার','সোমবার','মঙ্গলবার','বুধবার','বৃহস্পতিবার','শুক্রবার',
'শনি','রবি','সোম','মঙ্গল','বুধ','বৃহঃ','শুক্র',
'পূর্বাহ্ণ','অপরাহ্ণ','','','','','',
'জানুয়ারি','ফেব্রুয়ারি','মার্চ','এপ্রিল','মে','জুন','জুলাই','আগস্ট','সেপ্টেম্বর','অক্টোবর','নভেম্বর','ডিসেম্বর',
'জানু','ফেব্রু','মার্চ','এপ্রি','মে','জুন','জুলা','আগ','সেপ্টে','অক্টো','নভে','ডিসে','','স্থায়ী','চুক্তি ভিত্তিক','অস্থায়ী','প্রকল্প ভিত্তিক');
$converted = str_replace($englDTN, $bangDTN, $NRS);
return $converted;
}

?>
<?php
// use App\Models\Department;

// $department_name = Department::where('id','=',Session::get('employee_setup_id'))->first();
?>

	<!--<div class="id-card-holder">-->
	<!--	<div class="id-card">-->
	<!--		<div class="header">-->
	<!--		{{-- <img src="{{base_path()}}{{'/public/'.$company_details_value->company_logo}}"> --}}-->
	<!--		</div>-->
	<!--		<div class="photo">-->
	<!--		 <img class="rounded-circle" src="{{asset($employee_details_value->profile_photo)}}">-->
	<!--		</div>-->
	<!--		<h2>{{$employee_details_value->first_name.' '.$employee_details_value->last_name}}</h2>-->
	<!--		 <h3>ID:{{$employee_details_value->company_assigned_id}}</h3> -->
	<!--		 <p>Department: {{$department_value->department_name}}</p> -->
	<!--		 <p>Designation: {{$designation_value->designation_name}}</p>-->
	<!--		<div class="qr-code">-->
	<!--		<img src="{{asset('idcard/company.png')}}">-->
	<!--		</div>-->
	<!--		<h3>{{$company_details_value->company_web_address}}</h3>-->
	<!--		<hr>-->
	<!--		<p>{{$company_details_value->company_address}}<p>-->
	<!--		<p>Ph: {{$company_details_value->company_phone}} | E-mail:{{$company_details_value->company_email}} </p>-->
<!--height:100px;width:100px;margin-left:33px;text-align: center;padding-left:13px;   height:100px;width:200px;margin-left:15px; margin-right:15px; margin-top:0px;   width:192px; height: 288px; border-radius: 0px; border: 3px solid #430fc5; margin-left:60px;-->
	<!--	</div>-->
	<!--</div>-->

@if($employee_details_value->appointment_letter == "management" )
<div class="container">
<div class="row" style="height:340px;  border-radius: 10px; border: 3px solid #BADA55;">
	<div class="col" style="padding-left:200px; margin-top:5px;">
		<div class="card" style="width:192px; height: 288px; border-radius: 0px; border: 3px solid #430fc5; margin-left:60px;">
		  @if($employee_details_value->company->company_name == "Prediction Info Tech")
		  <img style="height:70px;width:200px;margin-left:25px; margin-right:25px; margin-top:30px;padding-bottom:25px;" src="{{asset('uploads/logos/predictionit.png')}}">
		  @else
		  <img style="height:100px;width:200px;margin-left:15px; margin-right:15px; margin-top:7px;" src="{{asset('idcard/pla_logo.png')}}">
		  @endif

		    <div class="card-body" style="padding-top:-15px;" >
		      <img style="height:100px;width:100px;margin-left:33px;text-align: center;padding-left:13px;" src="{{asset($employee_details_value->profile_photo)}}">
		      <p style="font-size:14px; margin-top:15px; margin-left:5px; text-align: center;">{{$employee_details_value->first_name.' '.$employee_details_value->last_name}}</p>
                    <p class="card-text" style="text-align: center;"><span style=" font-size:9px;">{{$designation_value->designation_name}} - {{$department_value->department_name}}   </span>
                    <br>
                    <span style="; font-size:8px;">Employee ID: {{$employee_details_value->company_assigned_id}}</span>
                    <br>
                    <span style=" font-size:8px;">Job Nature: {{$employee_details_value->employment_type}}</span>
                    <br>
                    <span style=" font-size:8px;">Blood Group: {{$employee_details_value->blood_group}}</span>
                    <br>
                    <span style="font-size:8px;">Joining Date: {{ date('d-m-Y',strtotime($employee_details_value->joining_date)) }}</span>
                    <br>
                    </p>
				</div>

		</div>
	</div>
	<div class="col" style="padding-left:261px; margin-bottom:10px;">
		<div class="card" style="width: 192px; height: 288px; border-radius: 0px; border: 3px solid #430fc5; margin-top:10px;background-image: url('{{ asset('idcard/BACKGROUNDIDCARD.png') }}');background-size: contain;background-repeat: no-repeat;">
		<div class="card-body">
        <p class=" text-justify" style="font-size:12px; text-align:center;margin-top:35px;">{{__('If found, return this to')}}<br><br> <span style="font-size:10px;">
        @if($employee_details_value->company->company_name == "Prediction Info Tech")
        {{__('Prediction Info Tech.')}} <br> <span style="font-size:7px;">{{__('A sister concern of')}}<br>{{__('Prediction Learning Associates Ltd.')}}</span>
        @else
        {{__('Prediction Learning Associates Ltd.')}}
        @endif

        </span> </p>
        <p class="card-text" style="font-size:8px;text-align: center;margin-top:10px">{{__('365/9, Tazin Villa, Level 04, Road 06,')}}<br>{{__('Baridhara DOHS, Dhaka 1206')}}</p>
        <p class="card-text" style="font-size:8px;text-align: center;margin-top:10px">{{__('Phone: +8802-841-3439')}}<br>{{__('www.predictionla.com')}}</p>
	    <p class="card-text" style="font-size:8px;text-align: center;margin-top:15px">{{__('Authorized Signatory')}} <br><br> <span><img style="height:20px;width:50px;" src="{{asset('uploads/signature/signature.png')}}"></span> <br> <span style="background-color:white;color:black;font-weight: bold;">____________________</span><br> <span style="font-size:8px;">{{__('Managing Director')}}</span> </p>
        @if(($employee_details_value->company->company_name == "Prediction Learning Associates Ltd.") || ($employee_details_value->company->company_name == "Prediction Info Tech"))

        @else
        <p class="card-text "style="font-size:8px;text-align: center; margin-top:15px">{{__('Engaged for')}} {{$employee_details_value->company->company_name}}</p>
        @endif



			</div>
		</div>
	</div>
</div>
<br>
<br>
</div>
@endif
@if($employee_details_value->appointment_letter == "nonmanagement" )

	 <?php

	    $joining_date = date('j-F-Y',strtotime($employee_details_value->joining_date));
	    $joining_date_bn= Bengali_DTN("$joining_date");
	    $issue_date = date("Y-m-d");
	    $issue_date = date('j-F-Y',strtotime(date("Y-m-d")));
	    $issue_date_bn = Bengali_DTN("$issue_date ");
	    $Cell_no_bn = Bengali_DTN("$employee_details_value->phone");
	    $identification_number = $employee_details_value->emoloyeedetail->identification_number ?? 0;

	    $idetification_number_bn = Bengali_DTN("$identification_number");
	    $jobnature = $employee_details_value->employment_type;
	    $jobnature_bn =  Bengali_DTN("$jobnature");
	    $assinged_id =$employee_details_value->company_assigned_id;
	    $assinged_id_bn=  Bengali_DTN("$assinged_id");
	  ?>

<div class="row" style="height:250px;">
    <div class="col" style="padding-left:200px; margin-top:3px;">
    <div class="card" style="width: 192px; height: 288px; border-radius: 0px; border: 3px solid #430fc5; margin-left:60px;">


   {{--
    <p style="margin-top:20px;height:100px;width:80px;float:left;"><img style="" src="{{asset('idcard/pla_logo.png')}}"></p>
    <p style="margin-top:10px;height:100px;width:80px;float:right;padding-right:5%;"><span style="font-size:8px;">Outsourced By</span><img style="margin-top:-1px; border-style: solid;border-width: 1px;" src="{{asset($employee_details_value->company->company_logo)}}"></p>
    </div> --}}

       @if($employee_details_value->company->company_name == "Prediction Learning Associates Ltd.")
         <img style="height:100px;width:200px;margin-left:15px; margin-right:15px; margin-top:10px;" src="{{asset('idcard/pla_logo.png')}}">
       @elseif($employee_details_value->company->company_name == "Prediction Info Tech")
         <img style="height:70px;width:200px;margin-left:25px; margin-right:25px; margin-top:30px;padding-bottom:25px;" src="{{asset('uploads/logos/predictionit.png')}}">
       @else
	 <div>
	    <p style="margin-top:20px;height:100px;width:80px;float:left;"><img style="" src="{{asset('idcard/pla_logo.png')}}"></p>
	    <p style="margin-top:10px;height:100px;width:80px;float:right;padding-right:5%;"><span style="font-size:8px;">Outsourced By</span><img style="margin-top:-1px; border-style: solid;border-width: 1px;" src="{{asset($employee_details_value->company->company_logo)}}"></p>
         </div>
        @endif

  {{--  <img style="height:100px;width:200px;margin-left:15px; margin-right:15px; margin-top:-10px;" src="{{asset('idcard/pla_logo.png')}}"> --}}
    <div class="card-body" style="padding-top:1px;">
    <img style="height:70px;width:70px;margin-left:33px;text-align: center;padding-left:27px;margin-top:-30px;" src="{{asset($employee_details_value->profile_photo)}}">
    <p style="font-size:14px; margin-top:2px; margin-left:5px; text-align: center;font-weight:bold;">{{ $employee_details_value->emoloyeedetail->bangla_name ?? null}}</p>
        <p class="card-text" style=" font-size:10px;text-align: center;">
            <span style=" font-size:10px;font-weight:bold;">পদবি:{{$employee_details_value->userdesignation->designation_bangla_name ?? null}}</span> <br>
            <span style="font-size:10px;">ডিপার্টমেন্ট: {{$employee_details_value->userdepartment->department_name_bangla ?? null}}</span><br>
            <span style="font-size:10px;">আই ডি কার্ড :{{$assinged_id_bn}}</span><br>
            <span style="font-size:10px;">কাজের ধরন: {{$jobnature_bn}}</span><br>
            <span style="font-size:10px;">টিকেট/কার্ড :প্ৰযোজ্য নহে </span><br>
            <span style="font-size:10px;">যোগদানের তারিখ :{{$joining_date_bn}}</span>
            <br>
            @if($employee_details_value->employee_signature)
    	    <p style="width:70px;float:left;padding-left:5%;">
            <!--<span style=""><img style="height:10px;width:40px;" src="#"></span><br>-->
            <!--<span style=""><img style="height:10px;width:40px;" src="{{asset('uploads/signature/signature.png')}}"></span><br>-->
            <span style=""> <img style="height:10px;width:40px;" src="{{asset($employee_details_value->employee_signature)}}"></span><br>
    	    <span style="background-color:white;color:black;font-weight: bold;width:40px;padding-right:-30%;">____________________</span> <br>
    	    <span style="font-size:8px;float:right;width:40px;padding-left:3%;">{{__('শ্রমিকের স্বাক্ষর')}}</span>
    	     </p>
    	     @else
    	    <p style="width:70px;float:left;padding-left:5%;">
            <span style="margin-bottom:5px;"></span><br>
    	    <span style="background-color:white;color:black;font-weight: bold;width:40px;padding-right:-30%;">____________________</span> <br>
    	    <span style="font-size:8px;float:right;width:40px;padding-left:3%;">{{__('শ্রমিকের স্বাক্ষর')}}</span>
    	     </p>
    	     @endif
    	     <p style="width:100px;float:right;padding-right:-15%;">
    	    <span style=""><img style="height:10px;width:40px;" src="{{asset('uploads/signature/signature.png')}}"></span> <br>
    	    <span style="background-color:white;color:black;font-weight:bold;width:40px;padding-right:-30%;">________________________</span><br>
    	    <span style="font-size:8px;float:right;width:40px;padding-right:-30%;">{{__('মালিক/ব্যবস্থাপক ')}}</span>
	    </p>
        </p>

    </div>
    </div>
    </div>

	<div class="col" style="padding-left:261px; margin-bottom:10px;">
		<div class="card" style="width: 192px; height: 288px; border-radius: 0px; border: 3px solid #430fc5; margin-top:10px;background-image: url('{{ asset('idcard/BACKGROUNDIDCARD.png') }}');background-size: contain;background-repeat: no-repeat;">
		<div class="card-body">
		<p  class="text-justify" style="font-size:12px; font-weight: bold;margin-top:35px;padding-left:5%;text-align:center">

		  <span style="font-size:10px;">স্থায়ী ঠিকানা:{{ $employee_details_value->emoloyeedetail->permenet_address_bangla ?? null}} </span><br>
		  <span style="font-size:10px;">রক্তের গ্রুপ:{{$employee_details_value->blood_group}}</span><br>
		  <span style="font-size:10px;">ফোন নম্বর:{{$Cell_no_bn}}</span><br>
		  <span style="font-size:10px;">জাতীয় পরিচয়পত্র নং:{{$idetification_number_bn}}</span><br>

		  <span style="font-size:10px;">প্রদানের তারিখ:{{$issue_date_bn }}</span><br>
		  <span style="font-size:10px;">মেয়াদ: চাকরি বলবৎ থাকা পর্যন্ত</span>

		</p>

        <p class=" text-justify" style="font-size:12px; text-align:center;margin-top:10px;">{{__('উক্ত পরিচয়পত্র হারাইয়া গেলে তাৎক্ষণিক ব্যবস্থাপনা কর্তৃপক্ষকে জানাইতে হইবে।')}}<br>
        @if($employee_details_value->company->company_name == "Prediction Info Tech")
        <span style="font-size:11px;">{{__('প্রেডিকশন ইনফো টেক)')}}</span>
        <br> <span style="font-size:7px;">{{__('এ সিস্টার কনসার্ন অফ ')}}<br>{{__('প্রেডিকশন লার্নিং এসোসিয়েটস লিমিটেড (পি এল এ)')}}</span>
        @else
        <span style="font-size:11px;">{{__('প্রেডিকশন লার্নিং এসোসিয়েটস লিমিটেড (পি এল এ)')}}</span>
        @endif
          </p>
        <p class="card-text" style="font-size:8px;text-align: center;">{{__('৩৬৫/৯, তাজিন ভিলা, লেভেল ০৪, রোড ০৬,')}}<br>{{__('বারিধারা ডিওএইচএস, ঢাকা ১২০৬')}}</p>
        <p class="card-text" style="font-size:8px;text-align: center;">{{__('টেলিফোন :+৮৮০২৮৪১৩৪৩৯')}} <br> {{__('জরুরী যোগাযোগ: ০১৭১৩-৩৩৪৮৭৪')}}<br>{{__('www.predictionla.com')}}</p>

        @if(($employee_details_value->company->company_name == "Prediction Learning Associates Ltd.") || ($employee_details_value->company->company_name == "Prediction Info Tech"))

        @else
		<p class="card-text "style="font-size:12px;text-align: center; margin-top:5px">
	{{$employee_details_value->company->company_name_bangla}}   {{__('এর জন্য  নিয়োজিত')}}

  {{--  	    <span style=""><img style="height:30px;width:60px;" src="{{asset('uploads/logos/assianpaints.jpg')}}"></span> <br> --}}
		</p>
        @endif



		</div>
		</div>
	</div>

</div>
<br>
<br>
@endif
</body>
</html>




