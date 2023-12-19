@extends('back-end.premium.layout.premium-main')

@section('content')

<section class="main-contant-section">


    <div class=" mb-3"></div>

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
                    <h1 class="card-title text-center"> {{__('PF Bank Account List')}} </h1>
                    <ol id="breadcrumb1">
                        <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>

                        <li><a href="#" type="button" data-toggle="modal" data-target="#addDepartmentModal"><span class="icon icon-plus"> </span>Add</a></li>

                        <li><a href="#">List - PF Bank Account   </a></li>
                    </ol>
                </div>
            </div>



           <div id="addDepartmentModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header" style="background-color:#61c597;">
                            <h5 id="exampleModalLabel" class="modal-title">{{_('Add')}}</h5>
                            <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i class="dripicons-cross"></i></button>
                        </div>

                        <div class="modal-body">
                            <form method="post" action="{{route('add-pf-bank-accounts')}}" class="form-horizontal" enctype="multipart/form-data">
                                @csrf

                                <div class="row">


                                    <div class="col-md-4 form-group">
                                        <label>PF Bank Name:</label>
                                        <input type="text" name="providentfund_bankaccount_bank_name" class="form-control" value="">
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label>PF Account No:</label>
                                        <input type="text" name="providentfund_bankaccount_bank_account_number" class="form-control" value="">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>PF Bank Branch:</label>
                                        <input type="text" name="providentfund_bankaccount_branch_name" class="form-control" value="">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>PF Bank Code:</label>
                                        <input type="text" name="providentfund_bankaccount_branch_code" class="form-control" value="">
                                    </div>
                                    <br>

                                    <div class="col-sm-12">

                                        <input type="submit" name="action_button" class="btn btn-primary btn-block" value="{{__('Add')}}"/>

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
                    <thead style="background-color:#20898f; ">
                    <tr>
                        <th>{{__('SL')}}</th>
                        <th>{{__('Bank Name')}}</th>
                        <th>{{__('A/C No')}}</th>
                        <th>{{__('Branch')}}</th>
                        <th>{{__('Bank Code')}}</th>
                        <th>{{__('Action')}}</th>
                    </tr>
                    </thead>
                    <tbody>

                        @php($i=1)
                        @foreach($pf_bank_accounts as $pf_bank_accounts_value)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$pf_bank_accounts_value->providentfund_bankaccount_bank_name}}</td>
                            <td>{{$pf_bank_accounts_value->providentfund_bankaccount_bank_account_number}}</td>
                            <td>{{$pf_bank_accounts_value->providentfund_bankaccount_branch_name}}</td>
                            <td>{{$pf_bank_accounts_value->providentfund_bankaccount_branch_code}}</td>
                            <td>
                                <a href="javascript:void(0)" class="btn btn-primary edit" data-id="{{$pf_bank_accounts_value->id}}">Edit</a>
                                <a href="{{route('delete-pf-bank-accounts',['id'=>$pf_bank_accounts_value->id])}}" class="btn btn-danger delete-post">Delete</a>
                            </td>
                        </tr>
                        @endforeach


                    </tbody>

                </table>
            </div>



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
                    <form method="post" id="edit_form" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label>Bank Name:</label>
                                <input type="text" name="providentfund_bankaccount_bank_name" id="providentfund_bankaccount_bank_name" class="form-control" value="">
                            </div>

                            <div class="col-md-4 form-group">
                                <label>Account No:</label>
                                <input type="text" name="providentfund_bankaccount_bank_account_number" id="providentfund_bankaccount_bank_account_number" class="form-control date" value="">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Bank Branch:</label>
                                <input type="text" name="providentfund_bankaccount_branch_name" id="providentfund_bankaccount_branch_name" class="form-control date" value="">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Bank Code:</label>
                                <input type="text" name="providentfund_bankaccount_branch_code" id="providentfund_bankaccount_branch_code" class="form-control date" value="">
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





             //value retriving and opening the edit modal starts

             $('.edit').on('click', function () {
                var id = $(this).data('id');

                $.ajax({
                    type:"POST",
                    url: 'employee-pf-bank-account-by-id',
                    data: { id: id },
                    dataType: 'json',
                    success: function(res){
                    $('#ajaxModelTitle').html("Edit");
                    $('#edit-modal').modal('show');
                    $('#id').val(res.id);
                    $('#providentfund_bankaccount_bank_name').val(res.providentfund_bankaccount_bank_name);
                    $('#providentfund_bankaccount_bank_account_number').val(res.providentfund_bankaccount_bank_account_number);
                    $('#providentfund_bankaccount_branch_name').val(res.providentfund_bankaccount_branch_name);
                    $('#providentfund_bankaccount_branch_code').val(res.providentfund_bankaccount_branch_code);
                }
                });
            });

           //value retriving and opening the edit modal ends

             // edit form submission starts

          $('#edit_form').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                console.log(formData);
                $('#error-message').text('');

                $.ajax({
                    type:'POST',
                    url: `/update-pf-bank-account`,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        window.location.reload();
                        if (response) {
                        this.reset();
                        alert('Data has been updated successfully');
                        }
                    },
                    error: function(response){
                        console.log(response);
                            $('#error-message').text(response.responseJSON.errors.file);
                    }
                });
            });

            // edit form submission ends





   });

    </script>
@endsection
