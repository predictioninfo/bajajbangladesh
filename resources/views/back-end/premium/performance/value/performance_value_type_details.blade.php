@extends('back-end.premium.layout.premium-main')
@section('content')
<?php
  use App\Models\User;
  use App\Models\ObjectiveTypeConfig;
  use App\Models\Objective;
  use App\Models\ObjectiveDetails;

//  $users = User::where('id', Session::get('employee_setup_id'))->first(['designation_id','department_id','id']);
//  $users_objectives = ObjectiveTypeConfig::where('obj_config_com_id',
// Auth::user()->com_id)->where('obj_config_desig_id',$users->designation_id)->get();
?>
<section class="main-contant-section">
    <div class="container-fluid">

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

        <div class="card mb-4">
            <div class="card-header with-border">
                <h1 class="card-title text-center"> Objective Details </h1>
            </div>
        </div>
        <div class="objective-contant">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">

                        @php($i = 1)

                        <form action="" method="POST" enctype="multipart/form-data">
                            <table class="form-table" id="Objective_plan">
                                <tbody>
                                    @foreach ($value_type_configs as
                                    $objective)
                                    <?php
                                    $Objdetails = ObjectiveDetails::where('objective_obj_type_id', $objective->objective_obj_type_id)
                                                                   ->where('objective_id',$objective->objective_id)
                                                                   ->where('obj_detail_com_id', Auth::user()->com_id)
                                                                   ->get();
                                    ?>
                                    <tr>
                                        <th colspan="5" class="text-center">
                                            {{ $objective->objectiveTypes->objective_type_name ?? null}} -
                                            {{ $objective->objectiveTypeConfig->obj_config_percent ?? null}}%</th>
                                    </tr>
                                    <tr valign="top">
                                        <th>
                                            SL
                                        </th>
                                        <th>
                                            Individual Objective With Timeline
                                        </th>
                                        <th>
                                            Measures Of Success
                                        </th>

                                        <th>
                                            <a href="javascript:void(0);" class="addOB btn"> <i class="fa fa-plus"
                                                    aria-hidden="true"></i> </a>
                                        </th>
                                        <input type="hidden" name="obj_config_obj_typ_id" value="" />

                                    </tr>
                                    @foreach ($Objdetails as $value)

                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td><input type="text" name="objective_name[]" class="code" id="customFieldName"
                                                value="{{ $value->objective_name }}" placeholder="Objective Name" />
                                        </td>
                                        <td> <input type="text" class="code" id="customFieldValue"
                                                name="objective_success[]" value="{{ $value->objective_success }}"
                                                placeholder="Objective Name Succes" /> </td>
                                        <td class="remBtn"> <a href="javascript:void(0);" class="remOB btn"><i
                                                    class="fa fa-minus" aria-hidden="true"></i></a> </td>
                                    </tr>
                                </tbody>
                                @endforeach
                                @endforeach
                            </table>
                            <button class="btn btn-grad">Approve</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function() {
            $(".addOB").click(function() {
                $("#Objective_plan").append(`
                <tr valign="top">

                    <td>  </td>
                    <td><input type="text" name="payment_method[]" class="code" id="customFieldName" name="customFieldName[]" value="" placeholder="Method Name" /></td>
                    <td> <input type="text" class="code" id="customFieldValue" name="methodInfo[]" value="" placeholder="Method Info" /> </td>
                    <td class="remBtn"> <a href="javascript:void(0);" class="remOB btn"><i class="fa fa-minus" aria-hidden="true"></i></a> </td>
                </tr>
                `);
            });
            $("#Objective_plan").on('click', '.remOB', function() {
                $(this).parent().parent().remove();
            });

        });
</script>
@endsection
