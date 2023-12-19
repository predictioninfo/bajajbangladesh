@extends('job.layouts.master')
@section('content')

  <!-- ======= Blog Section ======= -->

<?php
//echo $message ;
?>

  <section id="" class="blog">
    <div class="container mt-5" data-aos="fade-up">
            @if(Session::get('message'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>{{Session::get('message')}}</strong>
                {{-- <button type="button" class="close" data-dismiss="alert" aria-label="Close"> --}}
                {{-- <span aria-hidden="true">&times;</span> --}}
                {{-- </button> --}}
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
      <div class="row">
        <div class="col-lg-12">

            <article class="entry row" style="box-shadow:0px 0px 1px 1px  red;">
              <div class="col-md-12">


              {{-- @if($message === 0) --}}

              <form method="post" action="{{route('add-job-applies')}}" class="form-horizontal" enctype="multipart/form-data">
                @csrf

                <div class="row">

                    <input type="hidden" name="id" value="{{$id}}" class="form-control" required>

                    <div class="col-md-6 form-group">
                        <label>Full Name *</label>
                        <input type="text" name="job_cnd_full_name" id="job_cnd_full_name" class="form-control" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Email *</label>
                        <input type="text" name="job_cnd_email" id="job_cnd_email" class="form-control" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Phone *</label>
                        <input type="number" name="job_cnd_phone" id="job_cnd_phone" class="form-control" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Address *</label>
                        <input type="text" name="job_cnd_address" id="job_cnd_address" class="form-control" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Facebook Link</label>
                        <input type="text" name="job_cnd_fb" id="job_cnd_fb" class="form-control" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>LinkedIn Link</label>
                        <input type="text" name="job_cnd_lnkdin" id="job_cnd_lnkdin" class="form-control" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Cover  Letter *</label>
                        <input type="text" name="job_cnd_cover_ltr" id="job_cnd_cover_ltr" class="form-control" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>CV Upload *</label>
                        <input type="file" name="job_cnd_cv_upload" id="job_cnd_cv_upload" class="form-control" required>
                    </div>
                    <br>
                    <br>
                    <br>
                    <div class="col-md-12 form-group">
                        <label style="font-size:12px;">আবেদন করার আগে অনুগ্রহ করে পড়ুন* প্রেডিকশন লার্নিং এসোসিয়েটস লিঃ (পি.এল.এ.) শুধুমাত্রই নিয়োগকর্তা এবং চাকরিপ্রার্থীদের মাঝে যোগাযোগ মাধ্যম হিসেবে কাজ করে। প্রেডিকশন লার্নিং এসোসিয়েটস লিঃ (পি.এল.এ.) ওয়েবসাইটের মাধ্যমে চাকরিতে আবেদন করার পর কোম্পানি যদি আপনার সাথে কোনো আর্থিক লেনদেন অথবা অনিয়ম/প্রতারণা করে তার জন্য predictionla.com লিমিটেড দায়ী থাকবে না।</label>
                        <input type="checkbox" name="job_cnd_agrmnt" value="1">
                    </div>
                  </div>

                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Apply</button>
                  </div>

                </div>
              </form>


              {{-- @else --}}



{{--
              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>{{$message}}</strong>

                  <a href="{{ url('job-portal') }}" style="color:black; margin-left:25px;"><button>Search A Job</button></a>

                </div>


              @endif --}}

            {{--
            @foreach ($errors->all() as $error)
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong class="text-danger">{{ $error }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endforeach

            --}}


              </div>
            </article><!-- End blog entry -->

        </div>


      </div>
    </div>
  </section><!-- End Blog Section -->




  @endsection



