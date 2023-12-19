@extends('job.layouts.master')
@section('content')
    <!-- ======= About Us Section ======= -->
    <section id="about-us" class="about-us mt-5">
      <div class="container" data-aos="fade-up">
        <div class="row content">
          <div class="section-title" data-aos="fade-up">
            <h2>About <strong>Us</strong></h2>
          </div>
          <div class="col-lg-6" data-aos="fade-right">
            <h3>Prediction Learning Associates</h3>
            <p>Change Management, Human Resource Audit, Organizational Restructuring, Compensation Survey and Design,
              Organization Tree
              Set up, Employee Relations Counseling.</p>
            <!--<div class="pt-2 pb-2 mt-2 mb-2">-->
            <!--  <img src="{{asset('system-job-portal/assets/img/clients/client-5.png')}}" class="img-fluid" alt="Image">-->
            <!--</div>-->
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0" data-aos="fade-left">
            <h5>Your Dream Our IDEA</h5>
            <p>
              Prediction Learning Associates conducts highly focused and effective international searches to locate and
              attract
              exceptional candidates for senior level positions within Multinationals, International Organizations, Non
              Government
              Organizations, Universities and Institutions, Financial Institutions and Governments.
            </p>
          </div>
        </div>

      </div>
    </section><!-- End About Us Section -->
    <hr>
    <!-- ======= Our Clients Section ======= -->
    <section id="clients" class="clients">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Clients</h2>
        </div>

        <div class="row no-gutters clients-wrap clearfix" data-aos="fade-up">

          <div class="col-lg-3 col-md-4 col-6">
            <div class="client-logo">
              <img src="{{asset('system-job-portal/assets/img/clients/Perfetti_Van_Melle_logo.png')}}" class="img-fluid" alt="">
            </div>
          </div>

          <div class="col-lg-3 col-md-4 col-6">
            <div class="client-logo">
              <img src="{{asset('system-job-portal/assets/img/clients/Skylarksoft-Logo-with-limited.png')}}" class="img-fluid" alt="">
            </div>
          </div>

          <div class="col-lg-3 col-md-4 col-6">
            <div class="client-logo">
              <img src="{{asset('system-job-portal/assets/img/clients/haier.jpg')}}" class="img-fluid" alt="">
            </div>
          </div>

          <div class="col-lg-3 col-md-4 col-6">
            <div class="client-logo">
              <img src="{{asset('system-job-portal/assets/img/clients/Asian-Paints_startuptalky.png')}}" class="img-fluid" alt="">
            </div>
          </div>


        </div>

      </div>
    </section><!-- End Our Clients Section -->
    @endsection