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
                <h1 class="card-title text-center"> {{__('Yearly Festival Bonus List')}} </h1>
                <ol id="breadcrumb1">
                    <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>

                    <li><a href="#" type="button" data-toggle="modal" data-target="#addModal"><span
                                class="icon icon-plus"> </span>Add</a></li>
                    </li>

                    <li><a href="#">List - Yearly Festival Bonus </a></li>
                </ol>
            </div>
        </div>

    </div>

    <!-- Add Modal Starts -->

    <div id="addModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 id="exampleModalLabel" class="modal-title">{{_('Add Yearly Festival Bonus')}}</h5>
                    <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i
                            class="dripicons-cross"></i></button>
                </div>

                <div class="modal-body">
                    <form method="post" action="{{route('add-yearly-festival-bonus-configs')}}" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <label>Employee Name</label> 
                                    <select name="emp_id" class="form-control">
                                        <option value="">Select-a-Employee</option>
                                        @foreach($users as $user)
                                        <option value = "{{$user->id}}">{{ $user->first_name}} {{ $user->last_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                  
                                        <label>{{ __('Yearly Festival Bonus') }} <span class="text-danger">*</span></label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-newspaper-o" aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="text" name="total_bonus"  class="form-control">
                                    </div>
                            </div>
                            
                            <div class="col-sm-12 mt-4">
                                <button class="btn btn-grad" type="submit"> <i class="fa fa-plus"
                                        aria-hidden="true"></i> Add </button>

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
                        <th>{{__('Name')}}</th>
                        <th>{{__('Yearly Bonus')}}</th>
                        <th>{{__('Action')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @php($i = 1)
                    @foreach($yearlyFestivalBonus as $value)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{$value->user->first_name ?? ''}} {{$value->user->last_name ?? ''}}</td>
                        <td>{{$value->total_bonus}}</td>
                        <td>
                            <a href="#" id="edit-post" class="btn edit" data-toggle="modal"
                               data-target="#yearlybonusEditModal{{ $value->id }}" data-id="" data-toggle="tooltip" title=" Edit "
                              data-original-title="Edit" > <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                              <a href="{{ route('yearly-festival-bonus-delete', ['id' => $value->id]) }}"
                                class="btn btn-danger delete-post" data-toggle="tooltip" title=""
                                data-original-title=" Delete "><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>


                    <div id="yearlybonusEditModal{{ $value->id }}" class="modal fade"
                        role="dialog">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 id="exampleModalLabel" class="modal-title">{{ _('Edit') }}</h5>
                                    <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i class="dripicons-cross"></i></button>
                                </div>

                                <div class="modal-body">
                                    <form method="post" action="{{ route('update-yearly-bonus-configs') }}"
                                        class="form-horizontal" enctype="multipart/form-data">

                                        @csrf
                                        <div class="row">

                                            <input type="hidden" name="id"
                                                value="{{ $value->id }}">

                                            <div class="col-md-12 form-group">
                                                <label class="text-bold">{{ __('Employee') }} <span
                                                        class="text-danger">*</span></label>
                                                <select name="emp_id" class="form-control">
                                                    <option value="">Select a Employee</option>
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->id }}" {{ $value->employee_id == $user->id ? 'selected' : '' }}>
                                                            {{ $user->first_name }}  {{ $user->last_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>


                                            <div class="col-md-12">
                                                <div class="input-group mb-3">
                                                    <label>{{ __('Yearly Festival Bonus') }} <span class="text-danger">*</span></label>
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"> <i class="fa fa-newspaper-o" aria-hidden="true"></i> </span>
                                                    </div>
                                                    <input type="text" name="total_bonus" value="{{ $value->total_bonus }}"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-sm-12 mt-4">

                                                <input type="submit" name="action_button"
                                                    class="btn btn-grad" value="{{ __('Edit') }}" />

                                            </div>
                                        </div>

                                    </form>
                                </div>

                            </div>

                        </div>
                    </div>
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
