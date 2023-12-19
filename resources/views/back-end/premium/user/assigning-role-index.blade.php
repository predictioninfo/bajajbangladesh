
@extends('back-end.premium.layout.premium-main')

@section('content')

<?php
use App\Models\Role;

?>

    <section class="main-contant-section">

        <div class="mb-3">
            @if(Session::get('message'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>{{Session::get('message')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>
            @endif

            <div class="card mb-4">
                <div class="card-header with-border">
                    <h1 class="card-title text-center"> {{__('Assigning Role List')}} </h1>
                    <ol id="breadcrumb1">
                        <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                        <li><a href="#">List -Role </a></li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="content-box">

        <div class="table-responsive">
            <table id="user-table" class="table table-bordered table-hover table-striped">
                <thead>
                <tr>
                    <th>{{__('SL')}}</th>
                    <th>{{__('Photo')}}</th>
                    <th>{{__('User')}}</th>
                    <th>{{__('Username')}}</th>
                    <th>{{__('Permission Role')}}</th>
                    <th>{{__('Action')}}</th>
                </tr>
                </thead>
                <tbody>
                @php($i=1)
                @foreach($users as $usersData)
                    <tr>

                        <td>{{$i++}}</td>
                        <td><img class="rounded" width="60" src="{{asset($usersData->profile_photo)}}"></td>
                        <td>{{$usersData->first_name.' '.$usersData->last_name}}</td>
                        <td>{{ $usersData->username}}</td>
                        <td class="text-center">

                            <span class="badge badge-light-success">
                            @if(Role::where('id',$usersData->role_id)->where('roles_com_id','=',Auth::user()->com_id)->exists())
                                <?php
                                $roles = Role::where('id',$usersData->role_id)->where('roles_com_id','=',Auth::user()->com_id)->get(['id','roles_name']);
                                ?>
                                @foreach($roles as $rolesData)
                                {{$rolesData->roles_name}}
                                @endforeach
                                @else
                                {{'Role Not Assigned For This User'}}
                            @endif
                            </span>

                        </td>
                        <td>
                        @if(Role::where('id',$usersData->role_id)->where('roles_com_id','=',Auth::user()->com_id)->where('roles_admin_status','=','Yes')->exists())
                        {{'Admin role can not be changed'}}
                        @elseif($usersData->company_profile === 'Yes')
                        {{'Company Admin Role Can Not Be Changed'}}
                        @else
                            <div class="dropdown">
                                <button class="btn dropdown-toggle" type="button" data-toggle="dropdown"> <i class="fa fa-plus-circle" aria-hidden="true"></i> </button>
                                <ul class="dropdown-menu">
                                    @foreach($user_roles as $user_roles_data)
                                    <li><a href="{{route('users-assigned-roles',['user_id'=>$usersData->id,'role_id'=>$user_roles_data->id])}}"> <button class="btn"> {{$user_roles_data->roles_name}} </button></a></li>
                                    @endforeach

                                </ul>
                            </div>
                        @endif
                        </td>

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


            var i = 1;

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
