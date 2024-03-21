@extends('layout.layout_front.index')
@section('title')
    Welcome Sektor Kreatif
@endsection
@section('content')
<section id="hero" class="d-flex flex-column justify-content-center align-items-center">
    <div class="container text-center text-md-left" data-aos="fade-up">
      <h2>Hello, Welcome to Sektor Kreatif</h2>
      <h1>Video Production And Digital Product Service
        {{-- <a href="" class="typewrite" data-period="2000" data-type='[ "Sektor Kreatif" ]'>
            <span class="wrap text-white"></span>
        </a> --}}
      </h1>
      <h2>More than 80% of companies use video as part of their marketing strategy,<br> and the overwhelming majority of them reap tangible ROI.</h2>
      
      <a href="https://api.whatsapp.com/send?phone={{$data['profile']->wa}}" class="btn-get-started scrollto" target="_blank">Mulai Project</a>
    </div>
  </section><!-- End Hero -->

  <main id="main">
     <!-- ======= About Section ======= -->
    <section id="about" class="about mb-5 mt-5">
      <div class="container">

        <div class="row">
          <div class="col-lg-6">
            <img src="{{asset('assets_front/img/about.jpg')}}" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0">
            <h3>Halo, Kami adalah Sektor Kreatif!</h3>
            <p align="justify"> 
               <?php
                  $num_char = 800;
                  $text = strip_tags($data['profile']->tentang_kami);
                  echo substr($text, 0, $num_char) . '...';
                ?>
            </p>
            <a href="/about" class="btn btn-primary" style="margin-top: 55px" style="width:200px">Lihat Selengkapnya</a>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts">
      <div class="container">

        <div class="row">

          <div class="col-lg-3 col-6">
            <div class="count-box">
              <i class="bi bi-patch-check"></i>
              <span>99 %</span>
              <p>Penyelesaian</p>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <div class="count-box">
              <i class="bi bi-cart-check"></i>
              <span >267</span>
              <p>Terjual</p>
            </div>
          </div>

          <div class="col-lg-3 col-6 mt-5 mt-lg-0">
            <div class="count-box">
              <i class="bi bi-repeat"></i>
              <span>146</span>
              <p>Repeat Order</p>
            </div>
          </div>

          <div class="col-lg-3 col-6 mt-5 mt-lg-0">
            <div class="count-box">
              <i class="bi bi-chat-square-dots"></i>
              <span>3 Menit</span>
              <p>Response</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Counts Section -->

     <!-- ======= Services Section ======= -->
    <section id="services"  class="portfolio section-bg">
      <div class="container">

        <div class="section-title">
          <h2>Layanan</h2>
          {{-- <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem</p> --}}
        </div>

        <div class="row portfolio-container">
          @foreach($data['service'] as $val)
            <?php 
              $icon = ($val->icon != null) ? asset($val->icon) : asset('/uploads/noimage.jpg');
            ?>
          <div class="col-lg-3 col-md-4 portfolio-item filter-app wow fadeInUp">
            <div class="portfolio-wrap">
              <figure>
                <img src="{{$icon}}" class="img-fluid" alt="">
                {{-- <a href="{{$foto}}" data-gallery="portfolioGallery" class="link-preview portfolio-lightbox" title="Preview"><i class="bx bx-plus"></i></a> --}}
              </figure>

              <div class="portfolio-info">
                <h4><a href="/detail_service/{{\Crypt::encrypt($val->id)}}">{{$val->nama}}</a></h4>
                {{-- <p>{{$val->deskripsi}}</p> --}}
              </div>
            </div>
          </div>
          @endforeach


        

        </div>
        

      </div>
    </section><!-- End Services Section -->

    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">
      <div class="container">

        <div class="section-title">
          <h2>Portfolio</h2>
          {{-- <p>Sit sint consectetur velit quisquam cupiditate impedit suscipit</p> --}}
        </div>

        <div class="row portfolio-container">
          @foreach($data['portofolio'] as $val)
          <?php 
            $foto = ($val->foto != null) ? asset($val->foto) : asset('/uploads/noimage.jpg');
          ?>
          <div class="col-lg-3 col-md-4 portfolio-item filter-app wow fadeInUp">
            <div class="portfolio-wrap">
              <figure>
                <img src="{{$foto}}" class="img-fluid" alt="">
                <a href="{{$foto}}" data-gallery="portfolioGallery" class="link-preview portfolio-lightbox" title="Preview"><i class="bx bx-plus"></i></a>
                <a href="/detail_portofolio/{{\Crypt::encrypt($val->id)}}" class="link-details" title="More Details"><i class="bx bx-link"></i></a>
              </figure>

              <div class="portfolio-info">
                <h4><a href="/detail_portofolio/{{\Crypt::encrypt($val->id)}}">{{$val->nama}}</a></h4>
                <p>{{$val->kategori}}</p>
              </div>
            </div>
          </div>
          @endforeach


        

        </div>
        <div class="row justify-content-center">
            <a href="/list_portofolio" class="btn btn-primary " style="width:200px">Selanjutnya</a>
        </div>

      </div>
    </section><!-- End Portfolio Section -->

    <!-- ======= Portfolio Section ======= -->
    <section id="kegiatan" class="portfolio">
      <div class="container">

        <div class="section-title">
          <h2>Foto kegiatan</h2>
          {{-- <p>Sit sint consectetur velit quisquam cupiditate impedit suscipit</p> --}}
        </div>

        <div class="row portfolio-container">
          @foreach($data['foto_kegiatan'] as $val)
          <?php 
            $foto = ($val->foto != null) ? asset($val->foto) : asset('/uploads/noimage.jpg');
          ?>
          <div class="col-lg-3 col-md-4 ">
            <img src="{{$foto}}" class="img-thumbnail" alt="{{$val->nama}}">
          </div>
          @endforeach


        

        </div>

      </div>
    </section><!-- End Portfolio Section -->

    <!-- ======= What We Do Section ======= -->
    <section id="what-we-do" class="what-we-do">
      <div class="container">

        <div class="section-title">
          <h2>Mitra</h2>
        </div>

        <div class="row gy-5 gy-md-6">
            
            @foreach($data['mitra'] as $val)
            
            <div class="col-6 col-md-2 align-self-center text-center">
                <img src="{{asset($val->logo)}}" alt="logo" style="width:125px;hight:65px">
            </div>
            @endforeach

        </div>

      </div>
    </section><!-- End What We Do Section -->

    <section>
      <div class="container">
        <div class="section-title">
          <h2>Kenapa Harus Kami</h2>
        </div>
        <div class="accordion" id="accordionPanelsStayOpenExample">
          @foreach($data['kenapa_harus_kami'] as $val)
          <div class="accordion-item">
            <h2 class="accordion-header" id="panelsStayOpen-heading{{$val->id}}">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse{{$val->id}}" aria-expanded="false" aria-controls="panelsStayOpen-collapse{{$val->id}}">
                {{$val->judul}}
              </button>
            </h2>
            <div id="panelsStayOpen-collapse{{$val->id}}" class="accordion-collapse collapse " aria-labelledby="panelsStayOpen-heading{{$val->id}}">
              <div class="accordion-body">
                <p>{{$val->deskripsi}}</p>
              </div>
            </div>
          </div>
          @endforeach
          
        </div>
        {{-- <ul class="timeline">
        
        @foreach($data['kenapa_harus_kami'] as $val)
        <li class="timeline-inverted">
          <div class="timeline-badge warning"><i class="glyphicon glyphicon-credit-card"></i></div>
          <div class="timeline-panel">
            <div class="timeline-heading">
              <h4 class="timeline-title">{{$val->judul}}</h4>
            </div>
            <div class="timeline-body">
              <p>{{$val->deskripsi}}</p>
            </div>
          </div>
        </li>
        @endforeach



    </ul> --}}
    </section>

   

    <!-- ======= Skills Section ======= -->
    {{-- <section id="skills" class="skills">
      <div class="container">

        <div class="row skills-content">

          <div class="col-lg-6">

            <div class="progress">
              <span class="skill">HTML <i class="val">100%</i></span>
              <div class="progress-bar-wrap">
                <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>

            <div class="progress">
              <span class="skill">CSS <i class="val">90%</i></span>
              <div class="progress-bar-wrap">
                <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>

            <div class="progress">
              <span class="skill">JavaScript <i class="val">75%</i></span>
              <div class="progress-bar-wrap">
                <div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>

          </div>

          <div class="col-lg-6">

            <div class="progress">
              <span class="skill">PHP <i class="val">80%</i></span>
              <div class="progress-bar-wrap">
                <div class="progress-bar" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>

            <div class="progress">
              <span class="skill">WordPress/CMS <i class="val">90%</i></span>
              <div class="progress-bar-wrap">
                <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>

            <div class="progress">
              <span class="skill">Photoshop <i class="val">55%</i></span>
              <div class="progress-bar-wrap">
                <div class="progress-bar" role="progressbar" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>

          </div>

        </div>

      </div>
    </section><!-- End Skills Section --> --}}


    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials section-bg">
      <div class="container">

        <div class="section-title">
          <h2>Ulasan Client</h2>
          {{-- <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem</p> --}}
        </div>

        <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
          <div class="swiper-wrapper">
            
            @foreach($data['testimoni'] as $testimoni)
            <div class="swiper-slide">
              <div class="testimonial-item">
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  {{$testimoni->isi}}
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
                {{-- <img src="assets/img/testimonials/testimonials-1.jpg" class="testimonial-img" alt=""> --}}
                <h3>{{$testimoni->nama}}</h3>
                <h4>{{$testimoni->perusahaan}}</h4>
              </div>
            </div><!-- End testimonial item -->
            @endforeach

            

          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
    </section><!-- End Testimonials Section -->

    {{-- <section id="paket_promo" class="paket_promo section-bg">
      <div class="container">

        <div class="section-title">
          <h2>Paket Promo</h2>
        </div>
        <div class="row">
          @foreach($data['paket'] as $val)
            <div class="col-12 col-md-4">
              <div class="card border-primary mb-3 text-center">
                <div class="card-header bg-transparent border-primary"><h3>{{$val->nama}}</h3></div>
                <div class="card-body">
                  <h3 class="card-title mb-5 mt-2">Rp. {{number_format($val->harga,0,',')}}</h3>
                  <?php 
                    $x = \DB::table('paket_detail')->whereIn('id', json_decode($val->id_paket_detail))->get();
                  ?>
                  @foreach($x as $c)
                  <p class="card-text">{{$c->nama}}</p>
                  @endforeach
                </div>
                <div class="card-footer bg-transparent border-primary"><a href="/list_portofolio" class="btn btn-primary mt-2 mb-2" style="width:200px">Start Project</a></div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section> --}}


    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact section-bg">
      <div class="container">

        <div class="section-title">
          <h2>Kontak Kami</h2>
          {{-- <p>Magnam dolores commodi suscipit eius consequatur ex aliquid fuga</p> --}}
        </div>

        <div class="row mt-5 justify-content-center">

          <div class="col-lg-10">

            <div class="info-wrap">
              <div class="row">
                <div class="col-lg-4 info">
                  <i class="bi bi-geo-alt"></i>
                  <h4>Alamat:</h4>
                  <p>{{$data['profile']->alamat}}</p>
                </div>

                <div class="col-lg-4 info mt-4 mt-lg-0">
                  <i class="bi bi-envelope"></i>
                  <h4>Email:</h4>
                  <p>{{$data['profile']->email}}</p>
                </div>

                <div class="col-lg-4 info mt-4 mt-lg-0">
                  <i class="bi bi-phone"></i>
                  <h4>Nomor WhatsApp :</h4>
                  <p>{{$data['profile']->no_hp}}<br>{{$data['profile']->wa}}</p>
                </div>
              </div>
            </div>

          </div>

        </div>

        {{-- <div class="row mt-5 justify-content-center">
          <div class="col-lg-10">
            <form action="forms/contact.php" method="post" role="form" class="php-email-form">
              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                </div>
              </div>
              <div class="form-group mt-3">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
              </div>
              <div class="form-group mt-3">
                <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
              </div>
              <div class="my-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div>
              <div class="text-center"><button type="submit">Send Message</button></div>
            </form>
          </div>

        </div> --}}

      </div>
    </section><!-- End Contact Section -->
  </main>
@endsection
