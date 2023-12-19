@extends('back-end.premium.layout.premium-main')
@section('content')
<section class="main-contant-section">


    <div class=" mb-3">

        @if(Session::get('message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
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
                <h1 class="card-title text-center"> {{ __('Offical Documnets List') }} </h1>
                <ol id="breadcrumb1">
                    <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                    @if ($add_permission == 'Yes')
                        <li><a href="#" type="button" data-toggle="modal" data-target="#addDepartmentModal"><span
                                    class="icon icon-plus"> </span>Add</a></li>
                    @endif
                    <li><a href="#">List - {{ 'Offical Documnets List' }} </a></li>
                </ol>
            </div>
        </div>
{{-- 
        <div class="d-flex flex-row">
    
            @if($delete_permission == 'Yes')
            <div class="p-1">
                <form method="post" action="{{route('bulk-delete-office-documents')}}" id="sample_form"
                    class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="bulk_delete_com_id" value="{{Auth::user()->com_id}}"
                        class="form-check-input">
                    <input type="submit" class="btn btn-danger w-100" value="{{__('Bulk Delete')}}" />
                </form>
            </div>
            @endif
        </div> --}}

        <div id="addDepartmentModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-md">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 id="exampleModalLabel" class="modal-title">{{_('Add Document')}}</h5>
                        <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i
                                class="dripicons-cross"></i></button>
                    </div>

                    <div class="modal-body">
                        <form method="post" action="{{route('add-official-documents')}}" class="form-horizontal"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <input type="hidden" name="document_uploaded_employee_id">
                                <div class="col-md-12 form-group">
                                    <label for="exampleFormControlSelect1">Document Type</label>
                                    <select class="form-control" name="document_type" required>
                                        <option value="">Select A Type</option>
                                        @foreach ($documnets_types as $documnets_type)
                                        <option value="{{ $documnets_type->variable_type_name }}">{{
                                            $documnets_type->variable_type_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <label for="staticEmail"> Document Title </label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-file-o" aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="text" name="document_title" class="form-control date" value="">
                                    </div>
                                </div>
                                
                                <div class="col-md-12 form-group">
                                    <label>Description:</label>
                                    <textarea name="document_description" class="form-control" rows="5"></textarea>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <label for="staticEmail"> Document File </label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-file-o" aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="file" name="document_file" class="form-control date" value="">
                                    </div>
                                </div>

                                <div class="col-sm-12 mt-4">
                                <button class="btn btn-grad" type = "submit"> <i class="fa fa-plus" aria-hidden="true"></i> Add </button> 
                                    <!-- <input type="submit" name="action_button" class="btn btn-grad"
                                        value="{{__('Add')}}" /> -->

                                </div>
                            </div>

                        </form>
                    </div>

                </div>

            </div>
        </div>

        <div class="content-box">
        <div class="table-responsive">
            <table id="user-table" class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>{{__('SL')}}</th>
                        <th>{{__('Document Uploaded By')}}</th>
                        <th>{{__('Document Employee Name')}}</th>
                        <th>{{__('Document Type')}}</th>
                        <th>{{__('Document Title')}}</th>
                        <th>{{__('Description')}}</th>
                        <th>{{__('Document File')}}</th>
                        @if($edit_permission == 'Yes' || $delete_permission == 'Yes')
                        <th>{{__('Action')}}</th>
                        @endif
                    </tr>
                </thead>
                <tbody>

                    @php($i=1)
                    @foreach($document_details as $document_details_value)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$document_details_value->documentUploadedByEmployee->first_name ?? null }}
                            {{$document_details_value->documentUploadedByEmployee->last_name ?? null}}</td>
                        <td>{{$document_details_value->documentEmployee->first_name ?? null}}
                            {{$document_details_value->documentEmployee->last_name ?? null}}</td>
                        <td>{{$document_details_value->document_type}}</td>
                        <td>{{$document_details_value->document_title}}</td>
                        <td>{{$document_details_value->document_description}}</td>
                        <td><a href="{{asset($document_details_value->document_file)}}" download>Download</a></td>
                        @if($edit_permission == 'Yes' || $delete_permission == 'Yes')
                        <td>
                            @if($edit_permission == 'Yes')
                                <a href="javascript:void(0)" class="btn edit"
                                    data-id="{{$document_details_value->id}}" data-toggle="tooltip" title=" Edit " data-original-title="Edit"> <i
                                    class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                @endif
                                @if($delete_permission == 'Yes')
                                <a href="{{route('delete-employee-documents',['id'=>$document_details_value->id])}}"
                                        class="btn  btn-danger delete-post" data-toggle="tooltip" title=" Delete "
                                        data-original-title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                @endif
                              
                        </td>
                        @endif
                    </tr>
                    @endforeach



                </tbody>

            </table>
        </div>
        </div>


    </div>
</section>





<!-- edit boostrap model -->
<div class="modal fade" id="edit-modal" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="ajaxModelTitle"></h4>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('update-employee-documents') }}" class="form-horizontal"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="row">

                        <div class="col-md-12 form-group">
                            <label for="exampleFormControlSelect1">Document Type</label>
                            <select class="form-control" name="document_type" id="document_type">
                                <option>Select A Type</option>
                                <option value="Certificate">Certificate</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>

                        <div class="col-md-12">
                            <div class="input-group mb-3">
                                <label for="staticEmail"> Document Title </label>
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-file-o" aria-hidden="true"></i> </span>
                                </div>
                                <input type="text" name="document_title" id="document_title" class="form-control date"
                                value="">
                            </div>
                        </div>

                        <div class="col-md-12 form-group">
                            <label>Description:</label>
                            <textarea name="document_description" id="document_description" class="form-control"
                                rows="5"></textarea>
                        </div>
                        <div class="col-md-12">
                            <div class="input-group mb-3">
                                <label for="staticEmail"> Document File </label>
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-file-o" aria-hidden="true"></i> </span>
                                </div>
                                <input type="hidden" name="document_file_hidden" id="document_file"
                                class="form-control date" value="">
                            <input type="file" name="document_file" class="form-control date" value="">
                            </div>
                        </div>
                        
                        <div class="col-sm-offset-2 col-sm-10 mt-4">
                            <button type="submit" class="btn btn-grad ">Save changes</button>
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
             url: 'employee-document-by-id',
             data: { id: id },
             dataType: 'json',
             success: function(res){
             $('#ajaxModelTitle').html("Edit");
             $('#edit-modal').modal('show');
             $('#id').val(res.id);
             $('#document_type').val(res.document_type);
             $('#document_title').val(res.document_title);
             $('#document_description').val(res.document_description);
             $('#document_file').val(res.document_file);
         }
         });
     });

    //value retriving and opening the edit modal ends

     $('#user-table').DataTable({

            "aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],
            "iDisplayLength": 25,
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
