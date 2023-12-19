@extends('back-end.premium.layout.premium-main')
@section('content')
<style>
    input[type="text"],
    textarea {

        background-color: #d1d1d1;

    }
</style>
<!-- calander links -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
<!-- calander links ends -->


<section class="main-contant-section">
    <div class="card mb-0">
        <div class="card-header with-border">
            <h1 class="card-title text-center"> Company Calendar </h1>
        </div>
    </div>
    <div class="content-box">
        <div id='calendar'></div>
    </div>

    <!-- leave boostrap model starts -->
    <div class="modal fade" id="leave-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="ajaxModelLeaveTitle"></h4>
                </div>
                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-12 form-group">
                            <label>Employee Name:</label>
                            <input readonly id="edit_company_calendar_leave_employee_name" class="form-control date"
                                value="">
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="my-textarea">Leave Reason</label>
                            <textarea id="edit_leave_reason" readonly class="form-control" rows="5"></textarea>
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Start Date:</label>
                            <input readonly id="edit_start" class="form-control date" value=""></label>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>End Date:</label>
                            <input readonly id="edit_end" class="form-control date" value="">
                        </div>
                        <div class="col-md-12 form-group">
                            <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
    <!-- leave bootstrap model ends-->

    <!-- travel boostrap model starts-->
    <div class="modal fade" id="travel-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="ajaxModelTravelTitle"></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label>Employee Name:</label>
                            <input readonly id="edit_company_calendar_travel_employee_name" class="form-control date"
                                value="">
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Travel Place:</label>
                            <input readonly id="edit_travel_title" class="form-control date" value="">
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="my-textarea">Purpose</label>
                            <textarea id="edit_travel_purpose" readonly class="form-control" rows="5"></textarea>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Start Date:</label>
                            <input readonly id="edit_travel_start" class="form-control date" value=""></label>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>End Date:</label>
                            <input readonly id="edit_travel_end" class="form-control date" value="">
                        </div>
                        <div class="col-md-12 form-group">
                            <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
    <!-- travel bootstrap model ends-->


    <!-- training boostrap model starts-->
    <div class="modal fade" id="training-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="ajaxModelTrainingTitle"></h4>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label>Title:</label>
                            <input readonly id="edit_title" class="form-control date" value="">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Start Date:</label>
                            <input readonly id="edit_start" class="form-control date" value=""></label>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>End Date:</label>
                            <input readonly id="edit_end" class="form-control date" value="">
                        </div>
                        <div class="col-md-12 form-group">
                            <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
    <!-- training bootstrap model ends-->

    <!-- event boostrap model starts-->
    <div class="modal fade" id="event-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="ajaxModelEventTitle"></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label>Event For Department:</label>
                            <input readonly type="text" id="edit_event_department_name" class="form-control date"
                                value="">
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Event Name:</label>
                            <input readonly id="edit_event_title" class="form-control date" value="">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Start Date:</label>
                            <input readonly id="edit_event_start" class="form-control date" value=""></label>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>End Date:</label>
                            <input readonly id="edit_event_end" class="form-control date" value="">
                        </div>
                        <div class="col-md-12 form-group">
                            <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
    <!-- event bootstrap model ends-->
    <!-- holiday boostrap model starts-->
    <div class="modal fade" id="holiday-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="ajaxModelHolidayTitle"></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label>Title:</label>
                            <input readonly id="edit_holiday_title" class="form-control date" value="">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Start Date:</label>
                            <input readonly id="edit_holiday_start" class="form-control date" value=""></label>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>End Date:</label>
                            <input readonly id="edit_holiday_end" class="form-control date" value="">
                        </div>
                        <div class="col-md-12 form-group">
                            <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
    <!-- holiday bootstrap model ends-->



    <!-- edit boostrap model starts-->
    <div class="modal fade" id="edit-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="ajaxModelTitle"></h4>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label>Title:</label>
                            <input readonly id="edit_title" class="form-control date" value="">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Start Date:</label>
                            <input readonly id="edit_start" class="form-control date" value=""></label>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>End Date:</label>
                            <input readonly id="edit_end" class="form-control date" value="">
                        </div>
                        <div class="col-md-12 form-group">
                            <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
    <!-- edit bootstrap model ends-->


</section>


