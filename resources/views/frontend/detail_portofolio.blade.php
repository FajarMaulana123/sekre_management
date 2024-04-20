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
          <h2>Portofolio Details</h2>
          <ol>
            <li><a href="/">Home</a></li>
            <li>Portofolio Details</li>
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
            <div class="card">
                <div class="card-header">
                    
                    <div class="d-flex">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal" style="margin-left: auto;order: 2;">Preview</button>
                        <h4 >Project information</h4>
                    </div>
                </div>
                <div class="card-body">
                    
                    <h4><b>{{$data['portofolio']->nama}}</b></h4>
                    <p class="mt-2">{{$data['portofolio']->deskripsi}}</p>
                </div>
            </div>
            
          </div>

        </div>

      </div>
    </section><!-- End Portfolio Details Section -->

    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Preview Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="{{$data['video']}}" style="width:-webkit-fill-available;height:500px" allowfullscreen></iframe>
                </div>
            </div>
            </div>
        </div>
    </div>
  </main><!-- End #main -->

@endsection