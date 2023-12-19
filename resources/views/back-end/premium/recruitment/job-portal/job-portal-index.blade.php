<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>PLA Career Portal | Prediction Learning Associates</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <!-- Favicons -->
  <link href="{{asset('system-job-portal/assets/img/logo/plafavicons.png')}}" rel="icon">
  <link href="{{asset('system-job-portal/assets/img/logo/plalogo.png')}}" rel="apple-touch-icon">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <!-- Vendor CSS Files -->
  <link href="{{asset('system-job-portal/assets/vendor/animate.css/animate.min.css')}}" rel="stylesheet">
  <link href="{{asset('system-job-portal/assets/vendor/aos/aos.css')}}" rel="stylesheet">
  <link href="{{asset('system-job-portal/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('system-job-portal/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('system-job-portal/assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('system-job-portal/assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{asset('system-job-portal/assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{asset('system-job-portal/assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{asset('system-job-portal/assets/css/style.css')}}" rel="stylesheet">
</head>
<body>
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="d-flex align-items-center">
      <h1 class="logo me-auto navbar-brand" style="padding-left:10px;padding-right:50px;"><a href="#"><img
            src="{{asset('system-job-portal/assets/img/logo/plalogo.png')}}" class="img-fluid" alt=""></a></h1>
      <nav id="navbar" class="container navbar order-last order-lg-0">
        <ul>
          <li><a href="search.html">Search A Job</a></li>
          <li><a href="about.html">About Us</a></li>
          <li><a href="contact.html">Contact</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>
      <nav class="navbar" style="padding-right:15px;">
        <ul class="navbar-right btn-group btn-group-lg btn-group-sm d-flex">
          <button type="button" class="btn" style="background-color: #efedfc !important;"><a
              href="login.html">Login</a></button>
          <button type="button" class="btn" style="background-color: #47a0e9 !important;"><a href="jobseeker.html">Job
              Seeker</a></button>
          <button type="button" class="btn" style="background-color: #d4ca3c !important;"><a href="jobpost.html">Post A
              Job</a></button>
         </ul>
      </nav>
    </div>
    <nav class="row justify-content-center">
      <div class="col-12 col-md-10 col-lg-8">
        <form class="card card-sm">
          <div class="card-body row no-gutters align-items-center">
            <div class="col-auto">
              <i class="fas fa-search h4 text-body"></i>
            </div>
            <!--end of col-->
            <div class="col" >
              <input class="form-control form-control-lg form-control-borderless" type="search"
                placeholder="Search topics or keywords">
            </div>
            <!--end of col-->
            <div class="col-auto">
              <button class="btn btn-lg" type="submit" style="color:black; background:rgba(16, 199, 255, 0.705)">Search</button>
            </div>
            <!--end of col-->
          </div>
        </form>
      </div>
    </nav>
   </div>
  </header><!-- End Header -->
  <main id="main" class="mt-5 mb-5 pt-5 pb-5" style="margin-top:50px; padding-top: 50px;">
  <!-- ======= Blog Section ======= -->




  @foreach($job_posts as $job_post)


  <section id="" class="blog">
    <div class="container mt-5" data-aos="fade-up">
      <div class="row">
        <div class="col-lg-8 entries">  
          <article class="entry row" style="box-shadow:0px 0px 1px 1px  red;">
           <div class="col-lg-8 col-sm-8">
            <h2 class="col-sm-12">
              <a href="blog-single.html">{{$job_post->jb_post_title}}</a>
            </h2>
            <h5 class="col-sm-9">
              <a href="blog-single.html">{{$job_post->jobpostcompanydetails->company_name}}</a>
            </h5>
            <p class="col-sm-9">
              <a href="blog-single.html"><img src="assets/img/logo/location.png" class="img-fluid" alt="" style="height:15px;width:15px; border-radius:50%;"> Dhaka</a>
            </p>
            <p class="col-sm-12">
              <a href="blog-single.html"><img src="assets/img/logo/institute.png" class="img-fluid" alt="" style="height:15px;width:15px; border-radius:50%;">
              Diploma in Food Engineering with excellent track record.</a>
            </p>
            <h5 class="col-sm-9">
            <a href="blog-single.html"><img src="assets/img/logo/experince.jpg" class="img-fluid" alt="" style="height:15px;width:15px; border-radius:50%;">
             4 to 6 years</a>
            </h5>
            </div>
            <div class="entry-content col-sm-4">
            <!-- if login  -->
              <p class="read-more">
               <a href="blog-single.html">Apply now</a>
              </p>
              <br> <br> <br> <br>
              <div class="deadline">
                <a href="blog-single.html">Deadline:11 Jan 2021</a>
              </div>
            </div>
          </article><!-- End blog entry -->    
          <div class="blog-pagination">
            <ul class="justify-content-center">
              <li><a href="#">1</a></li>
              <li class="active"><a href="#">2</a></li>
              <li><a href="#">3</a></li>
            </ul>
          </div>
        </div>

      @endforeach






        <!-- End blog entries list -->
        <div class="col-lg-4">
          <div class="sidebar"> 
          <!-- sidebar job Title-->
            <h3 class="sidebar-title btn" style="color:rgba(16, 199, 255, 0.705)">Job Title</h3>
            <div class="sidebar-item categories">
              <ul>
                <li><a href="#">General <span>(25)</span></a></li>
                <li><a href="#">Hr <span>(12)</span></a></li>
                <li><a href="#">Travel <span>(5)</span></a></li>
                <li><a href="#">Design <span>(22)</span></a></li>
                <li><a href="#">Creative <span>(8)</span></a></li>
                <li><a href="#">Webdeveloper <span>(14)</span></a></li>
              </ul>
            </div><!-- End sidebar job Title-->
            <!-- sidebar job City-->
            <h3 class="sidebar-title btn" style="color:rgba(16, 199, 255, 0.705)">City</h3>
            <div class="sidebar-item categories">
              <ul>
                <li><a href="#">Dhaka <span>(25)</span></a></li>
                <li><a href="#">Rajsahi <span>(12)</span></a></li>
                <li><a href="#">khulna<span>(5)</span></a></li>
                <li><a href="#">Gazipur <span>(22)</span></a></li>
              </ul>
            </div><!-- End sidebar City-->
            <!-- sidebar job Companies -->
            <h3 class="sidebar-title btn" style="color:rgba(16, 199, 255, 0.705)">Top Companies</h3>
            <div class="sidebar-item categories">
              <ul>
                <li><a href="#">Skylark <span>(25)</span></a></li>
                <li><a href="#">Coca Cola<span>(12)</span></a></li>
                <li><a href="#">Godrej <span>(5)</span></a></li>
                <li><a href="#">Marico <span>(22)</span></a></li>
                <li><a href="#">Nagad<span>(8)</span></a></li>
              </ul>
            </div><!-- End sidebar Companies-->
            <!-- sidebar job Salary Range-->
            <h3 class="sidebar-title btn" style="color:rgba(16, 199, 255, 0.705)">Salary Range</h3>
            <div class="sidebar-item categories">
              <ul>
                <li><a href="#">General <span>(25)</span></a></li>
                <li><a href="#">Hr <span>(12)</span></a></li>
                <li><a href="#">Travel <span>(5)</span></a></li>
              </ul>
            </div><!-- End sidebar Salary Range-->
          </div><!-- End sidebar -->
        </div><!-- End blog sidebar -->
      </div>
    </div>
  </section><!-- End Blog Section -->
  </main><!-- End #main -->
  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-6 footer-contact">
            <div class="pb-2"> <img src="assets/img/logo/plalogo.png" class="img-fluid" alt=""></div>
            <p>
              Prediction Learning Associates conducts highly focused and effective international searches to locate and
              attract
              exceptional candidates for senior level positions within Multinationals, International Organizations, Non
              Government
              Organizations, Universities and Institutions, Financial Institutions and Governments.
            </p>
          </div>
          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Quick Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>
          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Popular Industries</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>
          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Popular Cities</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
            </ul>
          </div>

        </div>
      </div>
    </div>

    <div class="container d-md-flex py-4">

      <div class="me-md-auto text-center text-md-start">
        <div class="copyright">
          &copy; 2022 Copyright : <strong><span>Prediction Info Tech.</span></strong>
        </div>
        <div class="credits">
          <!-- All the links in the footer should remain intact. -->
          <!-- You can delete the links only if you purchased the pro version. -->
          <!-- Licensing information: https://bootstrapmade.com/license/ -->
          <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/company-free-html-bootstrap-template/ -->
          Designed & Developed by <a style="color:red;" href="https://predictionit.com/">PredictionIT</a>
        </div>
      </div>
      <div class="social-links text-center text-md-right pt-3 pt-md-0">
        <a href="https://twitter.com/predictionla" class="twitter"><i class="bx bxl-twitter"></i></a>
        <a href="https://www.facebook.com/predictionla" class="facebook"><i class="bx bxl-facebook"></i></a>
        <a href="https://www.instagram.com/predictionla/" class="instagram"><i class="bx bxl-instagram"></i></a>
        <a href="https://www.linkedin.com/company/prediction-learning-associates" class="linkedin"><i
            class="bx bxl-linkedin"></i></a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{asset('system-job-portal/assets/vendor/aos/aos.js')}}"></script>
  <script src="{{asset('system-job-portal/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('system-job-portal/assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{asset('system-job-portal/assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
  <script src="{{asset('system-job-portal/assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
  <script src="{{asset('system-job-portal/assets/vendor/waypoints/noframework.waypoints.js')}}"></script>
  <script src="{{asset('system-job-portal/assets/vendor/php-email-form/validate.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{asset('system-job-portal/assets/js/main.js')}}"></script>

</body>

</html>