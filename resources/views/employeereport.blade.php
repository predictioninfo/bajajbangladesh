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
      @foreach ($employee_report as $employee)
    <div style="width:900px;padding-right:0px; height: 800px;float:left;">
    <div style="width:850px;">
     <div  style=""> 
         <img src="{{asset($employee->profile_photo)}}" style="max-width:250px; height:100px;text-align:center;padding:15px;"/>    

	  </div>
	   <div style="width:500px;padding-left:300px;float:right; padding-top:-150px;">
           <h3>{{$employee->first_name.' '.$employee->last_name}}</h3>
           <p>Department: {{$employee->userdepartment->department_name}}</p>
            <p>Designation: {{$employee->userdesignation->designation_name}}</p> 
            <p>Employee Id: {{$employee->company_assigned_id}}</p>
            <p>Address: {{$employee->employeedetail->permenet_address_english ?? null}} </p>
            <hr>
        </div>
    </div>

    <div style="float:left; width:900px;">
        <div style="float:left;width:33%;">
             <p>EC: 123sdfsd45</p>
             <p>SU Code: 12345</p>
        </div>
        <div style="float:left; width:33%;">
             <p>Email: {{$employee->email}}</p>
             <p>Phone: {{$employee->phone}}</p>
        </div>

        <div style="float:right;width:33%;">
            <p>SR Type: Bioscope</p>
            <p>Name BN: {{$employee->employeedetail->bangla_name ?? null}}</p>
        </div>
        <hr>
    </div>
    <div style="float:left; width:900px;">
        <div style="float:left; width:33%;">
        <p>Identification Type: {{$employee->employeedetail->identification_type ?? null}}</p>
        <p>Identification Number: {{$employee->employeedetail->identification_number ?? null}}</p>
        </div>
        <div style="float:left;width:33%;">
        <p>Gender:Male</p>
        <p>Blood Group: {{$employee->employeedetail->blood_group ?? null}}</p>
        </div>
        <div style="float:left;width:33%;">
        <p>Religion: {{$employee->employeedetail->religion ?? null}}</p>
        <p>Marital Status: </p>
        </div>
        <hr>
    </div>
        <div style="float:left; width:900px;">
        <div style="float:left; width:33%;">
        <p>Bank Name:Dutch Bangla Bank Ltd. {{$employee->bankaccount->bank_name ?? null}}</p>
        <p>Account Type: Core Banking (ATM) {{$employee->bankaccount->father_name ?? null}}</p>
        </div>
        <div style="float:left;width:33%;">
        <p>Branch Name: Mohakhali {{$employee->bankaccount->bank_branch ?? null}}</p>
        <p>Routing Number: 090263194 {{$employee->bankaccount->bank_code ?? null}}</p>
        </div>
        <div style="float:left;width:33%;">
        <p>Bank Account Number:114.103.289832 {{$employee->bankaccount->bank_account_number ?? null}}</p>
        <p>Card Number: 01214051390  {{$employee->bankaccount->bank_code ?? null}}</p>
        </div>
        <hr>
    </div>
    <div style="float:left; width:900px;">
        <div style="float:left; width:33%;">
            <p>Father Name: {{$employee->employeedetail->father_name ?? null}}</p>
            <p>Mother Name: {{$employee->employeedetail->mother_name ?? null}}</p>
        </div>
        <div style="float:left;width:33%;">
            <p>Experience Month: {{$employee->employeedetail->experience_month ?? null}}</p>
            <p>Previous Organization: {{$employee->employeedetail->previous_organization ?? null}}</p>
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
            <p>DB Name: Test sjdfjdk</p>
        </div>
        <hr>
    </div>
    <div style="float:left; width:900px;">
        <div style="float:left;width:33%;">
            <p>Fixed Salary:12752</p>
            <p>Mobile Allowence:300</p>
        </div>
        <div style="float:left;width:33%;">
            <p>Gross Salary:13052</p>

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