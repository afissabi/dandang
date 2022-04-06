@extends('front.layout.app')
@section('custom_css')
<style>
    #hero {
        width: 100%;
        height: 90vh;
        /* background-image: url("img/front/hero-bg.jpg"); */
        background-image: url("img/front/hero-bg2.jpg");
        background-size: cover;
        margin-bottom: -200px;
    }
</style>
@endsection

@section('content')

<!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">
    <div class="container">
      <h1>Welcome to Dandang Kominfo</h1>
      <h2>We are team of talented designers making websites with Bootstrap</h2>
      <a href="#about" class="btn-get-started scrollto">Get Started</a>
    </div>
  </section>
<!-- End Hero -->

<main id="main">
    <!-- ======= Why Us Section ======= -->
    <section id="why-us" class="why-us">
      <div class="container">

        <div class="row">
          <div class="col-lg-4 d-flex align-items-stretch">
            <div class="content">
              <h3>Kenapa memilih kami ?</h3>
              <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Duis aute irure dolor in reprehenderit
                Asperiores dolores sed et. Tenetur quia eos. Autem tempore quibusdam vel necessitatibus optio ad corporis.
              </p>
              <div class="text-center">
                <a href="#" class="more-btn">Learn More <i class="bx bx-chevron-right"></i></a>
              </div>
            </div>
          </div>
          <div class="col-lg-8 d-flex align-items-stretch">
            <div class="icon-boxes d-flex flex-column justify-content-center">
              <div class="row">
                <div class="col-xl-4 d-flex align-items-stretch">
                  <div class="icon-box mt-4 mt-xl-0">
                    <i class="bx bx-receipt"></i>
                    <h4>Corporis voluptates sit</h4>
                    <p>Consequuntur sunt aut quasi enim aliquam quae harum pariatur laboris nisi ut aliquip</p>
                  </div>
                </div>
                <div class="col-xl-4 d-flex align-items-stretch">
                  <div class="icon-box mt-4 mt-xl-0">
                    <i class="bx bx-cube-alt"></i>
                    <h4>Ullamco laboris ladore pan</h4>
                    <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt</p>
                  </div>
                </div>
                <div class="col-xl-4 d-flex align-items-stretch">
                  <div class="icon-box mt-4 mt-xl-0">
                    <i class="bx bx-images"></i>
                    <h4>Labore consequatur</h4>
                    <p>Aut suscipit aut cum nemo deleniti aut omnis. Doloribus ut maiores omnis facere</p>
                  </div>
                </div>
              </div>
            </div><!-- End .content-->
          </div>
        </div>

      </div>
    </section>
    <!-- End Why Us Section -->
    <!-- ======= Counts Section ======= -->
    <section class="counts">
      <div class="container">

        <div class="row">

          <div class="col-lg-12 col-md-6">
            Jam Buka
          </div>

        </div>

      </div>
    </section><!-- End Counts Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
      <div class="container">

        <div class="section-title">
          <h2>KLINIK KAMI</h2>
          <p>Temukan lokasi klinik kami di sini</p>
        </div>

        <div class="row">
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="icon-box" style="width:100%">
              <div class="icon"><i class="fas fa-hospital-user"></i></div>
              <h4><a href="">PUSAT</a></h4>
              <p>Jl. Mulyorejo Pertanian No. 20 Surabaya<br>telp :</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="icon-box" style="width:100%">
              <div class="icon"><i class="fas fa-hospital-user"></i></div>
              <h4><a href="">CABANG 1</a></h4>
              <p>Jl. Mulyorejo Pertanian No. 20 Majalengka<br>telp :</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="icon-box" style="width:100%">
              <div class="icon"><i class="fas fa-hospital-user"></i></div>
              <h4><a href="">CABANG 2</a></h4>
              <p>Jl. Mulyorejo Pertanian No. 20 Sidoarjo<br>telp :</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Services Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
      <div class="container">

        <div class="section-title">
          <h2>DAFTAR POLI</h2>
          <p>Daftar Layanan Poli Kami</p>
        </div>

        <div class="row">
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="icon-box" style="width:100%">
              <div class="icon"><i class="fas fa-hospital-user"></i></div>
              <h4><a href="">POLI UMUM</a></h4>
              <p>Keterangan<br>Waktu Layanan :</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="icon-box" style="width:100%">
              <div class="icon"><i class="fas fa-hospital-user"></i></div>
              <h4><a href="">POLI KANDUNGAN</a></h4>
              <p>Keterangan<br>Waktu Layanan :</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="icon-box" style="width:100%">
              <div class="icon"><i class="fas fa-hospital-user"></i></div>
              <h4><a href="">POLI GIGI</a></h4>
              <p>Keterangan<br>Waktu Layanan :</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Services Section -->
</main>

@endsection

@section('custom_js')
@endsection