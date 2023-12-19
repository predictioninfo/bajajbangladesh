@extends('back-end.premium.layout.premium-main')
@section('content')

    <section class="main-contant-section">


        <div class="container-fluid mb-3">

            @if(Session::get('message'))
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <strong>{{Session::get('message')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>
            @endif

            @foreach ($errors->all() as $error)
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong class="text-danger">{{ $error }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endforeach

            @if($add_permission == 'Yes')
                <button type="button" class="edit-btn btn btn-grad mr-2" data-toggle="modal" data-target="#addModal">
                    <i class="fa fa-plus"></i> {{__('Add Goal Type')}}
                </button> 
            @endif

          
        </div>

        @if($add_permission == 'Yes')
            <!-- Add Modal Starts -->
            <div id="addModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 id="exampleModalLabel" class="modal-title">{{_('Add Goal Type')}}</h5>
                            <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i class="dripicons-cross"></i></button>
                        </div>

                        <div class="modal-body">
                            <form method="post" action="{{route('add-goal-types')}}" class="form-horizontal" enctype="multipart/form-data">
                                @csrf

                                    <div class="col-md-12 form-group">
                                        <label>Goal Type</label>
                                        <input type="text" name="goal_type_name" class="form-control" value="">
                                    </div>
                                    <br>
                                    <div class="col-sm-12">
                                        <input type="submit" name="action_button" class="btn btn-grad w-50" value="{{__('Add')}}"/>
                                    </div>
                            </form>
                        </div>

                    </div>

                </div>
            </div>
            <!-- Add Modal Ends -->
        @endif

        <div class="table-responsive">
            <table id="user-table" class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Goal Type</th>
                        @if($edit_permission == 'Yes' || $delete_permission == 'Yes')
                        <th>Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
          
                @php($i=1)
                @foreach($goal_types as $goal_types_value)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$goal_types_value->goal_type_name}}</td>
                        @if($edit_permission == 'Yes' || $delete_permission == 'Yes')
                        <td>
                        <div class="dropdown">
                            <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">
                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                            </button>
                            <ul class="dropdown-menu">
                            @if($edit_permission == 'Yes')
                            <a href="javascript:void(0)" class="btn edit" data-id="{{$goal_types_value->id}}">Edit</a>
                            @endif
                            @if($delete_permission == 'Yes')
                            <a href="{{route('delete-goal-types',['id'=>$goal_types_value->id])}}" class="btn delete-post">Delete</a>
                            @endif
                            </ul>
                        </div>
                            
                        </td>
                        @endif
                        
                    </tr>
                @endforeach
                   
                </tbody>
                
            </table>

        </div>
    </section>



            <!-- edit boostrap model -->
            <div class="modal fade" id="edit-modal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="ajaxModelTitle"></h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('update-goal-types')}}" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id" required>
                        <div class="row">

                     
                            <div class="col-md-12 form-group">
                                <label>Goal Type</label>
                                <input type="text" name="goal_type_name" id="goal_type_name" class="form-control" value="">
                            </div>
           
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-grad w-50">Save changes</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    
                </div>
                </div>
            </div>
            </div>
        <!-- end bootstrap model -->






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
                url: 'goal-type-by-id',
                data: { id: id },
                dataType: 'json',

                success: function(res){
                $('#ajaxModelTitle').html("Edit");
                $('#edit-modal').modal('show');
                $('#id').val(res.id);
                $('#goal_type_name').val(res.goal_type_name);
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
















