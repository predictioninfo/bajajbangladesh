@extends('back-end.premium.layout.employee-setting-main')

@section('content')

<section class="main-contant-section">


    <div class="profile-picture-update">

        @if(Session::get('message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{Session::get('message')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif


        @foreach($profile as $profileValue)

        <div class="content-box">
        <form action="{{route('employee-profile-photo-updates')}}" method="post" class="form-horizontal"
            enctype="multipart/form-data">
            @csrf
            <input type="hidden" class="form-control" name="id" value="{{Session::get('employee_setup_id')}}">
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-12 col-form-label">Profile Picture</label>
                <div class="col-sm-12">
                    {{-- <img class="rounded" width="100" src="{{$profileValue->profile_photo}}"> --}}
                    <input type="file" name="profile_photo" value="" id="imgInp">
                    <img id="blah" src="{{$profileValue->profile_photo}}" alt="your image" width="100px"
                        height="100px" />
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-grad" id="btn-save">Update</button>
            </div>
        </form>
        </div>

        @endforeach

    </div>
</section>




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

                ///Image Preview Code Starts
                imgInp.onchange = evt => {
                const [file] = imgInp.files
                    if (file) {
                        blah.src = URL.createObjectURL(file)
                    }
                }
                ///Image Preview Code Ends



   });

</script>
@endsection
