<!DOCTYPE html>
<html lang="en">

@include('templateHome.header')

<body>
<!--==========================
    Header
    ============================-->
    <header id="header">
      <div class="container">

        <div id="logo" class="pull-left">
          <!-- Uncomment below if you prefer to use a text logo -->
          <!-- <h1><a href="#main">C<span>o</span>nf</a></h1>-->
          <a href="#intro" class="scrollto"><img src="{{ asset('img/home/logo.png') }}" alt="" title=""></a>
        </div>

        <nav id="nav-menu-container">
          <ul class="nav-menu">
            <li class="menu-active"><a href="#intro">Beranda</a></li>
            <li><a href="#about">Tentang</a></li>
            <li><a href="#speakers">Manga</a></li>
            <li><a href="#venue">Venue</a></li>
            <li><a href="#gallery">Gallery</a></li>
            <li class="buy-tickets"><a href="#buy-tickets">Buy Tickets</a></li>
          </ul>
        </nav><!-- #nav-menu-container -->
      </div>
    </header><!-- #header -->

  <!--==========================
    Intro Section
    ============================-->
    <section id="intro">
      <div class="intro-container wow fadeIn">
        <h1 class="mb-4 pb-0">The Annual<br><span>Reading</span> Manga</h1>
        <a href="https://www.youtube.com/watch?v=jDDaplaOz7Q" class="venobox play-btn mb-4" data-vbtype="video"
        data-autoplay="true"></a>
        <a href="#about" class="about-btn scrollto">About The Event</a>
      </div>
    </section>

    <main id="main">
    <!--==========================
      About Section
      ============================-->
      <section id="about">
        <div class="container">
          <div class="row">
            <div class="col-lg-6">
              <h2>Tentang The Evenet</h2>
              <p>Sed nam ut dolor qui repellendus iusto odit. Possimus inventore eveniet accusamus error amet eius aut
                accusantium et. Non odit consequatur repudiandae sequi ea odio molestiae. Enim possimus sunt inventore in
              est ut optio sequi unde.</p>
            </div>
          </div>
        </div>
      </section>

    <!--==========================
      Speakers Section
      ============================-->
      <section id="speakers" class="wow fadeInUp">
        <div class="container">
          <div class="section-header">
            <h2>Manga</h2>
            <p>Kumpulan manga terbaru hingga terlama</p>
          </div>

          <div class="row">
            @foreach ($manga as $value)
            <div class="col-lg-4 col-md-6">
              <div class="col-10 mx-auto">
                <div class="speaker" style="height: 350px;">
                  <img src="{{ asset('img/admin/manga/'.$value->image) }}" alt="Speaker 1" class="img-fluid" style="width: 100%;height: 100%;">
                  <div class="details">
                    <h3><a href="{{ route('manga-view', ['id'=> $value->_id]) }}">{{ $value->judul }}</a></h3>
                    <p>{{ date_format(date_create($value->createdAt), 'd F Y') }}</p>
                    <div class="social">
                      <a class="btn btn-dark btn-sm" href="{{ route('manga-view', ['id'=> $value->_id]) }}">Read More</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>

        </div>

      </section>

    <!--==========================
      Venue Section
      ============================-->
      <section id="venue" class="wow fadeInUp">

        <div class="container-fluid">

          <div class="section-header">
            <h2>Event Venue</h2>
            <p>Event venue location info and gallery</p>
          </div>

          <div class="row no-gutters">
            <div class="col-12 venue-info">
              <div class="row justify-content-center">
                <div class="col-11 col-lg-8">
                  <h3>Downtown Conference Center, New York</h3>
                  <p>Iste nobis eum sapiente sunt enim dolores labore accusantium autem. Cumque beatae ipsam. Est quae sit qui voluptatem corporis velit. Qui maxime accusamus possimus. Consequatur sequi et ea suscipit enim nesciunt quia velit.</p>
                </div>
              </div>
            </div>
          </div>

        </div>

        <div class="container-fluid venue-gallery-container">
          <div class="row no-gutters">

            <div class="col-lg-3 col-md-4">
              <div class="venue-gallery">
                <a href="{{ asset('img/home/venue-gallery/1.jpg') }}" class="venobox" data-gall="venue-gallery">
                  <img src="{{ asset('img/home/venue-gallery/1.jpg') }}" alt="" class="img-fluid">
                </a>
              </div>
            </div>

            <div class="col-lg-3 col-md-4">
              <div class="venue-gallery">
                <a href="{{ asset('img/home/venue-gallery/2.jpg') }}" class="venobox" data-gall="venue-gallery">
                  <img src="{{ asset('img/home/venue-gallery/2.jpg') }}" alt="" class="img-fluid">
                </a>
              </div>
            </div>

            <div class="col-lg-3 col-md-4">
              <div class="venue-gallery">
                <a href="{{ asset('img/home/venue-gallery/3.jpg') }}" class="venobox" data-gall="venue-gallery">
                  <img src="{{ asset('img/home/venue-gallery/3.jpg') }}" alt="" class="img-fluid">
                </a>
              </div>
            </div>

            <div class="col-lg-3 col-md-4">
              <div class="venue-gallery">
                <a href="{{ asset('img/home/venue-gallery/4.jpg') }}" class="venobox" data-gall="venue-gallery">
                  <img src="{{ asset('img/home/venue-gallery/4.jpg') }}" alt="" class="img-fluid">
                </a>
              </div>
            </div>

            <div class="col-lg-3 col-md-4">
              <div class="venue-gallery">
                <a href="{{ asset('img/home/venue-gallery/5.jpg') }}" class="venobox" data-gall="venue-gallery">
                  <img src="{{ asset('img/home/venue-gallery/5.jpg') }}" alt="" class="img-fluid">
                </a>
              </div>
            </div>

            <div class="col-lg-3 col-md-4">
              <div class="venue-gallery">
                <a href="{{ asset('img/home/venue-gallery/6.jpg') }}" class="venobox" data-gall="venue-gallery">
                  <img src="{{ asset('img/home/venue-gallery/6.jpg') }}" alt="" class="img-fluid">
                </a>
              </div>
            </div>

            <div class="col-lg-3 col-md-4">
              <div class="venue-gallery">
                <a href="{{ asset('img/home/venue-gallery/7.jpg') }}" class="venobox" data-gall="venue-gallery">
                  <img src="{{ asset('img/home/venue-gallery/7.jpg') }}" alt="" class="img-fluid">
                </a>
              </div>
            </div>

            <div class="col-lg-3 col-md-4">
              <div class="venue-gallery">
                <a href="{{ asset('img/home/venue-gallery/8.jpg') }}" class="venobox" data-gall="venue-gallery">
                  <img src="{{ asset('img/home/venue-gallery/8.jpg') }}" alt="" class="img-fluid">
                </a>
              </div>
            </div>

          </div>
        </div>

      </section>

    <!--==========================
      Gallery Section
      ============================-->
      <section id="gallery" class="wow fadeInUp">

        <div class="container">
          <div class="section-header">
            <h2>Gallery</h2>
            <p>Check our gallery from the recent events</p>
          </div>
        </div>

        <div class="owl-carousel gallery-carousel">
          <a href="{{ asset('img/home/gallery/1.jpg') }}" class="venobox" data-gall="gallery-carousel"><img src="{{ asset('img/home/gallery/1.jpg') }}" alt=""></a>
          <a href="{{ asset('img/home/gallery/2.jpg') }}" class="venobox" data-gall="gallery-carousel"><img src="{{ asset('img/home/gallery/2.jpg') }}" alt=""></a>
          <a href="{{ asset('img/home/gallery/3.jpg') }}" class="venobox" data-gall="gallery-carousel"><img src="{{ asset('img/home/gallery/3.jpg') }}" alt=""></a>
          <a href="{{ asset('img/home/gallery/4.jpg') }}" class="venobox" data-gall="gallery-carousel"><img src="{{ asset('img/home/gallery/4.jpg') }}" alt=""></a>
          <a href="{{ asset('img/home/gallery/5.jpg') }}" class="venobox" data-gall="gallery-carousel"><img src="{{ asset('img/home/gallery/5.jpg') }}" alt=""></a>
          <a href="{{ asset('img/home/gallery/6.jpg') }}" class="venobox" data-gall="gallery-carousel"><img src="{{ asset('img/home/gallery/6.jpg') }}" alt=""></a>
          <a href="{{ asset('img/home/gallery/7.jpg') }}" class="venobox" data-gall="gallery-carousel"><img src="{{ asset('img/home/gallery/7.jpg') }}" alt=""></a>
          <a href="{{ asset('img/home/gallery/8.jpg') }}" class="venobox" data-gall="gallery-carousel"><img src="{{ asset('img/home/gallery/8.jpg') }}" alt=""></a>
        </div>

      </section>

    <!--==========================
      F.A.Q Section
      ============================-->
      <section id="faq" class="wow fadeInUp">

        <div class="container">

          <div class="section-header">
            <h2>F.A.Q </h2>
          </div>

          <div class="row justify-content-center">
            <div class="col-lg-9">
              <ul id="faq-list">

                <li>
                  <a data-toggle="collapse" class="collapsed" href="#faq1">Non consectetur a erat nam at lectus urna duis? <i class="fa fa-minus-circle"></i></a>
                  <div id="faq1" class="collapse" data-parent="#faq-list">
                    <p>
                      Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus laoreet non curabitur gravida. Venenatis lectus magna fringilla urna porttitor rhoncus dolor purus non.
                    </p>
                  </div>
                </li>
                
                <li>
                  <a data-toggle="collapse" href="#faq2" class="collapsed">Feugiat scelerisque varius morbi enim nunc faucibus a pellentesque? <i class="fa fa-minus-circle"></i></a>
                  <div id="faq2" class="collapse" data-parent="#faq-list">
                    <p>
                      Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.
                    </p>
                  </div>
                </li>
                
                <li>
                  <a data-toggle="collapse" href="#faq3" class="collapsed">Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi? <i class="fa fa-minus-circle"></i></a>
                  <div id="faq3" class="collapse" data-parent="#faq-list">
                    <p>
                      Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci. Faucibus pulvinar elementum integer enim. Sem nulla pharetra diam sit amet nisl suscipit. Rutrum tellus pellentesque eu tincidunt. Lectus urna duis convallis convallis tellus. Urna molestie at elementum eu facilisis sed odio morbi quis
                    </p>
                  </div>
                </li>
                
                <li>
                  <a data-toggle="collapse" href="#faq4" class="collapsed">Ac odio tempor orci dapibus. Aliquam eleifend mi in nulla? <i class="fa fa-minus-circle"></i></a>
                  <div id="faq4" class="collapse" data-parent="#faq-list">
                    <p>
                      Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.
                    </p>
                  </div>
                </li>
                
                <li>
                  <a data-toggle="collapse" href="#faq5" class="collapsed">Tempus quam pellentesque nec nam aliquam sem et tortor consequat? <i class="fa fa-minus-circle"></i></a>
                  <div id="faq5" class="collapse" data-parent="#faq-list">
                    <p>
                      Molestie a iaculis at erat pellentesque adipiscing commodo. Dignissim suspendisse in est ante in. Nunc vel risus commodo viverra maecenas accumsan. Sit amet nisl suscipit adipiscing bibendum est. Purus gravida quis blandit turpis cursus in
                    </p>
                  </div>
                </li>
                
                <li>
                  <a data-toggle="collapse" href="#faq6" class="collapsed">Tortor vitae purus faucibus ornare. Varius vel pharetra vel turpis nunc eget lorem dolor? <i class="fa fa-minus-circle"></i></a>
                  <div id="faq6" class="collapse" data-parent="#faq-list">
                    <p>
                      Laoreet sit amet cursus sit amet dictum sit amet justo. Mauris vitae ultricies leo integer malesuada nunc vel. Tincidunt eget nullam non nisi est sit amet. Turpis nunc eget lorem dolor sed. Ut venenatis tellus in metus vulputate eu scelerisque. Pellentesque diam volutpat commodo sed egestas egestas fringilla phasellus faucibus. Nibh tellus molestie nunc non blandit massa enim nec.
                    </p>
                  </div>
                </li>
                
              </ul>
            </div>
          </div>

        </div>

      </section>

    <!--==========================
      Subscribe Section
      ============================-->
      <section id="subscribe">
        <div class="container wow fadeInUp">
          <div class="section-header">
            <h2>Newsletter</h2>
            <p>Rerum numquam illum recusandae quia mollitia consequatur.</p>
          </div>

          <form method="POST" action="#">
            <div class="form-row justify-content-center">
              <div class="col-auto">
                <input type="text" class="form-control" placeholder="Enter your Email">
              </div>
              <div class="col-auto">
                <button type="submit">Subscribe</button>
              </div>
            </div>
          </form>

        </div>
      </section>
    </main>


  <!--==========================
    Footer
    ============================-->
    <footer id="footer">
      <div class="footer-top">
        <div class="container">
          <div class="row">

            <div class="col-lg-3 col-md-6 footer-info">
              <img src="{{ asset('img/home/logo.png') }}" alt="TheEvenet">
              <p>In alias aperiam. Placeat tempore facere. Officiis voluptate ipsam vel eveniet est dolor et totam porro. Perspiciatis ad omnis fugit molestiae recusandae possimus. Aut consectetur id quis. In inventore consequatur ad voluptate cupiditate debitis accusamus repellat cumque.</p>
            </div>

            <div class="col-lg-3 col-md-6 footer-links">
              <h4>Useful Links</h4>
              <ul>
                <li><i class="fa fa-angle-right"></i> <a href="#">Home</a></li>
                <li><i class="fa fa-angle-right"></i> <a href="#">About us</a></li>
                <li><i class="fa fa-angle-right"></i> <a href="#">Services</a></li>
                <li><i class="fa fa-angle-right"></i> <a href="#">Terms of service</a></li>
                <li><i class="fa fa-angle-right"></i> <a href="#">Privacy policy</a></li>
              </ul>
            </div>

            <div class="col-lg-3 col-md-6 footer-links">
              <h4>Useful Links</h4>
              <ul>
                <li><i class="fa fa-angle-right"></i> <a href="#">Home</a></li>
                <li><i class="fa fa-angle-right"></i> <a href="#">About us</a></li>
                <li><i class="fa fa-angle-right"></i> <a href="#">Services</a></li>
                <li><i class="fa fa-angle-right"></i> <a href="#">Terms of service</a></li>
                <li><i class="fa fa-angle-right"></i> <a href="#">Privacy policy</a></li>
              </ul>
            </div>

            <div class="col-lg-3 col-md-6 footer-contact">
              <h4>Contact Us</h4>
              <p>
                A108 Adam Street <br>
                New York, NY 535022<br>
                United States <br>
                <strong>Phone:</strong> +1 5589 55488 55<br>
                <strong>Email:</strong> info@example.com<br>
              </p>

              <div class="social-links">
                <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
                <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
                <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
                <a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
                <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
              </div>

            </div>

          </div>
        </div>
      </div>

      <div class="container">
        <div class="copyright">
          &copy; Copyright <strong>TheEvent</strong>. All Rights Reserved
        </div>
        <div class="credits">
        <!--
          All the links in the footer should remain intact.
          You can delete the links only if you purchased the pro version.
          Licensing information: https://bootstrapmade.com/license/
          Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=TheEvent
        -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- #footer -->

  <a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>

  @include('templateHome.footer')
</body>

</html>
