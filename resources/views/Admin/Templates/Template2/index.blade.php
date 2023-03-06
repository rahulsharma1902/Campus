@extends('Public.index')
 @section('content')
 <!-- Favicons -->
 <div class="template1">
  <link href="{{ asset('template/template1/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('template/template1/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link
      href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
      rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('template/template1/vendor/animate.css/animate.min.css') }}" rel="stylesheet">
  <link href="{{ asset('template/template1/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('template/template1/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('template/template1/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('template/template1/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('template/template1/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('template/template1/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('template/template1/css/style.css') }}" rel="stylesheet">

  <!-- <body class="body"> -->
    
      <!-- ======= Header ======= -->
      <header id="header" class="fixed-top header-inner-pages">
          <div class="container d-flex align-items-center justify-content-between">
              <h1 class="logo"><a href="">{{$college_page['college_name'] ?? ''}}</a></h1>
              <!-- Uncomment below if you prefer to use an image logo -->
              <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
              <nav id="navbar" class="navbar">
                  <ul>
                      <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                      <li><a class="nav-link scrollto" href="#about">About</a></li>
                      <!-- <li><a class="nav-link scrollto" href="#address">Address</a></li> -->
                      <li><a class="nav-link  scrollto" href="#gallery">Gallery</a></li>
                      <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
                  </ul> <i class="bi bi-list mobile-nav-toggle"></i>
              </nav><!-- .navbar -->
          </div>
      </header><!-- End Header -->
      <!-- ======= Hero Section ======= -->
      <section id="hero">
          <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">
              <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>
              <div class="carousel-inner" role="listbox"> 
                <div class="carousel-item active" style="background: linear-gradient(rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.8)), url('{{asset('products_images')}}/{{$college_page['images']}}') fixed center center; !important background-repeat: no-repeat !important; background-size: cover !important;">
                        <div class="carousel-container">
                            <div class="container">
                                <h2 class="animated fadeInDown">Welcome to <span>{{$college_page['college_name'] ?? ''}}</span></h2>
                                <p class="animated fadeInUp">Ut velit est quam dolor ad a {{$college_page['college_name'] ?? ''}}. Sequi ea ut
                                    et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem mollitia ut. Similique
                                    ea voluptatem.</p> <a href="#about"
                                    class="btn-get-started animated fadeInUp scrollto">Read More</a>
                            </div>
                        </div>
                        </div>
                  <!-- Slide 1 images -->
                  <?php   $gallery = explode(",",$college_page['Gallery']); ?>
                        @foreach($gallery as $g)
                  <div class="carousel-item active" style="background: linear-gradient(rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.8)), url('{{asset('products_images')}}/{{$g}}') fixed center center; !important background-repeat: no-repeat !important; background-size: cover !important;">
                       <div class="carousel-container">
                          <div class="container">
                              <h2 class="animated fadeInDown">Welcome to <span>{{$college_page['college_name'] ?? ''}}</span></h2>
                              <p class="animated fadeInUp">Ut velit est quam dolor ad a {{$college_page['college_name'] ?? ''}}. Sequi ea ut
                                  et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem mollitia ut. Similique
                                  ea voluptatem.</p> <a href="#about"
                                  class="btn-get-started animated fadeInUp scrollto">Read More</a>
                          </div>
                      </div>
                    </div>
                    @endforeach
              </div> <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev"> <span
                      class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span> </a> <a
                  class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next"> <span
                      class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span> </a>
          </div>
          </section>
          <!-- ======= About Section ======= -->
          <section id="about" class="about">
              <div class="container-fluid">
                  <div class="row justify-content-center">
                        <div class="col-xl-5 col-lg-6 icon-boxes d-flex flex-column align-items-stretch justify-content-center py-5 px-lg-5">
                                
                        <h3>Information Section</h3>
                          <p><?php echo $college_page['information_section']; ?></p>
                        </div>
                      <div class="col-xl-5 col-lg-6 icon-boxes d-flex flex-column align-items-stretch justify-content-center py-5 px-lg-5">
                      <h3>History</h3>
                                <p> <?php echo $college_page['history']; ?></p>
                      </div>
                  </div>
              </div>
          </section><!-- End About Section -->
          <!-- ======= Cta Section ======= -->
          <!-- ======= Portfolio Section ======= -->
          <section id="gallery" class="gallery">
              <div class="container-fluid">
                  <div class="section-title">
                      <h2>Gallery</h2>
                      <h3>Check our <span>Gallery</span></h3>
                      <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at voluptas
                          atque vitae autem.</p>
                  </div>
                    <div class="row">
                    <?php   $gallery = explode(",",$college_page['Gallery']); ?>
                        @foreach($gallery as $g)
                            <div class="col-lg-4">
                                <img src="{{ asset('/products_images')}}/{{$g}}" alt="" class="img img-responsive" style="width: 100%;height: 100%;">
                            </div>
                        @endforeach
                    </div>
              </div>
          </section><!-- End Portfolio Section -->
          <!-- ======= Testimonials Section ======= -->
          <section id="managment" class="testimonials section-bg">
              <div class="container-fluid">
                  <div class="section-title">
                      <h2>Managment</h2>
                      <h3>We And <span>Our</span> MANAGMENT</h3>
                      <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at voluptas
                          atque vitae autem.</p>
                  </div>
                  <div class="row justify-content-center">
                      <div class="col-xl-10">
                          <div class="row">
                            @for($i=0; $i < count($college_page['staff']);$i++)
                              <div class="col-lg-6">
                                  <div class="testimonial-item"> <img src="{{asset('Profile_images')}}/{{$college_page['staff'][$i]['picture']}}"
                                          class="testimonial-img" alt="">
                                      <h3>{{$college_page['staff'][$i]['name'] ?? ''}}</h3>
                                      <h4>{{$college_page['staff'][$i]['department']['position_name'] ?? ''}}</h4>
                                      <p> <i class="bx bxs-quote-alt-left quote-icon-left"></i>{{$college_page['staff'][$i]['about_me'] ?? ''}}<i class="bx bxs-quote-alt-right quote-icon-right"></i> </p>
                                  </div>
                              </div><!-- End testimonial-item -->
                             @endfor 
                          </div>
                      </div>
                  </div>
              </div>
          </section><!-- End Testimonials Section -->
          <div class="d-none"><button class="college_page" data-id="{{$college_page['id'] ?? ''}}">college_page</button></div>
          <!-- ======= Contact Section ======= -->
          <section id="contact" class="contact section-bg">
              <div class="container-fluid">
                  <div class="section-title">
                      <h2>Contact</h2>
                      <h3>Get In Touch With <span>Us</span></h3>
                      <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at voluptas
                          atque vitae autem.</p>
                  </div>
                  <div class="row justify-content-center">
                      <div class="col-xl-10">
                          <div class="row">
                              <div class="col-lg-12">
                                  <div class="row justify-content-center">
                                      <div class="col-md-6 info d-flex flex-column align-items-stretch"> <i
                                              class="bx bx-phone"></i>
                                          <h4>Call Us</h4>
                                          <p>{{Auth::user()->phone_number ?? ''}}</p>
                                      </div>
                                      <div class="col-md-6 info d-flex flex-column align-items-stretch"> <i
                                              class="bx bx-envelope"></i>
                                          <h4>Email Us</h4>
                                          <p>{{Auth::user()->email ?? ''}}</p>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-lg-12 text-center my-1">
                                <!-- <div class="map"></div> -->
                                <iframe width="1000" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q={{$college_page['location']}}&key=AIzaSyD1RAgEeGApXi7twfygIEpARWGsddgys3g" allowfullscreen></iframe>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </section><!-- End Contact Section -->
      </main><!-- End #main -->
      <!-- ======= Footer ======= -->
      <footer id="footer">
          
          <div class="container">
              <div class="copyright"> &copy; Copyright <strong><span>{{$college_page['college_name'] ?? ''}}</span></strong>. All Rights Reserved </div>
              <div class="credits">
                  <!-- All the links in the footer should remain intact. -->
                  <!-- You can delete the links only if you purchased the pro version. -->
                  <!-- Licensing information: https://bootstrapmade.com/license/ -->
                  <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/hidayah-free-simple-html-template-for-corporate/ -->
                  Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
              </div>
          </div>
      </footer><!-- End Footer -->
      <script src="{{ asset('template/template1/vendor/purecounter/purecounter_vanilla.js') }}"></script>
      <script src="{{ asset('template/template1/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
      <script src="{{ asset('template/template1/vendor/glightbox/js/glightbox.min.js') }}"></script>
      <script src="{{ asset('template/template1/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
      <script src="{{ asset('template/template1/vendor/swiper/swiper-bundle.min.js') }}"></script>
      <script src="{{ asset('template/template1/vendor/waypoints/noframework.waypoints.js') }}"></script>
      <script src="{{ asset('template/template1/vendor/php-email-form/validate.js') }}"></script>
      <!-- Template Main JS File -->
      <script src="{{ asset('template/template1/js/main.js') }}"></script>
   
  <!-- </body> -->
  
  </div>
  <script>
    // $(document).ready(function () {
    //     $('.trycode').on('click', function () {
    //         var template = $(".template1").html();
    //         var college_page = $(".college_page").attr('data-id');
    //         alert('clicked');
    //         alert(template);
    //         $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //         });
    //    $.ajax({
    //             method: 'post',
    //             url: '{{url('/tryajax')}}',
    //             dataType: 'json',
    //             data: {
    //                 // _token: token,
    //                 template: template,
    //                 college_page: college_page,
    //             },
    //             success: function(response) {
    //                 Swal.fire({
    //                             icon: 'success',
    //                             title: response,
    //                             });
    //            if(response == true){
    //                 window.location.href = '{{url('/admindash/Colleges/addTemplate')}}';
    //                }else{
    //                 window.location.href = '{{url('/collegePageUpdate')}}';
    //                }
    //             }
    //         });
    //     });
    // });




    $(document).ready(function () {
       var template = $(".template1").html();
       var college_page = $(".college_page").attr('data-id');
    //    var token = $("meta[name='csrf-token']").attr("content");
    //    console.log(data);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
       $.ajax({
                method: 'post',
                url: '{{url('/addtemplatedata')}}',
                dataType: 'json',
                data: {
                    // _token: token,
                    template: template,
                    college_page: college_page,
                },
                success: function(response) {
                    Swal.fire({
                                icon: 'success',
                                title: response,
                                });
                   if(response == true){
                    window.location.href = '{{url('/admindash/Colleges/addTemplate')}}';
                   }else{
                    window.location.href = '{{url('/collegePageUpdate')}}';
                   }
                }
            });
    });
  </script>
  @endsection