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
        <div class="card mb-4">
            <div class="card-header with-border">
                <h1 class="card-title text-center"> {{__('Late Time Salary Config')}} </h1>
                <ol id="breadcrumb1">
                    <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                    @if ($add_permission == 'Yes')
                    <li><a href="#" type="button" data-toggle="modal" data-target="#addModal"><span
                                class="icon icon-plus"> </span>Add</a></li>
                    @endif
                    <li><a href="#">List - Late Time Salary Config </a></li>
                </ol>
            </div>
        </div>


    </div>


    <!-- Add Modal Starts -->

    <div id="addModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 id="exampleModalLabel" class="modal-title">{{_('Config Late Salary Config')}}</h5>
                    <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i
                            class="dripicons-cross"></i></button>
                </div>

                <div class="modal-body">
                    <form method="post" action="{{route('add-late-time-salary-configs')}}" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <label>Config Late Salary Config Type</label>
                                    <select name="late_time_salary_config" class="form-control selectpicker "
                                        data-live-search="true" data-live-search-style="begins"
                                        title="{{__('Selecting Salary Type')}}..." required>
                                        <option value="Gross">Gross</option>
                                        <option value="Basic">Basic</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-12 mt-4">
                                <button class="btn btn-grad" type="submit"> <i class="fa fa-plus"
                                        aria-hidden="true"></i> Add </button>
                                <!-- <input type="submit" name="action_button" class="btn btn-grad" value="{{__('Add')}}"/> -->

                            </div>
                        </div>

                    </form>
                </div>

            </div>

        </div>
    </div>

    <!-- Add Modal Ends -->
    <div class="content-box">

        <div class="table-responsive">
            <table id="user-table" class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>{{__('SL')}}</th>
                        <th>{{__('Company Name')}}</th>
                        <th>{{__('Late Time Salary Config Type')}}</th>
                        @if($edit_permission == 'Yes' || $delete_permission == 'Yes')
                        <th>{{__('Action')}}</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @php($i=1)

                    <tr>
                        @foreach($late_time_salary_configs as $late_time_salary_config)


                        <td>{{$i++}}</td>
                        <td>{{$late_time_salary_config->lateTimeSalaryConfigCompany->company_name ?? null}}</td>
                        <td>{{$late_time_salary_config->late_time_salary_config ?? null}}</td>
                        @if($edit_permission == 'Yes' || $delete_permission == 'Yes')
                        <td>
                            @if($edit_permission == 'Yes')
                            <a href="#" type="button" data-toggle="modal" data-toggle="tooltip" title=""
                                data-original-title=" Edit " data-target="#editModal" class="btn edit"> <i
                                    class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                            @endif
                            @if($delete_permission == 'Yes')
                            <a href="{{route('delete-late-time-salary-configs')}}" data-toggle="tooltip" title=""
                                data-original-title="Delete" class="btn btn-danger delete-post"><i class="fa fa-trash"
                                    aria-hidden="true"></i> </a>
                            @endif
                        </td>
                        @endif
                        @endforeach
                    </tr>


                </tbody>

            </table>
            <!-- edit Modal Starts -->

            <div id="editModal" class="modal fade" role="dialog">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 id="exampleModalLabel" class="modal-title">{{_('Config Late Salary Config')}}</h5>
                            <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i
                                    class="dripicons-cross"></i></button>
                        </div>

                        <div class="modal-body">
                            <form method="post" action="{{route('add-late-time-salary-configs')}}"
                                class="form-horizontal" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-group mb-3">
                                            <label>Config Late Salary Config Type</label>
                                            <select name="late_time_salary_config" class="form-control selectpicker "
                                                data-live-search="true" data-live-search-style="begins"
                                                title="{{__('Selecting Salary Type')}}..." required>
                                                <option value="Gross">Gross</option>
                                                <option value="Basic">Basic</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 mt-4">
                                        <button class="btn btn-grad" type="submit"> <i class="fa fa-plus"
                                                aria-hidden="true"></i>
                                            Add </button>
                                        <!-- <input type="submit" name="action_button" class="btn btn-grad" value="{{__('Add')}}"/> -->

                                    </div>
                                </div>

                            </form>
                        </div>

                    </div>

                </div>
            </div>

            <!-- Edit Modal Ends -->
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
                    url: 'late-time-config-by-id',
                    data: { id: id },
                    dataType: 'json',
                    success: function(res){
                    $('#ajaxModelTitle').html("Edit");
                    $('#edit-modal').modal('show');
                    $('#id').val(res.id);
                    $('#minimum_countable_time').val(res.minimum_countable_time);
                    $('#minimum_countable_day').val(res.minimum_countable_day);
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


  } );


</script>



@endsection