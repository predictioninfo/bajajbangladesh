@extends('job.layouts.master')
@section('content')

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

          <form method="post" action="{{route('add-training-types')}}" class="form-horizontal" enctype="multipart/form-data">
              @csrf
              <div class="row">

                  <div class="col-md-12 form-group">
                      <label>Fullname</label>
                      <input type="text" name="job_cnd_full_name" class="form-control" required>
                  </div>
                  <div class="col-md-12 form-group">
                      <label>Email</label>
                      <input type="text" name="job_cnd_email" class="form-control" required>
                  </div>
                  <div class="col-md-12 form-group">
                      <label>Phone</label>
                      <input type="text" name="job_cnd_phone" class="form-control" required>
                  </div>
                  <div class="col-md-12 form-group">
                      <label>Address</label>
                      <input type="text" name="job_cnd_address" class="form-control" required>
                  </div>
                  <div class="col-md-12 form-group">
                      <label>Fecebook Profile</label>
                      <input type="text" name="job_cnd_fb" class="form-control" required>
                  </div>
                  <div class="col-md-12 form-group">
                      <label>LinkedIn Profile</label>
                      <input type="text" name="job_cnd_lnkdin" class="form-control" required>
                  </div>
                  <div class="col-md-12 form-group">
                      <label>Cover Letter</label>
                      <textarea name="job_cnd_cover_ltr" id="jb_post_desc" class="form-control" row="50"></textarea>
                  </div>
                  <div class="col-md-12 form-group">
                      <label>Upload Your CV</label>
                      <input type="file" name="job_cnd_cv_upload" class="form-control" required>
                  </div>

                  <br><br><br>

                  <div class="col-sm-12">
                      <input type="submit" name="action_button" class="btn btn-primary btn-block" value="{{__('Add')}}"/>
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
              </div>

          </form>
      </div>
    </div>
  </div>
</div>



  <!-- ======= Blog Section ======= -->



  <section id="" class="blog">
    <div class="container mt-5" data-aos="fade-up">
    @if(Session::get('message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>{{Session::get('message')}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
         </button>
        </div>

    @endif
      <div class="row">
        <div class="col-lg-8 entries">
            @foreach($job_posts as $job_post)

            <article class="entry row" >
              <div class="col-lg-8 col-sm-8">
                <h2 class="col-sm-12">
                  <a href="{{route('single-job-details',['slug'=>$job_post->jb_post_slug])}}">{{$job_post->jb_post_title}}</a>
                </h2>
                <h5 class="col-sm-9">
                  <a href="{{route('single-job-details',['slug'=>$job_post->jb_post_slug])}}">{{$job_post->jb_post_com_name}}</a>
                </h5>
                <p class="col-sm-9">
                  Job Location : {{$job_post->jb_post_location}}
                </p>
                <p class="col-sm-9">
                  Salary: {{$job_post->jb_post_salary}}
                </p>
                <p class="col-sm-9">
                  Vacancy : {{$job_post->jb_post_vacancy}}
                </p>
                <h5 class="col-sm-9">
                  Minimum Experience : {{$job_post->jb_post_min_exp}}
                </h5>
                </div>
                <div class="entry-content col-sm-4">

                  <p class="read-more">
                  <a href="{{route('single-job-details',['slug'=>$job_post->jb_post_slug])}}">View Details</a>
                  </p>
                  <br> <br> <br> <br>
                  <div class="deadline" style="color:#10c7ffb4;">
                  Deadline : <?php $yrdata= strtotime($job_post->jb_post_closing_dt);
                                echo date('d-M-Y', $yrdata);
                              ?>
                  </div>
              </div>
            </article>
            @endforeach

            <div class="d-flex">
                {!! $job_posts->links() !!}
            </div>
        </div>
        <div class="col-lg-4">
          <div class="sidebar">

            <h3 class="sidebar-title btn" style="color:rgba(16, 199, 255, 0.705)">Job Categories</h3>
            <div class="sidebar-item categories">
              <ul>

                @foreach ($job_post__category_count as $job_category)

                <li><a href="{{route('job-categories',['categories'=>$job_category->category])}}">{{ $job_category->category}} <span>({{ $job_category->count }})</span> </a></li>

                @endforeach
              </ul>
            </div><!-- End sidebar job Title-->
            <!-- sidebar job City-->
            <h3 class="sidebar-title btn" style="color:rgba(16, 199, 255, 0.705)">City</h3>
            <div class="sidebar-item categories">
              <ul>
                @foreach ($job_post_city_count as $job_post_city)
                <li><a href="{{route('job-cities',['cities'=>$job_post_city->city])}}">{{ $job_post_city->city}} <span>({{ $job_post_city->count }})</span> </a></li>

                @endforeach
              </ul>
            </div><!-- End sidebar City-->
          </div><!-- End sidebar -->
        </div><!-- End blog sidebar -->
      </div>
    </div>
  </section><!-- End Blog Section -->
  @endsection



