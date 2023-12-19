
@extends('back-end.premium.layout.premium-main')

@section('content')




    <section>

        <div class="container-fluid"><span id="general_result"></span></div>


 

        <div class="table-responsive">
            <table id="user-table" class="table table-bordered table-hover table-striped">
                <thead style="background-color:#343a40; color:white;">
                <tr>
                    
                    <th>{{__('Cluster')}}</th>
                    <th>{{__('Area')}}</th>
                    <th>{{__('Territory')}}</th>
                    <th>{{__('Town')}}</th>
                    <th>{{__('DB_Point_Id')}}</th>
                    <th>{{__('Db Point')}}</th>                                       
                   
                </tr>
                </thead>
                <tbody>
 
                @foreach($db_house as $usersData)
                <tr>
                
                   
                    <td>{{$usersData->db_house_region_id}}</td>
                    <td>{{$usersData->db_house_area_id}}</td>
                    <td>{{ $usersData->db_house_territory_id}}</td>
                    <td>{{ $usersData->db_house_town_id}}</td>
                     <td>{{$usersData->id}}</td>
                    <td>{{ $usersData->db_house_name}}</td>


              
                </tr>

                @endforeach
                </tbody>

            </table>
        </div>
    </section>
    
 
    <script type="text/javascript">

      $(document).ready( function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    

            var i = 1;
            

            $('#user-table').DataTable({
                
               

                    dom: '<"row"lfB>rtip',
                    
                    buttons: [
                        {
                            extend: 'pdf',
                            text: '<i title="export to pdf" class="fa fa-file-pdf-o"></i>',
                            exportOptions: {
                                columns: ':visible:Not(.not-exported)',
                                rows: ':visible'
                            },
                        },
                        {
                            extend: 'csv',
                            text: '<i title="export to csv" class="fa fa-file-text-o"></i>',
                            exportOptions: {
                                columns: ':visible:Not(.not-exported)',
                                rows: ':visible'
                            },
                        },
                        {
                            extend: 'print',
                            text: '<i title="print" class="fa fa-print"></i>',
                            exportOptions: {
                                columns: ':visible:Not(.not-exported)',
                                rows: ':visible'
                            },
                        },
                        {
                            extend: 'colvis',
                            text: '<i title="column visibility" class="fa fa-eye"></i>',
                            columns: ':gt(0)'
                        },
                    ],
                });



        $('#company_id').on('change', function() {
               var companyID = $(this).val();
               if(companyID) {
                   $.ajax({
                       url: '/get-department/'+companyID,
                       type: "GET",
                       data : {"_token":"{{ csrf_token() }}"},
                       dataType: "json",
                       success:function(data)
                       {
                         if(data){
                            $('#department_id').empty();
                            $('#department_id').append('<option hidden>Choose Department</option>'); 
                            $.each(data, function(key, departments){
                                $('select[name="department_id"]').append('<option value="'+ departments.id +'">' + departments.department_name+ '</option>');
                            });
                        }else{
                            $('#departments').empty();
                        }
                     }
                   });
               }else{
                 $('#departments').empty();
               }
            });

        $('#department_id').on('change', function() {
               var departmentID = $(this).val();
               if(departmentID) {
                   $.ajax({
                       url: '/get-designation/'+departmentID,
                       type: "GET",
                       data : {"_token":"{{ csrf_token() }}"},
                       dataType: "json",
                       success:function(data)
                       {
                         if(data){
                            $('#designation_id').empty();
                            $('#designation_id').append('<option hidden>Choose Designation</option>'); 
                            $.each(data, function(key, designations){
                                $('select[name="designation_id"]').append('<option value="'+ designations.id +'">' + designations.designation_name+ '</option>');
                            });
                        }else{
                            $('#designations').empty();
                        }
                     }
                   });
               }else{
                 $('#designations').empty();
               }
        });

        $('#company_id').on('change', function() {
               var companyID = $(this).val();
               if(companyID) {
                   $.ajax({
                       url: '/get-office-shift/'+companyID,
                       type: "GET",
                       data : {"_token":"{{ csrf_token() }}"},
                       dataType: "json",
                       success:function(data)
                       {
                         if(data){
                            $('#office_shift_id').empty();
                            $('#office_shift_id').append('<option hidden>Choose Office Shift</option>'); 
                            $.each(data, function(key, office_shifts){
                                $('select[name="office_shift_id"]').append('<option value="'+ office_shifts.id +'">' + office_shifts.shift_name+ '</option>');
                            });
                        }else{
                            $('#office_shifts').empty();
                        }
                     }
                   });
               }else{
                 $('#office_shifts').empty();
               }
            });
            

            
        $('#region_id').on('change', function() {
               var regionID = $(this).val();
               if(regionID) {
                   $.ajax({
                       url: '/get-area/'+regionID,
                       type: "GET",
                       data : {"_token":"{{ csrf_token() }}"},
                       dataType: "json",
                       success:function(data)
                       {
                         if(data){
                            $('#area_id').empty();
                            $('#area_id').append('<option hidden>Choose Area</option>'); 
                            $.each(data, function(key, areas){
                                $('select[name="area_id"]').append('<option value="'+ areas.id +'">' + areas.area_name+ '</option>');
                            });
                        }else{
                            $('#areas').empty();
                        }
                     }
                   });
               }else{
                 $('#areas').empty();
               }
            });

                       
        $('#area_id').on('change', function() {
               var areaID = $(this).val();
               if(areaID) {
                   $.ajax({
                       url: '/get-territory/'+areaID,
                       type: "GET",
                       data : {"_token":"{{ csrf_token() }}"},
                       dataType: "json",
                       success:function(data)
                       {
                         if(data){
                            $('#territory_id').empty();
                            $('#territory_id').append('<option hidden>Choose Territory</option>'); 
                            $.each(data, function(key, territories){
                                $('select[name="territory_id"]').append('<option value="'+ territories.id +'">' + territories.territory_name+ '</option>');
                            });
                        }else{
                            $('#territories').empty();
                        }
                     }
                   });
               }else{
                 $('#territories').empty();
               }
            });

            $('#territory_id').on('change', function() {
               var territoryID = $(this).val();
               if(territoryID) {
                   $.ajax({
                       url: '/get-town/'+territoryID,
                       type: "GET",
                       data : {"_token":"{{ csrf_token() }}"},
                       dataType: "json",
                       success:function(data)
                       {
                         if(data){
                            $('#town_id').empty();
                            $('#town_id').append('<option hidden>Choose Town</option>'); 
                            $.each(data, function(key, towns){
                                $('select[name="town_id"]').append('<option value="'+ towns.id +'">' + towns.town_name+ '</option>');
                            });
                        }else{
                            $('#towns').empty();
                        }
                     }
                   });
               }else{
                 $('#towns').empty();
               }
            });

            $('#town_id').on('change', function() {
               var townID = $(this).val();
               if(townID) {
                   $.ajax({
                       url: '/get-db-house/'+townID,
                       type: "GET",
                       data : {"_token":"{{ csrf_token() }}"},
                       dataType: "json",
                       success:function(data)
                       {
                         if(data){
                            $('#db_house_id').empty();
                            $('#db_house_id').append('<option hidden>Choose Town</option>'); 
                            $.each(data, function(key, db_houses){
                                $('select[name="db_house_id"]').append('<option value="'+ db_houses.id +'">' + db_houses.db_house_name+ '</option>');
                            });
                        }else{
                            $('#db_houses').empty();
                        }
                     }
                   });
               }else{
                 $('#db_houses').empty();
               }
            });

         



   });

    </script>


@endsection





                  

        
      