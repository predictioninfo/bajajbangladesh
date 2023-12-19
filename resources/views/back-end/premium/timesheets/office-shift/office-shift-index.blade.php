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
                <h1 class="card-title text-center"> {{__('Office Shift')}} </h1>

                <ol id="breadcrumb1">
                    <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                    @if($add_permission == 'Yes')
                    <li><a href="#" type="button" data-toggle="modal" data-target="#addDepartmentModal"><span
                                class="icon icon-plus"> </span>Add</a></li>
                    @endif
                    <li><a href="#">List - Office Shift </a></li>
                </ol>

            </div>
        </div>

        <div id="addDepartmentModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 id="exampleModalLabel" class="modal-title">{{_('Add Office Shift')}}</h5>
                        <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i
                                class="dripicons-cross"></i></button>
                    </div>

                    <div class="modal-body ">
                        <form method="post" action="{{route('add-shifts')}}" class="form-horizontal row"
                            enctype="multipart/form-data">
                            @csrf
                            {{-- <div class="col-md-2"></div> --}}
                            {{-- <div class="container">
                                <div class="row align-items-center">
                                    <div class=" form-group  align-middle">
                                        <label>{{__('Office Shift Name')}}</label>
                                        <select class="form-control" name="shift_name">
                                            <option>Choose a Shift</option>
                                            @foreach($office_shift_types as $office_shift_types)
                                            <option value="{{$office_shift_types->variable_type_name}}">
                                                {{$office_shift_types->variable_type_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div> --}}
                            {{-- <div class="col-md-2"></div> --}}
                            <div class="container">
                                <div class="row align-items-center">
                                    <div class="form-group col-md-8 mx-auto">
                                        <!-- Add mx-auto class here -->
                                        <label>{{__('Office Shift Name')}}</label>
                                        <select class="form-control" name="shift_name">
                                            <option>Choose a Shift</option>
                                            @foreach($office_shift_types as $office_shift_type)
                                            <option value="{{$office_shift_type->variable_type_name}}">
                                                {{$office_shift_type->variable_type_name}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <label>{{__('Sunday In')}} *</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-clock-o" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="time" name="sunday_in" value="" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <label>{{__('Sunday Out')}} *</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-clock-o" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="time" name="sunday_out" value="" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <label>{{__('Monday In')}} *</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-clock-o" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="time" name="monday_in" value="" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <label>{{__('Monday Out')}} *</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-clock-o" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="time" name="monday_out" value="" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <label>{{__('Tuesday In')}} *</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-clock-o" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="time" name="tuesday_in" value="" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <label>{{__('Tuesday Out')}} *</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-clock-o" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="time" name="tuesday_out" value="" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <label>{{__('Wednesday In')}} *</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-clock-o" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="time" name="wednesday_in" value="" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <label>{{__('Wednesday Out')}} *</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-clock-o" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="time" name="wednesday_out" value="" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <label>{{__('Thursday In')}} *</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-clock-o" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="time" name="thursday_in" value="" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <label>{{__('Thursday Out')}} *</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-clock-o" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="time" name="thursday_out" value="" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <label>{{__('Friday In')}} *</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-clock-o" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="time" name="friday_in" value="" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <label>{{__('Friday Out')}} *</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-clock-o" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="time" name="friday_out" value="" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <label>{{__('Saturday In')}} *</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-clock-o" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="time" name="saturday_in" value="" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <label>{{__('Saturday Out')}} *</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-clock-o" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="time" name="saturday_out" value="" class="form-control">
                                </div>
                            </div>

                            <div class=" col-md-12 mt-4">
                                <button class="btn btn-grad" type="submit"> <i class="fa fa-plus"
                                        aria-hidden="true"></i> Add </button>
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
                            <th>{{__('Shift Name')}}</th>
                            <th>{{__('Sunday')}}</th>
                            <th>{{__('Monday')}}</th>
                            <th>{{__('Tuesday')}}</th>
                            <th>{{__('Wednesday')}}</th>
                            <th>{{__('Thursday')}}</th>
                            <th>{{__('Friday')}}</th>
                            <th>{{__('Saturday')}}</th>
                            @if($edit_permission == 'Yes' || $delete_permission == 'Yes')
                            <th>{{__('Action')}}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>

                        @php($i = 1)
                        @foreach($office_shifts as $office_shifts_value)
                        <tr>

                            <td>{{$i++}}</td>
                            <td>{{ $office_shifts_value->shift_name}}</td>
                            @if(isset($office_shifts_value->sunday_in) && isset($office_shifts_value->sunday_out))
                            <td>{{date('g:i A', strtotime($office_shifts_value->sunday_in)).' To '.date('g:i A',
                                strtotime($office_shifts_value->sunday_out))}}</td>
                            @else
                            <td></td>
                            @endif
                            @if(isset($office_shifts_value->monday_in) && isset($office_shifts_value->monday_out))
                            <td>{{date('g:i A', strtotime($office_shifts_value->monday_in)).' To '.date('g:i A',
                                strtotime($office_shifts_value->monday_out))}}</td>
                            @else
                            <td></td>
                            @endif
                            @if(isset($office_shifts_value->tuesday_in) && isset($office_shifts_value->tuesday_out))
                            <td>{{date('g:i A', strtotime($office_shifts_value->tuesday_in)).' To '.date('g:i A',
                                strtotime($office_shifts_value->tuesday_out))}}</td>
                            @else
                            <td></td>
                            @endif
                            @if(isset($office_shifts_value->wednesday_in) && isset($office_shifts_value->wednesday_out))
                            <td>{{date('g:i A', strtotime($office_shifts_value->wednesday_in)).' To '.date('g:i A',
                                strtotime($office_shifts_value->wednesday_out))}}</td>
                            @else
                            <td></td>
                            @endif
                            @if(isset($office_shifts_value->thursday_in) && isset($office_shifts_value->thursday_out))
                            <td>{{date('g:i A', strtotime($office_shifts_value->thursday_in)).' To '.date('g:i A',
                                strtotime($office_shifts_value->thursday_out))}}</td>
                            @else
                            <td></td>
                            @endif
                            @if(isset($office_shifts_value->friday_in) && isset($office_shifts_value->friday_out))
                            <td>{{date('g:i A', strtotime($office_shifts_value->friday_in)).' To '.date('g:i A',
                                strtotime($office_shifts_value->friday_out))}}</td>
                            @else
                            <td></td>
                            @endif
                            @if(isset($office_shifts_value->saturday_in) && isset($office_shifts_value->saturday_out))
                            <td>{{date('g:i A', strtotime($office_shifts_value->saturday_in)).' To '.date('g:i A',
                                strtotime($office_shifts_value->saturday_out))}}</td>
                            @else
                            <td></td>
                            @endif

                            @if($edit_permission == 'Yes' || $delete_permission == 'Yes')
                            <td>
                                @if($edit_permission == 'Yes')

                                <a href="#" id="edit-post" data-toggle="modal"
                                    data-target="#departmentEditModal{{ $office_shifts_value->id }}" class="btn edit"
                                    data-id="" data-toggle="tooltip" title=" Edit " data-original-title="Edit"><i
                                        class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                @endif

                                @if($delete_permission == 'Yes')

                                <a href="{{route('delete-office-shifts',['id'=>$office_shifts_value->id])}}"
                                    class="btn btn-danger delete-post" data-toggle="tooltip" title=" Delete "
                                    data-original-title="Delete"> <i class="fa fa-trash-o" aria-hidden="true"></i></a>

                            </td>
                            @endif

                            @endif
                        </tr>
                        <div id="departmentEditModal{{$office_shifts_value->id}}" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <div class="modal-header" style="background-color:#61c597;">
                                        <h5 id="exampleModalLabel" class="modal-title">{{_('Edit')}}</h5>
                                        <button type="button" data-dismiss="modal" id="close" aria-label="Close"
                                            class="close"><i class="dripicons-cross"></i></button>
                                    </div>

                                    <div class="modal-body row">
                                        <form method="post" action="{{route('update-shifts')}}" class="form-horizontal"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <input type="hidden" name="id" value="{{$office_shifts_value->id}}">
                                            <input type="hidden" name="shift_name"
                                                value="{{$office_shifts_value->shift_name}}">

                                            <div class="col-md-4">
                                                <div class="input-group mb-3">
                                                    <label>{{__('Sunday In')}} *</label>
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"> <i class="fa fa-clock-o"
                                                                aria-hidden="true"></i> </span>
                                                    </div>
                                                    <input type="time" name="sunday_in"
                                                        value="{{$office_shifts_value->sunday_in}}"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="input-group mb-3">
                                                    <label>{{__('Sunday Out')}} *</label>
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"> <i class="fa fa-clock-o"
                                                                aria-hidden="true"></i> </span>
                                                    </div>
                                                    <input type="time" name="sunday_out"
                                                        value="{{$office_shifts_value->sunday_out}}"
                                                        class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="input-group mb-3">
                                                    <label>{{__('Monday In')}} *</label>
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"> <i class="fa fa-clock-o"
                                                                aria-hidden="true"></i> </span>
                                                    </div>
                                                    <input type="time" name="monday_in"
                                                        value="{{$office_shifts_value->monday_in}}"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="input-group mb-3">
                                                    <label>{{__('Monday Out')}} *</label>
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"> <i class="fa fa-clock-o"
                                                                aria-hidden="true"></i> </span>
                                                    </div>
                                                    <input type="time" name="monday_out"
                                                        value="{{$office_shifts_value->monday_out}}"
                                                        class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="input-group mb-3">
                                                    <label>{{__('Tuesday In')}} *</label>
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"> <i class="fa fa-clock-o"
                                                                aria-hidden="true"></i> </span>
                                                    </div>
                                                    <input type="time" name="tuesday_in"
                                                        value="{{$office_shifts_value->tuesday_in}}"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="input-group mb-3">
                                                    <label>{{__('Tuesday Out')}} *</label>
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"> <i class="fa fa-clock-o"
                                                                aria-hidden="true"></i> </span>
                                                    </div>
                                                    <input type="time" name="tuesday_out"
                                                        value="{{$office_shifts_value->tuesday_out}}"
                                                        class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="input-group mb-3">
                                                    <label>{{__('Wednesday In')}} *</label>
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"> <i class="fa fa-clock-o"
                                                                aria-hidden="true"></i> </span>
                                                    </div>
                                                    <input type="time" name="wednesday_in"
                                                        value="{{$office_shifts_value->wednesday_in}}"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="input-group mb-3">
                                                    <label>{{__('Wednesday Out')}} *</label>
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"> <i class="fa fa-clock-o"
                                                                aria-hidden="true"></i> </span>
                                                    </div>
                                                    <input type="time" name="wednesday_out"
                                                        value="{{$office_shifts_value->wednesday_out}}"
                                                        class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="input-group mb-3">
                                                    <label>{{__('Thursday In')}} *</label>
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"> <i class="fa fa-clock-o"
                                                                aria-hidden="true"></i> </span>
                                                    </div>
                                                    <input type="time" name="thursday_in"
                                                        value="{{$office_shifts_value->thursday_in}}"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="input-group mb-3">
                                                    <label>{{__('Thursday Out')}} *</label>
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"> <i class="fa fa-clock-o"
                                                                aria-hidden="true"></i> </span>
                                                    </div>
                                                    <input type="time" name="thursday_out"
                                                        value="{{$office_shifts_value->thursday_out}}"
                                                        class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="input-group mb-3">
                                                    <label>{{__('Friday In')}} *</label>
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"> <i class="fa fa-clock-o"
                                                                aria-hidden="true"></i> </span>
                                                    </div>
                                                    <input type="time" name="friday_in"
                                                        value="{{$office_shifts_value->friday_in}}"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="input-group mb-3">
                                                    <label>{{__('Friday Out')}} *</label>
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"> <i class="fa fa-clock-o"
                                                                aria-hidden="true"></i> </span>
                                                    </div>
                                                    <input type="time" name="friday_out"
                                                        value="{{$office_shifts_value->friday_out}}"
                                                        class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="input-group mb-3">
                                                    <label>{{__('Saturday In')}} *</label>
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"> <i class="fa fa-clock-o"
                                                                aria-hidden="true"></i> </span>
                                                    </div>
                                                    <input type="time" name="saturday_in"
                                                        value="{{$office_shifts_value->saturday_in}}"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="input-group mb-3">
                                                    <label>{{__('Saturday Out')}} *</label>
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"> <i class="fa fa-clock-o"
                                                                aria-hidden="true"></i> </span>
                                                    </div>
                                                    <input type="time" name="saturday_out"
                                                        value="{{$office_shifts_value->saturday_out}}"
                                                        class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-12 mt-4">
                                                <input type="submit" name="action_button" class="btn btn-grad"
                                                    value="{{__('Update')}}" />
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