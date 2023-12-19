@extends('back-end.premium.layout.premium-main')
@section('content')
<?php 
                    
use App\Models\User;

?>

    <section class="main-contant-section">


        <div class="mb-3">

            @if(Session::get('message'))
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <strong>{{Session::get('message')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>
            @endif

            @foreach ($errors->all() as $error)
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <strong class="text-danger">{{ $error }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endforeach
                <div class="card mb-4">
                    <div class="card-header with-border">
                        <h3 class="card-title text-center"> {{__('Employee Selection for Marking')}} </h3>
                    </div>
                    <div class="content-box">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form method="post" action="{{route('supervisor-mark-giving-pages')}}" >
                                     @csrf
                                    <div class="row">

                       
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="text-bold">{{__('Employee')}} <span class="text-danger">*</span></label>

                                                <select name="em_id" id="em_id" required
                                                        class="form-control selectpicker dynamic"
                                                        data-live-search="true" data-live-search-style="begins"
                                                        data-shift_name="shift_name" data-dependent="department_name">
                                                        <option value="">Select-an-Employee</option>
                                                    @foreach($employees as $employees_value)
                                                        <option value="{{$employees_value->id}}">{{$employees_value->first_name}} {{$employees_value->last_name}}</option>
                                                        <?php 
                                                            $second_supervisors = User::where('com_id',Auth::user()->com_id)->where('report_to_parent_id',$employees_value->id)->get();
                                                        ?>
                                                        @foreach($second_supervisors as $second_supervisors_value)
                                                        <option value="{{$second_supervisors_value->id}}">{{$second_supervisors_value->first_name}} {{$second_supervisors_value->last_name}}(as second supervisor)</option>
                                                        @endforeach
                                                    @endforeach
                                                </select>
                                        
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-4">
                                            <div class="form-group">
                                                <div class="form-actions">
                                                    <button type="submit" class="btn btn-grad"><i class="fa fa-plus"></i> {{__('Action')}}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>


                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>

          
        </div>

    </section>

        



<script type="text/javascript">

    $(document).ready( function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });



            //value retriving and opening the edit modal starts

            $('.edit').on('click', function () {
                var id = $(this).data('id');

                $.ajax({
                    type:"POST",
                    url: 'objective-by-id',
                    data: { id: id },
                    dataType: 'json',

                    success: function(res){
                    $('#ajaxModelTitle').html("Edit");
                    $('#edit-modal').modal('show');
                    $('#id').val(res.id);
                    $('#objective_goal_type_id').val(res.objective_goal_type_id);
                    $('#objective_obj_type_id').val(res.objective_obj_type_id);
                    $('#objective_name').val(res.objective_name);
                    $('#objective_success').val(res.objective_success);
                    }
                });
            });

           //value retriving and opening the edit modal ends


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

       



  } );


</script>



@endsection
















