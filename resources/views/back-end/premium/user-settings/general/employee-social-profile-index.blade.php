
@extends('back-end.premium.layout.employee-setting-main')

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

           <div class="card mb-0">
            <div class="card-header with-border">
                <h1 class="card-title text-center"> {{ __('Social Profile List') }} </h1>
                <ol id="breadcrumb1">
                    <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                    <li><a href="#" type="button" data-toggle="modal" data-target="#addDepartmentModal"><span
                                    class="icon icon-plus"> </span>Add</a></li>
                    <li><a href="#">List - Social Profile </a></li>
                </ol>
            </div>
        </div>

           <div id="addDepartmentModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 id="exampleModalLabel" class="modal-title">{{_('Add Social Profile')}}</h5>
                            <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i class="dripicons-cross"></i></button>
                        </div>

                        <div class="modal-body">
                            <form method="post" action="{{route('add-social-profile-employees')}}" class="form-horizontal" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="input-group mb-3">
                                            <label>Facebook Profile:</label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-facebook" aria-hidden="true"></i> </span>
                                            </div>
                                            <input type="text" name="social_profile_fb_profile" class="form-control date" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group mb-3">
                                            <label>Linkedin Profile:</label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-linkedin" aria-hidden="true"></i> </span>
                                            </div>
                                            <input type="text" name="social_profile_linkedin_profile" class="form-control date" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group mb-3">
                                            <label>Skype Profile:</label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-skype" aria-hidden="true"></i> </span>
                                            </div>
                                            <input type="text" name="social_profile_skype_profile" class="form-control date" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group mb-3">
                                            <label>Twitter Profile:</label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-twitter" aria-hidden="true"></i> </span>
                                            </div>
                                            <input type="text" name="social_profile_twitter_profile" class="form-control date" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group mb-3">
                                            <label>Whatsapp Profile:</label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-whatsapp" aria-hidden="true"></i> </span>
                                            </div>
                                            <input type="text" name="social_profile_whatsapp_profile" class="form-control date" value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mt-4">
                                    <button class="btn btn-grad" type = "submit"> <i class="fa fa-plus" aria-hidden="true"></i> Add </button>

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
                        <th>{{__('SL')}}</th>
                        <th>{{__('Facebook Profile')}}</th>
                        <th>{{__('Linkedin Profile')}}</th>
                        <th>{{__('Skype Profile')}}</th>
                        <th>{{__('Twitter Profile')}}</th>
                        <th>{{__('Whatsapp Profile')}}</th>
                        <th>{{__('Action')}}</th>
                    </tr>
                    </thead>
                    <tbody>

                        @php($i=1)
                        @foreach($social_profile_details as $social_profile_details_value)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$social_profile_details_value->social_profile_fb_profile}}</td>
                            <td>{{$social_profile_details_value->social_profile_linkedin_profile}}</td>
                            <td>{{$social_profile_details_value->social_profile_skype_profile}}</td>
                            <td>{{$social_profile_details_value->social_profile_twitter_profile}}</td>
                            <td>{{$social_profile_details_value->social_profile_whatsapp_profile}}</td>
                            <td>
                                <a href="javascript:void(0)" class="btn  edit" data-id="{{$social_profile_details_value->id}}" data-toggle="tooltip"
                                    title="" data-original-title=" Edit "><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                <a href="{{route('delete-employee-social-profiles',['id'=>$social_profile_details_value->id])}}" class="btn btn-danger delete delete-post" data-toggle="tooltip" title=""
                                    data-original-title=" Delete "><i class="fa fa-trash-o"
                                    aria-hidden="true"></i></a>
                            </td>
                        </tr>
                        @endforeach



                    </tbody>

                </table>
            </div>
            </div>



        </div>
    </section>





      <!-- edit boostrap model -->
      <div class="modal fade" id="edit-modal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="ajaxModelTitle"></h4>
                </div>
                <div class="modal-body">
                    <form method="post" id="edit_form" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="row">
                        <div class="col-md-4">
                                        <div class="input-group mb-3">
                                            <label>Facebook Profile:</label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-facebook" aria-hidden="true"></i> </span>
                                            </div>
                                            <input type="text" name="social_profile_fb_profile" id="social_profile_fb_profile" class="form-control date" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group mb-3">
                                            <label>Linkedin Profile:</label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-linkedin" aria-hidden="true"></i> </span>
                                            </div>
                                            <input type="text" name="social_profile_linkedin_profile" id="social_profile_linkedin_profile" class="form-control date" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group mb-3">
                                            <label>Skype Profile:</label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-skype" aria-hidden="true"></i> </span>
                                            </div>
                                            <input type="text" name="social_profile_skype_profile" id="social_profile_skype_profile" class="form-control date" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group mb-3">
                                            <label>Twitter Profile:</label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-twitter" aria-hidden="true"></i> </span>
                                            </div>
                                            <input type="text" name="social_profile_twitter_profile" id="social_profile_twitter_profile" class="form-control date" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group mb-3">
                                            <label>Whatsapp Profile:</label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-whatsapp" aria-hidden="true"></i> </span>
                                            </div>
                                            <input type="text" name="social_profile_whatsapp_profile" id="social_profile_whatsapp_profile" class="form-control date" value="">
                                        </div>
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



    <script type="text/javascript">

      $(document).ready( function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });




            $('#user-table').DataTable({


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





             //value retriving and opening the edit modal starts

             $('.edit').on('click', function () {
                var id = $(this).data('id');

                $.ajax({
                    type:"POST",
                    url: 'employee-social-profile-by-id',
                    data: { id: id },
                    dataType: 'json',
                    success: function(res){
                    $('#ajaxModelTitle').html("Edit");
                    $('#edit-modal').modal('show');
                    $('#id').val(res.id);
                    $('#social_profile_fb_profile').val(res.social_profile_fb_profile);
                    $('#social_profile_linkedin_profile').val(res.social_profile_linkedin_profile);
                    $('#social_profile_skype_profile').val(res.social_profile_skype_profile);
                    $('#social_profile_twitter_profile').val(res.social_profile_twitter_profile);
                    $('#social_profile_whatsapp_profile').val(res.social_profile_whatsapp_profile);
                }
                });
            });

           //value retriving and opening the edit modal ends

             // edit form submission starts

          $('#edit_form').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                console.log(formData);
                $('#error-message').text('');

                $.ajax({
                    type:'POST',
                    url: `/update-employee-social-profile`,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                    toastr.success(response.success, 'Data successfully updated!!');
                    window.location.reload(true);
                    },
                    error: function(response){
                        toastr.error(response.error, 'Please Entry Valid Data!!');
                    }
                });
            });

            // edit form submission ends





   });

    </script>
@endsection
