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
                <h1 class="card-title text-center"> {{__('Tax Configure List')}} </h1>
                <ol id="breadcrumb1">
                    <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                    @if ($add_permission == 'Yes')
                    <li><a href="#" type="button" data-toggle="modal" data-target="#addModal"><span
                                class="icon icon-plus"> </span>Add</a></li>
                    </li>
                    @endif
                    <li><a href="#">List - Tax Configure </a></li>
                </ol>
            </div>
        </div>

    </div>

    <!-- Add Modal Starts -->

    <div id="addModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 id="exampleModalLabel" class="modal-title">{{_('Add Tax Config')}}</h5>
                    <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i
                            class="dripicons-cross"></i></button>
                </div>

                <div class="modal-body">
                    <form method="post" action="{{route('add-tax-configs')}}" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <label>Minimum Salary</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-money" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="minimum_salary" class="form-control" value="">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <label>Maximum Salary</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-money" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="maximum_salary" class="form-control" value="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <label>Tax Percentage %</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-money" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="tax_percentage" placeholder="10" class="form-control"
                                        value="">
                                </div>
                            </div>

                            <div class="col-sm-12 mt-4">
                                <button class="btn btn-grad" type="submit"> <i class="fa fa-plus"
                                        aria-hidden="true"></i> Add </button>
                                <!-- <input type="submit" name="action_button" class="btn btn-grad " value="{{__('Add')}}"/> -->

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
                        <th>{{__('Minimum Salary (Tk)')}}</th>
                        <th>{{__('Maximum Salary (Tk)')}}</th>
                        <th>{{__('Tax Percentage (%)')}}</th>
                        @if($edit_permission == 'Yes' || $delete_permission == 'Yes')
                        <th>{{__('Action')}}</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @php($i=1)
                    <?php
                         $previous_deducted_salary_tax = 0;
                        ?>
                    @foreach($tax_configs as $tax_configs_value)
                    <?php
                        //     $yearly_total_gross_salary = 1600000;
                        //     $house_rent_non_taxable_minimum_range_yearly = 300000;
                        //     $medical_allowance_non_taxable_minimum_range_yearly = 120000;
                        //     $conveyance_allowance_non_taxable_minimum_range_yearly = 30000;

                        //     $house_rent_of_the_yearly_gross_salary = ($yearly_total_gross_salary*30)/100;
                        //     $medical_allowance_of_the_yearly_gross_salary = ($yearly_total_gross_salary*10)/100;
                        //     $conveyance_allowance_of_the_yearly_gross_salary = ($yearly_total_gross_salary*10)/100;

                        //     if($house_rent_of_the_yearly_gross_salary >= $house_rent_non_taxable_minimum_range_yearly){
                        //         $yearly_taxable_house_rent = $house_rent_of_the_yearly_gross_salary - $house_rent_non_taxable_minimum_range_yearly;
                        //     }else{
                        //         $yearly_taxable_house_rent = 0;
                        //     }


                        //     if($medical_allowance_of_the_yearly_gross_salary >= $medical_allowance_non_taxable_minimum_range_yearly){
                        //         $yearly_taxable_medical_allowance = $medical_allowance_of_the_yearly_gross_salary - $medical_allowance_non_taxable_minimum_range_yearly;
                        //     }else{
                        //         $yearly_taxable_medical_allowance = 0;
                        //     }

                        //     if($conveyance_allowance_of_the_yearly_gross_salary >= $conveyance_allowance_non_taxable_minimum_range_yearly){
                        //         $yearly_taxable_conveyance_allowance = $conveyance_allowance_of_the_yearly_gross_salary - $conveyance_allowance_non_taxable_minimum_range_yearly;
                        //     }else{
                        //         $yearly_taxable_conveyance_allowance = 0;
                        //     }

                        //     //echo $taxable_total_yearly_salary = $yearly_taxable_house_rent + $yearly_taxable_medical_allowance + $yearly_taxable_conveyance_allowance;




                        //     $gross_salary = 1600000;

                        //     if($tax_configs_value->minimum_salary >= 1600000 && $tax_configs_value->minimum_salary <= $gross_salary ){

                        //         if($gross_salary < 16000000000){
                        //             $taxable_salary = $gross_salary - $tax_configs_value->minimum_salary;
                        //         }else{

                        //             $taxable_salary = $tax_configs_value->maximum_salary - $tax_configs_value->minimum_salary;
                        //         }


                        //         $tax_deduction_percentage = $taxable_salary*$tax_configs_value->tax_percentage;

                        //          $taxable_salary = $tax_configs_value->minimum_salary;


                        //         $tax_deduction = $tax_deduction_percentage/100;

                        //         $previous_deducted_salary_tax += $tax_deduction;

                        //     }elseif($tax_configs_value->minimum_salary >= 1100000 && $tax_configs_value->minimum_salary <= $gross_salary ){



                        //         if($gross_salary < 1600000){
                        //             $taxable_salary = $gross_salary - $tax_configs_value->minimum_salary;
                        //          }else{

                        //             $taxable_salary = $tax_configs_value->maximum_salary - $tax_configs_value->minimum_salary;
                        //          }
                        //             $tax_deduction_percentage = $taxable_salary*$tax_configs_value->tax_percentage;

                        //           $taxable_salary = $tax_configs_value->minimum_salary;


                        //           $tax_deduction = $tax_deduction_percentage/100;

                        //             $previous_deducted_salary_tax += $tax_deduction;


                        //     }elseif($tax_configs_value->minimum_salary >= 700000 && $tax_configs_value->minimum_salary <= $gross_salary){



                        //         if($gross_salary < 1100000){
                        //             $taxable_salary = $gross_salary - $tax_configs_value->minimum_salary;
                        //          }else{

                        //             $taxable_salary = $tax_configs_value->maximum_salary - $tax_configs_value->minimum_salary;
                        //          }
                        //         $tax_deduction_percentage = $taxable_salary*$tax_configs_value->tax_percentage;

                        //         $taxable_salary = $tax_configs_value->minimum_salary;


                        //       $tax_deduction = $tax_deduction_percentage/100;

                        //         $previous_deducted_salary_tax += $tax_deduction;


                        //     }elseif($tax_configs_value->minimum_salary >= 400000 && $tax_configs_value->minimum_salary <= $gross_salary){


                        //         if($gross_salary < 700000){
                        //             $taxable_salary = $gross_salary - $tax_configs_value->minimum_salary;
                        //          }else{

                        //             $taxable_salary = $tax_configs_value->maximum_salary - $tax_configs_value->minimum_salary;
                        //          }
                        //         $tax_deduction_percentage = $taxable_salary*$tax_configs_value->tax_percentage;

                        //         $taxable_salary = $tax_configs_value->minimum_salary;


                        //         $tax_deduction = $tax_deduction_percentage/100;

                        //         $previous_deducted_salary_tax += $tax_deduction;


                        //    }elseif($tax_configs_value->minimum_salary >= 300000 && $tax_configs_value->minimum_salary <= $gross_salary){


                        //         if($gross_salary < 400000){
                        //             $taxable_salary = $gross_salary - $tax_configs_value->minimum_salary;
                        //          }else{

                        //             $taxable_salary = $tax_configs_value->maximum_salary - $tax_configs_value->minimum_salary;
                        //          }
                        //     $tax_deduction_percentage = $taxable_salary*$tax_configs_value->tax_percentage;

                        //      $taxable_salary = $tax_configs_value->minimum_salary;


                        //      $tax_deduction = $tax_deduction_percentage/100;

                        //     $previous_deducted_salary_tax += $tax_deduction;


                        //     }



                        ?>
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$tax_configs_value->minimum_salary}}</td>
                        <td>{{$tax_configs_value->maximum_salary}}</td>
                        <td>{{$tax_configs_value->tax_percentage}}</td>
                        @if($edit_permission == 'Yes' || $delete_permission == 'Yes')
                        <td>
                            @if ($edit_permission == 'Yes')
                            <a href="javascript:void(0)" class="btn edit" data-id="{{$tax_configs_value->id}}"
                                data-toggle="tooltip" title="" data-original-title=" Edit "> <i
                                    class="fa fa-pencil-square-o" aria-hidden="true"></i> </a>
                            @endif
                        </td>
                        @endif
                    </tr>
                    @endforeach
                    <?php
                        //  echo "Yearly Tax Deduction : ".$previous_deducted_salary_tax;
                        //  echo "<br>";
                        //  echo "Monthly Tax Deduction : ".$previous_deducted_salary_tax/12;

                        ?>
                </tbody>

            </table>

        </div>
    </div>
