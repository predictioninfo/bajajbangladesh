@extends('back-end.premium.layout.employee-setting-main')

@section('content')
<section class="main-contant-section">


    <div class=" mb-3">

        @if (Session::get('message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{ Session::get('message') }}</strong>
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
                <h1 class="card-title text-center"> {{ __('Bank Account List') }} </h1>
                <ol id="breadcrumb1">
                    <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                    <li><a href="#" type="button" data-toggle="modal" data-target="#addDepartmentModal"><span
                                class="icon icon-plus"> </span>Add</a></li>
                    <li><a href="#">List - Bank Account </a></li>
                </ol>
            </div>
        </div>


        <div id="addDepartmentModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 id="exampleModalLabel" class="modal-title">{{ _('Add') }}</h5>
                        <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i
                                class="dripicons-cross"></i></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('add-employee-bank-accounts') }}" class="form-horizontal"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <input type="hidden" name="employee_id" value="{{ Session::get('employee_setup_id') }}">

                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <label>Stuff ID:</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-user"
                                                    aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="text" name="stuff_id" class="form-control date"
                                            value="{{ $stuff_id }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label> {{ "Bank Name"}} <span class="text-danger">*</span></label>
                                    <select name="bank_id" class="form-control" required>
                                        <option value=""> Chosse Bank Name</option>
                                        @foreach($company_bank_accounts as $key => $bank_account)
                                        <option value="{{ $bank_account->id }}">{{
                                            $bank_account->company_bank_account_name
                                            ?? null }}({{
                                            $bank_account->company_bank_account_type ?? null}})
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label>Account No:</label>
                                    <input type="text" name="bank_account_number" class="form-control date" value="">
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

        <div class="content-box">

            <div class="table-responsive">
                <table id="user-table" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>{{ __('SL') }}</th>
                            <th>{{ __('Stuff ID') }}</th>
                            <th>{{ __('Bank Name') }}</th>
                            <th>{{ __('Bank Type') }}</th>
                            <th>{{ __('Branch') }}</th>
                            <th>{{ __('Routing Number') }}</th>
                            <th>{{ __('A/C No') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($i = 1)
                        @foreach ($bank_accounts as $bank_accounts_value)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $bank_accounts_value->stuff_id }}</td>
                            <td>{{ $bank_accounts_value->employeeBank->company_bank_account_name ?? null }}</td>
                            <td>{{ $bank_accounts_value->employeeBank->company_bank_account_type ?? null }}</td>
                            <td>{{ $bank_accounts_value->employeeBank->company_bank_account_branch ?? null }}</td>
                            <td>{{ $bank_accounts_value->employeeBank->company_bank_account_routing_number ?? null }}
                            </td>
                            <td>{{ $bank_accounts_value->bank_account_number ?? null}}</td>
                            <td>
                                <a href="#" id="edit-post" class="btn edit" data-toggle="modal"
                                    data-target="#EditModal{{ $bank_accounts_value->id }}" data-id=""
                                    data-toggle="tooltip" title=" Edit " data-original-title="Edit"> <i
                                        class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                @if (Auth::user()->company_profile == 'Yes')
                                <a href="{{ route('delete-employee-bank-accounts', ['id' => $bank_accounts_value->id]) }}"
                                    class="btn delete btn-danger delete-post" data-toggle="tooltip" title=""
                                    data-original-title=" Delete "> <i class="fa fa-trash-o" aria-hidden="true"></i>
                                </a>
                                @endif
                            </td>
                        </tr>

                        <!-- edit boostrap model -->
                        <div id="EditModal{{$bank_accounts_value->id}}" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="ajaxModelTitle"></h4>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post"
                                            action="{{ route('update-employee-bank-accounts',['id' => $bank_accounts_value->id]) }}"
                                            class="form-horizontal" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="id" id="id"
                                                value="{{ $bank_accounts_value->id }}">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="input-group mb-3">
                                                        <label>Stuff ID:</label>
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"> <i class="fa fa-user"
                                                                    aria-hidden="true"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" name="stuff_id" id="stuff_id"
                                                            class="form-control date"
                                                            value="{{ $bank_accounts_value->stuff_id }}" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <label> {{ "Bank Name"}} <span class="text-danger">*</span></label>
                                                    <select id="bank_id" name="bank_id" class="form-control" required>
                                                        <option value=""> Chosse Bank Name</option>
                                                        @foreach($company_bank_accounts as $key => $bank_account)
                                                        <option value="{{ $bank_account->id }}" {{ $bank_account->id ==
                                                            $bank_accounts_value->bank_account_id
                                                            ? 'selected' : '' }}>{{
                                                            $bank_account->company_bank_account_name
                                                            ?? null }}({{
                                                            $bank_account->company_bank_account_type ?? null}})
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-4 form-group">
                                                    <label>Account No:</label>
                                                    <input id="bank_account_number" type="text"
                                                        name="bank_account_number" class="form-control date"
                                                        value="{{ $bank_accounts_value->bank_account_number ?? null}}">
                                                </div>

                                                <div class="col-sm-offset-2 col-sm-10 mt-4">
                                                    <button type="submit" class="btn btn-grad">Save changes</button>
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
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection