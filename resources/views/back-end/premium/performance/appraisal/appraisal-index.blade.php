@extends('back-end.premium.layout.premium-main')
@section('content')

    <section>


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
                <button type="button" class="edit-btn btn btn-secondary mr-2" data-toggle="modal" data-target="#addModal">
                    <i class="fa fa-plus"></i> {{__('Add Appraisal')}}
                </button> 

          
        </div>

            <!-- Add Modal Starts -->

            <div id="addModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header" style="background-color:#61c597;">
                            <h5 id="exampleModalLabel" class="modal-title">{{_('Add Appraisal')}}</h5>
                            <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i class="dripicons-cross"></i></button>
                        </div>

                        <div class="modal-body">
                            <form method="post" action="{{route('add-appraisals')}}" class="form-horizontal" enctype="multipart/form-data">
                                @csrf

                                    <div class="col-md-12 form-group">
                                        <label>Appraisal</label>
                                        <input type="text" name="appraisal_name" class="form-control" value="">
                                    </div>
                                    <br>
                                    <div class="col-sm-12">
                                        <input type="submit" name="action_button" class="btn btn-primary btn-block" value="{{__('Add')}}"/>
                                    </div>
                            </form>
                        </div>

                    </div>

                </div>
            </div>

            <!-- Add Modal Ends -->

    

        <div class="table-responsive">
            <table id="user-table" class="table table-bordered table-hover table-striped">
                <thead style="background-color:#00695c; color:white;">
                    <tr>
                        <th>SL</th>
                        <th>Appraisal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
            
                @php($i=1)
                @foreach($appraisals as $appraisals_value)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$appraisals_value->appraisal_name}}</td>
                        <td>
                 
                            <a href="javascript:void(0)" class="btn btn-primary edit" data-id="{{$appraisals_value->id}}">Edit</a>

                            <a href="{{route('delete-appraisals',['id'=>$appraisals_value->id])}}" class="btn btn-danger delete-post">Delete</a>

                        </td>
                        
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
                    <form method="post" action="{{route('update-appraisals')}}" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id" required>
                        <div class="row">

                     
                            <div class="col-md-12 form-group">
                                <label>Appraisal</label>
                                <input type="text" name="appraisal_name" id="appraisal_name" class="form-control" value="">
                            </div>
           
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary">Save changes</button>
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
                    url: 'appraisal-by-id',
                    data: { id: id },
                    dataType: 'json',

                    success: function(res){
                    $('#ajaxModelTitle').html("Edit");
                    $('#edit-modal').modal('show');
                    $('#id').val(res.id);
                    $('#appraisal_name').val(res.appraisal_name);
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



