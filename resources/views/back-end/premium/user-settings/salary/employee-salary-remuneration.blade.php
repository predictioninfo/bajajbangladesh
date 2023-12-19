@extends('back-end.premium.layout.employee-setting-main')
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

        <div class="card mb-0">
            <div class="card-header with-border">
                <h1 class="card-title text-center"> {{__('Add Salary Remuneration')}} </h1>
                <ol id="breadcrumb1">
                    <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                    {{-- @if($add_permission == "Yes" || (Auth::user()->company_profile == 'Yes')) --}}

                    <li><a href="#" type="button" data-toggle="modal" data-target="#addModal"><span
                                class="icon icon-plus">
                            </span>Add</a></li>
                    {{-- @endif --}}
                    <li><a href="#">List - Salary Remuneration </a></li>
                </ol>
            </div>
        </div>


    </div>


    <!-- Add Modal Starts -->

    <div id="addModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#61c597;">
                    <h5 id="exampleModalLabel" class="modal-title">{{_('Add Gross Salary')}}</h5>
                    <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i
                            class="dripicons-cross"></i></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('add-salary-remunarations')}}" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="employee_id" value="{{Session::get('employee_setup_id')}}">
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label>Basic Salary</label>
                                <input type="number" name="saray_remuneration_basic" placeholder="0"
                                    class="form-control" value="">
                            </div>

                            <div class="col-md-4 form-group">
                                <label>House Rent</label>
                                <input type="number" name="saray_remuneration_house_rent" placeholder="0"
                                    class="form-control" value="">
                            </div>

                            <div class="col-md-4 form-group">
                                <label>Medical</label>
                                <input type="number" name="saray_remuneration_medical" placeholder="0"
                                    class="form-control" value="">
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Conveyance</label>
                                <input type="number" name="saray_remuneration_convence" placeholder="0"
                                    class="form-control" value="">
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Other Allowance</label>
                                <input type="number" name="saray_remuneration_other_allowance" placeholder="0"
                                    class="form-control" value="">
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Gross Salary with Fixed / Variable</label>
                                <input type="number" name="saray_remuneration_gross_salary_with_fixed" placeholder="0"
                                    class="form-control" value="">
                            </div>
                            <br>
                            <div class="col-sm-12">

                                <input type="submit" name="action_button" class="btn btn-primary btn-block"
                                    value="{{__('Add')}}" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Add Modal Ends -->


    <div class="table-responsive">
        <table id="user-table" class="table table-bordered table-hover table-striped">
            <thead style="background-color:#20898f; color:white;">
                <tr>
                    <th>SL</th>
                    <th>{{__('Basic Salary')}}</th>
                    <th>{{__('House Rent')}}</th>
                    <th>{{__('Conveyance')}}</th>
                    <th>{{__('Medical')}}</th>
                    <th>{{__('Other Allowance')}}</th>
                    <th>{{__('Gross Salary with Fixed/Variable')}}</th>
                    <th>{{__('Total')}}</th>
                    <th>{{__('Action')}}</th>
                </tr>
            </thead>
            <tbody>
                @php($i=1)
                @foreach($user_salary_configs as $user_salary_configs)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{$user_salary_configs->saray_remuneration_basic}}
                    </td>
                    <td>{{$user_salary_configs->saray_remuneration_medical}}
                    </td>
                    <td>{{$user_salary_configs->saray_remuneration_house_rent}}
                    </td>
                    <td>{{$user_salary_configs->saray_remuneration_other_allowance}}</td>
                    <td>{{$user_salary_configs->saray_remuneration_convence}}
                    </td>
                    <td>{{$user_salary_configs->saray_remuneration_gross_salary_with_fixed}}</td>
                    <td>{{$user_salary_configs->saray_remuneration_gross_salary_with_fixed}}</td>
                    <td>
                        <a href="#" id="edit-post" class="btn btn-info" data-toggle="modal"
                            data-target="#EditModal{{ $user_salary_configs->id }}">Edit</a>
                    </td>
                </tr>

                <!-- edit Modal starts from here -->
                <div id="EditModal{{$user_salary_configs->id}}" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header" style="background-color:#61c597;">
                                <h5 id="exampleModalLabel" class="modal-title">{{_('Edit')}}</h5>
                                <button type="button" data-dismiss="modal" id="close" aria-label="Close"
                                    class="close"><i class="dripicons-cross"></i></button>
                            </div>

                            <div class="modal-body">
                                <form method="post" action="{{route('add-salary-remunarations')}}"
                                    class="form-horizontal" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="com_id" value="{{ Auth::user()->com_id }}">
                                    <input type="hidden" name="employee_id"
                                        value="{{Session::get('employee_setup_id')}}">
                                    <div class="row">
                                        <div class="col-md-4 form-group">
                                            <label>Basic Salary</label>
                                            <input type="number" name="saray_remuneration_basic" placeholder="0"
                                                class="form-control" value="">
                                        </div>

                                        <div class="col-md-4 form-group">
                                            <label>House Rent</label>
                                            <input type="number" name="saray_remuneration_house_rent" placeholder="0"
                                                class="form-control" value="">
                                        </div>

                                        <div class="col-md-4 form-group">
                                            <label>Medical</label>
                                            <input type="number" name="saray_remuneration_medical" placeholder="0"
                                                class="form-control" value="">
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label>Conveyance</label>
                                            <input type="number" name="saray_remuneration_convence" placeholder="0"
                                                class="form-control" value="">
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label>Other Allowance</label>
                                            <input type="number" name="saray_remuneration_other_allowance"
                                                placeholder="0" class="form-control" value="">
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label>Gross Salary with Fixed / Variable</label>
                                            <input type="number" name="saray_remuneration_gross_salary_with_fixed"
                                                placeholder="0" class="form-control" value="">
                                        </div>
                                        <br>
                                        <div class="col-sm-12">

                                            <input type="submit" name="action_button" class="btn btn-primary btn-block"
                                                value="{{__('Add')}}" />
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>

                    </div>
                </div>

                <!-- edit Modal ends from here -->

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




             // edit form submission starts

          $('#edit_form').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                console.log(formData);
                $('#error-message').text('');

                $.ajax({
                    type:'POST',
                    url: `/update-salary-config`,
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


  } );


</script>



@endsection