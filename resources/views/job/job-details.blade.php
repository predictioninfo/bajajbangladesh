@extends('job.layouts.master')
@section('content')

  <!-- ======= Blog Section ======= -->

    @if(Session::get('message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>{{Session::get('message')}}</strong>
        {{-- <button type="button" class="close" data-dismiss="alert" aria-label="Close"> --}}
        {{-- <span aria-hidden="true">&times;</span> --}}
        {{-- </button> --}}
        </div>

    @endif


  @foreach($job_posts as $job_post)

  <section id="" class="blog">
    <div class="container mt-5" data-aos="fade-up">

      <div class="row justify-content-center">
        <div class="col-lg-8 entries">

            <article class="entry row" style="box-shadow:0px 0px 1px 1px  red;">
              <div class="col-lg-8 col-sm-8">
                  <h2 class="col-sm-12">
                    <a>{{$job_post->jb_post_title}}</a>
                  </h2>
                  <h5 class="col-sm-9">
                    <a>{{$job_post->jobpostcompanydetails->company_name}}</a>
                  </h5>
                  <p class="col-sm-9">
                    <b>Vacancy</b>
                    <br>
                    {{$job_post->jb_post_vacancy}}
                  </p>
                  <br>
                  <p class="col-sm-9">
                    <b>Job Context</b>
                    <br>
                    {!!$job_post->jb_post_context!!}
                  </p>
                  <br>
                  <p class="col-sm-9">
                    <b>Job Responsibilities</b>
                    <br>
                    {!!$job_post->jb_post_res!!}
                  </p>
                  <br>
                  <p class="col-sm-9">
                    <b>Employment Status</b>
                    <br>
                    {{$job_post->jb_post_type_id}}
                  </p>
                  <br>
                  <p class="col-sm-9">
                    <b>Workplace</b>
                    <br>
                    {{$job_post->jb_post_wrk_plc}}
                  </p>
                  <br>
                  <p class="col-sm-9">
                    <b>Educational Requirements</b>
                    <br>
                    {!!$job_post->jb_post_edu_req!!}
                  </p>
                  <br>
                  <p class="col-sm-9">
                    <b>Experience Requirements</b>
                    <br>
                    {!!$job_post->jb_post_ex_req!!}
                  </p>
                  <br>
                  <p class="col-sm-9">
                    <b>Additional Requirements</b>
                    <br>
                    {!!$job_post->jb_post_addi_req!!}
                  </p>
                  <br>
                  <p class="col-sm-9">
                    <b>Job Location</b>
                    <br>
                    {{$job_post->jb_post_location}}
                  </p>
                  <br>
                  <p class="col-sm-9">
                    <b>Salary</b>
                    <br>
                    {{$job_post->jb_post_salary}}
                  </p>
                  <br>
                  <p class="col-sm-9">
                    <b>Compensation & Other Benefits</b>
                    <br>
                    {!!$job_post->jb_post_compen!!}
                  </p>


                </div>
                <div class="entry-content col-sm-4">
                <!-- if login  -->
                  <br> <br> <br> <br>
                  <div class="deadline" style="color:#10c7ffb4;">
                  <span style="color:red;">Deadline</span> : <?php $yrdata= strtotime($job_post->jb_post_closing_dt);
                                echo date('d-M-Y', $yrdata);
                              ?>
                  </div>
              </div>
            </article><!-- End blog entry -->

            <div class="text-center">
            {{-- <a href="#exampleModal{{$job_post->jb_post_slug}}"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$job_post->jb_post_slug}}">Apply Now</button> --}}
            {{-- <a href="{{route('online-job-applies')}}"><button type="button" class="btn btn-primary">Apply Now</button> --}}
            <form method="post" action="{{route('online-job-applies')}}" class="form-horizontal" enctype="multipart/form-data">
              @csrf

                <input type="hidden" name="id" value="{{$job_post->id}}" class="form-control" required>
                <button type="submit" class="btn btn-primary">Apply Now</button>
            </form>
            </div>

        </div>


      </div>
    </div>
  </section><!-- End Blog Section -->


  {{--
  <!-- Modal -->
  <div class="modal fade" id="exampleModal{{$job_post->jb_post_slug}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Apply Now</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="post" action="{{route('add-job-applies')}}" class="form-horizontal" enctype="multipart/form-data">
              @csrf

                <input type="text" name="slug" value="{{$job_post->jb_post_slug}}" class="form-control" required>

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
                    <input type="text" name="job_cnd_phone" id="job_cnd_phone" class="form-control" required>
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
                <div class="col-md-12 form-group">
                    <label style="font-size:12px;">আবেদন করার আগে অনুগ্রহ করে পড়ুন* প্রেডিকশন লার্নিং এসোসিয়েটস লিঃ (পি.এল.এ.) শুধুমাত্রই নিয়োগকর্তা এবং চাকরিপ্রার্থীদের মাঝে যোগাযোগ মাধ্যম হিসেবে কাজ করে। প্রেডিকশন লার্নিং এসোসিয়েটস লিঃ (পি.এল.এ.) ওয়েবসাইটের মাধ্যমে চাকরিতে আবেদন করার পর কোম্পানি যদি আপনার সাথে কোনো আর্থিক লেনদেন অথবা অনিয়ম/প্রতারণা করে তার জন্য predictionla.com লিমিটেড দায়ী থাকবে না।</label>
                    <input type="checkbox" name="job_cnd_agrmnt" value="1">
                </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Apply</button>
            </div>
          </form>
        </div>
    </div>
  </div>
  <!-- Modal End-->


  --}}




 @endforeach


  @endsection



