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
                <h1 class="card-title text-center"> {{__('Minimum Conveyance Allowance Non Taxable
                    Configure List')}} </h1>
                <ol id="breadcrumb1">
                    <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                    @if ($add_permission == 'Yes')
                    <li><a href="#" type="button" data-toggle="modal" data-target="#addModal"><span
                                class="icon icon-plus"> </span>Add / Edit
                        </a></li>
                    </li>
                    @endif
                    <li><a href="#">List - Minimum Conveyance Allowance Non Taxable Configure
                        </a></li>
                </ol>
            </div>
        </div>

    </div>

    <!-- Add Modal Starts -->

    <div id="addModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 id="exampleModalLabel" class="modal-title">{{_('Add Minimum Conveyance Allowance Non Taxable
                        Amount')}}
                    </h5>
                    <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i
                            class="dripicons-cross"></i></button>
                </div>

                <div class="modal-body">
                    <form method="post" action="{{route('minimum-conveyance-allowance-non-taxable-adds')}}"
                        class="form-horizontal" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <label>Minimum Conveyance Allowance Non Taxable
                                        Amount</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-money" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="number" name="medical_allowance_minimum_tax_amount"
                                        class="form-control" value="">
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
                        <th>{{__('Company Name')}}</th>
                        <th>{{__('Minimum Conveyance Allowance Non Taxable Amount')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @php($i=1)

                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$conveyance_allowance_non_taxable->companyName->company_name ?? null }}</td>
                        <td>{{$conveyance_allowance_non_taxable->conveyance_allowance_non_taxable_range_yearlies_amount
                            ??
                            null }}
                        </td>
                    </tr>
                </tbody>

            </table>

        </div>
    </div>
</section>

@endsection