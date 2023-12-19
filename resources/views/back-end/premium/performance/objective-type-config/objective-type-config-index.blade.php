@extends('back-end.premium.layout.premium-main')
@section('content')
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
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
         <strong class="text-danger">{{ $error }}</strong>
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
         </button>
      </div>
      @endforeach



    <div class="card mb-0">
        <div class="card-header with-border">
            <h1 class="card-title text-center"> {{ __('Objectives List') }} </h1>
            <ol id="breadcrumb1">
                <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                <li><a href="{{('objective-type-creates') }}"><span
                            class="icon icon-plus"> </span>Add</a></li>
                <li><a href="#">List - {{ 'Objectives' }} </a></li>
            </ol>
        </div>
    </div>
   </div>

   <div class="content-box">
      <div class="table-responsive">
         <table id="user-table" class="table table-bordered table-hover table-striped">
            <thead>
               <tr>
                  <th>SL</th>
                  <th>Department</th>
                  <th>Designation</th>
                  @if($edit_permission == 'Yes' || $delete_permission == 'Yes')
                  <th>Action</th>
                  @endif
               </tr>
            </thead>
            <tbody>
               @php($i=1)
               @foreach($objective_type_configs as $objective_type_configs_value)
               <tr>
                  <td>{{$i++}}</td>
                  <td>{{$objective_type_configs_value->departmentfromobjectiveconfig->department_name ?? null}}</td>
                  <td>{{$objective_type_configs_value->designationfromobjectiveconfig->designation_name ?? null}}</td>
                  @if($edit_permission == 'Yes' || $delete_permission == 'Yes')


                  <td>
                    @if($edit_permission == 'Yes')
                    <a href="{{route('edit-objectives-type-configs',$objective_type_configs_value->id)}}" class="btn edit"  data-toggle="tooltip" title=" Edit "
                    data-original-title="Edit" > <i class="fa fa-pencil-square-o" aria-hidden="true"></i> </a>
                    @endif
                    @if($delete_permission == 'Yes')
                    <a href="{{route('delete-objective-type-configs',['id'=>$objective_type_configs_value->id])}}" class="btn btn-danger delete-post" data-toggle="tooltip" title=" Delete "
                    data-original-title="Delete"> <i class="fa fa-trash-o" aria-hidden="true"></i> </a>
                    @endif

                    </td>

                  @endif
               </tr>
               @endforeach
            </tbody>
         </table>
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

      });

</script>
@endsection