</section>






<!-- edit boostrap model -->
<div class="modal fade" id="edit-modal" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="ajaxModelTitle"></h4>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('update-tax-configs')}}" class="form-horizontal"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="id">

                    <div class="col-md-12">
                        <div class="input-group mb-3">
                            <label for="name" class="col-sm-12 control-label">Minimum Salary</label>
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-money" aria-hidden="true"></i> </span>
                            </div>
                            <input type="text" name="minimum_salary" id="minimum_salary" class="form-control" value="">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="input-group mb-3">
                            <label for="name" class="col-sm-12 control-label">Maximum Salary</label>
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-money" aria-hidden="true"></i> </span>
                            </div>
                            <input type="text" name="maximum_salary" id="maximum_salary" class="form-control" value="">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="input-group mb-3">
                            <label for="name" class="col-sm-12 control-label">Tax Percentage</label>
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-money" aria-hidden="true"></i> </span>
                            </div>
                            <input type="text" name="tax_percentage" id="tax_percentage" class="form-control" value="">
                        </div>
                    </div>

                    <div class="col-sm-offset-2 col-sm-10 mt-4">
                        <button type="submit" class="btn btn-grad">Save changes
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
<!-- end bootstrap model -->



<script type="text/javascript">
    $(document).ready( function () {

  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });


             //value retriving and opening the edit modal starts

             $('.edit').on('click', function () {
                var id = $(this).data('id');

                $.ajax({
                    type:"POST",
                    url: 'tax-config-by-id',
                    data: { id: id },
                    dataType: 'json',
                    success: function(res){
                    $('#ajaxModelTitle').html("Edit");
                    $('#edit-modal').modal('show');
                    $('#id').val(res.id);
                    $('#minimum_salary').val(res.minimum_salary);
                    $('#maximum_salary').val(res.maximum_salary);
                    $('#tax_percentage').val(res.tax_percentage);
                }
                });
            });

           //value retriving and opening the edit modal ends

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