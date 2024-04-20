@extends('layout.layout_front.index')
@section('title')
    Portofolio
@endsection
@section('content')
<section id="hero" class="d-flex flex-column justify-content-center align-items-center">
    <div class="container text-center text-md-left" data-aos="fade-up">
      <h1><span>Portofolio</span>
        {{-- <a href="" class="typewrite" data-period="2000" data-type='[ "Sektor Kreatif" ]'>
            <span class="wrap text-white"></span>
        </a> --}}
      </h1>
      {{-- <h2>Sit sint consectetur velit quisquam cupiditate impedit suscipit</h2> --}}
      {{-- <a href="#about" class="btn-get-started scrollto">Start Project</a> --}}
    </div>
  </section><!-- End Hero -->

  <main id="main">
    <section id="portfolio" class="portfolio">
      <div class="container">

        <div class="row">
          <div class="col-lg-12">
            <ul id="portfolio-flters">
                <li data-filter="*" class="filter-active">All</li>
                @foreach($data['kategori'] as $val)
                <li data-filter=".filter-{{$val->nama}}">{{$val->nama}}</li>
                @endforeach
            </ul>
          </div>
        </div>

        <div class="row portfolio-container">
          @foreach($data['portofolio'] as $val)
          <?php 
            $foto = ($val->foto != null) ? asset($val->foto) : asset('/uploads/noimage.jpg');
          ?>
          <div class="col-lg-3 col-md-4 portfolio-item filter-{{$val->kategori}} wow fadeInUp">
            <div class="portfolio-wrap">
              <figure>
                <img src="{{$foto}}" class="img-porto" alt="">
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


          {{-- <div class="col-lg-4 col-md-6 portfolio-item filter-web wow fadeInUp" data-wow-delay="0.1s">
            <div class="portfolio-wrap">
              <figure>
                <img src="assets/img/portfolio/portfolio-2.jpg" class="img-fluid" alt="">
                <a href="assets/img/portfolio/portfolio-2.jpg" class="link-preview portfolio-lightbox" data-gallery="portfolioGallery" title="Preview"><i class="bx bx-plus"></i></a>
                <a href="portfolio-details.html" class="link-details" title="More Details"><i class="bx bx-link"></i></a>
              </figure>

              <div class="portfolio-info">
                <h4><a href="portfolio-details.html">Web 3</a></h4>
                <p>Web</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-app wow fadeInUp" data-wow-delay="0.2s">
            <div class="portfolio-wrap">
              <figure>
                <img src="assets/img/portfolio/portfolio-3.jpg" class="img-fluid" alt="">
                <a href="assets/img/portfolio/portfolio-3.jpg" class="link-preview portfolio-lightbox" data-gallery="portfolioGallery" title="Preview"><i class="bx bx-plus"></i></a>
                <a href="portfolio-details.html" class="link-details" title="More Details"><i class="bx bx-link"></i></a>
              </figure>

              <div class="portfolio-info">
                <h4><a href="portfolio-details.html">App 2</a></h4>
                <p>App</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-card wow fadeInUp">
            <div class="portfolio-wrap">
              <figure>
                <img src="assets/img/portfolio/portfolio-4.jpg" class="img-fluid" alt="">
                <a href="assets/img/portfolio/portfolio-4.jpg" class="link-preview portfolio-lightbox" data-gallery="portfolioGallery" title="Preview"><i class="bx bx-plus"></i></a>
                <a href="portfolio-details.html" class="link-details" title="More Details"><i class="bx bx-link"></i></a>
              </figure>

              <div class="portfolio-info">
                <h4><a href="portfolio-details.html">Card 2</a></h4>
                <p>Card</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-web wow fadeInUp" data-wow-delay="0.1s">
            <div class="portfolio-wrap">
              <figure>
                <img src="assets/img/portfolio/portfolio-5.jpg" class="img-fluid" alt="">
                <a href="assets/img/portfolio/portfolio-5.jpg" class="link-preview portfolio-lightbox" data-gallery="portfolioGallery" title="Preview"><i class="bx bx-plus"></i></a>
                <a href="portfolio-details.html" class="link-details" title="More Details"><i class="bx bx-link"></i></a>
              </figure>

              <div class="portfolio-info">
                <h4><a href="portfolio-details.html">Web 2</a></h4>
                <p>Web</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-app wow fadeInUp" data-wow-delay="0.2s">
            <div class="portfolio-wrap">
              <figure>
                <img src="assets/img/portfolio/portfolio-6.jpg" class="img-fluid" alt="">
                <a href="assets/img/portfolio/portfolio-6.jpg" class="link-preview portfolio-lightbox" data-gallery="portfolioGallery" title="Preview"><i class="bx bx-plus"></i></a>
                <a href="portfolio-details.html" class="link-details" title="More Details"><i class="bx bx-link"></i></a>
              </figure>

              <div class="portfolio-info">
                <h4><a href="portfolio-details.html">App 3</a></h4>
                <p>App</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-card wow fadeInUp">
            <div class="portfolio-wrap">
              <figure>
                <img src="assets/img/portfolio/portfolio-7.jpg" class="img-fluid" alt="">
                <a href="assets/img/portfolio/portfolio-7.jpg" class="link-preview portfolio-lightbox" data-gallery="portfolioGallery" title="Preview"><i class="bx bx-plus"></i></a>
                <a href="portfolio-details.html" class="link-details" title="More Details"><i class="bx bx-link"></i></a>
              </figure>

              <div class="portfolio-info">
                <h4><a href="portfolio-details.html">Card 1</a></h4>
                <p>Card</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-card wow fadeInUp" data-wow-delay="0.1s">
            <div class="portfolio-wrap">
              <figure>
                <img src="assets/img/portfolio/portfolio-8.jpg" class="img-fluid" alt="">
                <a href="assets/img/portfolio/portfolio-8.jpg" class="link-preview portfolio-lightbox" data-gallery="portfolioGallery" title="Preview"><i class="bx bx-plus"></i></a>
                <a href="portfolio-details.html" class="link-details" title="More Details"><i class="bx bx-link"></i></a>
              </figure>

              <div class="portfolio-info">
                <h4><a href="portfolio-details.html">Card 3</a></h4>
                <p>Card</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-web wow fadeInUp" data-wow-delay="0.2s">
            <div class="portfolio-wrap">
              <figure>
                <img src="assets/img/portfolio/portfolio-9.jpg" class="img-fluid" alt="">
                <a href="assets/img/portfolio/portfolio-9.jpg" class="link-preview portfolio-lightbox" data-gallery="portfolioGallery" title="Preview"><i class="bx bx-plus"></i></a>
                <a href="portfolio-details.html" class="link-details" title="More Details"><i class="bx bx-link"></i></a>
              </figure>

              <div class="portfolio-info">
                <h4><a href="portfolio-details.html">Web 1</a></h4>
                <p>Web</p>
              </div>
            </div>
          </div> --}}

        </div>

      </div>
    </section><!-- End Portfolio Section -->
  </main>
@endsection