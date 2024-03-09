@extends('layout.layout_front.index')
@section('title')
    Detail Portofolio
@endsection
@section('content')

<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Portfolio Details</h2>
          <ol>
            <li><a href="index.html">Home</a></li>
            <li>Portfolio Details</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-4">
            {{-- <div class="portfolio-details-slider swiper">
              <div class="swiper-wrapper align-items-center"> --}}
                <?php 
                    $foto = ($data['portofolio']->foto != null) ? asset($data['portofolio']->foto) : asset('/uploads/noimage.jpg');
                ?>
                {{-- <div class="swiper-slide"> --}}
                  <img src="{{$foto}}" alt="" style="width:-webkit-fill-available">
                {{-- </div> --}}

              {{-- </div> --}}
              {{-- <div class="swiper-pagination"></div> --}}
            {{-- </div> --}}
          </div>

          <div class="col-lg-8">
            <div class="portfolio-info">
              <h3>Project information</h3>
              <p>{{$data['portofolio']->deskripsi}}</p>
            </div>
            
          </div>

        </div>

      </div>
    </section><!-- End Portfolio Details Section -->

  </main><!-- End #main -->

@endsection