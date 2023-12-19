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
                <h1 class="card-title text-center"> {{__('Comapny Bank Account Employee Communication')}} </h1>

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
                        <form method="post" action="{{route('add-communication-company-bank-accounts')}}"
                            class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-12 form-group">
                                <label> {{ "Bank Name"}} <span class="text-danger">*</span></label>
                                <select name="bank_id" class="form-control" required>
                                    <option value=""> Chosse Bank Name</option>
                                    @foreach($bank_accounts as $key => $bank_account)
                                    <option value="{{ $bank_account->id }}">{{ $bank_account->company_bank_account_name
                                        ?? null }}({{
                                        $bank_account->company_bank_account_type ?? null}})
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 form-group">
                                <label> {{ "Communication Employee Name"}} <span class="text-danger">*</span></label>
                                <select name="emp_id" class="form-control selectpicker region" data-live-search="true"
                                    data-live-search-style="begins" data-dependent="area_name"
                                    title="{{__('Selecting Bank Type')}}..." required>
                                    @foreach($employees as $key => $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->first_name ?? null}}
                                        {{ $employee->last_name ?? null}}
                                    </option>
                                    @endforeach
                                </select>
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
                            <th>Communication Employee Name</th>
                            <th>Communication Employee Phone</th>
                            <th>Communication Employee Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i =1;
                        @endphp
                        @foreach($commmunication_bank_accounts as $commmunication_bank_account)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $commmunication_bank_account->companyBankAccount->company_bank_account_name ?? null}}
                            </td>
                            <td>{{ $commmunication_bank_account->companyBankAccount->company_bank_account_type ?? null}}
                            </td>
                            <td>{{ $commmunication_bank_account->companyBankAccount->company_bank_account_number ??
                                null}}</td>
                            <td>{{ $commmunication_bank_account->companyBankAccount->company_bank_account_branch ??
                                null}}</td>
                            <td>{{ $commmunication_bank_account->bankAccountCommunication->first_name ?? null}}{{
                                $commmunication_bank_account->bankAccountCommunication->last_name ?? null}}</td>
                            <td>{{ $commmunication_bank_account->bankAccountCommunication->phone ?? null
                                }}</td>
                            <td>{{ $commmunication_bank_account->bankAccountCommunication->email ?? null
                                }}</td>
                            <td>
                                @if(Role::where('id',Auth::user()->role_id)->where('roles_admin_status','Yes')->where('roles_is_active',1)->exists())
                                <a href="#" id="edit-post" class="btn edit" data-toggle="modal"
                                    data-target="#EditModal{{ $commmunication_bank_account->id }}" data-id=""
                                    data-toggle="tooltip" title=" Edit " data-original-title="Edit"> <i
                                        class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                                <a href="{{route('delete-communication-company-bank-accounts',['id'=>$commmunication_bank_account->id])}}"
                                    class="btn btn-danger delete-post" data-toggle="tooltip" title=" Delete "
                                    data-original-title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                @endif
                            </td>
                        </tr>


                        <!-- edit Modal starts from here -->
                        <div id="EditModal{{$commmunication_bank_account->id}}" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-md">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 id="exampleModalLabel" class="modal-title">{{_('Edit')}}</h5>
                                        <button type="button" data-dismiss="modal" id="close" aria-label="Close"
                                            class="close"><i class="dripicons-cross"></i></button>
                                    </div>

                                    <div class="modal-body">
                                        <form method="post"
                                            action="{{route('edit-communication-company-bank-accounts',['id'=>$commmunication_bank_account->id])}}"
                                            class="form-horizontal" enctype="multipart/form-data">
                                            @csrf
                                            <div class="col-md-12 form-group">
                                                <label> {{ "Bank Name"}} <span class="text-danger">*</span></label>
                                                <select name="bank_id" class="form-control" required>
                                                    <option value=""> Chosse Bank Name</option>
                                                    @foreach($bank_accounts as $key => $bank_account)
                                                    <option value="{{ $bank_account->id }}" {{ $bank_account->id ==
                                                        $commmunication_bank_account->company_bank_account_communication_bank_id
                                                        ? 'selected' : '' }}>{{
                                                        $bank_account->company_bank_account_name
                                                        ?? null }}({{
                                                        $bank_account->company_bank_account_type ?? null}})
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label> {{ "Communication Employee Name"}} <span
                                                        class="text-danger">*</span></label>
                                                <select name="emp_id" class="form-control" required>
                                                    @foreach($employees as $key => $employee)
                                                    <option value="{{ $employee->id }}" {{ $employee->id ==
                                                        $commmunication_bank_account->company_bank_account_communication_emp_id
                                                        ? 'selected' : '' }} >{{ $employee->first_name.'
                                                        '.$employee->last_name }}
                                                    </option>
                                                    @endforeach
                                                </select>
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