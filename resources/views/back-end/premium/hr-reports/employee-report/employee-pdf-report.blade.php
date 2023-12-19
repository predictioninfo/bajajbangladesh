
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Prediction IT</title>
        <style>
            html, body, div {
              font-family: nikosh;
              /*font-size:14px;*/
            }
        </style>
  </head>
  <body>
      @foreach ($employees as $employee)
    <div style="width:900px;padding-right:0px; height: 800px;float:left;">
    <div style="width:850px;">
     <div  style=""> 
         <img src="{{asset($employee->profile_photo)}}" style="max-width:250px; height:100px;text-align:center;padding:15px;"/>    

	  </div>
	   <div style="width:500px;padding-left:300px;float:right; padding-top:-150px;">
           <h3>{{$employee->first_name.' '.$employee->last_name}}</h3>
           <p>Department: {{$employee->userdepartment->department_name ?? null}}</p>
            <p>Designation: {{$employee->userdesignation->designation_name ?? null}}</p> 
            <p>Employee Id: {{$employee->company_assigned_id}}</p>
            <p>Address: {{$employee->address ?? null}} </p>
            <hr>
        </div>
    </div>

    <div style="float:left; width:900px;">
      
        <div style="float:left; width:33%;">
             <p>Email: {{$employee->email}}</p>
             <p>Phone: {{$employee->phone}}</p>
        </div>

        <hr>
    </div>
    <div style="float:left; width:900px;">
        <div style="float:left; width:33%;">
        <p>Identification Type: {{$employee->emoloyeedetail->identification_type ?? null}}</p>
        <p>Identification Number: {{$employee->emoloyeedetail->identification_number ?? null}}</p>
        </div>
        <div style="float:left;width:33%;">
        <p>Gender:Male</p>
        <p>Blood Group: {{$employee->blood_group ?? null}}</p>
        </div>
        <div style="float:left;width:33%;">
        <p>Religion: {{$employee->religion ?? null}}</p>
        <p>Marital Status: {{$employee->emoloyeedetail->marital_status ?? null}}</p>
        </div>
        <hr>
    </div>
        <div style="float:left; width:900px;">
        <div style="float:left; width:33%;">
        <p>Bank Name: {{$employee->bankaccount->bank_name ?? null}}</p>
        <p>Account Type:{{$employee->bankaccount->bank_account_type ?? null}}</p>
        </div>
        <div style="float:left;width:33%;">
        <p>Branch Name:  {{$employee->bankaccount->bank_branch ?? null}}</p>
        <p>Routing Number:{{$employee->bankaccount->bank_account_routing_number ?? null}}</p>
        </div>
        <div style="float:left;width:33%;">
        <p>Bank Account Number: {{$employee->bankaccount->bank_account_number ?? null}}</p>
        <p>Card Number: {{$employee->bankaccount->bank_account_card_number ?? null}}</p>
        </div>
        <hr>
    </div>
    <div style="float:left; width:900px;">
        <div style="float:left; width:33%;">
            <p>Father Name: {{$employee->emoloyeedetail->father_name ?? null}}</p>
            <p>Mother Name: {{$employee->emoloyeedetail->mother_name ?? null}}</p>
        </div>
        <div style="float:left;width:33%;">
            <p>Experience : {{$employee->emoloyeedetail->experience_month ?? null}}</p>
            <p>Previous Organization: {{$employee->emoloyeedetail->previous_organization ?? null}}</p>
        </div>
       

        <hr>
    </div>
    <div style="float:left; width:900px;">
        <div style="float:left;width:33%;">
            <p>Cluster:{{$employee->userregion->region_name ?? null}}</p> 
            <p>Area:{{$employee->userarea->area_name ?? null}}</p>
        </div>
        <div style="float:left;width:33%;">
            <p>Territory:{{$employee->userterritory->territory_name ?? null}}</p>
            <p>Town:{{$employee->usertown->town_name ?? null}}</p>
        </div>
        <div style="float:left;width:33%;">
            <p>DB Point: {{$employee->userdbhouse->db_house_name ?? null}} </p>
        </div>
        <hr>
    </div>
    <div style="float:left; width:900px;">
        <div style="float:left;width:33%;">
            <p>Gross Salary:{{$employee->gross_salary ?? null}}</p>

        </div>
        <div style="float:left;width:33%;">
         <p>Mobile Allowence:{{$employee->mobile_bill ?? null}}</p>
        </div>
        <div style="float:left;width:33%;">
            <p>TA/DA:120 </p>
        </div>
    </div>
<br>
</div>
@endforeach
  </body>
</html>