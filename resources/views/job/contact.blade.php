@extends('job.layouts.master')
@section('content')
   <!-- ======= Contact Section ======= -->
   
   <div class="map-section mt-5">
      <iframe style="border:0; width: 100%; height: 350px;" src="https://maps.google.com/maps?q=prediction%20learning%20&t=&z=13&ie=UTF8&iwloc=&output=embed"  frameborder="0" allowfullscreen></iframe>
    </div>


    @if(Session::get('message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>{{Session::get('message')}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
    @endif

    <section id="contact" class="contact">
      <div class="container">
        <div class="row mt-5 justify-content-center" data-aos="fade-up">
          <div class="col-lg-10">


            <form method="post" action="{{route('contact-from-job-portals')}}" class="form-horizontal" enctype="multipart/form-data">
                @csrf

              <div class="row" style="border: 1px solid red; padding:20px;">

                <div class="col-md-6 form-group">
                  <input type="text" name="job_cont_name" class="form-control" placeholder="Your Name" required>
                </div>
                <div class="col-md-6">
                  <input type="eamil" name="job_cont_email" class="form-control" placeholder="Your Email" required>
                </div>
                <br>
                <br>
                <div class="col-md-12">
                  <input type="text" class="form-control" name="job_cont_phone" placeholder="Your Phone Number" required>
                </div>
                <br>
                <br>
                <div class="form-group">
                  <input type="text" class="form-control" name="job_cont_subj" placeholder="Subject" required>
                </div>
                <br>
                <br>
                <div class="form-group">
                  <textarea class="form-control" name="job_cont_msg" rows="10" placeholder="Message" required></textarea>
                </div>
                <br>
                <br>
                <div class="col-sm-12 text-center mt-3">
                  <input type="submit" name="action_button" class="btn btn-primary btn-block" value="{{__('Submit')}}"/>
                </div>

              </div>
              <br>

            </form>
          </div>

        </div>

      </div>
    </section>


	<!-- End Contact Section -->
    @endsection