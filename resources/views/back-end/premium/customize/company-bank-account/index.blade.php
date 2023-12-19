@extends('back-end.premium.layout.premium-main')

@section('content')
<?php
use App\Models\Role;
?>
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
        @if(Role::where('id',Auth::user()->role_id)->where('roles_admin_status','Yes')->where('roles_is_active',1)->exists())
        <div class="card mb-0">
            <div class="card-header with-border">
                <h1 class="card-title text-center"> {{__('Comapny Bank Account')}} </h1>

                <ol id="breadcrumb1">
                    <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                    <li><a href="#" type="button" data-toggle="modal" data-target="#addModal"><span
                                class="icon icon-plus"> </span>Add</a></li>
                </ol>

            </div>
        </div>

        <div id="addModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-md">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 id="exampleModalLabel" class="modal-title">{{ __('Add Bank Account')}}</h5>
                        <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i
                                class="dripicons-cross"></i></button>
                    </div>

                    <div class="modal-body">
                        <form method="post" action="{{route('add-company-bank-accounts')}}" class="form-horizontal"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <label>{{ "Bank Name"}}<span class="text-danger">*</span></label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-location-arrow"
                                                aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="text" name="bank_name" value="" required class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12 form-group">
                                <label> {{ "Bank Type"}} <span class="text-danger">*</span></label>

                                <select name="bank_type" class="form-control selectpicker region"
                                    data-live-search="true" data-live-search-style="begins" data-dependent="area_name"
                                    title="{{__('Selecting Bank Type')}}...">
                                    <option value="Core Bank">Core Banking</option>
                                    <option value="Mobile Bank">Mobile Banking</option>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <label>{{ "Account Number"}}<span class="text-danger">*</span></label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-location-arrow"
                                                aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="text" name="account_number" value="" required class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <label>{{ "Branch Name"}}<span class="text-danger">*</span></label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-location-arrow"
                                                aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="text" name="branch_name" value="" required class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <label>{{ "Routing Number"}}<span class="text-danger">*</span></label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-location-arrow"
                                                aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="text" name="routing_number" value="" required class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <label>{{ "Bank Address"}}<span class="text-danger">*</span></label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-location-arrow"
                                                aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="text" name="address" value="" required class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 mt-4">
                                    <button class="btn btn-grad" type="submit"> <i class="fa fa-plus"
                                            aria-hidden="true"></i>
                                        Add </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <div class="content-box">
            <div class="table-responsive">
                <table id="user-table" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Bank Name</th>
                            <th>Bank Type</th>
                            <th>Account Number</th>
                            <th>Branch Name</th>
                            <th>Routing Number</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i =1;
                        @endphp
                        @foreach($bank_accounts as $bank_account)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $bank_account->company_bank_account_name }}</td>
                            <td>{{ $bank_account->company_bank_account_type }}</td>
                            <td>{{ $bank_account->company_bank_account_number }}</td>
                            <td>{{ $bank_account->company_bank_account_branch }}</td>
                            <td>{{ $bank_account->company_bank_account_routing_number }}</td>
                            <td>{{ $bank_account->company_bank_account_address }}</td>
                            <td>
                                @if(Role::where('id',Auth::user()->role_id)->where('roles_admin_status','Yes')->where('roles_is_active',1)->exists())
                                <a href="#" id="edit-post" class="btn edit" data-toggle="modal"
                                    data-target="#EditModal{{ $bank_account->id }}" data-id="" data-toggle="tooltip"
                                    title=" Edit " data-original-title="Edit"> <i class="fa fa-pencil-square-o"
                                        aria-hidden="true"></i></a>

                                <a href="{{route('delete-company-bank-accounts',['id'=>$bank_account->id])}}"
                                    class="btn btn-danger delete-post" data-toggle="tooltip" title=" Delete "
                                    data-original-title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                @endif
                            </td>
                        </tr>


                        <!-- edit Modal starts from here -->
                        <div id="EditModal{{$bank_account->id}}" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-md">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 id="exampleModalLabel" class="modal-title">{{_('Edit')}}</h5>
                                        <button type="button" data-dismiss="modal" id="close" aria-label="Close"
                                            class="close"><i class="dripicons-cross"></i></button>
                                    </div>

                                    <div class="modal-body">
                                        <form method="post"
                                            action="{{route('edit-company-bank-accounts',['id'=>$bank_account->id])}}"
                                            class="form-horizontal" enctype="multipart/form-data">
                                            @csrf
                                            <div class="col-md-12">
                                                <div class="input-group mb-3">
                                                    <label>{{ "Bank Name"}}<span class="text-danger">*</span></label>
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"> <i class="fa fa-location-arrow"
                                                                aria-hidden="true"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text" name="bank_name"
                                                        value="{{ $bank_account->company_bank_account_name }}" required
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label> {{ "Bank Type"}} <span class="text-danger">*</span></label>

                                                <select name="bank_type" class="form-control  region">
                                                    <option value="Core Bank" {{ $bank_account->
                                                        company_bank_account_type ==
                                                        'Core Bank' ? 'selected' : '' }}>{{__('Core Banking')}}
                                                    </option>
                                                    <option value="Mobile Bank" {{ $bank_account->
                                                        company_bank_account_type ==
                                                        'Mobile Bank' ? 'selected' : '' }}>{{ __('Mobile Banking') }}
                                                    </option>
                                                </select>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="input-group mb-3">
                                                    <label>{{ "Account Number"}}<span
                                                            class="text-danger">*</span></label>
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"> <i class="fa fa-location-arrow"
                                                                aria-hidden="true"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text" name="account_number"
                                                        value="{{ $bank_account->company_bank_account_number }}"
                                                        required class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="input-group mb-3">
                                                    <label>{{ "Branch Name"}}<span class="text-danger">*</span></label>
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"> <i class="fa fa-location-arrow"
                                                                aria-hidden="true"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text" name="branch_name"
                                                        value="{{ $bank_account->company_bank_account_branch }}"
                                                        required class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="input-group mb-3">
                                                    <label>{{ "Routing Number"}}<span
                                                            class="text-danger">*</span></label>
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"> <i class="fa fa-location-arrow"
                                                                aria-hidden="true"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text" name="routing_number"
                                                        value="{{ $bank_account->company_bank_account_routing_number }}"
                                                        required class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="input-group mb-3">
                                                    <label>{{ "Bank Address"}}<span class="text-danger">*</span></label>
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"> <i class="fa fa-location-arrow"
                                                                aria-hidden="true"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text" name="address"
                                                        value="{{ $bank_account->company_bank_account_address }}"
                                                        required class="form-control">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 mt-4">
                                                    <button class="btn btn-grad" type="submit"> <i class="fa fa-plus"
                                                            aria-hidden="true"></i>
                                                        Add </button>
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
        </div>

    </div>
</section>
@endsection