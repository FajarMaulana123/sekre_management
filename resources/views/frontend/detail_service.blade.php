@extends('layout.layout_front.index')
@section('title')
    Detail Layanan
@endsection
@section('content')

<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Layanan Details</h2>
          <ol>
            <li><a href="/">Home</a></li>
            <li>Layanan Details</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
        <div class="container">
            <div class="section-title">
                <h2>{{$data['service']->nama}}</h2>
                {{-- <p>Sit sint consectetur velit quos quisquam cupiditate nemo qui</p> --}}
            </div>
            <div class="card">
                <div class="card-body">
                    <p align="justify"> 
                        {{$data['service']->deskripsi}}
                    </p>
                </div>
            </div>

        </div>
    </section><!-- End Portfolio Details Section -->

    <section id="portfolio-details" class="portfolio-details">
        <div class="container">
            <div class="section-title">
                <h2>Flow Work</h2>
                {{-- <p>Sit sint consectetur velit quos quisquam cupiditate nemo qui</p> --}}
            </div>
            <div class="row col-md-12">
                <div class="main-timeline">
                    @foreach($data['flow_work'] as $val)
                    <div class="timeline">
                        <div class="timeline-content">
                            <div class="timeline-year">
                                {{-- <span>2019</span> --}}
                            </div>
                            <h3 class="title">{{$val->nama}}</h3>
                            <p class="description">{{$val->deskripsi}}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </section><!-- End Portfolio Details Section -->

    <div class="container text-center">

        <a href="#" class="btn btn-primary center" style="width:200px">Start Project</a>
    </div>

  </main><!-- End #main -->

@endsection