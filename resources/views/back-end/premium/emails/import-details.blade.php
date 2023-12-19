<!DOCTYPE html>
<html>
<head>
<style>
table{
width: 100%;
border-collapse:collapse;
border: 1px solid black;
}
tr:nth-child(even) {
  background-color: #f2f2f2;
}
table td{line-height:25px;padding-left:15px;border: 1px solid black;}
table th{background-color:#fbc403; color:#363636;border: 1px solid black;}
</style>

</head>
<?php 
 use App\Models\Company;
 $company_names = Company::where('id',Auth::user()->com_id)->first(['company_name']);
?>
<body>


                <div class="container-fluid mb-3">
                   
                        <h3>{{$company_names->company_name}} </h3>                
                   
                </div>


            <table id="user-table" class="table table-bordered table-hover table-striped">
                <thead style="background-color:#00695c; color:white;">
                    <tr>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Region</th>
                        <th>Area</th>
                        <th>Territory</th>
                        <th>Town</th>
                        <th>Column Name</th>
                        <th>Value</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($report_to_parent_ids as $report_to_parent_ids_value)
                    <tr>  
                        <td>Supervisor ID</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>report_to_parent_id</td>
                        <td>{{$report_to_parent_ids_value->id}}</td>
                    </tr>
                    @endforeach 
                    @foreach($importcompanydetails as $payment_histories_value)
                    <tr> 
                        <td>{{$payment_histories_value->company_name}}(company)</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>com_id</td>
                        <td>{{$payment_histories_value->id}}</td>
                     </tr>
                    @endforeach 
                    @foreach($importdepartmentdetails as $payment_histories_value)
                      <tr>                
                        <td>{{$payment_histories_value->department_name}}(department)</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>department_id</td>
                        <td>{{$payment_histories_value->id}}</td>
                     </tr>
                    @endforeach 
                    @foreach($importdesignationdetails as $payment_histories_value)
                    <tr>                 
                        <td>{{$payment_histories_value->designation_name}}(designation)</td>
                        <td>{{$payment_histories_value->designationdepartment->department_name}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>designation_id</td>
                        <td>{{$payment_histories_value->id}}</td>
                     </tr>
                    @endforeach  
                    @foreach($importofficeshiftsdetails as $payment_histories_value)
                    <tr>                   
                        <td>{{$payment_histories_value->shift_name}}(shift)</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>office_shift_id</td>
                        <td>{{$payment_histories_value->id}}</td>
                     </tr>
                    @endforeach 
                    <tr>  
                        <td>General(attendance type)</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>attendance_type</td>
                        <td>general/ip_based</td>
                    </tr>
                    <tr>  
                        <td>Attendance Status</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>attendance_status</td>
                        <td>Yes/No</td>
                    </tr>
                    <tr>  
                        <td>Joining Date(m/d/y)</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>joining_date</td>
                        <td>2/12/2022</td>
                    </tr>
                    <tr>  
                        <td>Gross Salary(example)</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>gross_salary</td>
                        <td>1000</td>
                    </tr>
                    <tr>  
                        <td>Provident Fund Member</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>user_provident_fund_member</td>
                        <td>Yes or Skip This</td>
                    </tr>
                    <tr>  
                        <td>Provident Fund Percentage</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>user_provident_fund</td>
                        <td>10 or skip this</td>
                    </tr>
                    <tr>  
                        <td>Active Employee Status</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>is_active</td>
                        <td>1</td>
                    </tr>  
                    <tr>  
                        <td>Overtime Payable</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>over_time_payable</td>
                        <td>Yes/No</td>
                    </tr>  
                    <tr>  
                        <td>Overtime Type</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>user_over_time_type</td>
                        <td>Automatic/Manual</td>
                    </tr> 
                    <tr>  
                        <td>Overtime Rate(Times of Basic)</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>user_over_time_rate</td>
                        <td>2</td>
                    </tr>  
                    @foreach($importregiondetails as $payment_histories_value)
                    <tr>                 
                        <td>{{$payment_histories_value->region_name}}(region)</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>region_id</td>
                        <td>{{$payment_histories_value->id}}</td>
                     </tr>
                    @endforeach
                    @foreach($importareadetails as $payment_histories_value)
                    <tr>                    
                        <td>{{$payment_histories_value->area_name}}(area)</td>
                        <td></td>
                        <td>{{$payment_histories_value->arearegion->region_name}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>area_id</td>
                        <td>{{$payment_histories_value->id}}</td>
                     </tr>
                    @endforeach
                    @foreach($importterritorydetails as $payment_histories_value)
                    <tr>                     
                        <td>{{$payment_histories_value->territory_name}}(territory)</td>
                        <td></td>
                        <td>{{$payment_histories_value->territoryregion->region_name}}</td>
                        <td>{{$payment_histories_value->territoryarea->area_name}}</td>
                        <td></td>
                        <td></td>
                        <td>territory_id</td>
                        <td>{{$payment_histories_value->id}}</td>
                     </tr>
                    @endforeach  
                    @foreach($importtowndetails as $payment_histories_value)
                    <tr>   
                        <td>{{$payment_histories_value->town_name}}(town)</td>
                        <td></td>
                        <td>{{$payment_histories_value->townregion->region_name}}</td>
                        <td>{{$payment_histories_value->townarea->area_name}}</td>
                        <td>{{$payment_histories_value->townterritory->territory_name}}</td>
                        <td></td>
                        <td>town_id</td>
                        <td>{{$payment_histories_value->id}}</td>
                     </tr>
                    @endforeach  
                    @foreach($importdbdetails as $payment_histories_value)
                    <tr>  
                        <td>{{$payment_histories_value->db_house_name}}(db house)</td>
                        <td></td>
                        <td>{{$payment_histories_value->dbhouseregion->region_name}}</td>
                        <td>{{$payment_histories_value->dbhousearea->area_name}}</td>
                        <td>{{$payment_histories_value->dbhouseterritory->territory_name}}</td>
                        <td>{{$payment_histories_value->dbhousetown->town_name}}</td>
                        <td>db_houses_id</td>
                        <td>{{$payment_histories_value->id}}</td>
                     </tr>
                    @endforeach   
                    @foreach($importroledetails as $payment_histories_value)
                    <tr>                     
                        <td>{{$payment_histories_value->roles_name}}(role)</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>role_id</td>
                        <td>{{$payment_histories_value->id}}</td>
                     </tr>
                    @endforeach  
                    <tr>                     
                        <td>Date of Birth(m/d/y)</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>date_of_birth</td>
                        <td>2/12/2022</td>
                     </tr>
                     <tr>                     
                        <td>Gender</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>gender</td>
                        <td>Male/Female/Other</td>
                     </tr>
                
                
                      
                </tbody>
                
            </table>

            <section>
</div>
 </section>
</body>
</html>