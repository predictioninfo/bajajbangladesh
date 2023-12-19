@extends('back-end.premium.layout.employee-setting-main')
@section('content')

<?php
    use App\Models\ApproveSalarySheet;

?>
<section class="main-contant-section">
    @if(Session::get('message'))
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
        <strong>{{Session::get('message')}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
    @endif
    <div class="card mb-0">
        <div class="card-header with-border">
            <h1 class="card-title text-center"> {{__('Approve Payslip List')}} </h1>
        </div>
    </div>
    <div class="content-box">
        <div class="table-responsive">
            <table id="user-table" class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>{{__('SL')}}</th>
                        <th>{{__('Salary Month')}}</th>
                        <th>{{__('Download')}}</th>
                        <th>{{__('Action')}}</th>
                    </tr>
                </thead>

                <tbody>
                    @php($i=1)
                    @foreach($pay_slip_details as $pay_slips_value)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$pay_slips_value->attendance_month}}</td>
                        <td>
                            <form method="post" action="{{route('download-with-out-payments-sheets')}}">
                                @csrf
                                <input type="hidden" name="month_year" value="{{$pay_slips_value->attendance_month}}">
                                <button type="submit">{{__('Download')}}</button>
                            </form>
                        </td>
                        <td>
                           <?php
                            $status = ApproveSalarySheet::where('emp_id', $pay_slips_value->monthly_employee_id)->value('status');
                            ?>
                           @if ($status == 1)
                           <button>{{ 'Approved' }}</button>
                            @else
                                <a href="{{ route('apporove-with-out-payments-sheets', $pay_slips_value->monthly_employee_id) }}" class="btn btn-info"
                                    data-toggle="tooltip" title="Approve" data-original-title="Approve">
                                    <i class="fa fa-check" aria-hidden="true"></i>
                                </a>
                            @endif

                            <a href="" class="btn btn-danger "
                                data-toggle="tooltip" title="Deny"
                                data-original-title="Deny">
                                <i class="fa fa-times" aria-hidden="true"></i>
                            </a>
                            <!-- Review Button -->
                            <button class="btn btn-primary" data-toggle="modal" data-target="#reviewModal">
                                Review
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</section>

<!-- Review Modal -->
<div class="modal fade" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="reviewModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{route('review-salary-sheets')}}" method="POST" enctype="multipart/form-data">
            @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reviewModalLabel">Review Employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <div class="form-group">
                        <label for="reviewText">Write your review:</label>
                        <textarea class="form-control"  name="review" rows="4"></textarea>
                    </div>
            </div>
            <input type="hidden" name="date" value="">
            <input type="hidden" name="id" value="">
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Send</button>
            </div>
        </div>
    </form>
    </div>
</div>




<script type="text/javascript">
    $(document).ready( function () {

  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
      $('#user-table').DataTable({


          });



  } );


</script>



@endsection