<script>
    $(document).ready(function () {

$.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

            var calendar = $('#calendar').fullCalendar({
                   // plugins: ['interaction', 'dayGridPlugin', 'timeGridPlugin', 'list'],
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,timeGridDay,timeGridWeek,listWeek'
                    },
                    editable: true,
                    events:"fullcalender",
                    displayEventTime: false,
                    editable: true,
                    eventRender: function (event, element, view) {
                        if (event.allDay === 'true') {
                                event.allDay = true;
                        } else {
                                event.allDay = false;
                        }

                    },
                    selectable: true,
                    selectHelper: true,
                   
                    eventClick: function (event) {
                        var id = event.id;
                        //var employee_id = event.company_calendar_employee_id;
                        var details_type = event.calander_detail_type;
                        //console.log(employee_id);
                        if(details_type == "Leave") {
                            $.ajax({
                                type:"POST",
                                url: 'fullcalender-by-id',
                                data: { id: id },
                                dataType: 'json',
                                success: function(res){
                                $('#ajaxModelLeaveTitle').html("Leave Details");
                                $('#leave-modal').modal('show');
                                $('#id').val(res.id);
                                $('#edit_company_calendar_leave_employee_name').val(res.company_calendar_employee_name);
                                $('#edit_leave_reason').val(res.calander_details);
                                $('#edit_start').val(res.start);
                                $('#edit_end').val(res.end);
                                }
                            });
                        }else if(details_type == "Travel") {
                            $.ajax({
                                type:"POST",
                                url: 'fullcalender-by-id',
                                data: { id: id },
                                dataType: 'json',
                                success: function(res){
                                $('#ajaxModelTravelTitle').html("Travel Details");
                                $('#travel-modal').modal('show');
                                $('#id').val(res.id);
                                $('#edit_company_calendar_travel_employee_name').val(res.company_calendar_employee_name);
                                $('#edit_travel_title').val(res.title);
                                $('#edit_travel_purpose').val(res.calander_details);
                                $('#edit_travel_start').val(res.start);
                                $('#edit_travel_end').val(res.end);
                                }
                            });
                        }else if(details_type == "Training") {
                            $.ajax({
                                type:"POST",
                                url: 'fullcalender-by-id',
                                data: { id: id },
                                dataType: 'json',
                                success: function(res){
                                $('#ajaxModelTrainingTitle').html("Training Details");
                                $('#training-modal').modal('show');
                                $('#id').val(res.id);
                                $('#edit_title').val(res.title);
                                $('#edit_start').val(res.start);
                                $('#edit_end').val(res.end);
                                }
                            });
                        }else if(details_type == "Event") {
                            $.ajax({
                                type:"POST",
                                url: 'fullcalender-by-id',
                                data: { id: id },
                                dataType: 'json',
                                success: function(res){
                                $('#ajaxModelEventTitle').html("Event Details");
                                $('#event-modal').modal('show');
                                $('#id').val(res.id);
                                $('#edit_event_department_name').val(res.company_calendar_event_department_name);
                                $('#edit_event_title').val(res.title);
                                $('#edit_event_start').val(res.start);
                                $('#edit_event_end').val(res.end);
                                }
                            });
                        }else if(details_type == "Holiday") {
                            $.ajax({
                                type:"POST",
                                url: 'fullcalender-by-id',
                                data: { id: id },
                                dataType: 'json',
                                success: function(res){
                                $('#ajaxModelHolidayTitle').html("Holiday Details");
                                $('#holiday-modal').modal('show');
                                $('#id').val(res.id);
                                $('#edit_holiday_title').val(res.title);
                                $('#edit_holiday_start').val(res.start);
                                $('#edit_holiday_end').val(res.end);
                                }
                            });
                        }else{
                            $.ajax({
                                type:"POST",
                                url: 'fullcalender-by-id',
                                data: { id: id },
                                dataType: 'json',
                                success: function(res){
                                $('#ajaxModelTitle').html("Details");
                                $('#edit-modal').modal('show');
                                $('#id').val(res.id);
                                $('#edit_title').val(res.title);
                                $('#edit_start').val(res.start);
                                $('#edit_end').val(res.end);
                                }
                            });
                        }

                    }
                    ////////view code ends///////////////

                });

});

function displayMessage(message) {
    toastr.success(message, 'Event');
}

</script>


@endsection