@extends('layout.layout_front.index')
@section('title')
    Tentang Kami
@endsection
@section('content')
<section id="hero" class="d-flex flex-column justify-content-center align-items-center">
    <div class="container text-center text-md-left" data-aos="fade-up">
      <h1><span>Tentang Kami</span>
        {{-- <a href="" class="typewrite" data-period="2000" data-type='[ "Sektor Kreatif" ]'>
            <span class="wrap text-white"></span>
        </a> --}}
      </h1>
      {{-- <h2>Sit sint consectetur velit quisquam cupiditate impedit suscipit</h2> --}}
      {{-- <a href="#about" class="btn-get-started scrollto">Start Project</a> --}}
    </div>
</section><!-- End Hero -->

<main id="main">
    <div class="container">
        <div class="row mt-4">
            <div class="card">
                <div class="card-body">
                    <p align="justify"> 
                        {!!$data['profile']->tentang_kami!!}
                    </p>
                </div>
            </div>
        </div>
         <!-- ======= Team Section ======= -->
    <section id="team" class="team">
      <div class="container">

        <div class="section-title">
          <h2>Tim Kami</h2>
          {{-- <p>Sit sint consectetur velit quos quisquam cupiditate nemo qui</p> --}}
        </div>

        <div class="row">
          @foreach($data['team'] as $team)
          <?php 
            $foto = ($team->foto != null) ? $team->foto : '/uploads/noimage.jpg';
          ?>
          <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
            <div class="member">
              <img src="{{asset($foto)}}" alt="">
              <h4>{{$team->nama}}</h4>
              <span>{{$team->jabatan}}</span>
               
              <div class="social">
                <a href="{{$team->fb}}"><i class="bi bi-facebook"></i></a>
                <a href="{{$team->ig}}"><i class="bi bi-instagram"></i></a>
                <a href="{{$team->linkedin}}"><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>
          @endforeach

       

        </div>

      </div>
    </section><!-- End Team Section -->
    </div>

</main>
@endsection