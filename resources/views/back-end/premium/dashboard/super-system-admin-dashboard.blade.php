@extends('back-end.premium.layout.super-system-admin-main')
@section('content')

<section class="main-contant-section">
    <div class="">
        @if(Session::get('message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{Session::get('message')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>

            </button>
        </div>
        @endif

        <div class="d-flex justify-content-between">
            <div class="section-titile card mb-3">
                <div class="card-header with-border">
                    <h1 class="card-title text-center"> {{__('Today is')}} {{now()->englishDayOfWeek}}
                        {{now()->format(env('Date_Format'))}} </h1>
                </div>
            </div>
        </div>
        <div class="dashboard-top-card-section">
            <div class="section-contant">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card ">
                            <div class="card_title">
                                <a href="{{ route('company-lists') }}">
                                    <div class="icon">
                                    <i class="fa fa-building" aria-hidden="true"></i>
                                    </div>
                                    <div class="name">
                                        <strong> Total Company </strong>
                                    </div>
                                    <div class="count-number employee-count"> <span> {{ $company_counts}} </span> </div>
                                </a>
                            </div>
                        </div>
                    </div>
            
                    <div class="col-md-3">
                        <div class="card ">
                            <div class="card_title">
                                <a href="{{ route('package-lists') }}">
                                    <div class="icon">
                                    <i class="fa fa-get-pocket" aria-hidden="true"></i>
                                    </div>
                                    <div class="name">
                                        <strong> {{__('Total Package')}} </strong>
                                    </div>
                                    <div class="count-number employee-count"> <span> {{ $package_counts }} </span> </div>
                                </a>
                            </div>
                        </div>
                    </div>
            
                    <div class="col-md-3">
                        <div class="card ">
                            <div class="card_title">
                                <a href="#">
                                    <div class="icon">
                                    <i class="fa fa-users" aria-hidden="true"></i>
                                    </div>
                                    <div class="name">
                                        <strong> {{__('Total Active Employee')}} </strong>
                                    </div>
                                    <div class="count-number employee-count"> <span> {{ $employee_active_counts }} </span> </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card ">
                            <div class="card_title">
                                <a href="#">
                                    <div class="icon">
                                    <i class="fa fa-users" aria-hidden="true"></i>
                                    </div>
                                    <div class="name">
                                        <strong> {{__('Total Inactive Employee')}} </strong>
                                    </div>
                                    <div class="count-number employee-count"> <span> {{ $employee_inactive_counts }} </span> </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dashboard-graph">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-header">
                                    <h4> Total Revenue </h4>
                                </div>
                                <div class="card-body">
                                    <div id="totalRevinew">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-header">
                                    <h4> Sales Overview </h4>
                                </div>
                                <div class="card-body">
                                    <div id="salesInfo">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="content-box">
                            <div class="section-title">
                                <h4> Employee Points </h4>
                            </div>
                            <div class="table-responsive">
                                <table id="user-table" class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th> SL No </th>
                                            <th> Employee Name </th>
                                            <th> Attendance Points </th>
                                            <th> Collaborative Points </th>
                                            <th> Management Points </th>
                                            <th> Total Points </th>
                                            <th> Date </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td> 1 </td>
                                            <td> Nahid Hassan </td>
                                            <td> 40 </td>
                                            <td> 20 </td>
                                            <td> 10 </td>
                                            <td> 100 </td>
                                            <td> 10-10-2022 </td>
                                        </tr>
                                        <tr>
                                            <td> 1 </td>
                                            <td> Nahid Hassan </td>
                                            <td> 40 </td>
                                            <td> 20 </td>
                                            <td> 10 </td>
                                            <td> 100 </td>
                                            <td> 10-10-2022 </td>
                                        </tr>
                                        <tr>
                                            <td> 1 </td>
                                            <td> Nahid Hassan </td>
                                            <td> 40 </td>
                                            <td> 20 </td>
                                            <td> 10 </td>
                                            <td> 100 </td>
                                            <td> 10-10-2022 </td>
                                        </tr>
                                        <tr>
                                            <td> 1 </td>
                                            <td> Nahid Hassan </td>
                                            <td> 40 </td>
                                            <td> 20 </td>
                                            <td> 10 </td>
                                            <td> 100 </td>
                                            <td> 10-10-2022 </td>
                                        </tr>
                                            
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    
</section>
@endsection
